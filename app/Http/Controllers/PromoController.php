<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::with('penjualan_detail')->get();
        $data = $this->calculation($produk);
        $data_harga = $this->harga($produk);
        $data_penjualan = $this->penjualan($produk);
        $data_daya_tahan = $this->dayatahan($produk);
        $data_persediaan = $this->persediaan($produk);
        $data_rekomendasi_promo = $this->rekomendasipromo($produk);
        $data_promo_pilihan = $this->promopilihan($produk);
        return view('promo.index', compact('produk', 'data', 'data_harga', 'data_penjualan', 'data_daya_tahan', 'data_persediaan', 'data_rekomendasi_promo', 'data_promo_pilihan'));
    }

    private function harga($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_harga = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c1_harga' => $val->harga_jual,
            ];

            //matriks
            if ($data_harga['c1_harga'] <= 10000) {
                $data_harga["c1_matriks"] = 1;
            } else if ($data_harga['c1_harga'] <= 15000) {
                $data_harga["c1_matriks"] = 2;
            } else if ($data_harga['c1_harga'] <= 18000) {
                $data_harga["c1_matriks"] = 3;
            } else {
                $data_harga["c1_matriks"] = 4;
            }
            //end matriks

            if ($data_harga['c1_harga'] <= 10000) {
                $data_harga["c1_grade"] = 'Rendah';
            } else if ($data_harga['c1_harga'] <= 15000) {
                $data_harga["c1_grade"] = 'Sedang';
            } else if ($data_harga['c1_harga'] <= 18000) {
                $data_harga["c1_grade"] = 'Tinggi';
            } else {
                $data_harga["c1_grade"] = 'Sangat Tinggi';
            }

            //normalisasi
            $data_harga['c1_matriks'] /= 4;
            //end normalisasi

            //hasil
            $data_harga['c1_matriks'] *= 30;
            $data_harga['total_harga'] = $data_harga['c1_matriks'];
            $data_harga['grade_harga'] = $data_harga['c1_grade'];
            //end hasil

            array_push($arr, (object)$data_harga);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total_harga')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total_harga) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total_harga;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('grade_harga')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->grade_harga) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->grade_harga;
        }
        return $arr;
    }

    private function penjualan($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_penjualan = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c2_penjualan' => $val->penjualan_detail->sum('jumlah'),
            ];

            if ($data_penjualan['c2_penjualan'] <= 50) {
                $data_penjualan["c2_matriks"] = 4;
            } else if ($data_penjualan['c2_penjualan'] <= 75) {
                $data_penjualan["c2_matriks"] = 3;
            } else if ($data_penjualan['c2_penjualan'] <= 100) {
                $data_penjualan["c2_matriks"] = 2;
            } else {
                $data_penjualan["c2_matriks"] = 1;
            }

            if ($data_penjualan['c2_penjualan'] <= 50) {
                $data_penjualan["c2_grade"] = 'Rendah';
            } else if ($data_penjualan['c2_penjualan'] <= 75) {
                $data_penjualan["c2_grade"] = 'Sedang';
            } else if ($data_penjualan['c2_penjualan'] <= 100) {
                $data_penjualan["c2_grade"] = 'Tinggi';
            } else {
                $data_penjualan["c2_grade"] = 'Sangat Tinggi';
            }


            $data_penjualan['c2_matriks'] /= 4;

            $data_penjualan['c2_matriks'] *= 20;
            $data_penjualan['total_penjualan'] = $data_penjualan['c2_matriks'];
            $data_penjualan['grade_penjualan'] = $data_penjualan['c2_grade'];

            array_push($arr, (object)$data_penjualan);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total_penjualan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total_penjualan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total_penjualan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('grade_penjualan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->grade_penjualan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->grade_penjualan;
        }
        return $arr;
    }

    private function dayatahan($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_daya_tahan = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c3_daya_tahan' => $val->daya_tahan,
            ];

            if ($data_daya_tahan['c3_daya_tahan'] <= 3) {
                $data_daya_tahan["c3_matriks"] = 4;
            } else if ($data_daya_tahan['c3_daya_tahan'] <= 7) {
                $data_daya_tahan["c3_matriks"] = 3;
            } else if ($data_daya_tahan['c3_daya_tahan'] <= 10) {
                $data_daya_tahan["c3_matriks"] = 2;
            } else {
                $data_daya_tahan["c3_matriks"] = 1;
            }

            if ($data_daya_tahan['c3_daya_tahan'] <= 3) {
                $data_daya_tahan["c3_grade"] = 'Rendah';
            } else if ($data_daya_tahan['c3_daya_tahan'] <= 7) {
                $data_daya_tahan["c3_grade"] = 'Sedang';
            } else if ($data_daya_tahan['c3_daya_tahan'] <= 10) {
                $data_daya_tahan["c3_grade"] = 'Tinggi';
            } else {
                $data_daya_tahan["c3_grade"] = 'Sangat Tinggi';
            }

            $data_daya_tahan['c3_matriks'] = 1 / $data_daya_tahan['c3_matriks'];

            $data_daya_tahan['c3_matriks'] *= 20;
            $data_daya_tahan['total_daya_tahan'] = $data_daya_tahan['c3_matriks'];
            $data_daya_tahan['grade_daya_tahan'] = $data_daya_tahan['c3_grade'];

            array_push($arr, (object)$data_daya_tahan);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total_daya_tahan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total_daya_tahan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total_daya_tahan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('grade_daya_tahan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->grade_daya_tahan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->grade_daya_tahan;
        }
        return $arr;
    }

    private function persediaan($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_persediaan = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c4_persediaan' => $val->stok,
            ];

            if ($data_persediaan['c4_persediaan'] <= 30) {
                $data_persediaan["c4_matriks"] = 1;
            } else if ($data_persediaan['c4_persediaan'] <= 40) {
                $data_persediaan["c4_matriks"] = 2;
            } else if ($data_persediaan['c4_persediaan'] <= 50) {
                $data_persediaan["c4_matriks"] = 3;
            } else {
                $data_persediaan["c4_matriks"] = 4;
            }

            if ($data_persediaan['c4_persediaan'] <= 30) {
                $data_persediaan["c4_grade"] = 'Rendah';
            } else if ($data_persediaan['c4_persediaan'] <= 40) {
                $data_persediaan["c4_grade"] = 'Sedang';
            } else if ($data_persediaan['c4_persediaan'] <= 50) {
                $data_persediaan["c4_grade"] = 'Tinggi';
            } else {
                $data_persediaan["c4_grade"] = 'Sangat Tinggi';
            }

            $data_persediaan['c4_matriks'] /= 4;

            $data_persediaan['c4_matriks'] *= 30;
            $data_persediaan['total_persediaan'] = $data_persediaan['c4_matriks'];
            $data_persediaan['grade_persediaan'] = $data_persediaan['c4_grade'];

            array_push($arr, (object)$data_persediaan);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total_persediaan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total_persediaan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total_persediaan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('grade_persediaan')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->grade_persediaan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->grade_persediaan;
        }
        return $arr;
    }

    private function promopilihan($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_promo_pilihan = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c1_harga' => $val->harga_jual,
                'c2_penjualan' => $val->penjualan_detail->sum('jumlah'),
                'c3_daya_tahan' => $val->daya_tahan,
                'c4_persediaan' => $val->stok,
            ];

            //Rekomendasi Promo
            if ($data_promo_pilihan['c4_persediaan'] >= 50 && $data_promo_pilihan['c2_penjualan'] <= 75) {
                $data_promo_pilihan["r1_promo"] = 'Bundling';
            } else if ($data_promo_pilihan['c1_harga'] <= 18000 && $data_promo_pilihan['c4_persediaan'] >= 40) {
                $data_promo_pilihan["r2_promo"] = 'Cashback';
            } else if ($data_promo_pilihan['c2_penjualan'] <= 75 && $data_promo_pilihan['c4_persediaan'] <= 50) {
                $data_promo_pilihan["r3_promo"] = 'Diskon Harga';
            } else { 
                $data_promo_pilihan["r4_promo"] = 'Tidak Ada Promo Yang Sesuai';
            }
            //End

            $data_promo_pilihan['hasil'] = '';

            array_push($arr, (object)$data_promo_pilihan);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('hasil')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->hasil) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->hasil;
        }
        return $arr;
    }

    private function calculation($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c1_harga' => $val->harga_jual,
                'c2_penjualan' => $val->penjualan_detail->sum('jumlah'),
                'c3_daya_tahan' => $val->daya_tahan,
                'c4_persediaan' => $val->stok,
            ];

            //matriks
            if ($data['c1_harga'] <= 10000) {
                $data["c1_matriks"] = 1;
            } else if ($data['c1_harga'] <= 15000) {
                $data["c1_matriks"] = 2;
            } else if ($data['c1_harga'] <= 18000) {
                $data["c1_matriks"] = 3;
            } else {
                $data["c1_matriks"] = 4;
            }

            if ($data['c2_penjualan'] <= 50) {
                $data["c2_matriks"] = 4;
            } else if ($data['c2_penjualan'] <= 75) {
                $data["c2_matriks"] = 3;
            } else if ($data['c2_penjualan'] <= 100) {
                $data["c2_matriks"] = 2;
            } else {
                $data["c2_matriks"] = 1;
            }

            if ($data['c3_daya_tahan'] <= 3) {
                $data["c3_matriks"] = 4;
            } else if ($data['c3_daya_tahan'] <= 7) {
                $data["c3_matriks"] = 3;
            } else if ($data['c3_daya_tahan'] <= 10) {
                $data["c3_matriks"] = 2;
            } else {
                $data["c3_matriks"] = 1;
            }

            if ($data['c4_persediaan'] <= 30) {
                $data["c4_matriks"] = '1';
            } else if ($data['c4_persediaan'] <= 40) {
                $data["c4_matriks"] = 2;
            } else if ($data['c4_persediaan'] <= 50) {
                $data["c4_matriks"] = 3;
            } else {
                $data["c4_matriks"] = 4;
            }
            // end matriks

            // normalisasi
            $data['c1_matriks'] /= 4;
            $data['c2_matriks'] /= 4;
            //$data['c2_matriks'] = 1 / $data['c2_matriks'];
            $data['c3_matriks'] = 1 / $data['c3_matriks'];
            $data['c4_matriks'] /= 4;
            // end normalisasi

            // ranking
            $data['c1_matriks'] *= 30;
            $data['c2_matriks'] *= 20;
            $data['c3_matriks'] *= 20;
            $data['c4_matriks'] *= 30;
            $data['total'] = $data['c1_matriks'] +  $data['c2_matriks'] +  $data['c3_matriks'] +  $data['c4_matriks'];
            // end ranking

            array_push($arr, (object)$data);
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total')->reverse()->take(10);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total;
        }
        return $arr;
    }

    private function rekomendasipromo($produk)
    {
        $arr = array();
        foreach ($produk as $val) {
            $data_rekomendasi_promo = [
                'nama_produk' => $val->nama_produk,
                'kode_produk' => $val->kode_produk,
                'c1_harga' => $val->harga_jual,
                'c2_penjualan' => $val->penjualan_detail->sum('jumlah'),
                'c3_daya_tahan' => $val->daya_tahan,
                'c4_persediaan' => $val->stok,
            ];

            //matriks
            if ($data_rekomendasi_promo['c1_harga'] <= 10000) {
                $data_rekomendasi_promo["c1_matriks"] = 1;
            } else if ($data_rekomendasi_promo['c1_harga'] <= 15000) {
                $data_rekomendasi_promo["c1_matriks"] = 2;
            } else if ($data_rekomendasi_promo['c1_harga'] <= 18000) {
                $data_rekomendasi_promo["c1_matriks"] = 3;
            } else {
                $data_rekomendasi_promo["c1_matriks"] = 4;
            }

            if ($data_rekomendasi_promo['c2_penjualan'] <= 50) {
                $data_rekomendasi_promo["c2_matriks"] = 4;
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 75) {
                $data_rekomendasi_promo["c2_matriks"] = 3;
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 100) {
                $data_rekomendasi_promo["c2_matriks"] = 2;
            } else {
                $data_rekomendasi_promo["c2_matriks"] = 1;
            }

            if ($data_rekomendasi_promo['c3_daya_tahan'] <= 3) {
                $data_rekomendasi_promo["c3_matriks"] = 4;
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 7) {
                $data_rekomendasi_promo["c3_matriks"] = 3;
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 10) {
                $data_rekomendasi_promo["c3_matriks"] = 2;
            } else {
                $data_rekomendasi_promo["c3_matriks"] = 1;
            }

            if ($data_rekomendasi_promo['c4_persediaan'] <= 30) {
                $data_rekomendasi_promo["c4_matriks"] = 1;
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 40) {
                $data_rekomendasi_promo["c4_matriks"] = 2;
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 50) {
                $data_rekomendasi_promo["c4_matriks"] = 3;
            } else {
                $data_rekomendasi_promo["c4_matriks"] = 4;
            }
            // end matriks

            //kondisi
            if ($data_rekomendasi_promo['c1_harga'] <= 10000) {
                $data_rekomendasi_promo["c1_pesan"] = '- Harga Dikategorikan Rendah';
            } else if ($data_rekomendasi_promo['c1_harga'] <= 15000) {
                $data_rekomendasi_promo["c1_pesan"] = '- Harga Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c1_harga'] <= 18000) {
                $data_rekomendasi_promo["c1_pesan"] = '- Harga Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c1_pesan"] = '- Harga Dikategorikan Sangat Tinggi';
            }

            if ($data_rekomendasi_promo['c2_penjualan'] <= 50) {
                $data_rekomendasi_promo["c2_pesan"] = '- Penjualan Dikategorikan Rendah';
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 75) {
                $data_rekomendasi_promo["c2_pesan"] = '-Penjualan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 100) {
                $data_rekomendasi_promo["c2_pesan"] = '- Penjualan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c2_pesan"] = '- Penjualan Dikategorikan Sangat Tinggi';
            }

            if ($data_rekomendasi_promo['c3_daya_tahan'] <= 3) {
                $data_rekomendasi_promo["c3_pesan"] = '- Daya Tahan Dikategorikan Singkat';
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 7) {
                $data_rekomendasi_promo["c3_pesan"] = '- Daya Tahan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 10) {
                $data_rekomendasi_promo["c3_pesan"] = '- Daya Tahan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c3_pesan"] = '- Daya Tahan Dikategorikan Sangat Tinggi';
            }

            if ($data_rekomendasi_promo['c4_persediaan'] <= 30) {
                $data_rekomendasi_promo["c4_pesan"] = '- Persediaan Dikategorikan Rendah';
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 40) {
                $data_rekomendasi_promo["c4_pesan"] = '- Persediaan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 50) {
                $data_rekomendasi_promo["c4_pesan"] = '- Persediaan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c4_pesan"] = '- Persediaan Dikategorikan Sangat Tinggi';
            }
            //kondisi

            //promo
            //kondisi
            if ($data_rekomendasi_promo['c4_persediaan'] >= 50 && $data_rekomendasi_promo['c2_penjualan'] <= 75 or $data_rekomendasi_promo['c3_daya_tahan'] <= 7 && $data_rekomendasi_promo['c1_harga'] >= 18000) {
                $data_rekomendasi_promo["c1_promo"] = 'Bundling';
            } else if ($data_rekomendasi_promo['c1_harga'] <= 18000 && $data_rekomendasi_promo['c4_persediaan'] >= 40 && $data_rekomendasi_promo['c2_penjualan'] >=75) {
                $data_rekomendasi_promo["c1_promo"] = 'Cashback';
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 75 && $data_rekomendasi_promo['c4_persediaan'] <= 50 && $data_rekomendasi_promo['c3_daya_tahan'] <= 7) {
                $data_rekomendasi_promo["c1_promo"] = 'Diskon Harga';
            } else { 
                $data_rekomendasi_promo["c1_promo"] = 'Royalti';
            }

            if ($data_rekomendasi_promo['c2_penjualan'] <= 50) {
                $data_rekomendasi_promo["c2_promo"] = '- Penjualan Dikategorikan Rendah';
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 75) {
                $data_rekomendasi_promo["c2_promo"] = '-Penjualan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c2_penjualan'] <= 100) {
                $data_rekomendasi_promo["c2_promo"] = '- Penjualan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c2_promo"] = '- Penjualan Dikategorikan Sangat Tinggi';
            }

            if ($data_rekomendasi_promo['c3_daya_tahan'] <= 3) {
                $data_rekomendasi_promo["c3_promo"] = '- Daya Tahan Dikategorikan Singkat';
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 7) {
                $data_rekomendasi_promo["c3_promo"] = '- Daya Tahan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c3_daya_tahan'] <= 10) {
                $data_rekomendasi_promo["c3_promo"] = '- Daya Tahan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c3_promo"] = '- Daya Tahan Dikategorikan Sangat Tinggi';
            }

            if ($data_rekomendasi_promo['c4_persediaan'] <= 30) {
                $data_rekomendasi_promo["c4_promo"] = '- Persediaan Dikategorikan Rendah';
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 40) {
                $data_rekomendasi_promo["c4_promo"] = '- Persediaan Dikategorikan Sedang';
            } else if ($data_rekomendasi_promo['c4_persediaan'] <= 50) {
                $data_rekomendasi_promo["c4_promo"] = '- Persediaan Dikategorikan Tinggi';
            } else {
                $data_rekomendasi_promo["c4_promo"] = '- Persediaan Dikategorikan Sangat Tinggi';
            }
            //kondisi
            //end

            // normalisasi
            $data_rekomendasi_promo['c1_matriks'] /= 4;
            $data_rekomendasi_promo['c2_matriks'] /= 4;
            $data_rekomendasi_promo['c3_matriks'] = 1 / $data_rekomendasi_promo['c3_matriks'];
            $data_rekomendasi_promo['c4_matriks'] /= 4;
            // end normalisasi

            // ranking
            $data_rekomendasi_promo['c1_matriks'] *= 30;
            $data_rekomendasi_promo['c2_matriks'] *= 20;
            $data_rekomendasi_promo['c3_matriks'] *= 20;
            $data_rekomendasi_promo['c4_matriks'] *= 30;
            $data_rekomendasi_promo['total'] = $data_rekomendasi_promo['c1_matriks'] +  $data_rekomendasi_promo['c2_matriks'] +  $data_rekomendasi_promo['c3_matriks'] +  $data_rekomendasi_promo['c4_matriks'];
            // end ranking

            //kodisi
            $data_rekomendasi_promo['kondisi_harga'] = $data_rekomendasi_promo['c1_pesan'];
            $data_rekomendasi_promo['kondisi_penjualan'] = $data_rekomendasi_promo['c2_pesan'];
            $data_rekomendasi_promo['kondisi_dayatahan'] = $data_rekomendasi_promo['c3_pesan'];
            $data_rekomendasi_promo['kondisi_persediaan'] = $data_rekomendasi_promo['c4_pesan'];

            $data_rekomendasi_promo['promo_harga'] = $data_rekomendasi_promo['c1_promo'];
            $data_rekomendasi_promo['promo_penjualan'] = $data_rekomendasi_promo['c2_promo'];
            $data_rekomendasi_promo['promo_dayatahan'] = $data_rekomendasi_promo['c3_promo'];
            $data_rekomendasi_promo['promo_persediaan'] = $data_rekomendasi_promo['c4_promo'];
            //end

            array_push($arr, (object)$data_rekomendasi_promo);
        }
        
        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('total')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->total) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->total;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('kondisi_harga')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->kondisi_harga) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->kondisi_harga;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('kondisi_penjualan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->kondisi_penjualan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->kondisi_penjualan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('kondisi_dayatahan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->kondisi_dayatahan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->kondisi_dayatahan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('kondisi_persediaan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->kondisi_persediaan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->kondisi_persediaan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('promo_harga')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->promo_harga) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->promo_harga;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('promo_penjualan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->promo_penjualan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->promo_penjualan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('promo_dayatahan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->promo_dayatahan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->promo_dayatahan;
        }

        $prev = null;
        $rank = 1;
        $arr = collect($arr)->sortBy('promo_persediaan')->reverse()->take(3);
        foreach ($arr as $val) {
            if ($prev && $prev != $val->promo_persediaan) {
                $rank++;
            }

            $val->rank = $rank;
            $prev = $val->promo_persediaan;
        }
        return $arr;
    }

    public function data()
    {
        $promo = Promo::orderBy('id', 'asc')->get();
        $produk = Produk::all();

        return datatables()
            ->of($promo)
            ->addIndexColumn()
            ->addColumn('harga', function ($produk) {
                return $this->convert_to_rupiah($produk->harga);
            })
            ->addColumn('nama_produk1', function ($promo) {
                return (\App\Models\Produk::find($promo['id_produk1'])->nama_produk);
            })
            ->addColumn('nama_produk2', function ($promo) {
                return (\App\Models\Produk::find($promo['id_produk2'])->nama_produk);
            })
            ->addColumn('diskon', function ($produk) {
                return $produk->diskon . '%';
            })
            ->addColumn('waktu', function ($promo) {
                return tanggal_indonesia($promo->created_at, false);
            })
            ->addColumn('select_all', function ($promo) {
                return '
                    <input type="checkbox" name="id[]" value="' . $promo->id . '">
                ';
            })
            ->addColumn('aksi', function ($promo) {
                return '
                <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a onclick="editForm(`' . route('promo.update', $promo->id) . '`)" class="dropdown-item" ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a onclick="deleteData(`' . route('promo.destroy', $promo->id) . '`)" class="dropdown-item" ><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //        dd($request->all());
        $harga = intval(preg_replace('/[^0-9]/', '', $request->harga));
        $promo = new Promo();
        // $kategori = Kategori::create($request->all());
        $promo->nama_promo = $request->nama_promo;
        $promo->id_produk1 = $request->id_produk1;
        $promo->id_produk2 = $request->id_produk2;
        $promo->status = $request->status;
        $promo->diskon = $request->diskon;
        $promo->harga = $harga;
        $promo->save();

        return redirect('/promo')->withToastSuccess('Promo Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = Promo::find($id);

        return response()->json($promo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);
        if ($promo->harga != $request->harga) {
            $harga = intval(preg_replace('/[^0-9]/', '', $request->harga));
            //            echo $request->harga;
            //            dd($request->all());
            $promo->nama_promo = $request->nama_promo;
            $promo->id_produk1 = $request->id_produk1;
            $promo->id_produk2 = $request->id_produk2;
            $promo->status = $request->status;
            $promo->diskon = $request->diskon;
            $promo->harga = $harga;
            $promo->update();
        } else {
            $promo->update($request->all());
        }
        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::find($id);
        $promo->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id as $id) {
            $promo = Produk::find($id);
            $promo->delete();
        }

        return response(null, 204);
    }

    function convert_to_rupiah($angka)
    {
        return 'Rp. ' . strrev(implode('.', str_split(strrev(strval($angka)), 3)));
    }

    public function recomendation($id)
    {
        $promo = Promo::where('id_produk1', '=', $id)
            ->orWhere(function ($query) use ($id) {
                $query->where('id_produk1', '!=', $id)
                    ->where('id_produk2', '=', $id);
            })
            ->get();

        $promos = [];

        foreach ($promo as $row) {

            $id = $row->id;
            $id_produk1 = $row->id_produk1;
            $id_produk2 = $row->id_produk2;
            $produk1 = $row->produk1->nama_produk;
            $kode_produk1 = $row->produk1->kode_produk;
            $produk2 = $row->produk2->nama_produk;
            $kode_produk2 = $row->produk2->kode_produk;
            $nama_promo = $row->nama_promo;
            $diskon = $row->diskon;
            $harga = $row->harga;

            $promoTemp = [
                'id' => $id,
                'id_produk1' => $id_produk1,
                'id_produk2' => $id_produk2,
                'kode_produk1' => $kode_produk1,
                'kode_produk2' => $kode_produk2,
                'produk1' => $produk1,
                'produk2' => $produk2,
                'nama_promo' => $nama_promo,
                'diskon' => $diskon,
                'harga' => $harga,
            ];
            array_push($promos, $promoTemp);
        }

        return json_encode($promos);
    }
}

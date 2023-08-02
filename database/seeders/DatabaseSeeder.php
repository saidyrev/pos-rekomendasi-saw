<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingTableSeeder::class,
            UserTableSeeder::class,
        ]);

        DB::table('kategori')->insert([[
                'id_kategori' => '1',
                'nama_kategori' => 'Espresso Based'
            ],
            [
                'id_kategori' => '2',
                'nama_kategori' => 'Manual Brew'
            ],
            [
                'id_kategori' => '3',
                'nama_kategori' => 'Fresh Signature'
            ],
            [
                'id_kategori' => '4',
                'nama_kategori' => 'Best Signature'
            ],
            [
                'id_kategori' => '5',
                'nama_kategori' => 'Makanan'
            ]]);

        DB::table('produk')->insert([[
                'id_produk' => '1',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000001',
                'nama_produk' => 'Espresso',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '10000',
                'daya_tahan' => '25',
                'stok' => '100'

            ],
            [
                'id_produk' => '2',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000002',
                'nama_produk' => 'Americanno',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '25',
                'stok' => '100'

            ],
            [
                'id_produk' => '3',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000003',
                'nama_produk' => 'Long Black',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '25',
                'stok' => '100'

            ],
            [
                'id_produk' => '4',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000004',
                'nama_produk' => 'Caffe Latte',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '25',
                'stok' => '100'

            ],
            [
                'id_produk' => '5',
                'id_kategori' => '4',
                'kode_produk' => 'P-CRP-000005',
                'nama_produk' => 'Cerita',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '23',
                'stok' => '100'

            ],
            [
                'id_produk' => '6',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000006',
                'nama_produk' => 'Cappucinno',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '29',
                'stok' => '100'

            ],
            [
                'id_produk' => '7',
                'id_kategori' => '1',
                'kode_produk' => 'P-CRP-000008',
                'nama_produk' => 'Mochacino',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '30',
                'stok' => '100'

            ],
            [
                'id_produk' => '8',
                'id_kategori' => '2',
                'kode_produk' => 'P-CRP-000009',
                'nama_produk' => 'Lungo',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '31',
                'stok' => '100'

            ],
            [
                'id_produk' => '9',
                'id_kategori' => '2',
                'kode_produk' => 'P-CRP-000010',
                'nama_produk' => 'V60',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '32',
                'stok' => '100'

            ],
            [
                'id_produk' => '10',
                'id_kategori' => '2',
                'kode_produk' => 'P-CRP-000011',
                'nama_produk' => 'Vietnam Drip',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '33',
                'stok' => '100'

            ],
            [
                'id_produk' => '11',
                'id_kategori' => '2',
                'kode_produk' => 'P-CRP-000012',
                'nama_produk' => 'Aeropress',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '15000',
                'daya_tahan' => '34',
                'stok' => '100'

            ],
            [
                'id_produk' => '12',
                'id_kategori' => '2',
                'kode_produk' => 'P-CRP-000013',
                'nama_produk' => 'Tubruk',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '10000',
                'daya_tahan' => '35',
                'stok' => '100'

            ],
            [
                'id_produk' => '13',
                'id_kategori' => '4',
                'kode_produk' => 'P-CRP-000014',
                'nama_produk' => 'Red Eye',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '20000',
                'daya_tahan' => '36',
                'stok' => '100'

            ],
            [
                'id_produk' => '14',
                'id_kategori' => '4',
                'kode_produk' => 'P-CRP-000015',
                'nama_produk' => 'Black Eye',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '20000',
                'daya_tahan' => '37',
                'stok' => '100'

            ],
            [
                'id_produk' => '15',
                'id_kategori' => '3',
                'kode_produk' => 'P-CRP-000016',
                'nama_produk' => 'Karna',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '20000',
                'daya_tahan' => '38',
                'stok' => '100'

            ],
            [
                'id_produk' => '16',
                'id_kategori' => '3',
                'kode_produk' => 'P-CRP-000017',
                'nama_produk' => 'Kamu',
                'harga_modal' => '5000',
                'diskon' => '0',
                'harga_jual' => '20000',
                'daya_tahan' => '39',
                'stok' => '100'

            ]]);
    }
}

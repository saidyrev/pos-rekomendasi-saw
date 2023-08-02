@extends('layouts.master')

@section('tittle')
    Rekomendasi
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                  <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true"><i class="tf-icons bx bx-purchase-tag"></i> Promo </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false"><i class="tf-icons bx bx-bar-chart-alt"></i> Perhitungan</button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false"><i class="tf-icons bx bx-message-square"></i> Rekomendasi</button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-tittle">
                                    <div class="head-label text-center">
                                        <h5 class="card-title mb-0">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Tabel Data Promo</font>
                                            </font>
                                        </h5>
                                    </div>
        
                                    <button onclick="addForm()" type="button" class="btn rounded-pill btn-primary">
                                        <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Promo Baru
                                    </button>
                                    {{--                            '{{ route('produk.delete_selected') }}' --}}
                                    {{-- <button onclick="deleteSelected()" type="button" class="btn rounded-pill btn-danger">
                                        <span class="tf-icons bx bx-trash"></span>&nbsp; Hapus
                                    </button> --}}
                                </div>
                                <div class="table-responsive pt-3">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <th witdh="1%">No</th>
                                            <th>Promo</th>
                                            <th>Nama Produk 1</th>
                                            <th>Nama Produk 2</th>
                                            <th>Diskon</th>
                                            <th>Status</th>
                                            <th>Harga</th>
                                            <th>Waktu</th>
                                            <th witdh="5%">Aksi</th>
                                        </thead>
                                        <tbody>
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-tittle">
                                                <div class="head-label text-center">
                                                    <h5 class="card-title mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">Hasil Ranking Perhitungan SAW</font>
                                                        </font>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive pt-3">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th width="8%">Ranking</th>
                                                        <th>Kode Produk</th>
                                                        <th>Nama Produk</th>
                                                        <th>Total Perhitungan </th>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data as $val)
                                                            <tr>
                                                                <td>{{ $val->rank }}</td>
                                                                <td><span class="badge bg-label-primary">{{ $val->kode_produk }}</span></td>
                                                                <td>{{ $val->nama_produk }}</td>
                                                                <td>{{ $val->total }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-tittle">
                                                <div class="head-label text-center">
                                                    <h5 class="card-title mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">C1 Harga</font>
                                                        </font>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive pt-3">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th width="8%">Ranking</th>
                                                        {{-- <th>Kategori Produk</th> --}}
                                                        <th>Nama Produk</th>
                                                        <th>Nilai Tertinggi </th>
                                                        <th>Deskripsi</th>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data_harga as $val)
                                                            <tr>
                                                                <td>{{ $val->rank }}</td>
                                                                <td>{{ $val->nama_produk }}</td>
                                                                <td>{{ $val->total_harga }}</td>
                                                                <td><span class="badge bg-label-primary">{{ $val->grade_harga }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-tittle">
                                                <div class="head-label text-center">
                                                    <h5 class="card-title mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">C2 Penjualan</font>
                                                        </font>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive pt-3">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th width="8%">Ranking</th>
                                                        {{-- <th>Kategori Produk</th> --}}
                                                        <th>Nama Produk</th>
                                                        <th>Nilai Tertinggi </th>
                                                        <th>Deskripsi</th>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data_penjualan as $val)
                                                            <tr>
                                                                <td>{{ $val->rank }}</td>
                                                                <td>{{ $val->nama_produk }}</td>
                                                                <td>{{ $val->total_penjualan }}</td>
                                                                <td><span class="badge bg-label-primary">{{ $val->grade_penjualan }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-tittle">
                                                <div class="head-label text-center">
                                                    <h5 class="card-title mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">C3 Daya Tahan</font>
                                                        </font>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive pt-3">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th width="8%">Ranking</th>
                                                        {{-- <th>Kategori Produk</th> --}}
                                                        <th>Nama Produk</th>
                                                        <th>Nilai Tertinggi </th>
                                                        <th>Deskripsi</th>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data_daya_tahan as $val)
                                                            <tr>
                                                                <td>{{ $val->rank }}</td>
                                                                <td>{{ $val->nama_produk }}</td>
                                                                <td>{{ $val->total_daya_tahan }}</td>
                                                                <td><span class="badge bg-label-primary">{{ $val->grade_daya_tahan }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-tittle">
                                                <div class="head-label text-center">
                                                    <h5 class="card-title mb-0">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">C4 Persediaan</font>
                                                        </font>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive pt-3">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th width="8%">Ranking</th>
                                                        {{-- <th>Kategori Produk</th> --}}
                                                        <th>Nama Produk</th>
                                                        <th>Nilai Tertinggi </th>
                                                        <th>Deskripsi</th>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data_persediaan as $val)
                                                            <tr>
                                                                <td>{{ $val->rank }}</td>
                                                                <td>{{ $val->nama_produk }}</td>
                                                                <td>{{ $val->total_persediaan }}</td>
                                                                <td><span class="badge bg-label-primary">{{ $val->grade_persediaan }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                      <p>
                        Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                        bears
                        cake chocolate.
                      </p>
                      <p class="mb-0">
                        Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                        sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                        jelly.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection
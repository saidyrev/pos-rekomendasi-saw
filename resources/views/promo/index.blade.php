@extends('layouts.master')

@section('tittle')
    Promo
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
                                                    @foreach ($data as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->kode_produk }}</span></td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->total }}</td>
                                                        </tr>
                                                    @endforeach
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
                                                    @foreach ($data_harga as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->total_harga }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->grade_harga }}</td>
                                                        </tr>
                                                    @endforeach
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
                                                    @foreach ($data_penjualan as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->total_penjualan }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->grade_penjualan }}</td>
                                                        </tr>
                                                    @endforeach
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
                                                    @foreach ($data_daya_tahan as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->total_daya_tahan }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->grade_daya_tahan }}</td>
                                                        </tr>
                                                    @endforeach
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
                                                    @foreach ($data_persediaan as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->total_persediaan }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->grade_persediaan }}</td>
                                                        </tr>
                                                    @endforeach
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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-tittle">
                                            <div class="head-label text-center">
                                                <h5 class="card-title mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Rekomendasi Produk Untuk Di Promo</font>
                                                    </font>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive pt-3">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th width="8%">No</th>
                                                    <th>Kode Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th width="50%">Alasan</th>
                                                    <th>Rekomendasi Promo</th>
                                                    <th width="30%">Aksi</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data_rekomendasi_promo as $val)
                                                        <tr>
                                                            <td>{{ $val->rank }}</td>
                                                            <td><span class="badge bg-label-primary">{{ $val->kode_produk }}</span></td>
                                                            <td>{{ $val->nama_produk }}</td>
                                                            <td>{{ $val->kondisi_harga }} <br> {{ $val->kondisi_penjualan }} <br> {{ $val->kondisi_dayatahan }} <br> {{ $val->kondisi_persediaan }} </td>
                                                            <td><span class="badge bg-label-success">{{ $val->promo_harga }}<span></td>
                                                            <td><button
                                                                type="button"
                                                                class="btn btn-primary text-nowrap"
                                                                data-bs-toggle="popover"
                                                                data-bs-offset="0,14"
                                                                data-bs-placement="right"
                                                                data-bs-html="true"
                                                                data-bs-content=" {{ $val->kondisi_harga }} <br> {{ $val->kondisi_penjualan }} <br> {{ $val->kondisi_dayatahan }} <br> {{ $val->kondisi_persediaan }}"
                                                                title="{{ $val->promo_harga }}"
                                                              >
                                                                ?
                                                              </button></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-lg-5 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-tittle">
                                            <div class="head-label text-center">
                                                <h5 class="card-title mb-0">
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive pt-3">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Produk</th>
                                                    <th>Rekomendasi Promo</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data_promo_pilihan as $val)
                                                        <tr>
                                                            <td>1</td>
                                                            <td>1</td>
                                                            <td>{{ $val -> hasil }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div> 
@includeIf('promo.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('#table').DataTable({
                responsive: false,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('promo.data') }}',
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_promo'
                    },
                    {
                        data: 'nama_produk1'
                    },
                    {
                        data: 'nama_produk2'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'waktu'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize(),
                        })
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            //   Swal.fire({
                            //         position: 'center',
                            //         icon: 'success',
                            //         title: 'Kategori Berhasil Disimpan',
                            //         showConfirmButton: false,
                            //         timer: 1500
                            //     });
                        })
                        .fail((errors) => {
                            alert('Tidak Dapat Menyimpan Data')
                        })
                }
            })

        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Promo');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_kategori]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Promo');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_promo]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_promo]').val(response.nama_promo);
                    $('#modal-form [name=id_produk1]').val(response.id_produk1);
                    $('#modal-form [name=id_produk2]').val(response.id_produk2);
                    var id1 = $('#id_produk1').find(":selected").val();
                    $.ajax({
                        url: '{{ route('produk.amount','') }}' + '/' + id1,
                        success: function (data) {
                            $('#harga_produk1').val(convertToRupiah(data));
                        }
                    });
                    var id2 = $('#id_produk2').find(":selected").val();
                    $.ajax({
                        url: '{{ route('produk.amount','') }}' + '/' + id2,
                        success: function (data) {
                            $('#harga_produk2').val(convertToRupiah(data));
                        }
                    });
                    $("#diskon").prop('disabled', false);
                    $('#modal-form [name=status]').val(response.status);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=harga]').val(response.harga);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                        //     Swal.fire({
                        //     position: 'center',
                        //     icon: 'success',
                        //     title: 'Kategori Berhasil Dihapus',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                    })
                    .fail((response) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function convertToRupiah(angka)
        {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

        function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        }

        $(document.body)
            .on('change', "#id_produk1", function (e) {
                var id = $('#id_produk1').find(":selected").val();
                $.ajax({
                    url: '{{ route('produk.amount','') }}' + '/' + id,
                    success: function (data) {
                        $('#harga_produk1').val(convertToRupiah(data));
                        var diskon = $('#diskon').find(":selected").val();
                        var harga_produk1 = $('#harga_produk1').val();
                        var harga_produk2 = $('#harga_produk2').val();
                        var hargaNonPromo = (convertToAngka(harga_produk1) + convertToAngka(harga_produk2));
                        var promo = (hargaNonPromo * (diskon/100));
                        var harga = (hargaNonPromo - promo);
                        if (data != null && convertToAngka(harga_produk2) > 0) {
                            $("#diskon").prop('disabled', false);
                        } else {
                            $("#diskon").prop('disabled', true);
                        }
                        if (convertToAngka(harga_produk2) > 0 && diskon > 0) {
                            $('#harga').val(convertToRupiah(harga));
                        }else{
                            $('#harga').val(0);
                        }
                    }
                });
            })
            .on('change', "#id_produk2", function (e) {
                var id = $('#id_produk2').find(":selected").val();
                $.ajax({
                    url: '{{ route('produk.amount','') }}' + '/' + id,
                    success: function (data) {
                        $('#harga_produk2').val(convertToRupiah(data));
                        if (data != null) {
                            $("#diskon").prop('disabled', false);
                        } else {
                            $("#diskon").prop('disabled', true);
                        }
                        var diskon = $('#diskon').find(":selected").val();
                        var harga_produk1 = $('#harga_produk1').val();
                        var harga_produk2 = $('#harga_produk2').val();
                        var hargaNonPromo = (convertToAngka(harga_produk1) + convertToAngka(harga_produk2));
                        var promo = (hargaNonPromo * (diskon/100));
                        var harga = (hargaNonPromo - promo);
                        if (convertToAngka(harga_produk1) > 0 && diskon > 0) {
                            $('#harga').val(convertToRupiah(harga));
                        }else{
                            $('#harga').val(0);
                        }
                    }
                });
            })
            .on('change', "#diskon", function (e) {
                var diskon = $('#diskon').find(":selected").val();
                var harga_produk1 = $('#harga_produk1').val();
                var harga_produk2 = $('#harga_produk2').val();
                var hargaNonPromo = (convertToAngka(harga_produk1) + convertToAngka(harga_produk2));
                var promo = (hargaNonPromo * (diskon/100));
                var harga = (hargaNonPromo - promo);
                $('#harga').val(convertToRupiah(harga));
            })
    </script>
@endpush

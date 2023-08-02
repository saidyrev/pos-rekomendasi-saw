@extends('layouts.master')

@section('tittle')
    Produk
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <div class="card-tittle">
                            <div class="head-label text-center"><h5 class="card-title mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tabel Data Produk</font></font></h5></div>

                            <button onclick="addForm('{{ route('produk.store') }}')" type="button" class="btn rounded-pill btn-primary">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Produk Baru
                            </button>
                            <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')" type="button" class="btn rounded-pill btn-danger">
                                <span class="tf-icons bx bx-trash"></span>&nbsp; Hapus
                            </button>
                        </div>
                        <div class="pt-3">
                            <form action="" method="post" class="form-produk">
                              @csrf

                              <table class="table table-striped">
                                <thead>
                                  <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                  </th>
                                    <th witdh="1%">No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th>Daya Tahan</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th witdh="5%">Aksi</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
    </div>
</div>
    @includeIf('produk.form')
@endsection

@push('scripts')
    <script>
         let table;

    $(function () {
        table = $('.table').DataTable({
        responsive: false,
        processing: true,
        serverSide: true,
        autoWidth: false,
      ajax: {
        url: '{{ route ('produk.data') }}',
      },
      columns: [
        {data: 'select_all', searchable: false, sortable: false},
        {data: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'kode_produk'},
        {data: 'nama_produk'},
        {data: 'nama_kategori'},
        {data: 'harga_modal'},
        {data: 'harga_jual'},
        {data: 'daya_tahan'},
        {data: 'diskon'},
        {data: 'stok'},
        {data: 'aksi', searchable: false, sortable: false},
      ]
    });

     $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Produk Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        $('[name=select_all]').on('click', function (){
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Tambah Produk');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('post');
      $('#modal-form [name=nama_produk]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Produk');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk').focus();

        $.get(url)
            .done((response) => {
              $('#modal-form [name=nama_produk]').val(response.nama_produk);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=harga_modal]').val(response.harga_modal);
                $('#modal-form [name=harga_jual]').val(response.harga_jual);
                $('#modal-form [name=daya_tahan]').val(response.daya_tahan);
                $('#modal-form [name=stok]').val(response.stok);
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
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Kategori Berhasil Dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, $('.form-produk').serialize())
                    .done((response) => {
                        table.ajax.reload();
                        Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Kategori Berhasil Dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }
    </script>
@endpush

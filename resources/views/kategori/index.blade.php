@extends('layouts.master')

@section('tittle')
    Kategori
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-tittle">
                            <div class="head-label text-center"><h5 class="card-title mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tabel Data Kategori</font></font></h5></div>

                            <button onclick="addForm()" type="button" class="btn rounded-pill btn-primary">
                                <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Kategori Baru
                            </button>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-striped">
                                <thead>
                                    <th width="8%">No</th>
                                    <th>Kategori</th>
                                    <th width="15%">Aksi</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          </div>
    </div>
</div>

    @includeIf('kategori.form')
@endsection

@push('scripts')
  <script>
    let table;

    $(function () {
        table = $('.table').DataTable({
          processing: true,
          autoWidth: false,
          ajax: {
            url: '{{ route ('kategori.data') }}',
          },
          columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_kategori'},
            {data: 'aksi', searchable: false, sortable: false},
          ]
        });

        $('#modal-form').validator().on('submit', function (e) {
          if (! e.preventDefault()) {
            $.ajax({
              url : $('#modal-form form').attr('action'),
              type : 'post',
              data : $('#modal-form form').serialize(),
            })
            .done((response)=>{
              $('#modal-form').modal('hide');
              table.ajax.reload();
              Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Kategori Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .fail((errors)=>{
              alert('Tidak Dapat Menyimpan Data')
            })
          }
        })

    });

    function addForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Tambah Kategori');

      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action', url);
      $('#modal-form [name=_method]').val('post');
      $('#modal-form [name=nama_kategori]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Kategori');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_kategori]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
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
                .fail((response) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
  </script>
@endpush

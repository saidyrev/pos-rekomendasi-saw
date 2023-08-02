@extends('layouts.master')

@section('tittle')
    Pengaturan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('setting.update') }}" method="post" class="form-setting" data-toggle="validator" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="alert alert-info alert-dismissible" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                                </div>
                                <div class="form-group row">
                                    <label for="nama_kafe" class="col-lg-2 control-label">Nama Perusahaan</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="nama_kafe" class="form-control" id="nama_kafe" required autofocus>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="instagram" class="col-lg-2 control-label">Instagram</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="instagram" class="form-control" id="instagram" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-lg-2 control-label">Alamat</label>
                                    <div class="col-lg-6">
                                        <textarea name="alamat" class="form-control" id="alamat" rows="3" required></textarea>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="path_logo" class="col-lg-2 control-label">Logo Perusahaan</label>
                                    <div class="col-lg-4">
                                        <input type="file" name="path_logo" class="form-control" id="path_logo"
                                            onchange="preview('.tampil-logo', this.files[0])">
                                        <span class="help-block with-errors"></span>
                                        <br>
                                        <div class="tampil-logo"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipe_nota" class="col-lg-2 control-label">Tipe Nota</label>
                                    <div class="col-lg-2">
                                        <select name="tipe_nota" class="form-control" id="tipe_nota" required>
                                            <option value="1">Nota Kecil</option>
                                            <option value="2">Nota Besar</option>
                                        </select>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
          </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        showData();

        $('.form-setting').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function showData() {
        $.get('{{ route('setting.show') }}')
            .done(response => {
                $('[name=nama_kafe]').val(response.nama_kafe);
                $('[name=instagram]').val(response.instagram);
                $('[name=alamat]').val(response.alamat);
                $('[name=tipe_nota]').val(response.tipe_nota);
                $('title').text(response.nama_kafe + ' | Pengaturan');
                
                let words = response.nama_kafe.split(' ');
                let word  = '';
                words.forEach(w => {
                    word += w.charAt(0);
                });
                $('.logo-mini').text(word);
                $('.logo-lg').text(response.nama_kafe);

                $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                // $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                $('[rel=    ]').attr('href', `{{ url('/') }}/${response.path_logo}`);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>
@endpush
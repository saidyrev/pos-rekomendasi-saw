@extends('layouts.master')

@section('tittle')
    Edit Profil
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('user.update_profil') }}" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-md-offside-1 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" class="form-control" id="name" required autofocus value="{{ $profil->name }}">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-md-2 col-md-offside-1 control-label">Profil</label>
                                <div class="group-input-text">
                                    <input type="file" name="foto" class="form-control" id="foto"
                                        onchange="preview('.tampil-foto', this.files[0])">
                                    <span class="help-block with-errors"></span>
                                    <br>
                                    <div class="tampil-foto">
                                        <img src="{{ url($profil->foto ?? '/') }}" width="200">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="old_password" class="col-md-2 col-md-offside-1 control-label">Password Lama</label>
                                <div class="col-md-12">
                                    <input type="password" name="old_password" id="old_password" class="form-control" 
                                    minlength="6">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-md-offside-1 control-label">Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="password" id="password" class="form-control" 
                                    minlength="6">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-2 col-md-offside-1 control-label">Konfirmasi Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                                        data-match="#password">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#old_password').on('keyup', function () {
            if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
            else $('#password, #password_confirmation').attr('required', false);
        });

        $('.form-profil').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-profil').attr('action'),
                    type: $('.form-profil').attr('method'),
                    data: new FormData($('.form-profil')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    $('[name=name]').val(response.name);
                    $('.tampil-foto').html(`<img src="{{ url('/') }}${response.foto}" width="200">`);
                    $('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);

                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    if (errors.status == 422) {
                        alert(errors.responseJSON); 
                    } else {
                        alert('Tidak dapat menyimpan data');
                    }
                    return;
                });
            }
        });
    });
</script>
@endpush
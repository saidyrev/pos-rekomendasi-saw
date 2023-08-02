@extends('layouts.master')

@section('tittle')
    Dashboard
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body text-center">
                        <h1>Selamat Datang</h1>
                        <h2>Anda login sebagai KASIR</h2>
                        <br><br>
                        <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg">Transaksi Baru</a>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
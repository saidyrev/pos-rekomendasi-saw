@extends('layouts.master')

@section('tittle')
    Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d {{ tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-tittle">
                        <div class="head-label text-center"><h5 class="card-title mb-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tabel Data Kategori</font></font></h5></div>

                        <button onclick="updatePeriode()" type="button" class="btn rounded-pill btn-primary">
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Ubah Periode
                        </button>
                        <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn rounded-pill btn-dark"><i class="fa fa-file-excel-o"></i> Export PDF</a>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-striped">
                            <thead>
                                <th width="8%">No</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                {{-- <th>Modal</th> --}}
                                <th>Pendapatan</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      </div>
</div>
@includeIf('laporan.form')
@endsection

@push('scripts')
<script src="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'penjualan'},
                // {data: 'harga_modal'},
                {data: 'pendapatan'}
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function updatePeriode() {
        $('#modal-form').modal('show');
    }
</script>
@endpush

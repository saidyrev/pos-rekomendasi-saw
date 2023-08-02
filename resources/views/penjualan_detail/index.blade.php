@extends('layouts.master')

@section('tittle')
    Transaksi
@endsection

@push('css')
    <style>
        .tampil-bayar {
            font-size: 4em;
            text-align: center;
            height: 100px;
            color: #f0f0f0;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        .table-penjualan tbody tr:last-child {
            display: none;
        }

        @media (max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-produk">
                            @csrf
                            <div class="form-group row mt-4">
                                <label for="tipe_transaksi" class="col-lg-2">Tipe Transaksi</label>
                                <div class="col-lg-5">
                                    <select id="tipe_transaksi" name="tipe_transaksi"
                                        class="form-control tipe-transaksi @error('tipe_transaksi') is-invalid @enderror">
                                        <option selected hidden value="">-Pilih Tipe-</option>
                                        <option value="Promo">Promo</option>
                                        <option value="Non Promo">Non Promo</option>
                                    </select>
                                    @error('tipe_transaksi')
                                        <div class="invalid-feedback">
                                            {{ $messages = 'Tipe Transaksi Tidak Boleh Kosong' }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4 id_promo" hidden="true">
                                <label for="id_promo" class="col-lg-2">Jenis Promo</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_promo" id="nama_promo">
                                        <input type="text" class="form-control" name="id_promo" id="id_promo"
                                            hidden="true">
                                        <input type="text" class="form-control" name="id_produk1" id="id_produk1"
                                            hidden="true">
                                        <input type="text" class="form-control" name="id_produk2" id="id_produk2"
                                            hidden="true">
                                        <span class="input-group-btn">
                                            <button onclick="tampilPromo()"
                                                class="btn btn-icon btn-rounded-pill btn-primary" type="button"><i
                                                    class="tf-icons bx bx-right-arrow-circle"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4 mb-3 kode_produk" hidden="true">
                                <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="hidden" name="id_penjualan" id="id_penjualan"
                                            value="{{ $id_penjualan }}">
                                        <input type="hidden" name="id_produk" id="id_produk">
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                        <span class="input-group-btn">
                                            <button onclick="tampilProduk()"
                                                class="btn btn-icon btn-rounded-pill btn-primary" type="button"><i
                                                    class="tf-icons bx bx-right-arrow-circle"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-stiped table-bordered table-penjualan">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th width="15%">Jumlah</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="tampil-bayar bg-primary"></div>
                                <div class="tampil-terbilang"></div>
                                <div class="qris" hidden="true">
                                    <div class="mt-4 d-flex justify-content-center">
                                        <img src="{{ asset('qris/qrisTitle.png') }}">
                                    </div>
                                    <div class="form-group row mt-4 mb-2 d-flex justify-content-center">
                                        <img src="{{ asset('qris/qrisImage.png') }}" style="height: 45%; width: 45%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                    @csrf
                                    <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                    <input type="hidden" name="total" id="total">
                                    <input type="hidden" name="total_item" id="total_item">
                                    <input type="hidden" name="bayar" id="bayar">

                                    <div class="form-group row">
                                        <label for="totalrp" class="col-lg-3 control-label">Total</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="totalrp" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="diskon" class="col-lg-3 control-label">Diskon</label>
                                        <div class="col-lg-8">
                                            <input type="number" name="diskon" id="diskon" class="form-control"
                                                value="{{ !empty($memberSelected->id_member) ? $diskon : 0 }}" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="bayar" class="col-lg-3 control-label">Bayar</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="bayarrp" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <label for="tipe_bayar" class="col-lg-3 control-label">Tipe Bayar</label>
                                        <div class="col-lg-8">
                                            <select id="tipe_bayar" name="tipe_bayar"
                                                class="form-control @error('tipe_bayar') is-invalid @enderror">
                                                <option selected hidden value="">-Pilih Tipe-</option>
                                                <option value="Tunai">Tunai</option>
                                                <option value="Non Tunai">Non Tunai</option>
                                            </select>
                                            @error('tipe_bayar')
                                                <div class="invalid-feedback">
                                                    {{ $messages = 'Tipe Pembayaran Tidak Boleh Kosong' }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="diterima form-group row mt-4" hidden="true">
                                        <label for="diterima" class="col-lg-3 control-label">Diterima</label>
                                        <div class="col-lg-8">
                                            <input type="number" id="diterima" class="form-control" name="diterima"
                                                value="{{ $penjualan->diterima ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="kembali form-group row mt-4" hidden="true">
                                        <label for="kembali" class="col-lg-3 control-label">Kembali</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="kembali" name="kembali" class="form-control"
                                                value="0" readonly>
                                        </div>
                                    </div>
                                    <input name="tipe_promo" id="tipe_promo" hidden="true">
                                    <input name="total_promo" id="total_promo" hidden="true">
                                    <input name="id_promos" id="id_promos" hidden="true">
                                    <input name="id_prod1" id="id_prod1" hidden="true">
                                    <input name="id_prod2" id="id_prod2" hidden="true">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary pull-right btn-simpan">
                            Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    @includeIf('penjualan_detail.produk')
    @includeIf('penjualan_detail.promo')
    @includeIf('penjualan_detail.recomendation')
@endsection

@push('scripts')
    <script>
        let table, table2, table3;
        $(function() {
            $('body').addClass('sidebar-collapse');

            table = $('.table-penjualan').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('transaksi.data', $id_penjualan) }}',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'kode_produk'
                        },
                        {
                            data: 'nama_produk'
                        },
                        {
                            data: 'harga_jual'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'diskon'
                        },
                        {
                            data: 'subtotal'
                        },
                        {
                            data: 'aksi',
                            searchable: false,
                            sortable: false
                        },
                    ],
                    dom: 'Brt',
                    bSort: false,
                    paginate: false
                })
                .on('draw.dt', function() {
                    loadForm($('#diskon').val());
                    setTimeout(() => {
                        $('#diterima').trigger('input');
                    }, 300);
                });
            table2 = $('.table-produk').DataTable();

            table3 = $('.table-promo').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('/transaksi') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });
            $(document.body)
                .on('change', "#tipe_bayar", function(e) {
                    var tipe_bayar = $('#tipe_bayar').find(":selected").text();
                    if (tipe_bayar === 'Non Tunai') {
                        $(".qris").attr("hidden", false);
                        $(".diterima").attr("hidden", true);
                        $(".kembali").attr("hidden", true);
                    } else if (tipe_bayar === 'Tunai') {
                        $(".qris").attr("hidden", true);
                        $(".diterima").attr("hidden", false);
                        $(".kembali").attr("hidden", false);
                    }
                })
                .on('change', "#tipe_transaksi", function(e) {
                    var tipe_transaksi = $('#tipe_transaksi').find(":selected").text();
                    if (tipe_transaksi === 'Non Promo') {
                        $(".kode_produk").attr("hidden", false);
                        $(".id_promo").attr("hidden", true);
                    } else if (tipe_transaksi === 'Promo') {
                        $(".kode_produk").attr("hidden", true);
                        $(".id_promo").attr("hidden", false);
                    }
                })

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            });

            $('#diterima').on('input', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($('#diskon').val(), $(this).val());
            }).focus(function() {
                $(this).select();
            });

            $('.btn-simpan').on('click', function() {
                $('.form-penjualan').submit();
            });
        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function tampilPromo() {
            $('#modal-promo').modal('show');
        }

        function hidePromo() {
            $('#modal-promo').modal('hide');
        }


        function tampilRecomendation() {
            $('#modal-recomendation').modal('show');
        }

        function hideRecomendation() {
            $('#modal-recomendation').modal('hide');
        }

        function pilihProduk(id, kode) {
            var tipe_transaksi = $('#tipe_transaksi').find(":selected").text();
            $('#tipe_promo').val(tipe_transaksi);
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            $.get(`{{ url('/promo/recomendation') }}/${id}`)
                .done(response => {
                    try {
                        var recomendations = JSON.parse(response);
                        $('.table-recomendation tbody').empty();
                        if (recomendations.length > 0) {
                            recomendations.forEach(recomendation => {
                                console.log(recomendation)
                                var row = `<tr>
                          <td>${recomendation.id}</td>
                          <td>${recomendation.nama_promo}</td>
                          <td>${recomendation.produk1}</td>
                          <td>${recomendation.produk2}</td>
                          <td>Rp. ${recomendation.harga}</td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs btn-flat" onclick="pilihPromo('${recomendation.id}','${recomendation.nama_promo}','${recomendation.id_produk1}','${recomendation.id_produk2}','${recomendation.kode_produk1}','${recomendation.kode_produk2}','${recomendation.harga}')">
                              <i class="fa fa-check-circle"></i>
                              Pilih
                            </a>
                          </td>
                        </tr>`;
                                $('.table-recomendation tbody').append(row);
                            });
                            var noUseButton =
                                `<div class="d-grid gap-2"><button class="btn btn-block btn-info" onclick="tambahProduk()">Tidak Pakai Promo</button></div>`;
                            $('#not-use-promo').empty().append(noUseButton);
                            tampilRecomendation();
                        } else {
                            tambahProduk();
                            return;
                        }
                        console.log(recomendations);
                    } catch (error) {
                        console.log(error);
                    }
                })
                .fail(errors => {
                    console.log(errors);
                });
        }



        function pilihPromo(idPromo, namaPromo, id1, id2, kode1, kode2, harga) {
            var tipe_transaksi = $('#tipe_transaksi').find(":selected").text();
            $('#tipe_promo').val(tipe_transaksi);
            $('#total_promo').val(harga);
            $('#id_promos').val(idPromo);
            $('#id_promo').val(idPromo);
            $('#nama_promo').val(namaPromo);
            $('#id_produk1').val(id1);
            $('#id_produk2').val(id2);
            $('#id_prod1').val(id1);
            $('#id_prod2').val(id2);
            for (var i = 1; i <= 2; i++) {
                if (i === 1) {
                    $('#id_produk').val(id1);
                    $('#kode_produk').val(kode1);
                    $(".quantity").prop("disabled", true);
                    tambahProduk();
                } else if (i === 2) {
                    $('#id_produk').val(id2);
                    $('#kode_produk').val(kode2);
                    $(".quantity").prop("disabled", true);
                    tambahProduk();
                }
            }
            hidePromo();
        }

        function tambahProduk() {
            hideRecomendation();
            hideProduk();
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
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
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadForm(diskon = 0, diterima = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
                .done(response => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Bayar: Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);

                    $('#kembali').val('Rp.' + response.kembalirp);
                    if ($('#diterima').val() != 0) {
                        $('.tampil-bayar').text('Kembali: Rp. ' + response.kembalirp);
                        $('.tampil-terbilang').text(response.kembali_terbilang);
                    }
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
    </script>
@endpush

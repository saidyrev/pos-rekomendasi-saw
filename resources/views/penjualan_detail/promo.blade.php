<div class="modal fade" id="modal-promo" tabindex="-1" role="dialog" aria-labelledby="modal-promo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-promo">
                    <thead>
                    <th width="5%">No</th>
                    <th>Nama Promo</th>
                    <th>Produk 1</th>
                    <th>Produk 2</th>
                    <th>Harga</th>
                    <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($promo as $key => $item)
                        <tr>
                            <td width="5%">{{ $key+1 }}</td>
                            <td><span class="label label-success">{{ $item->nama_promo }}</span></td>
                            <td>{{ $item->produk1 }}</td>
                            <td>{{ $item->produk2 }}</td>
                            <td>Rp. {{ $item->harga }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs btn-flat"
                                   onclick="pilihPromo('{{ $item->id }}','{{ $item->nama_promo }}','{{ $item->id_produk1 }}', '{{ $item->id_produk2 }}', '{{ $item->kode_produk1 }}', '{{ $item->kode_produk2 }}', '{{ $item->harga }}')">
                                    <i class="fa fa-check-circle"></i>
                                    Pilih
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

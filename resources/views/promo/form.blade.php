<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12 mt-2">
                            <input type="text" name="nama_promo" id="nama_promo" class="form-control" placeholder="Nama Promo" required
                                autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="col-md-12 mt-4">
                                <select name="id_produk1" id="id_produk1" class="form-control" required>
                                    <option value="0">Produk 1</option>
                                    @foreach ($produk as $p => $item)
                                        <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 mt-4">
                                <input type="text" name="harga_produk1" id="harga_produk1" class="form-control" placeholder="Harga Awal Sebelum Promo" autofocus disabled>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="col-md-12 mt-4">
                                <select name="id_produk2" id="id_produk2" class="form-control" required>
                                    <option value="0">Produk 2</option>
                                    @foreach ($produk as $p => $item)
                                        <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 mt-4">
                                <input type="text" name="harga_produk2" id="harga_produk2" class="form-control" placeholder="Harga Awal Sebelum Promo" autofocus disabled>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mt-4">
                            <select name="status" id="status" class="form-control" required>
                                <option selected value="">Status</option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mt-4">
                            <select name="diskon" id="diskon" class="form-control" required disabled>
                                <option selected value="">Pilih Diskon (%)</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="40">40%</option>
                                <option value="50">50%</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mt-4">
                            <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga Promo" required readonly
                                   autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

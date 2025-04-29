<div class="modal fade" id="showFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="show_customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="show_customer" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="show_perusahaan" class="form-label">Perusahaan</label>
                        <input type="text" class="form-control" id="show_perusahaan" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="show_tanggal_faktur" class="form-label">Tanggal Faktur</label>
                        <input type="date" class="form-control" id="show_tanggal_faktur" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="show_total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="show_total" readonly>
                    </div>
                </div>

                <hr>
                <h5>Detail Faktur</h5>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailFakturItems">
                        <!-- Detail items will be added here by JavaScript -->
                    </tbody>
                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

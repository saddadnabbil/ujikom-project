<div class="modal fade" id="showFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="show_no_faktur">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Customer</label>
                        <input type="text" class="form-control" id="show_customer" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Perusahaan</label>
                        <input type="text" class="form-control" id="show_perusahaan" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Faktur</label>
                        <input type="date" class="form-control" id="show_tanggal_faktur" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="show_due_date" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Metode Bayar</label>
                        <input type="text" class="form-control" id="show_metode_bayar" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">PPN (%)</label>
                        <input type="number" class="form-control" id="show_ppn" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">DP (Rp)</label>
                        <input type="number" class="form-control" id="show_dp" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control" id="show_total" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Grand Total</label>
                        <input type="number" class="form-control" id="show_grand_total" readonly>
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
                        <!-- Will be filled by JS -->
                    </tbody>
                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

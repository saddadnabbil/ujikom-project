<div class="modal fade" id="editFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" id="edit-faktur-form">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Faktur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="no_faktur" id="edit_no_faktur">

                    <div class="row">
                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" id="edit_customer_id" class="form-select" required>
                                <option disabled selected>Pilih Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Perusahaan</label>
                            <select name="perusahaan_id" id="edit_perusahaan_id" class="form-select" required>
                                <option disabled selected>Pilih Perusahaan</option>
                                @foreach ($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Faktur -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Faktur</label>
                            <input type="date" name="tanggal_faktur" id="edit_tanggal_faktur" class="form-control"
                                required>
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="edit_due_date" class="form-control">
                        </div>

                        <!-- Metode Bayar -->
                        <div class="col-md-6 mb-3">
                            <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                            <select name="metode_bayar" id="edit_metode_bayar" class="form-select" required>
                                <option value="" disabled selected>Pilih Metode</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Tempo">Tempo</option>
                            </select>
                        </div>

                        <!-- PPN & DP -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">PPN (%)</label>
                            <input type="number" name="ppn" id="edit_ppn" class="form-control" step="0.01">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">DP (Rp)</label>
                            <input type="number" name="dp" id="edit_dp" class="form-control" step="0.01">
                        </div>

                        <!-- Total & Grand Total -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" id="edit_total" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Grand Total</label>
                            <input type="number" name="grand_total" id="edit_grand_total" class="form-control"
                                readonly>
                        </div>
                    </div>

                    <hr>
                    <h5>Detail Faktur</h5>

                    <div id="edit-detail-items">
                        <!-- Populated dynamically by JavaScript -->
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="edit-add-item-btn">
                            <i class="bi bi-plus-circle"></i> Tambah Item
                        </button>
                    </div>

                    <!-- Hidden template for cloning -->
                    <div id="edit-detail-template" class="d-none">
                        <div class="row detail-item mb-3">
                            <div class="col-md-4">
                                <label for="details[0][id_produk]" class="form-label">Produk</label>
                                <select class="form-select produk-select" name="details[0][id_produk]">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->price }}">
                                            {{ $produk->nama_produk }} - {{ $produk->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="details[0][qty]" class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah" name="details[0][qty]"
                                    min="1">
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][price]" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control harga-satuan" name="details[0][price]"
                                    min="0" step="0.01">
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][subtotal]" class="form-label">Subtotal</label>
                                <input type="number" class="form-control subtotal" name="details[0][subtotal]"
                                    min="0" step="0.01" readonly>
                            </div>
                            <!-- Remove Button at the end of the row -->
                            <div class="col-12 text-end">
                                <button type="button"
                                    class="btn btn-sm btn-danger remove-item-btn mt-2">Remove</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

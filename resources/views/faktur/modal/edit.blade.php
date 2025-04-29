<div class="modal fade" id="editFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-faktur-form" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Nomor Faktur (hidden) -->
                        <input type="hidden" name="no_faktur" id="edit_no_faktur">

                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_customer_id" class="form-label">Customer</label>
                            <select name="customer_id" id="edit_customer_id" class="form-select" required>
                                <option value="">Pilih Customer</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_perusahaan_id" class="form-label">Perusahaan</label>
                            <select name="perusahaan_id" id="edit_perusahaan_id" class="form-select" required>
                                <option value="">Pilih Perusahaan</option>
                                @foreach ($perusahaans as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Faktur & Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_faktur" class="form-label">Tanggal Faktur</label>
                            <input type="date" name="tanggal_faktur" id="edit_tanggal_faktur" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_due_date" class="form-label">Jatuh Tempo</label>
                            <input type="date" name="due_date" id="edit_due_date" class="form-control">
                        </div>

                        <!-- Metode Bayar -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_metode_bayar" class="form-label">Metode Pembayaran</label>
                            <select name="metode_bayar" id="edit_metode_bayar" class="form-select" required>
                                <option value="">Pilih Metode</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Tempo">Tempo</option>
                            </select>
                        </div>

                        <!-- DP & PPN -->
                        <div class="col-md-3 mb-3">
                            <label for="edit_ppn" class="form-label">PPN (%)</label>
                            <input type="number" class="form-control ppn" name="ppn" id="edit_ppn" step="0.1" min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_dp_display" class="form-label">DP (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_dp_display" placeholder="0" autocomplete="off">
                                <input type="hidden" name="dp" id="edit_dp" value="0">
                            </div>
                        </div>

                        <!-- Total & Grand Total -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_total_display" class="form-label">Total</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_total_display" readonly>
                                <input type="hidden" name="total" id="edit_total" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_grand_total_display" class="form-label">Grand Total</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_grand_total_display" readonly>
                                <input type="hidden" name="grand_total" id="edit_grand_total" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5>Detail Faktur</h5>

                    <div id="edit-detail-items">
                        <!-- Dynamic items will be added here -->
                    </div>

                    <div id="edit-detail-template" class="d-none">
                        <div class="row detail-item mb-3">
                            <div class="col-md-4">
                                <label for="details[0][id_produk]" class="form-label">Produk</label>
                                <select class="form-select produk-select" name="details[0][id_produk]">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                    <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->price }}">{{ $produk->nama_produk }} - {{ $produk->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="details[0][qty]" class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah" name="details[0][qty]" min="1">
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][price]" class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control harga-satuan-display" autocomplete="off">
                                    <input type="hidden" class="harga-satuan" name="details[0][price]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][subtotal]" class="form-label">Subtotal</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control subtotal-display" readonly>
                                    <input type="hidden" class="subtotal" name="details[0][subtotal]" readonly>
                                </div>
                            </div>
                            <!-- Remove Button at the end of the row -->
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-sm btn-danger remove-item-btn mt-2">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="edit-add-item-btn">
                            <i class="bi bi-plus-circle"></i> Tambah Item
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

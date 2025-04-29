<div class="modal fade" id="editFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Ensure the modal is wide like the create modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('faktur.update', ':id') }}" method="POST" id="edit-faktur-form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Nomor Faktur (readonly or hidden) -->
                        <input type="hidden" name="no_faktur" value="{{ old('no_faktur', $autoKode ?? '') }}">

                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_customer_id" class="form-label">Customer</label>
                            <select name="customer_id" id="edit_customer_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_perusahaan_id" class="form-label">Perusahaan</label>
                            <select name="perusahaan_id" id="edit_perusahaan_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Perusahaan</option>
                                @foreach ($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Faktur -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_faktur" class="form-label">Tanggal Faktur</label>
                            <input type="date" class="form-control" name="tanggal_faktur" id="edit_tanggal_faktur"
                                required>
                        </div>

                        <!-- DP & PPN -->
                        <div class="col-md-3 mb-3">
                            <label for="edit_ppn" class="form-label">PPN (%)</label>
                            <input type="number" class="form-control" name="ppn" id="edit_ppn" value="11"
                                step="0.1" min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="edit_dp" class="form-label">DP (Rp)</label>
                            <input type="number" class="form-control" name="dp" id="edit_dp" value="0"
                                min="0" step="0.01">
                        </div>

                        <!-- Total & Grand Total -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" id="edit_total" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_grand_total" class="form-label">Grand Total</label>
                            <input type="number" class="form-control" name="grand_total" id="edit_grand_total"
                                readonly>
                        </div>
                    </div>

                    <hr>
                    <h5>Detail Faktur</h5>

                    <div id="detail-item-template" class="row mb-3 d-none">
                        <div class="col-md-4">
                            <select class="form-select produk-select" name="details[][produk_id]" required>
                                <!-- Options will be filled by JavaScript -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control jumlah" name="details[][jumlah]" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control harga-satuan" name="details[][harga_satuan]"
                                required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control subtotal" name="details[][subtotal]" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="add-item-btn">
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

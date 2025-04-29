<div class="modal fade" id="addFakturModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl for more space -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('faktur.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Nomor Faktur (readonly atau hidden, tergantung implementasi generate otomatis) -->
                        <input type="hidden" name="no_faktur" value="{{ old('no_faktur', $autoKode ?? '') }}">
                
                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Customer</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Perusahaan -->
                        <div class="col-md-6 mb-3">
                            <label for="perusahaan_id" class="form-label">Perusahaan</label>
                            <select name="perusahaan_id" id="perusahaan_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Perusahaan</option>
                                @foreach ($perusahaans as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Tanggal Faktur & Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_faktur" class="form-label">Tanggal Faktur</label>
                            <input type="date" name="tanggal_faktur" id="tanggal_faktur" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Jatuh Tempo</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>
                
                        <!-- Metode Bayar -->
                        <div class="col-md-6 mb-3">
                            <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                            <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                <option value="" disabled selected>Pilih Metode</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Tempo">Tempo</option>
                            </select>
                        </div>
                
                        <!-- DP & PPN -->
                        <div class="col-md-3 mb-3">
                            <label for="ppn" class="form-label">PPN (%)</label>
                            <input type="number" class="form-control" name="ppn" id="ppn" value="11" step="0.1" min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dp" class="form-label">DP (Rp)</label>
                            <input type="number" class="form-control" name="dp" id="dp" value="0" min="0" step="0.01">
                        </div>
                
                        <!-- Total & Grand Total -->
                        <div class="col-md-6 mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" id="total" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="grand_total" class="form-label">Grand Total</label>
                            <input type="number" class="form-control" name="grand_total" id="grand_total" readonly>
                        </div>
                    </div>
                
                    <hr>
                    <h5>Detail Faktur</h5>
                    
                    <div id="detail-items">
                        <div class="row detail-item mb-3">
                            <div class="col-md-4">
                                <label for="details[0][produk_id]" class="form-label">Produk</label>
                                <select class="form-select produk-select" name="details[0][produk_id]" required>
                                    <option value="" selected disabled>Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="details[0][jumlah]" class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah" name="details[0][jumlah]" value="1" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][harga_satuan]" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control harga-satuan" name="details[0][harga_satuan]" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-3">
                                <label for="details[0][subtotal]" class="form-label">Subtotal</label>
                                <input type="number" class="form-control subtotal" name="details[0][subtotal]" min="0" step="0.01" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="add-item-btn">
                            <i class="bi bi-plus-circle"></i> Tambah Item
                        </button>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

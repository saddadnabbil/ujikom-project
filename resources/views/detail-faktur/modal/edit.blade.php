<div class="modal fade" id="editDetailFakturModal" tabindex="-1" aria-labelledby="editDetailFakturModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-detail-faktur-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailFakturModalLabel">Edit Detail Faktur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_produk_id" class="form-label">Produk</label>
                        <select name="produk_id" id="edit_produk_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="edit_harga_satuan" class="form-control" required min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="edit_subtotal" class="form-label">Subtotal</label>
                        <input type="number" name="subtotal" id="edit_subtotal" class="form-control" required min="0" step="0.01">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

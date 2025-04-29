<div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="product_name" placeholder="Masukkan nama produk..">
                        @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="product_price_display" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="product_price_display" placeholder="Masukkan harga produk.." autocomplete="off">
                            <input type="hidden" name="price" id="product_price_actual">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label for="product_jenis" class="form-label">Jenis</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis" id="product_jenis" placeholder="Masukkan jenis produk..">
                        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="product_stock" class="form-label">Stok</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="product_stock" placeholder="Masukkan stok produk..">
                        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
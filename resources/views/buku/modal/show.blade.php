<!-- Modal Show Detail Buku -->
<div class="modal fade" id="showProductModal" tabindex="-1" aria-labelledby="showProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Judul</label>
            <input type="text" class="form-control" id="show_buku_judul" readonly>
          </div>
          <div class="mb-3">
            <label>Pengarang</label>
            <input type="text" class="form-control" id="show_buku_pengarang" readonly>
          </div>
          <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" class="form-control" id="show_buku_penerbit" readonly>
          </div>
          <div class="mb-3">
            <label>Tahun</label>
            <input type="text" class="form-control" id="show_buku_tahun" readonly>
          </div>
          <div class="mb-3">
            <label>ISBN</label>
            <input type="text" class="form-control" id="show_buku_isbn" readonly>
          </div>
          <div class="mb-3">
            <label>Tanggal Input</label>
            <input type="text" class="form-control" id="show_buku_tgl_input" readonly>
          </div>
          <div class="mb-3">
            <label>Jumlah Halaman</label>
            <input type="text" class="form-control" id="show_buku_jml_halaman" readonly>
          </div>
          <div class="mb-3">
            <label>Kategori</label>
            <select class="form-control" id="edit_buku_kategori" name="id_kategori" readonly>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->kategori_buku }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  
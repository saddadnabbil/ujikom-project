<!-- Modal Edit Buku -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="edit-buku-form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Buku</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Judul</label>
              <input type="text" class="form-control" id="edit_buku_judul" name="judul">
            </div>
            <div class="mb-3">
              <label>Pengarang</label>
              <input type="text" class="form-control" id="edit_buku_pengarang" name="pengarang">
            </div>
            <div class="mb-3">
              <label>Penerbit</label>
              <input type="text" class="form-control" id="edit_buku_penerbit" name="penerbit">
            </div>
            <div class="mb-3">
              <label>Tahun</label>
              <input type="text" class="form-control" id="edit_buku_tahun" name="tahun">
            </div>
            <div class="mb-3">
              <label>ISBN</label>
              <input type="text" class="form-control" id="edit_buku_isbn" name="isbn">
            </div>
            <div class="mb-3">
              <label>Tanggal Input</label>
              <input type="date" class="form-control" id="edit_buku_tgl_input" name="tgl_input">
            </div>
            <div class="mb-3">
              <label>Jumlah Halaman</label>
              <input type="number" class="form-control" id="edit_buku_jml_halaman" name="jml_halaman">
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select class="form-control" id="edit_buku_kategori" name="id_kategori">
                  @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori_buku }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
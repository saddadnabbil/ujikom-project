<!-- Modal Edit Buku -->
<div class="modal fade" id="editDendaModal" tabindex="-1" aria-labelledby="editDendaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="edit-denda-form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Denda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Denda</label>
              <input type="text" class="form-control" id="edit_nominal" name="nominal" placeholder="Masukkan nominal..">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
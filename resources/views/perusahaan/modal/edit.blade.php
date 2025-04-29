<div class="modal fade" id="editPerusahaanModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="edit-perusahaan-form">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan" id="edit_nama_perusahaan" placeholder="Masukkan nama perusahaan..">
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="edit_alamat" rows="3" placeholder="Masukkan alamat perusahaan.."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

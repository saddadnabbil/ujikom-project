<!-- Modal Edit Buku -->
<div class="modal fade" id="editAnggotaModal" tabindex="-1" aria-labelledby="editAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit-anggota-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>ID Anggota</label>
                        <input type="text" class="form-control" id="edit_id_anggota" name="id_anggota"
                            placeholder="Masukkan ID Anggota..">
                    </div>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama"
                            placeholder="Masukkan nama..">
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" placeholder="Masukkan alamat.." rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" id="edit_jenis_kelamin" name="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>No. Telepon</label>
                        <input type="text" class="form-control" id="edit_no_telp" name="no_telp"
                            placeholder="Masukkan no. telepon..">
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tgl_lahir" name="tgl_lahir">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

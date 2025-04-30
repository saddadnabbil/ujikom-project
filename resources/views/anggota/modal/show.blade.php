<!-- Modal Show Detail Buku -->
<div class="modal fade" id="showAnggotaModal" tabindex="-1" aria-labelledby="showAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>ID Anggota</label>
                    <input type="text" class="form-control" id="show_id_anggota" readonly>
                </div>

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="show_nama" readonly>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea class="form-control" id="show_alamat" rows="2" readonly></textarea>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" id="edit_jenis_kelamin" name="jenis_kelamin" readonly>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>No. Telepon</label>
                    <input type="text" class="form-control" id="show_no_telp" readonly>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" id="show_tgl_lahir" readonly>
                </div>
            </div>

        </div>
    </div>
</div>

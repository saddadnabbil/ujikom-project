<!-- Modal Edit Buku -->
<div class="modal fade" id="editPeminjamanModal" tabindex="-1" aria-labelledby="editPeminjamanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit-peminjaman-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_id_pinjam" class="form-label">ID Pinjam</label>
                        <input type="text" class="form-control" id="edit_id_pinjam" name="id_pinjam"
                            placeholder="Masukkan ID Pinjam" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="edit_lama_pinjam" class="form-label">Lama Pinjam</label>
                        <input type="number" class="form-control" id="edit_lama_pinjam" name="lama_pinjam"
                            placeholder="Masukkan lama pinjam">
                    </div>

                    <div class="mb-3">
                        <label for="edit_nominal_denda" class="form-label">Nominal Denda</label>
                        <input type="text" class="form-control" id="edit_nominal_denda" name="nominal_denda"
                            placeholder="Masukkan nominal denda">
                    </div>

                    <div class="mb-3">
                        <label for="edit_id_anggota" class="form-label">Anggota</label>
                        <select name="id_anggota" id="edit_id_anggota" class="form-select">
                            @foreach ($anggotas as $anggota)
                                <option value="{{ $anggota->id }}">
                                    {{ $anggota->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_id_denda" class="form-label">Denda</label>
                        <select name="id_denda" id="edit_id_denda" class="form-select">
                            @foreach ($dendas as $denda)
                                <option value="{{ $denda->id }}" >
                                    {{ $denda->jenis_denda }}
                                </option>
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

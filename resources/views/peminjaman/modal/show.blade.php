<!-- Modal Show Detail Peminjaman -->
<div class="modal fade" id="showPeminjamanModal" tabindex="-1" aria-labelledby="showPeminjamanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label>ID Pinjam</label>
                    <input type="text" class="form-control" id="show_id_pinjam" readonly>
                </div>

                <div class="mb-3">
                    <label>Lama Pinjam</label>
                    <input type="text" class="form-control" id="show_lama_pinjam" readonly>
                </div>

                <div class="mb-3">
                    <label>Nominal Denda</label>
                    <input type="text" class="form-control" id="show_nominal_denda" readonly>
                </div>

                <div class="mb-3">
                    <label for="edit_id_anggota" class="form-label">Anggota</label>
                    <select name="id_anggota" id="edit_id_anggota" class="form-select" readonly>
                        
                        @foreach ($anggotas as $anggota)
                            <option value="{{ $anggota->id }}">
                                {{ $anggota->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="edit_id_denda" class="form-label">Denda</label>
                    <select name="id_denda" id="edit_id_denda" class="form-select" readonly>
                        @foreach ($dendas as $denda)
                            <option value="{{ $denda->id }}">
                                {{ $denda->jenis_denda }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

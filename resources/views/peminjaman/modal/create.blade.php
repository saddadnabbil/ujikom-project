<div class="modal fade" id="addPeminjamanModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_pinjam" class="form-label">ID Pinjam</label>
                        <input type="text" class="form-control @error('id_pinjam') is-invalid @enderror"
                            name="id_pinjam" id="id_pinjam" placeholder="Masukkan ID Pinjam">
                        @error('id_pinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lama_pinjam" class="form-label">Lama Pinjam (hari)</label>
                        <input type="number" class="form-control @error('lama_pinjam') is-invalid @enderror"
                            name="lama_pinjam" id="lama_pinjam" placeholder="Contoh: 7">
                        @error('lama_pinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nominal_denda" class="form-label">Nominal Denda</label>
                        <input type="text" class="form-control @error('nominal_denda') is-invalid @enderror"
                            name="nominal_denda" id="nominal_denda" placeholder="Boleh dikosongkan">
                        @error('nominal_denda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_anggota" class="form-label">Anggota</label>
                        <select name="id_anggota" id="id_anggota"
                            class="form-select @error('id_anggota') is-invalid @enderror">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($anggotas as $anggota)
                                <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_denda" class="form-label">Denda</label>
                        <select name="id_denda" id="id_denda"
                            class="form-select @error('id_denda') is-invalid @enderror">
                            <option value="">-- Pilih Denda --</option>
                            @foreach ($dendas as $denda)
                                <option value="{{ $denda->id }}">{{ $denda->nominal }}</option>
                            @endforeach
                        </select>
                        @error('id_denda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

@extends('layouts.main', ['title' => 'Tambah Peminjaman', 'page_heading' => 'Tambah Data Peminjaman'])

@section('content')
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Peminjaman</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('peminjaman.store') }}" method="POST" class="form form-horizontal">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="id_pinjam">ID Pinjam</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="id_pinjam" class="form-control @error('id_pinjam') is-invalid @enderror" 
                                            name="id_pinjam" value="{{ old('id_pinjam') }}" required>
                                        @error('id_pinjam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="lama_pinjam">Lama Pinjam (hari)</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="lama_pinjam" class="form-control @error('lama_pinjam') is-invalid @enderror" 
                                            name="lama_pinjam" value="{{ old('lama_pinjam') }}" required>
                                        @error('lama_pinjam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="nominal_denda">Nominal Denda</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="nominal_denda" class="form-control @error('nominal_denda') is-invalid @enderror" 
                                            name="nominal_denda" value="{{ old('nominal_denda') }}" required>
                                        @error('nominal_denda')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="id_anggota">Anggota</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select name="id_anggota" id="id_anggota" class="form-select @error('id_anggota') is-invalid @enderror" required>
                                            <option value="" selected disabled>Pilih Anggota</option>
                                            @foreach ($anggotas as $anggota)
                                                <option value="{{ $anggota->id }}" {{ old('id_anggota') == $anggota->id ? 'selected' : '' }}>
                                                    {{ $anggota->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_anggota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="id_user">Petugas</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select name="id_user" id="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                                            <option value="" selected disabled>Pilih Petugas</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="id_denda">Denda</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select name="id_denda" id="id_denda" class="form-select @error('id_denda') is-invalid @enderror" required>
                                            <option value="" selected disabled>Pilih Denda</option>
                                            @foreach ($dendas as $denda)
                                                <option value="{{ $denda->id }}" {{ old('id_denda') == $denda->id ? 'selected' : '' }}>
                                                    {{ number_format($denda->nominal, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_denda')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary me-1 mb-1">Kembali</a>
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.main', ['title' => 'Peminjaman', 'page_heading' => 'Data Peminjaman'])

@section('content')
    <section class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldTicket"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Total Data Peminjaman</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $totalPeminjamanCount }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="stats-icon blue">
                                <i class="iconly-boldTicket"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col card px-3 py-3">
            <div class="d-flex justify-content-end pb-3">
                <div class="btn-group d-gap gap-2">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                    </a>
                    <a href="{{ route('peminjaman.export') }}" class="btn btn-success">Download Data</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm w-100" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Pinjam</th>
                            <th scope="col">Lama Pinjam (hari)</th>
                            <th scope="col">Nominal Denda</th>
                            <th scope="col">Anggota</th>
                            <th scope="col">User</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->id_pinjam }}</td>
                                <td>{{ $item->lama_pinjam }}</td>
                                <td>{{ number_format($item->nominal_denda, 0, ',', '.') }}</td>
                                <td>{{ $item->anggota->nama ?? 'N/A' }}</td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection


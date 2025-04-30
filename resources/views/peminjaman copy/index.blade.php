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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPeminjamanModal">
                        <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                    </button>
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
                            {{-- <th scope="col">Anggota</th>
                            <th scope="col">User</th> --}}
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('modal')
    @include('peminjaman.modal.create')
    @include('peminjaman.modal.edit')
    @include('peminjaman.modal.show')
@endpush

@push('js')
    @include('peminjaman.script')
@endpush

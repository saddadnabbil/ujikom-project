@extends('layouts.main', ['title' => 'Anggota', 'page_heading' => 'Data Anggota'])

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
                            <h6 class="text-muted font-semibold">Total Anggota</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $totalAnggotaCount }}
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnggotaModal">
                        <i class="bi bi-plus-circle"></i> Tambah Anggota
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm w-100" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Anggota</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Tanggal Lahir</th>
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
    @include('anggota.modal.create')
    @include('anggota.modal.edit')
    @include('anggota.modal.show')
@endpush

@push('js')
    @include('anggota.script')
@endpush

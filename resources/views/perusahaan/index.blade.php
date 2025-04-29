@extends('layouts.main', ['title' => 'Perusahaan', 'page_heading' => 'Data Perusahaan'])

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
                            <h6 class="text-muted font-semibold">Total Perusahaan</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $totalPerusahaanCount }}
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
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Perusahaan Terhapus</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $perusahaanTrashedCount }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col card px-3 py-3">
            <div class="d-flex justify-content-end pb-3">
                <div class="btn-group d-gap gap-2">
                    <a href="{{ route('perusahaan.index.history') }}" class="btn btn-secondary">
                        <span class="badge">{{ $perusahaanTrashedCount }}</span> Histori Data Perusahaan
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPerusahaanModal">
                        <i class="bi bi-plus-circle"></i> Tambah Perusahaan
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm w-100" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Alamat</th>
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
    @include('perusahaan.modal.create')
    @include('perusahaan.modal.edit')
    @include('perusahaan.modal.show')
@endpush

@push('js')
    @include('perusahaan.script')
@endpush

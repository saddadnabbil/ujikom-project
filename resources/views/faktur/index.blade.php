@extends('layouts.main', ['title' => 'Faktur', 'page_heading' => 'Data Faktur'])

@section('content')
<section class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-4">
                        <div class="stats-icon green">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Total Faktur</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalFakturCount }}</h6>
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
                            <i class="bi bi-trash"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Faktur Terhapus</h6>
                        <h6 class="font-extrabold mb-0">{{ $fakturTrashedCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col card px-3 py-3">
        <div class="d-flex justify-content-end pb-3">
            <div class="btn-group d-gap gap-2">
                <a href="{{ route('faktur.index.history') }}" class="btn btn-secondary">
                    <span class="badge">{{ $fakturTrashedCount }}</span> Histori Data Faktur
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFakturModal">
                    <i class="bi bi-plus-circle"></i> Tambah Faktur
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm w-100" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Perusahaan</th>
                        <th scope="col">Tanggal Faktur</th>
                        <th scope="col">Total</th>
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
@include('faktur.modal.create')
@include('faktur.modal.edit')
@include('faktur.modal.show')
@endpush

@push('js')
@include('faktur.script')
@endpush

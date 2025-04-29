@extends('layouts.main', ['title' => 'Detail Faktur', 'page_heading' => 'Data Detail Faktur'])

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
                        <h6 class="text-muted font-semibold">Total Detail Faktur</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalDetailFakturCount }}</h6>
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
                        <h6 class="text-muted font-semibold">Detail Faktur Terhapus</h6>
                        <h6 class="font-extrabold mb-0">{{ $detailFakturTrashedCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col card px-3 py-3">
        <div class="d-flex justify-content-end pb-3">
            <div class="btn-group d-gap gap-2">
                <a href="{{ route('detail-faktur.index.history', $faktur->id) }}" class="btn btn-secondary">
                    <span class="badge">{{ $detailFakturTrashedCount }}</span> Histori Detail Faktur
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDetailFakturModal">
                    <i class="bi bi-plus-circle"></i> Tambah Detail Faktur
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm w-100" id="datatable-detail">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
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
@include('detail-faktur.modal.create')
@include('detail-faktur.modal.edit')
@include('detail-faktur.modal.show')
@endpush

@push('js')
@include('detail-faktur.script')
@endpush

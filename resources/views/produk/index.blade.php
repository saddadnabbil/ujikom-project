@extends('layouts.main', ['title' => 'Produk', 'page_heading' => 'Data Produk'])

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
                            <h6 class="text-muted font-semibold">Total Produk</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $totalProductCount }}
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
                            <h6 class="text-muted font-semibold">Produk Terhapus</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $produkTrashedCount }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col card px-3 py-3">
            <div class="d-flex justify-content-end pb-3">
                <div class="btn-group d-gap gap-2">
                    <a href="{{ route('produk.index.history') }}" class="btn btn-secondary">
                        <span class="badge">{{ $produkTrashedCount }}</span> Histori Data Produk
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm w-100" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Price</th>
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
    @include('produk.modal.create')
    @include('produk.modal.edit')
    @include('produk.modal.show')
@endpush

@push('js')
    @include('produk.script')
@endpush

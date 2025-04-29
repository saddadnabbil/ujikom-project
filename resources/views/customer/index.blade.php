@extends('layouts.main', ['title' => 'Customer', 'page_heading' => 'Data Customer'])

@section('content')
<section class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-4">
                        <div class="stats-icon green">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Total Customer</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalCustomerCount }}</h6>
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
                            <i class="bi bi-person-x"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Customer Terhapus</h6>
                        <h6 class="font-extrabold mb-0">{{ $customerTrashedCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col card px-3 py-3">
        <div class="d-flex justify-content-end pb-3">
            <div class="btn-group d-gap gap-2">
                <a href="{{ route('customer.index.history') }}" class="btn btn-secondary">
                    <span class="badge">{{ $customerTrashedCount }}</span> Histori Data Customer
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                    <i class="bi bi-plus-circle"></i> Tambah Customer
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm w-100" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telp</th>
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
@include('customer.modal.create')
@include('customer.modal.edit')
@include('customer.modal.show')
@endpush

@push('js')
@include('customer.script')
@endpush

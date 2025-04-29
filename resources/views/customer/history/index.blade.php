@extends('layouts.main', ['title' => 'Customer History', 'page_heading' => 'Histori Daftar Customer Yang Telah Dihapus'])

@section('content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('utilities.alert-flash-message')

                <div class="col-md-12 card px-3 py-3 table-responsive">
                    <div class="col-md-12 py-2">
                        <a href="{{ route('produk.index') }}" class="btn btn-primary float-end mx-2">
                            <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Customer
                        </a>
                    </div>

                    <table class="table table-sm w-100" id="datatable-history">
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
        </div>
    </div>
</section>
@endsection

@push('js')
@include('customer.history.script')
@endpush

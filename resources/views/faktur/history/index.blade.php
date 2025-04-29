@extends('layouts.main', ['title' => 'Customer History', 'page_heading' => 'Histori Daftar Faktur Yang Telah Dihapus'])

@section('content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="col-md-12 card px-3 py-3 table-responsive">
                    <div class="col-md-12 py-2">
                        <a href="{{ route('faktur.index') }}" class="btn btn-primary float-end mx-2">
                            <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Faktur
                        </a>
                    </div>

                    <table class="table table-sm w-100" id="datatable-history">
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
        </div>
    </div>
</section>
@endsection

@push('js')
@include('faktur.history.script')
@endpush

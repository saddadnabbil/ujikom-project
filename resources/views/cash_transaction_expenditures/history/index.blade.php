@extends('layouts.main', ['title' => 'Pengeluaran', 'page_heading' => 'Histori Daftar Pengeluaran Yang Telah Dihapus'])

@section('content')
<section class="row">
	@include('utilities.alert-flash-message')
	<div class="col-md-12 card px-3 py-3 table-responsive">
		<div class="col-md-12 py-2">
			<a href="{{ route('cash-transaction-expenditures.index') }}" class="btn btn-primary float-end mx-2">
				<i class="bi bi-caret-left-square"></i> Kembali Ke Daftar kas
			</a>
		</div>
		<table class="table table-sm" id="datatable">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Note</th>
					<th scope="col">Pengeluaran</th>
					<th scope="col">Tanggal</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</section>
@endsection

@push('js')
@include('cash_transaction_expenditures.history.script')
@endpush

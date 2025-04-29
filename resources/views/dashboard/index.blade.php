@extends('layouts.main', ['title' => 'Dashboard', 'page_heading' => 'Dashboard'])

@section('content')
<section class="row">

</section>
@endsection

@push('modal')
@include('dashboard.modal.show')
@endpush

@push('js')
@include('dashboard.script')
@endpush

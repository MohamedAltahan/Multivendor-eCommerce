@extends('admin.layouts.master')
@section('mainTitle', 'Orders')
@section('content')
    <div class="card-header">
        <h4>All orders</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

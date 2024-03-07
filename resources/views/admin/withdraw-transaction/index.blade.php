@extends('admin.layouts.master')
@section('mainTitle', 'withdraw transactions')
@section('content')
    <div class="card-header">
        <h4>All withdraw transactions</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

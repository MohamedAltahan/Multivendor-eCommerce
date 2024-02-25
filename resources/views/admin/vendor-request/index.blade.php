@extends('admin.layouts.master')
@section('mainTitle', 'Pending vendor requests')
@section('content')
    <div class="card-header">
        <h4>All request</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

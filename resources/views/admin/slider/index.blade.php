@extends('admin.layouts.master')
@section('mainTitle', 'Slider')
@section('content')
    <div class="card-header">
        <h4>Simple Table</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">+ Create New</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection

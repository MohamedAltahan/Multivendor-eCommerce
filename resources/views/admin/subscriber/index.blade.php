@extends('admin.layouts.master')
@section('mainTitle', 'Transaction')
@section('content')

    <div class="card-header">
        <h4>Send email to all subscribers</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.subscribers-send-mail') }}" method="POST">
            @csrf
            <div class="form-group">
                <x-form.input name="subject" label="Subject" />
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="message" class="form-control" id=""></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <div class="card-header">
        <h4>All subscribers</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

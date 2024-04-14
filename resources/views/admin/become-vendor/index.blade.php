@extends('admin.layouts.master')
@section('mainTitle', 'Become Vendor')
@section('content')

    <div class="card-header">
        <h4>Become Vendor</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.become-vendor.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grop">
                <label for="">Become Vendor</label>
                <textarea name="content" class="summernote">{!! @$content->content !!}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>

@endsection

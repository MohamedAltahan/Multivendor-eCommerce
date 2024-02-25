@extends('admin.layouts.master')
@section('mainTitle', 'Terms and condition')
@section('content')

    <div class="card-header">
        <h4>Terms and condition</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.terms-and-conditions.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grop">
                <label for="">Content</label>
                <textarea name="content" class="summernote">{!! @$content->content !!}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>

@endsection

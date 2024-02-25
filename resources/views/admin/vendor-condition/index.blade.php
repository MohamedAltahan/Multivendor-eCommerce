@extends('admin.layouts.master')
@section('mainTitle', 'Vendor conditions')
@section('content')

    <div class="card-header">
        <h4>Conditions to be a vendor</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.vendor-condition.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grop">
                <label for="">Write the conditons for the user to be a vendor</label>
                <textarea name="content" class="summernote">{!! @$content->content !!}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>

@endsection

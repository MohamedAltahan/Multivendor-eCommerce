@extends('admin.layouts.master')
@section('mainTitle', 'Slider')
@section('content')

    <div class="card-header">
        <h4>Create slider</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <x-form.input name="banner_image" label="Banner Image" type="file" accept="image/*" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="banner_url" label="Button URL" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="serial" label='order of Banner "1,2,3..."' class="form-control" />
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection

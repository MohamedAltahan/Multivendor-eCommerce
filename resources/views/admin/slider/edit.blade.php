@extends('admin.layouts.master')
@section('mainTitle', 'Slider')
@section('content')
    <div class="card-header">
        <h4>Edit slider</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <h5>Preview</h5>
                <img width="300px" src="{{ asset('uploads/' . $slider->banner_image) }}">
            </div>

            <div class="form-group">
                <x-form.input name="banner_image" label="Banner Image" type="file" accept="image/*"
                    value={{ null }} class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input value="{{ $slider->banner_url }}" name="banner_url" label="Button URL" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input value="{{ $slider->serial }}" name="serial" label='order of Banner "1,2,3..."'
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option {{ $slider->status == 'active' ? 'selected' : '' }} value="active">Active
                    </option>
                    <option {{ $slider->status == 'inactive' ? 'selected' : '' }} value="inactive">
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

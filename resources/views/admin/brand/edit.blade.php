@extends('admin.layouts.master')
@section('mainTitle', 'Brand')
@section('content')

    <div class="card-header">
        <h4>Create category</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grop">
                <label for="">Logo preview</label>
                <br>
                <img width="150px" src="{{ asset('uploads/' . $brand->logo) }}" alt="Logo">
            </div>
            <div class="form-group">
                <x-form.input name="logo" label="Logo" type="file" accept="image/*" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="name" label="Name" value='{{ $brand->name }}' class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="url" label="Brand url" value='{{ $brand->url }}' class="form-control" />
            </div>

            <div class="form-group">
                <label for="">Is Featured</label>
                <select name="featured" id="inputStatus" class="form-control">
                    <option @selected(old('featured', $brand->featured) == 'yes') value="yes">Yes</option>
                    <option @selected(old('featured', $brand->featured) == 'no') value="no">No</option>
                </select>
                @error('is_featured')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option @selected(old('status', $brand->status) == 'active') value="active">Active</option>
                    <option @selected(old('status', $brand->status) == 'inactive') value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>

@endsection

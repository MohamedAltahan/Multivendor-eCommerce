@extends('admin.layouts.master')
@section('mainTitle', 'Brand')
@section('content')

    <div class="card-header">
        <h4>Create category</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <x-form.input name="logo" label="Banner Image" type="file" accept="image/*" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="">Is Featured</label>
                <select name="featured" id="inputStatus" class="form-control">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
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
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>

        </form>
    </div>

@endsection

@extends('admin.layouts.master')
@section('mainTitle', 'Product Varints')
@section('content')

    <div class="card-header">
        <h4>Updata variant</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.product-variant.update', $variant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form.input name="name" label="Name" value="{{ $variant->name }}" class="form-control" />
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option @selected($variant->status == 'active') value="active">Active</option>
                    <option @selected($variant->status == 'inactive') value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>

@endsection

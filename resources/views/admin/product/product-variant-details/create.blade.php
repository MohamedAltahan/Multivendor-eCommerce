@extends('admin.layouts.master')
@section('mainTitle', 'Product Varint details')
@section('content')

    <div class="card-header">
        <h4>Create variant details</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.product.variant-details.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" value='{{ $variant->name }}' readonly label="Variant Name" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="product_variant_type_id" type="hidden" value="{{ $variant->id }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="variant_value" label="Variant value ( like Red, blue, large, 2010 .....)"
                    class="form-control" />
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

@extends('admin.layouts.master')
@section('mainTitle', 'Product Varint details')
@section('content')

    <div class="card-header">
        <h4>Update variant details</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.product.product-variant-details.update', $variantDetails->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <x-form.input name="name" readonly label="Variant Name" value="{{ $variantDetails->productVariant->name }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="variant_value" label="Variant value" value="{{ $variantDetails->variant_value }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="price" label="Price (Set 0 for make it free)" value="{{ $variantDetails->price }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="">Is default</label>
                <select name="is_default" class="form-control">
                    <option value="">None</option>
                    <option @selected($variantDetails->is_default == 'yes') value="yes">Yes</option>
                    <option @selected($variantDetails->is_default == 'no') value="no">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" id="inputStatus" class="form-control">
                    <option @selected($variantDetails->status == 'active') value="active">Active</option>
                    <option @selected($variantDetails->status == 'inactive') value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>

@endsection

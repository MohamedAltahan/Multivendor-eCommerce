@extends('admin.layouts.master')
@section('mainTitle', 'Product Varints')
@section('content')

    <div class="card-header">
        <h4>Create new variant</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.variant.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Name (Like: size, color, model....)" class="form-control" />
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

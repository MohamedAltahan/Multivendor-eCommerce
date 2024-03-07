@extends('admin.layouts.master')
@section('mainTitle', 'withdraw methods')
@section('content')
    <div class="card-header">
        <h4>Create withdraw method</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.withdraw-method.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Name of method" />
            </div>

            <div class="form-group">
                <x-form.input name="minimum_amount" label="Minimun amount" />
            </div>

            <div class="form-group">
                <x-form.input name="maximum_amount" label="Maximum amount" />
            </div>

            <div class="form-group">
                <x-form.input name="withdraw_charge" label="Withdraw charge(% )" />
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="summernote"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Create</button>
        </form>
    </div>


@endsection

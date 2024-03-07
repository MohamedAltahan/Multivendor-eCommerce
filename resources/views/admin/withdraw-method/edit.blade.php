@extends('admin.layouts.master')
@section('mainTitle', 'withdraw methods')
@section('content')
    <div class="card-header">
        <h4>Update withdraw method</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.withdraw-method.update', $method->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form.input name="name" label="Name" value="{{ $method->name }}" />
            </div>

            <div class="form-group">
                <x-form.input name="minimum_amount" label="Minimun amount" value="{{ $method->minimum_amount }}" />
            </div>

            <div class="form-group">
                <x-form.input name="maximum_amount" label="Maximum amount" value="{{ $method->maximum_amount }} " />
            </div>

            <div class="form-group">
                <x-form.input name="withdraw_charge" label="Withdraw charge(% )" value="{{ $method->withdraw_charge }}" />
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="summernote"> {!! $method->description !!}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Create</button>
        </form>
    </div>


@endsection

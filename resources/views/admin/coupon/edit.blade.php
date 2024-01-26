@extends('admin.layouts.master')
@section('mainTitle', 'Coupon')
@section('content')

    <div class="card-header">
        <h4>Create Coupon</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" value="{{ $coupon->name }}" />
            </div>

            <div class="form-group">
                <x-form.input name="code" label="Coupon Code" class="form-control" value="{{ $coupon->code }}" />
            </div>

            <div class="form-group">
                <x-form.input name="quantity" label="Quantity" class="form-control" value="{{ $coupon->quantity }}" />
            </div>

            <div class="form-group">
                <x-form.input name="max_use_per_person" label="Maximun use per person " class="form-control"
                    value="{{ $coupon->max_use_per_person }}" />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input label="Start date" class="form-control datepicker" name="start_date"
                            value="{{ $coupon->start_date }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input label="End date" class="form-control datepicker" name="end_date"
                            value="{{ $coupon->end_date }}" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Discount type</label>
                        <select name="discount_type" class="form-control">
                            <option @selected($coupon->discount_type == 'percent') value="percent">Percentage (%)</option>
                            <option @selected($coupon->discount_type == 'fixed') value="fixed">Fixed Amount ({{ $setting->currency }})
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input name="discount_value" label="Discount value" class="form-control"
                            value="{{ $coupon->discount_value }}" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" class="form-control">
                    <option @selected($coupon->status == 'active') value="active">Active</option>
                    <option @selected($coupon->status == 'inactive') value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
@endsection
{{-- styles================================================================================ --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
{{-- scripts================================================================================ --}}
@push('scripts')
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush

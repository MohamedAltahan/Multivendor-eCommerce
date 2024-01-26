@extends('admin.layouts.master')
@section('mainTitle', 'Coupon')
@section('content')

    <div class="card-header">
        <h4>Create Coupon</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="code" label="Coupon Code" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="quantity" label="Quantity" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="max_use_per_person" label="Maximun use per person " class="form-control" />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input label="Start date" class="form-control datepicker" name="start_date" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input label="End date" class="form-control datepicker" name="end_date" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Discount type</label>
                        <select name="discount_type" class="form-control">
                            <option value="percent">Percentage (%)</option>
                            <option value="fixed">Fixed Amount ({{ $setting->currency }})</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input name="discount_value" label="Discount value" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Create' }}</button>

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

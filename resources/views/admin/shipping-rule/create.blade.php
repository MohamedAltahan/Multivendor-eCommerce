@extends('admin.layouts.master')
@section('mainTitle', 'Shipping Rule')
@section('content')

    <div class="card-header">
        <h4>Create Shipping Rule</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.shipping-rule.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="">Shipping type</label>
                <select name="type" class="form-control shipping-type">
                    <option value="flat_cost">Fixed cost</option>
                    <option value="min_cost">Depend on order cost</option>
                </select>
            </div>

            <div class="form-group min-cost d-none">
                <x-form.input name="min_cost" label="order cost is :" class="form-control " />
            </div>

            <div class="form-group">
                <x-form.input name="cost" label="Cost" class="form-control" />
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
    <script>
        $(document).ready(function() {
            $('body').on('change', '.shipping-type', function() {
                let shippingType = $(this).val();
                if (shippingType != 'min_cost') {
                    $('.min-cost').addClass('d-none');
                    $("[name = 'min_cost']").val(0);
                    $("[name = 'cost']").val('');
                } else {
                    $('.min-cost').removeClass('d-none');
                }
            })
        })
    </script>
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush

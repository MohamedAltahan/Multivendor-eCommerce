@extends('admin.layouts.master')
@section('mainTitle', 'Flash Sale')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Flash Sale End Date</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                @csrf
                @method('PUT')
                <x-form.input label='Flash Sale End Date' value="{{ @$flashSale->end_flash_date }}"
                    class="form-control datepicker" name="end_flash_date" />
                <button class="btn btn-primary my-4">Save</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Add Flash Sale Products</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="">Add product</label>
                    <select name="product_id" class="form-control select2 ">
                        <option value="">Select</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <label for="">Show at home</label>
                        <select name="show_at_home" class="form-control ">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">

                        <label for="">Status</label>
                        <select name="status" class="form-control ">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary my-4 ">Save</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>All Flash Sale products</h4>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    @endpush

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            // change status-------------------------------------------------------
            $(document).ready(function() {
                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.flash-sale.change-status') }}",
                        data: {
                            // status is the name of the value "ischecked" in you php function
                            status: isChecked,
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(error) {
                            toastr.error('Not updated')
                        }


                    })
                })
                //show at home status change
                $('body').on('click', '.show-at-home-change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.flash-sale.show-at-home-status') }}",
                        data: {
                            // status is the name of the value "ischecked" in you php function
                            show_at_home: isChecked,
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(error) {
                            toastr.error('Not updated')
                        }


                    })
                })
            })
        </script>
        <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    @endpush
@endsection

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
            <form action="">
                <label for="">Add product</label>
                <select name="" id="" class="form-control select2">
                    <option value=""></option>
                </select>
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
        <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
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
                        url: "{{ route('admin.product.change-status') }}",
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
            })
        </script>
        <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
@endsection

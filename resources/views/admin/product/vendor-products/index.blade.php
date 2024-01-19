@extends('admin.layouts.master')
@section('mainTitle', 'Product')
@section('content')
    <div class="card-header">
        <h4>All products for : {{ $vendor->shop_name }}</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

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
                //change is_approved status================================================
                $('body').on('change', '.is_approved', function() {
                    let selectionValue = $(this).val();
                    let productId = $(this).data('id');
                    let _token = "{{ CSRF_token() }}";
                    $.ajax({
                        url: "{{ route('admin.change-approval-status') }}",
                        method: "PUT",
                        data: {
                            productId,
                            selectionValue,
                            _token
                        },
                        success: function(data) {
                            toastr.success(data.message)
                            window.location.reload();
                        },
                        error: function(x, y, error) {
                            console.log(error);
                        }
                    })

                });
            })
        </script>
    @endpush
@endsection

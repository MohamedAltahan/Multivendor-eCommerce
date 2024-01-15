@extends('admin.layouts.master')
@section('mainTitle', 'Product-Variants')
@section('content')
    <div class="mt-2 ml-2">
        <a href="{{ route('admin.product-variant.index', ['product_id' => $product->id]) }}" class="btn btn-primary"><i
                class="fas fa-arrow-left">Back</i></a>
    </div>
    <div class="card-header">
        <h4> variants for : {{ $variant->name }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.product.product-variant-details.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                class="btn btn-primary">+Create New</a>
        </div>
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
                        url: "{{ route('admin.product.product-variant-details.change-status') }}",
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
    @endpush
@endsection

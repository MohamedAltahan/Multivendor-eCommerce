@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Product Variant Details
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <a href="{{ route('vendor.product-variant.index', ['product_id' => $product->id]) }}"
                            class="btn btn-warning mb-4"><i class="fas fa-arrow-left"></i> Back</a>
                        <h3><i class="far fa-user"></i>Product variant details</h3>
                        <h6> Variang name : <span class="btn-danger">{{ $variant->name }}</span></h6>
                        <div class="right">
                            <a href="{{ route('vendor.product.product-variant-details.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                                class="btn btn-primary">+
                                Create new variant details</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{ $dataTable->table() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
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
                        url: "{{ route('vendor.product.product-variant-details.change-status') }}",
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

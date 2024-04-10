@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Product
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Products</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('vendor.variant.index') }}" class="btn btn-warning">My Variants</a>
                            </div>

                            <div class="col-md-6">
                                <div class="right">
                                    <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">+Create New</a>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="col-md-4">
                                    <a href="{{ route('vendor.product.trash') }}" class="btn btn-danger"><i
                                            class="fas fa-trash"></i> Trash</a>
                                </div>
                                <br>
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
                        url: "{{ route('vendor.product.change-status') }}",
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

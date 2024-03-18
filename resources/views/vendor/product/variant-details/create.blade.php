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
                    <a href="{{ route('vendor.product.variant-details.index', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                        class="btn btn-warning mt-2">Back</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create variant value</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.product.variant-details.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group my-2">
                                        <x-form.input name="name" value='{{ $variant->name }}' readonly
                                            label="Variant Name" class="form-control" />
                                    </div>

                                    <div class="form-group my-2">
                                        <x-form.input name="product_variant_type_id" type="hidden"
                                            value="{{ $variant->id }}" class="form-control" />
                                    </div>

                                    <div class="form-group my-2">
                                        <x-form.input name="product_id" type="hidden" value="{{ $product->id }}"
                                            class="form-control" />
                                    </div>

                                    <div class="form-group my-2">
                                        <x-form.input name="variant_value" label="Variant value" class="form-control" />
                                    </div>

                                    <div class="form-group my-2">
                                        <x-form.input name="price" label="Price (Set 0 for make it free) "
                                            class="form-control" />
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Is default</label>
                                        <select name="is_default" id="inputStatus" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">status</label>
                                        <select name="status" id="inputStatus" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-2">Create</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
@endsection

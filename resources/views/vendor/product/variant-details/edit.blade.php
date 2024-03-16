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
                    {{-- <a href="{{ route('vendor.product.product-variant-details.index', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                        class="btn btn-warning mt-2">Back</a> --}}
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create variant value</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form
                                    action="{{ route('vendor.product.product-variant-details.update', $variantDetails->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="my-2">
                                        <x-form.input name="name" readonly label="Variant Name"
                                            value="{{ $variantDetails->Variant->name }}" class="form-control" />
                                    </div>

                                    <div class="my-2">
                                        <x-form.input name="variant_value" label="Variant value"
                                            value="{{ $variantDetails->variant_value }}" class="form-control" />
                                    </div>

                                    <div class="my-2">
                                        <x-form.input name="price" label="Price (Set 0 for make it free)"
                                            value="{{ $variantDetails->price }}" class="form-control" />
                                    </div>

                                    <div class="my-2">
                                        <label for="">Is default</label>
                                        <select name="is_default" class="form-control">
                                            <option @selected($variantDetails->is_default == 'yes') value="yes">Yes</option>
                                            <option @selected($variantDetails->is_default == 'no') value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="my-2">
                                        <label for="">status</label>
                                        <select name="status" id="inputStatus" class="form-control">
                                            <option @selected($variantDetails->status == 'active') value="active">Active</option>
                                            <option @selected($variantDetails->status == 'inactive') value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-2">Update</button>

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

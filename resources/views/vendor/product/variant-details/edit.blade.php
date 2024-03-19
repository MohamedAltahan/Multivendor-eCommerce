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
                        <h3><i class="far fa-user"></i>edit variant </h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product.variant-details.update', $variantDetails->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="my-2">
                                        <x-form.input name="name" readonly label="Variant Name"
                                            value="{{ $variantDetails->variantType->name }}" class="form-control" />
                                    </div>

                                    <div class="my-2">
                                        <x-form.input name="variant_value" label="Variant value"
                                            value="{{ $variantDetails->variant_value }}" class="form-control" />
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

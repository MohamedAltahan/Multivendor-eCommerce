@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Product Variant
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create variant</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.variant.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <x-form.input value="{{ request()->product_id }}" name="product_id" type="hidden"
                                            class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <x-form.input value="{{ Auth::user()->vendor->id }}" name="vendor_id" type="hidden"
                                            class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <x-form.input name="name" label="Name" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">status</label>
                                        <select name="status" id="inputStatus" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-3">Create</button>

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

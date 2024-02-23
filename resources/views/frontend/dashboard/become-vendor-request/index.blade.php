@extends('frontend.dashboard.layouts.master')
@section('title')
    {{ $setting->site_name }} - Reviews
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Make request to be a vendor</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">


                            </div>
                        </div>
                        <br>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('user.become-a-vendor-request.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <x-form.input class="mb-2" type="file" name="banner"
                                        label="Select the shop banner" />
                                    <x-form.input class="mb-2" name="shop_name" label="Shop name" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-form.input class="mb-2" name="phone" label="Phone" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-form.input class="mb-2" name="email" label="Email" />
                                        </div>
                                    </div>
                                    <x-form.input class="mb-2" name="address" label="Shop address" />
                                    <label for="">About your store</label>
                                    <div class="wsus__dash_pro_single">
                                        <textarea name="description" class="form control" placeholder="About your store"></textarea>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
    @push('scripts')
        <script></script>
    @endpush
@endsection

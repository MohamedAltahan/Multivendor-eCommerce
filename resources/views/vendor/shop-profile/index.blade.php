@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Shop profile
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Shop profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{-- first form --------------------------------------- --}}
                                <form action="{{ route('vendor.shop-profile.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group my-1">
                                        <label for="">Banner previvew</label>
                                        <br>
                                        <img width="150px" src="{{ asset('uploads/' . $profile->banner) }}" alt="">
                                    </div>

                                    <div class="form-group my-1">
                                        <x-form.input name="banner" label="Banner Image" type="file" accept="image/*"
                                            class="form-control" />
                                    </div>

                                    <div class="form-group my-1">
                                        <x-form.input name="shop_name" label="Shop name" value="{{ $profile->shop_name }}"
                                            class="form-control" />

                                        <div class="form-group my-1">
                                            <x-form.input name="phone" label="Phone" value="{{ $profile->phone }}"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group my-1">
                                            <x-form.input name="email" label="Email" value="{{ $profile->email }}"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group my-1">
                                            <x-form.input name="address" label="Address" value="{{ $profile->address }}"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group my-1">
                                            <label for="">Description</label>
                                            <textarea class="summernote" name="description" type='textarea' class="form-control">{{ $profile->description }}</textarea>
                                        </div>
                                        <div class="form-group my-1">
                                            <x-form.input name="fb_link" label="Facebook link"
                                                value="{{ $profile->fb_link }}" class="form-control" />
                                        </div>
                                        <div class="form-group my-1">
                                            <x-form.input name="insta_link" label="Istegram link"
                                                value="{{ $profile->insta_link }}" class="form-control" />
                                        </div>
                                        <div class="form-group my-1">
                                            <x-form.input name="tw_link" label="Twitter link"
                                                value="{{ $profile->tw_link }}" class="form-control" />
                                        </div>


                                        <button type="submit" class="btn btn-primary">Update</button>
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

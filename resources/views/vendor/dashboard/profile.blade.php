@extends('vendor.dashboard.layouts.master')
@section('content')
    <!--=============================
                                                                                                                                                                                                                                                                                                                DASHBOARD START
                                                                                                                                                                                                                                                                                                              ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>basic information</h4>
                                {{-- first form --------------------------------------- --}}
                                <form action="{{ route('user.profile.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    {{-- image --}}
                                    <div class="col-sm-2 col-md-2 mb-2">
                                        <div class="wsus__dash_pro_img">
                                            <img src="{{ Auth::user()->image ? asset('uploads/' . Auth::user()->image) : asset('frontend/images/ts-2.jpg') }}"
                                                alt="img" class="img-fluid w-100">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__dash_pro_single">
                                            <x-form.input class="form-group" type="file" accept="image/*"
                                                name="image" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- first name --}}
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie"></i>
                                                <x-form.input name="name" placeholder="Your Name"
                                                    value="{{ Auth::user()->name }}" />
                                            </div>
                                        </div>
                                        {{-- email --}}
                                        <div class=" col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fal fa-envelope-open"></i>
                                                <x-form.input type="email" name="email" placeholder="Email"
                                                    value="{{ Auth::user()->email }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <button class="common_btn mb-4 mt-2" type="submit">Update data</button>
                                    </div>
                                </form>
                                {{-- second form(update password) ------------------------------------------ --}}
                                <h4>Update password</h4>
                                <form action="{{ route('user.password.update') }}" method="POST">
                                    @csrf
                                    <div class="wsus__dash_pass_change mt-2">
                                        <div class="row">

                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-unlock-alt"></i>
                                                    <x-form.input name="current_password" type="password"
                                                        placeholder="Current Password" />
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <x-form.input name="password" type="password"
                                                        placeholder="New Password" />
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <x-form.input name="password_confirmation" type="password"
                                                        placeholder="Confirm Password" />
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <button class="common_btn" type="submit">Update password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                                                                                                                                                                                                                                                                                DASHBOARD START
                                                                                                                                                                                                                                                                                                              ==============================-->
@endsection

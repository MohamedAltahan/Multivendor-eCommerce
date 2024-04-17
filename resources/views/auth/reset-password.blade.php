@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - {{ __('Reset password') }}
@endsection
@section('content')
    <!--============================BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('Reset password') }}</h4>
                        <ul>
                            <li><a href="#">login</a></li>
                            <li><a href="#">Reset password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->

    <!--============================CHANGE PASSWORD START==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="wsus__change_password">
                            <h4>{{ __('Reset password') }}</h4>

                            <div class="wsus__single_pass">
                                <x-form.input :value="old('email', $request->email)" id="email" type="hidden" name="email"
                                    placeholder="{{ __('Your email') }}" />
                            </div>

                            <div class="wsus__single_pass">
                                <x-form.input id="password" type="password" name="password" label="new password"
                                    placeholder="{{ __('New Password') }}" />
                            </div>

                            <div class="wsus__single_pass">
                                <x-form.input label="comfirm password" id="password_confirmation" type="password"
                                    name="password_confirmation" placeholder="{{ __('Confirm Password') }}" />
                            </div>
                            <button class="common_btn" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================CHANGE PASSWORD END==============================-->
@endsection

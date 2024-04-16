@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - {{ __('Login') }}
@endsection
@section('content')
    <!--============================ BREADCRUMB START ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('Login') }} / {{ __('Register') }}</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">login / register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->

    <!--============================LOGIN/REGISTER PAGE START==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">{{ __('Login') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">{{ __('Signup') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    {{-- start login form----------------------------------------------- --}}
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="wsus__login_input">

                                            <i class="fas fa-user-tie"></i>
                                            <input type="email" id="email" name="email"
                                                placeholder="{{ __('Email') }}" autofocus />
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password"
                                                placeholder="{{ __('Password') }}" />
                                        </div>

                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember_me">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault">{{ __('Remember me') }}</label>
                                            </div>
                                            <a class="forget_p"
                                                href="{{ route('password.request') }}">{{ __('Forget password') }} ?</a>
                                        </div>
                                        <div class="text-center row justify-content-around">

                                            <a type="button" href="{{ route('github.login') }}"
                                                class=" col-md-3 btn btn-dark my-1"><i class="fab fa-github "></i>
                                                Github</a>

                                            <a type="button" href="{{ route('facebook.login') }}"
                                                class="btn btn-primary col-md-3 my-1  "><i class="fab fa-facebook"></i>
                                                Facebook</a>

                                            <a type="button" href="{{ route('google.login') }}"
                                                class=" my-1 btn btn-outline-success col-md-3"><i class="fab fa-google"></i>
                                                Google</a>

                                        </div>
                                        <br>
                                        <button class="common_btn" type="submit">{{ __('Login') }}</button>

                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    {{-- start register form----------------------------------------------- --}}

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Name -->
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <x-form.input id="name" type="text" name="name"
                                                placeholder="{{ __('Name') }}" autofocus />
                                        </div>
                                        <!-- Email Address -->
                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input id="email" type="email" name="email"
                                                placeholder="{{ __('Email') }}" />
                                        </div>
                                        <!-- Password -->
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password"
                                                placeholder="{{ __('Password') }}" />
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <x-form.input id="password_confirmation" type="password"
                                                name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}" />
                                        </div>


                                        <button class="common_btn my-4" type="submit">{{ __('Signup') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================LOGIN/REGISTER PAGE END==============================-->
@endsection

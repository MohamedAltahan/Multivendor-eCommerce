@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                {{-- edit profile ------------------------------------------------------- --}}
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" enctype="multipart/form-data" class="needs-validation"
                            action="{{ route('admin.profile.update') }}" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mx-3">
                                        <div class="form-group mx-1 ">
                                            <img width='100px' src="{{ asset('uploads/' . Auth::user()->image) }}"
                                                alt="image">
                                        </div>

                                        <div class="form-group mx-1 ">
                                            <x-form.input accept="image/*" lable="Image" name='image' type='file' />
                                        </div>
                                    </div>

                                    <div class="form-group mx-1 col-md-5">
                                        <x-form.input lable="UserName" name='name' placeholder='Your name'
                                            value="{{ Auth::user()->name }}" />
                                    </div>

                                    <div class="form-group mx-1 col-md-5">
                                        <x-form.input lable="Email" name='email' placeholder='your Email'
                                            value="{{ Auth::user()->email }}" />
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                {{-- update password------------------------------------------------------- --}}
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('admin.password.update') }}"
                            novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Update password</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group mx-1 col-12">
                                        <x-form.input type='password' lable="Current password" name='current_password'
                                            placeholder='Current password' />
                                    </div>

                                    <div class="form-group mx-1 col-12">
                                        <x-form.input type='password' lable="New password" name='password'
                                            placeholder='New password' />
                                    </div>

                                    <div class="form-group mx-1 col-12">
                                        <x-form.input type='password' lable="Confirm password" name='password_confirmation'
                                            placeholder='Confirm password' />
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

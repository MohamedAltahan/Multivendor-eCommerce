@extends('frontend.dashboard.layouts.master')
@section('content')
    <!--============================= DASHBOARD START ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- sidebar --}}
            @include('frontend.dashboard.layouts.sidebar')
            {{-- end sidebar --}}
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fal fa-gift-card"></i>Edit address</h3>
                        <div class="wsus__dashboard_add wsus__add_address">
                            <form action="{{ route('user.address.update', $address->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>name <b>*</b></label>
                                            <x-form.input placeholder="Name" name="name" value="{{ $address->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>email</label>
                                            <x-form.input type="email" placeholder="Email" name="email"
                                                value="{{ $address->email }}" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>phone <b>*</b></label>
                                            <x-form.input placeholder="Phone" name="phone"
                                                value="{{ $address->phone }}" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>country<b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="country">
                                                    <option value="">Select Country</option>
                                                    @foreach (config('setting.country') as $country)
                                                        <option @selected($address->country == $country) value="{{ $country }}">
                                                            {{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>City<b>*</b></label>
                                            <x-form.input placeholder="City" name="city" value="{{ $address->city }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>State<b>*</b></label>
                                            <x-form.input placeholder="State" name="state"
                                                value="{{ $address->state }}" />
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>zip code <b>*</b></label>
                                            <x-form.input placeholder="Zip Code" name="zip_code"
                                                value="{{ $address->zip_code }}" />
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Address <b>*</b></label>
                                            <x-form.input placeholder="Address" name="address"
                                                value="{{ $address->address }}" />
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <button type="submit" class="common_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================DASHBOARD START==============================-->
@endsection

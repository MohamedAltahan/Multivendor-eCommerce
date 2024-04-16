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
                    <div class="dashboard_content">
                        <h3><i class="fal fa-gift-card"></i> {{ __('Addresses') }}</h3>
                        <div class="wsus__dashboard_add">
                            <div class="row">
                                @foreach ($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="wsus__dash_add_single">
                                            <h4>{{ __('Billing address') }}</h4>
                                            <ul>
                                                <li><span>{{ __('Name') }} :</span> {{ $address->name }}</li>
                                                <li><span>{{ __('Phone') }} :</span>{{ $address->phone }}</li>
                                                <li><span>{{ __('Email') }} :</span> {{ $address->email }}</li>
                                                <li><span>{{ __('Country') }} :</span> {{ $address->country }}</li>
                                                <li><span>{{ __('State') }} :</span> {{ $address->state }}</li>
                                                <li><span>{{ __('City') }} :</span> {{ $address->city }}</li>
                                                <li><span>{{ __('zip code') }} :</span> {{ $address->zip_code }}</li>
                                                <li><span>{{ __('Address') }} :</span> {{ $address->address }}</li>
                                            </ul>

                                            <div class="wsus__address_btn">
                                                <a href="{{ route('user.address.edit', $address->id) }}" class="edit"><i
                                                        class="fal fa-edit"></i>
                                                    {{ __('Edit') }}</a>
                                                <a href="{{ route('user.address.destroy', $address->id) }}"
                                                    class="del delete-item"><i class="fal fa-trash-alt"></i>
                                                    {{ __('Delete') }}</a>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12">
                                    <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i
                                            class="far fa-plus"></i>
                                        {{ __('Add new address') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================DASHBOARD START==============================-->
@endsection

@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - {{ __('Checkout') }}
@endsection
@section('content')
    <!--============================BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('Checkout') }}</h4>
                        <ul>
                            <li><a href="route('home')">home</a></li>
                            <li><a href="#">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->

    <!--============================ CHECK OUT PAGE START==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <div class="d-flex">

                            <h5>{{ __('Shipping addresses :') }} </h5>
                            <a href="#" class="common_btn" style="margin-left:auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">{{ __('Add new address') }}</a>
                        </div>

                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" type="radio"
                                                name="flexRadioDefault" data-id="{{ $address->id }}"
                                                id="Radio{{ $address->id }}">
                                            <label class="form-check-label" for="Radio{{ $address->id }}">
                                                {{ __('Select Address') }}
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>{{ __('Name :') }}</span> {{ $address->name }}</li>
                                            <li><span>{{ __('Phone :') }}</span> {{ $address->phone }}</li>
                                            <li><span>{{ __('Email :') }}</span> {{ $address->email }}</li>
                                            <li><span>{{ __('Country :') }}</span> {{ $address->country }}</li>
                                            <li><span>{{ __('City :') }}</span> {{ $address->city }}</li>
                                            <li><span>{{ __('Zip Code :') }}</span> {{ $address->zip_code }}</li>
                                            <li><span>{{ __('Address :') }}</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">{{ __('Shipping Methods') }}</p>
                        @foreach ($shippingMethods as $shippingMethod)
                            @if ($shippingMethod->type == 'min_cost' && calcCartTotal() >= $shippingMethod->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="Radio_{{ $shippingMethod->id }}" value="{{ $shippingMethod->id }}"
                                        data-id="{{ $shippingMethod->cost }}">
                                    <label class="form-check-label" for="Radio_{{ $shippingMethod->id }}">
                                        {{ $shippingMethod->name }}
                                        <span>cost: {{ $setting->currency }}{{ $shippingMethod->cost }}</span>
                                    </label>
                                </div>
                            @elseif ($shippingMethod->type == 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        data-id="{{ $shippingMethod->cost }}" id="Radio_{{ $shippingMethod->id }}"
                                        value="{{ $shippingMethod->id }}">
                                    <label class="form-check-label" for="Radio_{{ $shippingMethod->id }}">
                                        {{ $shippingMethod->name }}
                                        <span>cost: {{ $setting->currency }}{{ $shippingMethod->cost }}</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>{{ __('Subtotal') }} :<span class="cart_subtotal"> {{ $setting->currency }}
                                    {{ calcCartTotal() }}</span></p>
                            <p>{{ __('Shipping fee(+)') }} :<span id="shipping_fee">{{ $setting->currency }}0</span></p>
                            <p>{{ __('Coupon(-)') }} :<span
                                    id="cart_discount">{{ $setting->currency }}{{ getMainCartDiscount() }}</span>
                            </p>
                            <p><b>{{ __('Total') }} :</b> <span></span>
                                <b id="total_price" data-id="{{ getMainCartTotal() }}">
                                    {{ $setting->currency }}{{ getMainCartTotal() }}</b></span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input check-agree" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    {{ __('I have read and agree to the website') }} <a
                                        href="#">{{ __('terms and conditions') }}
                                        *</a>
                                </label>
                            </div>
                        </div>
                        <form id="checkout_form">
                            <input type="hidden" name="shipping_method_id" id="shipping_method_id" value="">
                            <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">
                            <a href="" id="submit_checkout_form" class="common_btn">{{ __('Place order') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Add new address') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.create.address') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="name" type="text"
                                                placeholder="{{ __('Name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="phone" type="text"
                                                placeholder="{{ __('Phone') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="email" type="email"
                                                placeholder="{{ __('Email') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value=""> {{ __('Select Country') }}</option>
                                                @foreach (config('setting.country') as $country)
                                                    <option @selected(old('country') == $country ? 'selected' : '') value="{{ $country }}">
                                                        {{ $country }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="city" type="text"
                                                placeholder=" {{ __('City') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="state" type="text"
                                                placeholder="{{ __('State') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="zip_code" type="text"
                                                placeholder="{{ __('zip code') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <x-form.input name="address" type="text"
                                                placeholder="{{ __('Address') }}" />
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
    <!--============================ CHECK OUT PAGE END ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // calculations==========================================================
            $('input[type="radio"]').prop('checked', false)
            // reset hidden inputs
            $('#shipping_address_id').val('');
            $('#shipping_method_id').val('');


            $('.shipping_method').on('click', function() {
                let currentTotalPrice = $('#total_price').data('id');
                let shippingFee = $(this).data('id');
                let totalPrice = currentTotalPrice + shippingFee

                $('#shipping_method_id').val($(this).val())
                $('#shipping_fee').text("{{ $setting->currency }}" + $(this).data('id'))
                $('#total_price').text("{{ $setting->currency }}" + totalPrice)
            })

            // get address id========================================================
            $('.shipping_address').on('click', function() {
                $('#shipping_address_id').val($(this).data('id'))
            })
            //submit checkout form ==================================================
            $('#submit_checkout_form').on('click', function(e) {
                e.preventDefault();
                if ($('#shipping_method_id').val() == "") {
                    toastr.error('Shipping method is required')
                } else if ($('#shipping_address_id').val() == "") {
                    toastr.error('Shipping address is required')
                } else if (!$('.check-agree').prop('checked')) {
                    toastr.error('You have to agree with our terms and conditions')
                } else {
                    $.ajax({
                        url: "{{ route('user.checkout.submit-checkout') }}",
                        method: "POST",
                        data: $('#checkout_form').serialize(),
                        beforeSend: function() {
                            $('#submit_checkout_form').html(
                                '<i class="fas fa-spinner fa-spin fa-1x"></i>');
                        },
                        success: function(data) {
                            $('#submit_checkout_form').html('Done');
                            //goto payment page
                            window.location.href = data.redirect_to_payment_url;
                        },
                        error: function(data) {

                        }
                    })
                }
            })

        })
    </script>
@endpush

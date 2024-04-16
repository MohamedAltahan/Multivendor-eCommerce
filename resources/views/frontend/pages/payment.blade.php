@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - {{ __('Payment') }}
@endsection
@section('content')
    <!--============================  BREADCRUMB START ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('Payment') }}</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->

    <!--============================ PAYMENT PAGE START==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-cod" type="button" role="tab" aria-controls="v-pills-cod"
                                    aria-selected="true">{{ __('COD (cash on delivery)') }}</button>

                                <button class="nav-link common_btn " id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">Paypal</button>

                                <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">

                            <div class="tab-pane fade " id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a href="{{ route('user.paypal.payment') }}"
                                                class="nav-link common_btn text-center">{{ __('Pay with') }} paypal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <button class="nav-link common_btn">{{ __('Pay with') }} Stripe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="v-pills-cod" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a href="{{ route('user.cod.payment') }}" class="nav-link common_btn">
                                                {{ __('Proceed') }} > </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="wsus__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>{{ __('Order Summary') }}</h5>
                            <p>{{ __('Subtotal ') }} : <span>{{ $setting->currency }}{{ calcCartTotal() }}</span></p>
                            <p>{{ __('Shipping fee(+)') }} : <span>{{ $setting->currency }}{{ getShippingFee() }}</span>
                            </p>
                            <p>{{ __('Coupon(-)') }} : <span>{{ $setting->currency }}{{ getMainCartDiscount() }}</span>
                            </p>
                            <h6>{{ __('Total') }} <span>{{ $setting->currency }}{{ finalPaymentAmount() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================PAYMENT PAGE END ==============================-->
@endsection
@push('scripts')
    <script></script>
@endpush

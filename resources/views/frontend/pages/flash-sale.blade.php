@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - Flash Sale
@endsection
@section('content')
    <!--============================ BREADCRUMB START ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascript::">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================ BREADCRUMB END=======================================-->

    <!--============================DAILY DEALS DETAILS START==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_2.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_3.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleProducts as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            @include('frontend.home.big-product-card')

                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    @if ($flashSaleProducts->hasPages())
                        {{ $flashSaleProducts->links() }}
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!--============================ DAILY DEALS DETAILS END  ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown(".simply-countdown-one", {
                year: {{ date('Y', strtotime(@$flashSaleDate->end_flash_date)) }}, //2022
                month: {{ date('m', strtotime(@$flashSaleDate->end_flash_date)) }}, //2
                day: {{ date('d', strtotime(@$flashSaleDate->end_flash_date)) }}, //5
            });
        });
    </script>
@endpush

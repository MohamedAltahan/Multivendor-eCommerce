@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - {{ __('About') }}
@endsection
@section('content')
    <!--============================  BREADCRUMB START ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('About') }}</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">About</a></li>
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
                    <div class="card">
                        <div class="card-body p-4">
                            {!! $content->content !!}
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

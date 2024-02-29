@extends('frontend.dashboard.layouts.master')
@section('title')
    {{ $setting->site_name }} - Dashboard
@endsection
@section('content')
    <!--============================= DASHBOARD START ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- sidebar --}}
            @include('frontend.dashboard.layouts.sidebar')
            {{-- end sidebar --}}
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3>User dashboard</h3>
                    <br>
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="{{ route('user.profile') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <h4 style="color: white">-</h4>
                                        <p>profile</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('user.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>My orders</p>
                                        <h4 style="color: white">{{ $totalOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Pending orders</p>
                                        <h4 style="color: white">{{ $pendingOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Compeleted orders</p>
                                        <h4 style="color: white">{{ $completedOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('user.review.index') }}">
                                        <i class="fas fa-star"></i>
                                        <h4 style="color: white">{{ $reviews }}</h4>
                                        <p>Reviews</p>
                                    </a>
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

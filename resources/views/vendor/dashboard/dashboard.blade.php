@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Dashboard
@endsection
@section('content')
    <!--=============================dashbaord ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- sidebar --}}
            @include('vendor.layouts.sidebar')
            {{-- end sidebar --}}
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3>Vendor dashboard</h3>
                    <br>
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Total sales</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $totalSales }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Today's sales</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $todaySales }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>This month sales</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $thisMonthSales }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>This year sales</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $thisYearSales }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('vendor.products.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>All products</p>
                                        <h4 style="color: white">{{ $allProducts }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Today's orders</p>
                                        <h4 style="color: white">{{ $todayOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Today's pending orders</p>
                                        <h4 style="color: white">{{ $todayPendingOrders }}</h4>

                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>all pending orders</p>
                                        <h4 style="color: white">{{ $totalPendingOrders }}</h4>

                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>All orders</p>
                                        <h4 style="color: white">{{ $totalOrders }}</h4>

                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>All completed orders</p>
                                        <h4 style="color: white">{{ $totalCompletedOrders }}</h4>

                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="{{ route('vendor.reviews.index') }}">
                                        <i class="fas fa-star"></i>
                                        <p>Customer review</p>
                                        <h4 style="color: white">{{ $reviews }}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================end dashboard=============================-->
@endsection

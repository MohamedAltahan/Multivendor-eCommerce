@extends('admin.layouts.master')
@section('mainTitle', 'Dashboard')
@section('content')


    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today's orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todayOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today's pending orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $todayPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All pending orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $allPendingOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All completed orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $allCompletedOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-window-close"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All canceled orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $allCanceledOrders }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today sales</h4>
                        </div>
                        <div class="card-body">
                            {{ $setting->currency }} {{ $todaySales }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This month sales</h4>
                        </div>
                        <div class="card-body">
                            {{ $setting->currency }} {{ $thisMonthSales }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.order.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This year sales</h4>
                        </div>
                        <div class="card-body">
                            {{ $setting->currency }} {{ $thisYearSales }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.reviews.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All reviews</h4>
                        </div>
                        <div class="card-body">
                            {{ $allReviews }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.customers.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All users</h4>
                        </div>
                        <div class="card-body">
                            {{ $allUsers }}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{ route('admin.vendors.index') }}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All vendors</h4>
                        </div>
                        <div class="card-body">
                            {{ $allVendors }}
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>

@endsection

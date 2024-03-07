@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Withdraw
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Withdraw requests</h3>
                        <br>
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Current balance</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $vendorCurrentBalance }} </h4>
                                    </a>
                                </div>
                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Total withdraw</p>
                                        <h4 style="color: white">{{ $setting->currency }}{{ $vendorTotalWithdraw }} </h4>
                                    </a>
                                </div>
                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item red" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Pending amount</p>
                                        <h4 style="color: white">{{ $setting->currency }} {{ $vendorPendingAmount }} </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <a href="{{ route('vendor.withdraw.create') }}" class="btn btn-primary">+Create request</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{ $dataTable->table() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script></script>
    @endpush
@endsection

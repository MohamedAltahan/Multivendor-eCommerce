@extends('frontend.dashboard.layouts.master')
@section('title')
    {{ $setting->site_name }} - {{ __('Reviews') }}
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>{{ __('All reviews') }}</h3>

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

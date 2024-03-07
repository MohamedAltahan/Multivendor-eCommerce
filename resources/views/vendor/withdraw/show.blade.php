@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Create withdraw request
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i> Create withdraw request</h3>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area col-md-5 my-1 mx-1">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Withdraw method</b></td>
                                        <td>{{ $request->method }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total requested amount </b></td>
                                        <td>{{ $setting->currency }} {{ $request->total_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Withdraw charge </b></td>
                                        <td>{{ $setting->currency }} {{ $request->withdraw_charge }}</td>
                                    </tr>
                                    <tr>
                                        <td><b> Net withdraw amount </b></td>
                                        <td>{{ $setting->currency }} {{ $request->withdraw_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td><b> Status </b></td>
                                        <td>
                                            @if ($request->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($request->status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Account information </b></td>
                                        <td>{{ $request->account_info }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
@endsection
@push('scripts')
@endpush

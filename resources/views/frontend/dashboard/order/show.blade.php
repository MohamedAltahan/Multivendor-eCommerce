@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);

@endphp
@extends('frontend.dashboard.layouts.master')
@section('title')
    {{ $setting->site_name }} - Details
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>{{ __('Details') }}</h3>
                    <!--============================ INVOICE PAGE START ==============================-->
                    <section class="invoice-print">
                        <div class="wsus__invoice_area">
                            <div class="wsus__invoice_header">
                                <div class="wsus__invoice_content">
                                    <div class="row">
                                        <div class="col-md-6 mb-5 mb-md-0">
                                            <div class="wsus__invoice_single">
                                                <h5>{{ __('Shipping info') }}</h5>
                                                <h6>{{ $address->name }}</h6>
                                                <p>{{ $address->email }}</p>
                                                <p>{{ $address->phone }}</p>
                                                <p>{{ $address->address }}, {{ $address->state }}, {{ $address->city }},
                                                    {{ $address->zip_code }}</p>
                                                <p>{{ $address->country }}</p>

                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="wsus__invoice_single text-md-end">
                                                <h5>{{ __('Order id') }} : # {{ $order->invoice_id }}</h5>
                                                <h6>{{ __('Order status') }} : {{ $order->order_status }}</h6>
                                                <p>{{ __('Payment method') }} : {{ $order->payment_method }}</p>
                                                <p>{{ __('Payment status') }} : {{ $order->payment_status }}</p>
                                                <p>{{ __('Transaction id') }} : {{ @$order->transaction->transaction_id }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__invoice_description">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>

                                                <th class="name">
                                                    {{ __('product') }}

                                                </th>
                                                <th class="amount">
                                                    {{ __('Shop name') }}
                                                </th>
                                                <th class="amount">
                                                    {{ __('Unit price') }}
                                                </th>
                                                <th class="quentity">
                                                    {{ __('Quentity') }}
                                                </th>
                                                <th class="total">
                                                    {{ __('Total') }}
                                                </th>
                                            </tr>

                                            @foreach ($order->orderProducts as $product)
                                                @php
                                                    $variants = json_decode($product->variants);
                                                @endphp
                                                <tr>
                                                    <td class="name">
                                                        <p>{{ $product->product_name }}</p>
                                                        @foreach ($variants as $key => $variant)
                                                            <span>{{ $key }} : {{ $variant->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="amount">
                                                        {{ $product->vendor->shop_name }}
                                                    </td>
                                                    <td class="amount">
                                                        {{ $setting->currency }}{{ $product->unit_price }}
                                                    </td>

                                                    <td class="quentity">
                                                        {{ $product->qty }}
                                                    </td>
                                                    <td class="total">
                                                        {{ $setting->currency }}{{ $product->unit_price * $product->qty }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__invoice_footer">
                                <p><span>{{ __('Sub total') }} :</span>{{ $setting->currency }}{{ $order->sub_total }}
                                </p>
                                <p><span>{{ __('Shipping cost(+)') }}
                                        :</span>{{ $setting->currency }}{{ @$shipping->cost }} </p>
                                <p><span>{{ __('coupon(-)') }}
                                        :</span>{{ $setting->currency }}{{ @$coupon->discount_value ?: 0 }} </p>
                                <p><span>{{ __('Total Amount') }}
                                        :</span>{{ $setting->currency }}{{ $order->final_total }} </p>
                            </div>
                        </div>

                    </section>
                    <!--============================= INVOICE PAGE END ================================-->
                    <div class="col-md-8">
                        <div class="mt-2 text-start">
                            <button class="btn btn-warning print-invoice">{{ __('Print') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
@endsection
@push('scripts')
    <script>
        //print invoice==============================================================================
        $('.print-invoice').on('click', function() {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(printBody.html());
            window.print();
            $('body').html(originalContents);
        })
    </script>
@endpush

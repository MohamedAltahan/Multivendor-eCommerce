@php
    $address = json_decode($order->order_address);

@endphp
@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Details
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Details</h3>
                    <!--============================ INVOICE PAGE START ==============================-->
                    <section class="invoice-print">
                        <div class="wsus__invoice_area">
                            <div class="wsus__invoice_header">
                                <div class="wsus__invoice_content">
                                    <div class="row">
                                        <div class="col-md-6 mb-5 mb-md-0">
                                            <div class="wsus__invoice_single">
                                                <h5>Shipping info</h5>
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
                                                <h5>Order id: # {{ $order->invoice_id }}</h5>
                                                <h6>Order status: {{ $order->order_status }}</h6>
                                                <p>Payment method: {{ $order->payment_method }}</p>
                                                <p>Payment status: {{ $order->payment_status }}</p>
                                                <p>Transaction id: {{ @$order->transaction->transaction_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__invoice_description">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>

                                                <th class="name">
                                                    product

                                                </th>
                                                <th class="amount">
                                                    Shop name
                                                </th>
                                                <th class="amount">
                                                    Unit price
                                                </th>
                                                <th class="quentity">
                                                    quentity
                                                </th>
                                                <th class="total">
                                                    total
                                                </th>
                                            </tr>

                                            @foreach ($order->orderProducts as $product)
                                                @if ($product->vendor_id == Auth::user()->id)
                                                    @php
                                                        $variants = json_decode($product->variants);
                                                        $total = 0;
                                                        $total += $product->unit_price * $product->qty;
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
                                                @endif
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__invoice_footer">
                                <p><span>Total Amount:</span>{{ $setting->currency }} {{ $total }}</p>
                            </div>
                        </div>

                    </section>
                    <!--============================= INVOICE PAGE END ================================-->
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <form action="{{ route('vendor.orders.status', $order->id) }}">
                                <div class="form-group ">
                                    <label for="" class="mb-2">Order Status</label>
                                    <select name="status" id="" class="form-control">
                                        @foreach (config('order_status.order_status_vendor') as $key => $status)
                                            <option @selected($order->order_status == $key) value="{{ $key }}">
                                                {{ $status['status'] }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-8">
                            <div class="mt-2 text-end">
                                <button class="btn btn-warning print-invoice">Print</button>
                            </div>
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

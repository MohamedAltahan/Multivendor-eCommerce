@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp
@extends('admin.layouts.master')
@section('mainTitle', 'Orders')
@section('content')
    <div class="card-header">
        <h4>Order details</h4>
    </div>

    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2>
                        <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-6 text-md-left">
                            <address>
                                <strong>Shipped To:</strong><br>
                                <b>Name: </b> {{ $address->name }}<br>
                                <b>email: </b> {{ $address->email }}<br>
                                <b>phone: </b> {{ $address->phone }}<br>
                                <b>Address: </b> {{ $address->address }}<br>
                                {{ $address->state }}, {{ $address->city }}, {{ $address->zip_code }}<br>
                                {{ $address->country }}
                            </address>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Payment Information:</strong><br>
                                <b>Method:</b> {{ $order->payment_method }}<br>
                                <b>Transaction Id:</b> {{ @$order->transaction->transaction_id }}<br>
                                <b>Status:</b> {{ $order->payment_status }}<br>

                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ date('d F, Y', strtotime($order->created_at)) }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th data-width="40">#</th>
                                <th>Item</th>
                                <th>Variant</th>
                                <th>Shop name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Totals</th>
                            </tr>
                            @foreach ($order->orderProducts as $product)
                                @php
                                    $variants = json_decode($product->variants);
                                @endphp
                                <tr>
                                    <td>{{ ++$loop->index }}</td>

                                    <td> <a target="_blank"
                                            href="{{ route('show-product-details', $product->product->slug) }}">
                                            {{ $product->product_name }}
                                        </a></td>
                                    <td>

                                        @foreach ($variants as $key => $variant)
                                            <b>{{ $key }}: </b>{{ $variant->name }},
                                        @endforeach
                                    </td>
                                    <td>{{ $product->vendor->shop_name }}</td>
                                    <td class="text-center">{{ $setting->currency }}{{ $product->unit_price }}</td>
                                    <td class="text-center">{{ $product->qty }}</td>
                                    <td class="text-right">{{ $product->qty * $product->unit_price }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="row mt-4">

                        <div class="col-lg-4 text-left">
                            <div class="invoice-detail-item">
                                <b>Subtotal : </b>
                                <span>{{ $setting->currency }}{{ $order->sub_total }}</span>
                            </div>
                            <div class="invoice-detail-item">
                                <b>Coupon discount(-) : </b>
                                <span>{{ $setting->currency }}{{ @$coupon->discount_value }}
                                </span>
                            </div>
                            <div class="invoice-detail-item">
                                <b>Shipping(+) : </b>
                                <span>{{ $setting->currency }}{{ @$shipping->cost }}</span>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <h3>{{ $setting->currency }}{{ $order->final_total }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group text-left">
                                <label for="">Order Status</label>
                                <select name="order_status" id="order_status" data-id="{{ $order->id }}"
                                    class="form-control">
                                    @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                        <option @selected($order->order_status == $key) value="{{ $key }}">
                                            {{ $orderStatus['status'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group text-left">
                                <label for="">Payment Status</label>
                                <select name="order_status" id="payment_status" data-id="{{ $order->id }}"
                                    class="form-control">
                                    <option @selected($order->payment_status == 'pending') value="pending">Pending</option>
                                    <option @selected($order->payment_status == 'completed') value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-md-right">
            <button class="btn btn-warning btn-icon icon-left print-invoice"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            //change order status=================================================================
            $('#order_status').on('change', function() {
                let status = $(this).val();
                let orderId = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status,
                        orderId,
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            //change payment status=================================================================
            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let orderId = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status,
                        orderId,
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            //print invoice==============================================================================
            $('.print-invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());
                window.print();
                $('body').html(originalContents);
            })
        })
    </script>
@endpush

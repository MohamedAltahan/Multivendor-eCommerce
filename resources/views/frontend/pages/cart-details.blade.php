@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - Cart Details
@endsection
@section('content')
    <!--============================ BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END ==============================-->


    <!--============================ CART VIEW PAGE START  ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Unit Price
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class=" wsus__pro_select">
                                            Total
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @forelse ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img">
                                                <img src="{{ asset('uploads/' . $item->options->image) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>
                                            <td class="wsus__pro_name">
                                                <h6 style="color: rgb(56, 56, 255)">{!! $item->name !!}</h6>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }} : {{ $variant['name'] }} </span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ $setting->currency . $item->price }}</h6>
                                            </td>


                                            <td class="wsus__pro_select">
                                                <div class="product-qty-wrapper">
                                                    <button class="btn btn-danger qty-decrement">-</button>
                                                    <input class="form-control input-cart-qty" type="text"
                                                        data-rowid="{{ $item->rowId }}" min="1"max="100"
                                                        value="{{ $item->qty }}" />
                                                    <button class="btn btn-success qty-increment">+</button>
                                                </div>
                                            </td>


                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $setting->currency . $item->price * $item->qty }}</h6>
                                            </td>
                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('remove-cart-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" style="width: 100%">
                                                Cart is empty!
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================CART VIEW PAGE END ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            //decrement cart quantity ===============================================================
            $('.qty-increment').on('click', function() {
                let input = $(this).siblings('.input-cart-qty')
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid')
                input.val(quantity);
                updateCartQty(rowId, quantity)
            })

            //decrement  cart quantity ===============================================================
            $('.qty-decrement').on('click', function() {
                let input = $(this).siblings('.input-cart-qty')
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid')
                if (quantity < 1) {
                    quentity = 1;
                }
                input.val(quantity);
                updateCartQty(rowId, quantity)
            })

            // clear cart =============================================================================
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This will clear you cart",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear-cart') }}",
                            cache: false,
                            success: function(data) {
                                if (data.status == 'success') {
                                    window.location.reload();
                                }

                            },
                            error: function(xhn, status, error) {}
                        })
                    }
                })
            })

            // update cart quantity====================================================================
            function updateCartQty(rowId, quantity) {
                $.ajax({
                    url: "{{ route('cart-update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId,
                        quantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status == 'success') {
                            let totalPriceInput = $('#' + rowId).text(
                                "{{ $setting->currency }}" + data.totalPrice);
                            toastr.success(data.message);
                        }
                    },
                    erorr: function(data) {}
                })
            }

            // ==========================================================================

        })
    </script>
@endpush

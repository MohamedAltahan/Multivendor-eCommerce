@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - Vendor products
@endsection
@section('content')
    <!--============================  BREADCRUMB STAR ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>vendor products</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="#">peoduct</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================  BREADCRUMB END ==============================-->


    <!--============================ PRODUCT PAGE START ==============================-->
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset('uploads/' . $vendor->banner) }}" alt="banner" class="img-fluid w-50 ">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{ $vendor->shop_name }}</h4>
                                <p class="wsus__vendor_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </p>
                                <a href="callto:+962555544411"><i class="far fa-phone-alt"></i> {{ $vendor->phone }}</a>
                                <a href="mailto:example@gmail.com"><i class="far fa-envelope"></i> {{ $vendor->email }}</a>
                                <p class="wsus__vendor_location"><i class="fal fa-map-marker-alt"></i>
                                    {{ $vendor->address }}</p>
                                <ul class="d-flex">
                                    <li><a class="facebook" href="{{ $vendor->fb_link }}"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="{{ $vendor->tw_link }}"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li><a class="instagram" href="{{ $vendor->insta_link }}"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-lg-12">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button
                                            class="nav-link list-view {{ !session()->get('product_list_style') ? 'active' : '' }} {{ session()->get('product_list_style') == 'grid' ? 'active' : '' }}"
                                            data-id='grid' id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button
                                            class="nav-link list-view {{ session()->get('product_list_style') == 'list' ? 'active' : '' }}"
                                            data-id='list' id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            {{-- view products as grid========================================== --}}
                            <div class="tab-pane fade {{ !session()->get('product_list_style') ? 'show active' : '' }} {{ session()->get('product_list_style') == 'grid' ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-3  col-sm-6">
                                            <div class="wsus__product_item">
                                                <span class="wsus__new">{{ $product->product_type }}</span>
                                                @if (checkDiscount($product))
                                                    <span class="wsus__minus">
                                                        -{{ calcDiscountPercentage($product->price, $product->offer_price) }}%
                                                    </span>
                                                @endif

                                                <a class="wsus__pro_link"
                                                    href="{{ route('show-product-details', $product->slug) }}">
                                                    <img src="{{ asset('uploads/' . @$product->firstImage->name) }}"
                                                        alt="product" class="img-fluid w-100 img_1" />
                                                </a>

                                                <ul class="wsus__single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"><i class="far fa-eye"></i></a>
                                                    </li>
                                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">{{ $product->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <span>(133 review)</span>
                                                    </p>
                                                    <a class="wsus__pro_name"
                                                        href="{{ route('show-product-details', $product->slug) }}">{{ limitText($product->name, 50) }}</a>

                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price"><span
                                                                class="currency_color">{{ $setting->currency }}</span>{{ $product->offer_price }}
                                                            <del>{{ $setting->currency }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price"><span
                                                                class="currency_color">{{ $setting->currency }}</span>{{ $product->price }}
                                                        </p>
                                                    @endif

                                                    <a class="add_cart" href="#">add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($products) == 0)
                                    <div class="text-center mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2>No products found!</h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- view products as rows========================================== --}}
                            <div class="tab-pane fade {{ session()->get('product_list_style') == 'list' ? 'show active' : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <span class="wsus__new">{{ $product->product_type }}</span>
                                                <span class="wsus__minus">
                                                    -{{ calcDiscountPercentage($product->price, $product->offer_price) }}%
                                                </span>
                                                <a class="wsus__pro_link"
                                                    href="{{ route('show-product-details', $product->slug) }}">
                                                    <img src="{{ asset('uploads/' . @$product->firstImage->name) }}"
                                                        alt="product" class="img-fluid w-100 img_1" />

                                                </a>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                        href="#">{{ $product->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <span>(17 review)</span>
                                                    </p>
                                                    <a class="wsus__pro_name"
                                                        href="{{ route('show-product-details', $product->slug) }}">{{ $product->name }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price"><span
                                                                class="currency_color">{{ $setting->currency }}</span>{{ $product->offer_price }}
                                                            <del>{{ $setting->currency }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price"><span
                                                                class="currency_color">{{ $setting->currency }}</span>{{ $product->price }}
                                                        </p>
                                                    @endif
                                                    <p class="list_description">{{ $product->short_description }}</p>
                                                    <ul class="wsus__single_pro_icon">
                                                        <li><a class="add_cart" href="#">add to cart</a>
                                                        </li>
                                                        <li><a href="#"><i class="far fa-heart"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="far fa-random"></i></a>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($products) == 0)
                                    <div class="text-center mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2>No products found!</h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="mt-4 d-flex justify-content-center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================ PRODUCT PAGE END ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.list-view').on('click', function() {
                let style = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('change-product-list-view') }}",
                    data: {
                        style
                    },
                    success: function(data) {

                    },
                    error: function(data) {

                    }
                })
            })
        })
        @php
            if (request()->has('range') && request()->range != '') {
                $price = explode(';', request()->range);
                $startPrice = $price[0];
                $endPrice = $price[1];
            } else {
                $startPrice = 0;
                $endPrice = 8000;
            }
        @endphp
        //*==========PRICE SLIDER=========
        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 10000,
                step: 100,
                values: ["{{ $startPrice }}", "{{ $endPrice }}"],
                range: true,
                einheit: "{{ $setting->currency }}",
            });
        });
    </script>
@endpush

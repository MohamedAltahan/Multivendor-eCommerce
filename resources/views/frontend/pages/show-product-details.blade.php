@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - Product Details
@endsection
@section('content')
    <!--============================BREADCRUMB START ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">product</a></li>
                            <li><a href="#">product details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================ BREADCRUMB END==============================-->

    <!--============================ PRODUCT DETAILS START==============================-->
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 999">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if (isset($product->video_link))
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->images as $image)
                                            <li><img class="zoom img-fluid w-100"
                                                    src="{{ asset('uploads/' . $image->name) }}" alt="product"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-md-8 col-lg-8">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="javascrip:;">{{ $product->name }}</a>
                            @if ($product->quantity > 0)
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span>
                                    ({{ $product->quantity }} item in stock)</p>
                            @elseif($product->quantity == 0)
                                <p class="wsus__stock_area"><span class="in_stock">out of stock</span>
                                    ({{ $product->quantity }} item in stock)</p>
                            @endif
                            @if (checkDiscount($product))
                                <h4><span class="currency_color">{{ $setting->currency }}</span>{{ $product->offer_price }}
                                    <del>{{ $setting->currency }}</>{{ $product->price }}</del>
                                </h4>
                            @else
                                <h4><span class="currency_color">{{ $setting->currency }}</span>{{ $product->price }}
                                </h4>
                            @endif
                            <p class="review">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->reviews_avg_rating))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span>{{ count($product->reviews) }} review</span>
                            </p>
                            <p class="description">{!! $product->short_description !!}</p>
                            <div class="wsus_pro_hot_deals">
                                <h5>offer ending time: : </h5>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                            {{-- submit using ajax in scripts file --}}
                            <form class="shopping-cart-form" action="">
                                <input type="hidden" name='submit_source' value="details_page">
                                <div class="wsus__selectbox">
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->variants()->where('status', 'active')->get()->groupBy('product_variant_type_id') as $key => $variants)
                                            <div class="col-md-5 my-1 mx-1 form-group">
                                                @php
                                                    $variantTypeName = \App\Models\ProductVariantType::where(
                                                        'id',
                                                        $key,
                                                    )->value('name');
                                                @endphp
                                                <div class="mb-2">select {{ $variantTypeName }} :</div>
                                                <select class="form-select" name="variants_id[]">
                                                    {{-- using relation values --}}
                                                    @foreach ($variants as $variant)
                                                        <option value="{{ $variant->id }}">
                                                            {{ $variant->values->variant_value }}
                                                            (+{{ $setting->currency . $variant->variant_price }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="wsus__quentity">
                                    <h5>quentity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="quantity" type="text" min="1"
                                            max="100" value="1" />
                                    </div>
                                </div>

                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart">add to cart</button></li>
                                    <li>
                                        <button title="Send message to vendor" style="border-radius: 50%" type="button"
                                            class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="fas fa-envelope-square"></i>
                                        </button>
                                    </li>
                                </ul>
                            </form>

                            <p class="brand_model"><span>brand :</span> {{ @$product->brand->name }}</p>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                {!! $product->long_description !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- vendor tab =========================================================== --}}
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset('uploads/' . $product->vendor->banner) }}"
                                                        alt="vendor" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->user->name }}</h4>
                                                    <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>({{ count($product->reviews) }} review)</span>
                                                    </p>
                                                    <p><span>Store Name:</span>{{ $product->vendor->shop_name }}</p>
                                                    <p><span>Address:</span>{{ $product->vendor->address }}</p>
                                                    <p><span>Phone:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>mail:</span>{{ $product->vendor->email }}</p>
                                                    <p>{!! $product->vendor->description !!}</p>
                                                    <a href="{{ route('vendor-products', $product->vendor->id) }}"
                                                        class="see_btn">visit store</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- review tab =========================================================== --}}
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>{{ count($reviews) }}</span></h4>
                                                        @foreach ($reviews as $review)
                                                            <div class="wsus__main_comment">

                                                                <div class="wsus__comment_text reply">
                                                                    <h6> {{ $review->user->name }}<span>{{ $review->rating }}
                                                                            <i class="fas fa-star"></i></span></h6>
                                                                    <span>{{ date('d M Y', strtotime($review->created_at)) }}</span>
                                                                    <p>{{ $review->review }} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="mt-5">
                                                            @if ($reviews->hasPages())
                                                                {{ $reviews->links() }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    @php
                                                        $isBrought = false;
                                                        $orders = App\Models\Order::where([
                                                            'user_id' => @auth()->user()->id,
                                                            'order_status' => 'delivered',
                                                        ])->get();
                                                        foreach ($orders as $key => $order) {
                                                            $isExist = $order
                                                                ->orderProducts()
                                                                ->where('product_id', $product->id)
                                                                ->first();
                                                            if ($isExist) {
                                                                $isBrought = true;
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($isBrought)
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4>write a Review</h4>
                                                            <form action="{{ route('user.review.create') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <p class="rating">
                                                                    <span>select your rating : </span>
                                                                </p>
                                                                <div class="row">

                                                                    <div class="col-xl-12 mb-4">
                                                                        <div class="wsus__single_com">
                                                                            <select name="rating" class="form-select"
                                                                                id="">
                                                                                <option value="">select rating
                                                                                </option>
                                                                                <option value="1">1 Star</option>
                                                                                <option value="2">2 Star</option>
                                                                                <option value="3">3 Star</option>
                                                                                <option value="4">4 Star</option>
                                                                                <option value="5">5 Star</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="col-xl-12">
                                                                            <div class="wsus__single_com">
                                                                                <textarea name="review" cols="3" rows="3" placeholder="Write your review"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <x-form.input type='hidden' name='product_id'
                                                                        value="{{ $product->id }}" />
                                                                    <x-form.input type='hidden' name='vendor_id'
                                                                        value="{{ $product->vendor_id }}" />
                                                                </div>
                                                                <button class="common_btn mt-3" type="submit">submit
                                                                    review</button>
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--============================PRODUCT DETAILS END==============================-->
    <!--==========================send message to vendor modal===========================-->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send message to vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="message_modal">
                        @csrf
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea name="message" class="form-control message-box"></textarea>
                            <input type="hidden" name="receiver_id" value="{{ $product->vendor->user_id }}">
                        </div>
                        <button type="submit" class="btn btn-primary send-button my-2 ">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--================================================================ ===========================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            simplyCountdown(".simply-countdown-one", {
                year: {{ date('Y', strtotime($flashSaleDate->end_flash_date)) }}, //2022
                month: {{ date('m', strtotime($flashSaleDate->end_flash_date)) }}, //2
                day: {{ date('d', strtotime($flashSaleDate->end_flash_date)) }}, //5
                // enableUtc: true,
            });

            $('.message_modal').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('user.send-message') }}',
                    data: formData,
                    beforeSend: function() {
                        let html =
                            `<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Sending...`

                        $('.send-button').html(html);
                        $('.send-button').prop('disabled', true);

                    },
                    success: function(response) {
                        $('.message-box').val('');
                        $('.modal-body').append(
                            `<div class="alert alert-success mt-2"><a href="{{ route('user.messages.index') }}" class="text-primary">Click here</a> for go to messenger.</div>`
                        )
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                        $('.send-button').html('Send');
                        $('.send-button').prop('disabled', false);
                    },
                    complete: function() {
                        $('.send-button').html('Send');
                        $('.send-button').prop('disabled', false);
                    }
                })
            })
        })
    </script>
@endpush

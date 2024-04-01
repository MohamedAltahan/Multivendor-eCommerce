    <!--============================ HOT DEALS START==============================-->
    <section id="wsus__hot_deals" class="wsus__hot_deals_2">
        <div class="container">

            <div class="wsus__hot_large_item">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header justify-content-start">
                            <div class="monthly_top_filter2 mb-1">
                                <button class="active auto_click" data-filter=".new">New Arival</button>
                                <button data-filter=".featured">Featured</button>
                                <button data-filter=".top">Top Products</button>
                                <button data-filter=".best">Best Products</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row grid2">
                    @foreach ($typebasedProducts as $key => $products)
                        @foreach ($products as $product)
                            <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">
                                <div class="wsus__product_item">
                                    <span class="wsus__new">{{ $product->product_type }}</span>
                                    @if (checkDiscount($product))
                                        <span
                                            class="wsus__minus">-{{ calcDiscountPercentage($product->price, $product->offer_price) }}%
                                        </span>
                                    @endif
                                    <a class="wsus__pro_link"
                                        href="{{ route('show-product-details', $product->slug) }}">

                                        <img src="{{ asset('uploads/' . @$product->images()->pluck('name')[0]) }}"
                                            alt="product" class="img-fluid w-100 img_1" />
                                        {{-- if there is no second image preview the same image as a second --}}
                                        @if ($product->images()->pluck('name')->count() == 1)
                                            <img src="{{ asset('uploads/' . @$product->images()->pluck('name')[0]) }}"
                                                alt="product" class="img-fluid w-100 img_2" />
                                            {{-- if no image preview the default image --}}
                                        @elseif ($product->images()->pluck('name')->count() == 0)
                                            <img src="{{ asset('uploads/' . @$product->images()->pluck('name')[0]) }}"
                                                alt="product" class="img-fluid w-100 img_1" />
                                        @else
                                            <img src="{{ asset('uploads/' . @$product->images()->pluck('name')[1]) }}"
                                                alt="product" class="img-fluid w-100 img_2" />
                                        @endif
                                    </a>
                                    <ul class="wsus__single_pro_icon">
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="far fa-eye"></i></a></li>
                                        <li><a href="#"><i class="far fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a>
                                    </ul>
                                    <div class="wsus__product_details">
                                        <a class="wsus__category" href="#">Electronics </a>
                                        <p class="wsus__pro_rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>(1333333333333333 review)</span>
                                        </p>
                                        <a class="wsus__pro_name"
                                            href="{{ route('show-product-details', $product->slug) }}">{{ $product->name }}</a>

                                        @if (checkDiscount($product))
                                            <p class="wsus__price">
                                                <span
                                                    class="currency_color">{{ $setting->currency }}</span>{{ $product->offer_price }}
                                                <del>{{ $setting->currency }}{{ $product->price }}</del>
                                            </p>
                                        @else
                                            <p class="wsus__price"><span
                                                    class="currency_color">{{ $setting->currency }}</span>{{ $product->price }}
                                            </p>
                                        @endif

                                        {{-- <form class="shopping-cart-form" action="">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    @foreach ($product->variants()->get()->groupBy('product_variant_type_id') as $key => $variant)
                                        <select class="d-none" name="variants_id[]">
                                 @foreach ($variant->values()->where('product_id', $product->id)->get() as $value)
                                                <option value="{{ $value->id }}">{{ $value->variant_value }}
                                                    (+{{ $setting->currency . $value->price }})
                                                </option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                    <button type="submit" class="add_cart" href="#">add to cart</button>
                                </form> --}}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </div>

            <section id="wsus__single_banner" class="home_2_single_banner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="wsus__single_banner_content banner_1">
                                <div class="wsus__single_banner_img">
                                    <img src="images/single_banner_44.jpg" alt="banner" class="img-fluid w-100">
                                </div>
                                <div class="wsus__single_banner_text">
                                    <h6>sell on <span>35% off</span></h6>
                                    <h3>smart watch</h3>
                                    <a class="shop_btn" href="#">shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <div class="wsus__single_banner_img">
                                            <img src="images/single_banner_55.jpg" alt="banner"
                                                class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            <h6>New Collection</h6>
                                            <h3>kid's fashion</h3>
                                            <a class="shop_btn" href="#">shop now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-lg-4">
                                    <div class="wsus__single_banner_content">
                                        <div class="wsus__single_banner_img">
                                            <img src="images/single_banner_66.jpg" alt="banner"
                                                class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            <h6>sell on <span>42% off</span></h6>
                                            <h3>winter collection</h3>
                                            <a class="shop_btn" href="#">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </section>
    <!--============================HOT DEALS END==============================-->

    <!--============================FLASH SELL START==============================-->
    <section id="wsus__flash_sell" class="wsus__flash_sell_2">
        <div class=" container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }}">
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">flash sale</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="{{ route('flash-sale') }}">see more <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                @foreach ($flashSaleProducts as $product)
                    {{-- @dd($product->product->images()->pluck('name')); --}}
                    <div class="col-xl-3 col-sm-6 col-lg-4">
                        <div class="wsus__product_item">
                            <span class="wsus__new">{{ $product->product->product_type }}</span>
                            @if (checkDiscount($product->product))
                                <span
                                    class="wsus__minus">-{{ calcDiscountPercentage($product->product->price, $product->product->offer_price) }}%
                                </span>
                            @endif
                            <a class="wsus__pro_link"
                                href="{{ route('show-product-details', $product->product->slug) }}">

                                <img src="{{ asset('uploads/' . @$product->product->images()->pluck('name')[0]) }}"
                                    alt="product" class="img-fluid w-100 img_1" />
                                {{-- if there is no second image preview the same image as a second --}}
                                @if ($product->product->images()->pluck('name')->count() == 1)
                                    <img src="{{ asset('uploads/' . @$product->product->images()->pluck('name')[0]) }}"
                                        alt="product" class="img-fluid w-100 img_2" />
                                    {{-- if no image preview the default image --}}
                                @elseif ($product->product->images()->pluck('name')->count() == 0)
                                    <img src="{{ asset('uploads/' . @$product->product->images()->pluck('name')[0]) }}"
                                        alt="product" class="img-fluid w-100 img_1" />
                                @else
                                    <img src="{{ asset('uploads/' . @$product->product->images()->pluck('name')[1]) }}"
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
                                    <span>(133 review)</span>
                                </p>
                                <a class="wsus__pro_name"
                                    href="{{ route('show-product-details', $product->product->slug) }}">{{ $product->product->name }}</a>

                                @if (checkDiscount($product->product))
                                    <p class="wsus__price">
                                        <span
                                            class="currency_color">{{ $setting->currency }}</span>{{ $product->product->offer_price }}
                                        <del>{{ $setting->currency }}{{ $product->product->price }}</del>
                                    </p>
                                @else
                                    <p class="wsus__price"><span
                                            class="currency_color">{{ $setting->currency }}</span>{{ $product->product->price }}
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
            </div>
        </div>
    </section>
    <!--============================ FLASH SELL END ==============================-->
    @push('scripts')
        <script>
            $(document).ready(function() {
                simplyCountdown(".simply-countdown-one", {
                    year: {{ date('Y', strtotime(@$flashSaleDate->end_flash_date)) }}, //2022
                    month: {{ date('m', strtotime(@$flashSaleDate->end_flash_date)) }}, //2
                    day: {{ date('d', strtotime(@$flashSaleDate->end_flash_date)) }}, //5
                });
            });
        </script>
    @endpush

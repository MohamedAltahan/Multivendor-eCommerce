@php
    $productsSliderTwo = json_decode($productsSliderTwo->value);
    $lastKey = [];
    foreach ($productsSliderTwo as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    if (array_keys($lastKey)[0] == 'main_category') {
        $category = App\Models\Category::find($lastKey['main_category']);
        $products = App\Models\Product::where('category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $category = App\Models\SubCategory::find($lastKey['sub_category']);
        $products = App\Models\Product::where('sub_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } else {
        $category = App\Models\ChildCategory::find($lastKey['child_category']);
        $products = App\Models\Product::where('child_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    }
@endphp
<!--============================ ELECTRONIC PART START  ==============================-->
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                    <a class="see_btn" href="{{ route('products.index', ['category' => $category->slug]) }}">see more <i
                            class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
                @php
                    $productImage = App\Models\ProductImages::where('product_key', $product->product_key)->first()
                        ?->name;
                @endphp
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">{{ $product->product_type }}</span>
                        @if (checkDiscount($product->product))
                            <span
                                class="wsus__minus">-{{ calcDiscountPercentage($product->price, $product->offer_price) }}%
                            </span>
                        @endif
                        <a class="wsus__pro_link" href="{{ route('show-product-details', $product->slug) }}">

                            <img src="{{ asset('uploads/' . @$product->images()->pluck('name')[0]) }}" alt="product"
                                class="img-fluid w-100 img_1" />
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
                                <span>(133 review)</span>
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
        </div>
    </div>
</section>
<!--============================ELECTRONIC PART END==============================-->

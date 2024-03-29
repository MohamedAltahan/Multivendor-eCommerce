@php
    $productsSliderThree = json_decode($productsSliderThree->value);
    $lastKey = [];
    foreach ($productsSliderThree as $key => $category) {
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
<!--============================WEEKLY BEST ITEM START==============================-->
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                </div>
                <div class="row weekly_best2">
                    @foreach ($products as $item)
                        @php
                            $productImage = App\Models\ProductImages::where('product_key', $item->product_key)->first()->name;
                        @endphp
                        <div class="col-xl-2  col-sm-6 col-md-4 col-lg-3 ">
                            <a class="wsus__hot_deals__single" href="{{ route('show-product-details', $item->slug) }}">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="{{ asset('uploads/' . $productImage) }}" alt="bag"
                                        class="img-fluid w-100">
                                </div>
                                <div class="wsus__hot_deals__single_text">
                                    <h5>{!! limitText($item->name) !!}</h5>
                                    <p class="wsus__rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </p>
                                    @if (checkDiscount($item))
                                        <p class="wsus__tk">{{ $setting->currency }}{{ $item->offer_price }}
                                            <del>{{ $setting->currency }}{{ $item->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__tk">{{ $setting->currency }}{{ $item->price }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!--============================WEEKLY BEST ITEM END  ==============================-->

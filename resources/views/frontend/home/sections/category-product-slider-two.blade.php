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
                <div class="col-xl-4 col-sm-6">
                    @include('frontend.home.big-product-card')
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--============================ELECTRONIC PART END==============================-->

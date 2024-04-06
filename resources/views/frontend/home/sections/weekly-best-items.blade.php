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
<section id="wsus__electronic" class=" ">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                </div>
                <div class="row flash_sell_slider">
                    @foreach ($products as $product)
                        <div class="col-xl-4 col-sm-6">
                            @include('frontend.home.big-product-card')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================WEEKLY BEST ITEM END  ==============================-->

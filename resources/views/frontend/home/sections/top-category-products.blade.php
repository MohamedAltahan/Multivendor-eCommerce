    <!--============================     MONTHLY TOP PRODUCT START   ==============================-->
    @php
        $popularCategories = json_decode($popularCategories->value);
    @endphp
    <section id="wsus__monthly_top" class="wsus__monthly_top_2">
        <div class="container">
            <div class="row">
                @if ($banner1['banner1']['status'] == 'on')
                    <div class=" col-xl-12 col-lg-12">
                        <div class="wsus__monthly_top_banner">
                            <div class="wsus__monthly_top_banner_img">
                                <a href="{{ @$banner1['banner1']['url'] }}">
                                    <img class="img-fluid w-100"
                                        src="{{ asset('uploads/' . @$banner1['banner1']['banner']) }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header for_md">
                        <h3>Popular categories</h3>
                        <div class="monthly_top_filter">

                            @php
                                $products = [];
                            @endphp

                            @foreach ($popularCategories as $popularCategory)
                                @php
                                    $lastKey = [];
                                    foreach ($popularCategory as $key => $category) {
                                        if ($category == null) {
                                            break;
                                        }
                                        $lastKey = [$key => $category];
                                    }
                                    if (array_keys($lastKey)[0] == 'main_category') {
                                        $category = App\Models\Category::find($lastKey['main_category']);
                                        $products[] = App\Models\Product::where('category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    } elseif (array_keys($lastKey)[0] == 'sub_category') {
                                        $category = App\Models\SubCategory::find($lastKey['sub_category']);
                                        $products[] = App\Models\Product::where('sub_category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    } else {
                                        $category = App\Models\ChildCategory::find($lastKey['child_category']);
                                        $products[] = App\Models\Product::where('child_category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    }
                                @endphp

                                <button class="col-md-2 {{ $loop->index == 0 ? 'auto_click active' : '' }}"
                                    data-filter=".category-{{ $loop->index }}">{{ $category->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row grid">
                        @foreach ($products as $key => $productGroup)
                            @foreach ($productGroup as $product)
                                @include('frontend.home.small-product-card')
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================  MONTHLY TOP PRODUCT END   ==============================-->

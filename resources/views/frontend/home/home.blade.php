@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }}
@endsection
@section('content')
    {{-- banner-slider --------------------------- --}}
    @if (@$mainBanner == 'active')
        @include('frontend.home.sections.banner-slider')
    @endif
    {{-- end banner-slider --}}

    {{-- flash sale  ---------------------------- --}}
    @if (@$flashSale == 'active')
        @include('frontend.home.sections.flash-sale')
    @endif
    {{-- end flash sale  --}}

    {{-- advertisement banner1 --------------------- --}}
    @if (@$popularCategory == 'active')
        @include('frontend.home.sections.top-category-products')
    @endif
    {{-- end top category products --}}

    {{-- advertisement banner divided into two pices-------------------------- --}}
    @if (@$doubleBanner)
        @include('frontend.home.sections.single-banner')
    @endif
    {{-- end single banner --}}

    {{-- hot deals it works but need some modifications --}}
    {{-- @include('frontend.home.sections.hot-deals') --}}
    {{-- end hot deals --}}

    {{-- category-product-slider-one --------------------- --}}
    @if (@$singleCategorySliderOne)
        @include('frontend.home.sections.category-product-slider-one')
    @endif
    {{-- end category-product-slider-one --}}

    {{-- category-product-slider-two ------------------- --}}
    @if (@$singleCategorySliderTwo)
        @include('frontend.home.sections.category-product-slider-two')
    @endif
    {{-- end category-product-slider-two --}}

    {{-- weekly best items ------------------------- --}}
    @if (@$bestItem)
        @include('frontend.home.sections.weekly-best-items')
    @endif
    {{-- end weekly best items --}}

    {{-- brand-slider -------------------------- --}}

    @if (@$brandSlider)
        @include('frontend.home.sections.brand-slider')
    @endif
    {{-- end brand-slider --}}
@endsection

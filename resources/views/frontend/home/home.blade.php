@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }}
@endsection
@section('content')
    {{-- banner-slider --------------------------- --}}
    @if ($frontendSections->mainBanner == 'active')
        @include('frontend.home.sections.banner-slider')
    @endif
    {{-- end banner-slider --}}

    {{-- flash sale  ---------------------------- --}}
    @if ($frontendSections->flashSale == 'active')
        @include('frontend.home.sections.flash-sale')
    @endif
    {{-- end flash sale  --}}

    {{-- advertisement banner1 is above popular category--------------------- --}}
    @if ($frontendSections->popularCategory == 'active')
        @include('frontend.home.sections.top-category-products')
    @endif
    {{-- end top category products --}}

    {{-- advertisement banner divided into two pices-------------------------- --}}
    @if ($frontendSections->doubleBanner == 'active')
        @include('frontend.home.sections.single-banner')
    @endif
    {{-- end single banner --}}

    {{-- hot deals it works but need some modifications --}}
    {{-- @include('frontend.home.sections.hot-deals') --}}
    {{-- end hot deals --}}

    {{-- category-product-slider-one --------------------- --}}
    @if ($frontendSections->singleCategorySliderOne == 'active')
        @include('frontend.home.sections.category-product-slider-one')
    @endif
    {{-- end category-product-slider-one --}}

    {{-- category-product-slider-two ------------------- --}}
    @if ($frontendSections->singleCategorySliderTwo == 'active')
        @include('frontend.home.sections.category-product-slider-two')
    @endif
    {{-- end category-product-slider-two --}}

    {{-- weekly best items 'section three' ------------------------- --}}
    @if ($frontendSections->singleCategorySliderThree == 'active')
        @include('frontend.home.sections.weekly-best-items')
    @endif
    {{-- end weekly best items --}}

    {{-- brand-slider -------------------------- --}}

    @if ($frontendSections->brandSlider == 'active')
        @include('frontend.home.sections.brand-slider')
    @endif
    {{-- end brand-slider --}}
@endsection

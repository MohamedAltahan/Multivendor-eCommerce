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

    {{-- advertisement banner1 is above popular category--------------------- --}}
    @if ($frontendSections->popularCategory == 'active')
        @include('frontend.home.sections.top-category-products')
    @endif

    {{-- advertisement banner divided into two pices-------------------------- --}}
    @if ($frontendSections->doubleBanner == 'active')
        @include('frontend.home.sections.single-banner')
    @endif

    {{-- hot deals it works but need some modifications --}}
    {{-- @include('frontend.home.sections.hot-deals') --}}

    {{-- category-product-slider-one --------------------- --}}
    @if ($frontendSections->singleCategorySliderOne == 'active')
        @include('frontend.home.sections.category-product-slider-one')
    @endif

    {{-- category-product-slider-two ------------------- --}}
    @if ($frontendSections->singleCategorySliderTwo == 'active')
        @include('frontend.home.sections.category-product-slider-two')
    @endif

    {{-- weekly best items 'section three' ------------------------- --}}
    @if ($frontendSections->singleCategorySliderThree == 'active')
        @include('frontend.home.sections.weekly-best-items')
    @endif

    {{-- brand-slider -------------------------- --}}
    @if ($frontendSections->brandSlider == 'active')
        @include('frontend.home.sections.brand-slider')
    @endif
@endsection

@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }}
@endsection
@section('content')
    {{-- banner-slider --------------------------- --}}
    @include('frontend.home.sections.banner-slider')
    {{-- end banner-slider --}}

    {{-- flash sale  ---------------------------- --}}
    @include('frontend.home.sections.flash-sale')
    {{-- end flash sale  --}}

    {{-- advertisement banner1 --------------------- --}}
    @include('frontend.home.sections.top-category-products')
    {{-- end top category products --}}

    {{-- advertisement banner divided into two pices-------------------------- --}}
    @include('frontend.home.sections.single-banner')
    {{-- end single banner --}}

    {{-- hot deals it works but need some modifications --}}
    {{-- @include('frontend.home.sections.hot-deals') --}}
    {{-- end hot deals --}}

    {{-- category-product-slider-one --------------------- --}}
    @include('frontend.home.sections.category-product-slider-one')
    {{-- end category-product-slider-one --}}

    {{-- category-product-slider-two ------------------- --}}
    @include('frontend.home.sections.category-product-slider-two')
    {{-- end category-product-slider-two --}}

    {{-- weekly best items ------------------------- --}}
    @include('frontend.home.sections.weekly-best-items')
    {{-- end weekly best items --}}

    {{-- brand-slider -------------------------- --}}
    @include('frontend.home.sections.brand-slider')
    {{-- end brand-slider --}}
@endsection

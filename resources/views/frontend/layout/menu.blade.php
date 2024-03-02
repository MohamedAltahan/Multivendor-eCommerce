@php
    $categories = \App\Models\Category::where('status', 'active')
        ->with([
            'subCategories' => function ($query) {
                $query->where('status', 'active')->with([
                    'childCategories' => function ($query) {
                        $query->where('status', 'active');
                    },
                ]);
            },
        ])
        ->get();
    // $subCategories = \App\Models\SubCategory::with(['childCategories'])->get();
@endphp
<!--============================MAIN MENU START==============================-->
<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        {{-- categories---------------------------------------------------------- --}}
                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }}
                                </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        {{-- sub category--------------------------------------------- --}}
                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a
                                                    href="{{ route('products.index', ['subCategory' => $subCategory->slug]) }}">{{ $subCategory->name }}
                                                    <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>
                                                {{-- child category---------------------------------------- --}}
                                                @if (count($subCategory->childCategories) > 0)
                                                    <ul class="wsus__sub_category">
                                                        @foreach ($subCategory->childCategories as $childCategory)
                                                            <li><a
                                                                    href="{{ route('products.index', ['childCategory' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        {{-- end categories------------------------------------------------------- --}}
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="{{ setActive(['home']) }}" href="{{ url('/') }}">Home</a></li>

                        <li><a class="{{ setActive(['vendors.page']) }}"
                                href="{{ route('vendors.page') }}">Vendors</a></li>

                        <li><a class="{{ setActive(['track-order.index']) }}"
                                href="{{ route('track-order.index') }}">track
                                order</a></li>
                        <li><a class="{{ setActive(['about']) }}" href="{{ route('about') }}">About</a></li>
                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">Contact us</a></li>
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        @auth

                            @if (auth()->user()->role == 'user')
                                <li><a href="{{ route('user.dashboard') }}">my account</a></li>
                            @elseif (auth()->user()->role == 'vendor')
                                <li><a href="{{ route('vendor.dashboard') }}">Vendor dashboard</a></li>
                            @elseif (auth()->user()->role == 'admin')
                                <li><a href="{{ route('admin.dashboard') }}">Admin dashboard</a></li>
                            @endif

                            <li> <a href="javascript:$('#logout_form').submit();" class=""><i
                                        class="fas fa-sign-out-alt"> Logout </i></a></li>

                            <form method="post" id="logout_form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        @else
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"> login</i></a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!--============================= MAIN MENU END ==============================-->

<!--============================MOBILE MENU START==============================-->
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">
        <li><a href="{{ route('user.wishlist.index') }}"><i class="far fa-heart"></i> <span>
                    @auth
                        {{ App\Models\WishList::where('user_id', auth()->user()->id)->count() }}
                    @else
                        0
                    @endauth
                </span></a></li>
        <li>
            @auth

                @if (auth()->user()->role == 'user')
            <li><a href="{{ route('user.dashboard') }}"><i class="far fa-user"></i></a></li>
        @elseif (auth()->user()->role == 'vendor')
            <li><a href="{{ route('vendor.dashboard') }}"><i class="far fa-user"></i></a></li>
        @elseif (auth()->user()->role == 'admin')
            <li><a href="{{ route('admin.dashboard') }}"><i class="far fa-user"></i></a></li>
            @endif

            <li> <a style="width: 65px" href="javascript:$('#logout_form').submit();" class=""> Logout
                    </i></a></li>

            <form method="post" id="logout_form" action="{{ route('logout') }}">
                @csrf
            </form>
        @else
            <li><a style="width: 60px" href="{{ route('login') }}">login</i></a></li>
        @endauth
        </li>
    </ul>
    <form action="{{ route('products.index') }}">
        <input type="text" placeholder="Search" name="search" value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        {{-- main category-------------------------------------------------------------- --}}
                        @foreach ($categories as $category)
                            <li><a href="#"
                                    class="{{ count($category->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }}</a>
                                {{-- sub category----------------------------------------------- --}}
                                @if (count($category->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($category->subCategories as $subCategory)
                                                    <li><a href="#">{{ $subCategory->name }}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                        <li><a href="{{ route('vendors.page') }}">vendor</a></li>
                        <li><a href="{{ route('track-order.index') }}">track order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================MOBILE MENU END==============================-->

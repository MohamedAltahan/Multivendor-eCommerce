        <!--============================ HEADER START==============================-->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-1 d-lg-none">
                        <div class="wsus__mobile_menu_area">
                            <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                        </div>
                    </div>

                    <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                        <div class="wsus_logo_area">
                            <a class="wsus__header_logo" href="{{ url('/') }}">
                                <img src="{{ asset('uploads/' . $logoSetting->main_logo) }}" alt="logo"
                                    class="img-fluid w-100">
                            </a>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-5 col-lg-3 d-none d-lg-block">
                        <div class="wsus__search">
                            <form action="{{ route('products.index') }}">
                                <input type="text" placeholder="Search...." name="search"
                                    value="{{ request()->search }}">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>


                    <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                        <div class="wsus__call_icon_area">
                            <div class="wsus__call_area">
                                <div class="wsus__call">
                                    <i class="fas fa-user-headset"></i>
                                </div>
                                <div class="wsus__call_text">
                                    <p>{{ $setting->contact_email }}</p>
                                    <p>{{ $setting->contact_phone }}</p>
                                </div>
                            </div>

                            <ul class="wsus__icon_area">
                                <li><a href="{{ route('user.wishlist.index') }}"><i class="fal fa-heart"></i><span>
                                            @auth
                                                {{ App\Models\Wishlist::where('user_id', auth()->user()->id)->count() }}
                                            @else
                                                0
                                            @endauth
                                        </span></a>
                                </li>
                                <li><a class="wsus__cart_icon" href="#"><i class="fal fa-shopping-bag"></i><span
                                            class="cart-count-icon">{{ Cart::count() }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="wsus__mini_cart">
                <h4>{{ __('Shopping cart') }} <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span>
                </h4>
                <div class="side_cart_wrapper">
                    <ul>
                        @forelse (Cart::content() as $item)
                            <li id="product_{{ $item->rowId }}">
                                <div class="wsus__cart_img">
                                    <a href="{{ route('show-product-details', $item->options->slug) }}"><img
                                            src="{{ asset('uploads/' . $item->options->image) }}" alt="product"
                                            class="img-fluid w-100"></a>
                                    <a class="wsis__del_icon " id="side-cart-remove-product"
                                        data-id="{{ $item->rowId }}" href="#"><i
                                            class="fas fa-minus-circle"></i></a>
                                </div>

                                <div class="wsus__cart_text">
                                    <a class="wsus__cart_title"
                                        href="{{ route('show-product-details', $item->options->slug) }}">{{ $item->name }}</a>
                                    <p>{{ $item->price }} * {{ $item->qty }} =
                                        {{ $setting->currency . $item->price * $item->qty }}
                                    </p>

                                </div>
                            </li>

                        @empty
                            <h5 class="text-primary " style="justify-content: center">{{ __('Cart is empty') }}</h5>
                        @endforelse
                    </ul>
                    <h5>{{ __('Sub total') }}<span>{{ calcCartTotal() }}</span></h5>
                </div>

                <div class="wsus__minicart_btn_area">
                    <a class="common_btn" href="{{ route('cart-details') }}">{{ __('View cart') }}</a>
                    <a class="common_btn" href="{{ route('user.checkout') }}">{{ __('Checkout') }}</a>
                </div>
            </div>

        </header>
        <!--============================  HEADER END ==============================-->

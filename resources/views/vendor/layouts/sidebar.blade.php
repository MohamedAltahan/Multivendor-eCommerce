<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ url('/') }}" class="dash_logo"><img src="{{ asset('uploads/' . $logoSetting->main_logo) }}"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">

        <li><a href="{{ url('/') }}"> <i class="fas fa-home"></i> Go to home page</a> </li>

        <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Vendor dashboard</a></li>

        <li><a href="{{ route('user.dashboard') }}"><i class="far fa-user"></i> User dashboard</a></li>

        <li><a class="{{ setActive(['vendor.shop-profile.*']) }}" href="{{ route('vendor.shop-profile.index') }}"><i
                    class="far fa-user"></i> Shop profile</a></li>

        <li><a class="{{ setActive(['vendor.profile']) }}" href="{{ route('vendor.profile') }}"><i
                    class="far fa-user"></i> Vendor Profile</a></li>

        <li><a class="{{ setActive(['vendor.messages.*']) }}" href="{{ route('vendor.messages.index') }}"><i
                    class="fab fa-facebook-messenger"></i> Messages</a></li>

        <li><a class="{{ setActive(['vendor.orders.*']) }}" href="{{ route('vendor.orders.index') }}"><i
                    class="fas fa-box"></i> Orders</a></li>

        <li><a class="{{ setActive(['vendor.products.*']) }}" href="{{ route('vendor.products.index') }}"><i
                    class="fas fa-cart-plus"></i> Products</a></li>

        <li><a class="{{ setActive(['vendor.reviews.*']) }}" href="{{ route('vendor.reviews.index') }}"><i
                    class="fas fa-star"></i> review</a></li>

        <li><a class="{{ setActive(['vendor.withdraw.*']) }}" href="{{ route('vendor.withdraw.index') }}"><i
                    class="fas fa-dollar-sign"></i> My withdraw</a></li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>
            </form>
        </li>

    </ul>
</div>

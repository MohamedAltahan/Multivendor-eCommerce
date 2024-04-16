            <div class="dashboard_sidebar">
                <span class="close_icon">
                    <i class="far fa-bars dash_bar"></i>
                    <i class="far fa-times dash_close"></i>
                </span>
                <a href="{{ url('/') }}" class="dash_logo"><img
                        src="{{ asset('uploads/' . $logoSetting->main_logo) }}" alt="logo" class="img-fluid"></a>
                <ul class="dashboard_link">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i></i>{{ __('Go to home') }}</a></li>
                    <li><a class="{{ setActive(['user.dashboard']) }}" href="{{ route('user.dashboard') }}"><i
                                class="fas fa-tachometer"></i>{{ __('User Dashboard') }}</a></li>

                    @if (Auth::user()->role == 'vendor')
                        <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                                    class="fas fa-tachometer"></i>
                                {{ __('Vendor Dashboard') }}</a></li>
                    @endif

                    <li><a class="{{ setActive(['user.orders.*']) }}" href="{{ route('user.orders.index') }}"><i
                                class="fas fa-list-ul"></i> {{ __('Orders') }}</a></li>

                    <li><a class="{{ setActive(['user.review.*']) }}" href="{{ route('user.review.index') }}"><i
                                class="far fa-star"></i> {{ __('Reviews') }}</a></li>

                    <li><a class="{{ setActive(['user.profile']) }}" href="{{ route('user.profile') }}"><i
                                class="far fa-user"></i> {{ __('My Profile') }}</a></li>

                    <li><a class="{{ setActive(['user.messages.*']) }}" href="{{ route('user.messages.index') }}"><i
                                class="fab fa-facebook-messenger"></i> {{ __('Messages') }}</a></li>

                    <li><a class="{{ setActive(['user.address.index']) }}" href="{{ route('user.address.index') }}"><i
                                class="fal fa-gift-card"></i> {{ __('Addresses') }}</a></li>

                    @if (Auth::user()->role != 'vendor')
                        <li><a class="{{ setActive(['user.become-a-vendor-request']) }}"
                                href="{{ route('user.become-a-vendor-request') }}"><i class="fal fa-gift-card"></i>
                                {{ __('Request to be a vendor') }}</a></li>
                    @endif

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"><i
                                    class="far fa-sign-out-alt"></i> {{ __('Logout') }}</a>
                        </form>
                    </li>

                </ul>
            </div>

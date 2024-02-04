<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            {{--
         <li class="dropdown active">
                                <a href="#" class="nav-link has-dropdown"><i
                                        class="fas fa-fire"></i><span>Dashboard</span></a>
                                <ul class="dropdown-menu">
                                    <li class=active><a class="nav-link" href="index-0.html">General Dashboard</a>
                                    </li>
                                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                                </ul>
                            </li> --}}

            <li class="menu-header">Starter</li>
            {{-- category----------------------------------------------------- --}}
            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                </ul>
            </li>
            {{-- order----------------------------------------------------- --}}
            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">All orders</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                </ul>
            </li>
            {{-- slider---------------------------------------------------- --}}
            <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage website</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                </ul>
            </li>
            {{-- Manage product---------------------------------------------------- --}}
            <li
                class="dropdown {{ setActive([
                    'admin.brand.*',
                    'admin.products.*',
                    'admin.product-variant.*',
                    'admin.product.product-variant-details.*',
                    'admin.get-vendor-products*',
                    'admin.all-vendors-products.*',
                    'admin.pending-products.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage products</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brands</a></li>
                    <li
                        class="dropdown {{ setActive(['admin.products*', 'admin.product-variant.*', 'admin.product.product-variant-details.*']) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">My shop products</a>
                    </li>
                    <li
                        class="dropdown {{ setActive(['admin.all-vendors-products.*', 'admin.get-vendor-products*']) }}">
                        <a class="nav-link" href="{{ route('admin.all-vendors-products.index') }}">All vendors
                            products</a>
                    </li>
                    <li class="dropdown {{ setActive(['admin.pending-products.*']) }} ">
                        <a class="nav-link" href="{{ route('admin.pending-products.index') }}">Pending products</a>
                    </li>
                </ul>
            </li>
            {{-- Manage E-commerce---------------------------------------------------- --}}
            <li
                class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.coupons.*', 'admin.shipping-rule.*', 'admin.payment-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    <li class="dropdown {{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                    <li class="dropdown {{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Shipping rule</a></li>
                    <li class="dropdown {{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendors profile</a></li>
                    <li class="dropdown {{ setActive(['admin.payment-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-setting.index') }}">Payment Setting</a></li>
                </ul>
            </li>
            {{-- settings================================================================= --}}
            <li><a href="{{ route('admin.settings.index') }}" class="nav-link"><i
                        class="far fa-square"></i><span>Settings</span></a></li>

        </ul>
    </aside>
</div>

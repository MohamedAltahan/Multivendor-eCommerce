<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ $setting->site_name }}</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Starter</li>

            {{-- category========================================================= --}}
            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
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

            {{-- Manage product======================================================= --}}
            <li
                class="dropdown {{ setActive([
                    'admin.brand.*',
                    'admin.products.*',
                    'admin.product-variant.*',
                    'admin.product.product-variant-details.*',
                    'admin.get-vendor-products*',
                    'admin.all-vendors-products.*',
                    'admin.pending-products.*',
                    'admin.reviews.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
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
                    <li class="dropdown {{ setActive(['admin.reviews.*']) }} ">
                        <a class="nav-link" href="{{ route('admin.reviews.index') }}"> Product reviews</a>
                    </li>
                </ul>
            </li>

            {{-- order=============================================================== --}}
            <li class="dropdown {{ setActive(['admin.order.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-cart-arrow-down"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">All orders</a></li>
                </ul>
            </li>

            {{-- Manage website======================================================= --}}
            <li
                class="dropdown {{ setActive([
                    'admin.slider.*',
                    'admin.slider.*',
                    'admin.home-page-setting.*',
                    'admin.vendor-condition.*',
                    'admin.about.*',
                    'admin.terms-and-conditions.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wrench"></i>
                    <span>Manage website</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.home-page-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting') }}">Home page setting</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.vendor-condition.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-condition.index') }}">Vendor conditions</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.about.*']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">About</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.terms-and-conditions.*']) }}"><a class="nav-link"
                            href="{{ route('admin.terms-and-conditions.index') }}">terms and conditons</a></li>
                </ul>
            </li>

            {{-- Manage footer======================================================= --}}
            <li
                class="dropdown {{ setActive(['admin.subscribers.*', 'admin.footer.*', 'admin.footer-socials.*', 'admin.footer-grid-two.*', 'admin.footer-grid-three.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-shoe-prints"></i>
                    <span>Website footer</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.footer.index']) }}"><a class="nav-link"
                            href="{{ route('admin.footer.index') }}"> contact info</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.footer-socials.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-socials.index') }}"> social buttons</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}"> section two</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-three.index') }}"> section three</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.subscribers.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subscribers.index') }}"> Subscribers</a></li>
                </ul>
            </li>

            {{-- Manage users======================================================= --}}
            <li
                class="dropdown {{ setActive([
                    'admin.manage-user',
                    'admin.vendor-requests.*',
                    'admin.customers.*',
                    'admin.vendors.*',
                    'admin.admin.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.manage-user']) }}"><a class="nav-link"
                            href="{{ route('admin.manage-user') }}">Add users</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.vendor-requests.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-requests.index') }}"> Pending vendors</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.customers.*']) }}"><a class="nav-link"
                            href="{{ route('admin.customers.index') }}">Customers</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.vendors.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendors.index') }}">Vendors</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.admin.*']) }}"><a class="nav-link"
                            href="{{ route('admin.admin.index') }}">Admins</a></li>
                </ul>
            </li>



            {{-- Manage E-commerce======================================================= --}}
            <li
                class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.coupons.*', 'admin.shipping-rule.*', 'admin.payment-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tasks"></i>
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

            {{-- withdraw methods======================================================= --}}
            <li class="dropdown {{ setActive(['admin.withdraw-transaction.*', 'admin.withdraw-method.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i>
                    <span>Withdraw payments</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.withdraw-method.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-method.index') }}">Withdraw method</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.withdraw-transaction.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-transaction.index') }}">Withdraw requests</a></li>
                </ul>
            </li>

            {{-- messages================================================================= --}}
            <li class="{{ setActive(['admin.messages.*']) }}"><a href="{{ route('admin.messages.index') }}"
                    class="nav-link "><i class="fab fa-facebook-messenger"></i><span>Message</span></a></li>

            {{-- settings================================================================= --}}
            <li class="{{ setActive(['admin.settings.*']) }}"><a href="{{ route('admin.settings.index') }}"
                    class="nav-link "><i class="fas fa-cog"></i><span>Settings</span></a></li>

            {{-- advertisement================================================================= --}}
            <li class="{{ setActive(['admin.advertisement.*']) }}"><a
                    href="{{ route('admin.advertisement.index') }}" class="nav-link "><i
                        class="fas fa-ad"></i><span>Advertisement</span></a></li>

            {{-- transactions================================================================= --}}
            <li class="{{ setActive(['admin.transaction']) }}"><a href="{{ route('admin.transaction') }}"
                    class="nav-link"><i class="fas fa-dollar-sign"></i><span>Transactions</span></a></li>

        </ul>
    </aside>
</div>

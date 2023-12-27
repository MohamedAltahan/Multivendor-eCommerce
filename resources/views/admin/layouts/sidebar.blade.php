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
            <li class="dropdown {{ setActive(['admin.brand.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage products</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brands</a></li>

                </ul>
            </li>
            {{-- Manage vendors---------------------------------------------------- --}}
            <li class="dropdown {{ setActive(['admin.brand.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown {{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendors profile</a></li>

                </ul>
            </li>

        </ul>
    </aside>
</div>

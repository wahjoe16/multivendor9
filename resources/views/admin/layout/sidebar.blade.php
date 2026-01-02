<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.admin') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('admin')->user()->type == "Admin")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin-manage" aria-expanded="false" aria-controls="admin-manage">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">User Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin-manage">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/subadmin') }}">Sub Admins</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendors</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/') }}">All</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#catalogue-manage" aria-expanded="false" aria-controls="catalogue-manage">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Catalogue Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="catalogue-manage">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('sections.view') }}">Sections</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('categories.view') }}">Categories</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('products.view') }}">Products</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('brands.view') }}">Brands</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('filters.index') }}">Filters</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pages-manage" aria-expanded="false" aria-controls="pages-manage">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Page Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pages-manage">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('banners.view') }}">Banners</a></li>
                    </ul>
                </div>
            </li>
        @endif

        @if (Auth::guard('admin')->user()->type == "Vendor")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#catalogue-manage" aria-expanded="false" aria-controls="catalogue-manage">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Catalogue Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="catalogue-manage">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('products.view') }}">Products</a></li>
                    </ul>
                </div>
            </li>
        @endif
        
    </ul>
</nav>
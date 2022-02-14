<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- sidebar - Brand -->
    <a href="index.html" class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- nav iteam - Dashboard -->
    <li class="nav-item active">
        <a href="{{ url("/") }}" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- nav iteam - Dashboard -->
    <li class="nav-item active">
        <a href="{{ url("/backend/product/index") }}" class="nav-link">
            <span>Sản phẩm</span>
        </a>
    </li>

    <!-- nav iteam - Dashboard -->
    <li class="nav-item active">
        <a href="{{ url("/backend/category/index") }}" class="nav-link">
            <span>Danh mục</span>
        </a>
    </li>

    <li class="nav-item active">
        <a href="{{ url("/backend/orders/index") }}" class="nav-link">
        <span>Đơn hàng</span></a>
    </li>

    <li class="nav-item active">
        <a href="{{url("/backend/admins/index")}}" class="nav-link">
        <span>Quản trị viên</span>
        </a>
    </li>
    <li class="nav-item active">
        <a href="{{ url("/backend/settings") }}" class="nav-link">
            <span>Cấu hình</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- sidebar toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
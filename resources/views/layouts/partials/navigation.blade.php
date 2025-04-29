<div class="sidebar-header">
    <div class="d-flex justify-content-between">
        <div class="logo">
            <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        </div>
        <div class="toggler">
            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
    </div>
</div>
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>

    <ul class="menu">
        <li class="sidebar-title">Master Data</li>

        <li class="sidebar-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
            <a href="{{ route('produk.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('customer.*') ? 'active' : '' }}">
            <a href="{{ route('customer.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Customer</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('perusahaan.*') ? 'active' : '' }}">
            <a href="{{ route('perusahaan.index') }}" class='sidebar-link'>
                <i class="bi bi-building"></i>
                <span>Perusahaan</span>
            </a>
        </li>

    </ul>
    <ul class="menu">
        <li class="sidebar-title">Transaksi</li>

        <li class="sidebar-item {{ request()->routeIs('faktur.*') ? 'active' : '' }}">
            <a href="{{ route('faktur.index') }}" class='sidebar-link'>
                <i class="bi bi-receipt"></i>
                <span>Faktur</span>
            </a>
        </li>
    </ul>

    <ul class="menu">
        <li class="sidebar-title">Authentication</li>

        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}" id="logout">
                @csrf

                <a href="{{ route('logout') }}" class='sidebar-link'>
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>
    </ul>


</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

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

        <li class="sidebar-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
            <a href="{{ route('buku.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Buku</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <a href="{{ route('kategori.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('administrators.*') ? 'active' : '' }}">
            <a href="{{ route('administrators.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>User</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
            <a href="{{ route('anggota.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Anggota</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('denda.*') ? 'active' : '' }}">
            <a href="{{ route('denda.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Denda</span>
            </a>
        </li>
    </ul>
    <ul class="menu">
        <li class="sidebar-title">Transaksi</li>

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

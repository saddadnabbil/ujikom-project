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
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        </li>
        <li class="sidebar-item has-sub @if (request()->routeIs('cash-transactions.*')) active @else @endif">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-cash-stack"></i>
                <span>Kas</span>
            </a>
            <ul class="submenu @if (request()->routeIs('cash-transactions.*')) active @else @endif ">
                <li class="submenu-item {{ request()->routeIs('cash-transactions.index') ? 'active' : '' }}">
                    <a href="{{ route('cash-transactions.index') }}">Kas Minggu Ini</a>
                </li>
                <li class="submenu-item {{ request()->routeIs('cash-transactions.filter') ? 'active' : '' }}">
                    <a href="{{ route('cash-transactions.filter') }}">Filter Kas</a>
                </li>
            </ul>
        </li>

        </li>
        <li class="sidebar-item has-sub @if (request()->routeIs('cash-transaction-expenditures.*')) active @else @endif">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-cash-stack"></i>
                <span>Pengeluaran</span>
            </a>
            <ul class="submenu @if (request()->routeIs('cash-transaction-expenditures.*')) active @else @endif ">
                <li
                    class="submenu-item {{ request()->routeIs('cash-transaction-expenditures.index') ? 'active' : '' }}">
                    <a href="{{ route('cash-transaction-expenditures.index') }}">Pengeluaran Minggu Ini</a>
                </li>
                <li
                    class="submenu-item {{ request()->routeIs('cash-transaction-expenditures.filter') ? 'active' : '' }}">
                    <a href="{{ route('cash-transaction-expenditures.filter') }}">Filter Pengeluaran</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item {{ request()->is('report*') ? 'active' : '' }}">
            <a href="{{ route('report.index') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Laporan</span>
            </a>
        </li>

        {{-- <li class="sidebar-title"><i class="bi bi-menu-button-wide"></i></li> --}}

        <li class="sidebar-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
            <a href="{{ route('students.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Warga</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('school-classes.*') ? 'active' : '' }}">
            <a href="{{ route('school-classes.index') }}" class='sidebar-link'>
                <i class="bi bi-bookmark-fill"></i>
                <span>Blok</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('school-majors.*') ? 'active' : '' }}">
            <a href="{{ route('school-majors.index') }}" class='sidebar-link'>
                <i class="bi bi-briefcase-fill"></i>
                <span>RT</span>
            </a>



        <li class="sidebar-item {{ request()->routeIs('administrators.*') ? 'active' : '' }}">
            <a href="{{ route('administrators.index') }}" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Administrator</span>
            </a>
        </li>

    </ul>

    <ul class="menu">
        <li class="sidebar-title">Master Data</li>

        <li class="sidebar-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
            <a href="{{ route('produk.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
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
                <i class="bi bi-people-fill"></i>
                <span>Perusahaan</span>
            </a>
        </li>

    </ul>
    <ul class="menu">
        <li class="sidebar-title">Transaksi</li>

        <li class="sidebar-item {{ request()->routeIs('faktur.*') ? 'active' : '' }}">
            <a href="{{ route('faktur.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Faktur</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('detail-faktur.*') ? 'active' : '' }}">
            <a href="{{ route('detail-faktur.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Detail Faktur</span>
            </a>
        </li>

        </li>

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

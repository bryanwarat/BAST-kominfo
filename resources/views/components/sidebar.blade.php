<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="{{ request()->routeIs('dashboard.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <i data-feather="home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('asset.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('asset.*') ? 'active' : '' }}"
                        href="{{ route('asset.index') }}">
                        <i data-feather="package"></i><span> Barang </span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('bast.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('bast.*') ? 'active' : '' }}"
                        href="{{ route('bast.index') }}">
                        <i data-feather="columns"></i><span> BAST </span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('employee.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('employee.*') ? 'active' : '' }}"
                        href="{{ route('employee.index') }}">
                        <i data-feather="users"></i><span> Pegawai </span>
                    </a>
                </li>
            </ul>


            <ul id="side-menu">
                <li class="menu-title">Konfigurasi</li>

                <li class="{{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">
                        <i data-feather="users"></i><span> User </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

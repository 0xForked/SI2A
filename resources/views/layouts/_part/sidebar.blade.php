<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ app_settings()['site_title']->value }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('assets/img/sites/' . app_settings()['site_logo']->value) }}" alt="logo" width="30">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li class="{{ (Request::segment(2) == 'home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-columns"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="menu-header">FITUR</li>
            <li class="">
                <a class="nav-link" href="">
                    <i class="fas fa-columns"></i>
                    <span>Konfirmasi</span>
                </a>
            </li>
            <li class="">
                <a class="nav-link" href="">
                    <i class="fas fa-columns"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="menu-header">LAPORAN</li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i>
                    <span>Barang</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">Item</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Satuan</a>
                    </li>
                </ul>
            </li> --}}
            <li class="menu-header">DATA</li>
            <li class="nav-item dropdown {{
                (
                    Route::is('admin.items.products.*')
                    || Route::is('admin.items.units.*')
                    || Route::is('admin.items.categories.*')
                ) ? 'active' : ''
            }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-box-open"></i>
                    <span>Barang</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.items.products.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.items.products.index') }}">Produk</a>
                    </li>
                    <li class="{{ Route::is('admin.items.units.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.items.units.index') }}">Satuan</a>
                    </li>
                    <li class="{{ Route::is('admin.items.categories.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.items.categories.index') }}">Kategori</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{
                (
                    Route::is('admin.users.*')
                    || Route::is('admin.roles.*')
                    || Route::is('admin.permissions.*')
                ) ? 'active' : ''
            }}
            ">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.users.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Pengguna</a>
                    </li>
                    <li class="{{ Route::is('admin.roles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.roles.index') }}">Peran</a>
                    </li>
                    <li class="{{ Route::is('admin.permissions.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.permissions.index') }}">Izin</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">SITUS</li>
            <li class="{{ (Request::segment(2) == 'settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.app.setting') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </aside>
</div>

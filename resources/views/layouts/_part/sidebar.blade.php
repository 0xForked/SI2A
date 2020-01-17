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
            <li class="nav-item dropdown {{ (Request::segment(2) == 'transactions') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Transaksi</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ (Request::segment(3) == 'purchase') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/')}}/admin/transactions/purchase">Pembelian</a>
                    </li>
                    <li class="{{ (Request::segment(3) == 'selling') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}/admin/transactions/selling">Penjualan</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">LAPORAN</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Transaksi</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">Pembelian</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Penjualan</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-window-restore"></i>
                    <span>Barang</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">Stock</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Kadaluarsa</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">DATA</li>
            <li class="{{ (Request::segment(2) == 'customers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li class="{{ (Request::segment(2) == 'suppliers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.suppliers.index') }}">
                    <i class="fas fa-truck"></i>
                    <span>Pemasok</span>
                </a>
            </li>
            <li class="nav-item dropdown {{
                (
                    Route::is('admin.items.products.*')
                    || Route::is('admin.items.units.*')
                    || Route::is('admin.items.categories.*')
                    || Route::is('admin.items.subcategories.*')
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
                    <li class="{{ Route::is('admin.items.subcategories.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.items.subcategories.index') }}">Subkategori</a>
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
                    <i class="fas fa-users-cog"></i>
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

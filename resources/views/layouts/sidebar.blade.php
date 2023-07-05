<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link ml-2">
        {{-- <img src="{{ asset('assets/dist/img/logo-bumdes.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"> <h4 class="mb-1 text-light">Service Elektronik</h1>
            @if (Auth::user()->level == 'konsumen')
                <span class="badge badge-light">Konsumen</span>
            @elseif(Auth::user()->level == 'admin')
                <span class="badge badge-success">Admin</span>
            @endif
        </span>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <h5 class="text-light text-center">
                    
                </h1>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('sb-dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->level == 'admin')
                <li class="nav-item">
                    <a href="{{ route('m-konsumen') }}" class="nav-link @yield('sb-konsumen')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manajemen Konsumen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('m-barang') }}" class="nav-link @yield('sb-barang')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manajemen Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('m-pengambilanbarang') }}" class="nav-link @yield('sb-ambilbarang')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pengambilan Barang
                        </p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->level == "konsumen")
                <li class="nav-item">
                    <a href="{{ route('barang') }}" class="nav-link @yield('sb-barang')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil') }}" class="nav-link @yield('sb-profil')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil anda
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

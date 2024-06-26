<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset ('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if($authUser->foto)
                    <img src="{{ asset('storage/fotos/' . $authUser->foto) }}" class="img-circle elevation-3" alt="User Image">
                @else
                    <img src="dist/img/default-user-image.png" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
            <a href="{{ route('profile') }}" class="d-block">{{ $authUser->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('doctors') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Doctors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pasiens') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pasiens</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('antrian') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Antrian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
</aside>
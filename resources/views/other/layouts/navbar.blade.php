<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Dynamic Title -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <h5 class="mt-0 mb-0">
                    @yield('navbar-title')
                </h5>
            </div>
        </div>
        <!-- User -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (!empty($authUser['foto']))
                            <div class="avatar-wrapper">
                                <img src="{{ $authUser['foto'] }}" alt class="avatar-img" />
                            </div>
                        @else
                            <div class="avatar-wrapper">
                                <img src="{{ asset('storage/logo/user.png') }}" alt="user-avatar" class="avatar-img">
                            </div>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <div class="avatar-wrapper">
                                            @if (!empty($authUser['foto']))
                                                <img src="{{ $authUser['foto'] }}" alt class="avatar-img" />
                                            @else
                                                <img src="{{ asset('storage/logo/user.png') }}" alt
                                                    class="avatar-img">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ substr($authUser['displayName'], 0, 8) }}</span>
                                    <small class="text-muted">{{ $authUser['role'] }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.setting') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
    .avatar-wrapper {
        position: relative;
        width: 40px;
        height: 40px;
        overflow: hidden;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #696CFF; 
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>

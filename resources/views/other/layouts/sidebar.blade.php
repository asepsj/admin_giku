<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Brand Logo" width="25">
            </span>
            <span class="menu-text fw-bolder ms-1">Giku</span>
            <p class="h6 pt-4 ms-1"> ({{ $authUser['role'] }})</p>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <hr>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li
            class="menu-item menu-item {{ request()->routeIs('jadwal-kerja') || request()->routeIs('jadwal-libur') || request()->routeIs('profile') || request()->routeIs('profile.setting') ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Extended UI">Profil</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Profile Saya</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('profile.setting') ? 'active' : '' }}">
                    <a href="{{ route('profile.setting') }}" class="menu-link">
                        <div data-i18n="Text Divider">Pengaturan</div>
                    </a>
                </li>
                @if ($authUser['role'] === 'dokter')
                    <li
                        class="menu-item {{ request()->routeIs('jadwal-kerja') || request()->routeIs('jadwal-libur') ? 'active' : '' }}">
                        <a href="{{ route('jadwal-kerja') }}" class="menu-link">
                            <div data-i18n="Jadwal Kerja">Jadwal Kerja</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @if ($authUser['role'] === 'admin')
            <li
                class="menu-item {{ request()->routeIs('admins') || request()->routeIs('doctors') || request()->routeIs('pasiens') || request()->routeIs('jadwal') ? 'active open' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="Extended UI">Kelola Pengguna</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admins') ? 'active' : '' }}">
                        <a href="{{ route('admins') }}" class="menu-link">
                            <div data-i18n="Text Divider">Admin</div>
                        </a>
                    </li>
                    <li
                        class="menu-item {{ request()->routeIs('doctors') || request()->routeIs('jadwal') ? 'active' : '' }}">
                        <a href="{{ route('doctors') }}" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Doctor</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('pasiens') ? 'active' : '' }}">
                        <a href="{{ route('pasiens') }}" class="menu-link">
                            <div data-i18n="Text Divider">Pasien</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if ($authUser['role'] === 'admin')
            <li class="menu-item {{ request()->routeIs('aplikasi.upload.form') ? 'active' : '' }}">
                <a href="{{ route('upload.view') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-upload"></i>
                    <div data-i18n="Extended UI">Upload APK</div>
                </a>
            </li>
        @endif
        @if ($authUser['role'] === 'dokter')
            <li
                class="menu-item menu-item {{ request()->routeIs('jadwal') || request()->routeIs('antrian.riwayat') ? 'active open' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-blanket"></i>
                    <div data-i18n="Extended UI">Antrian</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('jadwal') ? 'active' : '' }}">
                        <a href="{{ route('jadwal') }}" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Jadwal</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('antrian.riwayat') ? 'active' : '' }}">
                        <a href="{{ route('antrian.riwayat') }}" class="menu-link">
                            <div data-i18n="Text Divider">Riwayat</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="menu-item">
            <a href="#" class="menu-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                <div data-i18n="Basic">Keluar</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>

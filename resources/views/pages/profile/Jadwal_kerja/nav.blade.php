<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('jadwal-kerja') ? 'active' : '' }}" href="{{ route('jadwal-kerja') }}"><i
                class="bx bx-calendar me-1"></i>
            Jam Kerja</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('jadwal-libur') ? 'active' : '' }}" href="{{ route('jadwal-libur') }}"><i
                class="bx bx-calendar-check me-1"></i>
            Tanggal Libur</a>
    </li>
</ul>

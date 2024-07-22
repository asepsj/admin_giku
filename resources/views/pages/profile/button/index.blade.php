<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}"><i
                    class="bx bx-user me-1"></i>
                Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}"
                href="{{ route('profile.setting') }}"><i class="bx bx-cog me-1"></i>
                Settings</a>
        </li>
        {{-- @if ($authUser->role === 'doctor')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('klinik') ? 'active' : '' }}"
                    href="{{ route('klinik', $authUser->id) }}"><i class="bx bx-clinic me-1"></i>
                    Klinik</a>
            </li>
        @endif --}}
    </ul>
</ul>

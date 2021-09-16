<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('user.profile') }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ isset(auth()->user()->image) ? showUserImage(auth()->user()->image) : url('user/images/pic.svg') }}" alt="profile">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</span>
                    <span class="text-secondary text-small"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item @if(Request::is('dashboard')) active @endif">
            <a class="nav-link" href="{{ route('user.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @if(Request::is('press-releases')) active @endif">
            <a class="nav-link" href="{{ route('user.press_releases') }}">
                <span class="menu-title">My Press Releases</span>
                <i class="mdi mdi-nfc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @if(Request::is('draft-releases')) active @endif">
            <a class="nav-link" href="{{ route('user.draft_releases') }}">
                <span class="menu-title">My Draft Releases</span>
                <i class="mdi mdi-book-multiple menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @if(Request::is('profile')) active @endif">
            <a class="nav-link" href="{{ route('user.profile') }}">
                <span class="menu-title">Profile</span>
                <i class="mdi mdi-account-settings menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>

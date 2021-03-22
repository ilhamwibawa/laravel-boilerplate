<form class="form-inline mr-auto" action="">
    <ul class="navbar-nav mr-3">
        <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img class="rounded-circle mr-1" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                alt="{{ Auth::user()->name }}" />
            <div class="d-sm-none d-lg-inline-block">
                Hi, {{Auth::user()->name}}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Hi, {{Auth::user()->name}}</div>
            <a href="{{ route('users.profile.index') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile Settings
            </a>
            <div class="dropdown-divider"></div>
            <form id="logout-link" action="{{ url('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item has-icon text-danger d-flex align-items-center small">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </li>
</ul>

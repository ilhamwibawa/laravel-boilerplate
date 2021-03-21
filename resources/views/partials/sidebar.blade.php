<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">{{ config("app.name") }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('dashboard') }}">{{ strtoupper(substr(config("app.name"), 0, 2)) }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="fas fa-columns"></i> <span>Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->can('view_users') || auth()->user()->can('view_roles'))
            <li class="menu-header">Users Management</li>
        @endif
        @can('view_users')
            <li class="{{ request()->is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('users')}}">
                    <i class="fas fa-users"> </i> <span>Users</span>
                </a>
            </li>
        @endcan
        @can('view_roles')
            <li class="{{ request()->is('roles') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('roles')}}">
                    <i class="fas fa-lock"> </i> <span>Roles</span>
                </a>
            </li>
        @endcan
    </ul>
</aside>

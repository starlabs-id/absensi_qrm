<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="/">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Projects</span>
                </a>
            </li>
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">Absen</span>
                </a>
            </li>
            <li class="nav-item" data-item="users">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Network"></i>
                    <span class="nav-text">Users</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        
        <ul class="childNav" data-parent="users">
            <li class="nav-item">
                <a href="{{ route('users.index') }}">
                    <span class="item-name">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('role.index') }}">
                    <span class="item-name">Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('permission.index') }}">
                    <span class="item-name">Permission</span>
                </a>
            </li>
        </ul>

    </div>
</div>
<div class="sidebar-overlay"></div>
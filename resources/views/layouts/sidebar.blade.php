<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="/">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @can('projek-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('projek.index') }}">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Proyek</span>
                </a>
            </li>
            @endcan     
            @can('projekdetail-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('projekdetail.index') }}">
                    <i class="nav-icon i-File-Horizontal-Text"></i>
                    <span class="nav-text">Proyek Detail</span>
                </a>
            </li>
            @endcan
            @can('listpekerjaan-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('list_pekerjaan.index') }}">
                    <i class="nav-icon i-Note"></i>
                    <span class="nav-text">List Pekerjaan</span>
                </a>
            </li>
            @endcan
            @can('tukang-list')
            <!-- <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('tukang.index') }}">
                    <i class="nav-icon i-Business-Man"></i>
                    <span class="nav-text">Tukang</span>
                </a>
            </li> -->
            @endcan
            @can('absen-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('absen.index') }}">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">Absen</span>
                </a>
            </li>
            @endcan
            @can('absenlembur-list')
            <!-- <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('absenlembur.index') }}">
                    <i class="nav-icon i-Over-Time"></i>
                    <span class="nav-text">Lembur</span>
                </a>
            </li> -->
            @endcan
            @can('chat-list')
            <!-- <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('chat.index') }}">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">Chat</span>
                </a>
            </li> -->
            @endcan
            @can('shift-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('shift.index') }}">
                    <i class="nav-icon i-Clock"></i>
                    <span class="nav-text">Shift</span>
                </a>
            </li>
            @endcan
            @can('user-list')
            <li class="nav-item" data-item="users">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Network"></i>
                    <span class="nav-text">Users</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan


            
            
            
            @can('guest-proyek-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('proyek.index') }}">
                    <i class="nav-icon i-University"></i>
                    <span class="nav-text">Proyek </span>
                </a>
            </li>
            @endcan
                    
            @can('karyawan-absen-list')
            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('absensi.index') }}">
                    <i class="nav-icon i-Finger-Print"></i>
                    <span class="nav-text">Absen</span>
                </a>
            </li>
            @endcan
            @can('karyawan-absenlembur-list')
            <!-- <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('absensilembur.index') }}">
                    <i class="nav-icon i-Over-Time-2"></i>
                    <span class="nav-text">Lembur</span>
                </a>
            </li> -->
            @endcan
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
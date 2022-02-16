<div class="main-header">
    <div class="">
        <img style="width: 60px; margin-left: 20px;" src="{{ asset('packages/images/logo.png') }}">
        <!-- <h3><a href="/" style="padding-left: 15px;">{{ $title ?? config('app.name') }}</a></h3> -->
        
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i> -->
        <div class="dropdown">
            <div  class="user col align-self-end">
                <img src="{{ auth()->user()->avatar_url }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->name }} <br>
                        {{ Auth::user()->email }}
                    </div>
                    <a href="{{ route('profil') }}" class="dropdown-item">
                        <i class="nav-icon i-Network pull-left"></i> Update Profile
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="return logout(event);" data-popup="tooltip" data-original-title="Logout" data-placement="top">
                        <i class="nav-icon i-Key-Lock pull-left"></i> Log Out
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- header top menu end -->
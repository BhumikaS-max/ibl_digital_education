<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" width="50px" height="50px" class="rounded-circle" src="public/images/default_profile.png"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">full name</span>
                        <span class="text-muted text-xs block">email</span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li class="dropdown-divider"></li>
{{--                        <li><a class="dropdown-item" href="{{ route('admin-logout') }}">Logout</a></li>--}}
                    </ul>
                </div>
                <div class="logo-element">
                    Digital Education
                </div>
            </li>
            <li class="active">
                <a href=""><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboards</span></a>
            </li>

            <li class="active">
                @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <a href="#">
                    <i class="fa fa-calendar"></i> <span class="nav-label">Setting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="active">
                        <a href="{{route('teacher.index')}}">Teacher</a>
                    </li>
                    <li class="active">
                        <a href="">Student</a>
                    </li>
                </ul>
                @endif
            </li>
        </ul>
    </div>
</nav>

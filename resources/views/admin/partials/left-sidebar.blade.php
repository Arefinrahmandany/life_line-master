@php($p='admin')
<style>
    .sidebar-nav>ul>li {margin-bottom: 0px!important;margin-top: 0px!important;}
    .sidebar-nav ul li.nav-small-cap {padding: 12px 5px 5px 0!important;}
</style>
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- User Profile-->
    <div class="user-profile">
        <div class="user-pro-body">
            <div><img src="" alt="user-img" class="img-circle" style="height: 50px;"></div>
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->first_name}}<span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <!-- text-->
                    <a href="{{route('auth.account')}}" class="dropdown-item"><i class="ti-user"></i> My Account</a>
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="{{ route('auth.admin.logout') }}"onclick="return logout(event);" class="dropdown-item"><i class="ti-power-off"></i> Logout</a>
                    <form id="logout-form" action="{{ route('auth.admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- text-->
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="nav-small-cap">--- Main</li>
            <li>
                <a class="waves-effect waves-dark {{ request()->is($p."/dashboard") || request()->is($p."/notices/*") ? "active" : "" }}" href="{{route('admin.dashboard')}}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard </span></a>
            </li>

            <li>
               <a class="waves-effect waves-dark {{request()->is($p."/users") ||request()->is($p."/users/*") ? "active" : "" }}" href="{{route('admin.users')}}" aria-expanded="false"><i class="fas fa-users"></i>  &nbsp;<span class="hide-menu">Customers Manage</span></a>
            </li>

            <li>
                <a class="has-arrow waves-effect waves-dark {{request()->is($p."/riders") ? "active" : "" }} {{request()->is($p."/riders/applications") ? "active" : "" }} {{request()->is($p."/riders/profile") ? "active" : "" }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Riders</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a class="{{request()->is($p."/riders/applications") ? "active" : "" }}" href="">Applications</a></li>
                    <li><a class="{{request()->is($p."/riders") ? "active" : "" }}" href="">Riders</a></li>
                </ul>
            </li>

            <li class="nav-small-cap"> --- <i class="ti-settings"></i> Settings</li>
            <li>
                <a class="waves-effect waves-dark {{request()->is($p."/delivery-types") ? "active" : "" }}" href="" aria-expanded="false"><i class="ti-bar-chart-alt"></i><span class="hide-menu">Delivery Type</span></a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->

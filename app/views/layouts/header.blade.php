<header class="headermain">
<div class="logo_controlar">
<a href="{{ $dashboard_url }}">

  

  <img src="{{ URL :: asset('img/logo.png') }}" />

</a>
</div>
<div class="col_display">
    <p class="display_name">{{ $practice_name }}</p>
</div>
<nav class="navbar" role="navigation">
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>{{ $admin_name }} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-light-blue">
                        <img src="{{ URL :: asset('img/user3.jpg') }}" class="img-circle" alt="User Image" />
                        <p>
                           {{ $admin_name }}
                        </p>
                    </li>
                    
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            @if(isset($user_type) && $user_type != "C")
                            <a href="/staff-profile" class="btn btn-default btn-flat">Profile</a>
                            @else
                            <a href="/client/edit-ind-client/{{ $client_id or "" }}/{{ base64_encode('client_portal') }}" class="btn btn-default btn-flat">Profile</a>
                            @endif
                        </div>
                        <div class="pull-left" style="margin-left: 3px;">
                            <a href="/change-password" class="btn btn-default btn-flat">Edit Password</a>
                        </div>
                        <div class="pull-right">
                            <a href="/admin-logout" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
    
<div class="clearfix"></div>    

</header>
@extends('layouts.layout')
@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
     <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ URL :: asset('img/user3.jpg') }}" class="img-circle" alt="User Image" />
                        </div>
                        
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        @include('layouts.outer_leftside')
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>       
            
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side {{ $right_class }}">
        <!-- Content Header (Page header) -->
        @include('layouts.below_header')

        <!-- Main content -->
        

<section class="content">
    <div class="row icon_section">
    <div class="left_section">
    <ul>

<li class="hvr-grow">
    <a  href="/organisation-clients">
        <div class="circle_icons_inner">
            <div class="circle_icon"><img src="{{ URl :: asset('img/dashboard_circle.png') }}" /></div>
            <p class="c_tagline">CLIENT LIST - <br>
            ORGANISATIONS</p>
            <div class="clearfix"></div>
        </div>
    </a>
</li>


<li class="hvr-grow">
    <a  href="/jobs-dashboard">
        <div class="circle_icons_inner">
            <div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
            <p class="c_tagline2">JOBS</p>
            <div class="clearfix"></div>
        </div>
    </a>
</li>


<li class="hvr-grow">
<a  href="/individual-clients">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline">CLIENT LIST - <br>
INDIVIDUALS</p>
<div class="clearfix"></div>
</div></a>
</li>



<li class="hvr-grow">
<a  href="/hmrc">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline2">HMRC</p>
<div class="clearfix"></div>
</div></a>
</li>


<li class="hvr-grow">
<a  href="/noticeboard">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline2">NOTICE BOARD</p>
<div class="clearfix"></div>
</div></a>
</li>

   

<li class="hvr-grow">
<a  href="/chdata/index">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline2">CH DATA</p>
<div class="clearfix"></div>
</div></a>
</li>


<li class="hvr-grow">
<a  href="#">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline2">CRM</p>
<div class="clearfix"></div>
</div></a>
</li>



<li class="hvr-grow">
<a  href="/staff-management">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline">STAFF<br>
MANAGEMENT</p>
<div class="clearfix"></div>
</div></a>
</li>



<li class="hvr-grow">
<a  href="/contacts-letters-emails/1/{{ base64_encode('corres') }}">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline">CONTACTS,<br>
LETTERS & EMAILS</p>
<div class="clearfix"></div>
</div></a>
</li>


<li class="hvr-grow">
<a  href="/settings-dashboard">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>
<p class="c_tagline2">SETTINGS</p>
<div class="clearfix"></div>
</div></a>
</li>

<li class="hvr-grow">
<a  href="/knowledgebase">
<div class="circle_icons_inner">
<div class="circle_icon"><img src="{{ URl::asset('img/dashboard_circle.png') }}" /></div>

<p class="c_tagline">HOUSE <br>
KNOWLEDGE BASE</p>

<div class="clearfix"></div>
</div></a>
</li>

    </ul>
    </div>
 
    </div>
    
    
      
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
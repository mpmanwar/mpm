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
                        <div class="pull-left info">
                           <?php $admin_s =  Session::get('admin_details');
                                //echo "Name :".$admin_s['first_name'];
                                //echo "<pre>";print_r($admin_s);die;
                         ?>
                        
                            <p>Hello, {{ $admin_s['first_name'] }}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
<!-- <section class="content">
    <div class="col-xs-12">
        <div class="circle_icons">
            <ul>
                <a href="/practice-details" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/practice_i.png') }}" alt="" />
                            </div>
                            <div class="clearfix"></div>
                            <p class="c_tagline">PRACTICE DETAILS</p>
                        </div>
       
                    </li>
                </a>
        
                <a href="/email-settings" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/email_i.png') }}" alt="" />
                            </div>
                            <p class="c_tagline">EMAIL SETTINGS</p>
                        </div>
                   
                    </li>
                </a>
        
                 <a href="#" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/client_i.png') }}" alt="" />
                            </div>
                            <p class="c_tagline">NEW CLIENT- ON BOARDING<br>CHECKLIST / TASK</p>
                        </div>
                    </li>
                </a>
                
                <a href="/user-list" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/adduser_i.png') }}" alt="" />
                            </div>
                            <p class="c_tagline">ADD USER</p>
                        </div>
                    </li>
                </a>
                
                <a href="#" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/noti_i.png') }}" alt="" />
                            </div>
                            <p class="c_tagline">NOTIFICATIONS</p>
                        </div>
                    </li>
                </a>
                
                <a href="#" class="hvr-grow">
                    <li>
                        <div class="circle_icons_inner">
                            <div class="circle_con">
                                <img src="{{ URl::asset('img/manage_i.png') }}" alt="" />
                            </div>
                            <p class="c_tagline">MANAGE SUBSCRIPTION</p>
                        </div>
                    </li>
                </a>
        
        
            <div class="clearfix"></div>
            </ul>
        </div>
    </div>
                           
</section> -->

<section class="content">
    <div class="row icon_section">
        <div class="left_section">
            <ul>
                <li class="hvr-grow">
                    <a  href="/practice-details">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="c_tagline2">PRACTICE DETAILS</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>

                <li class="hvr-grow">
                    <a  href="/email-settings">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="c_tagline2">EMAIL SETTINGS</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>

                <li class="hvr-grow">
                    <a  href="#">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="small_tagline">NEW CLIENT- ON BOARDING<br>CHECKLIST / TASK</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>

                <li class="hvr-grow">
                    <a  href="/user-list">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="c_tagline2">ADD USER</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>

                <li class="hvr-grow">
                    <a  href="#">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="c_tagline2">NOTIFICATIONS</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>

                <li class="hvr-grow">
                    <a  href="#">
                        <div class="circle_icons_inner">
                            <div class="circle_icon">
                                <img src="{{ URl::asset('img/dashboard_circle.png') }}" />
                            </div>
                        <p class="c_tagline">MANAGE<br>SUBSCRIPTION</p>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>



                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
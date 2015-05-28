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
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side {{ $right_class }}">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Edit Password</h1>
                    <ol class="breadcrumb">
                        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Password</li>
                    </ol>
                </section>
                {{ Form::open(array('url' => '/new-pass', 'files' => true)) }} 
                <section class="content">
     
     <div class="practice_mid">
     <div class="col-xs-12 col-xs-6">
     <div class="col_m2">
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                 @if ( $errors->count() > 0 )
                    <ul>
                        @foreach( $errors->all() as $message )
                          <li style="color: red ;">{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                              <div id="message" style="color: red;font-size: 15px;">{{ Session::get('message') }} </div> 
                              <div id="message_su" style="color: green ;font-size: 15px;">{{ Session::get('message_su') }}</div> 
                              
               
                                  <label for="exampleInputPassword1">Old password</label>
                                  <input type="text" id="old_password" name="old_password" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">New Password</label>
                                  <input type="text" id="new_password" name="new_password" class="form-control">
                                </div>
                              </div>
                             
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Confirm Password.</label>
                                  <input type="text" id="conform_password" name="conform_password" class="form-control">
                               
                               
                                </div>
                              </div>
                              
                              
                              
                              
                              <div class="clearfix"></div>
                            </div>
                            <div class="add_client_btn">
                            
                             <button type="submit" class="btn btn-primary">save</button>
                             
                               </a>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                         
	</div>  <div class="clearfix"></div>    
     </div>
     
   
     
    </section>
                {{ Form::close() }}

                <!-- Main content -->

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
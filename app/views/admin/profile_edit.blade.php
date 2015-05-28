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
                    <h1>Edit Profile</h1>
                    <ol class="breadcrumb">
                        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Profile</li>
                    </ol>
                </section>
                {{ Form::open(array('url' => '/profile-update', 'files' => true)) }} 
                <section class="content">
					<div class="practice_mid">
						<div class="col-xs-12 col-xs-6">
							<div class="col_m2">
								<div class="twobox">
									<div class="twobox_1">
										<div class="form-group">
									        <label for="exampleInputPassword1">First Name</label>
				                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $admin_details['first_name'] or "" }}">
										</div>
									</div>
									<div class="twobox_2">
										<label for="exampleInputPassword1">Last Name</label>
										<input type="text" id="last_name" name="last_name" class="form-control" value="{{ $admin_details['last_name'] or "" }}">
									</div>
									<div class="clearfix">
									</div>
								</div>
								<div class="twobox">
									<div class="twobox_1">
										<div class="form-group">
											<label for="exampleInputPassword1">Practice Name
											</label>
											<input type="text" id="practice_name" name="practice_name" class="form-control" value="{{ $admin_details['practice_name'] or "" }}">
										</div>
									</div>
                                    <div class="twobox_2">
										<label for="exampleInputPassword1">Website</label>
										<input type="text" id="website" name="website" class="form-control" value="{{ $admin_details['website'] or "" }}">
									</div>
									<div class="clearfix">
									</div>
								</div>
                                
                                <div class="twobox">
									<div class="twobox_1">
										<div class="form-group">
											<label for="exampleInputPassword1">Phone
											</label>
											<input type="text" id="phone" name="phone" class="form-control" value="{{ $admin_details['phone'] or "" }}">
										</div>
									</div>
                                   <div class="twobox_2">
										<label for="exampleInputPassword1">Country</label>
										<select class="form-control" id="country" name="country">
                                            @if(!empty($coun))
                                              @foreach($coun as $key=>$country_row)
                                              @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
                                                <option value="{{ $country_row->country_id }}" {{ ($country_row->country_id == $admin_details['country'])?'selected':''}}>{{ $country_row->country_name }}</option>
                                              @endif
                                              @endforeach
                                            @endif
                                            @if(!empty($coun))
                                              @foreach($coun as $key=>$country_row)
                                              @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
                                                <option value="{{ $country_row->country_id }}" {{ ($country_row->country_id == $admin_details['country'])?'selected':''}}>{{ $country_row->country_name }}</option>
                                              @endif
                                              @endforeach
                                            @endif
                                        </select>
									</div>
									<div class="clearfix">
									</div>
								</div>
								
								<div class="add_client_btn" style="margin-right: 8px;">
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
								<div class="clearfix">
								</div>
							</div>
						</div>
						<div class="clearfix">
						</div>
					</div>
				</section>
                {{ Form::close() }}

                <!-- Main content -->

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
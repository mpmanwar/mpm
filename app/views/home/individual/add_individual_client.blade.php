@extends('layouts.layout')

@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<script>
$(document).ready(function(){
    $("#dob").datepicker({ minDate: 0 });
    $("#app_date").datepicker({ minDate: 0 });
    $("#spouse_dob").datepicker({ minDate: 0 });
})
</script>

    
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ URL :: asset('img/user3.jpg') }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

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
                            <a href="/">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADD CLIENT
                        <!-- <small>CLIENT NAME  Limited</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li class="active">Add Clients</li> -->
                    </ol>
                </section>

    <!-- Main content -->
    {{ Form::open(array('url' => '/individual/insert-client-details', 'files' => true)) }}
    <section class="content">

      <div class="row">
        <div class="top_bts">
          <ul>
            <li>
              <button class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </li>
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <li>
              <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
            <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>
      </div>

      <div class="practice_mid">
        
          <!--<div class="row box_border2 row_cont">
 <div class="col-xs-12 col-xs-6 p_left">
 <h2 class="res_t">USERS <small>General Settings</small></h2>

 </div>
 <div class="col-xs-12 col-xs-6">
 <div class="setting_con">
 <button class="btn btn-success btn-lg"><i class="fa fa-cog fa-fw"></i>Settings</button>
 </div>
 </div>
 <div class="clearfix"></div>
</div>-->
          <!--<div class="add_usercon">
<p><a href="#">What's this?</a></p>
<button class="btn btn-success"><i class="fa fa-edit"></i> Add User</button>
</div>-->
<div class="tabarea">
<div class="row row_cont">

 <div class="col-xs-12 col-xs-6">
  <div class="col_m2">
<h3 class="box-title">Personal Address</h3>

<div class="form-group">
<label for="exampleInputPassword1">Tax Return Required &nbsp;&nbsp;</label>
<input type="checkbox"/>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Relationship Type</label>
<select class="form-control">
    <option value="">-- Select Relationship Type --</option>
    @if(!empty($rel_types))
        @foreach($rel_types as $key=>$type_row)
        <option value="{{ $type_row->relation_type_id }}">{{ $type_row->relation_type }}</option>
        @endforeach
    @endif
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Title</label>
<select class="form-control">
    <option value="">-- Select Title --</option>
    @if(!empty($titles))
        @foreach($titles as $key=>$title_row)
        <option value="{{ $title_row->title_id }}">{{ $title_row->title_name }}</option>
        @endforeach
    @endif
</select>
</div>

<div class="form-group">
<label for="exampleInputPassword1">First Name</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Middle Name</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Last Name</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Client Code</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Sex</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="dob">Date of Birth</label>
<input type="text" id="dob" name="dob" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">NI Number</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>


<div class="form-group">
<label for="app_date">Appointment Date</label>
<input type="text" id="app_date" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Marital Status</label>
<select class="form-control">
    <option value="">-- Select Marital Status --</option>
    @if(!empty($marital_status))
        @foreach($marital_status as $key=>$status_row)
        <option value="{{ $status_row->marital_status_id }}">{{ $status_row->status_name }}</option>
        @endforeach
    @endif
</select>
</div>

<div class="form-group">
<label for="spouse_dob">Spouse Date of Birth</label>
<input type="text" id="spouse_dob" class="form-control">
</div>
<h3 class="box-title">Service Address</h3>
<div class="form-group">
<label for="exampleInputPassword1">Change</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Building Name/Number</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>


<div class="form-group">
<label for="exampleInputPassword1">Street</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Town</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">County</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Country</label>
<select class="form-control">
<option value="1">United Kingdom</option>
</select>
</div>


</div>
 </div>
 
<div class="col-xs-12 col-xs-6">
  <div class="col_m2">

<h3 class="box-title">Residential Address</h3>
<div class="form-group">
<label for="exampleInputPassword1">Change &nbsp;&nbsp;</label>
<input type="checkbox"/>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Building Name/Number</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Street</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Town</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">County</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Country</label>
<select class="form-control">
<option value="1">United Kingdom</option>
</select>
</div>

<h3 class="box-title">Other</h3>
<div class="form-group">
<label for="exampleInputPassword1">Change</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">AML Checks Done</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Nationality</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Occuption</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Country of Residence</label>
<select class="form-control">
<option value="1">United Kingdom</option>
</select>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Telephone 1</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Telephone 2</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Fax</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input type="email" id="exampleInputPassword1" class="form-control">
</div>
<h3 class="box-title">Releted Parties</h3>

<div class="col-xs-12 align_left">
<div class="col-xs-12 col-xs-6 align_left">
<p>AB Limited</p>
<p>C Limited</p>
</div>
<div class="col-xs-12 col-xs-6">
<p>Director/Shareholder</p>
<p>Secretary</p>
</div>
</div>


<button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>

</div>
 </div>
 
 </div>


            
          </div>
        
      </div>
    </section>

{{ Form::close() }}

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
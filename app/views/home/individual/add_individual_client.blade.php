@extends('layouts.layout')
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
                        <small>CLIENT NAME  Limited</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add Clients</li>
                    </ol>
                </section>

                <!-- Main content -->
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
        <form>
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
<h3 class="box-title">Personal</h3>

<div class="form-group">
<label for="exampleInputPassword1">Tax Return Required</label>
<input type="checkbox"/>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Relationship Type</label>
<select class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Title</label>
<select class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>

<div class="form-group">
<label for="exampleInputPassword1">First Name</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Middle Name</label>
<input type="text" placeholder="Middle Name" id="exampleInputPassword1" class="form-control">
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
<input type="text" placeholder="Title" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Ni Number</label>
<input type="text" placeholder="Title" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>


<div class="form-group">
<label for="exampleInputPassword1">Appointment Date</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Marital Status</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Spouse Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
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
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>


<h3 class="box-title">Residential Address</h3>
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
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
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
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
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

<div class="col-xs-12">
<div class="col-xs-12 col-xs-6">
<p>AB Limited</p>
<p>C Limited</p>
</div>
<div class="col-xs-12 col-xs-6">
<p>Director/Shareholder</p>
<p>Secretary</p>
</div>
</div>



<button class="btn btn-primary">SUBMIT</button>

</div>
 </div>
 
<div class="col-xs-12 col-xs-6">
  <div class="col_m2">
<h3 class="box-title">Personal</h3>
<div class="form-group">
<label for="exampleInputPassword1">Tax Return Required</label>
<input type="checkbox"/>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Relationship Type</label>
<select class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Title</label>
<select class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>

<div class="form-group">
<label for="exampleInputPassword1">First Name</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Middle Name</label>
<input type="text" placeholder="Middle Name" id="exampleInputPassword1" class="form-control">
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
<input type="text" placeholder="Title" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Ni Number</label>
<input type="text" placeholder="Title" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>


<div class="form-group">
<label for="exampleInputPassword1">Appointment Date</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Marital Status</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Spouse Date of Birth</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>
<!--<h3 class="box-title">Service Address</h3>
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
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>-->


<h3 class="box-title">Residential Address</h3>
<div class="form-group">
<label for="exampleInputPassword1">Change</label>
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
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="exampleInputPassword1" class="form-control">
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
<input type="text" id="exampleInputPassword1" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Country</label>
<input type="text" id="exampleInputPassword1" class="form-control">
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

<div class="col-xs-12">
<div class="col-xs-12 col-xs-6">
<p>AB Limited</p>
<p>C Limited</p>
</div>
<div class="col-xs-12 col-xs-6">
<p>Director/Shareholder</p>
<p>Secretary</p>
</div>
</div>



<button class="btn btn-primary">SUBMIT</button>

</div>
 </div>
 
 </div>


            
          </div>
        </form>
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
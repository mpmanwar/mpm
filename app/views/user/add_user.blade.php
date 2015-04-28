@extends('layouts.layout')
@section('content')       
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @extends('layouts.inner_leftside')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      MY PRACTICE MANAGER
                        <small>CLIENT NAME Limited</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
{{ Form::open(array('url' => '/user_process', 'files' => true)) }}               
<section class="content">
<div class="row">
<div class="top_bts">
<ul>
<li><button class="btn btn-info"><i class="fa fa-print"></i> Print</button></li>
<li><button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button></li>
<li><button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button></li>
<li><button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button></li>
<li><button class="btn btn-warning"><i class="fa fa-edit"></i> Add Client - Key In</button></li>
<li><button class="btn btn-success"><i class="fa fa-edit"></i> Improve CSV Or Excel</button></li>
<li><button class="btn btn-primary"><i class="fa fa-edit"></i> Import From CH </button></li>
<li><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></li>
<div class="clearfix"></div>
</ul>
  
</div>
</div>


<div class="practice_mid">

<div class="row box_border2 row_cont">
 <div class="col-xs-12 col-xs-6 p_left">
 <h2 class="res_t">Enter There Details <small>General Settings</small></h2>
  </div>
 <div class="col-xs-12 col-xs-6">
 <div class="setting_con">
 <a href="/" class="btn btn-success btn-lg"><i class="fa fa-cog fa-fw"></i>Settings</a>
 </div>
 </div>
 <div class="clearfix"></div>
</div>

<div class="user_account">
 <div class="user_ncon">
<div class="form-group">
<label for="f_name">First Name</label>
<input type="text" placeholder="First Name" id="f_name" name="f_name" class="form-control">
</div>
</div>

 <div class="user_ncon">
<div class="form-group">
<label for="l_name">Last Name</label>
<input type="text" placeholder="Last Name" id="l_name" name="l_name" class="form-control">
</div>
</div>

 <div class="user_econ">
<div class="form-group">
<label for="email">Email</label>
<input type="text" placeholder="Email" id="email" name="email" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="tabarea">
    <div class="box-header">
        <h3 class="box-title">Access to the accounts</h3>  
                                     
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
    <p>Choose the user's level of access to this organisation's accounts:</p>     
        <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
        <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"></th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">VAT</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">CORP TAX</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STATUTORY ACCOUNTS</th>
                
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">MANAGEMENT ACCOUNTS</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">NOTICE BOARD</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">INCOME TAX RETURNS</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">ETC</th>
                </tr>
            </thead>
                                        
                                        
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <tr class="odd">
                    <td class="  sorting_1">
                    <div class="form-group"> 
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                       STAFF
                    </label>
                </div>
                
                
            </div>
                    </td>
                    <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                    <td class=" " align="center"><img src="{{ URL :: asset('img/cross.png') }}" /></td>
                </tr>
                <tr class="even">
                    <td class="  sorting_1">
                    <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        CLIENT
                    </label>
                </div>
                </td>
                   <td class=" " align="center"></td>
                     <td class=" " align="center"></td>
                     <td class=" " align="center"></td>
                     <td class=" " align="center"></td>
                     <td class=" " align="center"></td>
                     <td class=" " align="center"></td>
                     <td class=" " align="center"><img src="{{ URL :: asset('img/cross.png') }}" /></td>
                </tr>
                
                <tr class="odd">
                    <td class="  sorting_1">
                    <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
                        ADMIN
                    </label>
                </div>
                </td>
                    <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><input type="radio" name="" id="" value=""></td>
                     <td class=" " align="center"><img src="{{ URL :: asset('img/cross.png') }}" /></td>
                </tr>
                
                
                
                
                </tbody></table>
                <div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
    </div><!-- /.box-body -->
                          
</div>
 <div class="clearfix"></div>
<div class="row ">
 <div class="col-xs-12 col-xs-6 chk_cont">
<div class="checkbox">
<label>
<input type="checkbox"/>
<strong> Manage Users</strong> Allows this user to add remove users and change permissions
</label>                                                
</div>
<div class="checkbox">
<label>
<input type="checkbox"/>
<strong> Payroll Admin</strong> You do not have permission to change this
</label>                                                
</div>
 </div>
  <div class="col-xs-12 col-xs-6 chk_cont">
<div class="save_con">
<button class="btn btn-primary" type="Save">Continue</button>
<button class="btn btn-danger" type="Save">Cancel</button>
</div>

 </div>
</div>

</div>


    </section><!-- /.content -->
{{ Form::close() }}
            </aside><!-- /.right-side -->
        
@stop
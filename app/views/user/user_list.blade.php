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
                        <li class="active">User List</li>
                    </ol>
                </section>

                <!-- Main content -->
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
<form>
<div class="row box_border2 row_cont">
 <div class="col-xs-12 col-xs-6 p_left">
 <h2 class="res_t">USERS <small>General Settings</small></h2>

 </div>
 <div class="col-xs-12 col-xs-6">
 <div class="setting_con">
 <a href="/" class="btn btn-success btn-lg"><i class="fa fa-cog fa-fw"></i>Settings</a>
 </div>
 </div>
 <div class="clearfix"></div>
</div>

<div class="add_usercon">
<p><a href="#">What's this?</a></p>
<a href="/add_user" class="btn btn-success"><i class="fa fa-edit"></i> Add User</a>
</div>

<div class="tabarea">
<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab_1">Users</a></li>
                    <!-- <li class=""><a data-toggle="tab" href="#tab_2">Users2</a></li> -->
                    
                    <li class="pull-right"><a class="text-muted" href="#"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab_1" class="tab-pane active">
                      <!--table area-->
                        <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
                    <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Permissions</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Last Login</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Login this week </th></tr>
                        </thead>
                        
                        <!--<tfoot>
                            <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                        </tfoot>-->
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr class="odd">
                                <td class="  sorting_1">Abel Asiamah</td>
                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                            <tr class="even">
                                <td class="  sorting_1">Ben Abraham</td>
                                <td class=" ">Financial Adviser</td>
                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                            
                             <tr class="odd">
                                <td class="  sorting_1">Abel Asiamah</td>
                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                            <tr class="even">
                                <td class="  sorting_1">Ben Abraham</td>
                                <td class=" ">Financial Adviser</td>
                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                             <tr class="odd">
                                <td class="  sorting_1">Abel Asiamah</td>
                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                            <tr class="even">
                                <td class="  sorting_1">Ben Abraham</td>
                                <td class=" ">Financial Adviser</td>
                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                             <tr class="odd">
                                <td class="  sorting_1">Abel Asiamah</td>
                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                <td class=" ">3</td>
                            </tr>
                            <tr class="even">
                                <td class="  sorting_1">Ben Abraham</td>
                                <td class="gray_y">Financial Adviser</td>
                                 <td class=""><a href="#" class="gray_y">Pending</a></td>
                                <td class=" "></td>
                                <td class=" "></td>
                            </tr>
                           
                           </tbody></table>
                           <div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
                </div>
                      <!--end table--> 
                    </div><!-- /.tab-pane -->
                                    <!-- <div id="tab_2" class="tab-pane">
                                       <div class="box-body table-responsive">
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
                                    <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name1</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Permissions</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Last Login</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Login this week </th></tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                                        </tfoot>
                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <tr class="odd">
                                                <td class="  sorting_1">Abel Asiamah</td>
                                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="  sorting_1">Ben Abraham</td>
                                                <td class=" ">Financial Adviser</td>
                                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                            
                                             <tr class="odd">
                                                <td class="  sorting_1">Abel Asiamah</td>
                                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="  sorting_1">Ben Abraham</td>
                                                <td class=" ">Financial Adviser</td>
                                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                             <tr class="odd">
                                                <td class="  sorting_1">Abel Asiamah</td>
                                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="  sorting_1">Ben Abraham</td>
                                                <td class=" ">Financial Adviser</td>
                                                 <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">2 May 2013 10:31 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                             <tr class="odd">
                                                <td class="  sorting_1">Abel Asiamah</td>
                                                <td class=" ">Financial Adviser + Manage User + Provide Support</td>
                                                <td class=" "><a href="#" class="active_t">Active</a></td>
                                                <td class=" ">1 May 2013 9:13 p.m.</td>
                                                <td class=" ">3</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="  sorting_1">Ben Abraham</td>
                                                <td class="gray_y">Financial Adviser</td>
                                                 <td class=""><a href="#" class="gray_y">Pending</a></td>
                                                <td class=" "></td>
                                                <td class=" "></td>
                                            </tr>
                                           
                                           </tbody></table>
                                           <div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
                                                                    </div>
                                    </div> --><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div>
</div>

</form>
</div>






                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
        
      
@stop




@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function() {
    $('#example2').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,


        //"iDisplayLength": -1,
        //"aaSorting": [[ 5, "desc" ]],
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true}
        ]

    });
});

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
                        ORGANISATION CLIENT LIST
                        <!-- <small>CLIENT NAME  Limited</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Organisation Clients</li>
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
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
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
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <a href="/organisation/add-client" class="btn btn-info">ADD CLIENT</a>
                  </li>
                  <li>
                    <button class="btn btn-success">BULK CSV IMPORT</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
               <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-info">ON-BOARD NEW CLIENT</button>
                  </li>
                  <li>
                    <button class="btn btn-success">Search</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>
            </div>
            
            <div class="table_top_box">
            <ul>
            <li style="width:auto;"><input type="button" value="Clear"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
            <li><input type="text" class="s_box"></li>
           
            </ul>
            <div class="clearfix"></div>
          
            </div>
            
            <div class="box-body table-responsive">
              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
                <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
                        
                    <thead>
                        <tr role="row">
                            <th><input type="checkbox" id="allCheckSelect"/></th>
                            <th>#</th>
                            <th>STAFF</th>
                            <th>BUSINESS TYPE</th>
                            <th>BUSINESS NAME</th>
                            <th>Year End</th>
                            <th>Deadline</th>
                            <th>Count Down</th>
                            <th>Next Return Due</th>
                            <th>Count Down</th>
                            <th>VAT Stagger</th>
                            <th>CT Return Deadline</th>
                            <th>Count Down</th>
                        </tr>
                    </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                          <tr class="all_check">
                            <td align="center">
                              <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="1" id="client_delete_id"/>
                            </td>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Jan-April - Jul-Oct</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr class="all_check">
                            <td align="center">
                              <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="1" id="client_delete_id"/>
                            </td>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Jan-April - Jul-Oct</td>
                            <td></td>
                            <td></td>
                          </tr>

                          <tr class="all_check">
                            <td align="center">
                              <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="1" id="client_delete_id"/>
                            </td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Jan-April - Jul-Oct</td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                                           <!--<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">? Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next ? </a></li></ul></div></div></div>--></div>
                                </div>
            
            
            

            
                      
                      
          </div>
        </form>
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
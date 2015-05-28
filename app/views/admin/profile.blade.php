@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
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
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,


        //"iDisplayLength": -1,
        //"aaSorting": [[ 5, "desc" ]],
        "aoColumns":[
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true}
        ]

    });

    $("#example2_filter").hide();
    
});

</script>
@stop

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
                    <h1>My Profile</h1>
                    <ol class="breadcrumb">
                        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
   <div class="practice_mid">
        <div class="box-body table-responsive">
            <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
                <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
                
                <thead>
                    <tr role="row">
                      <th><strong>Name</strong></th>
                      <th align="center"><strong>Website</strong></th>
                      <th align="center"><strong>Practice_Name</strong></th>
                      <th align="center"><strong>Phone No</strong></th>
                      <th align="center"><strong>Country</strong></th>
                      <th align="center"><strong>Action</strong></th>
                    </tr>
                </thead>
        
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    @if(!empty($admin_details) && count($admin_details) > 0)
                       <tr>
                            <td align="center">{{ $admin_details['first_name'] }} {{ $admin_details['last_name'] }}</td>
                            <td align="center">{{ $admin_details['website'] }}</td>
                            <td align="center">{{ $admin_details['practice_name'] }} </td>
                            <td align="center">{{ $admin_details['phone'] }} </td>
                            <td align="center">{{ $admin_details['country'] }} </td>
                            <td align="center"><a href="/profile-edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php ?>
                    @endif
                  
                  
                </tbody>
              </table>
        
                </div>
            </div>
            
        </div>
        
    </div>
</section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
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
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[10, 25, 50, -1], [25, 50, 100, 200]],
        "iDisplayLength": 25,


        "aoColumns":[
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

    //$("#example2_filter").hide();
    
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
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        @include('layouts.outer_leftside')
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side  {{ $right_class }}">
                <!-- Content Header (Page header) -->
                @include('layouts.below_header')

                <!-- Main content -->
                <section class="content">
      <div class="row">
        <div class="top_bts">
          <ul>
            <!-- <li>
              <button class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </li> -->
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <!-- <li>
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li> -->
            <!-- <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li> -->
            

            <div class="clearfix"></div>
          </ul>
        </div>

        <!-- <div style="float: right; margin-right: 43px;"><a href="javascript:void(0)" id="archive_div">Show Archived</a></div> -->

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
                  <li>
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>

            <li>
              <button type="button" id="archivedButton" style="display:none;" class="btn btn-warning">Archive</button>
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
                    <!-- <button type="button" id="show_search" class="btn btn-success">Search</button> -->
                    <a href="javascript:void(0)" id="archive_div">Show Archived</a>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>
            </div>
            
            <!-- <div class="table_top_box">
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
                      
            </div> -->
            
<div class="box-body table-responsive">
  <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
    <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            
        <thead>
            <tr role="row">
                <th><input type="checkbox" id="allCheckSelect"/></th>
                <th>BUSINESS TYPE</th>
                <th>BUSINESS NAME</th>
                <th>Year End</th>
                <th>Deadline</th>
                <th>Count Down</th>
                <th>Next Return Due</th>
                <th>Count Down</th>
                <th>VAT Stagger</th>
                <th>Correspondence Address</th>
            </tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
            @if(!empty($client_details))
                <?php $i=1; ?>
                @foreach($client_details as $key=>$client_row)
                
                <tr class="all_check">
                    <td align="center">
                      <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                    </td>
                    <td>{{ $client_row['business_type'] or "" }}</td>
                    <td><a href="">{{ $client_row['business_name'] or "" }}</a></td>
                    <td>{{ $client_row['acc_ref_date'] or "" }}</td>
                    <td>{{ $client_row['next_acc_due'] or "" }}</td>
                    <td>{{ $client_row['deadacc_count'] or "" }}</td>
                    <td>{{ $client_row['next_ret_due'] or "" }}</td>
                    <td>{{ $client_row['next_ret_due'] or "" }}</td>
                    <td>{{ $client_row['vat_stagger'] or "" }}</td>
                    <td>{{ (!empty($client_row['cont_addr_line1'])) ? $client_row['cont_addr_line1']."," : '' }} {{ (!empty($client_row['cont_city'])) ? $client_row['cont_city']."," : '' }} {{ (!empty($client_row['cont_postcode'])) ? $client_row['cont_postcode'] : '' }}</td>
                </tr>
                <?php $i++; ?>
              @endforeach
            @endif
          
          
        </tbody>
      </table>

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
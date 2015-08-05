@extends('layouts.layout')

@section('mycssfile')
<link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
  .nav-tabs-custom > .nav-tabs > li{ margin-right: -3px;}
</style>

@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/client_list_allocation.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
var Table1, Table2;
$(function() {
  Table1 = $('#example1').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
    "iDisplayLength": 50,
    "language": {
      "lengthMenu": "Show _MENU_ entries",
      "zeroRecords": "Nothing found - sorry",
      "info": "Showing page _PAGE_ of _PAGES_",
      "infoEmpty": "No records available",
      "infoFiltered": "(filtered from _MAX_ total records)"
    },

    "aoColumns":[
      {"bSortable": false},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true}
    ]

  });

  Table2 = $('#example2').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
    "iDisplayLength": 50,
    "language": {
      "lengthMenu": "Show _MENU_ entries",
      "zeroRecords": "Nothing found - sorry",
      "info": "Showing page _PAGE_ of _PAGES_",
      "infoEmpty": "No records available",
      "infoFiltered": "(filtered from _MAX_ total records)"
    },

    "aoColumns":[
      {"bSortable": false},
      //{"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true}
    ]

  });

   Table1.fnSort( [ [2,'asc'] ] );
   Table2.fnSort( [ [1,'asc'] ] );

});

</script>

@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
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
<section class="content">

      <div class="row">
        <div class="top_bts">
          <ul>
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <!-- <li>
              <a href="/chdata/index" class="btn btn-info">PERMANENT DATA</a>
            </li>
            <li>
              <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
            <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li>
            <li>
              <button class="btn btn-success">IMPORT FROM CSV</button>
            </li> -->
            <!-- <li>
              <button class="btn btn-primary">REQUEST FROM CLIENT</button>
            </li>
            <li>
              <button class="btn btn-danger">REQUEST FROM OLD ACCOUNTANT</button>
            </li> -->
            <div class="clearfix"></div>
          </ul>
        </div>

        <div class="top_search_con" style="margin-right: 38px;">
          <table width="100%" border="0">
            <tbody><tr>
              <td><!-- COMPANIES HOUSE --></td>
              <td>&nbsp;</td>
              <td><!-- <button class="btn btn-danger">SYNC DATA</button> --></td>
              <td>&nbsp;</td>
              <td>
                <!-- <a href="#" data-toggle="modal" data-target="#bulk_allocation-modal" class="btn btn-info">Bulk Allocation</a> -->
                <a href="javascript:void(0)" class="btn btn-info bulk_allocation">Bulk Allocation</a>
              </td>
            </tr>
          </tbody></table>
        </div>
        <div class="clearfix"></div>
      </div>

<div class="practice_mid">
        

<div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg" id="header_ul">
        <li class="{{ ($client_type == 'org')?'active':'' }}" id="tab_1"><a class="open_header client_allocate" data-id="1" data-type="org" href="javascript:void(0)">ORGANISATIONAL CLIENT LIST</a></li>
        <li id="tab_2" class="{{ ($client_type == 'ind')?'active':'' }}"><a class="open_header client_allocate" data-id="2" data-type="ind" href="javascript:void(0)">INDIVIDUAL CLIENT LIST</a></li>
       </ul>
<div class="tab-content">
<input type="hidden" id="client_type" name="client_type" value="org">
  <div id="step1" class="tab-pane" style="display:{{ ($client_type == 'org')?'block':'none' }};">
    <div class="tab_topcon" style="position: relative; left:30%;">
      {{ Form::open(array('url'=>'/allocationClientsByService')) }}
      <input type="hidden" name="type" value="org">
      <div class="selctbox_containor1">
        <div class="select_t">Select Service :</div>
        <div class="sel_box">
          <select class="form-control" name="org_service_id" id="org_service_id"><!--.service_dropdown-->
            <option value="0">None</option>
            @if( isset($old_services) && count($old_services)>0 )
              @foreach($old_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "org" )
                  <option value="{{ $service_row->service_id }}" {{ (isset($service_id) && $service_id == $service_row->service_id)?"selected":"" }}>{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif

            @if( isset($new_services) && count($new_services)>0 )
              @foreach($new_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "org" )
                  <option value="{{ $service_row->service_id }}" {{ (isset($service_id) && $service_id == $service_row->service_id)?"selected":"" }}>{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
        <button type="submit" class="search_t" style="margin-left: 10px; height: 33px;">Save</button>
      </div>
      {{ Form::close() }}
      <div class="clearfix"></div>
    </div>

    <div id="orgclient_table">
    <table class="table table-bordered table-hover dataTable org_alocation" id="example1" aria-describedby="example1_info">
      
      <thead>
        <tr role="row">
          <th width="2%"><span class="custom_chk"><input type='checkbox' class="CheckorgCheckbox" /></span></th><!-- allCheckSelect -->
          <th width="10%">Type</th>
          <th>BUSINESS NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">

        @if(isset($org_client_details) && count($org_client_details) >0)
          @foreach($org_client_details as $key=>$details)
            @if(isset($details['other_services']) && in_array($service_id, unserialize($details['other_services'])))
              <tr class="even">
                <td><span class="custom_chk"><input type='checkbox' class="checkbox org_Checkbox" name="org_checkbox[]" value="{{ $details['client_id'] or "" }}" id="org_checkbox{{ $details['client_id'] }}" /><label for="org_checkbox{{ $details['client_id'] }}"></label></span></td>
                <td align="left">{{ $details['business_type'] or "" }}</td>
                <td align="left"><a target="_blank" href="/client/edit-org-client/{{ $details['client_id'] }}">{{ $details['business_name'] or "" }}</a></td>
                @for($i=1; $i <=5; $i++)
                <td align="left">
                  <select class="form-control save_manual_user" data-client_id="{{ $details['client_id'] }}" data-column="{{ $i }}" name="org_staff_id{{ $i }}" id="{{ $details['client_id'] }}_org_staff_id{{ $i }}">
                    <option value="">None</option>
                    @if(!empty($staff_details))
                      @foreach($staff_details as $key=>$staff_row)
                      <option value="{{ $staff_row->user_id }}" {{ (isset( $details['allocation'][$service_id]['staff_id'.$i] ) && ($details['allocation'][$service_id]['staff_id'.$i] == $staff_row->user_id) && isset( $details['allocation'][$service_id]['service_id'] ) && ($details['allocation'][$service_id]['service_id'] == $service_id))?"selected":""}} >{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                      @endforeach
                    @endif
                  </select>
                </td>
                @endfor
              </tr>
            @endif
          @endforeach
        @endif
        
      </tbody>
    </table>
  </div>
    <div class="clearfix"></div>
  </div>

  <div id="step2" class="tab-pane" style="display:{{ ($client_type == 'ind')?'block':'none' }};"><!--.active-->
    <div class="tab_topcon" style="position: relative; left:30%;">
      {{ Form::open(array('url'=>'/allocationClientsByService')) }}
      <input type="hidden" name="type" value="ind">
      <div class="selctbox_containor1">
        <div class="select_t">Select Service :</div>
        <div class="sel_box">
          <select class="form-control" name="ind_service_id" id="ind_service_id"><!--.service_dropdown-->
            <option value="0">None</option>
            @if( isset($old_services) && count($old_services)>0 )
              @foreach($old_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "ind" )
                  <option value="{{ $service_row->service_id }}" {{ (isset($service_id) && $service_id == $service_row->service_id)?"selected":"" }} >{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif

            @if( isset($new_services) && count($new_services)>0 )
              @foreach($new_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "ind" )
                  <option value="{{ $service_row->service_id }}" {{ (isset($service_id) && $service_id == $service_row->service_id)?"selected":"" }}>{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
        <button type="submit" class="search_t" style="margin-left: 10px; height: 33px;">Save</button>
      </div>
      {{ Form::close() }}
      
      <div class="clearfix"></div>
    </div>
    <table class="table table-bordered table-hover dataTable org_alocation" id="example2" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th width="5%"><span class="custom_chk"><input type='checkbox' class="CheckorgCheckbox" /></span></th><!-- allCheckSelect -->
          <!-- <th>Type</th> -->
          <th>CLIENT NAME</th>
          <th width="14%">STAFF NAME</th>
          <th width="14%">STAFF NAME</th>
          <th width="14%">STAFF NAME</th>
          <th width="14%">STAFF NAME</th>
          <th width="14%">STAFF NAME</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">

        @if(isset($ind_client_details) && count($ind_client_details) >0)
          @foreach($ind_client_details as $key=>$details)
            @if(isset($details['other_services']) && in_array($service_id, unserialize($details['other_services'])))
              <tr class="even">
                <td><span class="custom_chk"><input type='checkbox' class="checkbox ind_Checkbox" name="ind_checkbox[]" value="{{ $details['client_id'] or "" }}" id="ind_checkbox{{ $details['client_id'] }}" /><label for="ind_checkbox{{ $details['client_id'] }}"></label></span></td>
                <!-- <td align="left">{{ $details['business_type'] or "" }}</td> -->
                <td align="left"><a target="_blank" href="/client/edit-ind-client/{{ $details['client_id'] }}">{{ $details['client_name'] or "" }}</a></td>
                @for($i=1; $i <=5; $i++)
                <td align="left">
                  <select class="form-control save_manual_user" data-client_id="{{ $details['client_id'] }}" data-column="{{ $i }}" name="ind_staff_id{{ $i }}" id="{{ $details['client_id'] }}_ind_staff_id{{ $i }}">
                    <option value="">None</option>
                    @if(!empty($staff_details))
                      @foreach($staff_details as $key=>$staff_row)
                      <option value="{{ $staff_row->user_id }}" {{ (isset( $details['allocation'][$service_id]['staff_id'.$i] ) && ($details['allocation'][$service_id]['staff_id'.$i] == $staff_row->user_id) && isset( $details['allocation'][$service_id]['service_id'] ) && ($details['allocation'][$service_id]['service_id'] == $service_id))?"selected":""}} >{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                      @endforeach
                    @endif
                  </select>
                </td>
                @endfor
              </tr>
            @endif
          @endforeach
        @endif
        
      </tbody>
    </table>
  </div>
      

</div>

</div>
          

</div>
        
    
</div>
</section>


        <!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->



<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="bulk_allocation-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">BULK ALLOCATION</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div style="font-size: 18px; color: #008d4c; text-align: center;" id="success_msg"></div>
      <table class="table table-bordered table-hover dataTable">
        <tr>
          <td width="30%"><strong style="font-size: 16px;">Select Staff : </strong></td>
          <td colspan="2">
            <select class="form-control" name="staff_id" id="staff_id">
              <option value="">None</option>
              @if(!empty($staff_details))
                @foreach($staff_details as $key=>$staff_row)
                <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                @endforeach
              @endif
            </select>
          </td>
        </tr>

        <tr>
          <td width="30%">&nbsp;</td>
          <td width="35%">
            <strong>Column 1</strong> <input type="radio" name="column" value="1" class="radio_column">
          </td>
          <td width="35%">
            <strong>Column 3</strong> <input type="radio" name="column" value="3" class="radio_column">
          </td>
        </tr>

        <tr>
          <td width="30%">&nbsp;</td>
          <td width="35%">
            <strong>Column 2</strong> <input type="radio" name="column" value="2" class="radio_column">
          </td>
          <td width="35%">
            <strong>Column 4</strong> <input type="radio" name="column" value="4" class="radio_column">
          </td>
        </tr>

        <tr>
          <td width="30%">&nbsp;</td>
          <td width="35%">
            <strong>Column 5</strong> <input type="radio" name="column" value="5" class="radio_column">
          </td>
          <td width="35%"></td>
        </tr>
    
    </table>

        <div class="modal-footer clearfix" style="padding-right: 0px;">
          <div class="email_btns">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary save_bulk_allocation" name="save">Save</button>
          </div>
        </div>


      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




@stop
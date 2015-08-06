@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    
@stop

@section('myjsfile')
<!-- <script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script> -->
<script src="{{ URL :: asset('js/ch_data.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
var Table1, Table3;
$(function() {
    Table1 = $('#example1').dataTable({
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
            {"bSortable": false},
            {"bSortable": false}
        ]

    });
    Table1.fnSort( [ [8,'asc'] ] );

  for(var k=1; k<=10;k++){
    //var table = Table2+""+k;
    var table = $('#example2'+k).dataTable({
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
    table.fnSort( [ [7,'asc'] ] );
  }

  /*var Table21 = $('#example21').dataTable({
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
    Table21.fnSort( [ [7,'asc'] ] );

    var Table22 = $('#example22').dataTable({
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
    Table22.fnSort( [ [7,'asc'] ] );

    var Table23 = $('#example23').dataTable({
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
    Table23.fnSort( [ [7,'asc'] ] );

    var Table24 = $('#example24').dataTable({
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
    Table24.fnSort( [ [7,'asc'] ] );*/

  Table3 = $('#example3').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[10, 25, 50, -1], [25, 50, 100, 200]],
        "iDisplayLength": 25,

        "aoColumns":[
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });


    

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
            @include('layouts.inner_leftside')
        </section>
        <!-- /.sidebar -->
    </aside>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side {{ $right_class }}">
  <input type="hidden" name="service_id" id="service_id" value="{{ $service_id }}">
    <!-- Content Header (Page header) -->
    @include('layouts.below_header')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="practice_hed">
        <div class="top_bts">
          <ul>
            <!-- <li>
              <button class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </li>-->
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <li>
              <button class="btn btn-danger">SYNC DATA</button>
            </li>
            <li>
              <div class="import_fromch_main">
                <div class="import_fromch">
                  <a href="/import-from-ch/{{ base64_encode('ch_list') }}" class="import_fromch_link">IMPORT FROM CH</a>
                  <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                  <div class="clearfix"></div>
                </div>
                <div class="i_dropdown open_toggle"><a href="/chdata/bulk-company-upload-page/{{ base64_encode('ch_list') }}">BULK COMPANY UPLOAD</a></div>
              </div>
              <!-- <a href="/import-from-ch/{{ base64_encode('ch_list') }}" class="btn btn-info">IMPORT FROM CH</a> -->
            </li>
            <li>
              <a href="https://beta.companieshouse.gov.uk" target="_blank" class="btn btn-info">WEBCHECK</a>
            </li>

            <div class="clearfix"></div>
          </ul>
        </div>

        <div style="float: right;">
          <table>
            <tr>
              <td width="30%" class="head_txt">Filter By Staff</td>
              <td width="2%">&nbsp;</td>
              <td width="68%">
                <select class="form-control">
                  <option value="all">Show All</option>
                  @if(!empty($staff_details))
                    @foreach($staff_details as $key=>$staff_row)
                    <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                    @endforeach
                  @endif
                  <option value="none">Unassigned</option>
                </select>
              </td>
            </tr>
          </table>
        </div>
      </div>

      </div>
      <div class="practice_mid">
      

          <div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg">
        <li class="active"><a data-toggle="tab" href="#tab_1">COMPANIES HOUSE - PERMANENT DATA</a></li>
        <li><a data-toggle="tab" href="#tab_2">ANNUAL RETURNS - TASK MANAGEMENT</a></li>
        <li><a data-toggle="tab" href="#tab_3">COMPLETED TASKS</a></li>
      </ul>
<div class="tab-content">
  <div id="tab_1" class="tab-pane active">
    <div class="tab_topcon" style="position:relative; height: 25px">

      <div class="send_task" style="width:45.5%; margin: -5px 0 0 300px; position: absolute;">
        <span class="custom_chk"><input type='checkbox' id="manage_check" /><label for="manage_check"> Auto Send To Task Management</label></span>  <input type="text" name="dead_line" id="dead_line" style="width:7%;"> Days Before Deadline
      </div>

      <div class="clearfix"></div>
    </div>
    <table class="table table-bordered table-hover dataTable ch_returns" id="example1" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th><span class="custom_chk"><input type='checkbox' id="CheckallCheckbox" /></span></th>
          <th>D0I</th>
          <th>CRN</th>
          <th>BUSINESS NAME</th>
          <th>YEAR END</th>
          <th>AUTHEN CODE</th>
          <th>LAST RETURN DATE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>SEND TO TASKS</th>
          <th>STAFF</th>
        </tr>
      </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all">
      @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['registration_number']) && $details['registration_number']!= "")
            <tr class="even">
                <td><span class="custom_chk"><input type='checkbox' class="checkbox" name="checkbox[]" value="{{ $details['client_id'] or "" }}"/></span></td>
                <td class="sorting_1" align="center">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="center">{{ $details['registration_number'] or "" }}</td>
                <td align="left"><a href="/chdata-details/{{ $details['registration_number'] }}">{{ $details['business_name'] or "" }}</a></td>
                <td align="center">{{ $details['acc_ref_day'] or "" }}-{{ $details['ref_month'] or "" }}</td>
                <td align="center">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="center">{{ isset($details['last_acc_madeup_date'])?date("d-m-Y", strtotime($details['last_acc_madeup_date'])):"" }}</td>
                <td align="center">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="center">{{ $details['deadacc_count'] or "" }}</td>
                <td align="center" id="after_send_{{ $details['client_id'] }}">
                  @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "N")
                    <button type="button" class="send_btn send_manage_task" data-client_id="{{ $details['client_id'] }}" data-field_name="ch_manage_task">Send</button>
                  @else
                    <button type="button" class="sent_btn">Sent</button>
                  @endif
                </td>
                <td align="center"></td>
            </tr>
          @endif 
        @endforeach
      @endif
      
    </tbody>
  </table>

  </div>

  <div id="tab_2" class="tab-pane">
    <ul class="nav nav-tabs nav-tabsbg">
        <li class="active"><a data-toggle="tab" href="#tab_21">All [{{ $all_count }}]</a></li>
        <li><a data-toggle="tab" href="#tab_22">Not Started [{{ $not_started_count }}]</a></li>
        @if(isset($jobs_steps) && count($jobs_steps) >0)
          <?php $i = 3;?>
            @foreach($jobs_steps as $key=>$value)
              <li class="header_step_{{ $value['step_id']}}" style="display: {{ ($value['status'] == 'H')?'none':'block'}}"><a data-toggle="tab" href="#tab_2{{ $i }}"><span id="step_field_{{ $value['step_id']}}">{{ $value['title'] or "" }}</span> [{{ $value['count'] or "0" }}]</a></li>
              <?php $i++;?>
            @endforeach
        @endif
        
    </ul>
    
  <div class="tab-content">

  <div id="tab_21" class="tab-pane top_margin active">
    
    <table class="table table-bordered table-hover dataTable ch_returns" id="example21" aria-describedby="example21_info">
      <thead>
        <tr role="row">
          <th>DELETE</th>
          <th>STAFF</th>
          <th>DOI</th>
          <th>BUSINESS TYPE</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>JOB START DATE</th>
          <th>STATUS <a href="#" data-toggle="modal" data-target="#status-modal">Add/Edit list</a></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['registration_number']) && $details['registration_number']!= "")
            @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "Y")
              <tr class="even">
                <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}"><img src="/img/cross.png"></a></td>
                <td align="left"></td>
                <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="left">{{ $details['business_type'] or "" }}</td>
                <td align="left"><a href="/chdata-details/{{ $details['registration_number'] }}">{{ $details['business_name'] or "" }}</a></td>
                <td align="left">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="left">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="left">{{ $details['deadacc_count'] or "" }}</td>
                <td align="center"></td>
                <td align="center" width="12%">
                  <select class="table_select status_dropdown" id="status_dropdown" data-client_id="{{ $details['client_id'] }}">
                    <option value="2">Not Started</option>
                    @if(isset($jobs_steps) && count($jobs_steps) >0)
                      @foreach($jobs_steps as $key=>$value)
                        <option value="{{ $value['step_id'] or "" }}" {{ ((isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == $value['step_id']) && (isset($details['job_status'][$service_id]['client_id']) && $details['job_status'][$service_id]['client_id'] == $details['client_id']))?"selected":"" }}>{{ $value['title'] or "" }}</option>
                      @endforeach
                    @endif
                  </select>
                </td>
              </tr>
            @endif 
          @endif
        @endforeach
      @endif
        
      </tbody>
    </table>
    </div>
           
    <div id="tab_22" class="tab-pane top_margin">
      <table class="table table-bordered table-hover dataTable ch_returns" id="example22" aria-describedby="example22_info">
      <thead>
        <tr role="row">
          <th>DELETE</th>
          <th>STAFF</th>
          <th>DOI</th>
          <th>BUSINESS TYPE</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>JOB START DATE</th>
          <th>STATUS <a href="#" data-toggle="modal" data-target="#status-modal">Add/Edit list</a></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['registration_number']) && $details['registration_number']!= "")
            @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "Y")
              @if(!isset($details['job_status'][$service_id]['status_id']))
              <tr class="even">
                <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}"><img src="/img/cross.png"></a></td>
                <td align="left"></td>
                <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="left">{{ $details['business_type'] or "" }}</td>
                <td align="left"><a href="/chdata-details/{{ $details['registration_number'] }}">{{ $details['business_name'] or "" }}</a></td>
                <td align="left">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="left">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="left">{{ $details['deadacc_count'] or "" }}</td>
                <td align="center"></td>
                <td align="center" width="12%">
                  <select class="table_select status_dropdown" id="status_dropdown" data-client_id="{{ $details['client_id'] }}">
                    <option value="2">Not Started</option>
                    @if(isset($jobs_steps) && count($jobs_steps) >0)
                      @foreach($jobs_steps as $key=>$value)
                        <option value="{{ $value['step_id'] or "" }}" {{ ((isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == $value['step_id']) && (isset($details['job_status'][$service_id]['client_id']) && $details['job_status'][$service_id]['client_id'] == $details['client_id']))?"selected":"" }}>{{ $value['title'] or "" }}</option>
                      @endforeach
                    @endif
                  </select>
                </td>
              </tr>
              @endif
            @endif 
          @endif
        @endforeach
      @endif
        
      </tbody>
    </table>  
    </div>
     
    @for($k=3; $k <= 10;$k++)                          
    <div id="tab_2{{$k}}" class="tab-pane top_margin">
      <table class="table table-bordered table-hover dataTable ch_returns" id="example2{{$k}}" aria-describedby="example2{{$k}}_info">
      <thead>
        <tr role="row">
          <th>DELETE</th>
          <th>STAFF</th>
          <th>DOI</th>
          <th>BUSINESS TYPE</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>JOB START DATE</th>
          <th>STATUS <a href="#" data-toggle="modal" data-target="#status-modal">Add/Edit list</a></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['registration_number']) && $details['registration_number']!= "")
            @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "Y")
              @if(isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == $k)
              <tr class="even">
                <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}"><img src="/img/cross.png"></a></td>
                <td align="left"></td>
                <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="left">{{ $details['business_type'] or "" }}</td>
                <td align="left"><a href="/chdata-details/{{ $details['registration_number'] }}">{{ $details['business_name'] or "" }}</a></td>
                <td align="left">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="left">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="left">{{ $details['deadacc_count'] or "" }}</td>
                <td align="center"></td>
                <td align="center" width="12%">
                  <select class="table_select status_dropdown" id="status_dropdown" data-client_id="{{ $details['client_id'] }}">
                    <option value="2">Not Started</option>
                    @if(isset($jobs_steps) && count($jobs_steps) >0)
                      @foreach($jobs_steps as $key=>$value)
                        <!-- <option value="{{ $value['step_id'] or "" }}"  style="display: {{ ($value['status'] == 'H')?'none':'block'}}">{{ $value['title'] or "" }}</option> -->
                        <option value="{{ $value['step_id'] or "" }}" {{ ((isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == $value['step_id']) && (isset($details['job_status'][$service_id]['client_id']) && $details['job_status'][$service_id]['client_id'] == $details['client_id']))?"selected":"" }}>{{ $value['title'] or "" }}</option>
                      @endforeach
                    @endif
                  </select>
                </td>
              </tr>
              @endif
            @endif 
          @endif
        @endforeach
      @endif
        
      </tbody>
    </table> 
    </div>
    @endfor     
    <!-- <div id="tab_24" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_25" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_26" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_27" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_8" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_9" class="tab-pane top_margin">
      
    </div>
    
    <div id="tab_210" class="tab-pane top_margin">
      
    </div> -->
         

  </div>


  </div>

  <div id="tab_3" class="tab-pane">
    <table class="table table-bordered table-hover dataTable ch_returns" id="example3" aria-describedby="example3_info">
      <thead>
        <tr role="row">
          <th>DELETE</th>
          <th>STAFF</th>
          <th>CRN</th>
          <th>BUSINESS NAME</th>
          <th>LAST RETURN DATE</th>
          <th>FILING DATE</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        <!-- <tr role="row">
          <th><img src="/img/cross.png"></th>
          <th>STAFF</th>
          <th>DO1</th>
          <th>BUSINESS TYPE</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>COMPLETED TASK</th>
          <th></th>
        </tr> -->
        
      </tbody>
    </table>

  </div>
      

</div>

</div>
          

</div>
        
      </div>
    </section>


</aside><!-- /.right-side -->
            


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="status-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FIELD</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '', 'id'=>'field_form')) }}
      <div class="modal-body">
      <table class="table table-bordered table-hover dataTable add_status_table">
        <thead>
          <tr>
            <th align="center" width="20%">Show/Unshow</th>
            <th >Status Name</th>
            <th align="center">Action</th>
          </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($jobs_steps) && count($jobs_steps) >0)
            @foreach($jobs_steps as $key=>$value)
              <tr id="change_status_tr_{{ $value['step_id'] or "" }}">
                <td align="center"><input type="checkbox" class="status_check" {{ ($value['status'] == "S")?"checked":"" }} value="{{ $value['step_id'] or "" }}" data-step_id="{{ $value['step_id'] }}"></td>
                <td><span id="status_span{{ $value['step_id'] or "" }}">{{ $value['title'] or "" }}</span></td>
                <td align="center"><span id="action_{{ $value['step_id'] or "" }}"><a href="javascript:void(0)" class="edit_status" data-step_id="{{ $value['step_id'] or "" }}"><img src="/img/edit_icon.png"></a></span></td>
              </tr>
            @endforeach
          @endif

        </tbody>
    
    </table>

        
      </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
      
@stop




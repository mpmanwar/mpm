@extends('layouts.layout')

@section('mycssfile')
  <link href="{{URL :: asset('css/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/crm.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
  $(function() {
    $('#example11').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[2, 'asc']]
    });

  for(var k=2; k<=10;k++){
    $('#example1'+k).dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[2, 'asc']]

    });
  }

  $('#example2').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
    "iDisplayLength": 25,

    "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": true}
    ],
    "aaSorting": [[6, 'asc']],

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
  
    <!-- Content Header (Page header) -->
    @include('layouts.below_header')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="practice_hed">
        <div class="top_bts">
          <ul>
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>

        <!-- <div style="float: right;">
          <table>
            <tr>
              <td width="50%" class="head_txt">&nbsp;</td>
              <td width="18%" class="head_txt">Filter per deal owner</td>
              <td width="2%">&nbsp;</td>
              <td width="30%">
                <select class="form-control filter_by_staff" name="filter_by_staff" id="filter_by_staff">
                  <option value="{{ base64_encode('all') }}" {{ (isset($owner_id) && $owner_id == 'all')?"selected":"" }}>Show All</option>
                  @if(!empty($staff_details))
                    @foreach($staff_details as $key=>$staff_row)
                      <option value="{{ base64_encode($staff_row->user_id) }}" {{ (isset($staff_id) && $staff_id == $staff_row->user_id)?"selected":"" }}>{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  
                    @endforeach
                  @endif
                  <option value="{{ base64_encode('none') }}" {{ (isset($staff_id) && $staff_id == 'none')?"selected":"" }}>Unassigned</option>
                </select>
              </td>
            </tr>
          </table>
           <div class="clearfix"></div>
        </div> -->
       
        <div id="message_div"><!-- Loader image show while sync data --></div>
      </div>

      

      </div>
      <div class="practice_mid">
      <input type="hidden" name="page_open" id="page_open" value="{{ $page_open }}">
      <input type="hidden" name="encode_page_open" id="encode_page_open" value="{{ $encode_page_open }}">
      <input type="hidden" name="encode_owner_id" id="encode_owner_id" value="{{ $encode_owner_id }}">
          <div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg">
        <li class="{{ ($page_open != 2)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('11') }}/{{ base64_encode($owner_id) }}">LEADS & PROSPECTS</a></li>
        <li class="{{ ($page_open == 2)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('2') }}/{{ base64_encode($owner_id) }}">ENGAGEMENT LETTER / CONTRACT RENEWALS</a></li>
      </ul>
<div class="tab-content">
  <div id="tab_1" class="tab-pane {{ ($page_open != 2)?'active':'' }}">

    <div class="tab_topcon">
      <div class="top_bts" style="float:left;">
        <ul style="padding:0;">
          <li>
            <div class="import_fromch_main" style="width:190px;">
              <div class="import_fromch">
                <a href="javascript:void(0)" class="import_fromch_link">+ NEW OPPORTUNITY</a>
                <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                <div class="clearfix"></div>
              </div>
              <div class="crm_dropdown open_toggle">
              <ul>
                <li><href="javascript:void(0)" data-type="ind" class="open_form-modal">Individual</a></li>
                <li><href="javascript:void(0)" data-type="org" class="open_form-modal">Organisation</a></li>
              </ul>
            </div>
          </div>
          </li>
        <div class="clearfix"></div>
        </ul>
      </div>
      <div class="top_search_con">
       <div class="top_bts">
        <ul style="padding:0;">
          <li style="margin-top: 8px;">Filter per deal owner</li>
          <li>
            <select class="form-control" style="width:150px;" name="filter_by_staff" id="filter_by_staff">
              <option value="{{ base64_encode('all') }}" {{ (isset($owner_id) && $owner_id == 'all')?"selected":"" }}>Show All</option>
              @if(!empty($staff_details))
                @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ base64_encode($staff_row->user_id) }}" {{ (isset($staff_id) && $staff_id == $staff_row->user_id)?"selected":"" }}>{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
              
                @endforeach
              @endif
            </select>
          </li>

          <li style="margin-top: 8px;">
            <a href="javascript:void(0)" id="archive_div">Hide Archived</a>
          </li>
          <li>
            <button type="button" id="archivedButton" class="btn btn-warning">Archive</button>
          </li>
          <div class="clearfix"></div>
        </ul>
      </div>
      </div>
      <div class="clearfix"></div>
    </div>

    <ul class="nav nav-tabs nav-tabsbg">
        <li class="{{ ($page_open == 11)?'active':'' }}">
          <a href="{{ $goto_url }}/{{ base64_encode('11') }}/{{ base64_encode($owner_id) }}">
            <span class="{{($page_open==11)?'active_text':''}}">ALL [<span id="task_count_11">1</span>]</span>
            <div>&#163;50.000.00<br>&#163;50.000.00<br>&#163;50.000.00</div></a>
        </li>

        <li class="{{ ($page_open == 12)?'active':'' }}">
          <a href="{{ $goto_url }}/{{ base64_encode('12') }}/{{ base64_encode($owner_id) }}">
            <span class="{{ ($page_open == 12)?'active_text':'' }}">INCOMING [<span id="task_count_21">1</span>]</span>
            <div>&#163;50.000.00<br>&#163;50.000.00<br>&#163;50.000.00</div></a>
          </a>
        </li>
        
        
    </ul>
    
  <div class="tab-content">

  <div id="tab_11" class="tab-pane top_margin {{ ($page_open == '11')?'active':'' }}">
    <table class="table table-bordered table-hover dataTable crm" id="example11" aria-describedby="example11_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type='checkbox'></th>
          <th width="8%">Lead Owner</th>
          <th>Prospect Name</th>
          <th>Contact Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th width="6%">Deal Age</th>
          <th width="6%">Quote</th>
          <th width="10%">Quote Status</th>
          <th width="11%">Lead Status <a href="#" data-toggle="modal" data-target="#status-modal" class="auto_send-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
          <th width="8%">Quoted Value</th>
          <th width="6%">Notes</th>
          <th width="10%">Start Onboarding</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        <tr>
          <td><input type='checkbox'></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="center"></td>
          <td align="center">
            <div class="email_client_selectbox" style="height:24px;">
              <span>SEND</span>
              <div class="small_icon" data-id="152" data-tab="11"></div><div class="clr"></div>
              <div class="select_toggle" id="status152_11" style="display: none;">
                <ul>
                  <li><a href="javascript:void(0)" class="send_template-modal">+ New</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">Generate Invoice</a></li>
                </ul>
              </div>
            </div>
          </td>
          <td align="center"></td>
          <td align="center">
            <select class="form-control newdropdown" id="21_status_dropdown_152" data-client_id="152">
              <option value="2">Incoming</option>
            </select>
          </td>
          <td align="center"></td>
          <td><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="" data-tab="11"><span>notes</span></a></td>
          <td align="center"><button type="button" class="send_btn send_manage_task" data-client_id="156" data-field_name="ch_manage_task">Start</button></td>
        </tr>
      </tbody>
    </table>
    </div>
           
    <div id="tab_12" class="tab-pane top_margin {{ ($page_open == '12')?'active':'' }}">
      <table class="table table-bordered table-hover dataTable crm" id="example12" aria-describedby="example12_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type='checkbox'></th>
          <th width="8%">Lead Owner</th>
          <th>Prospect Name</th>
          <th>Contact Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th width="6%">Deal Age</th>
          <th width="6%">Quote</th>
          <th width="10%">Quote Status</th>
          <th width="11%">Lead Status <a href="#" data-toggle="modal" data-target="#status-modal" class="auto_send-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
          <th width="8%">Quoted Value</th>
          <th width="6%">Notes</th>
          <th width="10%">Start Onboarding</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        <tr>
          <td><input type='checkbox'></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="center"></td>
          <td align="center">
            <div class="email_client_selectbox" style="height:24px;">
              <span>SEND</span>
              <div class="small_icon" data-id="152" data-tab="11"></div><div class="clr"></div>
              <div class="select_toggle" id="status152_11" style="display: none;">
                <ul>
                  <li><a href="javascript:void(0)" class="send_template-modal">+ New</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                  <li><a href="javascript:void(0)" class="send_template-modal">Generate Invoice</a></li>
                </ul>
              </div>
            </div>
          </td>
          <td align="center"></td>
          <td align="center">
            <select class="form-control newdropdown" id="21_status_dropdown_152" data-client_id="152">
              <option value="2">Incoming</option>
            </select>
          </td>
          <td align="center"></td>
          <td><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="" data-tab="11"><span>notes</span></a></td>
          <td align="center"><button type="button" class="send_btn send_manage_task" data-client_id="156" data-field_name="ch_manage_task">Start</button></td>
        </tr>
        
      </tbody>
    </table>  
    </div>
     
    @for($k=3; $k <= 9;$k++)                          
    <div id="tab_1{{$k}}" class="tab-pane top_margin {{ ($page_open == '1'.$k)?'active':'' }}">
      <table class="table table-bordered table-hover dataTable crm" id="example1{{$k}}" aria-describedby="example1{{$k}}_info">
      <thead>
        <tr role="row">
          <th width="5%">DELETE</th>
          <th width="8%">DOI</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th>NOTES</th>
          <th width="10%">EMAIL CLIENT</th>
          <th width="13%">STATUS <a href="#" data-toggle="modal" data-target="#status-modal">Add/Edit list</a></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "Y")
              @if(isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == $k)
              <tr id="data_tr_{{ $details['client_id'] }}_2{{ $k }}">
                <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}" data-tab="2{{ $k }}"><img src="/img/cross.png"></a></td>
                <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="left"><a href="/client/edit-org-client/{{ $details['client_id'] }}/{{ base64_encode('org_client') }}" target="_blank">{{ $details['business_name'] or "" }}</a></td>
                <td align="left">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="left">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="left">
                  @if( isset($details['deadret_count']) && $details['deadret_count'] < 0 )
                    <span style="color:red">{{ $details['deadret_count'] or "" }}</span>
                  @else
                     {{ $details['deadret_count'] or "" }}
                  @endif
                </td>
                <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21"><span  {{ (isset($details['jobs_notes']['notes']) && $details['jobs_notes']['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a>
              </td>
                <td align="left">
                
              </td>
                <td align="center" width="12%">
                  <input type="hidden" name="2{{ $k }}_prev_status_{{ $details['client_id'] }}" id="2{{ $k }}_prev_status_{{ $details['client_id'] }}" value="{{ $details['job_status'][$service_id]['status_id'] or '2' }}">
                  <select class="form-control newdropdown table_select status_dropdown" id="2{{ $k }}_status_dropdown" data-client_id="{{ $details['client_id'] }}">
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
        @endforeach
      @endif
        
      </tbody>
    </table> 
    </div>
    @endfor     
   

  </div>


  </div>

  <div id="tab_2" class="tab-pane {{ ($page_open == '2')?'active':'' }}">
    <table class="table table-bordered table-hover dataTable ch_returns" id="example3" aria-describedby="example3_info">
      <!-- <thead>
        <tr role="row">
          <th width="6%">DELETE</th>
          <th width="13%">STAFF</th>
          <th>CRN</th>
          <th>BUSINESS NAME</th>
          <th width="22%">LAST RETURN DATE</th>
          <th>NOTES</th>
          <th>FILING DATE</th>
        </tr>
      </thead> -->

      
        <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php $i = 1;?>
        @if(isset($completed_task) && count($completed_task) >0)
          @foreach($completed_task as $key=>$details)
            <tr id="data_tr_{{ $details['client_id'] }}_3">
              <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}" data-tab="3"><img src="/img/cross.png"></a></td>
              <td align="left">
                @if(isset($details['allocated_staffs']) && count($details['allocated_staffs']) >0)
                <select class="form-control newdropdown table_select staff_dropdown" id="1_staff_dropdown_{{ $details['client_id'] }}" data-client_id="{{$details['client_id']}}">
                  @foreach($details['allocated_staffs'] as $key=>$staff_row)
                    <option value="{{ $staff_row['staff_id'] or "" }}">{{ $staff_row['staff_name'] or "" }}</option>
                  @endforeach
                </select>
              @endif
              </td>
              <td align="left">{{ $details['registration_number'] or "" }}</td>
              <td align="left"><a href="/client/edit-org-client/{{ $details['client_id'] }}/{{ base64_encode('org_client') }}">{{ $details['business_name'] or "" }}</a></td>
              <td align="center">
                <a href="javascript:void(0)" class="change_last_date" data-client_id="{{ $details['client_id'] or "" }}" data-tab="3" data-key="{{ $key }}" id="3_dateanchore_{{ $key }}" data-prev_date="{{ isset($details['completed_tasks']['date'])?$details['completed_tasks']['date']:"" }}">{{ isset($details['completed_tasks']['date'])?$details['completed_tasks']['date']:"" }}</a>
                <span class="3_save_made_span_{{ $key }}"  style="display:none;">
                  <input type="text" class="made_up_date" id="3_made_up_date_{{ $key }}" />
                  <a href="javascript:void(0)" class="search_t save_made_date" data-client_id="{{ $details['client_id'] or "" }}" data-tab="3" data-key="{{ $key }}">Save</a>
                  <a href="javascript:void(0)" class="search_t cancel_made_date" data-client_id="{{ $details['client_id'] or "" }}" data-tab="3" data-key="{{ $key }}">Cancel</a>
                </span>
              </td>
              <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $details['client_id'] or "" }}" data-is_completed="{{ (isset($details['jobs_notes']['is_completed']))?$details['jobs_notes']['is_completed']:'N' }}" data-job_status_id="{{ (isset($details['jobs_notes']['job_status_id']))?$details['jobs_notes']['job_status_id']:'0' }}" data-tab="3"><span {{ (isset($details['jobs_notes']['notes']) && $details['jobs_notes']['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a>
              </td>
              <td align="center" width="12%">
                {{ isset($details['job_status'][$service_id]['filling_date'])?date("d-m-Y", strtotime($details['job_status'][$service_id]['filling_date'])):"" }}
              </td>
            </tr>
            <?php $i++;?>
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


</aside><!-- /.right-side -->
            




<!-- Send Template modal start -->
<div class="modal fade" id="open_form-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">NEW - LEAD ENQUIRY & PROSPECT</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div class="twobox">
          <div class="twobox_1">
            <div class="box_30">
              <div class="form-group">
                <label for="exampleInputPassword1">Deal Certainty</label>
                <input type="text" id="client_code" name="client_code" class="form-control box_60">
              </div>
            </div>
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Lead Owner</label>
              <select class="form-control" name="business_type" id="business_type">
                <option value="">-- None --</option>
             </select>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox" id="org_name_div">
          <div class="twobox_1">
            <div class="form-group">
              <label for="exampleInputPassword1">Business Type</label>
              <a href="javascript:void(0)" class="add_to_list"> Add/Edit list</a>
              <select class="form-control" name="business_type" id="business_type">
                @if( isset($old_org_types) && count($old_org_types) >0 )
                  @foreach($old_org_types as $key=>$old_org_row)
                  <option value="{{ $old_org_row->organisation_id }}">{{ $old_org_row->name }}</option>
                  @endforeach
                @endif

                @if( isset($new_org_types) && count($new_org_types) >0 )
                  @foreach($new_org_types as $key=>$new_org_row)
                  <option value="{{ $new_org_row->organisation_id }}">{{ $new_org_row->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
            
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Prospect Name</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="contact_name_div">
          <label for="exampleInputPassword1">Contact Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="title" name="title">
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="prospect_name_div">
          <label for="exampleInputPassword1">Prospect Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="title" name="title">
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" id="" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" id="" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Website</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Annual Revenue</label>
                <input type="text" id="" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Quoted Value</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Lead Source</label>
                <a href="javascript:void(0)" class="add_to_list"> Add/Edit list</a>
                <select class="form-control select_title" id="" name="">
                  <option value="">-- None --</option>
                
              </select>
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Industry</label>
              <select class="form-control select_title" id="" name="">
                <option value="">-- None --</option>
                
              </select>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Street</label>
                <input type="text" id="" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">City</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Province</label>
                <input type="text" id="" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Postal Code</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
         <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Country</label>
                <select class="form-control" name="country_id" id="country_id">
                @if(!empty($countries))
                  @foreach($countries as $key=>$country_row)
                  @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
                    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                  @endif
                  @endforeach
                @endif
                @if(!empty($countries))
                  @foreach($countries as $key=>$country_row)
                  @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
                    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                  @endif
                  @endforeach
                @endif
                </select>
              </div> 
          </div>
          <!--<div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>-->
          <div class="clearfix"></div>
        </div>

 <div class="form-group" style="width:98%;">
              <label for="exampleInputPassword1">Notes</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
<div class="clearfix"></div>
      </div>

      <div class="modal-footer clearfix" style="border-top: none; padding-top: 0;">
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-info pull-left save_t2">Save</button>
        </div>
      </div>
    
  </div>
  </div>
</div>
<!-- Send Template modal end -->


@stop




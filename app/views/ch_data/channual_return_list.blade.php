@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

<!-- Date picker script -->
<link rel="stylesheet" href="{{ URL :: asset('css/jquery-ui.css') }}" />
<!-- Date picker script -->

<!-- Time picker script -->
<link rel="stylesheet" href="{{ URL :: asset('css/timepicki.css') }}" />
<!-- Time picker script -->

<!-- Add To Calender Start -->
<link href="{{ URL :: asset('css/atc-style-blue.css') }}" rel="stylesheet" type="text/css">
<!-- Add To Calender End -->    
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/jobs.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/ch_data.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- Date picker script -->
<script src="{{ URL :: asset('js/jquery-ui.min.js') }}"></script>
<!-- Date picker script -->

<!-- Time picker script -->
<script src="{{ URL :: asset('js/timepicki.js') }}"></script>
<!-- Time picker script -->

<!-- page script -->
<script type="text/javascript">
$(".made_up_date").datepicker({ minDate: new Date(1900, 12-1, 25), maxDate:0, dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-10:+10" });
$(".addto_date").datepicker({ minDate: new Date(1900, 12-1, 25), dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-5:+100" });
var Table1, Table3;
$(function() {
    Table1 = $('#example1').dataTable({
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
          {"bSortable": true},
          {"bSortable": true},
          {"bSortable": true},
          {"bSortable": false},
          {"bSortable": false}
      ],
      "aaSorting": [[8, 'asc']]

    });
    
    var table = $('#example21').dataTable({
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
          {"bSortable": false}
      ],
      "aaSorting": [[5, 'asc']]

    });

  for(var k=2; k<=10;k++){
    //var table = Table2+""+k;
    var table = $('#example2'+k).dataTable({
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
          {"bSortable": false}
      ],
      "aaSorting": [[4, 'asc']]

    });
    //table.fnSort( [ [7,'asc'] ] );
  }

  Table3 = $('#example3').dataTable({
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

<!-- Add to Calender -->
<script type="text/javascript">(function () {
  if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
  if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
      var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
      s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
      //s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
      s.src = '/js/atc.min.js';
      var h = d[g]('body')[0];h.appendChild(s); }})();
</script>

<script>
  $('#calender_time').timepicki({
    show_meridian:false,
    //min_hour_value:0,
    max_hour_value:23,
    //step_size_minutes:15,
    //overflow_minutes:true,
    increase_direction:'up',
    //disable_keyboard_mobile: true
  });
</script>

<!-- <script src="{{ URL :: asset('ckeditor/ckeditor.js') }}"></script> -->
<script type="text/javascript">
  /*$(window).load(function() {
    CKEDITOR.replace( 'add_message',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
        }
    });
  });*/


</script>

<script src="{{ URL :: asset('tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
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
              <a class="btn btn-danger sync_jobs_data" href="javascript:void(0)">SYNC DATA</a>
            </li>
            <!-- <li>
              <div class="import_fromch_main">
                <div class="import_fromch">
                  <a href="/import-from-ch/{{ base64_encode('ch_list') }}" class="import_fromch_link">IMPORT FROM CH</a>
                  <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                  <div class="clearfix"></div>
                </div>
                <div class="i_dropdown open_toggle"><a href="/chdata/bulk-company-upload-page/{{ base64_encode('ch_list') }}">BULK COMPANY UPLOAD</a></div>
              </div>
            </li> -->
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
                <select class="form-control filter_by_staff" name="filter_by_staff" id="filter_by_staff">
                  <option value="{{ base64_encode('all') }}" {{ (isset($staff_id) && $staff_id == 'all')?"selected":"" }}>Show All</option>
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
        </div>
       
        <div id="message_div"><!-- Loader image show while sync data --></div>
      </div>

      

      </div>
      <div class="practice_mid">
      <input type="hidden" name="page_open" id="page_open" value="{{ $page_open }}">
      <input type="hidden" name="encode_page_open" id="encode_page_open" value="{{ $encode_page_open }}">
      <input type="hidden" name="encode_staff_id" id="encode_staff_id" value="{{ $encode_staff_id }}">
          <div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg">
        <!-- <li class="active"><a data-toggle="tab" href="#tab_1">ANNUAL RETURNS - PERMANENT DATA</a></li>
        <li><a data-toggle="tab" href="#tab_2">ANNUAL RETURNS - TASK MANAGEMENT</a></li>
        <li><a data-toggle="tab" href="#tab_3">COMPLETED TASKS</a></li> -->
        <li class="{{ ($page_open == 1)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('1') }}/{{ base64_encode($staff_id) }}">ANNUAL RETURNS - PERMANENT DATA</a></li>
        <li class="{{ ($page_open != 1 && $page_open != 3)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('21') }}/{{ base64_encode($staff_id) }}">ANNUAL RETURNS - TASK MANAGEMENT</a></li>
        <li class="{{ ($page_open == 3)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('3') }}/{{ base64_encode($staff_id) }}">COMPLETED TASKS</a></li>
      </ul>
<div class="tab-content">
  <div id="tab_1" class="tab-pane {{ ($page_open == 1)?'active':'' }}">
    <!-- <div class="tab_topcon" style="position:relative; height: 25px">
      <div class="send_task auto_send">
        <div class=" chk_cont01"><input type='checkbox' id="manage_check" {{ (isset($autosend['days']) && $autosend['days'] != "")?"checked":"" }} /><label for="manage_check"> Auto Send To Task </label></div> 
        <div class="chk_cont02"><input type="text" name="dead_line" id="dead_line" style="width:18%; padding: 0; text-align: center; height: 18px;" value="{{ $autosend['days'] or "" }}"  {{ (isset($autosend['days']) && $autosend['days'] != "")?"disabled":"" }} /> <label for=""> Days Before Deadline </label></div>
      </div>
      <div class="clearfix"></div>
    </div> -->
    <table class="table table-bordered table-hover dataTable ch_returns" id="example1" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th width="2%"><span class="custom_chk"><input type='checkbox' id="CheckallCheckbox" /></span></th>
          <th width="8%">D0I</th>
          <th>CRN</th>
          <th width="15%">BUSINESS NAME</th>
          <th>YEAR END</th>
          <th>AUTHEN CODE</th>
          <th>LAST RETURN DATE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>COUNT DOWN</th>
          <th width="11%">SEND TO TASKS <a href="#" data-toggle="modal" data-target="#auto_send-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
          <th>STAFF</th>
        </tr>
      </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all">
      @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          <tr class="even">
            <td><span class="custom_chk"><input type='checkbox' class="checkbox" name="checkbox[]" value="{{ $details['client_id'] or "" }}"/></span></td>
            <td class="sorting_1" align="center">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
            <td align="center">{{ $details['registration_number'] or "" }}</td>
            <td align="left"><a href="/client/edit-org-client/{{ $details['client_id'] }}/{{ base64_encode('org_client') }}">{{ $details['business_name'] or "" }}</a></td>
            <td align="center">{{ $details['acc_ref_day'] or "" }}-{{ $details['ref_month'] or "" }}</td>
            <td align="center">{{ $details['ch_auth_code'] or "" }}</td>
            <td align="center">{{ isset($details['made_up_date'])?date("d-m-Y", strtotime($details['made_up_date'])):"" }}</td>
            <td align="center">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
            <td align="center">
              @if( isset($details['deadret_count']) && $details['deadret_count'] < 0 )
                <span style="color:red">{{ $details['deadret_count'] or "" }}</span>
              @else
                 {{ $details['deadret_count'] or "" }}
              @endif
            </td>
            <td align="center" id="after_send_{{ $details['client_id'] }}">
              @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "N")
                <button type="button" class="send_btn send_manage_task" data-client_id="{{ $details['client_id'] }}" data-field_name="ch_manage_task">SEND</button>
              @else
                <button type="button" class="sent_btn">SENT</button>
              @endif
            </td>
            <td align="center">
              @if(isset($details['allocated_staffs']) && count($details['allocated_staffs']) >0)
                <select class="form-control newdropdown table_select staff_dropdown" id="1_staff_dropdown_{{ $details['client_id'] }}" data-client_id="{{$details['client_id']}}">
                  @foreach($details['allocated_staffs'] as $key=>$staff_row)
                    <option value="{{ $staff_row['staff_id'] or "" }}">{{ $staff_row['staff_name'] or "" }}</option>
                  @endforeach
                </select>
              @endif
            </td>
          </tr>
        @endforeach
      @endif
      
    </tbody>
  </table>

  </div>

  <div id="tab_2" class="tab-pane {{ ($page_open != 1 && $page_open != 3)?'active':'' }}">
    <ul class="nav nav-tabs nav-tabsbg">
        <li class="{{ ($page_open == 21)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('21') }}/{{ base64_encode($staff_id) }}">All [<span id="task_count_21">{{ $all_count }}</span>]</a></li>
        <li class="{{ ($page_open == 22)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('22') }}/{{ base64_encode($staff_id) }}">Not Started [<span id="task_count_22">{{ ($not_started_count >0 )?$not_started_count:"0" }}</span>]</a></li>
        @if(isset($jobs_steps) && count($jobs_steps) >0)
          <?php $i = 3;?>
            @foreach($jobs_steps as $key=>$value)
              <li class="header_step_{{ $value['step_id']}} {{ ($page_open == '2'.$i)?'active':'' }}" style="display: {{ ($value['status'] == 'H')?'none':'block'}}"><a href="{{ $goto_url }}/{{ base64_encode('2'.$i) }}/{{ base64_encode($staff_id) }}"><span id="step_field_{{ $value['step_id']}}">{{ $value['title'] or "" }}</span> [<span id="task_count_2{{$i}}">{{ $value['count'] or "0" }}</span>]</a></li>
              <?php $i++;?>
            @endforeach
        @endif
        
    </ul>
    
  <div class="tab-content">

  <div id="tab_21" class="tab-pane top_margin {{ ($page_open == '21')?'active':'' }}">
    
    <table class="table table-bordered table-hover dataTable ch_returns" id="example21" aria-describedby="example21_info">
      <thead>
        <tr role="row">
          <th width="5%">DELETE</th>
          <th width="8%">DOI</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>NEXT RETURN DUE ON</th>
          <th>DAYS</th>
          <th width="11%">JOB START DATE <a href="javascript:void(0)" class="job_start_date-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
          <th>NOTES</th>
          <th width="13%">EMAIL CLIENT <a href="javascript:void(0)" class="email_client-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
          <th width="11%">STATUS <a href="#" data-toggle="modal" data-target="#status-modal" class="auto_send-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['ch_manage_task']) && $details['ch_manage_task'] == "Y")
          
            <tr id="data_tr_{{ $details['client_id'] }}_21">
              <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21"><img src="/img/cross.png"></a></td>
              <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
              <!-- <td align="left">{{ $details['business_type'] or "" }}</td> -->
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
              <td align="center">
                <div id="edit_calender_{{ $details['client_id'] }}_21" class="edit_cal">
                   <!-- <a href="javascript:void(0)" class="open_calender_drop" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21">10-08-2015 12:98</a> -->
                   <a href="javascript:void(0)" id="date_view_{{ $details['client_id'] }}_21" />{{ (isset($details['job_start_date']) && $details['job_start_date'] != "")?date("d-m-Y H:i", strtotime('+'.$jobs_start_days.' day', strtotime($details['job_start_date'])) ):"" }}</a>
                  <span class="glyphicon glyphicon-chevron-down open_adddrop" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21"></span>
                  <div class="cont_add_to_date open_dropdown_{{ $details['client_id'] }}_21" style="display:none;">
                    <ul>

                    <li><a href="javascript:void(0)" class="open_calender_pop" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21">Add/Edit Start Date</a></li>
                   <li>
                    <span id="view_calender_{{ $details['client_id'] }}_21" class="addtocalendar atc-style-blue">
                      <var class="atc_event">
                        <var class="atc_date_start">{{ (isset($details['job_start_date']) && $details['job_start_date'] != "")?date("Y-m-d H:i:s", strtotime('+'.$jobs_start_days.' day', strtotime($details['job_start_date'])) ):"" }}</var>
                        <var class="atc_date_end">{{ (isset($details['job_start_date']) && $details['job_start_date'] != "")?date("Y-m-d H:i:s", strtotime('+1 hour', strtotime('+'.$jobs_start_days.' day', strtotime($details['job_start_date']))) ):"" }}</var>
                        <var class="atc_timezone">Europe/London</var>
                        <var class="atc_title">{{$title}} - {{$details['business_name'] or ""}}</var>
                        <var class="atc_description">{{$title}} - {{$details['business_name'] or ""}}</var>
                        <var class="atc_location">Office</var>
                        <var class="atc_organizer">{{ $admin_name }}</var>
                        <var class="atc_organizer_email">{{ $logged_email }}</var>
                      </var>
                    </span>
                   </li>
                  </ul>
                </div>
              </div>
                
              </td>
              <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21"><span  {{ (isset($details['jobs_notes']['notes']) && $details['jobs_notes']['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a>
              </td>
              <td>
                <div class="email_client_selectbox" style="height:24px;">
                  <span>SEND</span>
                  <div class="small_icon" data-id="{{ $details['client_id'] }}"></div><div class="clr"></div>
                  <div class="select_toggle" id="status{{ $details['client_id'] }}" style="display: none;">
                    <ul>
                      @if(isset($email_templates) && count($email_templates) >0)
                        @foreach($email_templates as $key=>$temp_row)
                          <li><a href="javascript:void(0)" data-template_id="{{ $temp_row['email_template_id'] or "" }}" class="send_template-modal">{{ $temp_row['name'] or "" }}</a></li>
                        @endforeach
                      @endif
                    </ul>
                  </div>
                </div>

                <div style="float:right"><a href="javascript:void(0)" class="enter_email-modal"><img src="/img/corner_arrow.png" style="height:12px;"></a></div>

              </td>
              
              <td align="center" width="12%">
                <input type="hidden" name="21_prev_status_{{ $details['client_id'] }}" id="21_prev_status_{{ $details['client_id'] }}" value="{{ $details['job_status'][$service_id]['status_id'] or '2' }}">
                <select class="form-control newdropdown table_select status_dropdown" id="21_status_dropdown_{{ $details['client_id'] }}" data-client_id="{{ $details['client_id'] }}">
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
        @endforeach
      @endif
        
      </tbody>
    </table>
    </div>
           
    <div id="tab_22" class="tab-pane top_margin {{ ($page_open == '22')?'active':'' }}">
      <table class="table table-bordered table-hover dataTable ch_returns" id="example22" aria-describedby="example22_info">
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
            @if(!isset($details['job_status'][$service_id]['status_id']))
            <tr id="data_tr_{{ $details['client_id'] }}_22">
              <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}"  data-tab="22" ><img src="/img/cross.png"></a></td>
              <td align="left">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
              <!-- <td align="left">{{ $details['business_type'] or "" }}</td> -->
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
                <input type="hidden" name="22_prev_status_{{ $details['client_id'] }}" id="22_prev_status_{{ $details['client_id'] }}" value="2">
                <select class="form-control newdropdown table_select status_dropdown" id="22_status_dropdown_{{ $details['client_id'] }}" data-client_id="{{ $details['client_id'] }}">
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
     
    @for($k=3; $k <= 9;$k++)                          
    <div id="tab_2{{$k}}" class="tab-pane top_margin {{ ($page_open == '2'.$k)?'active':'' }}">
      <table class="table table-bordered table-hover dataTable ch_returns" id="example2{{$k}}" aria-describedby="example2{{$k}}_info">
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
    <div id="tab_210" class="tab-pane {{ ($page_open == '210')?'active':'' }} top_margin">
      <table class="table table-bordered table-hover dataTable ch_returns" id="example210" aria-describedby="example210_info">
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
            @if(isset($details['job_status'][$service_id]['status_id']) && $details['job_status'][$service_id]['status_id'] == 10)
            <tr id="data_tr_{{ $details['client_id'] }}_210">
              <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}" data-tab="210"><img src="/img/cross.png"></a></td>
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
                <input type="hidden" name="210_prev_status_{{ $details['client_id'] }}" id="210_prev_status_{{ $details['client_id'] }}" value="{{ $details['job_status'][$service_id]['status_id'] or '2' }}">
                <select class="form-control newdropdown table_select status_dropdown" id="210_status_dropdown" data-client_id="{{ $details['client_id'] }}">
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
   

  </div>


  </div>

  <div id="tab_3" class="tab-pane {{ ($page_open == '3')?'active':'' }}">
    <table class="table table-bordered table-hover dataTable ch_returns" id="example3" aria-describedby="example3_info">
      <thead>
        <tr role="row">
          <th>DELETE</th>
          <th>STAFF</th>
          <th>CRN</th>
          <th>BUSINESS NAME</th>
          <th width="22%">LAST RETURN DATE</th>
          <th>NOTES</th>
          <th>FILING DATE</th>
        </tr>
      </thead>

      
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($completed_task) && count($completed_task) >0)
          @foreach($completed_task as $key=>$details)
            <tr id="data_tr_{{ $details['client_id'] }}_3">
              <td><a href="javascript:void(0)" class="delete_single_task" data-client_id="{{ $details['client_id'] or "" }}" data-tab="3"><img src="/img/cross.png"></a></td>
              <td align="left"></td>
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
              <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $details['client_id'] or "" }}" data-tab="21"><span  {{ (isset($details['jobs_notes']['notes']) && $details['jobs_notes']['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a>
              </td>
              <td align="center" width="12%">
                {{ isset($details['job_status'][$service_id]['created'])?date("d-m-Y", strtotime($details['job_status'][$service_id]['created'])):"" }}
              </td>
            </tr>
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
                <td align="center"><input type="checkbox" id="step_check_2{{ $value['step_id']}}" class="status_check" {{ ($value['status'] == "S")?"checked":"" }} value="{{ $value['step_id'] or "" }}" data-step_id="{{ $value['step_id'] }}" {{ ((isset($value['count']) && $value['count'] !=0) || $value['step_id'] == 10)?"disabled":"" }} /></td>
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

<!-- Notes modal start -->
<div class="modal fade" id="notes-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">SAVE NOTES</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <input type="hidden" id="notes_client_id" name="notes_client_id">
        <input type="hidden" id="notes_tab" name="notes_tab">
        <table>
          <tr>
            <td align="left" width="20%"><strong>Notes : </strong></td>
            <td align="left"><textarea cols="56" rows="4" id="notes" name="notes"></textarea></td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="right"><button type="button" class="btn btn-info save_notes">Save</button></td>
          </tr>
        </table>

        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
<!-- Notes modal start -->

<!-- Notes modal start -->
<div class="modal fade" id="addto_calender-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:410px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD JOB START DATE</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div id="start_date_loader" style="text-align: center; padding-bottom: 10px;"><!-- Show loader --></div>
        <input type="hidden" id="calender_client_id" name="calender_client_id">
        <input type="hidden" id="calender_tab" name="calender_tab">
        <table>
          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left" width="20%"><strong>Date : </strong></td>
            <td align="left"><input id="calender_date" name="calender_date" class="form-control addto_date"></td>
          </tr>
          <tr>
            <td align="left" colspan="3">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left" width="20%"><strong>Time : </strong></td>
            <td align="left"><input id="calender_time" name="calender_time" class="form-control"></textarea></td>
          </tr>

          <tr>
            <td align="left" colspan="3">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" colspan="2" width="20%"></td>
            <td align="right"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-info save_job_start_date">Save</button></td>
          </tr>
        </table>

        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
<!-- Notes modal start -->

<!-- Auto send modal start -->
<div class="modal fade" id="auto_send-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:370px;">
    <div class="modal-content">
      <div class="loader_show"></div>
      <div class="modal-body">
        <div class="form-group">
            <div class="tab_topcon">
              <div class="send_task auto_send">
                <div class=" chk_cont01">
                  <!-- <input type='checkbox' id="manage_check" {{ (isset($autosend['days']) && $autosend['days'] != "")?"checked":"" }} /> -->
                  <label for="manage_check"> Auto Send To Task </label></div> 
                <div class="chk_cont02"><input type="text" name="dead_line" id="dead_line" style="width:18%; padding: 0; text-align: center; height: 19px;" value="{{ $autosend['days'] or "" }}" /> <label for=""> Days Before Deadline </label></div>
              </div>
              <div class="clearfix"></div>
            </div>     
        </div>

        <div class="auto_modal_footer clearfix">
          <div class="email_btns">
            <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-info pull-left save_t2" data-client_type="org" id="manage_check" name="save">Save</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Auto send modal end -->

<!-- Job start date modal start -->
<div class="modal fade" id="job_start_date-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:400px;">
    <div class="modal-content">
      <div class="loader_show"></div>
      <div class="modal-body">
        <div class="form-group">
            <div class="tab_topcon">
              <div class="send_task job_start_date">
                <div class="jsd_cont01">
                  <label for="manage_check"> Auto Set Job Start Date at SEND Date Plus </label></div> 
                <div class="jsd_cont02"><input type="text" name="job_start_date" id="job_start_date" style="width:40%; padding: 0; text-align: center; height: 19px;" value="{{ (isset($jobs_start_days) && $jobs_start_days != "")?$jobs_start_days:"" }}" /> Days</div>
              </div>
              <div class="clearfix"></div>
            </div>     
        </div>

        <div class="auto_modal_footer clearfix" style="margin-right: 22px;">
          <div class="email_btns">
            <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-info pull-left save_t2" id="jsd_save">Save</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Job start date modal end -->

<!-- Email Client modal start -->
<div class="modal fade" id="email_client-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:515px;">
    <div class="modal-content">
      <div class="loader_show"></div>
      <div class="modal-body">
        <div class="form-group">
            <div class="tab_topcon">
              <div class="email_client">
                <div class="days_count">
                  <label for="manage_check" class="auto_t">Auto Send</label>
                    <select class="form-control newdropdown float_c" >
                      @if(isset($email_templates) && count($email_templates) >0)
                        @foreach($email_templates as $key=>$temp_row)
                          <option value="{{ $temp_row['email_template_id'] or "" }}">{{ $temp_row['name'] or "" }}</option>
                        @endforeach
                      @endif
                    </select>
                   <div class="days_box"><input type="text" name="dead_line" id="dead_line" style="width:100%; padding: 0; text-align: center; height: 24px;" value="" /> </div>
                    <label for="" class="auto_t"> Days</label>
                    <select class="form-control newdropdown deadline_box" >
                      <option value="8">Before</option>
                      <option value="17">After</option>
                    </select>
                    <label for="manage_check" class="auto_t">deadline date</label>

                </div> 
               
              </div>

              <div class="email_client">
                <div class="days_count">
                  <label for="manage_check" class="auto_t">Remind Client Every</label>
                  <div class="days_box"><input type="text" name="dead_line" id="dead_line" style="width:100%; padding: 0; text-align: center; height: 24px;" value="" /></div>
                    <label for="" class="auto_t"> Days after email date</label>
                </div> 
               
              </div>


              <div class="clearfix"></div>
            </div>     
        </div>

        <div class="auto_modal_footer clearfix" style="margin-right: 5px;">
          <div class="email_btns">
            <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-info pull-left save_t2">Save</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Email Client modal end -->

<!-- Send Template modal start -->
<div class="modal fade" id="send_template-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">SEND EMAIL TEMPLATE</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div class="form-group">
          <div class="input_box_g">
            <label for="exampleInputEmail1">Template Name</label>
            <input type="text" class="form-control" name="add_name" id="add_name" placeholder="Template Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group">
          <div class="input_box_g">
            <label for="exampleInputEmail1">Message Subject</label>
            <input name="add_title" id="add_title" type="text" class="form-control" placeholder="Message Subject">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group">
          <textarea name="add_message" id="add_message" class="form-control" placeholder="Message" style="height: 250px;"></textarea>
        </div>
        
      </div>

      <div class="modal-footer clearfix" style="border-top: none; padding-top: 0;">
        <div class="form-group new_temp">                                
            <div class="btn-file search_t">
                <!-- <i class="fa fa-paperclip"></i> --> Attachment
                <input type="file" name="add_file" id="add_file">
            </div>
            <!-- <p class="help-block">Max. 32MB</p> -->
        </div>
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-info pull-left save_t2">Save</button>
        </div>
      </div>
    
  </div>
  </div>
</div>
<!-- Send Template modal end -->

<!-- Enter Email Address modal start -->
<div class="modal fade" id="enter_email-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none; padding-bottom: 0">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">×</button>
        <!-- <h4 class="modal-title">ENTER EMAIL ADDRESS</h4> -->
        <div class="clearfix"></div>
      </div>

      <div class="loader_show"></div>
      
      <div class="modal-body">
        <div class="enter_email_box">
          <table>
            <tr>
              <td width="60%"><h4 class="modal-title">ENTER EMAIL ADDRESS</h4></td>
              <td class="stop_email">Stop Email Reminders</td>
              <td><input type='checkbox'></td>
            </tr>
          </table>
        

          <table width="100%" class="table table-bordered" style="margin-top: 10px;">
            <tbody>
              <tr>
                <td width="6%">&nbsp;</td>
                <td width="47%" align="center"><strong>Contact Name</strong></td>
                <td width="47%" align="center"><strong>Email Address</strong></td>
              </tr>

              <tr id="database_tr145">
                <td><a href="javascript:void(0)" class="delete_database_rel"><img src="/img/cross_icon.png" height="15"></a></td>
                <td align="center"><input type="text" class="form-control" placeholder="Search"></td>
                <td align="center"><input type="text" class="form-control"></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="modal-footer clearfix" style="padding: 10px 0 0; border-top: none;">
        <div class="form-group new_temp">                                
            <button type="button" class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new</p></button>
        </div>
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-info pull-left save_t2">Save</button>
        </div>
      

      </div>
    </div>
    </div>
  </div>
</div>
<!-- Enter Email Address modal end -->

@stop




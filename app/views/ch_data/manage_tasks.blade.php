@extends('layouts.layout')

@section('mycssfile')
<link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
  .nav-tabs-custom > .nav-tabs > li{ margin-right: -3px;}
</style>

@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
var Table1;
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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

   Table1.fnSort( [ [4,'asc'] ] );

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
              <button class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
            </li>
            <li>
              <a href="/chdata/index" class="btn btn-info">PERMANENT DATA</a>
            </li>
            <!-- <li>
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
              <td>COMPANIES HOUSE</td>
              <td>&nbsp;</td>
              <td><button class="btn btn-danger">SYNC DATA</button></td>
              <td>&nbsp;</td>
              <td><a href="https://beta.companieshouse.gov.uk" target="_blank" class="btn btn-info">WEBCHECK</a></td>
            </tr>
          </tbody></table>
        </div>
        <div class="clearfix"></div>
      </div>

<div class="practice_mid">
        

<div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg" id="header_ul">
        <li class="active" id="tab_1"><a class="open_header" data-id="1" href="javascript:void(0)">All [1]</a></li>
        <li id="tab_2"><a class="open_header" data-id="2" href="javascript:void(0)">Not Started [2]</a></li>
        <li id="tab_3"><a class="open_header" data-id="3" href="javascript:void(0)">Information Requested [3]</a></li>
        <li id="tab_4"><a class="open_header" data-id="4" href="javascript:void(0)">Information Received [4]</a></li>
        <li id="tab_5"><a class="open_header" data-id="5" href="javascript:void(0)">Progress [5]</a></li>
        <li id="tab_6"><a class="open_header" data-id="6" href="javascript:void(0)">Drafted [6]</a></li>
        <li id="tab_7"><a class="open_header" data-id="7" href="javascript:void(0)">Firm Review [7]</a></li>
        <li id="tab_8"><a class="open_header" data-id="8" href="javascript:void(0)">Client Review [8]</a></li>
        <li id="tab_9"><a class="open_header" data-id="9" href="javascript:void(0)">Finals Sent [9]</a></li>
        <li id="tab_10"><a class="open_header" data-id="10" href="javascript:void(0)">Filed [10]</a></li>
         
        <!-- <li><a href="#" class=" btn-block btn-primary " data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i> New Field
         
        </a></li> -->
        
      </ul>
<div class="tab-content">

  <div id="step1" class="tab-pane active" style="display:block;">
    <div class="tab_topcon">
      <div class="top_bts">
        <ul style="padding:0;">
          <li>
            <a href="#" class="btn btn-danger">Delete</a>
          </li>
        <div class="clearfix"></div>
        </ul>
      </div>
      <!-- <div class="top_search_con">
       <div class="top_bts">
        <ul style="padding:0;">
          <li style="margin-right: 0px">
            <button class="btn btn-info">HMRC PAYMENT PLANS</button>
          </li>
          
          <div class="clearfix"></div>
        </ul>
      </div>
      </div> -->
      <div class="clearfix"></div>
    </div>
    <table class="table table-bordered table-hover dataTable" id="example1" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th><input type="checkbox" id="allCheckSelect"/></th>
          <th>STAFF</th>
          <th>DO1</th>
          <th>BUSINESS TYPE</th>
          <th>BUSINESS NAME</th>
          <th>AUTHEN CODE</th>
          <th>LAST RETURN DATE</th>
          <th>DEADLINE</th>
          <th>COUNT DOWN</th>
          <th>STATUS</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        <tr class="all_check">
          <td><input type="checkbox" name="checkbox[]" value="" /></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"><a href="#">Anwar</a></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="left"></td>
          <td align="center"></td>
          <td align="center" width="12%">
            <select class="table_select">
              <option>Not Started</option>
              <option>Information Requested</option>
              <option>In Process</option>
              <option>Firm Review</option>
              <option>Client Review</option>
              <option>Finalising</option>
              <option>Filed</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
         
  <div id="step2" class="tab-pane" style="display:none;">
                  
  </div>
                              
  <div id="step3" class="tab-pane" style="display:none;">
    
  </div>
         
  <div id="step4" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step5" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step6" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step7" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step8" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step9" class="tab-pane" style="display:none;">
    
  </div>

  <div id="step10" class="tab-pane" style="display:none;">
    
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
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FIELD</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/individual/save-userdefined-field', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="ind" />
    <input type="hidden" name="back_url" value="add_ind" />
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputPassword1">Select Section</label>
          <select class="form-control show_subsec" name="step_id" id="step_id" data-client_type="ind">
            @if( isset($steps) && count($steps) >0 )
              @foreach($steps as $key=>$step_row)
                @if($step_row->step_id != '4' && $step_row->status == "old")
                  <option value="{{ $step_row->step_id }}">{{ $step_row->title }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Subsection Name</label>
          <select class="form-control subsec_change" name="substep_id" id="substep_id">
            <option value="">-- Select sub section --</option>
            @if( isset($substep) && count($substep) >0 )
              @foreach($substep as $key=>$substep_row)
                <option value="{{ $substep_row['step_id'] }}">{{ $substep_row['title'] }}</option>
              @endforeach
            @endif
            <option value="new">Add new ...</option>
          </select>
        </div>
        <div class="input-group show_new_div" style="display:none;">
            <input type="text" class="form-control" name="subsec_name" id="subsec_name">
           <span class="input-group-addon"> <a href="javascript:void(0)" class="add_subsec_name" data-client_type="ind">Save</a></span>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Name</label>
          <input type="text" id="field_name" name="field_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Type</label>
          <select class="form-control user_field_type" name="field_type" id="field_type">
            @if(!empty($field_types))
              @foreach($field_types as $key=>$field_row)
                <option value="{{ $field_row->field_type_id }}">{{ $field_row->field_type_name }}</option>
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group" style="display:none;" id="show_select_option">
          <label for="exampleInputPassword1">Options</label>
          <textarea name="select_option" cols="40" rows="3"></textarea>
          Give options width ',' separator
        </div>
        
        <div class="modal-footer1 clearfix">
          <div class="email_btns1">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary pull-left save_text" name="save">Save</button>
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- Relationship Add To List Modal Start-->
<!-- <div class="modal fade" id="add_to_list-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:404px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div id="add_to_msg_div" style="text-align: center; color: #00acd6"></div>
        <div class="form-group" style="width:70%">
          <label for="name">Type</label>
          <select class="form-control" name="add_to_type" id="add_to_type">
            <option value="ind">Individual</option>
            <option value="org">Organisation</option>
          </select>
        </div>

        <div class="form-group" id="add_to_client_text">

<div class="clearfix"></div>
<div class="n_box18_18">
<label for="exampleInputPassword1">Title</label>
<select class="form-control select_title" id="add_to_title" name="add_to_title">
          <option value="Mr" selected="">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
        <option value="Dr">Dr</option>
        <option value="Professor">Professor</option>
        <option value="Rev">Rev</option>
        <option value="Sir">Sir</option>
        <option value="Dame">Dame</option>
        <option value="Lord">Lord</option>
        <option value="Lady">Lady</option>
        <option value="Captain">Captain</option>
        <option value="The Hon">The Hon</option>
        <option value="Other">Other</option>
      </select></div>
<div class="n_box27_27">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" id="add_to_fname" name="add_to_fname" value="" class="form-control toUpperCase"></div>
<div class="n_box22_22">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" id="add_to_mname" name="add_to_mname" value="" class="form-control toUpperCase"></div>
<div class="n_box27_27">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" id="add_to_lname" name="add_to_lname" value="" class="form-control toUpperCase"></div>
<div class="clearfix"></div>
</div>

        <div class="form-group" style="width:70%; display:none;" id="add_to_business">
          <label for="name">Business Name</label>
          <input class="form-control toUpperCase" type="text" name="add_to_name" id="add_to_name">
        </div>
       
        <div class="modal-footer1 clearfix">
          <div class="email_btns">
            <button type="button" class="btn btn-primary pull-left save_t relation_add_client" id="add_to_save" name="save">Save</button>
            <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
    </div>
    /.modal-content
  </div>
  /.modal-dialog
</div> -->
<!-- Relationship Add To List Modal End-->

@include("home.include.client_modal_page")

@stop
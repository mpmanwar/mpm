@extends('layouts.layout') 
@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
  <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/staff_appraisal.js') }}" type="text/javascript"></script>

<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->

<!-- page script -->
<script type="text/javascript">
$(".date_of_meeting").datepicker({minDate: new Date(1900, 12-1, 25), dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

var Table1, Table2;
$(function() {//date_of_meeting
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
            {"bSortable": true}
        ]

    });
  /*Table1.fnSort( [ [1,'asc'] ] );*/
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
    <aside class="left-side sidebar-offcanvas {{ $left_class }}">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('layouts/inner_leftside')

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
        <!--<div class="top_bts">
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
              <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
            <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>-->
      </div>
      <div class="practice_mid">
        <form>
          <div class="tabarea">
          <!--<div class="tab_topcon">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="notes_top_btns">
  <tr>
    <td width="11%">COMPANIES HOUSE</td>
    <td width="35%"><button class="btn btn-danger">SYNC DATA</button></td>
    <td width="0%">&nbsp;</td>
    <td width="4%"><button class="btn btn-info">AM</button></td>
    <td width="26%">ADE MCADIO LIMITED</td>
    <td width="13%">&nbsp;</td>
    <td width="11%"><button class="btn btn-success">GENERATE PDF</button></td>
  </tr>
</table>
              <div class="clearfix"></div>
            </div>-->
            
            
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">CURRENT APPRAISALS</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">PREVIOUS APPRAISALS</a></li>
                <li class=""><a data-toggle="tab" href="#tab_3">ARCHIVED</a></li>
                <!--<li><a href="#" class=" btn-block btn-primary " data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i> New Field </a></li>-->
              </ul>
              <div class="tab-content">
                <div id="tab_1" class="tab-pane active">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                         <div class="col_m2">
  <div class="notes_top_btns">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%"><button type="button" class="btn btn-default "><span class="requ_t">Roll Forward from Previous From</span></button></td>
        <td width="1%">&nbsp;</td>
        <td width="22%"><button class="btn btn-default show_new_form" type="button"><span class="requ_t">+ New Form</span></button></td>
        <td width="2%">&nbsp;</td>
        <td width="42%"><strong><h4>PERFORMANCE APPRAISAL FORM</h4></strong></td>
        <td width="2%">&nbsp;</td>
        <td width="11%"><button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button></td>
      </tr>
    </table>
  </div>
  
  <div id="show_form_content" style="display: none;">
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table_content">
      <tr>
        <td width="21%"><strong>Appraisee :</strong></td>
        <td width="30%">
          <select class="form-control">
            <option>None</option>
            <option>Abel</option>
            <option>Anwar</option>
          </select>
        </td>
        <td width="19%"><strong>Appraiser :</strong></td>
        <td width="30%">
          <select class="form-control">
            <option>None</option>
            <option>Abel</option>
            <option>Anwar</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><strong>Job Title :</strong></td>
        <td><input type="text" class="form-control"></td>
        <td><strong>Job Title :</strong></td>
        <td><input type="text" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>Date of Meeting :</strong></td>
        <td><input type="text" class="form-control date_of_meeting"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>

    <ul class="nav nav-tabs nav-tabsbg">
      <li class="active"><a data-toggle="tab" href="#tab_5">Performance – Objectives and targets</a></li>
      <li class=""><a data-toggle="tab" href="#tab_6">Competency and Skill Development</a></li>
      <li class=""><a data-toggle="tab" href="#tab_7">Additional Comments</a></li>
    </ul>
              <div class="tab-content">
                <div id="tab_5" class="tab-pane active">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                         <div class="col_m2">
                         <div class="notes_top_btns">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_content">
  <tr>
    <td><a href="javascript:void(0)" class="show_set_objective">Review of last performance – Objectives and targets</a></td>
    <td><a href="javascript:void(0)" class="show_review_last">Set objectives and targets for the comming year</a></td>
  </tr>
</table>

</div>

<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table_content set_objective" style="display:none;">
  <tr>
    <td width="30%">Objectives /targets from last appraisal</td>
    <td width="20%">Objective met</td>
    <td>Supporting evidance – Please note any other factors affecting performance (positive or negative)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <select class="form-control">
        <option>Yes</option>
        <option>No</option>
        <option>Partially</option>
      </select>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>

<div class="review_last" style="display:none;">
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table_content">
  <tr>
    <td width="25%">New targets / objectives (An appropriate and manageable number)</td>
    <td width="30%">How are these linked to your personal / team / Directorate / Council targets / objectives / sercvice improvements ?</td>
    <td width="30%">How will success be measured?<br>e.g Performance Indicators Supporting Evidence</td>
    <td width="15%">Completion Date</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></div>
</div>

<div class="clearfix"></div>


<!--<span class="search_t">Search</span>
<button class="sent_btn">SEND</button>-->


                         </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <!-- /.tab-pane -->


                <div id="tab_6" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                         <div class="col_m2">
<div class="notes_top_btns">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_content">
  <tr>
    <td><a href="javascript:void(0)" class="show_identifying">Identifying competencies /skills for development in the coming year</a></td>
    <td><a href="javascript:void(0)" class="show_performance">Review of last performance</a></td>
  </tr>
</table>

</div>

<div class="identifying_table" style="display:none;">
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table_content">
  <tr>
    <td width="25%">Competencies / Skills identified for development</td>
    <td width="15%">Competency level required</td>
    <td width="15%">Previous Competency level</td>
    <td width="15%">Current Competency level</td>
    <td width="30%">Supporting evidence – note other factors affrecting performance (Positive or negative)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
<div class="performance_table" style="display:none;">
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table_content">
  <tr>
    <td>Competencies / Skills identified for development</td>
    <td>Competency lavel required</td>
    <td>Current Competency lavel</td>
    <td>How will competencies be developed ?(e.g coaching,specific task,training course,shadowing a colleague)</td>
    <td>How will success be measured? i.e what type of supporting evidence will be gathered.</td>
    <td>Completion date</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></div>
</div>

<div class="clearfix"></div>


<!--<span class="search_t">Search</span>
<button class="sent_btn">SEND</button>-->


                         </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab_7" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col_m2">
                            <h3 class="box-title">ADDITIONAL COMMENTS</h3>
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table_content">
  <tr>
    <td>Appraisee's Comments</td>
    <td><textarea cols="50" rows="4"></textarea></td>
  </tr>
  <tr>
    <td>Appraiser's Comments</td>
    <td><textarea  cols="50" rows="4"></textarea></td>
  </tr>
  <tr>
    <td>Appraisee Signature :</td>
    <td><input type="text" id="" class="text_small"></td>
  </tr>
  <tr>
    <td>Appraiser Signature :</td>
    <td><input type="text" id="" class="text_small"></td>
  </tr>
</table>

                            </div>
                          
                          
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                <!-- /.tab-pane -->
              </div>
            </div>
<!--end sub tab-->


                         </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <!-- /.tab-pane -->
                <div id="tab_2" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col_m2">
  <table class="table table-bordered table-hover dataTable" id="example1">
    <thead>
      <tr role="row">
        <th></th>
        <th><strong>Review Date</strong></th>
        <th><strong>Date Joined</strong></th>
        <th><strong>Department</strong></th>
        <th><strong>Job Title</strong></th>
        <th><strong>Staff Name</strong></th>
        <th><strong>Notes</strong></th>
      </tr>
    </thead>

    <tbody role="alert" aria-live="polite" aria-relevant="all">
      <tr>
        <td align="center"><img src="img/cross.png" /></td>
        <td align="center">29/07/2015</td>
        <td align="center">29/07/2015</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
    </tbody>
  </table>                          
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab_3" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col_m2">
    <table class="table table-bordered table-hover dataTable" id="example2">
      <thead>
        <tr role="row">
          <th></th>
          <th><strong>Review Date</strong></th>
          <th><strong>Date Joined</strong></th>
          <th><strong>Department</strong></th>
          <th><strong>Job Title</strong></th>
          <th><strong>Staff Name</strong></th>
          <th><strong>Notes</strong></th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        <tr>
          <td align="center"><img src="img/cross.png" /></td>
          <td align="center">29/07/2015</td>
          <td align="center">29/07/2015</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </tbody>
    </table>
                          
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                <!-- /.tab-pane -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->


@stop
<!-- staff-->
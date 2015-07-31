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
                        <div class="col-xs-12 col-xs-8">
                          <div class="col_m2 icon_poisition">
                          <div class="notes_inner">
                          <div class="notes_inner_top">
                          <img src="img/icon_1.png" class="heading_icon">
                          <div class="n_top_left">
                          <span class="n_heading">TB Coder</span>
                          <p><span class="n_heading_name">By Abel Asiamah</span> <span class="n_date">On: Sat, 28 July, 2015 at 5:50PM</span></p>
                          </div>
                          <div class="print">
                          <a href="#"><img src="img/print.png"></a>
                          </div>
                          <div class="clearfix"></div>
                          </div>
                          <p class="n_text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                          
                          <!-- <div class="add_client_btn">
                              <button class="btn btn-warning">Edit</button>
                              <button class="btn btn-info">Delete</button>
                              <button class="btn btn-success">Save</button>
                              <button class="btn btn-danger">Cancel</button>
                            </div> -->
                             <div class="clearfix"></div>
                          </div>
                          
                            <div class="add_client_btn">
                              <button class="btn btn-warning">Edit</button>
                              <button class="btn btn-info">Delete</button>
                              <button class="btn btn-success">Save</button>
                              <button class="btn btn-danger">Cancel</button>
                            </div>

                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-4"> 
                        <div class="col_m2">
                        <div class="noted_right">
                        <img src="img/plus_1.png" class="icon_gap"> <strong class="notes_h_t">New Notes</strong>
                        <div class="notes_points">
                        <span class="notes_h_t">NOTES</span>
                        <ul>
                        <li><a href="#">TB Coder System requirements</a></li>
                        <li><a href="#">How does TB coder work</a></li>
                        <li><a href="#">Is TB coder a Secure site?</a></li>
                        <li><a href="#">Sign Up for a TB coder account</a></li>
                        <li><a href="#">How can I sin up for TB coder</a></li>
                        <li><a href="#">For which contries is TB coder available?</a></li>
                        <li><a href="#">Does TB coder work any accounts</a></li>
                        </ul>
                        </div>
                        </div>
                        </div>
                        </div>
                      </div>

    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->


@stop
<!-- staff-->
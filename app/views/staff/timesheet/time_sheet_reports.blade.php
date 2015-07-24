@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
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
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ]

    });
  Table1.fnSort( [ [2,'asc'] ] );

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
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ]

    });

   
   Table2.fnSort( [ [2,'asc'] ] );

});


/*$(document).ready(function(){
  $("#archivedButton").click(function(){
        var oSettings = oTable.fnSettings();
        oSettings._iDisplayLength = -1;
        oTable.fnDraw();
  })
})*/
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
      <div class="practice_mid">
        <form>
          <div class="top_buttons">
            <div class="top_bts">
              <ul>
                <li>
                  <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                </li>
                <li>
                  <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
                </li>
                <li>
                  <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
                </li>
                <div class="clearfix"></div>
              </ul>
            </div>
          </div>
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">TIME SHEET</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">TIME SHEET LOG</a></li>
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
                        <div style="width:100%; margin: 0 0 40px 15px;">
                            <div style="float: left; padding-right: 10px;"><button class="btn btn-default" data-toggle="modal" data-target="#compose-modal"><span class="requ_t">New Time Sheet</span></button></div>

                            <div style="float: left; padding-right: 10px;"><button class="btn btn-default">Client Time Report</button></div>

                            <div style="float: left;"><button class="btn btn-default"><span class="decline_t">Staff Time Report</span></button></div>
                          </div>
                        <div class="col-xs-12">
                          
                          <!--start table-->
                          
                          <table class="table table-bordered table-hover dataTable" id="example1" aria-describedby="example1_info">
            
                            <thead>
                              <tr role="row">
                                <th align="center"><input type="checkbox" id="allCheckSelect"/></th>
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th><strong>Service</strong></th>
                                <th><strong>HRS</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                              <tr>
                                <td><input type="checkbox" /></td>
                                <td align="left"><input type="text" placeholder="dd/mm/yy">
                                  AM - HALF DAY</td>
                                <td align="center">fdfwef</td>
                                <td align="center">wqefef</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center"><a href="#"><img src="/img/edit_icon.png" width="15"></a>
                                  <!--<a href="#"><img src="img/delete_icon.png" width="15"></a>--></td>
                              </tr>
                              
                            </tbody>
                          </table>
                          
                          <!--end table-->
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
                          <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                                <th align="center"><input type="checkbox" id="allCheckSelect"/></th>
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th><strong>Service</strong></th>
                                <th><strong>HRS</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                              <tr>
                                <td><input type="checkbox" /></td>
                                <td align="left"><input type="text" placeholder="dd/mm/yy">
                                  AM - HALF DAY</td>
                                <td align="center">fdfwef</td>
                                <td align="center">wqefef</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center"><a href="#"><img src="/img/edit_icon.png" width="15"></a>
                                  <!--<a href="#"><img src="img/delete_icon.png" width="15"></a>--></td>
                              </tr>
                              
                            </tbody>
                          </table>
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


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <form action="#" method="post">
      
      <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          <table width="100%" border="0" class="staff_holidays">
            <tr>
              <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%"><strong>NEW TIME SHEET</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

              </td>
            </tr>
            <tr>
              <td valign="top">
              <table width="100%" class="table table-bordered">
            <tbody>
              <!-- <tr class="table_heading_bg"> -->
              <tr>
                <td width="20%"><strong>Date</strong></td>
                <td width="20%" align="center"><strong>Staff Name</strong></td>
                <td width="20%" align="center"><strong>Client Name</strong></td>
                <td width="20%" align="center"><strong>Service</strong> <a href="#">Add/Edit List</a></td>
                <td width="6%" align="center"><strong>HRS</strong></td>
                <td width="14%" align="center"><strong>Notes</strong></td>
              </tr>
              <tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>
              <tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>
              <tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>
              <!-- <tr>
                <td align="left" colspan="5"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></td>
                <td align="center"><button class="btn btn-primary">Submit</button></td>
              </tr> -->
            </tbody>
          </table>
              </td>
            </tr>
          </table>
          <div class="save_btncon">
            <div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></div>
            <div class="right_side"> <button class="btn btn-primary">Submit</button></div>
            <div class="clearfix"></div>
            </div>
         
        </div>
        
        
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@stop
<!-- time-->
@extends('layouts.layout')
 
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%">
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
        </div></td>
    <td width="6%">Select Staff</td>
    <td width="9%">
<select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select>
</td>
<td width="3%">&nbsp;</td>
    <td width="10%">Holidays Entitlement</td>
    <td width="3%"><input type="text" id="" class="form-control" value="20"></td>
    <td width="3%">&nbsp;</td>
    <td width="10%">Holidays Taken</td>
    <td width="3%"><input type="text" class="form-control" value="18"></td>
    <td width="3%">&nbsp;</td>
    <td width="10%">Holidays Remaining</td>
    <td width="3%"><input type="text" id="" class="form-control" value="10"></td>
    <td width="3%">&nbsp;</td>
  </tr>
</table>

      </div>
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">Awating Approval</a></li>
                <li><a data-toggle="tab" href="#tab_2">Approved</a></li>
                <li><a data-toggle="tab" href="#tab_3">Previous Requests</a></li>
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
                          <!--start table-->
                          <table width="100%" border="0" class="staff_holidays">
                            <tr>
                              <td valign="top">
                              <table width="100%" border="0">
  <tr>
 
    <td width="4%"><strong>Show</strong></td>
<td width="8%"><select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select>
</td>
<td width="20%"><strong>entries</strong></td>
 <td width="36%">&nbsp;</td>
<td><button class="btn btn-default" data-toggle="modal" data-target="#compose-modal"><span class="requ_t">New Request</span></button></td>
<td><button class="btn btn-default">Approve</button></td>
<td><button class="btn btn-default"><span class="decline_t">Decline</span></button></td>
<td width="5%"><strong>Search</strong></td>
<td width="20%">
<input type="text" id="" class="form-control">

    </td>
  </tr>
</table>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="89%"><strong>BOOKED COURSES</strong></td>
<td width="11%"><button class="btn btn-success" data-toggle="modal" data-target="#compose-modal">+ NEW COURSES</button></td>
</tr>
</table>-->
</td>
                            </tr>
                            <tr>
                              <td valign="top"><table width="100%" class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td width="5%">&nbsp;</td>
                                      <td width="15%"><strong>Staff Name</strong></td>
                                      <td width="15%" align="center"><strong>Request Type</strong></td>
                                      <td width="10%" align="center"><strong>Date</strong></td>
                                      <td width="15%" align="center"><strong>Duration</strong></td>
                                      <td width="15%" align="center"><strong>Status</strong></td>
                                      <td width="15%" align="center"><strong>Notes</strong></td>
                                      <td width="10%" align="center">Action</td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">ewf wefew</td>
                                      <td align="center">erwafew</td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">Avating Approval</td>
                                      <td align="center"><a href="#">Views</a></td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> </td>
                                    </tr>
                                     <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">ewf wefew</td>
                                      <td align="center">erwafew</td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">Avating Approval</td>
                                      <td align="center"><a href="#">Views</a></td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
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
                          <table width="100%" border="0" class="staff_holidays">
                            <tr>
                              <td valign="top"><table width="100%" border="0">
                                  <tr>
                                    <td width="36%"><strong>COURSES</strong></td>
                                    <td width="4%"><strong>Show</strong></td>
                                    <td width="8%"><select class="form-control">
                                        <option>50</option>
                                        <option>20</option>
                                        <option>10</option>
                                        <option>15</option>
                                      </select></td>
                                    <td width="20%"><strong>entries</strong></td>
                                    <td width="7%">&nbsp;</td>
                                    <td width="5%"><strong>Search</strong></td>
                                    <td width="20%"><input type="text" id="" class="form-control"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td valign="top"><table width="100%" class="table table-bordered">
                                  <tbody>
                                    <tr class="table_heading_bg">
                                      <td width="5%">&nbsp;</td>
                                      <td width="15%"><strong>Date - From</strong></td>
                                      <td width="18%" align="center"><strong>Date - To</strong></td>
                                      <td width="16%" align="center"><strong>Course Name</strong></td>
                                      <td width="20%" align="center"><strong>Staff Name</strong></td>
                                      <td width="17%" align="center"><strong>Attachments</strong></td>
                                      <td width="9%" align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                  <div id="tab_3" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <table width="100%" border="0" class="staff_holidays">
                            <tr>
                              <td valign="top"><table width="100%" border="0">
                                  <tr>
                                    <td width="36%"><strong>COURSES</strong></td>
                                    <td width="4%"><strong>Show</strong></td>
                                    <td width="8%"><select class="form-control">
                                        <option>50</option>
                                        <option>20</option>
                                        <option>10</option>
                                        <option>15</option>
                                      </select></td>
                                    <td width="20%"><strong>entries</strong></td>
                                    <td width="7%">&nbsp;</td>
                                    <td width="5%"><strong>Search</strong></td>
                                    <td width="20%"><input type="text" id="" class="form-control"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td valign="top"><table width="100%" class="table table-bordered">
                                  <tbody>
                                    <tr class="table_heading_bg">
                                      <td width="5%">&nbsp;</td>
                                      <td width="15%"><strong>Date - From</strong></td>
                                      <td width="18%" align="center"><strong>Date - To</strong></td>
                                      <td width="16%" align="center"><strong>Course Name</strong></td>
                                      <td width="20%" align="center"><strong>Staff Name</strong></td>
                                      <td width="17%" align="center"><strong>Attachments</strong></td>
                                      <td width="9%" align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center"><input type="text" placeholder="dd/mm/yy"></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
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
  <div class="modal-dialog" style="width:800px;">
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
    <td width="30%"><strong>HOLIDAY/TIME OFF REQUEST</strong></td>
    <td width="30%">&nbsp;</td>
    <td width="10%"><strong>Staff Name</strong></td>
    <td width="15%">
<select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select></td>
  </tr>
</table>

              </td>
            </tr>
            <tr>
              <td valign="top">
              <table width="100%" class="table table-bordered">
                                  <tbody>
                                    <tr>
                                     <td align="center">&nbsp;</td>
                                      <td align="center"><strong>Date</strong></td>
                                      <td align="center"><strong>Duration</strong></td>
                                      <td align="center"><strong>Request type</strong></td>
                                      <td align="center"><strong>Notes</strong></td>
                                    </tr>
                                    <tr>
                                      <td><a href="#"><img src="img/cross_icon.png" /></a></td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">AM - HALF DAY</td>
                                      <td align="center">
                                      <select class="form-control">
                                        <option>ewfwe</option>
                                        <option>ergreg </option>
                                        <option>regerg</option>
                                        <option>rtyhrt</option>
                                        </select></td>
                                      <td align="center"><input type="text" id="" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td><a href="#"><img src="img/cross_icon.png" /></a></td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">AM - HALF DAY</td>
                                      <td align="center">
                                      <select class="form-control">
                                        <option>ewfwe</option>
                                        <option>ergreg </option>
                                        <option>regerg</option>
                                        <option>rtyhrt</option>
                                        </select></td>
                                      <td align="center"><input type="text" id="" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td><a href="#"><img src="img/cross_icon.png" /></a></td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">AM - HALF DAY</td>
                                      <td align="center">
                                      <select class="form-control">
                                        <option>ewfwe</option>
                                        <option>ergreg </option>
                                        <option>regerg</option>
                                        <option>rtyhrt</option>
                                        </select></td>
                                      <td align="center"><input type="text" id="" class="form-control"></td>
                                    </tr>
                                     
                                  </tbody>
                                </table>
              </td>
            </tr>
          </table>
          <div class="save_btncon">
         <div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></div>
         <div class="right_side"> <button class="btn btn-success">Submit for Approval</button></div>
         <div class="clearfix"></div>
         </div>
         <!--<div class="row">
                  <div class="col-xs-6">
                    <div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div>
                  </div>
                  <div class="col-xs-6">
                    <div class="dataTables_paginate paging_bootstrap">
                      <ul class="pagination">
                        <li class="prev disabled"><a href="#">← Previous</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li class="next"><a href="#">Next → </a></li>
                      </ul>
                    </div>
                  </div>
                </div>-->
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@stop
<!-- staff-->
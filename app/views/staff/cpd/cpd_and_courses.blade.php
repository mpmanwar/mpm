@extends('layouts.layout') @section('mycssfile')

@stop
 @section('myjsfile')
 
@stop
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
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">Booked</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">CPD Log</a></li>
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
                              <td valign="top"><!--<table width="100%" border="0">
  <tr>
  <td width="36%"><strong>BOOKED COURSES</strong></td>
    <td width="4%"><strong>Show</strong></td>
<td width="8%"><select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select>
</td>
<td width="20%"><strong>entries</strong></td>
<td width="7%">&nbsp;</td>
    <td width="5%"><strong>Search</strong></td>
    <td width="20%">
<input type="text" id="" class="form-control">

    </td>
  </tr>
</table>-->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="89%"><strong>BOOKED COURSES</strong></td>
                                    <td width="11%"><button class="btn btn-success" data-toggle="modal" data-target="#compose-modal">+ NEW COURSES</button></td>
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
              <td><div class="client_timebg">Add Course</div></td>
            </tr>
            <tr>
              <td valign="top"><table width="100%" border="0">
                  <tr>
                    <td width="16%"><strong>Course Name :</strong></td>
                    <td><input type="text" style="width:100%;" /></td>
                    <td width="4%">&nbsp;</td>
                    <td width="55%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="25"><strong>Start Date :</strong></td>
                    <td width="25%"><input type="text" placeholder="dd/mm/yy" /></td>
                    <td width="4%">To</td>
                    <td><input type="text" placeholder="dd/mm/yy" /></td>
                  </tr>
                  <tr>
                    <td><strong>Attachment :</strong></td>
                    <td width="25%"><input type="file" value="Attachment" /></td>
                    <td width="4%">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><strong>Allocate :</strong></td>
                    <td><select class="form-control">
                        <option>Leave Bank if own</option>
                        <option>Sole Tradership</option>
                      </select></td>
                    <td>&nbsp;</td>
                    <td align="right"><button class="btn btn-primary">SUBMIT</button></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
    <!--noti -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@stop
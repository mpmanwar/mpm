@extends('layouts.layout') 
    @section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop
 @section('myjsfile')
 <!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

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
            <li>
              <button class="btn btn-info"><!--<i class="fa fa fa-file-text-o"></i>--> Invite Staff User</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>

      </div>
          <div class="tabarea">
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
                                      <td width="15%" align="center"><strong>Position/Job Title</strong></td>
                                      <td width="10%" align="center"><strong>Date Joined</strong></td>
                                      <td width="15%" align="center"><strong>Holidays Left</strong></td>
                                      <td width="15%" align="center"><strong>Department</strong></td>
                                      <td width="15%" align="center"><strong>Address</strong></td>
                                      <!--<td width="10%" align="center">Action</td>-->
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">ewf wefew</td>
                                      <td align="center">erwafew</td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">Avating Approval</td>
                                      <td align="center">ewfefewf </td>
                                     <!-- <td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>-->
                                    </tr>
                                     <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">ewf wefew</td>
                                      <td align="center">erwafew</td>
                                      <td align="center">20/07/2015</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">Avating Approval</td>
                                      <td align="center">efewf efef</td>
                                      <!--<td align="center"><a href="#"><img src="img/edit_icon.png" width="15"></a> <a href="#"><img src="img/delete_icon.png" width="15"></a></td>-->
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </table>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- popup content -->
<!-- add new calendar event modal -->
<!--start popup-->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">INVITE STAFF</h4>
        <div class="clearfix"></div>
      </div>
      <form action="#" method="post">
        <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Name</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Start Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Holiday Entitlement</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Residential Address</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <!--<label for="exampleInputPassword1">Residential Address</label>-->
                              <input type="text" id="" class="form-control">
                            </div>
                            
                            <div class="form-group">
                              <div class="n_box2">
                              <label for="exampleInputPassword1">Post Code</label>
                              <input type="text" id="" class="form-control">
                              </div>
                              <div class="n_box2">
                              <label for="exampleInputPassword1">Date of Birth</label>
                                <input type="text" id="" class="form-control">
                              </div>
                              <div class="n_box2" style="margin-right:0;">
                              <label for="exampleInputPassword1">NINO</label>
                                <input type="text" id="" class="form-control">
                              </div>
                              
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Bank Name</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Sort Code</label>
                              <div class="clearfix"></div>
                              <div class="n_box2">
                               <input type="text" id="" class="form-control">
                              </div>
                              <div class="n_box2">
                                <input type="text" id="" class="form-control">
                              </div>
                              <div class="n_box2" style="margin-right:0;">
                                <input type="text" id="" class="form-control">
                              </div>
                              
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Account Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Mobile Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Email</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Salary</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Leaving Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Qualifications</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Department</label>
                                  <select class="form-control">
                                  <option>wqdwqd</option>
                                  <option>weqfewqf</option>
                                </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Emergency Contact Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Emergency Contact Tel</label>
                                 <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <!--<div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Emergency Contact Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>-->
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="form-group">
                            <h3 class="box-title">Documents</h3>
                              <div class="n_box2">
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="label_width">CV</label>
                                 <button class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                                </div>
                              </div>
                              <div class="n_box2">
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="label_width">ID</label>
                                 <button class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                                </div>
                              </div>
                              
                              <div class="n_box2" style="margin-right:0;">
                              <div class="form-group">
                                 <label for="exampleInputPassword1" class="label_width">Employment Contract</label>
                                 <button class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                                </div>
                              </div>
                              
                              <div class="clearfix"></div>
                            </div>
                             <div class="clearfix"></div>
                        
                            
    
          
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--end popup-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false

                });
            });

        </script>

@stop
<!--staff -->
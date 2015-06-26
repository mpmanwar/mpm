@extends('layouts.layout') 
    @section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop
 @section('myjsfile')
 <!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

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
    <div class="row">
<div class="top_bts">
<ul>
<li><button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button></li>
<li><button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button></li>
<div class="clearfix"></div>
</ul>
  
</div>
</div>     
      <div class="practice_mid">
        <form>
          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                  
                    <button class="btn btn-success" data-toggle="modal" data-target="#compose-modal">Invite Staff</button>
                  </li>
                  <li>
                    <button class="btn btn-danger">Delete</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
                <table width="100%" border="0">
                  <tr>
                  <td><button class="btn btn-warning">Archive</button></td>
                    <td>&nbsp;</td>
                    <td><a href="#">Hide Archived</a></td>
                    
                  </tr>
                </table>
              </div>
              <div class="clearfix"></div>
            </div>
            
<div class=" col-xs-12">
<!--start table-->        
<table width="100%" border="0" class="staff_holidays">
    <tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="5%"><strong>Show</strong></td>
<td width="7%"><select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select>
</td>
<td width="35%"><strong>entries</strong></td>
<td width="24%">&nbsp;</td>
    <td width="5%"><strong>Search</strong></td>
    <td width="21%">
<input type="text" id="" class="form-control">

    </td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td valign="top">
    <table width="100%" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                     <td><input type="checkbox" /></td>
                                      <td><strong>Date</strong></td>
                                      <td align="center"><strong>Staff Name</strong></td>
                                      <td align="center"><strong>Date Joined</strong></td>
                                      <td align="center"><strong>DOB</strong></td>
                                      <td align="center"><strong>Position</strong></td>
                                      <td align="center"><strong>Holidays Left</strong></td>
                                      <td align="center"><strong>Nino</strong></td>
                                      <td align="center"><strong>Telephone</strong></td>
                                      <td align="center"><strong>Salary</strong></td>
                                      <td align="center"><strong>Qualifications</strong></td>
                                      <td align="center"><strong>Department</strong></td>
                                      <td align="center"><strong>Address</strong></td>
                                      <td align="center"><strong>Notes</strong></td>
                                    </tr>
                                    
                                    <tr>
                                     <td><input type="checkbox" /></td>
                                      <td>wqdwqd</td>
                                      <td align="center">efewf</td>
                                      <td align="center">ewfe</td>
                                      <td align="center">wfwe</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">ergre</td>
                                      <td align="center">ewfew</td>
                                      <td align="center">ewf</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                     <td><input type="checkbox" /></td>
                                      <td>wqdwqd</td>
                                      <td align="center">efewf</td>
                                      <td align="center">ewfe</td>
                                      <td align="center">wfwe</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">ergre</td>
                                      <td align="center">ewfew</td>
                                      <td align="center">ewf</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    
                                    
                                  </tbody></table>
    </td>
  </tr>
</table>
<!--end table-->

        </div>
<div class="clearfix"></div>

            
            
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
@extends('layouts.layout')
 @section('mycssfile')

@stop
 @section('myjsfile')
  
 
  <script src="{{ URL :: asset('ckeditor/ckeditor.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="js/notice_board.js"></script>
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
      <!--<div class="row">
        <div class="top_bts">
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
        </div>
      </div>-->
      <div class="practice_mid">
        <form>
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">Board 1</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">Board 2</a></li>
                <li class=""><a data-toggle="tab" href="#tab_3">Staff Holiday/Course</a></li>
                <li class=""><a data-toggle="tab" href="#tab_4">PDF Viewer</a></li>
                <li class=""><a href="#tab_5" data-toggle="modal" data-target="#compose-modal">NEW</a></li>
                
                
                
                
                
                
                <!--<li><a href="#" class=" btn-block btn-primary "> Add </a></li>-->
              </ul>
              <div class="tab-content" style="padding:10px 0 0 0;">
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
                        <div class="notice_board">
                        <div class="notice_upbg"></div>
                        <div class="notice_midbg">
                      <div class="col-xs-12">
                        <div class="col-xs-6">
                        <div class="notice_baordbg">
                        <div class="bottom_content">
                        <p class="posted_t">Posted/Uplaod by Ramjee Sharma 22/06/2015</p>
                        <div class="edit_controlar">
                        <a href="#"><img src="img/edit_icon.png" /></a>
                         <a href="#"><img src="img/cross.png" /></a>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        </div>
                        
                        <div class="baord_content">
                        <div class="notice_board_content">
                        <span>Lorem Ipsum is simply dummy text of the printing</span>
                        <p> and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </div>
                         <div class="clearfix"></div>
                        <div class="bottom_content">
                        <p class="posted_t">Posted/Uplaod by Ramjee Sharma 22/06/2015</p>
                        <div class="edit_controlar">
                        <a href="#"><img src="img/edit_icon.png" /></a>
                         <a href="#"><img src="img/cross.png" /></a>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        
                        </div>
                        
                        </div>
                        <div class="col-xs-6">
                        <div class="new_btn">
                        
                        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#compose-modal">NEW</button>-->
                        <!--<button class="btn btn-primary">NEW</button>--></div>
                        </div>
                        
                        
                        
                      </div>
                       <div class="clearfix"></div>
                        </div>
                        <div class="notice_downbg"></div>
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
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Ni Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tax Reference</label>
                                  <select class="form-control">
                                    <option>Postal</option>
                                    <option>Board</option>
                                    <option>Company</option>
                                    <option>LLP</option>
                                    <option>Incorporation Charity</option>
                                    <option>Unincorporation Charity</option>
                                    <option>Other</option>
                                  </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax Office</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Town/City</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">State Region</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postal/Zip Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Telephone</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="add_client_btn">
                              <button class="btn btn-info">Next</button>
                              <button class="btn btn-success">Save</button>
                              <button class="btn btn-danger">Cancel</button>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6"></div>
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
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <h3 class="box-title">Residential Address</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Residential Address</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Town/City</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">State Region</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postal/Zip Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Service Address</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Service Address</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Town/City</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">State Region</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postal/Zip Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <label for="exampleInputPassword1">Telephone</label>
                            <div class="form-group">
                              <div class="n_box01">
                                <select class="form-control">
                                  <option>Mr.</option>
                                  <option>Mrs.</option>
                                </select>
                              </div>
                              <div class="telbox">
                                <input type="text" id="" class="form-control">
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Email</label>
                              <input type="email" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Website</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Skype</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="add_client_btn">
                              <button class="btn btn-info">Next</button>
                              <button class="btn btn-success">Save</button>
                              <button class="btn btn-danger">Cancel</button>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6"> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab_4" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col_m2">
                            <div class="director_table">
                              <h3 class="box-title">RELATIONSHIP</h3>
                              <div class="form-group">
                                <button class="btn btn-info"><i class="fa fa-plus"></i> New</button>
                              </div>
                              <div class="box-body table-responsive">
                                <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                  <div class="row">
                                    <div class="col-xs-6"></div>
                                    <div class="col-xs-6"></div>
                                  </div>
                                  <table width="100%" class="table table-bordered table-hover dataTable">
                                    <tr>
                                      <td><strong>Name</strong></td>
                                      <td align="center"><strong>Appointment Date</strong></td>
                                      <td align="center"><strong>Relationship Type</strong></td>
                                      <td align="center"><strong>Action</strong></td>
                                    </tr>
                                    <tr>
                                      <td>Work Paper Limited</td>
                                      <td align="center">23/04/2015</td>
                                      <td align="center"><select class="form-control">
                                          <option>Director</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
                                      <td align="center"><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                      <td><input type="text" placeholder="Search..." class="form-control" name="q">
                                        <div class="search_value">
                                          <ul>
                                            <li>Select Value</li>
                                            <li>Select Value</li>
                                            <li>Select Value</li>
                                            <li>Select Value</li>
                                          </ul>
                                        </div></td>
                                      <td align="center"><input type="text" id="" class="form-control"></td>
                                      <td align="center"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
                                      <td align="center"><a href="#">Edit</a></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="add_client_btn">
                                <button class="btn btn-info">Next</button>
                                <button class="btn btn-success">Save</button>
                                <button class="btn btn-danger">Cancel</button>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab_5" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <div class="director_table">
                              <div class="others_topcon">
                                <div class="other_left">
                                  <h3 class="box-title">OHERS</h3>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Tax Return Required</label>
                                      <input type="checkbox"/>
                                    </div>
                                </div>
                                <div class="twobox">
                                  <div class="add_client_btn">
                                    <button class="btn btn-success">Save</button>
                                    <button class="btn btn-danger">Cancel</button>
                                    <div class="clearfix"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="other_mid">
                                <div class="other_left_sec">
                                  <div class="download_pdf">
                                  <button class="btn download_icon"></button>
                                  <!--<button class="btn btn-success"><i class="fa fa-download"></i>DOWNLOAD</button>-->
                                  </div>
                                  <div class="select_business">
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Select Business Name</label>
                                      <select class="form-control">
                                        <option>Monobrata</option>
                                        <option>R Sharma</option>
                                        <option>Company</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="other_right_sec">
                                  <p class="select_t">Select Service</p>
                                  <table width="100%" class="table table-bordered">
                                    <tr>
                                      <td><strong>Name</strong></td>
                                      <td align="center"><strong>SA/NI</strong></td>
                                      <td align="center"><strong>TC</strong></td>
                                      <td align="center"><strong>CT</strong></td>
                                      <td align="center"><strong>PAYE</strong></td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center"><input type="checkbox" /></td>
                                      <td align="center"><input type="checkbox" /></td>
                                      <td align="center"><input type="checkbox" /></td>
                                      <td align="center"><input type="checkbox" /></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <table width="100%" border="0" >
                                <tr>
                                  <td width="52%"><button class="btn btn-danger">Upload Passport & Utility docs</button></td>
                                  <td width="48%"><span class="btn btn-default btn-file"> Browse
                                    <input type="file">
                                    </span></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><span class="btn btn-default btn-file"> Browse
                                    <input type="file">
                                    </span></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><button class="btn btn-success">Other Documents</button></td>
                                  <td><span class="btn btn-default btn-file"> Browse
                                    <input type="file">
                                    </span></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><span class="btn btn-default btn-file"> Browse
                                    <input type="file">
                                    </span></td>
                                  <td>&nbsp;</td>
                                </tr>
				               </table>
                              <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab_6" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <div class="director_table">
                              <h3 class="box-title">OHERS</h3>
                              <div class="twobox">
                                <div class="twobox_1">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">AML Checks Done</label>
                                    <input type="checkbox"/>
                                  </div>
                                </div>
                                <div class="twobox_2">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Acting?</label>
                                    <input type="checkbox"/>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="twobox">
                                <div class="twobox_1">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Tax Return Required</label>
                                    <input type="checkbox"/>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Responsible Staff</label>
                                <select class="form-control">
                                  <option>Monobrata Sdhg</option>
                                  <option>R Sharma</option>
                                  <option>Company</option>
                                </select>
                              </div>
                            </div>
                            <div class="add_client_btn">
                              <button class="btn btn-info">Next</button>
                              <button class="btn btn-success">Save</button>
                              <button class="btn btn-danger">Cancel</button>
                            </div>
                            <div class="clearfix"></div>
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


<!-- COMPOSE MESSAGE MODAL -->
{{ Form::open(array('url' => '/notice-template', 'files' => true)) }}
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">



  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">NOTICE BOARD</h4>
        <div class="clearfix"></div>
      </div>
      
      
      <!-- New popup -->
      
      <form action="#" method="post">
        <div class="modal-body">
        <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Message Subject</label>
                                  <input type="text" id="message_subject" name="message_subject" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
            <label for="exampleInputPassword1">Type </label>
            <select class="form-control" name="typecatagory" id="typecatagory">
             <!-- <option>Select Relatioship Type</option> -->
             
              <option value="Postal">Postal</option>
              <option value="Board">Board</option>
             
            </select>
          </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
   
   <div class="twobox">
   

 <div class="form-group">
           
            <textarea name="add_message" id="add_message" class="form-control" placeholder="Message....." style="height: 250px;"></textarea>
 </div>

 
   </div>
                            
<div class="twobox">

<div class="twobox_1">
<i class="fa fa-attach"></i> Attachment
<input type="file" name="add_file" id="add_file" />

</div>





<div class="twobox_2">
<div class="email_btns1">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="save" class="btn btn-primary pull-left save_t">Save</button>
            </div>
</div>
<div class="clearfix"></div>
</div>

<div class="notify_con">
<h4 class="modal-title">Notify Users</h4>


                                    @foreach($username as $key=>$val)
                                    
                                        <div class="notify_users">
                                        <input type="checkbox" name="arr[];" value="{{ $val['user_id'] }}"/>
                                        <label>{{ $val['fname'].' '.$val['lname']}}</label>
                                        </div>
                                    @endforeach
                                                                                                            
<!--<div class="notify_users">
<input type="checkbox"/>
<label>AA</label>
</div>
 
<div class="notify_users">
<input type="checkbox"/>
<label>RK</label>
</div>
 
 <div class="notify_users">
<input type="checkbox"/>
<label>RK</label>
</div>-->            

<div class="clearfix"></div>
</div>
                     
     hfjskhfsklgsk
            <!-- New popup -->
          
          <!--<div class="modal-footer clearfix">
            <div class="email_btns">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="save" class="btn btn-primary pull-left save_t">Save</button>
            </div>
          </div>-->
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  
  {{ Form :: close() }}
</div>


@stop
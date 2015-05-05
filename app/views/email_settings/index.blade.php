@extends('layouts.layout')
@section('content')

<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    @include('layouts.inner_leftside')
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> EMAIL SETTINGS </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Email Settings</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      
      <div class="practice_mid">
        <form>
          
          <div class="tabarea">
            <div class="box-header">
              <h3 class="box-title">Email Templates</h3>
            </div>
            <div class="add_template"><a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i> Add template</a></div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
             <!-- <p>Choose the user's level of access to this organisation's accounts:</p>-->
              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                
                <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Type</th>
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Attachment</th>
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Action</th>
                     </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <tr class="odd">
                      <td class="sorting_1">fewf</td>
                      <td class=" " align="center">wefwef</td>
                      <td class=" " align="center">wefewf</td>
                      <td class=" " align="center"><a href="#">Edit</a></td>
                      <td class=" " align="center"><a href="#"><img src="img/cross.png" /></a></td>
                    </tr>
                    <tr class="even">
                      <td class="sorting_1">fewf</td>
                      <td class=" " align="center">wefwef</td>
                      <td class=" " align="center">wefewf</td>
                      <td class=" " align="center"><a href="#">Edit</a></td>
                      <td class=" " align="center"><a href="#"><img src="img/cross.png" /></a></td>
                    </tr>
                    <tr class="odd">
                      <td class="sorting_1">fewf</td>
                      <td class=" " align="center">wefwef</td>
                      <td class=" " align="center">wefewf</td>
                      <td class=" " align="center"><a href="#">Edit</a></td>
                      <td class=" " align="center"><a href="#"><img src="img/cross.png" /></a></td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="clearfix"></div>
          
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">NEW TEMPLATE</h4>
                        
                        
                        
                       
                        <div class="clearfix"></div>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input_box_g">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                                </div>
                                
                                <div class="input_dropdown">
                                            <label>Insert Variable</label>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                  <div class="clearfix"></div>      
                            </div>
                            <div class="form-group">
                                <div class="input_box_g">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input name="Title" type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="input_dropdown">
                                            <label>Select</label>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                             <div class="clearfix"></div>     
                            </div>
                            <!--<div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">BCC:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Email BCC">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 250px;"></textarea>
                            </div>
                            <!--<div class="form-group">                                
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment"/>
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>-->

                        </div>
                       <div class="modal-footer clearfix">
                            <div class="email_btns">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="save" class="btn btn-primary pull-left save_t">Save</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

@stop




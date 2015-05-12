@extends('layouts.layout')
@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ URL :: asset('img/user3.jpg') }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        INDIVIDUAL CLIENT LIST
                        <small>CLIENT NAME  Limited</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Individual Clients</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
      <div class="row">
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
      </div>
      <div class="practice_mid">
        <form>
          <!--<div class="row box_border2 row_cont">
 <div class="col-xs-12 col-xs-6 p_left">
 <h2 class="res_t">USERS <small>General Settings</small></h2>

 </div>
 <div class="col-xs-12 col-xs-6">
 <div class="setting_con">
 <button class="btn btn-success btn-lg"><i class="fa fa-cog fa-fw"></i>Settings</button>
 </div>
 </div>
 <div class="clearfix"></div>
</div>-->
          <!--<div class="add_usercon">
<p><a href="#">What's this?</a></p>
<button class="btn btn-success"><i class="fa fa-edit"></i> Add User</button>
</div>-->
          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <a href="/individual/add-client" class="btn btn-info">ADD CLIENT</a>
                  </li>
                  <li>
                    <button class="btn btn-success">BULK CSV IMPORT</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
               <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-info">ON-BOARD NEW CLIENT</button>
                  </li>
                  <li>
                    <button class="btn btn-success">CLEAR</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr role="row">
                            <th>S.N.</th>
                            <th><input type="checkbox"/></th>
                            <th>STAFF</th>
                            <th>DOB</th>
                            <th>BUSINESS NAME</th>
                            <th>CLIENT NAME</th>
                            <th>NI NUMBER</th>
                            <th>TAX REFERENCE</th>
                            <th>ACTING</th>
                            <th>RESIDENTIAL ADDRESS</th>
                          
                          </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                          <tr class="odd">
                            <td class=" ">1</td>
                            <td class="sorting_1" align="center"><input type="checkbox"/></td>
                            <td class=" "></td>
                            <td class=" ">30-04-2008</td>
                            <td class=" "></td>
                            <td class=" ">2207 LTD.</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class=" ">Yes</td>
                            <td class=" ">&nbsp;</td>
                          </tr>
                          <tr class="even">
                           <td class=" ">2</td>
                            <td class="sorting_1" align="center"><input type="checkbox"/></td>
                            <td class=" "></td>
                            <td class=" ">30-04-2008</td>
                            <td class=" "></td>
                            <td class=" ">2207 LTD.</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class=" ">Yes</td>
                            <td class=" ">&nbsp;</td>
                          </tr>
                          <tr class="odd">
                            <td class=" ">3</td>
                            <td class="sorting_1" align="center"><input type="checkbox"/></td>
                            <td class=" "></td>
                            <td class=" ">30-04-2008</td>
                            <td class=" "></td>
                            <td class=" ">2207 LTD.</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class=" ">Yes</td>
                            <td class=" ">&nbsp;</td>
                          </tr>
                          <tr class="even">
                            <td class=" ">4</td>
                            <td class="sorting_1" align="center"><input type="checkbox"/></td>
                            <td class=" "></td>
                            <td class=" ">30-04-2008</td>
                            <td class=" "></td>
                            <td class=" ">2207 LTD.</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class=" ">Yes</td>
                            <td class=" ">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
                      
                      
          </div>
        </form>
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
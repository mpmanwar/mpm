@extends('layouts.layout')

@section('mycssfile')

@stop

@section('myjsfile')

@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('layouts/inner_leftside')

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADD CLIENT
                        <!-- <small>CLIENT NAME  Limited</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add Clients</li>
                    </ol>
                </section>

    <!-- Main content -->
    {{ Form::open(array('url' => '/organisation/insert-client-details', 'files' => true)) }}
    <section class="content">
      <div class="row">
        <div class="top_bts">
          <ul>
            <li>
              <button class="btn btn-info">IMPORT FROM CH</button>
            </li>
            <li>
              <button class="btn btn-success">IMPORT FROM CSV</button>
            </li>
            <li>
              <button class="btn btn-primary">REQUEST FROM CLIENT</button>
            </li>
            <li>
              <button class="btn btn-danger">REQUEST FROM OLD ACCOUNTANT</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>
      </div>
      <div class="practice_mid">
        
          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-info">PERMANENT DATA</button>
                  </li>
                  <li>
                    <button class="btn btn-success">MANAGE ECSL</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
                <table width="100%" border="0">
                  <tr>
                    <td>COUNT DOWN - DAYS</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">STEP 1 <br>
                  <span>Business : Information</span></a></li>
                <li><a data-toggle="tab" href="#tab_2">STEP 2<br>
                  <span>Tax information</span></a></li>
                <li><a data-toggle="tab" href="#tab_3">STEP 3<br>
                  <span>Contact Information</span></a></li>
                <li><a data-toggle="tab" href="#tab_4">STEP 4<br>
                  <span>Relationship</span></a></li>
                <li><a data-toggle="tab" href="#tab_5">STEP 5<br>
                  <span>OTHERS</span></a></li>
                <!--<li class="pull-right"><a class="text-muted" href="#"><i class="fa fa-gear"></i></a></li>-->
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
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Type</label>
                              <select class="form-control">
                                <option>Partnership</option>
                                <option>Sole Tradership</option>
                                <option>Company</option>
                                <option>LLP</option>
                                <option>Incorporation Charity</option>
                                <option>Unincorporation Charity</option>
                                <option>Other</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Name</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Client Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Incorporation Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Registration Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Registered In</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Annual Returns</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Annual Returns</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Annual Returns</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Made up Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Next Return Due</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Ch Authentication Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Year End Accounts</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Accounting Ref Date</label>
                                  <select class="form-control">
                                    <option>10/05/2014</option>
                                    <option>01/20/2015</option>
                                    <option>20/10/2016</option>
                                    <option>05/05/2017</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Year of first Finalcial Year End</label>
                                  <select class="form-control">
                                    <option>Jan</option>
                                    <option>Feb</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                  </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Last Account Made of Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Next Account Due</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <h3 class="box-title">Statement of Capital Summary</h3>
                            <table class="table table-bordered table-hover dataTable">
                              <tr>
                                <td>Total issued :</td>
                                <td>7064254</td>
                              </tr>
                              <tr>
                                <td>Currency :</td>
                                <td>GBP</td>
                              </tr>
                              <tr>
                                <td>Total Aggregate Value :</td>
                                <td>7</td>
                              </tr>
                            </table>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Description</label>
                              <input type="text" id="" class="form-control">
                            </div>
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
                            <h3 class="box-title">Tax Information</h3>
                            <h3 class="box-title">VAT</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Registered for Vat</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Effective Date of Registration</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Scheme</label>
                                  <select class="form-control">
                                    <option>Partnership</option>
                                    <option>Sole Tradership</option>
                                    <option>Company</option>
                                    <option>LLP</option>
                                    <option>Incorporation Charity</option>
                                    <option>Unincorporation Charity</option>
                                    <option>Other</option>
                                  </select>
                                </div>
                              </div>
                              <div class="add_client_chk">
                                <div class="add_ch1">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Cash</label>
                                    <input type="checkbox"/>
                                  </div>
                                </div>
                                <div class="add_ch2">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Accrual</label>
                                    <input type="checkbox"/>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Return Frequency</label>
                                  <select class="form-control">
                                    <option>Quarterly</option>
                                    <option>Monthly</option>
                                    <option>Yearly</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Stagger</label>
                                  <select class="form-control">
                                    <option>Choose One</option>
                                    <option>Jan-April-Jul-Oct</option>
                                    <option>Feb-May-Aug-Nov</option>
                                    <option>Mar-Jun-Sept-Dec</option>
                                  </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">EC Sales Lis</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax Reference</label>
                            </div>
                            <div class="form-group">
                              <div class="accural_chk">
                                <label for="exampleInputPassword1">Corporate Tax</label>
                                <input type="checkbox" >
                              </div>
                              <div class="accural_chk">
                                <label for="exampleInputPassword1">Income Tax</label>
                                <input type="checkbox" >
                              </div>
                              <div class="accural_chk">
                                <label for="exampleInputPassword1">None</label>
                                <input type="checkbox" >
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax Reference(UTR)</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Quaryerly Corporation Tax Payments</label>
                              <input type="checkbox" >
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tax District</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postal Address</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Post Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tel</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Paye Registered</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">CIS Registered</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Account Office Ref</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Paye Reference</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Paye District</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Employer Office</label>
                                  <input type="text" id="" class="form-control">
                                  <!--<input type="text" id="" class="form-control">
<input type="text" id="" class="form-control">
<input type="text" id="" class="form-control">-->
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Post Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tel</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <!--<div class="form-group">
<label for="exampleInputPassword1">Employer Office</label>
<input type="text" id="" class="form-control">
<input type="text" id="" class="form-control">
<input type="text" id="" class="form-control">
<input type="text" id="" class="form-control">
</div>-->
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <h3 class="box-title">Statement of Capital Summary</h3>
                            <table class="table table-bordered table-hover dataTable">
                              <tr>
                                <td>Total issued :</td>
                                <td>7064254</td>
                              </tr>
                              <tr>
                                <td>Currency :</td>
                                <td>GBP</td>
                              </tr>
                              <tr>
                                <td>Total Aggregate Value :</td>
                                <td>7</td>
                              </tr>
                            </table>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Description</label>
                              <input type="text" id="" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div>-->
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
                            <h3 class="box-title">Contact Information</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Registered Office Address</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address Type</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Name</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address Line1</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address Line2</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">City/Town</label>
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
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postcode</label>
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
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Trading Address</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Correspondence Address</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Banker</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Trading Address</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Old Accountants</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Auditors</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Solicitors</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Others</label>
                                  <input type="checkbox"/>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Notes</label>
                              <input type="checkbox"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6"> </div>
                      </div>
                      <!--<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div>-->
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
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <div class="director_table">
                              <h3 class="box-title">RELATIONSHIP</h3>
                              <h2>Directors</h2>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Select From Store</label>
                                <input type="checkbox"/>
                              </div>
                              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                <div class="row">
                                  <div class="col-xs-6"></div>
                                  <div class="col-xs-6"></div>
                                </div>
                                <table width="100%" class="table table-bordered table-hover dataTable">
                                  <tr>
                                    <td>Name</td>
                                    <td colspan="3" align="center">Action</td>
                                  </tr>
                                  <tr>
                                    <td>Mr. Sagi Shorrer</td>
                                    <td align="center"><a href="#">View</a></td>
                                    <td align="center"><a href="#">Edit</a></td>
                                    <td align="center"><a href="#">Resign</a></td>
                                  </tr>
                                  <tr>
                                    <td>Mr. Shukri Shammas</td>
                                    <td align="center"><a href="#">View</a></td>
                                    <td align="center"><a href="#">Edit</a></td>
                                    <td align="center"><a href="#">Resign</a></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="director_table">
                              <h2>Secretaries</h2>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Select From Store</label>
                                <input type="checkbox"/>
                              </div>
                              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                <div class="row">
                                  <div class="col-xs-6"></div>
                                  <div class="col-xs-6"></div>
                                </div>
                                <table width="100%" class="table table-bordered table-hover dataTable">
                                  <tr>
                                    <td>Name</td>
                                    <td colspan="3" align="center">Action</td>
                                  </tr>
                                  <tr>
                                    <td>Mr. Sagi Shorrer</td>
                                    <td align="center"><a href="#">View</a></td>
                                    <td align="center"><a href="#">Edit</a></td>
                                    <td align="center"><a href="#">Resign</a></td>
                                  </tr>
                                  <tr>
                                    <td>Mr. Shukri Shammas</td>
                                    <td align="center"><a href="#">View</a></td>
                                    <td align="center"><a href="#">Edit</a></td>
                                    <td align="center"><a href="#">Resign</a></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="director_table">
                              <h2>Shareholders</h2>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Select From Store</label>
                                <input type="checkbox"/>
                              </div>
                              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                <div class="row">
                                  <div class="col-xs-6"></div>
                                  <div class="col-xs-6"></div>
                                </div>
                                <table width="100%" class="table table-bordered table-hover dataTable">
                                  <tr>
                                    <th>Name</th>
                                    <th>Share Type</th>
                                    <th>Balance</th>
                                    <th>Shareholder Since</th>
                                    <th>Residential Address</th>
                                  </tr>
                                  <tr>
                                    <td>Paul Kaliszewski</td>
                                    <td>Ordinary</td>
                                    <td>452822</td>
                                    <td>&nbsp;</td>
                                    <td align="center">United Kingdom</td>
                                  </tr>
                                  <tr>
                                    <td>Patrick Kampfner</td>
                                    <td>Ordinary</td>
                                    <td>25078</td>
                                    <td>&nbsp;</td>
                                    <td align="center">United Kingdom</td>
                                  </tr>
                                  <tr>
                                    <td>Roman Lentz</td>
                                    <td>Ordinary</td>
                                    <td>201542</td>
                                    <td>&nbsp;</td>
                                    <td align="center">United Kingdom</td>
                                  </tr>
                                  <tr>
                                    <td>Roman Lentz</td>
                                    <td>Ordinary</td>
                                    <td>201542</td>
                                    <td>&nbsp;</td>
                                    <td align="center">United Kingdom</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Proprietor</label>
                                <input type="checkbox"/>
                                <button class="btn btn-info"><i class="fa fa-plus"></i>ADD</button>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Partners</label>
                                <input type="checkbox"/>
                                <button class="btn btn-info"><i class="fa fa-plus"></i>ADD</button>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Proprietor</label>
                                <input type="checkbox"/>
                                <button class="btn btn-info"><i class="fa fa-plus"></i>ADD</button>
                              </div>
                              <div class="col_m2">
                                <h3 class="box-title">Share Capital <small>Return of Allotment of Share</small></h3>
                                <table class="table table-bordered table-hover dataTable">
                                  <tr>
                                    <td>Total issued :</td>
                                    <td>7064254</td>
                                  </tr>
                                  <tr>
                                    <td>Currency :</td>
                                    <td>GBP</td>
                                  </tr>
                                  <tr>
                                    <td>Total Aggregate Value :</td>
                                    <td>7</td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <h3 class="box-title">Personal</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax Return Required</label>
                              <input type="checkbox"/>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Relationship Type</label>
                              <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                              </select>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Title</label>
                                  <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">First Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Middle Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Last Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Client Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Sex</label>
                                  <select class="form-control">
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Date of Birth</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Ni Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tax Reference</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Apppointtment Date</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Marital Status</label>
                                  <select class="form-control">
                                    <option>Married</option>
                                    <option>Unmarried</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Spouse Date of Birth</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Service Address</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Change</label>
                              <input type="checkbox">
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Building Name/Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Street</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Address</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Town</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postcode</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Residential Address</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Change</label>
                              <input type="checkbox" >
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Building Name/Number</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Street</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Address</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Town</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postcode</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Other</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Change</label>
                              <input type="checkbox" >
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">AML Checks Done</label>
                              <input type="checkbox" >
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nationality</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Occuption</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country of Residence</label>
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
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Telephone1</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Telephone2</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Fax</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Email</label>
                                  <input type="email" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <h3 class="box-title">Releted Parties</h3>
                            <div class="col-xs-12">
                              <div class="col-xs-12 col-xs-6">
                                <p>AB Limited</p>
                                <p>C Limited</p>
                              </div>
                              <div class="col-xs-12 col-xs-6">
                                <p>Director/Shareholder</p>
                                <p>Secretary</p>
                              </div>
                            </div>
                            <button class="btn btn-primary">SAVE</button>
                          </div>
                        </div>
                      </div>
                      <!--<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div>-->
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
                              <h3 class="box-title">OTHERS</h3>
                              <div class="other_top">
                                <div class="twobox_1">
                                  <h4>Services</h4>
                                </div>
                                <div class="twobox_2">
                                  <h4>Staff</h4>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Audit</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>New</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Bookkeeping</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>New</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Annual Returns</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Statutory Accounts</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Vat Returns</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Management Accounts</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Corporation Tax</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Payroll</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">P11Ds</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Statutory Accounts</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Sole Trade Annual Accounts</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <div class="chk_andbox">
                                <div class="chk_left">
                                  <div class="form-group">
                                    <input type="checkbox" >
                                    <label for="exampleInputPassword1">Sole Trade Annual Accounts</label>
                                  </div>
                                </div>
                                <div class="box_right">
                                  <div class="form-group">
                                    <select class="form-control">
                                      <option>Option1</option>
                                      <option>Option2</option>
                                      <option>Option3</option>
                                      <option>Option4</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          <div class="col_m2">
                            <h3 class="box-title">Bank Details</h3>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Bank Name</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Sort Code</label>
                                  <input type="text" id="" class="form-control">
                                </div>
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
                                  <label for="exampleInputPassword1">Address</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Address Line2</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">City/Town</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postcode</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Country</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Marketing Source</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div></div><div class="col-xs-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div>-->
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
              </div>
            </div>
          </div>
        
      </div>
    </section>

    {{ Form::close() }}

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

@stop
@extends('layouts.layout')

@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/org_clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<script>
$(document).ready(function(){
    $("#incorporation_date").datepicker({minDate: new Date(1900, 12-1, 25)});
    $("#made_up_date").datepicker({minDate: new Date(1900, 12-1, 25)});
    $("#next_ret_due").datepicker({minDate: new Date(1900, 12-1, 25)});
    $("#last_acc_madeup_date").datepicker({minDate: new Date(1900, 12-1, 25)});
    $("#next_acc_due").datepicker({minDate: new Date(1900, 12-1, 25)});
    $("#app_date").datepicker({ minDate: new Date(1900, 12-1, 25) });
    $("#effective_date").datepicker({ minDate: new Date(1900, 12-1, 25) });
    
})
</script>
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
            <!-- <div class="tab_topcon">
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
            </div> -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs nav-tabsbg" id="header_ul">
          <li class="active" id="tab_1"><a class="open_header" data-id="1" href="javascript:void(0)">BUSINESS INFORMATION</a></li>
          <li id="tab_2"><a class="open_header" data-id="2" href="javascript:void(0)">TAX INFORMATION</a></li>
          <li id="tab_3"><a class="open_header" data-id="3" href="javascript:void(0)">CONTACT INFORMATION</a></li>
          <li id="tab_4"><a class="open_header" data-id="4" href="javascript:void(0)">RELATIONSHIP</a></li>
          <li id="tab_5"><a class="open_header" data-id="5" href="javascript:void(0)">OTHERS</a></li>
          <li><a href="#" class="btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i> New Field</a></li>
        </ul>
              <div class="tab-content">
                <div id="step1" class="tab-pane active">
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

                      <div class="twobox">
                        <div class="twobox_1">
                          <div class="small_box">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Client Code</label>
                              <input type="text" id="client_code" name="client_code" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="twobox_2">
                          <div class="form-group">
                            <label for="exampleInputPassword1">Business Type</label>
                              <select class="form-control" name="business_type" id="business_type">
                                @if(!empty($org_types))
                                  @foreach($org_types as $key=>$org_row)
                                  <option value="{{ $org_row->organisation_id }}">{{ $org_row->name }}</option>
                                  @endforeach
                                @endif
                              </select>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>


                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Name</label>
                              <input type="text" id="business_name" name="business_name" class="form-control">
                            </div>

                            <div class="twobox">
                              <div class="threebox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Registration Number</label>
                                  <input type="text" id="registration_number" name="registration_number" class="form-control">
                                </div>
                              </div>
                              <div class="threebox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Incorporation Date</label>
                                  <input type="text" id="incorporation_date" name="incorporation_date" class="form-control">
                                </div>
                              </div>

                              <div class="threebox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Registered In</label>
                                  <input type="text" id="registered_date" name="registered_date" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Business Description</label>
                              <input type="text" id="business_desc" name="business_desc" class="form-control">
                            </div>

                            <h3 class="box-title">Annual Returns</h3>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Annual Returns</label>
                              <input type="checkbox" name="ann_ret_check" id="ann_ret_check" value="1" />
                            </div>

      <div id="show_ann_ret" style="display:none;">
        <div class="twobox">
          <div class="twobox_1">
            <div class="form-group">
              <label for="exampleInputPassword1">Made up Date</label>
              <input type="text" id="made_up_date" name="made_up_date" class="form-control">
            </div>
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Next Return Due</label>
              <input type="text" id="next_ret_due" name="next_ret_due" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
            <div class="form-group">
              <label for="exampleInputPassword1">CH Authentication Code</label>
              <input type="text" id="ch_auth_code" name="ch_auth_code" class="form-control">
            </div>
          </div>
          
          <div class="clearfix"></div>
        </div>

      </div>


        <div class="form-group">
          <label for="exampleInputPassword1">Year End Accounts</label>
          <input type="checkbox" name="yearend_acc_check" id="yearend_acc_check" value="1" />
        </div>

      <div id="show_year_end" style="display:none;">
        <div class="twobox">
          <div class="twobox_1">
            <label for="exampleInputPassword1">Accounting Ref Date</label> 
            <div class="clearfix"></div>
            <div class="accountbox1">
            <div class="form-group">
              <select class="form-control" id="acc_ref_day" name="acc_ref_day">
                @for($i = 1; $i<=31;$i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>

          <div class="accountbox2">
            <div class="form-group">
              <select class="form-control" name="acc_ref_month" id="acc_ref_month">
                <option value="JAN">JAN</option>
                <option value="FEB">FEB</option>
                <option value="MAR">MAR</option>
                <option value="APR">APR</option>
                <option value="MAY">MAY</option>
                <option value="JUN">JUN</option>
                <option value="JUL">JUL</option>
                <option value="AUG">AUG</option>
                <option value="SEPT">SEPT</option>
                <option value="OCT">OCT</option>
                <option value="NOV">NOV</option>
                <option value="DEC">DEC</option>            
                
              </select>
            </div>
          </div>
            <div class="clearfix"></div>
          </div>

           <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Last Account Made Up Date</label>
              <input type="text" id="last_acc_madeup_date" name="last_acc_madeup_date" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
            <div class="form-group">
              <label for="exampleInputPassword1">Next Account Due</label>
              <input type="text" id="next_acc_due" name="next_acc_due" class="form-control">
            </div>
          </div>
          
          <div class="clearfix"></div>
        </div>

      </div>

      <div class="add_client_btn">
          <button class="btn btn-info open" data-id="2" type="button">Next</button>
          <!-- <button class="btn btn-success" type="button">Save</button> -->
          <button class="btn btn-danger back" data-id="1" type="button">Cancel</button>
      </div>
      <div class="clearfix"></div>

    </div>
  </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <!-- /.tab-pane -->
                <div id="step2" class="tab-pane" style="display:none;">
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
                            <div class="form-group">
                              <label for="exampleInputPassword1">Registered for Vat</label>
                              <input type="checkbox" name="reg_for_vat" id="reg_for_vat" value="1" />
                            </div>
                            <div class="registered_vat" id="show_reg_for_vat" style="display:none">
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Effective Date of Registration</label>
                                  <input type="text" id="effective_date" name="effective_date" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Number</label>
                                  <input type="text" id="vat_number" name="vat_number" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Scheme</label>
                                  <select class="form-control" name="vat_scheme" id="vat_scheme">
                                    <option value="1">Standered Vat Accounting Scheme</option>
                                    <option value="2">Annual Accounting</option>
                                    <option value="3">Flat Rate Scheme</option>
                                    <option value="4">Retails Schemes - Point of Sale</option>
                                    <option value="5">Retails Schemes - Apportionment Schemes</option>
                                    <option value="6">Retails Schemes - Direct Calculation Schemes</option>
                                    <option value="7">Retails Schemes - Caterers Catering</option>
                                    <option value="8">Retails Schemes - Chemist(retail pharmacist)</option>
                                    <option value="9">Margin Schemes</option>
                                    <option value="10">Tour operator's Margine Scheme</option>
                                    <option value="11">Others - specify</option>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="add_client_chk">
                                <div class="add_ch1">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Cash</label>
                                    <input type="checkbox" name="vat_scheme_type" id="vat_scheme_type" value="cash" />
                                  </div>
                                </div>
                                <div class="add_ch2">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Accrual</label>
                                    <input type="checkbox" name="vat_scheme_type" id="vat_scheme_type" value="accrual" />
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
                                  <select class="form-control" name="ret_frequency" id="ret_frequency">
                                    <option value="quarterly">Quarterly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Vat Stagger</label>
                                  <select class="form-control" name="vat_stagger" id="vat_stagger">
                                    <option>Choose One</option>
                                    <option value="Jan-April-Jul-Oct">Jan-April-Jul-Oct</option>
                                    <option value="Feb-May-Aug-Nov">Feb-May-Aug-Nov</option>
                                    <option value="Mar-Jun-Sept-Dec">Mar-Jun-Sept-Dec</option>
                                  </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">EC Sales List</label>
                              <input type="checkbox" name="ec_scale_list" id="ec_scale_list"/>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax</label>
                               <input type="checkbox" id="tax_div" name="tax_div" value="1" >
                            </div>
                          
                          <div id="show_tax_div" style="display:none;"> 
                            <div class="tax_utr_con">
                            <div class="tax_utr">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tax Reference(UTR)</label>
                              <input type="text" id="tax_reference" name="tax_reference" class="form-control">
                            </div>
                            </div>
                            
                            <div class="tax_utr_drop">
                            <div class="form-group">
                              <label for="exampleInputPassword1"></label>
                              <select class="form-control" name="tax_reference_type" id="tax_reference_type">
                                <option value="none">None</option>
                                <option value="Income Tax">Income Tax</option>
                                <option value="Corporation Tax">Corporation Tax</option>
                              </select>
                            </div>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                                                       
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tax District</label>
                                   <select class="form-control" name="tax_district" id="tax_district">
                                    <option value="Liverpool">Liverpool</option>
                                    <option value="Newcastle Upon Tyne">Newcastle Upon Tyne</option>
                                    <option value="Cardiff">Cardiff</option>
                                  </select>
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Postal Address</label>
                                  <input type="text" id="postal_address" name="postal_address" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Post Code</label>
                                  <input type="text" id="post_code" name="post_code" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tel</label>
                                  <input type="text" id="telephone" name="telephone" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                        </div>
                            
                            <div class="form-group">
                                  <label for="exampleInputPassword1">Paye Registered</label>
                                  <input type="checkbox" id="paye_reg" name="paye_reg" value="1" />
                                </div>
                        
                        <div id="show_paye_reg" style="display:none;">    
                            <div class="form-group">
                              <label for="exampleInputPassword1">CIS Registered</label>
                              <input type="checkbox" name="cis_registered" name="cis_registered" />
                            </div>
                            
                            
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Account Office Ref</label>
                                  <input type="text" id="acc_office_ref" name="acc_office_ref" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Paye Reference</label>
                                  <input type="text" id="paye_reference" name="paye_reference" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Paye District</label>
                                  <input type="text" id="paye_district" name="paye_district" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Employer Office</label>
                                  <input type="text" id="employer_office" name="employer_office" class="form-control">
                                 
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Post Code</label>
                                  <input type="text" id="employer_postcode" name="employer_postcode" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Tel</label>
                                  <input type="text" id="employer_telephone" name="employer_telephone" class="form-control">
                                </div>
                              </div>

                        </div>
                              <div class="clearfix"></div>
                            </div>
                            
<div class="add_client_btn">
  <button class="btn btn-info open"data-id="3" type="button">Next</button>
  <!-- <button class="btn btn-success" type="button">Save</button> -->
  <button class="btn btn-danger back"data-id="1" type="button">Cancel</button>
</div>
                             <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div id="step3" class="tab-pane" style="display:none;">
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
                              <input type="checkbox" name="reg_office_addr" id="reg_office_addr" />
                            </div>
                            <div class="address_type" id="show_reg_office_addr">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address Type</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Name</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            </div>
                             <div class="form-group">
                              <label for="exampleInputPassword1">Select or Add</label>
                               <select class="form-control">
                                    <option>Choose One</option>
                                    <option>Choose Two</option>
                                    
                                  </select>
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
                                  <label for="exampleInputPassword1">County</label>
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
                            
                            <div class="form-group">
                                  <label for="exampleInputPassword1">Trading Address</label>
                                  <input type="checkbox"/>
                                </div>
                            
                            <div class="form-group">
                                  <label for="exampleInputPassword1">Correspondence Address</label>
                                  <input type="checkbox"/>
                                </div>
                            
                             <div class="form-group">
                                  <label for="exampleInputPassword1">Banker</label>
                                  <input type="checkbox"/>
                                </div>
                            
                             <div class="form-group">
                                  <label for="exampleInputPassword1">Trading Address</label>
                                  <input type="checkbox"/>
                                </div>
                                
                                 <div class="form-group">
                                  <label for="exampleInputPassword1">Old Accountants</label>
                                  <input type="checkbox"/>
                                </div>
                                
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Auditors</label>
                                  <input type="checkbox"/>
                                </div>
                            
                            <div class="form-group">
                                  <label for="exampleInputPassword1">Solicitors</label>
                                  <input type="checkbox"/>
                                </div>
                            
                            <div class="form-group">
                                  <label for="exampleInputPassword1">Others</label>
                                  <input type="checkbox"/>
                                </div>
                            
                            
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Notes</label>
                             <textarea rows="3" class="form-control"></textarea>
                            </div>
<div class="add_client_btn">
<button class="btn btn-info open" data-id="4" type="button">Next</button>
<!-- <button class="btn btn-success" type="button">Save</button> -->
<button class="btn btn-danger back" data-id="2" type="button">Cancel</button>
</div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6"> </div>
                      </div>
                      
                    </div>
                  </div>
                </div>

                <div id="step4" class="tab-pane" style="display:none;">
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
  <a href="javascript:void(0)" class="btn btn-info" onClick="show_div()"><i class="fa fa-plus"></i> New</a>
</div>

<div class="box-body table-responsive">
<div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
<table width="100%" class="table table-bordered table-hover dataTable" id="myRelTable">
  <tr>
    <td width="25%"><strong>Name</strong></td>
    <td width="30%" align="center"><strong>Appointment Date</strong></td>
    <td width="30%" align="center"><strong>Relationship Type</strong></td>
    <td width="15%" align="center"><strong>Action</strong></td>
    
  </tr>

  </table>

  <div class="contain_tab4" id="new_relationship" style="display:none;">
    <div class="contain_search">
      <input type="text" placeholder="Search..." class="form-control" id="relname" name="relname">
    </div>

    <div class="contain_date"><input type="text" id="app_date" name="app_date" class="form-control"></div>

    <div class="contain_type">
      <select class="form-control" name="reltype" id="reltype">
          @if(!empty($rel_types))
            @foreach($rel_types as $key=>$rel_row)
            <option value="{{ $rel_row->relation_type_id }}">{{ $rel_row->relation_type }}</option>
            @endforeach
          @endif
        </select>
    </div>
    
    <div class="contain_action"><button class="btn btn-success" onClick="saveRelationship()" type="button">Save</button></div>
  </div>
    


</div>
</div>

<div class="add_client_btn">
<button class="btn btn-info open" data-id="5" type="button">Next</button>
<!-- <button class="btn btn-success" type="button">Save</button> -->
<button class="btn btn-danger back" data-id="3" type="button">Cancel</button>
</div>
<div class="clearfix"></div>
</div>
</div>
                   
                   
                   </div>
                   

                  
                    </div>
                      
                    </div>
                  </div>
                </div>

                <div id="step5" class="tab-pane" style="display:none;">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-xs-6">
                          
                          <div class="col_m2">
                            <h3 class="box-title">Others</h3>
                            <h4 class="box-title">Bank Details</h4>
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
                                  <label for="exampleInputPassword1">Marketing Source</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="director_table">
                              <h3 class="box-title">Services</h3>
                              <div class="form-group">
                                <a href="javascript:void(0)" class="btn btn-info" onClick="show_org_other_div()"><i class="fa fa-plus"></i> New</a>
                              </div>
                              <div class="box-body table-responsive">
                                <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                  <div class="row">
                                    <div class="col-xs-6"></div>
                                    <div class="col-xs-6"></div>
                                  </div>
                                  <table width="100%" class="table table-bordered table-hover dataTable" id="myServTable">
                                    <tr>
                                      <td><strong>Service</strong></td>
                                      <td align="center"><strong>Staff</strong></td>
                                      <td align="center"><strong>Action</strong></td>
                                    </tr>
                                    <!-- <tr>
                                      <td>
                                      <select class="form-control">
                                          <option>Add New</option>
                                          <option>Audit</option>
                                          <option>Bookkeeping</option>
                                          <option>Annual Returns</option>
                                          <option>Statutory Accounts</option>
                                          <option>Vat Returns</option>
                                          <option>Management Accounts</option>
                                          <option>Corporation Tax</option>
                                          <option>Payroll</option>
                                          <option>P11Ds</option>
                                          <option>Sole Trade Annual Accounts</option>
                                        </select>
                                      </td>
                                      <td align="center">
                                      <select class="form-control">
                                          <option>Option1</option>
                                          <option>Option2</option>
                                          </select></td>
                                      <td align="center"><button class="btn btn-success">Save</button></td>
                                    </tr> -->
                                    
                                  </table>



<div class="contain_tab4" id="add_services_div" style="display:none;">
    <div class="services_search">
      <select class="form-control" name="services" id="services">
        <option>Add New</option>
        <option value="Audit">Audit</option>
        <option value="Bookkeeping">Bookkeeping</option>
        <option value="Annual Returns">Annual Returns</option>
        <option value="Statutory Accounts">Statutory Accounts</option>
        <option value="Vat Returns">Vat Returns</option>
        <option value="Management Accounts">Management Accounts</option>
        <option value="Corporation Tax">Corporation Tax</option>
        <option value="Payroll">Payroll</option>
        <option value="P11Ds">P11Ds</option>
        <option value="Sole Trade Annual Accounts">Sole Trade Annual Accounts</option>
      </select>
    </div>

    <div class="contain_type">
      <select class="form-control" name="staff" id="staff">
        <option value="Staff 1">Staff 1</option>
        <option value="Staff 2">Staff 2</option>
      </select>
      
    </div>
    
    <div class="contain_action"><button class="btn btn-success" onClick="saveServices()" type="button">Save</button></div>
  </div>



                                </div>
                              </div>
<div class="add_client_btn">
<!-- <button class="btn btn-info">Next</button> -->
<button class="btn btn-success save" type="submit">Save</button>
<button class="btn btn-danger back" data-id="4" type="button">Cancel</button>
</div>
                              <div class="clearfix"></div>
                            </div>
                            
                          </div>
                        </div>
                        <div class="col-xs-12 col-xs-6">
                          
                        </div>
                      </div>
                      
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


<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FILED</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/individual/save-userdefined-field', 'id'=>'field_form')) }}
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputPassword1">Select Section</label>
          <select class="form-control" name="step_id" id="step_id">
            @if(!empty($steps))
              @foreach($steps as $key=>$step_row)
                @if(!empty($step_row->step_id) && $step_row->step_id != '4')
                  <option value="{{ $step_row->step_id }}">{{ $step_row->title }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Name</label>
          <input type="text" id="field_name" name="field_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Type</label>
          <select class="form-control" name="field_type" id="field_type">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="checkbox">Checkbox</option>
            <option value="date">Date</option>
            <option value="dropdown">Dropdown</option>
          </select>
        </div>
        
        <div class="modal-footer clearfix">
          <div class="email_btns">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary pull-left save_t" name="save">Save</button>
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@stop
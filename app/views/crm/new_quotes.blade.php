@extends('layouts.layout')

@section('mycssfile')

    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    
@stop

@section('myjsfile')
 <script src="{{ URL :: asset('js/quotes.js') }}" type="text/javascript"></script> 
<!-- <script src="{{ URL :: asset('js/onboard.js') }}" type="text/javascript"></script> -->
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- Time picker script -->
<script src="{{ URL :: asset('js/timepicki.js') }}"></script>
<!-- Time picker script -->




<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="{{ URL :: asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>

<!-- Date picker script -->
<script src="{{ URL :: asset('js/jquery-ui.min.js') }}"></script>


<!-- Date picker script -->
<script src="{{ URL :: asset('tinymce/tinymce.min.js') }}"></script>
<!-- page script -->
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
});
</script>
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        @include('layouts.outer_leftside')
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side  {{ $right_class }}">
                <!-- Content Header (Page header) -->
                @include('layouts.below_header')

                <!-- Main content -->
                <section class="content">
                
                <section class="content">
      <div class="practice_mid">
        <div class="top_buttons">
          <div class="top_bts">
            <ul style="padding:0;">
              <li> <a href="#"><img src="img/download_latter.png" /></a> </li>
              <li>
                <button class="btn btn-warning">Preview</button>
              </li>
            </ul>
          </div>
          <div class="right_side">
            <button class="btn btn-primary">SEND</button>
          </div>
          <div class="clearfix"></div>
        </div>
        <form>
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li id="gentab1" class="active"><a data-toggle="tab"  href="#tab_1">GENERAL</a></li>
                <li id="cwtab2" class=""><a data-toggle="tab"  href="#tab_2">CLIENT WELCOME</a></li>
                <li id="rltab2" class=""><a data-toggle="tab"  href="#tab_2">RENEWAL LETTER</a></li>
                <li id="covertab3" ><a data-toggle="tab"  href="#tab_3">QUOTE COVER LETTER</a></li>
                <li id="tabletab4" ><a data-toggle="tab"  href="#tab_4">QUOTE TABLE</a></li>
                <li id="eltab5" ><a data-toggle="tab"  href="#tab_5">ENGEMENT LETTER</a></li>
                <li id="tctab6" ><a data-toggle="tab"  href="#tab_6">T&Cs</a></li>
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
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="8%">Select Client</td>
                                    <td width="49%"><select class="form-control">
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                      </select></td>
                                    <td width="11%">&nbsp;</td>
                                    <td width="9%">Contact person</td>
                                    <td width="23%"><select class="form-control">
                                        <option></option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                        <option>BLACK COMMERCIAL LIMITED</option>
                                      </select></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="9%"><strong>Pick Elements</strong></td>
                                    <td width="4%">&nbsp;</td>
                                    <td width="3%"><input type="radio" name="pickelements" id="none" value="None" checked="checked"></td>
                                    <td width="4%"><strong>None</strong></td>
                                    <td width="4%">&nbsp;</td>
                                    <td width="3%"><input type="radio" name="pickelements" id="ncwl" value="NEW CLIENT WELCOME LETTER"></td>
                                    <td width="23%"><button class="btn btn-info">NEW CLIENT WELCOME LETTER</button></td>
                                    <td width="2%"><input type="radio" name="pickelements" id="rl" value="RENEWAL LETTER"></td>
                                    <td width="48%"><button class="btn btn-warning">RENEWAL LETTER</button></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top" align="center"><table width="70%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><input type="checkbox" name="qcl" id="qcl" value="qcl"></td>
                                    <td><button class="btn btn-danger">Quote cover letter</button></td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="qtnqs" id="qtnqs" value="qtnqs"></td>
                                    <td><button class="btn btn-danger">Quote Table Notes & Optional services</button></td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="el" id="el" value="el"></td>
                                    <td><button class="btn btn-primary">Engagement Letter</button></td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="tc" id="tc" value="tc"></td>
                                    <td><button class="btn btn-primary">T&C</button></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><strong>Attachments</strong> <span class="btn btn-default btn-file"> Browse
                                <input type="file">
                                </span></td>
                            </tr>
                          </table>
                          <div class="add_client_btn">
                            <button class="btn btn-danger">Save</button>
                            <button class="btn btn-info">Next</button>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <!-- /.tab-pane -->
                <div id="tab_2" class="tab-pane">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="top_buttons">
                            <div class="form-group email_top_left">
                              <label for="exampleInputPassword1">Message Subject</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group select_template">
                              <label for="exampleInputPassword1">Select Template <a href="#">Add</a></label>
                              <select class="form-control">
                                <option></option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                              </select>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea</textarea>
                          <div class="add_client_btn">
                            <button class="btn btn-info">Prev</button>
                            <button class="btn btn-danger">Save</button>
                            <button class="btn btn-info">Next</button>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <div id="tab_3" class="tab-pane">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="top_buttons">
                            <div class="form-group email_top_left">
                              <label for="exampleInputPassword1">Message Subject</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group select_template">
                              <label for="exampleInputPassword1">Select Template <a href="#">Add</a></label>
                              <select class="form-control">
                                <option></option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                              </select>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea</textarea>
                          <div class="add_client_btn">
                            <button class="btn btn-info">Prev</button>
                            <button class="btn btn-danger">Save</button>
                            <button class="btn btn-info">Next</button>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <div id="tab_4" class="tab-pane">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="11%"><strong>Quote Type</strong></td>
                              <td width="2%"><input type="radio" name="quotetype" class="quotetype" id="ltemisedservices" value="Ltemised Services" checked="checked"></td>
                              <td width="17%">Ltemised Services <a href="javascript:void(0)" class="lead_status-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></td>
                              <td width="2%"><input type="radio" name="quotetype" class="quotetype"  id="menupricing" value="Menu/Packaged pricing"></td>
                              <td width="17%">Menu/Packaged pricing <a href="javascript:void(0)" class="lead_status-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></td>
                              <td width="2%"><input type="radio" name="quotetype" class="quotetype"  id="tailoredquote" value="Tailored quote"></td>
                              <td width="11%">Tailored quote</td>
                              <td width="2%"><input type="radio" name="quotetype" class="quotetype"  id="importfrommexcel" value="Import fromm Excel"></td>
                              <td width="14%">Import fromm Excel</td>
                              <td width="2%"><input type="radio" name="" class="quotetype"  id="" value=""></td>
                              <td width="20%">Select sample quote</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>
                              
                              <select class="form-control">
                                  <option>Option1</option>
                                  <option>Option2</option>
                                  <option>Option3</option>
                                 
                                </select>
                             <!--
                              <input type="checkbox" name="" id="" value="">
                                Option1 -->
                                
                                
                                
                                
                                </td>
                              <td>&nbsp;</td>
                              <td>
                              
                              <select class="form-control">
                                  <option>Option1</option>
                                  <option>Option2</option>
                                  <option>Option3</option>
                                 
                                </select>
                                <!--
                              <input type="checkbox" name="" id="" value="">
                                Option1
                                -->
                                
                                </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><span class="btn btn-default btn-file m_top"> Browse
                                <input type="file">
                                </span></td>
                              <td>&nbsp;</td>
                              <td><input type="radio" name="" id="" value="">
                                Menu/Packaged pricing</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="radio" name="" id="" value="">
                                Ltemised Services</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><div class="m_top"><select class="form-control">
                                  <option>BLACK COMMERCIAL</option>
                                  <option>BLACK COMMERCIAL</option>
                                </select></div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td valign="top">
                              &nbsp;
                              <!--
                              Or Import <span class="btn btn-default btn-file"> Browse
                                <input type="file">
                                </span>
                                -->
                                
                                </td> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                          <div class="ltemised_services">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="12%">Date of first Invoice</td>
                                <td width="13%"><input type="text" id="" class="form-control"></td>
                                <td width="12%">&nbsp;</td>
                                <td width="9%">Quote validity</td>
                              
                                <td width="3%"><input type="text" name="quotevalidity" id="quotevalidity" style="width:34px;" value=""></td>
                               
                                <td width="10%">Days</td>
                                <td width="1%">&nbsp;</td>
                                <td width="13%">&nbsp;</td>
                                <td width="9%">&nbsp;</td>
                                <td width="4%">Fees</td>
                                <td width="14%"><input type="text" id="" class="form-control"></td>
                              </tr>
                            </table>
                            <div class="first_item" id="firsttable">
                            
                            
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="white_table table-bordered">
                                      <tr>
                                        <th width="2%" align="center">&nbsp;</th>
                                        <th width="10%" align="center">Item <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                                        <th width="15%" align="center">Description</th>
                                        <th width="7%" align="center">Qty</th>
                                        <th width="9%" align="center">Unit Price</th>
                                        <th width="5%" align="center">Disc%</th>
                                        <th width="11%" align="center">Tax Rate <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                                        <th width="10%" align="center">Per Year</th>
                                        <th width="15%" align="center">Per Month</th>
                                        <th width="12%" align="center">Flex fees</th>
                                        <th width="4%" align="center">&nbsp;</th>
                                      </tr>
                                      <tr>
                                       <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                      <tr>
                                        <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                      <tr>
                                      <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                       <tr>
                                       <td align="center"><img src="img/dotted_icon.png"></td>
                                       <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="2%">&nbsp;</td>
                                        <td width="6%"><button class="addnew_line" style="width:70px; margin-bottom: 0; height: 29px;"><i class="add_icon_img" style="padding-right: 5px;"><img src="img/add_icon.png"></i>
                                          <p class="add_line_t">Add</p>
                                          </button></td>
                                        <td width="15%" align="center">&nbsp;</td>
                                        <td width="7%">&nbsp;</td>
                                        <td width="9%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="15%" align="center" class="bottom_border">Sub Total</td>
                                        <td width="10%" align="center" class="bottom_border">0.00</td>
                                        <td width="15%" align="center" class="bottom_border">0.00</td>
                                        <td width="12%">&nbsp;</td>
                                        <td width="4%">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="center"><strong>GBP</strong></td>
                                        <td align="center" class="bottom_border1"><strong class="total_t">TOTAL</strong></td>
                                        <td align="center" class="bottom_border1"><strong class="total_t">0.00</strong></td>
                                        <td align="center" class="bottom_border1"><strong class="total_t">0.00</strong></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              
                            </div>
                            <div class="">
                                  <input type="checkbox" id="" class="form-control">
                                  <label for="exampleInputPassword1">One - Off Fees</label>
                                </div>
                            <div class="first_item" id="secondtable">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="white_table table-bordered">
                                      <tr>
                                        <th width="2%">&nbsp;</th>
                                        <th width="10%" align="center">Item <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                                        <th width="26%" align="center">Description</th>
                                        <th width="10%" align="center">Qty</th>
                                        <th width="10%" align="center">Unit Price</th>
                                        <th width="10%" align="center">Disc%</th>
                                        <th width="10%" align="center">Tax Rate <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                                        <th width="10%" align="center">Amount GBP</th>
                                        
                                        <th width="10%" align="center">Flex fees</th>
                                        <th width="4%" align="center">&nbsp;</th>
                                      </tr>
                                      <tr>
                                        <td align="center"><img src="img/dotted_icon.png" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                      <tr>
                                      <td align="center"><img src="img/dotted_icon.png" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                      <tr>
                                      <td align="center"><img src="img/dotted_icon.png" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                       <tr>
                                       <td align="center"><img src="img/dotted_icon.png" /></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg">&nbsp;</td>
                                        <td class="td_bg" align="center"><a href="#"><img src="img/cross_icon.png"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="6%"><button class="addnew_line" style="width:70px; margin-bottom: 0; height: 29px; margin-left:5px;"><i class="add_icon_img" style="padding-right: 5px;"><img src="img/add_icon.png"></i>
                                          <p class="add_line_t">Add</p>
                                          </button></td>
                                        <td width="30%" align="center">&nbsp;</td>
                                        <td width="10%">&nbsp;</td>
                                        <td width="10%">&nbsp;</td>
                                        <td width="10%">&nbsp;</td>
                                        <td width="10%" align="center" class="bottom_border">Sub Total</td>
                                        <td width="10%" align="center" class="bottom_border">0.00</td>
                                        <td width="10%" align="center"></td>
                                        <td width="4%">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        
                                        
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center" class="bottom_border1"><strong class="total_t">TOTAL</strong></td>
                                        <td align="center" class="bottom_border1"><strong class="total_t">0.00</strong></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        
                                        
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                            </div>
                           
                            <div class="col-xs-12" style="padding:0; margin-bottom:15px;"id="thirdtable">
                              <div class="top_buttons" >
                                <div class="form-group email_top_left">
                                  <input type="checkbox" id="" class="form-control">
                                  <label for="exampleInputPassword1">Notes</label>
                                </div>
                                <div class="form-group select_template">
                                  <label for="exampleInputPassword1">Select Template <a href="#">Add</a></label>
                                  <select class="form-control">
                                    <option></option>
                                    <option>Sfrewfgrewf</option>
                                    <option>Sfrewfgrewf</option>
                                    <option>Sfrewfgrewf</option>
                                  </select>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea </textarea>
                              
                            </div>
                            <div class="second_item" id="forthtable">
                              <p>
                                <input type="checkbox" name="" id="" value="">
                                Optional Services</p>
                              <div class="first_item" id="">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="white_table table-bordered">
                                      <tr>
                                        <th align="center" width="2%" >&nbsp;</th>
                                        <th width="10%" align="center" >Item</th>
                                        <th width="88%" align="left" style="text-align:left;">Description</th>
                                      </tr>
                                      <tr>
                                       
                                        <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        
                                      </tr>
                                      <tr>
                                        
                                       <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        
                                      </tr>
                                      <tr>
                                        <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        
                                      </tr>
                                       <tr>
                                        <td align="center"><img src="img/dotted_icon.png"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td valign="top">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="10%"><button class="addnew_line" style="width:70px; margin-bottom: 0; height: 29px; margin-left:5px;"><i class="add_icon_img" style="padding-right: 5px;"><img src="img/add_icon.png"></i>
                                          <p class="add_line_t">Add</p>
                                          </button></td>
                                        <td width="90%" align="center">&nbsp;</td>
                                        
                                      </tr>
                                      <tr>
                                        
                                        
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                       
                                      </tr>
                               <!--       <tr>
                                        
                                        
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                       
                                      </tr> -->
                                    </table></td>
                                </tr>
                              </table>
                            </div>
                            <div class="add_client_btn">
                                <button class="btn btn-info">Prev</button>
                                <button class="btn btn-danger">Save</button>
                                <button class="btn btn-info">Next</button>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <div id="tab_5" class="tab-pane">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="engement_table">
                            <tr>
                              <td width="16%">Letter Date</td>
                              <td width="15%"><input type="text" id="" class="form-control"></td>
                              <td width="28%" align="right">Limitation of Liability </td>
                              <td width="15%"><input type="text" id="" class="form-control"></td>
                              <td width="25%" align="right"><button class="btn btn-default">Add a Placeholder</button></td>
                            </tr>
                            <tr>
                              <td>Main Staff Contact</td>
                              <td><select class="form-control">
                                  <option>BLACK COMMERCIAL</option>
                                  <option>BLACK COMMERCIAL</option>
                                </select></td>
                              <td align="right">Staff Member responsible for ongoing work</td>
                              <td><select class="form-control">
                                  <option>BLACK COMMERCIAL</option>
                                  <option>BLACK COMMERCIAL</option>
                                </select></td>
                              <td><input type="checkbox" />
                                Group of Companies</td>
                            </tr>
                            <tr>
                              <td>Period of Engagement from</td>
                              <td><input type="text" id="" class="form-control"></td>
                              <td align="right">to</td>
                              <td><input type="text" id="" class="form-control"></td>
                              <td><input type="text" id="" class="form-control" style="width:94%;">
                                <a href="#">X</a></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><button class="addnew_line" style="width:82px;"><i class="add_icon_img"><img src="img/add_icon.png"></i>
                                <p class="add_line_t">Add</p>
                                </button></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-xs-12">
                          <div class="top_buttons">
                            <div class="form-group email_top_left">
                              <label for="exampleInputPassword1">Message Subject</label>
                              <input type="text" id="" class="form-control">
                            </div>
                            <div class="form-group select_template">
                              <label for="exampleInputPassword1">Select Template <a href="#">+ New</a></label>
                              <select class="form-control">
                                <option></option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                                <option>Sfrewfgrewf</option>
                              </select>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea</textarea>
                          <!--<div class="add_client_btn">
<button class="btn btn-info">Prev</button>
<button class="btn btn-danger">Save</button>
<button class="btn btn-info">Next</button>
<div class="clearfix"></div>
</div>-->
                        </div>
                        <div class="col-xs-12" style="padding:0;">
                          <div class="col-xs-12 col-xs-8">
                            <div class="col_m2 icon_poisition">
                              <div class="notes_inner">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Title</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Message</label>
                                  <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-xs-4">
                            <div class="col_m2">
                              <div class="noted_right"> <img src="img/plus_1.png" class="icon_gap"> <strong class="notes_h_t">New Section</strong>
                                <div class="new_section"> <span class="notes_h_t">SCHEDULE OF SERVICES TO BE PROVIDED</span>
                                  <ul>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                  </ul>
                                </div>
                                <div class="add_client_btn">
                                  <button class="btn btn-info">Prev</button>
                                  <button class="btn btn-danger">Save</button>
                                  <button class="btn btn-info">Next</button>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <div id="tab_6" class="tab-pane">
                  <!--table area-->
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12" style="padding:0;">
                          <div class="col-xs-12 col-xs-8">
                            <div class="col_m2 icon_poisition">
                              <div class="notes_inner">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Title</label>
                                  <input type="text" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Message</label>
                                  <textarea name="" rows="10" cols="" style="width:100%;">This is my textarea</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-xs-4">
                            <div class="col_m2">
                              <div class="noted_right"> <img src="img/plus_1.png" class="icon_gap"> <strong class="notes_h_t">New Section</strong>
                                <div class="new_section"> <span class="notes_h_t">SCHEDULE OF SERVICES TO BE PROVIDED</span>
                                  <ul>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                     <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                     <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                    <li>
                                      <div class="new_sec_chkbox"><input type="checkbox" id="" class="form-control"></div>
                                      <strong>TB Coder System requirements</strong></li>
                                  </ul>
                                </div>
                                <div class="add_client_btn">
                                  <button class="btn btn-info">Prev</button>
                                  <button class="btn btn-danger">Save</button>
<!--                                  <button class="btn btn-info">Next</button>-->
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                </div>
                <!-- /.tab-pane -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        

    

     

@stop
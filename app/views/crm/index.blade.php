@extends('layouts.layout')

@section('mycssfile')
<style>
.leads_tab li h3{ color:#fff; background: #000; font-size: 13px; padding: 8px 0 !important; margin: 0 0 0px 0!important; cursor: text;}
</style>

  <link href="{{URL :: asset('css/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
  <!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')





<!-- Time picker script -->
<script src="{{ URL :: asset('js/timepicki.js') }}"></script>
<!-- Time picker script -->

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="{{ URL :: asset('js/forecast.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/crm.js') }}" type="text/javascript"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="{{ URL :: asset('js/plugins/jquery.quicksearch.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<!-- page script -->

<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<!-- <script src="{{ URL :: asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script> -->
<script src="{{ URL :: asset('js/jquery.price_format.2.0.js') }}" type="text/javascript"></script>

<script>
$(document).ready(function(){
    $("#close_date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    $(".close_date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    $("#date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    $("#from_date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    $("#to_date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    //$('.money').mask('000.000.000.000.000,00');
    $('#quoted_value').priceFormat({
        prefix: '',
        //centsSeparator: '.',
        //thousandsSeparator: ',',
        //centsLimit: '',
    });
    $('#annual_revenue').priceFormat({
        prefix: '',
        //centsSeparator: '.',
        //thousandsSeparator: ',',
        //centsLimit: '',
    });
});

</script>
<script type="text/javascript">

$(function() {
        $('input#id_search').quicksearch('.forecastsearch  li');
        
       
    });


  $(function() {
     $('#exaforecast').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true}
       
      ],
      "aaSorting": [[1, 'desc']]
    });
    
    
    
    
    
     $('#exampletab2').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });
    
    
    $('#exampletab3').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });
    
    
    
    
    $('#example611').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });

  for(var k=2; k<=11;k++){
    $('#example61'+k).dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });
  }

  $('#example62').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });

  $('#example63').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });

  $('#example64').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });

    $('#example5').dataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100]],
      "iDisplayLength": 25,

      "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},
        {"bSortable": false},
        {"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        //{"bSortable": false},
        {"bSortable": false}
      ],
      "aaSorting": [[1, 'desc']]
    });
        

});

</script>

<script src="{{ URL :: asset('js/graph.js') }}" type="text/javascript"></script>
<script>
/*$(function () {
  var bar = new GraphBar({
    attachTo: '#graph',
    special: 'combo',
    height: 475,
    width: '100%',
    yDist: 30,
    xDist: 50,
    showPoints: false,
    xGrid: false,
    legend: true,
    averageLineColor:false,
    points: [
      [17, 21, 51, 74, 12, 49, 100, 17, 21, 51, 74, 12],
      [32, 15, 75, 20, 45, 90, 52, 15, 75, 20, 45, 90]
    ],
    colors: ['red', 'orange'],
    dataNames: ['Total', 'Won'],
    xName: 'Month',
    tooltipWidth: 15,
    design: {
        tooltipColor: '#fff',
        gridColor: 'black',
        tooltipBoxColor: 'green',
        averageLineColor: 'blue',
    }
  });
  bar.init();
});*/
</script>
<style type="text/css">
  svg:not(:root){overflow: inherit; margin-right: 20px; float:right;}

</style>
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas {{ $left_class }}">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            @include('layouts.inner_leftside')
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
        <div class="practice_hed">
        <div class="top_bts">
          <ul>
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>

        <div id="message_div"><!-- Loader image show while sync data --></div>
      </div>

      

      </div>
      <div class="practice_mid">
      <input type="hidden" name="page_open" id="page_open" value="{{ $page_open }}">
      <input type="hidden" name="encode_page_open" id="encode_page_open" value="{{ $encode_page_open }}">
      <input type="hidden" name="encode_owner_id" id="encode_owner_id" value="{{ $encode_owner_id }}">
      
    <div class="tabarea">
  
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs nav-tabsbg">
      <li class="{{ ($page_open == 11)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('11') }}/{{ base64_encode($owner_id) }}">DASHBOARD</a></li>
      <li class="{{ ($page_open == 2)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('2') }}/{{ base64_encode($owner_id) }}">CLIENT DETAILS</a></li>
      <li class="{{ ($page_open == 3)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('3') }}/{{ base64_encode($owner_id) }}">MANAGE CONTRACT RENEWALS</a></li>
      <li class="{{ ($page_open == 4)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('4') }}/{{ base64_encode($owner_id) }}">MANAGE DIRECT DEBITS</a></li>
      <li class="{{ ($page_open == 51)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('51') }}/{{ base64_encode($owner_id) }}">LEADS</a></li>
      <li class="{{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617 || $page_open == 62 || $page_open == 63 || $page_open == 64 || $page_open == 65)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('611') }}/{{ base64_encode($owner_id) }}">OPPORTUNITIES</a></li>
      <li class="{{ ($page_open == 7)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('7') }}/{{ base64_encode($owner_id) }}">SALES FORECAST</a></li>
      <li class="{{ ($page_open == 8)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('8') }}/{{ base64_encode($owner_id) }}">MAILING LIST</a></li>
    </ul>

<div class="tab-content">
  <!-- Tab 1 Start-->
  <div id="tab_11" class="tab-pane {{ ($page_open == 11)?'active':'' }}">
  Tab 1
  </div>
<!-- Tab 1 End-->

<!-- Tab 2 Start-->
  <div id="tab_2" class="tab-pane {{ ($page_open == 2)?'active':'' }}">
  <div class="col_m2">
                            <!--sub tab -->
                            <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs nav-tabsbg" style="cursor: move;">
                                <li class="active"><a data-toggle="tab" href="#tab_6">ORGANISATION</a></li>
                                <li class=""><a data-toggle="tab" href="#tab_7">INDIVIDUALS</a></li>
                              </ul>
                              <div class="tab-content">
                                <div id="tab_6" class="tab-pane active">
                                  <!--table area-->
                                  <div class="box-body table-responsive">
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                      <div class="row">
                                        <div class="col-xs-6"></div>
                                        <div class="col-xs-6"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12">
                                          <div class="col_m2">
                                            <div class="notes_top_btns"> </div>
                                            <div class="total_annual_fee">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody><tr>
                                                
                                                <!--  <td>Total Annual Fees</td>
                                                  <td><input type="text" id="" class="form-control"></td>
                                                  <td width="10%">&nbsp;</td>
                                                  <td>Average Fees</td>
                                                  <td><input type="text" id="" class="form-control"></td> -->
                                                </tr>
                                              </tbody></table>
                                            </div>
                                            <table width="100%" border="0" class="staff_holidays">
                                              <tbody>
                                                <tr>
                                                  <td valign="top"><table width="100%" border="0">
                                                      <tbody>
                                                        <tr>
                                                         
                                                          
                                                          
                                                          
                                                          
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td valign="top">
                                                  
      <table class="table table-bordered table-hover dataTable crm" id="exampletab2" aria-describedby="exampletab2_info">                                            
                                                  
                                                      <thead>
                                                        <tr>
                                                          <td><input type="checkbox" class="CheckallCheckbox" style="position: absolute; opacity: 0;"></td>
                                                          <td><strong>Joining Date</strong></td>
                                                          <td align="center"><strong>Client Name</strong></td>
                                                          <td align="center"><strong>Payment Method</strong></td>
                                                          <td align="center"><strong>Engagement letters</strong></td>
                                                          <td align="center"><strong>Annual Fee</strong></td>
                                                          <td align="center"><strong>Monthly Fees</strong></td>
                                                          <td align="center"><strong>Contract End Date</strong></td>
                                                          <td align="center"><strong>Count Down</strong></td>
                                                          <td align="center"><strong>Renewals</strong>
                                                          <i class="fa fa-cog fa-fw" style="color:#00c0ef"></i>
                                                          </td>
                                                          <td align="center"><strong>Quotes</strong></td>
                                                        </tr>
                                                        </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td><input type="checkbox" class="CheckallCheckbox" style="position: absolute; opacity: 0;"></td>
                                                          <td>09-09-2015</td>
                                                          <td align="center">Cockerton &amp; Co Limited</td>
                                                          <td align="center">Method</td>
                                                          <td align="center">
                             <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>View</span>
                                  <div class="small_icon" data-id="27" data-tab="11"></div><div class="clr"></div>
                                  
                                </div>                       
                                                          
                                                          </td> 
                                                          <td align="center">&nbsp;</td>
                                                          <td align="center">09-09-2015</td>
                                                          <td align="center">19-09-2015</td>
                                                          <td align="center">39</td>
                                                          
                       <td align="center">
                             <button type="button" class="send_btn send_manage_task" data-client_id="1" data-field_name="ch_manage_task">SEND</button>                      
                                                          
                                                          </td>      
                                                          
                                                         <!-- <td align="center"><button class="btn btn-default">SENT</button></td> -->
                                                         <td align="center">
                             <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>View</span>
                                  <div class="small_icon" data-id="27" data-tab="11"></div><div class="clr"></div>
                                  
                                </div>                       
                                                          
                                                          </td> 
                                                        <!--  <td align="center"><button class="btn btn-default">View</button></td> -->
                                                        </tr>
                                                      <!--  <tr>
                                                          <td><div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                                                          <td>09-09-2015</td>
                                                          <td align="center">Cockerton &amp; Co Limited</td>
                                                          <td align="center">ewfe</td>
                                                          <td align="center"><select class="form-control">
                                                              <option>50</option>
                                                              <option>20</option>
                                                              <option>10</option>
                                                              <option>15</option>
                                                            </select></td>
                                                          <td align="center">&nbsp;</td>
                                                          <td align="center">ergre</td>
                                                          <td align="center">ewfew</td>
                                                          <td align="center">ewf</td>
                                                          <td align="center"><button class="btn btn-default">SENT</button></td>
                                                          <td align="center"><button class="btn btn-default">View</button></td>
                                                        </tr> -->
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--end table-->
                                </div>
                                <!-- /.tab-pane -->
                                <div id="tab_7" class="tab-pane">
                                  <!--table area-->
                                  <div class="box-body table-responsive">
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                      <div class="row">
                                        <div class="col-xs-6"></div>
                                        <div class="col-xs-6"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12">
                                          <div class="col_m2">
                                            <div class="notes_top_btns"> </div>
                                            <div class="total_annual_fee">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody><tr>
                                                <!--  <td>Total Annual Fees</td>
                                                  <td><input type="text" id="" class="form-control"></td>
                                                  <td width="10%">&nbsp;</td>
                                                  <td>Average Fees</td>
                                                  <td><input type="text" id="" class="form-control"></td> -->
                                                </tr>
                                              </tbody></table>
                                            </div>
                                            <table width="100%" border="0" class="staff_holidays">
                                              <tbody>
                                                <tr>
                                                  <td valign="top"><table width="100%" border="0">
                                                      <tbody>
                                                        <tr>
                                                          <td width="5%"><strong>Show</strong></td>
                                                          <td width="7%"><select class="form-control">
                                                              <option>50</option>
                                                              <option>20</option>
                                                              <option>10</option>
                                                              <option>15</option>
                                                            </select></td>
                                                          <td width="35%"><strong>entries</strong></td>
                                                          <td width="24%">&nbsp;</td>
                                                          <td width="5%"><strong>Search</strong></td>
                                                          <td width="21%"><input type="text" id="" class="form-control"></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                                <tr>
                                                  <td valign="top"><table width="100%" class="table table-bordered">
                                                      <tbody>
                                                        <tr>
                                                          <td><div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                                                          <td><strong>Joining Date</strong></td>
                                                          <td align="center"><strong>Client Name</strong></td>
                                                          <td align="center"><strong>Payment Method</strong></td>
                                                          <td align="center"><strong>Engagement letters</strong></td>
                                                          <td align="center"><strong>Annual Fee</strong></td>
                                                          <td align="center"><strong>Monthly Fees</strong></td>
                                                          <td align="center"><strong>Contract End Date</strong></td>
                                                          <td align="center"><strong>Count Down</strong></td>
                                                          <td align="center"><strong>Renewals</strong></td>
                                                          <td align="center"><strong>Quotes</strong></td>
                                                        </tr>
                                                        <tr>
                                                          <td><div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                                                          <td>09-09-2015</td>
                                                          <td align="center">Cockerton &amp; Co Limited</td>
                                                          <td align="center">ewfe</td>
                                                          <td align="center"><select class="form-control">
                                                              <option>50</option>
                                                              <option>20</option>
                                                              <option>10</option>
                                                              <option>15</option>
                                                            </select></td>
                                                          <td align="center">&nbsp;</td>
                                                          <td align="center">ergre</td>
                                                          <td align="center">ewfew</td>
                                                          <td align="center">ewf</td>
                                                          <td align="center"><button class="btn btn-default">SENT</button></td>
                                                          <td align="center"><button class="btn btn-default">View</button></td>
                                                        </tr>
                                                        <tr>
                                                          <td><div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                                                          <td>09-09-2015</td>
                                                          <td align="center">Cockerton &amp; Co Limited</td>
                                                          <td align="center">ewfe</td>
                                                          <td align="center"><select class="form-control">
                                                              <option>50</option>
                                                              <option>20</option>
                                                              <option>10</option>
                                                              <option>15</option>
                                                            </select></td>
                                                          <td align="center">&nbsp;</td>
                                                          <td align="center">ergre</td>
                                                          <td align="center">ewfew</td>
                                                          <td align="center">ewf</td>
                                                          <td align="center"><button class="btn btn-default">SENT</button></td>
                                                          <td align="center"><button class="btn btn-default">View</button></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                              </tbody>
                                            </table>
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
                            <!--end sub tab-->
                          </div>
  
  
 <!-- Tab 2 -->
  </div>
<!-- Tab 2 End-->

<!-- Tab 3 Start-->
  <div id="tab_3" class="tab-pane {{ ($page_open == 3)?'active':'' }}">
 <!-- Tab 3 -->
 
                            <!--sub tab -->
                            <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs nav-tabsbg" style="cursor: move;">
                                <li class="active"><a data-toggle="tab" href="#tab_6">All [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Not Started [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">In Progress [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Renewals sent [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Client Review [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Renegotiated [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Accpted [8]</a></li>
                                <li class=""><a data-toggle="tab" href="#">Client Invoiced [8]</a></li>
                              </ul>
                              <div class="tab-content">
                                <div id="tab_6" class="tab-pane active">
                                  <!--table area-->
                                  <div class="box-body table-responsive">
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                                      <div class="row">
                                        <div class="col-xs-6"></div>
                                        <div class="col-xs-6"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12">
                                          <div class="col_m2">
                                           
                                            
                                            <table width="100%" border="0" class="staff_holidays">
                                              <tbody>
                                               
                                                <tr>
                                                  
                                                  
                                                <table class="table table-bordered table-hover dataTable crm" id="exampletab3" aria-describedby="exampletab3_info">
                                                  
                                                      <thead>
                                                        <tr>
                                                        <td><strong>Delete</strong></td>
                                                          <td><strong>DOJ</strong></td>
                                                          <td align="center"><strong>Business Name</strong></td>
                                                          <td align="center"><strong>Annual Fee</strong></td>
                                                          <td align="center"><strong>Contract End Date</strong></td>
                                                          <td align="center"><strong>Days</strong></td>
                                                         
                                                          <td align="center"><strong>Job Start Date</strong>
                                                          <i class="fa fa-cog fa-fw" style="color:#00c0ef"></i>
                                                          </td>
                                                          <td align="center"><strong>Notes</strong></td>
                                                          <td align="center"><strong>Quotes</strong>
                                                          <i class="fa fa-cog fa-fw" style="color:#00c0ef"></i>
                                                          </td>
                                                          <td align="center"><strong>Status</strong>
                                                          <i class="fa fa-cog fa-fw" style="color:#00c0ef"></i>
                                                          </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr><td> 
                                                        <a href="javascript:void(0)" class="delete_single_task DeleteBoxRow" data-client_id="" data-tab=""><img src="/img/cross.png"></a>
                                                        </td>
                                                          <td>28-08-2015</td>
                                                          <td>Business Name  Co Limited</td>
                                                          <td align="center">&nbsp; </td>
                                                          <td align="center">08-08-2015</td>
                                                          <td align="center">39</td>
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          <td align="center">18-08-2015
                                               <span class="glyphicon glyphicon-chevron-down open_adddrop" data-client_id="4" data-tab="21"></span>
                                                          
                                                          </td>
                                                           
                                                          <td align="center">
                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="33" data-tab="11"><span style="">notes</span></a>
                                                          
                                                          
                                                          </td>
                                                         
                                                          <td align="center">
                             <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>SEND</span>
                                  <div class="small_icon" data-id="27" data-tab="11"></div><div class="clr"></div>
                                  
                                </div>  <img src="/img/corner_arrow.png" style="height:12px;">                      
                                                          
                                                          </td>
                                                          
                                  <td align="center">
                                    <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_27" data-leads_id="27">
                                                                                      
                                                          <option value="4">QUALIFIED</option>
                                                          <option value="6">DISCUSSIONS</option>
                                                          <option value="7">PROPOSAL</option>
                                                          <option value="8" selected="">NEGITIATIONS</option>
                                                          <option value="10">CLOSING</option>
                                                                                      </select></td>
                                                        </tr>
                                                       
                                                      </tbody>
                                                    </table></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--end table-->
                                </div>
                                <!-- /.tab-pane -->
                                
                                <!-- /.tab-pane -->
                              </div>
                            </div>
                            <!--end sub tab-->
                         
  </div>
<!-- Tab 3 End-->

<!-- Tab 4 Start-->
  <div id="tab_4" class="tab-pane {{ ($page_open == 4)?'active':'' }}">
  Tab 4
  </div>
<!-- Tab 4 End-->

<!-- Tab 5 Start-->
  <div id="tab_51" class="tab-pane {{ ($page_open == 51 || $page_open == 52 || $page_open == 53)?'active':'' }}">

    <!-- <div class="tab_topcon">
      <div class="top_bts" style="float:left;">
        <ul style="padding:0;">
          <li>
            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
          </li>
          <li>
            <div class="import_fromch_main" style="width:182px;">
              <div class="import_fromch">
                <a href="javascript:void(0)" class="import_fromch_link">+ NEW LEAD</a>
                <a href="javascript:void(0)" class="i_selectbox" id="select_new_lead"><img src="/img/arrow_icon.png"></a>
                <div class="clearfix"></div>
              </div>
              <div class="crm_dropdown open_toggle" style="left: 90px;">
              <ul>
                <li><href="javascript:void(0)" data-type="ind" data-leads_id="0" class="open_new_lead-modal">Individual</a></li>
                <li><href="javascript:void(0)" data-type="org" data-leads_id="0" class="open_new_lead-modal">Organisation</a></li>
              </ul>
            </div>
          </div>
          </li>
        <div class="clearfix"></div>
        </ul>
      </div>
      
      <div class="clearfix"></div>
    </div> -->

    <ul class="leads_tab" style="border: none;">
        <li style="width:8%">
          <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
        </li>
        <li>
          <div class="import_fromch_main" style="width:182px;">
            <div class="import_fromch">
              <a href="javascript:void(0)" class="import_fromch_link">+ NEW LEAD</a>
              <a href="javascript:void(0)" class="i_selectbox" id="select_new_lead"><img src="/img/arrow_icon.png"></a>
              <div class="clearfix"></div>
            </div>
            <div class="crm_dropdown open_toggle" style="left: 90px;">
            <ul>
              <li><href="javascript:void(0)" data-type="ind" data-leads_id="0" class="open_new_lead-modal">Individual</a></li>
              <li><href="javascript:void(0)" data-type="org" data-leads_id="0" class="open_new_lead-modal">Organisation</a></li>
            </ul>
          </div>
        </div>
        </li>

        <li style="width:9%;" class="{{ ($page_open == '51')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('51') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#0066FF;">All [<span id="task_count_11">10</span>]</h3></a>
          <p>100%</p>
        </li>

        <li class="{{ ($page_open == '52')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('52') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#CC3300;"><span id="step_field_{{ $tab_row['tab_id'] or "" }}">HOT</span> [<span id="task_count_1">0</span>]</h3></a>
          <p>10%</p>
        </li>

        <li class="{{ ($page_open == '53')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('53') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#66CCFF;"><span id="step_field_{{ $tab_row['tab_id'] or "" }}">WARM</span> [<span id="task_count_1">0</span>]</h3></a>
          <p>10%</p>
        </li>

        <li class="{{ ($page_open == '54')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('54') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#D1A319;"><span id="step_field_{{ $tab_row['tab_id'] or "" }}">COLD</span> [<span id="task_count_1">0</span>]</h3></a>
          <p>10%</p>
        </li>

        <div class="clearfix"></div>
    </ul>
    
  <div class="tab-content">

    <div id="tab_51" class="tab-pane top_margin {{ ($page_open == '51')?'active':'' }}">
      <table class="table table-bordered table-hover dataTable crm" id="example5" aria-describedby="example5_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
          <th width="7%">Date</th>
          <th width="12%">Deal Owner</th>
          <th width="12%">Prospect Name</th>
          <th>Contact Name</th>
          <th width="5%">Phone</th>
          <th width="9%">Email</th>
          <th width="13%">Convert to Opportunity</th>
          <th width="8%">Lead Source</th>
          <th width="9%">Lead Status <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
          <th width="5%">Notes</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @if(isset($leads_details) && count($leads_details) >0)
          @foreach($leads_details as $key=>$leads_row)
            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
              <td align="left">{{ $leads_row['date'] or "" }}</td>
              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
              <td align="left">
                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                @else
                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                @endif
              </td>
              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
              <td align="center">Phone</td>
              <td align="center">Email</td>
              <td align="center">
                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </td>
              
              <td align="center"></td>
              <td align="center">
                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                  <option value="warm">WARM</option>
                  <option value="hot">HOT</option>
                  <option value="cold">COLD</option>
                </select>
              </td>
              <td>
                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
              </td>
              
            </tr>
          @endforeach
        @endif
        
      </tbody>
    </table>
    </div>

    @for($k=2; $k <=11;$k++)                          
    <div id="tab_5{{$k}}" class="tab-pane top_margin {{ ($page_open == '5'.$k)?'active':'' }}">
      33
    </div>
    @endfor  



  </div>


  </div>
<!-- Tab 5 End-->

<!-- Tab 6 Start-->
  <div id="tab_61" class="tab-pane {{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617 || $page_open == 62 || $page_open == 63 || $page_open == 64 || $page_open == 65)?'active':'' }}">
    <div class="box-body table-responsive">
      <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
        <div class="row">
          <div class="col-xs-6"></div>
          <div class="col-xs-6"></div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="col_m2">
              <!--sub tab -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-tabsbg">
                  <li class="{{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('611') }}/{{ base64_encode($owner_id) }}">OPEN</a></li>
                  <li class="{{ ($page_open == 62)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('62') }}/{{ base64_encode($owner_id) }}">CLOSED (WON)</a></li>
                  <li class="{{ ($page_open == 63)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('63') }}/{{ base64_encode($owner_id) }}">CLOSED (LOST)</a></li>
                  <li class="{{ ($page_open == 64)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('64') }}/{{ base64_encode($owner_id) }}">COLD</a></li>
                  <li><a href="/crm/report" target="_blank">REPORTS</a></li>
                  <!-- <li class="{{ ($page_open == 65)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('65') }}/{{ base64_encode($owner_id) }}">REPORTS</a></li> -->

                </ul>
                <div class="tab-content">

                  <div id="tab_611" class="tab-pane {{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617)?'active':'' }}">

                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <li>
                            <div class="import_fromch_main" style="width:182px;">
                              <div class="import_fromch">
                                <a href="javascript:void(0)" class="import_fromch_link">+ NEW OPPORTUNITY</a>
                                <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                                <div class="clearfix"></div>
                              </div>
                              <div class="crm_dropdown open_toggle">
                              <ul>
                                <li><href="javascript:void(0)" data-type="ind" data-leads_id="0" class="open_form-modal">Individual</a></li>
                                <li><href="javascript:void(0)" data-type="org" data-leads_id="0" class="open_form-modal">Organisation</a></li>
                              </ul>
                            </div>
                          </div>
                          </li>
                          <!-- <li>
                            <a class="btn btn-info" href="/crm/graph-page" target="_blank">GRAPHS</a>
                          </li>
                          <li>
                            <a class="btn btn-info" href="/crm/report" target="_blank">REPORT</a>
                          </li> -->
                        <div class="clearfix"></div>
                        </ul>
                      </div>
                      <!-- <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" id="archive_div"></a>
                          </li>
                          <li>
                            <button type="button" id="archivedButton" class="btn btn-warning">Archive</button>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div> -->
                      <div class="clearfix"></div>
                    </div>

                    <ul class="leads_tab">
                        <li style="width:9%;" class="{{ ($page_open == '611')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('611') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#0066FF;">All [<span id="task_count_11">{{ $all_count }}</span>]</h3></a>
                          <p>{{ ($all_total != '0.00')?round( ($all_total*100/$all_total), 2 ):'0.00' }}%</p>
                          <p>&#163;{{ $all_total or "0.00" }}</p>
                          <p>&#163;{{ $all_average or "0.00" }}</p>
                          <p>&#163;{{ $all_likely or "0.00" }}</p>
                        </li>

                        @if(isset($leads_tabs) && count($leads_tabs) >0)
                          <?php 
                            $i = 2;
                            $total    = 0;
                            $average  = 0;
                            $likely   = 0;
                          ?>
                          @foreach($leads_tabs as $key=>$tab_row)
                            @if($tab_row['status'] == 'S')
                            <li class="{{ ($page_open == '61'.$i)?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('61'.$i) }}/{{ base64_encode($owner_id) }}"><h3 style="background:#{{ $tab_row['color_code'] or "" }};"><span id="step_field_{{ $tab_row['tab_id'] or "" }}">{{ $tab_row['tab_name'] or "" }}</span> [<span id="task_count_1.$i">{{ $tab_row['count'] or "0" }}</span>]</h3></a>
                            <p>{{ isset($tab_row['table_value']['total'])?round(str_replace(',','',$tab_row['table_value']['total'])*100/str_replace(',','',$all_total), 2):'0.00' }}%</p>
                            <p>&#163;{{ $tab_row['table_value']['total'] or "0.00" }}</p>
                            <p>&#163;{{ $tab_row['table_value']['average'] or "0.00" }}</p>
                            <p>&#163;{{ $tab_row['table_value']['likely'] or "0.00" }}</p>
                            </li>
                            @endif
                          <?php $i++;?>
                          @endforeach
                        @endif

                        <li style="width:7%;"><h3 style="background:#FF3399;">METRIC</h3>
                          <p style="border-right: 0px"><strong>Percentages</strong></p>
                          <p style="border-right: 0px"><strong>Total</strong></p>
                          <p style="border-right: 0px"><strong>Average</strong></p>
                          <p style="border-right: 0px"><strong>Likely</strong></p>
                        </li>

                        <div class="clearfix"></div>
                    </ul>
                    
                  <div class="tab-content">

                  <div id="tab_611" class="tab-pane top_margin {{ ($page_open == '611')?'active':'' }}">
                    <table class="table table-bordered table-hover dataTable crm" id="example611" aria-describedby="example611_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Stage <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && ($leads_row['lead_status'] != 8 && $leads_row['lead_status'] != 9 && $leads_row['lead_status'] != 10))
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <input type="hidden" name="close_date_{{ $leads_row['leads_id'] }}" id="close_date_{{ $leads_row['leads_id'] }}" value="{{ $leads_row['close_date'] }}">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                    </div>

                    @for($k=2; $k <=7;$k++)                          
                    <div id="tab_61{{$k}}" class="tab-pane top_margin {{ ($page_open == '61'.$k)?'active':'' }}">
                      <table class="table table-bordered table-hover dataTable crm" id="example61{{$k}}" aria-describedby="example61{{$k}}_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="6%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Lead Status <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="8%">Quoted Value</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == $k)
                            <tr>
                              <td><input type='checkbox' class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px;">
                                  <span>SEND</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table> 
                    </div>
                    @endfor  



                  </div>


                  </div>



                  <!-- Tab 62 Start-->
                  <div id="tab_62" class="tab-pane top_margin {{ ($page_open == '62')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='8'>{{$won_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='8' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example62" aria-describedby="example62_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Close Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                          <th width="6%">Client Onboarding</th>
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 8)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['close_date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td>
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                    </div>
                  <!-- Tab 62 End-->

                  <!-- Tab 63 Start-->
                  <div id="tab_63" class="tab-pane {{ ($page_open == '63')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='9'>{{$lost_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='9' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example63" aria-describedby="example63_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Close Date</th>
                          <th width="18%">Deal Owner</th>
                          <th width="18%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th width="5%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 9)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['close_date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- Tab 63 End-->

                  <!-- Tab 64 Start-->
                  <div id="tab_64" class="tab-pane {{ ($page_open == '64')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <!-- <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='9'>{{$lost_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='9' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul> -->
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example64" aria-describedby="example64_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Stage <a href="javascript:void(0)" class="lead_status-modal" style="float:right;"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="7%">Amount</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 10)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- Tab 64 End-->

                  <!-- Tab 65 Start-->
                  <div id="tab_65" class="tab-pane {{ ($page_open == '65')?'active':'' }}">
                    Reports
                  </div>
                  <!-- Tab 64 End-->


                </div>
              </div>
              <!--end sub tab-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Tab 6 End-->

<!-- Tab 7 Start-->
  <div id="tab_7" class="tab-pane {{ ($page_open == '7')?'active':'' }}">
   
   <div class="tab_topcon">
                      <div style="float:left; margin-top:30px; width:25%;" class="top_bts">
                        <ul style="padding:0;">
                          <li>
                            <div style="width:170px;" class="import_fromch_main">
  
                              <div class="import_fromch">
                              
<a class="import_fromch_link" href="#" data-toggle="modal"  data-target="#forecast-modal" > +NEW FORECAST VALUES</a>
                              <!--  <a id="select_icon" class="i_selectbox" href="javascript:void(0)"><img src="/img/arrow_icon.png"></a> -->
                                <div class="clearfix"></div>
                              </div>
                              
                          </div>
                          </li>
                          <li>
                            <div style="width:108px;" class="import_fromch_main">
                              <div class="import_fromch">
                                <a class="import_fromch_link" href="javascript:void(0)">Show Totals</a>
                              <!--  <a id="select_icon" class="i_selectbox" href="javascript:void(0)"><img src="/img/arrow_icon.png"></a> -->
                                <div class="clearfix"></div>
                              </div>
                              
                          </div>
                          </li>
                          
                         
                          
                            
                          
                          
                          <!-- <li>
                            <a class="btn btn-info" href="/crm/graph-page" target="_blank">GRAPHS</a>
                          </li>
                          <li>
                            <a class="btn btn-info" href="/crm/report" target="_blank">REPORT</a>
                          </li> -->
                        <div class="clearfix"></div>
                        </ul>
                      </div>
                     
                           <form style="float:left; width:75%">
                           
                             <div style="margin-top:0px; float: left; width:14%; margin-right: 1%;">
                              <p style="font-weight: bold;">Select Months</p>
                               <select id="marital_status" name="marital_status" class="form-control" style="width: 100%;">
                 
                                 
                                            <option value='1'>Janaury</option>
                                            <option value='2'>February</option>
                                            <option value='3'>March</option>
                                            <option value='4'>April</option>
                                            <option value='5'>May</option>
                                            <option value='6'>June</option>
                                            <option value='7'>July</option>
                                            <option value='8'>August</option>
                                            <option value='9'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                               </select>
                             </div>
                             
                            <div style="margin-top:0px; float: left; width:12%; margin-right: 1%;">
                              <p style="font-weight: bold;">Select Year</p>
                               <select id="marital_status" name="marital_status" class="form-control" style="width: 100%;">
                 
                                  <option selected="" value="1">2015</option>
                               </select>
                             </div>
                             
                             <div style="margin-top:0px; float: left; width:14%; margin-right: 1%;">
                              <p style="font-weight: bold;">Include Previous</p>
                               <select id="marital_status" name="marital_status" class="form-control" style="width: 100%;">
                 
                                  <option selected="selected" value="1">1 Month</option>
                                  <option selected="" value="1">2 Month</option>
                                  <option selected="" value="1">3 Month</option>
                                  <option selected="" value="1">4 Month</option>
                                  <option selected="" value="1">5 Month</option>
                                  <option selected="" value="1">6 Month</option>
                                  <option selected="" value="1">7 Month</option>
                                  <option selected="" value="1">8 Month</option>
                                  <option selected="" value="1">9 Month</option>
                                  <option selected="" value="1">10 Month</option>
                                  <option selected="" value="1">11 Month</option>
                                  <option selected="" value="1">12 Month</option>
                                  <option selected="" value="1">13 Month</option>
                                  <option selected="" value="1">14 Month</option>
                                  <option selected="" value="1">15 Month</option>
                                  <option selected="" value="1">16 Month</option>
                                  <option selected="" value="1">17 Month</option>
                                  <option selected="" value="1">18 Month</option>
                                  <option selected="" value="1">19 Month</option>
                                  <option selected="" value="1">20 Month</option>
                                  <option selected="" value="1">21 Month</option>
                                  <option selected="" value="1">22 Month</option>
                                  <option selected="" value="1">23 Month</option>
                                  <option selected="" value="1">24 Month</option>
                                  
                               </select>
                             </div>
                             
                             <div style="margin-top:0px; float: left; width:11%; margin-right: 1%;">
                              <p style="font-weight: bold;">Forecasts</p>
                               <input type="text" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555; padding: 7px 0px;   height: 34px; background: #fff; width: 100px;"/>
                             </div>
                             
                              <div style="margin-top:0px; float: left; width:11%;   height: 34px; margin-right: 1%;">
                              <p style="font-weight: bold;">Closed Deals</p>
                               <input type="text" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555; padding: 7px 0px; background: #fff; width: 100px;"/>
                             </div>
                             
                              <div style="margin-top:0px; float: left; width:11%;   height: 34px; margin-right: 1%;">
                              <p style="font-weight: bold;">Pipeline Deals</p>
                               <input type="text" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555; padding: 7px 0px; background: #fff; "/>
                             </div>
                             <div class="clearfix"></div>
                           </form> 
                           
                            
                            
                      
                      <div class="clearfix"></div>
                    </div>
                    
                    <!--
                    <div style="margin-bottom:20px;"><strong class="search_t">Search</strong> &nbsp;	<input style=" padding: 3px; border: #ccc solid 1px;   width: 16em;" type="text" name="search" value="" id="id_search" placeholder="" autofocus=""></div> -->
                    
                    
                    <table class="table table-bordered table-hover dataTable crm" id="exaforecast" aria-describedby="exaforecast_info">
                      <thead>
                        <tr role="row">
                        
                          <td align="center" width="4%" style="color: black; background: #deedf5;" >EDIT</td>
                          <td align="center" width="12%" style="background:#0066ff; color: white" >MONTHS</td>
                          <td align="center" width="12%" style="background:#00ccff; color: white">FORECAST</td>
                          <td align="center" width="12%"  style="background:#ffcd0a;; color: white">CLOSED DEALS</td>
                          <td align="center" width="12%" style="background:#ff3199; color: white">OTHER CLOSED</td>
                          <td align="center" width="12%" style="background:#f56954; color: white">VARIANCE</td>
                          <td align="center" width="12%" style="background:#4da2a2; color: white">PIPELINE DEALS</td>
                          <td align="center" width="12%" style="background:#ff3399; color: white">OTHER PIPELINE</td>
                          <td  align="center"width="12%" style="background:#f56954; color: white">VARIANCE</td>
                          
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS</td>
                              <td align="center">FORECAST</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED</td>
                              <td align="center">VARIANCE</td>
                              <td align="center">PIPELINE DEALS</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE
                              </td>
                             
                            </tr>
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS1</td>
                              <td align="center">FORECAST1</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED1</td>
                              <td align="center">VARIANCE1</td>
                              <td align="center">PIPELINE DEALS1</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE1
                              </td>
                             
                            </tr>
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS1</td>
                              <td align="center">FORECAST1</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED1</td>
                              <td align="center">VARIANCE1</td>
                              <td align="center">PIPELINE DEALS1</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE1
                              </td>
                             
                            </tr>
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS1</td>
                              <td align="center">FORECAST1</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED1</td>
                              <td align="center">VARIANCE1</td>
                              <td align="center">PIPELINE DEALS1</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE1
                              </td>
                             
                            </tr>
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS1</td>
                              <td align="center">FORECAST1</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED1</td>
                              <td align="center">VARIANCE1</td>
                              <td align="center">PIPELINE DEALS1</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE1
                              </td>
                             
                            </tr>
                            <tr>
                              
                              <td align="center"><img src="/img/edit_icon.png"> </td>
                              <td align="center"> MONTHS1</td>
                              <td align="center">FORECAST1</td>
                              <td align="center"><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 24px; "></td>
                              <td align="center">OTHER CLOSED1</td>
                              <td align="center">VARIANCE1</td>
                              <td align="center">PIPELINE DEALS1</td>
                              <td align="center">
                               <input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142PX; border-radius: 5px; height: 24px; "></td>
                              <td align="center">
                                 VARIANCE1
                              </td>
                             
                            </tr>
                           
                            
                      
                      </tbody>
                    </table>
                    
                                        
                <!--    <div class="forecastsearch"> 
                    <ul class="leads_tab">
                        <li style="width:6%" class="" style="width:5%;"><a href=""><h3 style="color: black; background: #deedf5;">EDIT<span id="task_count_11"></span></h3></a>
                          
                          <p><img src="/img/edit_icon.png"></p>
                          <p><img src="/img/edit_icon.png"></p>
                          <p><img src="/img/edit_icon.png"></p>
                          <p><img src="/img/edit_icon.png"></p>
                        </li>

                        <li style="width:12%" class=""><a href=""><h3 style="background:#0066ff;"><span id="step_field_2">MONTHS</span> <span id="task_count_1.$i"></span></h3></a>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>10,444.00</p>
                          <p>10,444.00</p>
                        </li>
                         <li style="width:12%" class=""><h3 style="background:#00ccff;"><span id="step_field_4">FORECAST</span> <span id="task_count_1.$i"></span></h3>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>0.00</p>
                          <p>0.00</p>
                        </li>
                          <li style="width:13%" class=""><a href=""><h3 style="background:#ffcd0a;"><span id="step_field_6">CLOSED DEALS</span> <span id="task_count_1.$i"></span></h3></a>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>0.00</p>
                          <p>0.00</p>
                        </li>
                        <li style="width:11%" class=""><a href=""><h3 style="background:#ff3199;"><span id="step_field_7">OTHER CLOSED</span> <span id="task_count_1.$i"></span></h3></a>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                        </li>
                                                                              <li style="width:12%" class=""><a href=""><h3 style="background:#f56954;"><span id="step_field_8">VARIANCE</span> <span id="task_count_1.$i"></span></h3></a>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>0.00</p>
                          <p>0.00</p>
                        </li>
                            <li style="width:11%" class=""><a href="/crm/NjE3/YWxs"><h3 style="background:#4da2a2; "><span id="step_field_10">PIPELINE DEALS</span> <span id="task_count_1.$i"></span></h3></a>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>20,500.00</p>
                          <p>41,000.00</p>
                        </li>
                                                                            
                        <li style="width:11%;"><h3 style="background:#ff3399;">OTHER PIPELINE</h3>
                           <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                          <p><input type="text" class="forecasttext" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:115px; border-radius: 5px; height: 19px; "/></p>
                        </li>
                    <li style="width:12%;"><h3 style="background:#f56954;">VARIANCE</h3>
                          <p>10%</p>
                          <p>144,454.00</p>
                          <p>20,500.00</p>
                          <p>41,000.00</p>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
   </div> -->
   
   <!-- Tab 7 -->
  </div>
<!-- Tab 7 End-->

<!-- Tab 8 Start-->
  <div id="tab_8" class="tab-pane {{ ($page_open == 8)?'active':'' }}">
  Tab 8
  </div>
<!-- Tab 8 End-->
      

</div>

</div>
          

</div>
        
      </div>
    </section>


</aside><!-- /.right-side -->
            
<!-- Send Template modal start -->
<div class="modal fade" id="open_form-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">NEW OPPORTUNITY</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/crm/save-leads-data')) }}
      <input type="hidden" name="encode_page_open" value="{{ $encode_page_open }}">
      <input type="hidden" name="encode_owner_id" value="{{ $encode_owner_id }}">
      <input type="hidden" name="type" id="type" value="">
      <input type="hidden" name="leads_id" id="leads_id" value="">
      <div class="modal-body">
        <div class="form-group" style="margin:0;">
           <div class="n_box12">
           
              <div class="form-group">
                <label for="exampleInputPassword1">Date</label>
                <input type="text" id="date" name="date" value="{{ $staff_row['date'] or '' }}" class="form-control">
              </div>
            
          </div>
          <div class="n_box11">
            <div class="form-group">
              <label for="deal_certainty">Probabilty</label>
              <input type="text" id="deal_certainty" name="deal_certainty" value="100" class="form-control box_60" maxlength="3"><span style="margin-top: 7px; float:left;">%</span>
            </div>
          </div>

          <div class="f_namebox2">
            <label for="exampleInputPassword1">Deal Owner</label>
              <select class="form-control" name="deal_owner" id="deal_owner">
                <option value="">-- None --</option>
                @if(isset($staff_details) && count($staff_details) >0)
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row['user_id'] }}">{{ $staff_row['fname'] or "" }} {{ $staff_row['lname'] or "" }}</option>
                  @endforeach
                @endif
             </select>
          </div>
          <div class="f_namebox3">
            <label for="exampleInputPassword1">Attach Opportunity to Existing Client</label>
            <select class="form-control" name="existing_client" id="existing_client">
              <option value="0">-- None --</option>
              
             </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox" id="org_name_div">
          <div class="twobox_1">
            <div class="form-group" style="width:57%">
              <label for="exampleInputPassword1">Business Type <a href="#" class="add_to_list" data-toggle="modal" data-target="#addcompose-modal"> Add/Edit list</a></label>
              <select class="form-control" name="business_type" id="business_type">
                @if( isset($old_org_types) && count($old_org_types) >0 )
                  @foreach($old_org_types as $key=>$old_org_row)
                  <option value="{{ $old_org_row->organisation_id }}">{{ $old_org_row->name }}</option>
                  @endforeach
                @endif

                @if( isset($new_org_types) && count($new_org_types) >0 )
                  @foreach($new_org_types as $key=>$new_org_row)
                  <option value="{{ $new_org_row->organisation_id }}">{{ $new_org_row->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
            
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Prospect Name</label>
              <input type="text" class="form-control" name="prospect_name" id="prospect_name">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="contact_name_div">
          <label for="exampleInputPassword1">Contact Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="contact_title" name="contact_title">
              <option value="">-- Title --</option>
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="contact_fname" name="contact_fname" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="contact_lname" name="contact_lname" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="prospect_name_div">
          <label for="exampleInputPassword1">Prospect Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="prospect_title" name="prospect_title">
              <option value="">-- Title --</option>
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="prospect_fname" name="prospect_fname" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="prospect_lname" name="prospect_lname" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile</label>
                <input type="text" id="mobile" name="mobile" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" id="email" name="email" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Website</label>
                <input type="text" id="website" name="website" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Annual Revenue</label>
                <input type="text" id="annual_revenue" name="annual_revenue" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Amount</label>
                <input type="text" id="quoted_value" name="quoted_value" class="form-control money" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Lead Source <a href="javascript:void(0)" class="lead_source-modal"> Add/Edit list</a></label>
                <select class="form-control select_title" id="lead_source" name="lead_source">
                  <option value="0">-- None --</option>
                  @if(isset($old_lead_sources) && count($old_lead_sources) >0)
                    @foreach($old_lead_sources as $key=>$lead_row)
                      <option value="{{ $lead_row['source_id'] }}">{{ $lead_row['source_name'] }}</option>
                    @endforeach
                  @endif
                  @if(isset($new_lead_sources) && count($new_lead_sources) >0)
                    @foreach($new_lead_sources as $key=>$lead_row)
                      <option value="{{ $lead_row['source_id'] }}">{{ $lead_row['source_name'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Industry</label>
              <select class="form-control select_title" id="industry" name="industry">
                <option value="0">-- None --</option>
                @if(isset($industry_lists) && count($industry_lists) >0)
                  @foreach($industry_lists as $key=>$industry_row)
                    <option value="{{ $industry_row['industry_id'] }}">{{ $industry_row['industry_name'] }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Street</label>
                <input type="text" id="street" name="street" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">City</label>
                <input type="text" id="city" name="city" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">County</label>
                <input type="text" id="county" name="county" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
         <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Country</label>
                <select class="form-control" name="country_id" id="country_id">
                @if(!empty($countries))
                  @foreach($countries as $key=>$country_row)
                  @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
                    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                  @endif
                  @endforeach
                @endif
                @if(!empty($countries))
                  @foreach($countries as $key=>$country_row)
                  @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
                    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                  @endif
                  @endforeach
                @endif
                </select>
              </div> 
          </div>
          <!--<div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile</label>
                <input type="text" id="" class="form-control" >
            </div>
          </div>-->
          <div class="clearfix"></div>
        </div>

        <div class="form-group" style="width:98%;">
          <label for="exampleInputPassword1">Notes</label>
          <textarea class="form-control" rows="4" name="notes" id="notes"></textarea>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Close Date</label>
                <input type="text" id="close_date" name="close_date" class="form-control" >
              </div> 
          </div>
          <!-- <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">City</label>
                <input type="text" id="city" name="city" class="form-control" >
            </div>
          </div> -->
          <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>
      </div>
      
      <div class="modal-footer clearfix" style="border-top: none; padding-top: 0;">
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-info pull-left save_t2">Save</button>
        </div>
      </div>
      {{ Form::close() }}
    
  </div>
  </div>
</div>
<!-- Send Template modal end -->

<!-- add/edit list -->
<div class="modal fade" id="addcompose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
    
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="org_name" name="org_name" placeholder="Business Type" class="form-control">
      </div>
      
      <div id="append_bussiness_type">
      @if( isset($old_org_types) && count($old_org_types) >0 )
        @foreach($old_org_types as $key=>$old_org_row)
        <div class="form-group">
          <label for="{{ $old_org_row->name }}">{{ $old_org_row->name }}</label>
        </div>
        @endforeach
      @endif

      @if( isset($new_org_types) && count($new_org_types) >0 )
        @foreach($new_org_types as $key=>$new_org_row)
        <div class="form-group" id="hide_div_{{ $new_org_row->organisation_id }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_org_name" data-field_id="{{ $new_org_row->organisation_id }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $new_org_row->name }}">{{ $new_org_row->name }}</label>
        </div>
        @endforeach
      @endif
      </div>
      
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_business_type" name="save">Save</button>
          <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- add/edit list -->
<div class="modal fade" id="lead_source-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD LEAD SOURCE</h4>
        <div class="clearfix"></div>
      </div>
    
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Lead Source</label>
        <input type="text" id="new_source" name="new_source" class="form-control">
      </div>
      
      <div id="append_new_source">
      @if( isset($old_lead_sources) && count($old_lead_sources) >0 )
        @foreach($old_lead_sources as $key=>$source_row)
        <div class="form-group">
          <label for="{{ $source_row['source_id'] }}">{{ $source_row['source_name'] }}</label>
        </div>
        @endforeach
      @endif
      @if( isset($new_lead_sources) && count($new_lead_sources) >0 )
        @foreach($new_lead_sources as $key=>$source_row)
        <div class="form-group" id="hide_div_{{ $source_row['source_id'] }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_source" data-field_id="{{ $source_row['source_id'] }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $source_row['source_name'] }}">{{ $source_row['source_name'] }}</label>
        </div>
        @endforeach
      @endif
      </div>
      
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_lead_source" name="save">Save</button>
          <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="lead_status-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">EDIT LEAD STATUS</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '', 'id'=>'field_form')) }}
      <div class="modal-body">
      <table class="table table-bordered table-hover dataTable add_status_table">
        <thead>
          <tr>
            <!-- <th align="center" width="20%">Show/Unshow</th> -->
            <th >Status Name</th>
            <th align="center">Action</th>
          </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($leads_tabs) && count($leads_tabs) >0)
            @foreach($leads_tabs as $key=>$value)
              <tr id="change_status_tr_{{ $value['tab_id'] or "" }}">
                <!-- <td align="center"><input type="checkbox" id="step_check_2{{ $value['tab_id']}}" class="status_check" {{ ($value['status'] == "S")?"checked":"" }} value="{{ $value['tab_id'] or "" }}" data-step_id="{{ $value['tab_id'] }}" {{ ((isset($value['count']) && $value['count'] !=0) || $value['tab_id'] == 10)?"disabled":"" }} /></td> -->
                <td><span id="status_span{{ $value['tab_id'] or "" }}">{{ $value['tab_name'] or "" }}</span></td>
                <td align="center"><span id="action_{{ $value['tab_id'] or "" }}"><a href="javascript:void(0)" class="edit_status" data-step_id="{{ $value['tab_id'] or "" }}"><img src="/img/edit_icon.png"></a></span></td>
              </tr>
            @endforeach
          @endif

        </tbody>
    
    </table>

        
      </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="full_address-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">FULL ADDRESS</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body" id="show_full_address">
        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="full_notes-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">NOTES</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body" id="show_full_notes">
        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- GRAPHS MODAL -->
<div class="modal fade" id="graphs-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:790px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">GRAPHS</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">From Date</label>
                <input type="text" id="from_date" name="from_date" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">To Date</label>
                <input type="text" id="to_date" name="to_date" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group">
          <input type="button" id="show_graph_button" class="btn btn-info" value="Show Graph">
        </div> 
        <div id="show_graph_loader" style="text-align: center;"></div>
        <div class="clearfix"></div>

        <div class="form-group" id="show_graph"></div>
         <div class="clearfix"></div>
      </div>
    
    </div>
  </div>
</div>

<!-- Add New Lead Start-->
<div class="modal fade" id="open_new_lead-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">NEW - LEAD ENQUIRY & PROSPECT</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/crm/save-new-leads')) }}
      <input type="hidden" name="encode_page_open" value="{{ $encode_page_open }}">
      <input type="hidden" name="encode_owner_id" value="{{ $encode_owner_id }}">
      <div class="modal-body">
        <div class="form-group" style="margin:0;">
            <div class="n_box12">
              <div class="form-group">
                <label for="exampleInputPassword1">Date</label>
                <input type="text" id="date" name="date" value="{{ $staff_row['date'] or '' }}" class="form-control">
              </div>
            </div>

          <div class="n_box11">
            <div class="form-group">
              <!-- <label for="deal_certainty">Deal Certainty</label>
              <input type="text" id="deal_certainty" name="deal_certainty" value="100" class="form-control box_60" maxlength="3"><span style="margin-top: 7px; float:left;">%</span> -->
            </div>
          </div>

          <div class="f_namebox2">
            <label for="exampleInputPassword1">Lead Owner</label>
              <select class="form-control" name="deal_owner" id="deal_owner">
                <option value="">-- None --</option>
                @if(isset($staff_details) && count($staff_details) >0)
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row['user_id'] }}">{{ $staff_row['fname'] or "" }} {{ $staff_row['lname'] or "" }}</option>
                  @endforeach
                @endif
             </select>
          </div>
          <!-- <div class="f_namebox3">
            <label for="exampleInputPassword1">Attach Opportunity to Existing Client</label>
            <select class="form-control" name="existing_client" id="existing_client">
              <option value="0">-- None --</option>
              
             </select>
          </div> -->
          <div class="clearfix"></div>
        </div>

        <div class="twobox" id="lead_org_name_div">
          <div class="twobox_1">
            <div class="form-group" style="width:57%">
              <label for="exampleInputPassword1">Business Type <a href="#" class="add_to_list" data-toggle="modal" data-target="#addcompose-modal"> Add/Edit list</a></label>
              <select class="form-control" name="business_type" id="business_type">
                @if( isset($old_org_types) && count($old_org_types) >0 )
                  @foreach($old_org_types as $key=>$old_org_row)
                  <option value="{{ $old_org_row->organisation_id }}">{{ $old_org_row->name }}</option>
                  @endforeach
                @endif

                @if( isset($new_org_types) && count($new_org_types) >0 )
                  @foreach($new_org_types as $key=>$new_org_row)
                  <option value="{{ $new_org_row->organisation_id }}">{{ $new_org_row->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
            
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Lead Name</label>
              <input type="text" class="form-control" name="prospect_name" id="prospect_name">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="lead_contact_name_div">
          <label for="exampleInputPassword1">Contact Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="contact_title" name="contact_title">
              <option value="">-- Title --</option>
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="contact_fname" name="contact_fname" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="contact_lname" name="contact_lname" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" id="lead_name_div">
          <label for="exampleInputPassword1">Lead Name</label>
          <div class="clearfix"></div>
          <div class="n_box1">
            <select class="form-control select_title" id="prospect_title" name="prospect_title">
              <option value="">-- Title --</option>
              @if(!empty($titles))
                @foreach($titles as $key=>$title_row)
                <option value="{{ $title_row->title_name }}">{{ $title_row->title_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="f_namebox">
            <input type="text" id="prospect_fname" name="prospect_fname" class="form-control" placeholder="First Name">
          </div>
          <div class="f_namebox">
            <input type="text" id="prospect_lname" name="prospect_lname" class="form-control" placeholder="Last Name">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile</label>
                <input type="text" id="mobile" name="mobile" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" id="email" name="email" class="form-control" >
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Website</label>
                <input type="text" id="website" name="website" class="form-control" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        
        <div class="twobox">
          <div class="twobox_1">
              <div class="form-group">
                <label for="exampleInputPassword1">Lead Source <a href="javascript:void(0)" class="lead_source-modal"> Add/Edit list</a></label>
                <select class="form-control select_title" id="lead_source" name="lead_source">
                  <option value="0">-- None --</option>
                  @if(isset($old_lead_sources) && count($old_lead_sources) >0)
                    @foreach($old_lead_sources as $key=>$lead_row)
                      <option value="{{ $lead_row['source_id'] }}">{{ $lead_row['source_name'] }}</option>
                    @endforeach
                  @endif
                  @if(isset($new_lead_sources) && count($new_lead_sources) >0)
                    @foreach($new_lead_sources as $key=>$lead_row)
                      <option value="{{ $lead_row['source_id'] }}">{{ $lead_row['source_name'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div> 
          </div>
          <div class="twobox_2">
            <div class="form-group">
              <label for="exampleInputPassword1">Industry</label>
              <select class="form-control select_title" id="industry" name="industry">
                <option value="0">-- None --</option>
                @if(isset($industry_lists) && count($industry_lists) >0)
                  @foreach($industry_lists as $key=>$industry_row)
                    <option value="{{ $industry_row['industry_id'] }}">{{ $industry_row['industry_name'] }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group" style="width:98%;">
          <label for="exampleInputPassword1">Notes</label>
          <textarea class="form-control" rows="4" name="notes" id="notes"></textarea>
        </div>

        

        <div class="clearfix"></div>
      </div>
      
      <div class="modal-footer clearfix" style="border-top: none; padding-top: 0;">
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-info pull-left save_t2">Save</button>
        </div>
      </div>
      {{ Form::close() }}
    
  </div>
  </div>
</div>
<!-- Add New Lead End-->

<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="add_close_date-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD CLOSE DATE</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div class="show_loader" style="text-align: center;"></div>
        <input type="hidden" name="add_date_leads_id" id="add_date_leads_id" />
        <input type="hidden" name="add_date_tab_id" id="add_date_tab_id" />
        <div class="form-group" style="width:100%;">
          <label for="exampleInputPassword1">Close Date</label>
          <input type="text" class="form-control close_date" name="add_close_date" id="add_close_date" />
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer clearfix" style="border-top: none; padding-top: 0;">
        <div class="email_btns">
          <button type="button" class="btn btn-danger pull-left save_t" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-info pull-left save_t2 save_close_date">Save</button>
        </div>
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="forecast-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:60%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
      <p id="businessname" align="center" style="margin: 17px 0px -31px 0px;font-size: 18px; font-weight: bold;color:#00acd6"></p>
      <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          <table width="100%" border="0" class="staff_holidays">
            <tr>
              <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="30%"><strong style="color: #00ccff; font-size: 20px;">ADD FORECAST VALUES</strong></td>
    <td width="30%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

              </td>
            </tr>
            <tr>
              <td valign="top">
			 
              
              
              
              
              
			   {{ Form::open(array('url' => '/insert-forecast')) }}
               
              <table width="100%" class="table table-bordered" id="BoxTable">
            <tbody>
              <!-- <tr class="table_heading_bg"> -->
              <input type="hidden" name="cid" id="c_id" value="">
              <tr>
                <td width="5%" align="center"id="allCheckSelect"> Delete</td>
                <td width="40%" align="center"><strong>Details</strong>
                
                </td>
                <!--<td width="20%" align="center"><strong>Client</strong></td>-->
                <td width="20%" align="center"><strong>Date</strong>
                </td>
                <td width="15%" align="center"><strong>Amount</strong></td>
                
              </tr>
              
              
              
              <tr id="TemplateRow" class="makeCloneClass">
              
              
              
                <td align="center">
                <a href="javascript:void(0)" class="delete_single_task DeleteBoxRow" data-client_id="" data-tab=""><img src="/img/cross.png"></a>
                </td>
                
                <td align="center" style="width:50%;">
                <input type="text" class="" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:374px; border-radius: 5px; height: 30px; ">
                </td>
             
                  
                <td align="center" style="width:20%;" >
                <input type="hidden" name="" id="date" value="" style="height: 30px;" >
                </td>
                <td align="center" id="" style="width:30%;">
                <input type="text" class="" value="" name="" id="" style="border: 1px solid #CCCCCC; color: #555555;  background: #fff; width:142px; border-radius: 5px; height: 30px; ">
                </td>
                
              </tr>
              
            </tbody>
          </table>
              </td>
            </tr>
          </table>
          <div class="save_btncon">
            <div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add New</p></button></div>




        <div class="right_side" style="padding-left: 10px;"> <button class="btn btn-info">Save</button></div>
        <div class="right_side" > <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>

          
          
            <div class="clearfix"></div>
            </div>
         
        </div>
        
        {{ Form::close() }}
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>  

@stop




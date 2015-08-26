@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="{{ URL :: asset('js/org_clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/relationship.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
var Table1, Table2, Table3;
$(function() {
//$(function() {
  Table1 = $('#example1').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "aLengthMenu": [[90], [90]],
        "iDisplayLength": 90,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },

      "aoColumns":[
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ]
    });
  Table1.fnSort( [ [2,'asc'] ] );

  Table2 = $('#example2').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
        "iDisplayLength": 10,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },

      "aoColumns":[
          {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
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
        ]

    });

   
   Table2.fnSort( [ [2,'asc'] ] );
   
   
  /* Table2 = $('#example2lmt').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
        "iDisplayLength": 10,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },

      "aoColumns":[
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ]

    });

   
   Table3.fnSort( [ [2,'asc'] ] );*/
   
  
  
  
});

$(function() {
     //alert('dsdsdsd')
     $('#staffmDetails').change(function() {
       
        var client_id = $(this).val();
       
       
        console.log(client_id);
        // alert(client_id)
        
        
        
         $.ajax({
                type: "GET",
                //dataType: "json",
                //url: '/client/client-details-by-client_id/'+client_id+"=ajax",
                url: "/getresponsibleperson",
               data: { 'client_id' : client_id },
                beforeSend: function() {
                   // $(".show_client_details").html('<img src="/img/spinner.gif" />');
                    //return false;
                },
                success : function(resp){
                    //var res = JSON.parse(resp);
                
                  console.log(resp);
                   if(resp!= "")
                  {
                    $("#resperson").html(resp);
                  }
                  else{
                    $("#resperson").html("");
                  }
                  
               /*  if(resp!= "") {
                    var res = JSON.parse(resp);
                    var vsl=res.field_value;
                   
                    $("#shentitlement").val(vsl);
                    
                    //alert(vsl);
                  // console.log(resp);
                }*/
               
                
                }
                
                
                
                
            });
        
        
        
        
        
        
        
        
        });
        
        
        
        $('#staffmDetailstab2').change(function() {
       
        var client_id = $(this).val();
       
       
        console.log(client_id);
        // alert(client_id)
        
        
        
         $.ajax({
                type: "GET",
                //dataType: "json",
                //url: '/client/client-details-by-client_id/'+client_id+"=ajax",
                url: "/getresponsibleperson",
               data: { 'client_id' : client_id },
                beforeSend: function() {
                   // $(".show_client_details").html('<img src="/img/spinner.gif" />');
                    //return false;
                },
                success : function(resp){
                    //var res = JSON.parse(resp);
                  console.log(resp);
                  
                  if(resp!= "")
                  {
                    $("#restab2").html(resp);
                  }
                  else{
                    $("#restab2").html("");
                  }
                  
                  
               /*  if(resp!= "") {
                    var res = JSON.parse(resp);
                    var vsl=res.field_value;
                   
                    $("#shentitlement").val(vsl);
                    
                    //alert(vsl);
                  // console.log(resp);
                }*/
               
                
                }
                
                
                
                
            });
        
        
        
        
        
        
        
        
        });

});

</script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
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
                <li class="active"><a data-toggle="tab" href="#tab_1">PAPER AUTHORISATIONS</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">ONLINE AUTHORISATIONS</a></li>
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
                        <div style="margin: 0 auto;">   
                            <div style="float: left; padding-left: 15px;"> <td width="15%"><a href="#"><img src="/img/download_fbi2.png" /></a>
                            </div>


                          
                          </div>
                        <div class="col-xs-12">
                          
                          <!--start table-->
                          
                         
                          
                          <!--end table-->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                  
  
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered "id="example1" aria-describedby="example1_info" >
   
  
  <thead>
    <th  align="center" class="padding_h"><input type="checkbox" /></th>
    <th  align="center" class="padding_h"><strong>NAME</strong></th>
    <th  align="center" class="padding_h"><strong>RESPONSIBLE PERSON</strong></th>
    <th align="center"><strong>SA/NI</strong></th>
    <th align="center"><strong>TC</strong></th>
    <th align="center"><strong>CT</strong></th>
    <th align="center"><strong>PAYE</strong></th>
      <th align="center"><strong>VAT</strong></th>
      <th align="center"><strong>DOWNLOAD</strong></th>
      
    </thead>
 
  <tbody>
  @if(!empty($client_details))
                
                
  <tr>
    <td align="center"><input type="checkbox" /></td>
    
   <!-- <td align="left"><a target="_blank" href="{{ $client_row['client_url'] or "" }}">{{ $client_row['client_name'] or "" }}</a></td>
    
    
    -->
    <td>
    <select class="form-control" id="staffmDetails">
                         @foreach($client_details as $key=>$client_row)
                         
                        <option value="{{ $client_row['client_id'] }}"> {{ $client_row['client_name'] }}</option>
                        @endforeach
    </select>
    
    </td>
    
    
    
    
    
    <td align="center" id="resperson">
        
    </td>
    
   
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><a href="#"><img src="/img/download_64.png" /></a></td>
    
      
    
    
  </tr>
 
            @endif
 </tbody>
</table>




               <!--   <div>
              <p class="btn btn-default">Client Time Report</p>
              
              <table class="table table-bordered table-hover dataTable" id="example3" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                                
                                <th align="center"><strong>Client</strong></th>
                                <th align="center"><strong>Service</strong></th>
                                <th align="center"><strong>From</strong></th>
                                <th align="center"><strong>To</strong></th>
                                <th><strong>Action</strong></th>
                                
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($client_time_report))
								  @foreach($client_time_report as $key=>$client_row)
								 <tr>
									
									
									<td  align="left">{{ $client_row['client_detail']['field_value'] }}</td>
									<td align="left">{{ $client_row['old_vat_scheme']['vat_scheme_name'] }}</td>
                                    <td align="center">{{ date("d-m-Y",strtotime($client_row['fromdate'])) }}</td>
                                    <td align="center">{{ date("d-m-Y",strtotime($client_row['todate'])) }}</td>
									<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $client_row['ctr_id'] }}" onclick="openeditctrModal('{{ $client_row['ctr_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
									</tr>
									</tr>
									@endforeach
								@endif
                                  
                              
                            </tbody>
                          </table>
            <p class="btn btn-default">Staff Time Report</p>  
              
              
              <table class="table table-bordered table-hover dataTable" id="example4" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                                
                                <th align="center"><strong>Staff</strong></th>
                                <th align="center"><strong>Client</strong></th>
                                <th align="center"><strong>From</strong></th>
                                <th align="center"><strong>To</strong></th>
                                <th><strong>Action</strong></th>
                                
                              </tr>
                            </thead>






                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($staff_time_report))
								  @foreach($staff_time_report as $key=>$staff_row)
								 <tr>
									
						<td align="center">{{ $staff_row['staff_detail']['fname'] }} {{ $staff_row['staff_detail']['lname'] }}</td>
									
									<td align="left">{{ $staff_row['client_detail']['field_value'] }}</td>
                                    <td align="center">{{ date("d-m-Y",strtotime($staff_row['fromdate'])) }}</td>
                                    <td align="center">{{ date("d-m-Y",strtotime($staff_row['todate'])) }}</td>
                                    
									<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $staff_row['str_id'] }}" onclick="openstaffModal('{{ $staff_row['str_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
									</tr>
									</tr>
									@endforeach
								@endif
                                  
                              
                            </tbody>
                          </table>
              </div> -->
                </div>
                
                <!-- /.tab-pane -->
                <div id="tab_2" class="tab-pane">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div style=" margin: 0 auto;">   
                            <div style="float: left; padding-left: 15px;"> <td width="15%"><a href="#"><img src="/img/download_fbi2.png" /></a>
                            </div>


                          
                          </div>
                        <div class="col-xs-12">
                          
                          <!--start table-->
                          
                         
                          
                          <!--end table-->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
						<?php 
						//echo '<pre>';
						//print_r($time_sheet_report);
							
						?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered "id="example2" aria-describedby="example2_info" >
   
  
  <thead>
    <th  align="center" class="padding_h"><input type="checkbox" /></th>
    <th  align="center" class="padding_h"><strong>NAME</strong></th>
    <th  align="center" class="padding_h"><strong>RESPONSIBLE PERSON</strong></th>
    <th align="center"><strong>SA/TC</strong></th>
    <th align="center"><strong>PAYE</strong></th>
    <th align="center"><strong>TC</strong></th>
    <th align="center"><strong>ERS</strong></th>
      <th align="center"><strong>CT</strong></th>
              <th align="center"><strong>VAT</strong></th>
      <th align="center"><strong>NOVA</strong></th>

              <th align="center"><strong>EU REFUNDS</strong></th>
      <th align="center"><strong>MOSS-US</strong></th>
      <th align="center"><strong>MOSS-NUS</strong></th>
      <th align="center"><strong>DOWNLOAD</strong></th>
      
    </thead>
 
  <tbody>
  @if(!empty($client_details))
                
                
  <tr>
    <td align="center"><input type="checkbox" /></td>
    
    
    <td>
    <select class="form-control" id="staffmDetailstab2">
                         @foreach($client_details as $key=>$client_row)
                        <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
                        @endforeach
    </select>
    
    </td>
    
  <!--  <td align="left"><a target="_blank" href="{{ $client_row['client_url'] or "" }}">{{ $client_row['client_name'] or "" }}</a></td> -->
    
    
    
    
    
    
    
    
    <td align="center" id="restab2">
       <!--  @if(isset($client_row['contact_name']) && count($client_row['contact_name']) >0)
                        <select class="form-control newdropdown">
                        @foreach($client_row['contact_name'] as $key=>$name_row)
                        <option>{{ $name_row['name'] }}</option>
                        @endforeach
                        </select>
                      @endif -->
    </td>
   
   <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><a href="#"><img src="/img/download_64.png" /></a></td>
    
      
    
    
  </tr>
 
            @endif
 </tbody>
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

@stop
<!-- time-->
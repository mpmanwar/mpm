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
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
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
            //{"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ]

    });
  Table1.fnSort( [ [2,'asc'] ] );

  Table2 = $('#example2').dataTable({
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
           // {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
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


/*$(document).ready(function(){
  $("#archivedButton").click(function(){
        var oSettings = oTable.fnSettings();
        oSettings._iDisplayLength = -1;
        oTable.fnDraw();
  })
})*/

$(function() {
    //attach the a function to the click event of the 
    //"Add Box Attribute" button that will add a new row
   var cloneCount = 0;
   
   
 	
    $('.addnew_line').click(function() {
		
				//alert('AAAAAAAAAAAA');	
				
				
                $(".dpick").datepicker("destroy");      
				
				
				
				var $newRow = $('#TemplateRow').clone(true);
   
            	$newRow.find('#date_picker').val('');
				$newRow.find('.dpick').val('');
        		$newRow.find('#staff_id').val('');
                $newRow.find('#rel_client_id').val('');
				$newRow.find('#vat_scheme_type').val('');
				$newRow.find('#hrs').val('');
				$newRow.find('#notes').val('');
        		//strip the IDs from everything to avoid DOM issues
        		//$newRow.find('*').andSelf().removeAttr('id');
				//var row = $("#BoxTable tr:last").clone().prop('id', 'date' + cloneCount);
				var noOfDivs = $('.makeCloneClass').length + 1;
				 $newRow.find('input[type="text"]').attr('id', 'dpick'+ noOfDivs);
				//cloneCount++;
				//alert('#dpick'+ noOfDivs);
				$('#BoxTable tr:last').after($newRow);
				//$newRow.find('#date_picker').datepicker({dateFormat: 'dd-mm-yy'});
				//$('#dpick1').datepicker({dateFormat: 'dd-mm-yy'}); 
				//$('#dpick'+ noOfDivs).datepicker({dateFormat: 'dd-mm-yy'});  
				
				/*$('.dpick').each(function(index,value){
			  			var num = parseInt(index)+1;
						console.log(num);
						 $('#dpick'+ num).datepicker({dateFormat: 'dd-mm-yy'});  
			  });*/
				 
				 
				 $(".dpick").datepicker({dateFormat: 'dd-mm-yy'});    
				return false;
			
	})
$(function() {
            $(".dpick").datepicker({dateFormat: 'dd-mm-yy'});
			  
});	
$(function() {
                $("#eddpick").datepicker({dateFormat: 'dd-mm-yy'});
});
	// "remove row" check box
    $('.DeleteBoxRow').click(function() {
    
    //find the closest parent row and remove it
	var size = $(".DeleteBoxRow").size();
		if(size>1){
        	$(this).closest('tr').remove();
		}
    });
	
})

	/*$('body').on('focus',".txtbox", function(){
    		$(this).datepicker();
		});*/
	function openModal(timesheet_id) {

	//$('#edit-modal').modal('show');

	console.log(timesheet_id);

	$.ajax({

		type: "POST",

		//dataType: "html",

		url: '/timesheet/timesheet-templates',

		data: {

			'timesheet_id': timesheet_id

		},

		success: function(resp) {

			console.log(resp);

			// console.log("asdfhsdaghfjksdagkf")

			$("#compose-edit-modal").modal("show");
			//alert(resp.created_dates);
			   var dateAr = resp.created_date.split('-');
			   var date_string = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
               
				//var date_string = moment(resp.created_date, "DD.MM.YYYY").format("DD-MM-YYYY");
				$('#eddpick').val(date_string);
				$('#staff_id_edit').val(resp.staff_id);
				$('#rel_client_id_edit').val(resp.rel_client_id);
				$('#vat_scheme_types').val(resp.vat_scheme_type);
				$('#editid').val(resp.timesheet_id);


				$('#hrs').val(resp.hrs);
				$('#notes').val(resp.notes);
                $('#notesedit').val(resp.notes);



			//	$('#edit_notice_template_id').val(resp['edit_notice_template_id']);

			

			//CKEDITOR.instances['edit_message'].setData(resp['message']);

			// $("#compose-modal").modal("toggle");

			//$('#modal').modal();

		}

	});

}

function editnotesmodal(){
   // var editnotesval= $("#notes").val();
   // console.log(editnotesval);
   // $("#notesedit").val(editnotesval);
    
    $("#compose-edit-modal").modal("hide");
    
}

//var editnotesval= $("#notes").val();
function editnotes(){
    
    var editnotesval= $("#notes").val(); 
    
    console.log(editnotesval);
    
    $("#notesedit").val(editnotesval);

    $("#composeeditnotes-modal").modal("hide");
    $("#compose-edit-modal").modal("show");
    
}

function notesmodal(){
    $("#compose-modal").modal("hide");
}

function notes(){
    //console.log('dklfjsdkf');
    
   var notesval= $("#notess").val();
   
   //$("#compose-modal").modal("hide");
   //$("#compose-modal").modal("hide");
  
   $('#notes12').val(notesval);
   $("#composenotes-modal").modal("hide");
  
   $("#compose-modal").modal("show");
    console.log(notesval);
    //alert('return_notes');
}


function openeditctrModal(ctr_id) {
    
    
    $.ajax({
    	type: "POST",
        //dataType: "html",
        url: '/timesheet/fetcheditclient-time-sheet',
        data: {

			'ctr_id': ctr_id

		},

		success: function(resp) {
		  
        
           var clientfromdate = resp.fromdate.split('-');
	       var date_from = clientfromdate[2] + '-' + clientfromdate[1] + '-' + clientfromdate[0];
           
           var clienttodate = resp.todate.split('-');
           var date_to = clienttodate[2] + '-' + clienttodate[1] + '-' + clienttodate[0];
               
          
		  $("#composeeditclienttr-modal").modal("show");
          
          
            	$('#ctredit_client').val(resp.ctr_client);
                $('#ctredit_serv').val(resp.ctr_serv);
                $('#editfromdpick').val(date_from);
                
                $('#edittodpick').val(date_to);
                $('#editctrid').val(resp.ctr_id);
                
                
                
           // alert(resp);
           
			console.log(resp);

				}

	});
    
    
    
    
    
    
    console.log(ctr_id);
   
}
function openstaffModal(str_id) {
    
    
    
    
    
     $.ajax({
    	type: "POST",
        //dataType: "html",/timesheet/fetcheditstaff-time-sheet
        url: '/timesheet/fetcheditstaff-time-sheet',
        data: {

			'str_id': str_id

		},

		success: function(resp) {
		  
        
          var stafffromdate = resp.strfromdate.split('-');
	       var strdate_from = stafffromdate[2] + '-' + stafffromdate[1] + '-' + stafffromdate[0];
           
           var stafftodate = resp.strtodate.split('-');
           var strdate_to = stafftodate[2] + '-' + stafftodate[1] + '-' + stafftodate[0];
          
          
		  $("#composeditestr-modal").modal("show");
          
          
          $('#editstr_client').val(resp.str_client);
           $('#editstr_staff').val(resp.str_staff);
            $('#editstrfromdate').val(strdate_from);
             $('#editstrtodate').val(strdate_to);
             $('#editstrid').val(resp.str_id);
             
           
            
             
          
          
            	
                
                
           // alert(resp);
           
			console.log(resp);

				}

	});
    
     //$("#composeditestr-modal").modal("show");
    
    
    console.log(str_id);
    
}

function lmtdelfun($del_id)
{
    var delid=$del_id;
    console.log(delid);
    if (confirm("Do you want to delete ?")) {
    $.ajax({
    	type: "POST",
        //dataType: "html",/timesheet/fetcheditstaff-time-sheet
        url: '/timesheet/delete-time-sheet',
        data: {

			'delid': delid

		},

		success: function(resp) {
		  
                   window.location='/time-sheet-reports/c3RhZmY=';
			console.log(resp);

				}

	});
    }
    
    
}

function clientdisplay(){
    
    var ctr_client= $("#ctr_client").val();
    
    var ctr_serv = $("#ctr_serv").val();
    
    var fromdpick2= $("#fromdpick2").val();
    
    var todpick = $("#todpick").val();
    
    
    console.log(ctr_client);
    console.log(ctr_serv);
    console.log(fromdpick2);
    console.log(todpick);
    

    if(fromdpick2!="" && todpick!="" && ctr_client!="" ){
        
  

    $.ajax({
    	type: "POST",
        //dataType: "html",/timesheet/fetcheditstaff-time-sheet
        url: '/timesheet/insertclient-time-sheet',
        data: {

			'ctr_client': ctr_client,'ctr_serv': ctr_serv,'fromdpick2': fromdpick2,'todpick': todpick

		},

		success: function(resp) {
		  
        
               // alert(resp);
           
			console.log(resp);
            if(resp){
                $("#dropctr").html(resp);
            }
            else{
                $("#dropctrerror").html('<span style="color:red">No Records Found</span>');
            }

				}

	});  
    }else{
        
        $("#dropctrerror").html('<span style="color:red">Please Select Fields</span>');
    }





}

function staffdisplay(){
    
     var str_staff= $("#str_staff").val();
    
    var str_client = $("#str_client").val();
    
    var strdpick2= $("#strdpick2").val();
    
    var dpickclient = $("#dpickclient").val();
    
    
    console.log(str_staff);
    console.log(str_client);
    console.log(strdpick2);
    console.log(dpickclient);
    
    if(strdpick2!="" && dpickclient!="" && str_client!="" ){
     $.ajax({
    	type: "POST",
        //dataType: "html",/timesheet/fetcheditstaff-time-sheet
        url: '/timesheet/insertstaff-time-sheet',
        data: {

			'str_staff': str_staff,'str_client': str_client,'strdpick2': strdpick2,'dpickclient': dpickclient

		},

		success: function(resp) {
		  
        
               // alert(resp);
           
			console.log(resp);
            if(resp){
                $("#dropstr").html(resp);
            }
            else{
                $("#dropstrerror").html('<span style="color:red">No Records Found</span>');
            }
            //$("#dropstr").html(resp);

				}

	});
    }else{
         $("#dropstrerror").html('<span style="color:red">Please Select Fields</span>');
    }
    
    
    
    
}

$("#clienttimereset").click(function(){
    
    //alert('sgsgsgs');
    $("#ctr_client").val("");
    $("#ctr_serv").val("");
    $("#fromdpick2").val("");
    $("#todpick").val("");
    $("#dropctr").html("");
    $("#dropctrerror").html("");
 
});

$("#stafftimereset").click(function(){
    
    //alert('sgsgsgs');
    $("#str_staff").val("");
    $("#str_client").val("");
    $("#strdpick2").val("");
    $("#dpickclient").val("");
    $("#dropstr").html("");
    $("#dropstrerror").html("");
 
});


function fetchnotesmodal(value){
    
    var notesvalue=value;
    //alert(notesvalue);
    console.log(notesvalue);
    $("#fetchnotess").val(notesvalue);
    $("#fetchcomposenotes-modal").modal("show");
    
    
}
function fontfetchnotesmodal(fontvalue){
    
    var fontnotesvalue=fontvalue;
    //alert(notesvalue);
    console.log(fontnotesvalue);
    $("#fontfetchnotess").val(fontnotesvalue);
    
    $("#fontfetchcomposenotes-modal").modal("show");
}



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
          <div class="top_buttons">
            <div class="top_bts">
              <ul>
               <!-- <li>
                  <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                </li> -->
                <li>
                  <!-- <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button> -->
                  
                  <a href="/timesheetpdf" class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</a>
                  
                  
                </li>
                <li>
                <a href="/timesheetexcel" class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</a>
                
                 <!--  <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button> -->
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">RECENT TIME SHEET</a></li>
                <li class=""><a data-toggle="tab" href="#tab_2">TIME SHEET LOG</a></li>
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
                        <div style="width:35%; margin: 0 auto;">
                            <div style="float: left; padding-right: 10px;"><button class="btn btn-default" data-toggle="modal" data-target="#compose-modal"><span class="requ_t">New Time Sheet</span></button></div>

                            <div style="float: left; padding-right: 10px;">
                           
                           <!-- <button class="btn btn-default" id="clienttimereset" data-toggle="modal" data-target="#composeclienttr-modal" >Client Time Report</button> -->
                            <a class="btn btn-default" href='/timesheet/client-timereport' target="_blank">
                            Client Time Report </a>
                            
                            </div>

                            <div style="float: left;">
                            
                          <!--  <button class="btn btn-default" id="stafftimereset" data-toggle="modal" data-target="#composestr-modal" ><span class="decline_t">Staff Time Report</span></button> -->
                            <a class="btn btn-default" href='/timesheet/staff-timereport' target="_blank">
                           <span class="decline_t">Staff Time Report</span> </a>
                            
                            </div>
                          
                          </div>
                        <div class="col-xs-12">
                          
                          <!--start table-->
                          
                          <!--<table class="table table-bordered table-hover dataTable" id="example1" aria-describedby="example1_info">
            
                            <thead>
                              <tr role="row">
                                <th align="center"><input type="checkbox" id="allCheckSelect"/></th>
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th><strong>Service</strong></th>
                                <th><strong>HRS</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                              <tr>
                                <td><input type="checkbox" /></td>
                                <td align="left"><input type="text" placeholder="dd/mm/yy">
                                  AM - HALF DAY</td>
                                <td align="center">fdfwef</td>
                                <td align="center">wqefef</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center"><a href="#"><img src="/img/edit_icon.png" width="15"></a>
                                  <a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                              </tr>
                              
                            </tbody>
                          </table> -->
                          
                          <!--end table-->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end table-->
                  
                  <table class="table table-bordered table-hover dataTable" id="example1" aria-describedby="example1_info">
            
                            <thead>
                              <tr role="row">
                              <!-- <th align="center"><input type="checkbox" id="allCheckSelect"/></th> -->
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th align="left"><strong>Service</strong></th>
                                <th><strong>Hrs</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($time_sheet_reportlmt))
								  @foreach($time_sheet_reportlmt as $key=>$staff_row)
								 <tr>
								<!--	<td align="center"><input type="checkbox" /></td> -->
									<td align="center">{{ $staff_row['created_date'] }}</td>
									<td align="center">{{ $staff_row['staff_detail']['fname'] }} {{ $staff_row['staff_detail']['lname'] }}</td>
									<td  align="left">{{ $staff_row['client_detail']['field_value'] }}</td>
									<td align="left">{{ $staff_row['old_vat_scheme']['vat_scheme_name'] }}</td>
									<td align="center">{{ number_format((float)$staff_row['hrs'], 1, '.', '')  }}</td>
									<td align="center"> <!--{{ $staff_row['notes'] }} -->
                                    
                                    @if(empty($staff_row['notes']))
                                    
                                    <a href="javascript:void(0)" onclick="return fontfetchnotesmodal('{{ $staff_row['notes'] }}')" data-toggle="modal" data-target="#fontfetchcomposenotes-modal"><span class="notes_btn">Notes</span></a>
                                    @endif
                                     
                                    
                                    
                                   @if(!empty($staff_row['notes']))
                                    
                                    
                                    <a href="javascript:void(0)" onclick="return fontfetchnotesmodal('{{ $staff_row['notes'] }}')" data-toggle="modal" data-target="#fontfetchcomposenotes-modal"><span style="border-bottom:3px dotted #3a8cc1 !important" class="notes_btn">Notes</span></a>
                                    
                                     
                                   @endif
                                    </td>
									<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $staff_row['timesheet_id'] }}" onclick="openModal('{{ $staff_row['timesheet_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
                                    <a href="#" onClick="return lmtdelfun('{{ $staff_row['timesheet_id'] }}')"  ><img src="/img/cross.png" width="15" ></a>
									</tr>
									@endforeach
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
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
						<?php 
						//echo '<pre>';
						//print_r($time_sheet_report);
							
						?>
                          <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                              <!-- <th align="center"><input type="checkbox" id="allCheckSelect"/></th> -->
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th align="center"><strong>Service</strong></th>
                                <th><strong>Hrs</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($time_sheet_report))
								  @foreach($time_sheet_report as $key=>$staff_row)
								 <tr>
								<!--	<td align="center"><input type="checkbox" /></td> -->
									<td align="center">{{ $staff_row['created_date'] }}</td>
									<td align="center">{{ $staff_row['staff_detail']['fname'] }} {{ $staff_row['staff_detail']['lname'] }}</td>
									<td  align="center">{{ $staff_row['client_detail']['field_value'] }}</td>
									<td align="center">{{ $staff_row['old_vat_scheme']['vat_scheme_name'] }}</td>
									<td align="center">{{   number_format((float)$staff_row['hrs'], 1, '.', '')   }}</td>
								
                                
                                	<td align="center">
                                    
                                   
                                    
                                    @if(empty($staff_row['notes']))
                                     <a href="javascript:void(0)" onclick="return fetchnotesmodal('{{ $staff_row['notes'] }}')" data-toggle="modal" data-target="#fetchcomposenotes-modal"><span class="notes_btn">Notes</span>
                                    </a>
                                    @endif
                                    @if(!empty($staff_row['notes']))
                                    
                                    <a href="javascript:void(0)" onclick="return fetchnotesmodal('{{ $staff_row['notes'] }}')" data-toggle="modal" data-target="#fetchcomposenotes-modal"><span style="border-bottom:3px dotted #3a8cc1 !important" class="notes_btn">Notes</span>
                                    </a>
                                   
                                   @endif
                                    
                                    </td>
									<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $staff_row['timesheet_id'] }}" onclick="openModal('{{ $staff_row['timesheet_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
                                    <a href="#" onClick="return lmtdelfun('{{ $staff_row['timesheet_id'] }}')"  ><img src="/img/cross.png" width="15" ></a>
									</tr>
									@endforeach
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

<!-- COMPOSE EDIT MESSAGE MODAL -->
<div class="modal fade" id="compose-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
      
      <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          <table width="100%" border="0" class="staff_holidays">
            <tr>
              <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%"><strong>NEW TIME SHEET</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

              </td>
            </tr>
            <tr>
              <td valign="top">
			  <?php 
			  		
					//echo '<pre>';
					//print_r($staff_details);
			  
			  ?>
			   {{ Form::open(array('url' => '/timesheet/edit-time-sheet')) }}
              <table width="100%" class="table table-bordered" >
            <tbody>
              <!-- <tr class="table_heading_bg"> -->
              <tr>
                <td width="20%"><strong>Date</strong></td>
                <td width="20%" align="center"><strong>Staff Name</strong></td>
                <td width="20%" align="center"><strong>Client Name</strong></td>
                <td width="20%" align="center"><strong>Service</strong>  <!--Add/Edit list--></td>
                <td width="6%" align="center"><strong>Hrs</strong></td>
                <td width="14%" align="center"><strong>Notes</strong></td>
              </tr>
              <tr >
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15" id="date_picker" ></a>
				<input class="dpick" type="text" id="eddpick" name="date" size="10" style="width:86%; height: 33px;"/>
				<input type="hidden" id="editid" name="editid" value="" />
				</td>
                <td align="center">
                <select class="form-control" name="staff_id" id="staff_id_edit">
              <option value="">None</option>
                @if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
              </select>
              
              </td>
                <td align="center">
				<select class="form-control" name="rel_client_id" id="rel_client_id_edit">
				<option value="">None</option>
					@if(isset($allClients) && count($allClients)>0)
					  @foreach($allClients as $key=>$client_row)
						
						  <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
					
					  @endforeach
					@endif
          </select>
		  </td>
                <td align="center"><select class="form-control" name="vat_scheme_type" id="vat_scheme_types">
                                    <option value="">None</option>
                                    
                                    @if( isset($old_vat_schemes) && count($old_vat_schemes)>0 )
                                      @foreach($old_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                                    
                                    @if( isset($new_vat_schemes) && count($new_vat_schemes)>0 )
                                      @foreach($new_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                                   
                                  </select></td>
                <td align="center"><input type="text" name="hrs" id="hrs" style="width:90%; height: 33px;"></td>
                <td align="center">
                
                <button class="btn btn-default" onclick="return editnotesmodal()" data-toggle="modal" data-target="#composeeditnotes-modal"><span class="requ_t">Notes</span></button> 
                 <!--<input type="hidden" name="notes[]" id="notes12" value=""> -->

                <input type="hidden" name="notes" id="notesedit" style="width:90%; height: 33px;">
                
                </td>
              </tr>
              <!--<tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>-->
              <!--<tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>-->
              <!-- <tr>
                <td align="left" colspan="5"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></td>
                <td align="center"><button class="btn btn-primary">Submit</button></td>
              </tr> -->
            </tbody>
          </table>
              </td>
            </tr>
          </table>
          <div class="save_btncon">
            <div class="left_side"><!--<button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button>--></div>
            <div class="right_side"> <button class="btn btn-primary">Submit</button></div>
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



<!-- composeclienttr -->
<div class="modal fade" id="composeclienttr-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:56%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
     <!--  {{ Form::open(array('url' => '/timesheet/insertclient-time-sheet')) }} -->
      <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <div class="popupclienttime">
          
          <input type="hidden" name="type" id="ctr" value="client_tr">
             
                 <p class="clnt_con">CLIENT TIME REPORT</p>
             
              <div class="selec_seclf">
          
                  <span class="slct_con">Select Client</span>
                  
                       <select class="form-control2 newdropdown" name="ctr_client" id="ctr_client">
    				<option value="">None</option>
    					@if(isset($allClients) && count($allClients)>0)
    					  @foreach($allClients as $key=>$client_row)
    						
    						  <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
    					
    					  @endforeach
    					@endif
                       </select>
                     
                  <div class="clr"></div>
          
              </div>
              
              <div class="selec_seclf_r">
          
                  <span class="slct_con">Select Service</span>
                  
                       <select class="form-control2 newdropdown" name="ctr_serv" id="ctr_serv">
    				<option value="">None</option>
    					@if( isset($old_vat_schemes) && count($old_vat_schemes)>0 )
                                      @foreach($old_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                       </select>
                     
                  <div class="clr"></div>
          
          
              </div>
              <div class="clr"></div>
              
              <div class="select_con1">
              <div class="selec_seclf2">
                    <span class="slct_con"><strong>Display activity from</strong></span>
                  <input class="dpick dpick1" type="text" id="fromdpick2" name="fromdate"  />
              </div>
            <div class="selec_seclf3" >
                    <span class="slct_con"><strong>to</strong></span>
                  <input class="dpick dpick1" type="text" id="todpick" name="todate"  />
                  <button class="clnt_button" id="client_display" onclick="return clientdisplay()">Display</button>   
              </div></div>
              
              
              <div class="clr"></div>
              <div id="dropctr">
              </div>
              <div class="clr"></div>
              <div id="dropctrerror" style="text-align: center; padding: 20px 10px 10px 10px; ">
              </div>
          </div>
          </div>
        
      <!--  {{ Form::close() }} -->
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- composeclienttr -->

<!--composeeditclienttr edit -->
<div class="modal fade" id="composeeditclienttr-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:56%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
       {{ Form::open(array('url' => '/timesheet/editclient-time-report')) }}
      <div class="modal-body">
      
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <div class="popupclienttime">
          
          <input type="hidden" name="type" id="ctr" value="client_tr">
                 <p class="clnt_con">EDIT CLIENT TIME REPORT</p>
             
             
             <input type="hidden" id="editctrid" name="editctrid" value="" />
             
              <div class="selec_seclf">
          
          
          
                  <span class="slct_con">Select Client</span>
                  
                       <select class="form-control2 newdropdown" name="ctredit_client" id="ctredit_client">
    				<option value="">None</option>
    					@if(isset($allClients) && count($allClients)>0)
    					  @foreach($allClients as $key=>$client_row)
    						
    						  <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
    					
    					  @endforeach
    					@endif
                       </select>
                     
                  <div class="clr"></div>
          </div>
              
              
              
              <div class="selec_seclf_r" >
          
                  <span class="slct_con">Select Service</span>
                  
                       <select class="form-control2 newdropdown" name="ctredit_serv" id="ctredit_serv">
    				<option value="">None</option>
    					@if( isset($old_vat_schemes) && count($old_vat_schemes)>0 )
                                      @foreach($old_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                       </select>
                     
                  <div class="clr"></div>
          
          
              </div>
              <div class="clr"></div>
              
              
              
              
              <div class="select_con1">
              <div class="selec_seclf2" >
                    <span class="slct_con"><strong>Display activity from</strong></span>
                  <input class="dpick dpick1" type="text" id="editfromdpick" name="editfromdpick"  />
                  <div class="clr"></div>
              </div>
              
              
              
              <div class="selec_seclf3" >
                    <span class="slct_con"><strong>to</strong></span>
                  <input class="dpick dpick1" type="text" id="edittodpick" name="edittodpick"  />
                  <button class="clnt_button">Display</button>   
                  <div class="clr"></div>
              </div> 
              </div>
              
              <div class="clr"></div>
          </div>
          </div>
        
        {{ Form::close() }}
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--composeeditclienttr edit -->


<!-- strmodal -->
<div class="modal fade" id="composestr-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:56%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
    <!--  {{ Form::open(array('url' => '/timesheet/insertstaff-time-sheet')) }} -->
      
        <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <div class="popupclienttime">
          
          <input type="hidden" name="type" id="str" value="staff_tr">
                 <p class="clnt_con">STAFF TIME REPORT</p>
                 
              <div class="selec_seclf">
          
                  <span class="slct_con">Select Staff</span>
                  
                       <select class="form-control2 newdropdown" name="str_staff" id="str_staff">
    				<option value="">None</option>
    					@if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
                       </select>
                     
                  <div class="clr"></div>
                    </div>
                    
              <div class="selec_seclf_r">
              
                <span class="slct_con">Select Client</span>
                 <select class="form-control2 newdropdown" name="str_client" id="str_client">
    				<option value="">None</option>
    					@if(isset($allClients) && count($allClients)>0)
					       @foreach($allClients as $key=>$client_row)
						      <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
					       @endforeach
					   @endif
                </select>
                   <div class="clr"></div>
                   
                   
                   
            </div>
              <div class="clr"></div>
              
              
              
              
              <div class="select_con1">
              <div class="selec_seclf2" >
          
                  <span class="slct_con"><strong>Display activity from</strong></span>
                  <input class="dpick dpick1" type="text" id="strdpick2" name="strfromdate"  />
                    <div class="clr"></div>
                </div>
              
              
              
              <div class="selec_seclf3" >
          
                  <span class="slct_con"><strong>to</strong></span>
                  <input class="dpick dpick1" type="text" id="dpickclient" name="strtodate"  />
                   <button class="clnt_button" onclick="return staffdisplay()">Display</button>   
                   <div class="clr"></div>
          
          
              </div>
              
              </div>
              <div class="clr"></div>
          
          <div id="dropstr" ></div>
          <div class="clr"></div>
          
           <div id="dropstrerror" style="text-align: center; padding: 20px 10px 10px 10px;" ></div>
           
          
          </div>
          
          
         
          
          
         
        </div>
      <!--  {{ Form::close() }} -->
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- strmodal -->



<!-- strmodaledit -->
<div class="modal fade" id="composeditestr-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:56%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
      {{ Form::open(array('url' => '/timesheet/editstaff-time-report')) }}
      
        <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <div class="popupclienttime">
          <input type="hidden" name="editstrid" id="editstrid" value="">
                 <p class="clnt_con">EDIT STAFF TIME REPORT</p>
             
              <div class="selec_seclf">
          
                  <span class="slct_con">Select Staff</span>
                  
                       <select class="form-control2 newdropdown" name="editstr_staff" id="editstr_staff">
    				<option value="">None</option>
    					@if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
                       </select>
                     
                  <div class="clr"></div>
                    </div>
              <div class="selec_seclf_r">
                <span class="slct_con">Select Client</span>
                 <select class="form-control2 newdropdown" name="editstr_client" id="editstr_client">
    				<option value="">None</option>
    					@if(isset($allClients) && count($allClients)>0)
					       @foreach($allClients as $key=>$client_row)
						      <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
					       @endforeach
					   @endif
                </select>
                     
                  <div class="clr"></div>
            </div>
              <div class="clr"></div>
              
              
              
              
              <div class="select_con1">
              <div class="selec_seclf2">
          
                  <span class="slct_con"><strong>Display activity from</strong></span>
                  <input class="dpick dpick1" type="text" id="editstrfromdate" name="editstrfromdate"  />
                    <div class="clr"></div>
                </div>
              
              
              
              <div class="selec_seclf3">
          
                  <span class="slct_con"><strong>to</strong></span>
                  <input class="dpick dpick1" type="text" id="editstrtodate" name="editstrtodate"  />
                   <button class="clnt_button">Display</button>   
                   <div class="clr"></div>
          
          
              </div>
              </div>
              <div class="clr"></div>
          
          
          
          
          
          </div>
          
          
         
          
          
         
        </div>
        {{ Form::close() }}
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- strmodal -->



<div>
<div class="modal fade" id="composenotes-modal" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:36%;">
    
    <div class="modal-content">
     
      
      <div class="modal-body">
      <button class="close save_btn" aria-hidden="true" data-dismiss="modal" type="button">x</button>
     
      <div style="width:100%;">
             <label for="f_name" style="font-size: 18px;">Notes</label>
             
          <textarea rows="4" cols="50"  name="notes1[]" id="notess" value="" ></textarea>
         
         
          <button class="btn btn-primary" onclick="return notes()" id="save_notes" style=" padding:4px 20px; text-align: center; margin-top: 15px; float: right; margin-right: 6%; ">Save</button>   
          <div class="clr"></div>       
         </div>
        </div>
        
       
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</div>

<!-- fetchcomposenotes-modal-->
<div>
<div class="modal fade" id="fetchcomposenotes-modal" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:36%;">
    
    <div class="modal-content">
     
      
      <div class="modal-body">
      <button class="close save_btn" aria-hidden="true" data-dismiss="modal" type="button">x</button>
     
      <div style="width:100%;">
             <label for="f_name" style="font-size: 18px;">Notes</label>
             
          <textarea rows="4" cols="50"  name="notes1[]" id="fetchnotess" value="" ></textarea>
         
         
     <!--     <button class="btn btn-primary" onclick="return fetchnotes()" id="fetchsave_notes" style=" padding:4px 20px; text-align: center; margin-top: 15px; float: right; margin-right: 6%; ">Save</button> -->  
          <div class="clr"></div>       
         </div>
        </div>
        
       
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</div>
<!-- fetchcomposenotes-modal -->


<!-- fontfetchcomposenotes-modal-->
<div>
<div class="modal fade" id="fontfetchcomposenotes-modal" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:36%;">
    
    <div class="modal-content">
     
      
      <div class="modal-body">
      <button class="close save_btn" aria-hidden="true" data-dismiss="modal" type="button">x</button>
     
      <div style="width:100%;">
             <label for="f_name" style="font-size: 18px;">Notes</label>
             
          <textarea rows="4" cols="50"  name="notes1[]" id="fontfetchnotess" value="" ></textarea>
         
         
     <!--     <button class="btn btn-primary" onclick="return fetchnotes()" id="fetchsave_notes" style=" padding:4px 20px; text-align: center; margin-top: 15px; float: right; margin-right: 6%; ">Save</button> -->  
          <div class="clr"></div>       
         </div>
        </div>
        
       
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</div>
<!-- fontfetchcomposenotes-modal -->

<!-- edit notes-->
<div style="z-index: 999;">
<div class="modal fade" id="composeeditnotes-modal" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:36%;">
    <div class="modal-content" >
     
      
      <div class="modal-body">
      <button class="close save_btn" aria-hidden="true" data-dismiss="modal" type="button">x</button>
      <div style="width:100%;">
             <label for="f_name" style="font-size: 18px;">Notes</label>
             
          <!-- <input type="text" name="notes1[]" id="notess" value="" style="padding: 5px 5px;"> -->
          <textarea rows="4" cols="50" name="notes" id="notes" ></textarea>
          
        <!--  <input type="text" name="notes1[]" id="editnotess" value="" style="padding: 5px 5px;"> -->
         
          <button class="btn btn-primary" onclick="return editnotes()" id="save_notes" style="padding:4px 20px; text-align: center; margin-top: 15px; float: right; margin-right: 6%;">Save</button>  
          <div class="clr"></div>        
         </div>
        </div>
        
       
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</div>
<!-- edit notes -->

<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD COURSE</h4>
        <div class="clearfix"></div>
      </div>-->
      <!--<form action="#" method="post">-->
      
      <div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          <table width="100%" border="0" class="staff_holidays">
            <tr>
              <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%"><strong>NEW TIME SHEET</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

              </td>
            </tr>
            <tr>
              <td valign="top">
			  <?php 
			  		
					//echo '<pre>';
					//print_r($staff_details);
			  
			  ?>
			   {{ Form::open(array('url' => '/timesheet/insert-time-sheet')) }}
              <table width="100%" class="table table-bordered" id="BoxTable">
            <tbody>
              <!-- <tr class="table_heading_bg"> -->
              <tr>
                <td width="20%" align="center"><strong>Date</strong></td>
                <td width="20%" align="center"><strong>Staff Name</strong></td>
                <td width="20%" align="center"><strong>Client Name</strong></td>
                <td width="20%" align="center"><strong>Service</strong> <a href="#" class="add_to_list" data-toggle="modal" data-target="#vatScheme-modal">Add/Edit List</a></td>
                <td width="6%" align="center"><strong>Hrs</strong></td>
                <td width="14%" align="center"><strong>Notes</strong></td>
              </tr>
              <tr id="TemplateRow" class="makeCloneClass">
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15" id="date_picker"  class="DeleteBoxRow" ></a>
				<input class="dpick" type="text" id="dpick1" name="date[]"  style="width:86%; height: 33px;"/>
				</td>
                <td align="center"><select class="form-control" name="staff_id[]" id="staff_id">
              <option value="">None</option>
                @if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
              </select></td>
                <td align="center">
				<select class="form-control" name="rel_client_id[]" id="rel_client_id">
				<option value="">None</option>
					@if(isset($allClients) && count($allClients)>0)
					  @foreach($allClients as $key=>$client_row)
						
						  <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
					
					  @endforeach
					@endif
          </select>
		  </td>
                <td align="center"><select class="form-control" name="vat_scheme_type[]" id="vat_scheme_type">
                                    <option value="">None</option>
                                    @if( isset($old_vat_schemes) && count($old_vat_schemes)>0 )
                                      @foreach($old_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                                    @if( isset($new_vat_schemes) && count($new_vat_schemes)>0 )
                                      @foreach($new_vat_schemes as $key=>$scheme_row)
                                        <option value="{{ $scheme_row->vat_scheme_id }}" {{ (isset($client_details['vat_scheme_type']) && $client_details['vat_scheme_type'] == $scheme_row->vat_scheme_id)?"selected":"" }}>{{ $scheme_row->vat_scheme_name }}</option>
                                      @endforeach
                                    @endif
                                   
                                  </select></td>
                <td align="center"><input type="text" name="hrs[]" id="hrs" size="5%" style="height: 33px;"></td>
                
                <td align="center">
                <button class="btn btn-default" onclick="return notesmodal()" data-toggle="modal" data-target="#composenotes-modal"><span class="requ_t">Notes</span></button>  <input type="hidden" name="notes[]" id="notes12" value="">
                <!-- <input type="text" name="notes[]" id="notes" style="width:90%; height: 33px;"> -->
                </td> 
              </tr>
              <!--<tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>-->
              <!--<tr>
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15"></a> 19-08-2015</td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><select class="form-control">
                    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                  </select></td>
                <td align="center"><input type="text" ></td>
                <td align="center"><input type="text"></td>
              </tr>-->
              <!-- <tr>
                <td align="left" colspan="5"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></td>
                <td align="center"><button class="btn btn-primary">Submit</button></td>
              </tr> -->
            </tbody>
          </table>
              </td>
            </tr>
          </table>
          <div class="save_btncon">
            <div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add new line</p></button></div>
            <div class="right_side"> <button class="btn btn-primary">Submit</button></div>
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
  <!-- Vat Scheme Modal -->
			<div class="modal fade" id="vatScheme-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:430px; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD to List</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/client/add-vat-scheme', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="org">
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="vat_scheme_name" id="vat_scheme_name" placeholder="Vat Scheme" class="form-control">
      </div>
      
      <div id="append_vat_scheme">
        @if( isset($old_vat_schemes) && count($old_vat_schemes) )
          @foreach($old_vat_schemes as $key=>$scheme_row)
            <div class="form-group">
              <label for="{{ $scheme_row->vat_scheme_name }}">{{ $scheme_row->vat_scheme_name }}</label>
            </div>
          @endforeach
        @endif

        @if( isset($new_vat_schemes) && count($new_vat_schemes) )
          @foreach($new_vat_schemes as $key=>$scheme_row)
            <div class="form-group" id="hide_vat_div_{{ $scheme_row->vat_scheme_id }}">
              <a href="javascript:void(0)" title="Delete Field ?" class="delete_vat_scheme" data-field_id="{{ $scheme_row->vat_scheme_id }}"><img src="/img/cross.png" width="12"></a>
              <label for="{{ $scheme_row->vat_scheme_name }}">{{ $scheme_row->vat_scheme_name }}</label>
            </div>
          @endforeach
        @endif
      </div>
     
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" id="add_vat_scheme" data-client_type="org" name="save">Save</button>
          <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
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
<!-- time-->
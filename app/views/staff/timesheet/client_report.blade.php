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
                  <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
                </li>
                <li>
                  <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
<div class="modal-content" style="width: 59%; margin: 30px auto;">
<div class="modal-body">
          <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <div class="popupclienttime">
          
          <input type="hidden" name="type" id="ctr" value="client_tr">
             
                 <p class="clnt_con">CLIENT TIME REPORT</p>
             
              <div class="selec_seclf">
          
                  <span class="slct_con">Select Client</span>
                  
                       <select class="form-control2 newdropdown" name="ctr_client" id="ctr_clientc">
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
                  
                       <select class="form-control2 newdropdown" name="ctr_serv" id="ctr_servc">
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
                       </select>
                     
                  <div class="clr"></div>
          
          
              </div>
              <div class="clr"></div>
              
              <div class="select_con1">
              <div class="selec_seclf2">
                    <span class="slct_con"><strong>Display activity from</strong></span>
                  <input class="dpick dpick1" type="text" id="fromdpick2c" name="fromdate"  />
              </div>
            <div class="selec_seclf3" >
                    <span class="slct_con"><strong>to</strong></span>
                  <input class="dpick dpick1" type="text" id="todpickc" name="todate"  />
                  <button class="clnt_button" id="newclient_display" onclick="return newclientdisplay()">Display</button>   
              </div></div>
              
              
              <div class="clr"></div>
              <div id="dropctrc">
              </div>
              <div class="clr"></div>
              <div id="dropctrerror" style="text-align: center; padding: 20px 10px 10px 10px; ">
              </div>
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
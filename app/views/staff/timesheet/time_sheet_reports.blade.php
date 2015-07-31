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
var Table1, Table2;
$(function() {
/*$(function() {
  Table1 = $('#example1').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
        "iDisplayLength": 50,
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
  Table1.fnSort( [ [2,'asc'] ] );*/

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

   
   Table2.fnSort( [ [2,'asc'] ] );
   
  

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



			//	$('#edit_notice_template_id').val(resp['edit_notice_template_id']);

			

			//CKEDITOR.instances['edit_message'].setData(resp['message']);

			// $("#compose-modal").modal("toggle");

			//$('#modal').modal();

		}

	});

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
                <li>
                  <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                </li>
                <li>
                  <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
                </li>
                <li>
                  <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
                </li>
                <div class="clearfix"></div>
              </ul>
            </div>
          </div>
          <div class="tabarea">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-tabsbg">
                <li class="active"><a data-toggle="tab" href="#tab_1">TIME SHEET</a></li>
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
                        <div style="width:100%; margin: 0 0 40px 15px;">
                            <div style="float: left; padding-right: 10px;"><button class="btn btn-default" data-toggle="modal" data-target="#compose-modal"><span class="requ_t">New Time Sheet</span></button></div>

                            <div style="float: left; padding-right: 10px;"><button class="btn btn-default">Client Time Report</button></div>

                            <div style="float: left;"><button class="btn btn-default"><span class="decline_t">Staff Time Report</span></button></div>
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
                                  <!--<a href="#"><img src="img/delete_icon.png" width="15"></a></td>
                              </tr>
                              
                            </tbody>
                          </table>-->
                          
                          <!--end table-->
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
                        <div class="col-xs-12">
						<?php 
						//echo '<pre>';
						//print_r($time_sheet_report);
							
						?>
                          <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                                <th align="center"><input type="checkbox" id="allCheckSelect"/></th>
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th align="left"><strong>Service</strong></th>
                                <th><strong>HRS</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Action</strong></th>
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($time_sheet_report))
								  @foreach($time_sheet_report as $key=>$staff_row)
								 <tr>
									<td align="center"><input type="checkbox" /></td>
									<td align="center">{{ $staff_row['created_date'] }}</td>
									<td align="center">{{ $staff_row['staff_detail']['fname'] }} {{ $staff_row['staff_detail']['lname'] }}</td>
									<td  align="left">{{ $staff_row['client_detail']['field_value'] }}</td>
									<td align="left">{{ $staff_row['old_vat_scheme']['vat_scheme_name'] }}</td>
									<td align="center">{{ $staff_row['hrs'] }}</td>
									<td align="center">{{ $staff_row['notes'] }}</td>
									<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $staff_row['timesheet_id'] }}" onclick="openModal('{{ $staff_row['timesheet_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
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
                <td width="6%" align="center"><strong>HRS</strong></td>
                <td width="14%" align="center"><strong>Notes</strong></td>
              </tr>
              <tr >
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15" id="date_picker" ></a>
				<input class="dpick" type="text" id="eddpick" name="date" size="10"/>
				<input type="hidden" id="editid" name="editid" value="" />
				</td>
                <td align="center"><select class="form-control" name="staff_id" id="staff_id_edit">
              <option value="">None</option>
                @if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
              </select></td>
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
                <td align="center"><input type="text" name="hrs" id="hrs" size="5%"></td>
                <td align="center"><input type="text" name="notes" id="notes"></td>
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
                <td width="20%"><strong>Date</strong></td>
                <td width="20%" align="center"><strong>Staff Name</strong></td>
                <td width="20%" align="center"><strong>Client Name</strong></td>
                <td width="20%" align="center"><strong>Service</strong> <a href="#" class="add_to_list" data-toggle="modal" data-target="#vatScheme-modal">Add/Edit List</a></td>
                <td width="6%" align="center"><strong>HRS</strong></td>
                <td width="14%" align="center"><strong>Notes</strong></td>
              </tr>
              <tr id="TemplateRow" class="makeCloneClass">
                <td align="left"><a href="#"><img src="/img/cross_icon.png" width="15" id="date_picker" class="DeleteBoxRow" ></a>
				<input class="dpick" type="text" id="dpick1" name="date[]"  />
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
                <td align="center"><input type="text" name="hrs[]" id="hrs" size="5%"></td>
                <td align="center"><input type="text" name="notes[]" id="notes"></td>
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
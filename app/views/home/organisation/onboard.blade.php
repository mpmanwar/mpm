@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/onboard.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>






<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="{{ URL :: asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>


<!-- page script -->
<script type="text/javascript">
var oTable;

$(function() {
    oTable = $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, 200]],
        "iDisplayLength": 50,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            //{"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
           // {"bSortable": true},
           // {"bSortable": true},
            //{"bSortable": false}
        ]

    });
    oTable.fnSort( [ [3,'asc'] ] );

});
$(function() {
var cloneCount = 0;
   
   
 	
    $('.addnew_line').click(function() {
		
				//alert('AAAAAAAAAAAA');	
				
				
               // $(".dpick").datepicker("destroy");      
				
				
				
				var $newRow = $('#TemplateRow').clone(true);
			
            	//$newRow.find('#date_picker').val('');
			//	$newRow.find('.dpick').val('');
        		$newRow.find('#checklist_type').val('');
                $newRow.find('#client_id').val('');
				$newRow.find('#owner').val('');
				$newRow.find('#frequency').val('');
                $newRow.find('#status').val('');
        		
				var noOfDivs = $('.makeCloneClass').length + 1;
				
                // $newRow.find('input[type="text"]').attr('id', 'dpick'+ noOfDivs);
			
				$('#BoxTable tr:last').after($newRow);
				//$(".dpick").datepicker({dateFormat: 'dd-mm-yy'});    
				return false;
			
	})
    	});
function notesmodal(){
    //$("#compose-modal").modal("hide");
}

/*$(document).ready(function(){
  $("#archivedButton").click(function(){
        var oSettings = oTable.fnSettings();
        oSettings._iDisplayLength = -1;
        oTable.fnDraw();
  })
})*/

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
      <div class="row">
        <div class="top_bts">
          <ul>
            <!-- <li>
              <button class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </li> -->
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <li>
              <a class="btn btn-danger sync_jobs_data" href="javascript:void(0)">SYNC DATA</a>
            </li>
           <!-- <li>
              <button class="btn btn-info">ON-BOARD NEW CLIENT</button>
            </li> -->
            <!-- <li>
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li> -->
            <!-- <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li> -->
            

            <div class="clearfix"></div>
          </ul>
        </div>
        <div id="message_div" style="margin-left: 700px;"><!-- Loader image show while sync data --></div>
        <!-- <div style="float: right; margin-right: 43px;"><a href="javascript:void(0)" id="archive_div">Show Archived</a></div> -->

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
              <div class="top_bts" style="float:left;">
                <ul style="padding:0;">
                  <li>
                    <a href="/organisation/add-client" class="btn btn-info">+ CLIENT - KEY IN</a>
                  </li>
                  <li>
                    <div class="import_fromch_main">
                      <div class="import_fromch">
                        <a href="/import-from-ch/{{ base64_encode('org_list') }}" class="import_fromch_link">IMPORT FROM CH</a>
                        <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="i_dropdown open_toggle"><a href="/chdata/bulk-company-upload-page/{{ base64_encode('org_list') }}">BULK COMPANY UPLOAD</a></div>
                    </div>


                    <!-- <div class="import_fromch">
                      <a href="/import-from-ch/{{ base64_encode('org_list') }}" class="import_fromch_link">IMPORT FROM CH</a>
                      <a href="/chdata/bulk-company-upload-page/{{ base64_encode('org_list') }}" class="i_selectbox"><img src="img/arrow_icon.png" /></a>
                    </div> -->
                    <!-- <a href="/import-from-ch/{{ base64_encode('org_list') }}" class="btn btn-info">IMPORT FROM CH</a> -->
                  </li>
                  <li>
                    <button type="button" class="btn btn-info">CSV IMPORT</button>
                  </li>
                  <li>
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>

            
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
               <div class="top_bts">
                <ul style="padding:0;">
                  
                  <li style="margin-top: 8px;">
                    <!-- <button type="button" id="show_search" class="btn btn-success">Search</button> -->
                    <?php $value = Session::get('show_archive');?>
                    <a href="javascript:void(0)" id="archive_div">
                      {{ (isset($value) && $value == "Y") ? "Show Archived Clients":"Hide Archived Clients" }}</a>
                  </li>
                  <li>
                    <button type="button" id="archivedButton" class="btn btn-warning">Archive</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>

            </div>
            
<div class="box-body table-responsive">
  <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
    <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
      <input type="hidden" id="client_type" value="org"> 
        <thead>
            <tr role="row">
                <th><input type="checkbox" id="allCheckSelect"/></th>
                <th>Joining Date</th>
                <th>Client Type</th>
                <th>Client Name</th>
                <th>Contact Name</th>
                <th>% Completed</th>
                <th>Telephone</th>
                <th>Notes</th>
                
            </tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
            @if(!empty($client_details))
                <?php $i=1; ?>
                @foreach($client_details as $key=>$client_row)
                  <tr class="all_check" {{ ($client_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                   
                   
                   
                    <td align="center">
                      <input type="checkbox" data-archive="{{ $client_row['show_archive'] }}" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                    </td>
                    <td align="center">{{ 
                    
                    
                    
                    date('d-m-Y',strtotime($client_row['created'])) }}</td>
                    <td align="center">{{ isset($client_row['business_type'])?$client_row['business_type']:"" }}</td>
                    
                 <!--   <td align="center">{{ $client_row['registration_number'] or "" }}</td> -->
                    
                    
                    
                    
                    
                    <td align="left"><a href="#" data-toggle="modal" id="businessclient" data-clientid= "{{ $client_row['client_id'] }}" data-target="#compose-modal">{{ isset($client_row['business_name'])?$client_row['business_name']:"" }}</a></td>
                    <!--
                    <td align="left"><a href="/client/edit-org-client/{{ $client_row['client_id'] }}/{{ base64_encode('org_client') }}">{{ isset($client_row['business_name'])?$client_row['business_name']:"" }}</a></td> -->
                    
                    <td align="center">{{ $client_row['corres_cont_name'] or "" }}-{{ $client_row['corres_cont_name'] or "" }}</td>
                    
                    <td align="center">
                    %
                    <!--  @if( isset($client_row['deadacc_count']) && $client_row['deadacc_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadacc_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadacc_count'] or "" }}
                      @endif -->
                    </td>
                    
                    <td align="center">
                   {{ $client_row['corres_cont_telephone'] or "" }}-{{ $client_row['corres_cont_telephone'] or "" }}
                   <!--   @if( isset($client_row['deadret_count']) && $client_row['deadret_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadret_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadret_count'] or "" }}
                      @endif
                   -->
                    </td>
                    
                    
                    
                    <td align="center">
                    
                    <button class="notes_btn" onclick="return notesmodal()" data-toggle="modal" data-target="#composenotes-modal"><span class="requ_t">notes</span></button>
                    
                    
                    <!--
                    {{ isset($client_row['tax_reference'])?$client_row['tax_reference']:"" }}
                    -->
                    </td>
                    
                    
                    
                  </tr>
                <?php $i++; ?>
              @endforeach
            @endif
          
          
        </tbody>
      </table>

        </div>
    </div>
            
            
            

            
                      
                      
          </div>
        </form>
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        

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
        
<!-- -->
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
    <td width="30%"><strong>On Boarding checklist</strong></td>
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
                <td width="20%" align="center"id="allCheckSelect"> Delete</td>
                <td width="20%" align="center"><strong>Checklist</strong>
                <a href="#" class="add_to_list" data-toggle="modal" id="positionopen" data-target="#checklist-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a>
                </td>
                <td width="20%" align="center"><strong>Client</strong></td>
                <td width="20%" align="center"><strong>Owner</strong>
                </td>
                <td width="6%" align="center"><strong>Frequency of Reminder</strong></td>
                <td width="14%" align="center"><strong>Status</strong></td>
              </tr>
              
              
              
              <tr id="TemplateRow" class="makeCloneClass">
              
              
              
                <td align="center"><input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="" /></td>
                <td align="center">
                
                
                    <select class="form-control" name="checklist_type" id="checklist_type">
                     
                      @if( isset($old_postion_types) && count($old_postion_types) >0 )
                        @foreach($old_postion_types as $key=>$old_org_row)
                        <option value="{{ $old_org_row->checklist_id }}">{{ $old_org_row->name }}</option>
                        @endforeach
                      @endif

                      @if( isset($new_postion_types) && count($new_postion_types) >0 )
                        @foreach($new_postion_types as $key=>$new_org_row)
                        <option value="{{ $new_org_row->checklist_id }}">{{ $new_org_row->name }}</option>
                        
                        @endforeach
                      @endif
                     
                     
                    </select>
                  
                  </td>
                <td align="center">
                
                
                
                   
                    <select class="form-control" name="client_id" id="client_id">
    				<option value="">None</option>
    					@if(isset($allClients) && count($allClients)>0)
					       @foreach($allClients as $key=>$client_row)
						      <option value="{{ $client_row['client_id'] }}">{{ $client_row['client_name'] }}</option>
					       @endforeach
					   @endif
                </select>
                  
                  
                  
                  </td>
                  
                  
                <td align="center">
                                 
                  <select class="form-control" name="owner" id="owner">
    				<option value="">None</option>
    					@if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
                       </select>
                  
                  
                  
                <!--    <option>wdfd wefwe</option>
                    <option>wefew ewf</option>
                    <option>wef werfg</option>
                -->
                
                  </select></td>
                <td align="center"><input type="text" id="frequency" ></td>
                <td align="center">
                
                <select class="form-control" name="status" id="status">
                    <option value="done">Done</option>
                    <option value="wip">WIP</option>
                    <option value="na">N/A</option>
                  </select>
                
                
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
            <div class="left_side"><button class="addnew_line"><i class="add_icon_img"><img src="/img/add_icon.png"></i><p class="add_line_t">Add Another Item</p></button></div>
          <!--  <div class="right_side"> <button class="btn btn-primary">Submit</button></div> -->
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

 <!-- Client -->
			<div class="modal fade" id="checklist-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:430px; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD to List</h4>
        <div class="clearfix"></div>
      </div>
      <input type="hidden" id="hiddenclient" value="" />
              
   {{ Form::open(array('url' => '/client/add-checklist', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="org">
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="checklist" id="checklist" placeholder="Checklist" class="form-control">
      </div>
      
      <div id="append_position_type">
      @if( isset($old_postion_types) && count($old_postion_types) >0 )
        @foreach($old_postion_types as $key=>$old_org_row)
        <div class="form-group">
          <label for="{{ $old_org_row->name }}">{{ $old_org_row->name }}</label>
        </div>
        @endforeach
      @endif

      @if( isset($new_postion_types) && count($new_postion_types) >0 )
        @foreach($new_postion_types as $key=>$new_org_row)
        <div class="form-group" id="hide_div_{{ $new_org_row->checklist_id }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_checklist_name" data-field_id="{{ $new_org_row->checklist_id }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $new_org_row->name }}">{{ $new_org_row->name }}</label>
        </div>
        @endforeach
      @endif
      </div>
     
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
         
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_position_type" name="save">Save</button>
          
          
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

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


<script type="text/javascript">

function newclientdisplay(){
    alert('fsfsf');
    var ctr_client= $("#ctr_clientc").val();
    
    var ctr_serv = $("#ctr_servc").val();
    
    var fromdpick2= $("#fromdpick2c").val();
    
    var todpick = $("#todpickc").val();
    
    
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
                $("#dropctrc").html(resp);
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
</script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
@stop
 
@section('content')
<div class="practice_mid">
        <form>
          <div class="top_buttons">
            <div class="top_bts">
              <ul>
               <!-- <li>
                  <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                </li> -->
                <li>
                  <button class="btn btn-success"><i class="fa fa-download"></i> Print</button>
                </li>
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

          <div class="tabarea">
            
            
            
            <!-- composeclienttr -->

  <div style="width:56%;">
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
        
      <!--  {{ Form::close() }} -->
      <!--</form>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->

<!-- composeclienttr -->
            
              
              
            </div>
            
            
          </div>
        </form>
      </div>
      
      @stop
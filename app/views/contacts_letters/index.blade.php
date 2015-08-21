@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/letter_email.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function() {
    $('#example1').dataTable({
        "aaSorting": [[1, 'asc']],
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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

    $('#example2').dataTable({
        "aaSorting": [[1, 'asc']],
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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

    $('#example3').dataTable({
        "aaSorting": [[1, 'asc']],
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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

    $('#example4').dataTable({
        "aaSorting": [[1, 'asc']],
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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });

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
            
            <div class="clearfix"></div>
          </ul>
        </div>
        <div id="message_div" style="margin-left: 700px;"><!-- Loader image show while sync data --></div>
        
      </div>
      <div class="practice_mid">
        
          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts" style="float:left;">
                <ul style="padding:0;">
                  <li>
                    <a href="/send-letters-emails" class="btn btn-danger">SEND LETTER/EMAIL</a>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
               <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#upload_letterhead-modal">UPLOAD LETTERHEAD</a>
                  </li>

                  <li>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_contact-modal">ADD CONTACT</a>
                  </li>

                  <li>
                    <a href="/email-settings" target="_blank" class="btn btn-info">MAIL SETTINGS</a>
                  </li>
                  
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>

            </div>
            
<div class="box-body table-responsive">
  <div class="tabarea">
  <input type="hidden" id="tab_id" value="{{ $step_id or "" }}"> 
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg">
        @if(isset($steps) && count($steps) >0)
          @foreach($steps as $key=>$step_row)
            <li {{ (isset($step_id) && $step_id == $step_row['step_id'])?'class="active"':''}}><a href="/contacts-letters-emails/{{ $step_row['step_id'] }}">{{ $step_row['title'] or "" }} [{{ $step_row['count'] }}]</a></li>
          @endforeach
        @endif
        <li style="float:right;"><a href="#" class="btn-block btn-primary" data-toggle="modal" data-target="#create_group-modal"><i class="fa fa-plus"></i> New Contact Group</a></li>
      </ul>
<div class="tab-content">
  <div id="tab_1" class="tab-pane {{ (isset($step_id) && $step_id == 1)?'active':''}}">
    <div class="contact_email">
      <p class="display_t">Display</p>
      <div class="dis_selectbox">
      <select class="form-control newdropdown" >
        <option value="trad">Trading Address</option>
        <option value="reg">Registered Office address</option>
        <option value="corres">Correspondence address</option>
        <option value="bankers">Bankers</option>
        <option value="old_acc">Old Accounts</option>
        <option value="auditors">Auditors</option>
        <option value="solicitors">Solicitors</option>
        <option value="tax_office">Tax Office</option>
        <option value="paye_emp">Paye Employer Office</option>
       </select>
      </div>
      <p class="display_t">for all records</p>
      <a href="javascript:void(0)" class="search_add open_addto_group">Add to group</a>
    </div>

    <table class="table table-bordered table-hover dataTable email_letter" id="example1" aria-describedby="example1_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type="checkbox" class="allCheckSelect"/></th>
          <th>NAME</th>
          <th>TYPE</th>
          <th>CONTACT Person</th>
          <th>TELEPHONE</th>
          <th>MOBILE</th>
          <th>EMAIL</th>
          <th>ADDRESS</th>
          <th>NOTES</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($client_details) && count($client_details) >0)
              @foreach($client_details as $key=>$client_row)
                @if(isset($client_row['contact_type']) && $client_row['contact_type'] == "Business")
                <tr class="all_check">
                  <input type="hidden" name="corres_add_{{ $client_row['client_id'] }}" id="corres_add_{{ $client_row['client_id'] }}" value="{{ $client_row['corres_address'] or "" }}">

                  <td align="center">
                    <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                  </td>
                  <td align="left"><a target="_blank" href="{{ $client_row['client_url'] or "" }}">{{ $client_row['client_name'] or "" }}</a></td>
                  <td align="left">
                    <select class="form-control newdropdown" >
                      <option value="trad">Trading Address</option>
                      <option value="reg">Registered Office address</option>
                      <option value="corres">Correspondence address</option>
                      <option value="bankers">Bankers</option>
                      <option value="old_acc">Old Accounts</option>
                      <option value="auditors">Auditors</option>
                      <option value="solicitors">Solicitors</option>
                      <option value="tax_office">Tax Office</option>
                      <option value="paye_emp">Paye Employer Office</option>
                     </select>
                  </td>
                  <td align="left">
                    @if(isset($client_row['contact_name']) && count($client_row['contact_name']) >0)
                      <select class="form-control newdropdown">
                      @foreach($client_row['contact_name'] as $key=>$name_row)
                      <option>{{ $name_row['name'] }}</option>
                      @endforeach
                      </select>
                    @endif
                  </td>
                  <td align="center">{{ $client_row['telephone'] or "" }}</td>
                  <td align="center">{{ $client_row['mobile'] or "" }}</td>
                  <td align="center">{{ $client_row['email'] or "" }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $client_row['client_id'] or "" }}" data-contact_type="{{ $client_row['contact_type'] or "" }}"><span {{ (isset($client_row['notes']) && $client_row['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a></td>
                
                </tr>
              @endif
            @endforeach
          @endif
        
        
      </tbody>
    </table>
  </div>

  <div id="tab_2" class="tab-pane {{ (isset($step_id) && $step_id == 2)?'active':''}}">
    <div class="contact_email">
      <p class="display_t">Display</p>
      <div class="dis_selectbox">
      <select class="form-control newdropdown" >
        <option value="trad">Trading Address</option>
        <option value="reg">Registered Office address</option>
        <option value="corres">Correspondence address</option>
        <option value="bankers">Bankers</option>
        <option value="old_acc">Old Accounts</option>
        <option value="auditors">Auditors</option>
        <option value="solicitors">Solicitors</option>
        <option value="tax_office">Tax Office</option>
        <option value="paye_emp">Paye Employer Office</option>
       </select>
      </div>
      <p class="display_t">for all records</p>
      <a href="javascript:void(0)" class="search_add open_addto_group">Add to group</a>
    </div>

    <table class="table table-bordered table-hover dataTable email_letter" id="example2" aria-describedby="example2_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type="checkbox" class="allCheckSelect"/></th>
          <th>NAME</th>
          <th>TELEPHONE</th>
          <th>MOBILE</th>
          <th>EMAIL</th>
          <th>RESIDENTIAL ADDRESS</th>
          <th>SERVICE ADDRESS</th>
          <th>NOTES</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($client_details) && count($client_details) >0)
              @foreach($client_details as $key=>$client_row)
                @if(isset($client_row['contact_type']) && $client_row['contact_type'] == "Individual")
                <tr class="all_check">
                  <input type="hidden" name="corres_add_{{ $client_row['client_id'] }}" id="corres_add_{{ $client_row['client_id'] }}" value="{{ $client_row['corres_address'] or "" }}">

                  <td align="center">
                    <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                  </td>
                  
                  <td align="left">{{ $client_row['client_name'] or "" }}</td>
                  <td align="center">{{ $client_row['telephone'] or "" }}</td>
                  <td align="center">{{ $client_row['mobile'] or "" }}</td>
                  <td align="center">{{ $client_row['email'] or "" }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $client_row['client_id'] or "" }}" data-contact_type="{{ $client_row['contact_type'] or "" }}"><span {{ (isset($client_row['notes']) && $client_row['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a></td>
                  
                  
                </tr>
              @endif
            @endforeach
          @endif
        
        
      </tbody>
    </table>
  </div>

  <div id="tab_3" class="tab-pane {{ (isset($step_id) && $step_id == 3)?'active':''}}">
    <div class="contact_email">
      <p class="display_t">Display</p>
      <div class="dis_selectbox">
      <select class="form-control newdropdown" >
        <option value="trad">Trading Address</option>
        <option value="reg">Registered Office address</option>
        <option value="corres">Correspondence address</option>
        <option value="bankers">Bankers</option>
        <option value="old_acc">Old Accounts</option>
        <option value="auditors">Auditors</option>
        <option value="solicitors">Solicitors</option>
        <option value="tax_office">Tax Office</option>
        <option value="paye_emp">Paye Employer Office</option>
       </select>
      </div>
      <p class="display_t">for all records</p>
      <a href="javascript:void(0)" class="search_add open_addto_group">Add to group</a>
    </div>

    <table class="table table-bordered table-hover dataTable email_letter" id="example3" aria-describedby="example3_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type="checkbox" class="allCheckSelect"/></th>
          <th>NAME</th>
          <th>TELEPHONE</th>
          <th>MOBILE</th>
          <th>EMAIL</th>
          <th>ADDRESS</th>
          <th>NOTES</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($client_details) && count($client_details) >0)
              @foreach($client_details as $key=>$client_row)
                @if(isset($client_row['contact_type']) && $client_row['contact_type'] == "Staff")
                <tr class="all_check">
                  <input type="hidden" name="corres_add_{{ $client_row['client_id'] }}" id="corres_add_{{ $client_row['client_id'] }}" value="{{ $client_row['corres_address'] or "" }}">
                  <td align="center">
                    <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                  </td>
                  <td align="left">{{ $client_row['client_name'] or "" }}</td>
                  <td align="center">{{ $client_row['telephone'] or "" }}</td>
                  <td align="center">{{ $client_row['mobile'] or "" }}</td>
                  <td align="center">{{ $client_row['email'] or "" }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  
                  <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $client_row['client_id'] or "" }}" data-contact_type="{{ $client_row['contact_type'] or "" }}"><span {{ (isset($client_row['notes']) && $client_row['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a></td>
                  
                </tr>
              @endif
            @endforeach
          @endif
        
        
      </tbody>
    </table>
  </div>

  <div id="tab_4" class="tab-pane {{ (isset($step_id) && $step_id == 4)?'active':''}}">
    <div class="contact_email">
      <p class="display_t">Display</p>
      <div class="dis_selectbox">
      <select class="form-control newdropdown" >
        <option value="trad">Trading Address</option>
        <option value="reg">Registered Office address</option>
        <option value="corres">Correspondence address</option>
        <option value="bankers">Bankers</option>
        <option value="old_acc">Old Accounts</option>
        <option value="auditors">Auditors</option>
        <option value="solicitors">Solicitors</option>
        <option value="tax_office">Tax Office</option>
        <option value="paye_emp">Paye Employer Office</option>
       </select>
      </div>
      <p class="display_t">for all records</p>
      <a href="javascript:void(0)" class="search_add open_addto_group">Add to group</a>
    </div>

    <table class="table table-bordered table-hover dataTable email_letter" id="example4" aria-describedby="example4_info">
      <thead>
        <tr role="row">
          <th width="3%"><input type="checkbox" class="allCheckSelect"/></th>
          <th>NAME</th>
          <th>CONTACT Person</th>
          <th>TELEPHONE</th>
          <th>MOBILE</th>
          <th>EMAIL</th>
          <th>ADDRESS</th>
          <th>NOTES</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">
          @if(isset($client_details) && count($client_details) >0)
              @foreach($client_details as $key=>$client_row)
                @if(isset($client_row['contact_type']) && $client_row['contact_type'] == "Other")
                <tr class="all_check">
                  <input type="hidden" name="corres_add_{{ $client_row['client_id'] }}" id="corres_add_{{ $client_row['client_id'] }}" value="{{ $client_row['corres_address'] or "" }}">
                  <td align="center">
                    <input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" />
                  </td>
                  <td align="left">{{ $client_row['client_name'] or "" }}</td>
                  <td align="center">{{ $client_row['telephone'] or "" }}</td>
                  <td align="center">{{ $client_row['mobile'] or "" }}</td>
                  <td align="center">{{ $client_row['email'] or "" }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  <td align="center">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...<a href='javascript:void(0)' class='more_address' data-client_id='".$client_row['client_id']."'>more</a>": $client_row['corres_address'] }}</td>
                  <td align="center"><a href="javascript:void(0)" class="search_t open_notes_popup" data-client_id="{{ $client_row['client_id'] or "" }}" data-contact_type="{{ $client_row['contact_type'] or "" }}"><span {{ (isset($client_row['notes']) && $client_row['notes'] != "")?'style="border-bottom:3px dotted #3a8cc1 !important"':'' }}>notes</span></a></td>
                  
                </tr>
              @endif
            @endforeach
          @endif
        
        
      </tbody>
    </table>
  </div>
      

</div>

</div>
          

</div>
</div>
            
            
        </div>
        
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="upload_letterhead-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FILE</h4>
        <div class="clearfix"></div>
      </div>
    
    <input type="hidden" name="client_type" value="org" />
    <input type="hidden" name="back_url" value="add_org" />
      <div class="modal-body">
        

        <div class="form-group">
          <label for="exampleInputPassword1">Upload your customised .docx letterhead</label>
          <input type="file" class="form-control" name="upload_name" id="upload_name">
        </div>
        
        <div class="modal-footer1 clearfix">
          <div class="email_btns1">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-info" name="save">Save</button>
          </div>
        </div>
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="add_contact-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FIELD</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        

     <div class="form-group">
      <label for="exampleInputPassword1"><div style="float:left;">Contact Name</div> <div style="float:left; margin-left: 100px">File Contact as <input type="checkbox"></div></label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_tele_code" name="serv_tele_code" class="form-control" readonly>
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="serv_telephone" name="serv_telephone" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_mobile_code" name="serv_mobile_code" class="form-control" readonly>
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="serv_mobile" name="serv_mobile" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Email</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Website</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1"><div style="float:left;">Company Name</div> <div style="float:left; margin-left: 100px">File Contact as <input type="checkbox"></div></label>
      <input type="text" id="res_addr_line1" name="res_addr_line1"  class="form-control">
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Select or Add</label> 

      <select class="form-control service_country" name="res_country" id="res_country">
      </select>                   
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line 1</label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line 2</label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">City/Town</label>
          <input type="text" id="res_city" name="res_city" class="form-control">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">County</label>
          <input type="text" id="res_county" name="res_county" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

      <div class="twobox">
      <div class="twobox_1">
      <div class="form-group">
      <label for="exampleInputPassword1">Postcode</label>
      <input type="text" id="res_postcode" name="res_postcode" class="form-control">
      </div>
      </div>

      <div class="twobox_2">
      <div class="form-group">
      <label for="exampleInputPassword1">Country</label> 

        <select class="form-control service_country" name="res_country" id="res_country">
        </select>                   
      </div>
      </div>
      <div class="clearfix"></div>
      </div>


  
      <div class="modal-footer1 clearfix">
          <div class="add_client_btn">
      <button class="btn btn-info" type="button">Save</button>
      <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
    </div>
        </div>
      </div>
    
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

<!-- Notes modal start -->
<div class="modal fade" id="notes-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">SAVE NOTES</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <input type="hidden" id="notes_client_id" name="notes_client_id">
        <input type="hidden" id="contact_type" name="contact_type">
        <table>
          <tr>
            <td align="left" width="20%"><strong>Notes : </strong></td>
            <td align="left"><textarea cols="56" rows="4" id="notes" name="notes"></textarea></td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="right"><button type="button" class="btn btn-info save_notes">Save</button></td>
          </tr>
        </table>

        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
<!-- Notes modal start -->

<!-- Create Group modal start -->
<div class="modal fade" id="create_group-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">CREATE GROUP</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body" style="margin-left: 35px">
        <div class="loader_class"><!-- Loader Image Show--></div>
        <input type="hidden" id="notes_client_id" name="notes_client_id">
        <input type="hidden" id="contact_type" name="contact_type">
        <table>
          <tr>
            <td align="left" width="30%"><strong>Select Step&nbsp;&nbsp; </strong></td>
            <td align="left">
              <select class="form-control" id="create_group_step_id">
                @if(isset($steps) && count($steps) >0)
                  @foreach($steps as $key=>$step_row)
                    @if(isset($step_row['step_type']) && $step_row['step_type'] == "old")
                      <option value="{{ $step_row['step_id'] or "" }}">{{ $step_row['title'] or "" }}</option>
                    @endif
                  @endforeach
                @endif
              </select>
            </td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="30%"><strong>Enter Name&nbsp;&nbsp; </strong></td>
            <td align="left"><input type="text" class="form-control" name="group_name" id="group_name"></td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-info create_groups">Save</button>
            </td>
          </tr>
        </table>

        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
<!-- Create Group modal end -->

<!-- Add to Group modal start -->
<div class="modal fade" id="addto_group-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add To Group</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body" style="margin-left: 35px">
        <input type="hidden" id="notes_client_id" name="notes_client_id">
        <input type="hidden" id="contact_type" name="contact_type">
        <table>
          <tr>
            <td align="left" width="30%"><strong>Select Group&nbsp;&nbsp; </strong></td>
            <td align="left">
              <select class="form-control">
                @if(isset($steps) && count($steps) >0)
                  @foreach($steps as $key=>$step_row)
                    @if(isset($step_row['step_type']) && $step_row['step_type'] == "new")
                      <option value="{{ $step_row['step_id'] or "" }}">{{ $step_row['title'] or "" }}</option>
                    @endif
                  @endforeach
                @endif
              </select>
            </td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>

          <tr>
            <td align="left" width="20%">&nbsp;</td>
            <td align="right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-info addto_groups">Save</button>
            </td>
          </tr>
        </table>

        
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>        
<!-- Add to Group modal end -->

@stop
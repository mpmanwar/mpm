@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

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
        "aLengthMenu": [[25, 25, 50, -1], [25, 50, 100, 200]],
        "iDisplayLength": 25,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },

      "aoColumns":[
            {"bSortable": false},
            
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false}
        ]

    });

});


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
                                        
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        @include('layouts.outer_leftside')
                        
                    </ul>
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
            
            <!-- <li>
            
              <button class="btn btn-warning" type="button" id="edit_but"><i class="fa fa-edit"></i> Edit</button>
              <button class="btn btn-success" type="button" style="display:none;" id="save_but">Save</button>
            
            </li> -->

            

            <div class="clearfix"></div>
          </ul>
        </div>

        <!-- <div style="float: right; margin-right: 43px;"><a href="javascript:void(0)" id="archive_div">Show Archived</a></div> -->
      </div>
      <div class="practice_mid">
        <form>
          
          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <a href="/individual/add-client" class="btn btn-info">ADD CLIENT</a>
                  </li>
                  <li>
                    <button class="btn btn-success">BULK CSV IMPORT</button>
                  </li>
                  <li>
              <button type="button" id="deleteClients" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
                  <li>
              <button type="button" id="archivedButton" class="btn btn-warning">Archive</button>
            </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
               <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-info">ON-BOARD NEW CLIENT</button>
                  </li>
                  <li>
                    <!-- <button type="button" id="show_search" class="btn btn-success">Search</button> -->
                    <?php $value = Session::get('show_archive');?>
                    <a href="javascript:void(0)" id="archive_div">
                      {{ (isset($value) && $value == "Y") ? "Show Archived":"Hide Archived" }}</a>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              </div>
              <div class="clearfix"></div>
            </div>
            
            <!-- <div class="table_top_box" id="table_top_box">
              <ul>
                <li style="width:auto;"><input type="reset" value="Clear"></li>
                <li><input type="text" name="search_client_text" id="search_client_text" placeholder="Search..." class="search_box"></li>
              
              </ul>
              
              <div class="clearfix"></div>
                      
            </div> -->
            
            <div class="box-body table-responsive">
              <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                <div class="row">
                  <div class="col-xs-6"></div>
                  <div class="col-xs-6"></div>
                </div>
          <table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
            <input type="hidden" id="client_type" value="ind">  
            <thead>
              <tr role="row">
                <th><input type="checkbox" id="allCheckSelect"/></th>
                <!-- <th>#</th> -->
                <th>STAFF</th>
                <th><span id="dob_text">DOB</span>
                  <span id="dob_select" style="display:none;">
                    <select id="four" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'dob') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th>CLIENT NAME</th>
                <th><span id="business_name_text">BUSINESS NAME</span>
                  <span id="business_name_select" style="display:none;">
                    <select id="six" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'business_name') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                
                <th><span id="ni_number_text">NI NUMBER</span>
                  <span id="ni_number_select" style="display:none;">
                    <select id="seven" name="first" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'ni_number') ? 'selected':'' }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="tax_reference_text">TAX REFERENCE</span>
                  <span id="tax_reference_select" style="display:none;">
                    <select id="eight" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'tax_reference') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="acting_text">ACTING</span>
                  <span id="acting_select" style="display:none;">
                    <select id="nine" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'acting') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="res_address_text">RESIDENTIAL ADDRESS</span>
                  <span id="res_address_select" style="display:none;">
                    <select id="ten" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'res_address') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
              
              </tr>
            </thead>

            <tbody role="alert" aria-live="polite" aria-relevant="all">
              @if(!empty($client_details))
              <?php $i=1; ?>
              @foreach($client_details as $key=>$client_row)
                <tr class="all_check" {{ ($client_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                  <td align="center">
                    <input type="checkbox" data-archive="{{ $client_row['show_archive'] }}" class="ads_Checkbox" name="client_delete_id[]" value="{{ $client_row['client_id'] or "" }}" id="client_delete_id"/>
                  </td>
                  <td align="center">{{ $client_row['staff_name'] or "" }}</td>
                  <td align="center">{{ (!empty($client_row['dob']))? $client_row['dob']: '' }}</td>
                  <td align="center"><a href="/client/edit-ind-client/{{ $client_row['client_id'] }}">{{ (!empty($client_row['title']))? $client_row['title']: '' }} {{ (!empty($client_row['fname']))? $client_row['fname']: '' }} {{ (!empty($client_row['mname']))? $client_row['mname']: '' }} {{ (!empty($client_row['lname']))? $client_row['lname']: '' }}</a></td>
                  <td align="center">{{ (!empty($client_row['business_name']))? $client_row['business_name']: '' }}</td>
                  <td align="center">{{ (!empty($client_row['ni_number']))? $client_row['ni_number']: '' }}</td>
                  <td align="center">{{ (!empty($client_row['tax_reference']))? $client_row['tax_reference']: '' }}</td>
                  <td align="center">{{ (!empty($client_row['acting'])) ? 'Yes': 'No' }}</td>
                  <td align="center">{{ (!empty($client_row['res_addr_line1'])) ? $client_row['res_addr_line1']."," : '' }} {{ (!empty($client_row['res_city'])) ? $client_row['res_city']."," : '' }} {{ (!empty($client_row['res_postcode'])) ? $client_row['res_postcode'] : '' }}</td>
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

@stop
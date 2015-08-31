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
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false}
        ]

    });
    oTable.fnSort( [ [3,'asc'] ] );

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
            <li>
              <button class="btn btn-info">ON-BOARD NEW CLIENT</button>
            </li>
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
                <th>Business Type</th>
                <th>CRN</th>
                <th>Business Name</th>
                <th>Year End</th>
                <th>Accounts</th>
                <th>Annual returns</th>
                <th>Tax reference</th>
                <th>Vat number</th>
                <th>VAT Stagger</th>
                <th>Correspondence Address</th>
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
                    <td align="center">{{ isset($client_row['business_type'])?$client_row['business_type']:"" }}</td>
                    <td align="center">{{ $client_row['registration_number'] or "" }}</td>
                    <td align="left"><a href="/client/edit-org-client/{{ $client_row['client_id'] }}/{{ base64_encode('org_client') }}">{{ isset($client_row['business_name'])?$client_row['business_name']:"" }}</a></td>
                    <td align="center">{{ $client_row['acc_ref_day'] or "" }}-{{ $client_row['ref_month'] or "" }}</td>
                    <td align="center">
                      @if( isset($client_row['deadacc_count']) && $client_row['deadacc_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadacc_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadacc_count'] or "" }}
                      @endif
                    </td>
                    <td align="center">
                      @if( isset($client_row['deadret_count']) && $client_row['deadret_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadret_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadret_count'] or "" }}
                      @endif
                    </td>
                    <td align="center">{{ isset($client_row['tax_reference'])?$client_row['tax_reference']:"" }}</td>
                    <td align="center">{{ isset($client_row['vat_number'])?$client_row['vat_number']:"" }}</td>
                    <td align="center">{{ $client_row['vat_stagger'] or "" }}</td>
                    <td align="left">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...": $client_row['corres_address'] }}</td>
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
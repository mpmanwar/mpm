
<link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
  .nav-tabs-custom > .nav-tabs > li{ margin-right: -3px;}
</style>


<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
var Table3;
$(function() {
  Table3 = $('#example1').dataTable({
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
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true}
    ]

  });

  
   Table3.fnSort( [ [2,'asc'] ] );

});

</script>



<div class="tab_topcon" style="position: relative; left:30%;">
      <div class="selctbox_containor1">

        <div class="select_t">Select Service :</div>
        <div class="sel_box">
          <select class="form-control service_dropdown" name="org_service_id" id="org_service_id">
            <option value="">None</option>
            @if( isset($old_services) && count($old_services)>0 )
              @foreach($old_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "org" )
                  <option value="{{ $service_row->service_id }}">{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif

            @if( isset($new_services) && count($new_services)>0 )
              @foreach($new_services as $key=>$service_row)
                @if( isset($service_row->client_type) && $service_row->client_type == "org" )
                  <option value="{{ $service_row->service_id }}">{{ $service_row->service_name }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>
        
      </div>
      
      <div class="clearfix"></div>
    </div>

    <div id="orgclient_table">
    <table class="table table-bordered table-hover dataTable org_alocation" id="example3" aria-describedby="example1_info">
      
      <thead>
        <tr role="row">
          <th width="2%"><span class="custom_chk"><input type='checkbox' id="CheckorgCheckbox" /></span></th><!-- allCheckSelect -->
          <th width="10%">Type</th>
          <th>BUSINESS NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
          <th width="13%">STAFF NAME</th>
        </tr>
      </thead>

      <tbody role="alert" aria-live="polite" aria-relevant="all">

        @if(isset($org_client_details) && count($org_client_details) >0)
        @foreach($org_client_details as $key=>$details)
          <tr class="even">
            <td><span class="custom_chk"><input type='checkbox' class="checkbox org_Checkbox" name="org_checkbox[]" value="{{ $details['client_id'] or "" }}" id="org_checkbox" /></span></td>
            <td align="left">{{ $details['business_type'] or "" }}</td>
            <td align="left"><a href="/client/edit-org-client/{{ $details['client_id'] }}">{{ $details['business_name'] or "" }}</a></td>
            @for($i=1; $i <=5; $i++)
            <td align="left">
              <select class="form-control" name="org_staff_id{{ $i }}" id="org_staff_id{{ $i }}">
                <option value="">None</option>
                @if(!empty($staff_details))
                  @foreach($staff_details as $key=>$staff_row)
                  <option value="{{ $staff_row->user_id }}" {{ (isset( $details['allocation']['staff_id'.$i] ) && $details['allocation']['staff_id'.$i] == $staff_row->user_id)?"checked":""}}>{{ $staff_row->fname }} {{ $staff_row->lname }}</option>
                  @endforeach
                @endif
              </select>
            </td>
            @endfor
          </tr>
        @endforeach
      @endif
        
      </tbody>
    </table>
  </div>
    <div class="clearfix"></div>
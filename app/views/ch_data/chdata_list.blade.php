@extends('layouts.layout')

@section('mycssfile')
    <link href="{{ URL :: asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/ch_data.js') }}" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
$(function() {
    $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aLengthMenu": [[10, 25, 50, -1], [25, 50, 100, 200]],
        "iDisplayLength": 25,

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
            {"bSortable": false},
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
            @include('layouts.inner_leftside')
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
            </li>-->
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <!-- <li>
              <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
            <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li> -->
            <div class="clearfix"></div>
          </ul>
        </div>
      </div>
      <div class="practice_mid">
      

          <div class="tabarea">
            <div class="tab_topcon">
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-danger">MANAGE TASKS</button>
                  </li>
                  <li>
                    <button class="btn btn-info">IMPORT FROM CH</button>
                  </li>
                  <div class="clearfix"></div>
                </ul>
              </div>
              <div class="top_search_con">
                <table width="100%" border="0">
                  <tr>
                    <td>COMPANIES HOUSE</td>
                    <td>&nbsp;</td>
                    <td><button class="btn btn-danger">SYNC DATA</button></td>
                    <td>&nbsp;</td>
                    <td><a href="https://beta.companieshouse.gov.uk" target="_blank" class="btn btn-info">WEBCHECK</a></td>
                  </tr>
                </table>
              </div>
              <div class="clearfix"></div>
            </div>
            
            <!-- <div class="tab_topcon">
            
            
            <table width="100%" border="0">
              <tr>
            <td width="25%"> <div class="form-group">
            <label for="exampleInputPassword1">Search</label>
            <input type="text" id="" class="form-control">
            </div></td>
                <td width="10%">&nbsp;</td>
                <td width="3%"><input type="checkbox"/></td>
                <td width="8%">Send to Tasks</td>
                <td width="5%"><input type="text" id="" class="form-control" value="10"></td>
                <td width="15%">days before deadline</td>
                <td width="9%">&nbsp;</td>
                <td width="4%">Show</td>
                <td width="9%"><select class="form-control">
                                    <option>10</option>
                                    <option>20</option>
                                  </select></td>
                <td width="5%">entries</td>
                <td width="1%">&nbsp;</td>
              </tr>
            </table>
            
            
            
            </div> -->

        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr role="row">
                    <th><input type="checkbox"/></th>
                    <th>D01</th>
                    <th>CRN</th>
                    <th>NAME</th>
                    <th>YEAR END</th>
                    <th>AUTHEN CODE</th>
                    <th>LAST RETURN DATE</th>
                    <th>NEXT RETURN DATE</th>
                    <th>COUNT DOWN</th>
                    <th>SEND TO TASKS</th>
                    <th>NOTES</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                @if(isset($company_details) && count($company_details) >0)
                    @foreach($company_details as $key=>$details)
                        <tr class="even">
                            <td><input type="checkbox"/></td>
                            <td class="sorting_1" align="center">{{$details['incorporation_date'] or ""}}</td>
                            <td align="center">{{ $details['company_number'] or "" }}</td>
                            <td align="left"><a href="/chdata-details/{{ $details['company_number'] }}">{{ $details['company_name'] or "" }}</a></td>
                            <td align="center">{{ $details['acc_ref_date'] or "" }}</td>
                            <td align="center">{{ $details['auth_code'] or "" }}</td>
                            <td align="center">{{ $details['last_ret_made_date'] or "" }}</td>
                            <td align="center">{{ $details['next_due_date'] or "" }}</td>
                            <td align="center">{{ $details['count_down'] or "" }}</td>
                            <td align="center"><button type="button" class="btn btn-primary">Send</button></td>
                            <td align="center">+</td>
                        </tr>
                    @endforeach
                @endif
              
            </tbody>
          </table>
            
            
          </div>
        
      </div>
    </section>


</aside><!-- /.right-side -->
            
        
      
@stop



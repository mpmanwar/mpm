@extends('layouts.layout')


@section('mycssfile')

<style>
#example1_filter{position: absolute; left: -18%;} 
</style>



<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ URL :: asset('js/technical.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/org_clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/relationship.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<script>
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
            //{"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
           // {"bSortable": true},
           // {"bSortable": false},
           // {"bSortable": false},
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
        
    <table width="100%" class="table table-bordered table-hover" id="example1" aria-describedby="example1_info" style="margin-top: 15px;">

            
                            <thead>
                              <tr>
                                <td  width="5%" align="center"><strong>Delete</strong></td>
                                <td width="15%" align="center"><strong>Date & Time</strong></td>
                                <td width="55%" align="center"><strong>Topic</strong></td>
                                <td width="15%" align="center"><strong>Commentary</strong></td>
                                
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
						<tr>
						 <td align="center">
                            <a href="javascript:void(0)" data-client_id="" data-tab=""><img src="/img/cross.png"></a>                
                            </td>
                            <td align="center">               
                           4:31pm, 04september2015
                            </td>
                            <td align="center" id="frequency">
                            
                           <p id="businessname" align="center" style="margin: -3px 0px -9px 1px;font-size: 18px; font-weight: bold;color:#00acd6">Professional bodies approved for tax relief (list3)</p>
                            
                            
                            </td>
                            <td align="center">
                            <a href="#">View</a>
                            </td>

                        </tr>
									
                              
                            </tbody>
                          </table>
          
        
      </div></section>
</aside>



@stop
@extends('layouts.layout')


@section('mycssfile')


<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

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

  Table1 = $('#example1').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": true,
        //"aLengthMenu": [[90], [90]],
        //"iDisplayLength": 90,
        
  

      "aoColumns":[
            {"bSortable": false}
            /*{"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}*/
        ]

    });
    
    
    
  //Table1.fnSort( [ [2,'asc'] ] );

 

   
  

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
        <div class="practice_mid"> 
        <form>
          
          <div class="tabarea">
            <div class="row">
                        <div class="col-xs-12 ser_con">
                     <div class="service_t">SERVICES</div>
                       <table width="100%" cellspacing="0" cellpadding="0" class="table table-bordered th_con m_gap2" id="example1" aria-describedby="example1_info">
  <tr>
    <td>   
    <a href="#" target="_blank" class="registration_btn">Self Assesment and National Insurance Contributions Registration</a>
    </td>
  </tr>
  <tr>
    <td>
    <a href="#" target="_blank" class="registration_btn">Registering for Self Assessment and getting a tax return</a>
    </td>
  </tr>
  <tr>
    <td><a href="#" target="_blank" class="registration_btn">Register as an employer - Limited Company with up to 2 directors</a></td>
  </tr>
</table> 
<a href="#" class="refer_t">Refer to the excel book - book 1 stracture email</a>
                        </div>
                    
                      </div>
          </div>
        </form>
        
      </div>
</aside>




@stop
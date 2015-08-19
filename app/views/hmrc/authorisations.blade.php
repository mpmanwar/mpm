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
var Table1;

    
  $(function() {

   Table1 = $('#example1').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": true,
        "aLengthMenu": [[90], [90]],
        "iDisplayLength": 90,
        
  

      "aoColumns":[
          //  {"bSortable": false},
          //  {"bSortable": true},
           // {"bSortable": true},
          //  {"bSortable": true},
            //{"bSortable": true},
          
            {"bSortable": false}
        ]

    });
    Table1.fnSort( [ [2,'asc'] ] );
   
    }); 
    
</script>
@stop

@section('content')

<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('layouts/inner_leftside')

                </section>
                <!-- /.sidebar -->
            </aside>
           <aside class="right-side {{ $right_class }}">
                <!-- Content Header (Page header) -->
                @include('layouts.below_header')
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <h1>HMRC AUTHORISATIONS</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>-->
    <!-- Main content -->
    <section class="content">
      <div class="practice_mid"> 
        <form>
          <div class="top_buttons">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="25%"><div class="top_bts">
                    <ul>
                      <!--<li>
                        <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                      </li>-->
                      <li>
                        <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
                      </li>
                      <li>
                        <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
                      </li>
                      
                      <div class="clearfix"></div>
                  
                    </ul>
                  </div></td>

                <td width="50%">&nbsp;</td>
               
              </tr>
            </table>
          </div>
          <div class="tabarea">
            <div class="row">
                        <div class="col-xs-12">
                          <!--start table-->
                          <table width="100%" border="0" class="staff_holidays">
                          <tr>
                          <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td width="15%"><a href="#"><img src="/img/download_64.png" /></a></td>
     <td width="85%"><a href="#"><img src="/img/download_fbi2.png" /></a></td>
  </tr>
</table>

                          </td>
                         
                          </tr>
                           <!-- <tr>
                              <td valign="top"><table width="100%" border="0">
                                  <tr>
                                  <td width="5%"><strong>Search</strong></td>
                                    <td width="20%"><input type="text" id="" class="form-control"></td>
                                    
                                    
                                    <td width="36%">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td width="4%"><strong>Show</strong></td>
                                    <td width="8%"><select class="form-control">
                                        <option>50</option>
                                        <option>20</option>
                                        <option>10</option>
                                        <option>15</option>
                                      </select></td>
                                      <td width="5%"><strong>entries</strong></td>
                                  </tr>
                                </table>
                               </td>
                            </tr>-->
                            <tr>
                              <td valign="top">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dataTable" id="example1" aria-describedby="example1_info" >
  <tr>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered " >
   
  
  <tr>
    <td rowspan="2" align="center" class="padding_h"><input type="checkbox" /></td>
    <td rowspan="2" align="center" class="padding_h"><strong>NAME</strong></td>
    <td rowspan="2" align="center" class="padding_h"><strong>RESPONSIBLE PERSON</strong></td>
    <td colspan="5" align="center"><strong>PAPER AUTORISATION</strong></td>
    <td colspan="10" align="center"><strong>ONLINE AUTORISATION</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>SA/NI</strong></td>
    <td align="center"><strong>TC</strong></td>
    <td align="center"><strong>CT</strong></td>
    <td align="center"><strong>PAYE</strong></td>
    <td align="center"><strong>VAT</strong></td>
    <td align="center"><strong>SA/TC</strong></td>
    <td align="center"><strong>PAYE</strong></td>
    <td align="center"><strong>CT</strong></td>
    <td align="center"><strong>ERS</strong></td>
    <td align="center"><strong>CT</strong></td>
      <td align="center"><strong>VAT</strong></td>
    <td align="center"><strong>NOVA</strong></td>
    <td align="center"><strong>EU REFUNDS</strong></td>
    <td align="center"><strong>MOSS-US</strong></td>
    <td align="center"><strong>MOSS-NUS</strong></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="left">One Cloud Europe Limited</td>
    <td align="center">
    <select class="form-control">
    <option>50</option>
    <option>20</option>
    <option>10</option>
    <option>15</option>
    </select>
    </td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="left">Alexander Rosse Limited</td>
    <td align="center">    
    <select class="form-control">
    <option>50</option>
    <option>20</option>
    <option>10</option>
    <option>15</option>
    </select></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="left">Mr Jon Eagle</td>
    <td align="center">
    <select class="form-control">
    <option>50</option>
    <option>20</option>
    <option>10</option>
    <option>15</option>
    </select>
    </td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="left">Mr Anthony Kane</td>
    <td align="center">
    <select class="form-control">
    <option>50</option>
    <option>20</option>
    <option>10</option>
    <option>15</option>
    </select>
    </td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
        <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
</table>
</td>
    <!--<td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
  <tr>
    <td colspan="10" align="center"><strong>PAPER AUTORISATION</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>SA/TC</strong></td>
    <td align="center"><strong>PAYE</strong></td>
    <td align="center"><strong>CT</strong></td>
    <td align="center"><strong>ERS</strong></td>
    <td align="center"><strong>CT</strong></td>
    <td align="center"><strong>VAT</strong></td>
	<td align="center"><strong>NOVA</strong></td>
	<td align="center"><strong>EU REFUNDS</strong></td>
	<td align="center"><strong>MOSS-US</strong></td>
	<td align="center"><strong>MOSS-NUS</strong></td>  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>    
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>
    <td align="center"><input type="checkbox" /></td>    
  </tr>
</table></td>-->
  </tr>
</table>

                                </td>
                                
                            </tr>
                          </table>
                          <!--end table-->
                        </div>
                      </div>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </aside></div>




@stop
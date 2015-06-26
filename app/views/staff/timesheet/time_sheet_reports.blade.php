@extends('layouts.layout') @section('mycssfile')

@stop
 @section('myjsfile')
  
@stop
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
        <div class="row icon_section">
         
        </div>
        
        <div class=" col-xs-12">
<!--start staff holidays-->        
<table width="100%" border="0" class="staff_holidays">
  <tr>
    <td valign="top" class="reports_t">
    TIME SHEET REPORTS
    </td>
  </tr>

<tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="21%"><button class="btn btn-primary">GENERATE CLIENT TIME REPORT</button></td>
    <td width="79%"><button class="btn btn-primary">GENERATE USER TIME REPORT</button></td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
  <td><div class="client_timebg">GENERATE CLIENT TIME REPORT</div></td>
  </tr>
  <tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="14%"><strong>Select Client :</strong></td>
    <td colspan="2"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
    <td width="54%">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Start Date :<br>
<p class="red_text">(e.g. 01/06/2015)</p></strong></td>
    <td width="11%"><input type="text" placeholder="dd/mm/yy" /></td>
    <td width="21%">Date img</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>End Date :<br>
<p class="red_text">(e.g. 01/06/2015)</p></strong></td>
    <td width="11%"><input type="text" placeholder="dd/mm/yy" /></td>
    <td width="21%">Date img</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Time to Display :</strong></td>
    <td colspan="2"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
    <td align="right">
    <button class="btn btn-primary">SUBMIT</button>
    </td>
  </tr>
</table>
    </td>
  </tr>  
  
  
</table>

<table width="100%" border="0" class="staff_holidays gap_top">
  <tr>
    <td valign="top" class="reports_t">
    TIME SHEET REPORTS
    </td>
  </tr>

<tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="21%"><button class="btn btn-primary">GENERATE CLIENT TIME REPORT</button></td>
    <td width="79%"><button class="btn btn-primary">GENERATE USER TIME REPORT</button></td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
  <td><div class="client_timebg">GENERATE USER TIME REPORT</div></td>
  </tr>
  <tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="14%"><strong>Select Client :</strong></td>
    <td colspan="2"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
    <td width="54%">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Start Date :<br>
<p class="red_text">(e.g. 01/06/2015)</p></strong></td>
    <td width="11%"><input type="text" placeholder="dd/mm/yy" /></td>
    <td width="21%">Date img</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>End Date :<br>
<p class="red_text">(e.g. 01/06/2015)</p></strong></td>
    <td width="11%"><input type="text" placeholder="dd/mm/yy" /></td>
    <td width="21%">Date img</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Time to Display :</strong></td>
    <td colspan="2"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
    <td align="right">
    <button class="btn btn-primary">SUBMIT</button>
    </td>
  </tr>
</table>
    </td>
  </tr>  
  
  
</table>
<!--end staff holidays-->

        </div>
        <div class="clearfix"></div>
      </div>
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
@stop
<!-- time-->
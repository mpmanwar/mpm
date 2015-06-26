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
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="43%"><strong>TIME OFF</strong></td>
    <td width="12%"><strong>Awaiting Approval</strong></td>
    <td width="41%"><strong>Approaved</strong></td>
    <td width="4%">&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td valign="top">
    <table width="100%" border="0">
  <tr>
    <td width="16%"><button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button></td>
    <td width="21%">&nbsp;</td>
    <td width="4%"><strong>Show</strong></td>
<td width="7%"><select class="form-control">
<option>50</option>
<option>20</option>
<option>10</option>
<option>15</option>
</select>
</td>
<td width="8%"><strong>entries</strong></td>
<td width="17%">&nbsp;</td>
    <td width="5%"><strong>Search</strong></td>
    <td width="22%">
<input type="text" id="" class="form-control">

    </td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td valign="top">
    <table width="100%" class="table table-bordered">
                                    <tbody>
                                    <tr class="table_heading_bg">
                                     <td width="5%">&nbsp;</td>
                                      <td width="10%"><strong>Date</strong></td>
                                      <td width="17%" align="center"><strong>Staff Name</strong></td>
                                      <td width="15%" align="center"><strong>Type of event</strong></td>
                                      <td width="10%" align="center"><strong>No. of Days</strong></td>
                                      <td width="20%" align="center"><strong>Status</strong></td>
                                      <td width="23%" align="center"><strong>Message</strong></td>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">23/04/2015</td>
                                      <td align="center">R Sharma</td>
                                      <td align="center">efefewf</td>
                                      <td align="center">20 Days</td>
                                      <td align="center"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
                                      <td align="center">Awaiting Approval</td>
                                    </tr>
                                    
                                    <tr>
                                      <td><input type="checkbox" /></td>
                                      <td align="center">23/04/2015</td>
                                      <td align="center">R Sharma</td>
                                      <td align="center">efefewf</td>
                                      <td align="center">20 Days</td>
                                      <td align="center"><select class="form-control">
                                          <option>Select Relatioship Type</option>
                                          <option>Sole Tradership</option>
                                          <option>Company</option>
                                          <option>LLP</option>
                                          <option>Incorporation Charity</option>
                                          <option>Unincorporation Charity</option>
                                          <option>Other</option>
                                        </select></td>
                                      <td align="center">Awaiting Approval</td>
                                    </tr>
                                    
                                  </tbody></table>
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
<!-- staff-->
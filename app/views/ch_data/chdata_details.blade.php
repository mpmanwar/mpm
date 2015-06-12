@extends('layouts.layout')

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
              <div class="top_bts">
                <ul style="padding:0;">
                  <li>
                    <button class="btn btn-success">GENERATE PDF</button>
                  </li>
                  <li>
                    <button class="btn btn-info">WEBCHECK</button>
                  </li>
                  <li>
                    <a href="/chdata/index" class="btn btn-warning">BACK</a>
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
                  </tr>
                </table>
              </div>
              <div class="clearfix"></div>
            </div>
            
            <div class="details_table">
            <table width="100%" border="1" bordercolor="60aad2">
  <tr>
    <td width="40%" class="td_color">Company Name :</td>
    <td width="60%">{{ $details->CompanyName or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Registration Number :</td>
    <td>{{ $details->CompanyNumber or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Registered in</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="td_color">Web Filing Authentication Code :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="td_color">Company Category :</td>
    <td>{{ $details->CompanyCategory or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Company Status :</td>
    <td>{{ $details->CompanyStatus or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Country of Origin :</td>
    <td>{{ $details->CountryOfOrigin or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Incorporation Date :</td>
    <td>{{ $details->IncorporationDate or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Nature of Business :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="td_color">Accounting Reference Date :</td>
    <td>{{ $details->Accounts->AccountRefDay or "" }}/{{ $details->Accounts->AccountRefMonth or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Last Accounts made Up Date :</td>
    <td>{{ $details->Accounts->LastMadeUpDate or "" }}</td>
  </tr>
    <tr>
    <td class="td_color">Next Accounts Due :</td>
    <td>{{ $details->Accounts->NextDueDate or "" }}</td>
  </tr>
    <tr>
    <td class="td_color">Last Return Made Up To : </td>
    <td>{{ $details->Returns->LastMadeUpDate or "" }}</td>
  </tr>
    <tr>
    <td class="td_color">Next Return Due :</td>
    <td>{{ $details->Returns->NextDueDate or "" }}</td>
  </tr>
  
</table>

<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
    <td><span class="table_tead_t">REGISTERED OFFICE</span></td>
  </tr>
  <tr>
    <td>
    {{ $details->RegAddress->AddressLine1 or "" }}<br>
    {{ $details->RegAddress->AddressLine2 or "" }}<br>
    {{ $details->RegAddress->PostTown or "" }}<br>
    {{ $details->RegAddress->County or "" }}<br>
    {{ $details->RegAddress->Postcode or "" }}
    </td>
  </tr>
</table>
</div>

<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
     <td colspan="2"><span class="table_tead_t">SHARE CAPITAL</span></td>
    </tr>
  <tr>
    <td width="29%" class="td_color">Total issued :</td>
    <td width="71%">1</td>
  </tr>
  <tr>
    <td class="td_color">Currency :</td>
    <td>GBP</td>
  </tr>
  <tr>
    <td class="td_color">Total Aggregate Value:</td>
    <td>1</td>
  </tr>
</table>
</div>

<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
    <td><span class="table_tead_t">DIRECTORS</span></td>
  </tr>
  <tr>
    <td><a href="#" class="link_color" data-toggle="modal" data-target="#compose-modal"> Mr. Jude LOBO</a>
   
    </td>
  </tr>
</table>
</div>


<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2" style="text-align:center;">
  <tr class="td_color">
    <td width="80%"><span class="table_tead_t">SHARE HOLDERS</span></td>
    <td width="9%">Shares</td>
    <td width="11%">SharesClass</td>
  </tr>
  <tr>
    <td>
    Mr. Jude LOBO
    </td>
    <td>1</td>
    <td>Ordinary</td>
    
  </tr>
</table>
</div>

<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
    <td><span class="table_tead_t">SECRETARIES</span></td>
  </tr>
  <tr>
    <td><a href="#" class="link_color" data-toggle="modal" data-target="#personal_details"> Mr. Jude LOBO</a>
  </tr>
</table>
</div>
<div class="registered_table">
<table width="100%" border="1" bordercolor="60aad2" style="text-align:center;">
  <tr class="td_color">
    <td colspan="3" align="left"><span class="table_tead_t">COMPANY FILING HISTORY LIST</span></td>
  </tr>
  <tr>
    <td>
    Type</td>
    <td>Date</td>
    <td>Description</td>
  </tr>
   <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</div>


            </div>


            
            
          </div>
        </form>
      </div>
    </section>


</aside><!-- /.right-side -->
            
        
<!-- popup content -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="cross_btn1"><button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button></div>
      <div class="registered_table1 popup_align">
     
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
     <td colspan="2"><span class="table_tead_t">PERSONAL DETAILS</span></td>
    </tr>
  <tr>
    <td width="29%" class="td_color">Title :</td>
    <td width="71%">Mr.</td>
  </tr>
  <tr>
    <td class="td_color">First Name :</td>
    <td>Jude</td>
  </tr>
  <tr>
    <td class="td_color">Middle Name :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="td_color">Last Name :</td>
    <td>LOBO</td>
  </tr>
  <tr>
    <td class="td_color">DOB :</td>
    <td>1970-10-25</td>
  </tr>
  <tr>
    <td class="td_color">Nationality :</td>
    <td>British</td>
  </tr>
  <tr>
    <td class="td_color">Occupation :</td>
    <td>it Professional</td>
  </tr>
  <tr>
    <td class="td_color">Country of residence :</td>
    <td>Gbr</td>
  </tr>
   <tr class="td_color">
     <td colspan="2"><span class="table_tead_t">SERVICE ADDRESS</span></td>
    </tr>
  <tr>
    <tr>
    <td class="td_color">Address 1 :</td>
    <td>24</td>
  </tr>
   <tr>
    <td class="td_color">Address 2 :</td>
    <td>Awefwef</td>
  </tr>
   <tr>
    <td class="td_color">Address 3 :</td>
    <td></td>
  </tr>
     <tr>
    <td class="td_color">Town :</td>
    <td></td>
  </tr>
     <tr>
    <td class="td_color">Country :</td>
    <td>Leicestershire</td>
  </tr>
     <tr>
    <td class="td_color">Post Code :</td>
    <td>LE652NR</td>
  </tr>
  <tr>
    <td class="td_color">Country :</td>
    <td>GBR</td>
  </tr>
</table>
</div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="personal_details" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="cross_btn1"><button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button></div>
      <div class="registered_table1 popup_align">
     
<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
     <td colspan="2"><span class="table_tead_t">PERSONAL DETAILS</span></td>
    </tr>
  <tr>
    <td width="29%" class="td_color">Title :</td>
    <td width="71%">Mr.</td>
  </tr>
  <tr>
    <td class="td_color">First Name :</td>
    <td>Jude</td>
  </tr>
  <tr>
    <td class="td_color">Middle Name :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="td_color">Last Name :</td>
    <td>LOBO</td>
  </tr>
 
   <tr class="td_color">
     <td colspan="2"><span class="table_tead_t">ADDRESS</span></td>
    </tr>
  <tr>
    <tr>
    <td class="td_color">Address 1 :</td>
    <td>24</td>
  </tr>
   <tr>
    <td class="td_color">Address 2 :</td>
    <td>Awefwef</td>
  </tr>
   <tr>
    <td class="td_color">Address 3 :</td>
    <td></td>
  </tr>
     <tr>
    <td class="td_color">Town :</td>
    <td></td>
  </tr>
     <tr>
    <td class="td_color">Country :</td>
    <td>Leicestershire</td>
  </tr>
     <tr>
    <td class="td_color">Post Code :</td>
    <td>LE652NR</td>
  </tr>
  <tr>
    <td class="td_color">Country :</td>
    <td>GBR</td>
  </tr>
</table>
</div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>     
@stop




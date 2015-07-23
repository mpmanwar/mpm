@extends('layouts.layout')

@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/relationship.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/upload_file_other.js') }}" type="text/javascript"></script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<script>
$(document).ready(function(){
    $("#dob").datepicker({minDate: new Date(1900, 12-1, 25), maxDate:0, dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-100:+0"});
    $("#start_date").datepicker({ minDate: new Date(1900, 12-1, 25), dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-10:+10" });
    $("#holiday_entitlement").datepicker({ minDate: new Date(1900, 12-1, 25), maxDate:0, dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: "-10:+10" });

    $("#leaving_date").datepicker({ minDate: new Date(1900, 12-1, 25), dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });
})
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
    {{ Form::open(array('url' => '/staff/user-details-process', 'files' => true, 'id'=>'basicform')) }}
    <input name="user_id" id="user_id" type="hidden" value="{{ $user_id }}">
    <section class="content">
      
      <div class="row">
        
        <div class="top_bts">
          <ul>
            
            <li>
              <p style="margin:0px 0 0 500px;"><a href="javascript:void(0)" class="btn btn-info" style="font-size: 18px; font-weight: bold;">
                {{ $staff_details['initial_badge'] or "" }}
              </a></p>
            </li>
            <li>
              <p style="margin: 6px 0 0 0;font-size: 18px; font-weight: bold;color:#00acd6">{{ $staff_details['staff_name'] or "" }}</p>
            </li>
            <!-- <li>
              <button class="btn btn-danger">REQUEST FROM OLD ACCOUNTANT</button>
            </li> -->
            <div class="clearfix"></div>
          </ul>
        </div>
      </div>

    <div class="practice_mid">
        

<div class="tabarea">
  
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs nav-tabsbg" id="header_ul">
      <li class="active" id="tab_1"><a class="open_header" data-id="1" href="javascript:void(0)">GENERAL</a></li>
      <li id="tab_2"><a class="open_header" data-id="2" href="javascript:void(0)">CONTACT INFORMATION</a></li>
      <li id="tab_3"><a class="open_header" data-id="3" href="javascript:void(0)">EMPLOYMENT DETAILS</a></li>
      <li id="tab_4"><a class="open_header" data-id="4" href="javascript:void(0)">OTHERS</a></li>
    </ul>

  <div class="tab-content">

<div id="step1" class="tab-pane active" style="display:block;">
  <!--table area-->
  <div class="box-body table-responsive">
    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
      <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6"></div>
      </div>
<div class="row">  
        
<div class="col-xs-12 col-xs-6">
 <div class="col_m2">  
  
<div class="form-group">

<div class="n_box1">
<label for="exampleInputPassword1">Title</label>
<select class="form-control select_title" id="title" name="title">
  @if( isset($titles) && count($titles) >0 )
    @foreach($titles as $key=>$title_row)
    <option value="{{ $title_row->title_name }}" {{ (isset($staff_details['title']) && ($title_row->title_name == $staff_details['title']))?"selected":"" }}>{{ $title_row->title_name }}</option>
    @endforeach
  @endif
</select></div>
<div class="n_box2">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" id="fname" name="fname" value="{{ $staff_details['fname'] or "" }}" class="form-control toUpperCase"></div>
<div class="n_box3">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" id="mname" name="mname" value="{{ $staff_details['mname'] or "" }}" class="form-control"></div>
<div class="n_box4">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" id="lname" name="lname" value="{{ $staff_details['lname'] or "" }}" class="form-control toUpperCase"></div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Gender</label>
<select class="form-control" name="gender" id="gender">
  <option value="Male" {{ (isset($staff_details['gender']) && $staff_details['gender'] == "Male")?"selected":"" }}>Male</option>
  <option value="Female" {{ (isset($staff_details['gender']) && $staff_details['gender'] == "Female")?"selected":"" }}>Female</option>
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="dob" name="dob" value="{{ (isset($staff_details['dob']))?date('d-m-Y', strtotime($staff_details['dob'])):"" }}" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Marital Status</label>
<select class="form-control" name="marital_status" id="marital_status">
  @if(!empty($marital_status))
    @foreach($marital_status as $key=>$status_row)
    <option value="{{ $status_row->merital_status_id }}" {{ (isset($staff_details['marital_status']) && $status_row->merital_status_id == $staff_details['marital_status'])?"selected":"" }}>{{ $status_row->status_name }}</option>
    @endforeach
  @endif
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Nationality</label>
<select class="form-control" name="nationality" id="nationality">
@if(!empty($nationalities))
  @foreach($nationalities as $key=>$nationality_row)
    <option value="{{ $nationality_row->nationality_id }}" {{ (isset($staff_details['nationality_id']) && $nationality_row->nationality_id == $staff_details['nationality_id'])?"selected":"" }}>{{ $nationality_row->nationality_name }}</option>
  @endforeach
@endif
</select>
</div>
</div>
<div class="clearfix"></div>
</div>


<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Country</label>
<select class="form-control" name="country" id="country">
@if(!empty($countries))
  @foreach($countries as $key=>$country_row)
  @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
    <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['country']) && $country_row->country_id == $staff_details['country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
@if(!empty($countries))
  @foreach($countries as $key=>$country_row)
  @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
    <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['country_id']) && $country_row->country_id == $staff_details['country_id'])?"selected":"" }}>{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Position/Job Title</label>
<input type="text" id="occupation" name="occupation" value="{{ $staff_details['occupation'] or "" }}" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">NI Number</label>
<input type="text" id="occupation" name="occupation" value="{{ $staff_details['occupation'] or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="occupation" name="occupation" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>



    <div class="add_client_btn">
      <button class="btn btn-danger open" type="submit">Save</button>
      <button class="btn btn-info open" data-id="2" type="button">Next</button>
    </div>
    <div class="clearfix"></div>
</div>
</div>
                
                  
                </div>
            </div>
                  
                  <!--end table-->
        </div>
    </div>
                              <!--</div> -->
         
<div id="step2" class="tab-pane" style="display:none;">
  <div class="box-body table-responsive">
    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
      <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6"></div>
      </div>
      
      <div class="row">  
        <div class="col-xs-12 col-xs-6">
          <div class="col_m2">  
          
    <div class="form-group">
      <h3 class="box-title">Residential Address</h3>
      <div class="clearfix"></div>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line1</label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" value="{{ $staff_details['res_addr_line1']  or "" }}" class="form-control" />
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line2</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" value="{{ $staff_details['res_addr_line2']  or "" }}" class="form-control" />
    </div>

    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">City/Town</label>
          <input type="text" id="res_city" name="res_city" value="{{ $staff_details['res_city']  or "" }}" class="form-control">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">County</label>
          <input type="text" id="res_county" name="res_county" value="{{ $staff_details['res_county']  or "" }}" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['res_postcode']  or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Country</label>
  <select class="form-control" name="res_country" id="res_country">
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['res_country']) && $country_row->country_id == $staff_details['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['res_country']) && $country_row->country_id == $staff_details['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>


  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_tele_code" value="{{ $staff_details['serv_tele_code']  or "" }}" name="serv_tele_code" class="form-control" readonly />
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="serv_telephone" name="serv_telephone" value="{{ $staff_details['serv_telephone']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_mobile_code" value="{{$staff_details['serv_mobile_code']  or ""}}" name="serv_mobile_code" class="form-control" readonly />
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="serv_mobile" name="serv_mobile" value="{{ $staff_details['serv_mobile']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>


    <div class="form-group">
    <label for="exampleInputPassword1">Email (Personal)</label>
    <input type="text" id="email" name="email" value="{{ $staff_details['email']  or "" }}" class="form-control">
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Skype</label>
    <input type="text" id="serv_website" name="serv_website" value="{{ $staff_details['serv_website']  or "" }}" class="form-control">
    </div>

    <div class="form-group">
      <h3>Emergency Contact</h3>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" id="serv_website" name="serv_website" value="{{ $staff_details['serv_website']  or "" }}" class="form-control">
    </div>

    <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_tele_code" value="{{ $staff_details['serv_tele_code']  or "" }}" name="serv_tele_code" class="form-control" readonly />
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="serv_telephone" name="serv_telephone" value="{{ $staff_details['serv_telephone']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_mobile_code" value="{{$staff_details['serv_mobile_code']  or ""}}" name="serv_mobile_code" class="form-control" readonly />
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="serv_mobile" name="serv_mobile" value="{{ $staff_details['serv_mobile']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

    <div class="add_client_btn">
      <button class="btn btn-info back" data-id="1" type="button">Prev</button>
      <button class="btn btn-danger" type="submit">Save</button>
      <button class="btn btn-info open" data-id="3" type="button">Next</button>
    </div>
    <div class="clearfix"></div>


          </div>
 
        </div>
                   
      </div>
                      
    </div>
  </div>
</div>


<div id="step3" class="tab-pane" style="display:none;">
  <div class="box-body table-responsive">
    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
      <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6"></div>
      </div>
      
      <div class="row">  
        <div class="col-xs-12 col-xs-6">
          <div class="col_m2">  
          
    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">Start Date</label>
          <input type="text" id="start_date" name="start_date" value="{{ $staff_details['start_date']  or "" }}" class="form-control">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">Holiday Entitlement</label>
          <input type="text" id="holiday_entitlement" name="holiday_entitlement" value="{{ $staff_details['holiday_entitlement']  or "" }}" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Salary</label>
<input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['res_postcode']  or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Department</label>
  <select class="form-control" name="res_country" id="res_country">
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['res_country']) && $country_row->country_id == $staff_details['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['res_country']) && $country_row->country_id == $staff_details['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>


  <div class="form-group">
    <label for="exampleInputPassword1">Qualifications</label>
    <input type="text" id="serv_website" name="serv_website" value="{{ $staff_details['serv_website']  or "" }}" class="form-control">
  </div>

  
  <div class="twobox">
    <div class="twobox_1">
      <div class="form-group">
        <label for="exampleInputPassword1">Leaving Date</label>
        <input type="text" id="leaving_date" name="leaving_date" value="{{ $staff_details['leaving_date']  or "" }}" class="form-control">
      </div>
    </div>

    <div class="twobox_2">
      <div class="form-group">

      </div>
    </div>
    <div class="clearfix"></div>
  </div>

    
  <div class="add_client_btn">
    <button class="btn btn-info back" data-id="2" type="button">Prev</button>
    <button class="btn btn-danger" type="submit">Save</button>
    <button class="btn btn-info open" data-id="4" type="button">Next</button>
  </div>
  <div class="clearfix"></div>


          </div>
 
        </div>
                   
      </div>
                      
    </div>
  </div>
</div>
         

<div id="step4" class="tab-pane" style="display:none;">
  <div class="box-body table-responsive">
    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
      <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6"></div>
      </div>
      
      <div class="row">  
    
   <div class="col-xs-12 col-xs-6">
 <div class="col_m2"> 
 <div class="other_table"> 
<h3 class="box-title">Bank Details</h3> 

  <div class="twobox">
    <div class="twobox_1">
      <div class="form-group">
        <label for="exampleInputPassword1">Bank Name</label>
        <input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['res_postcode']  or "" }}" class="form-control">
      </div>
    </div>

    <div class="twobox_2">
      <div class="form-group">
        
      </div>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="twobox">
    <div class="twobox_1">
      <div class="form-group">
        <label for="exampleInputPassword1">Short Code</label>
        <input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['res_postcode']  or "" }}" class="form-control">
      </div>
    </div>

    <div class="twobox_2">
      <div class="form-group">
        <label for="exampleInputPassword1">Account Number</label>
        <input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['res_postcode']  or "" }}" class="form-control">
      </div>
    </div>
    <div class="clearfix"></div>
  </div>


<div class="form-group">
<table width="100%" border="0" class="other_staff_table" id="other_staff_table">
  <tbody>
    <tr>
      <td width="45%"><strong>Employment Contract</strong></td>
      <td width="22%"><img src="/img/download.png"></td>
      <td id="apassport1">
        Anwar <a href="javascript:void(0)" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        
      </td>
    </tr>

    <tr>
      <td width="45%"><strong>Staff Handbook</strong></td>
      <td width="22%"><img src="/img/download.png"></td>
      <td id="apassport1">
        Anwar <a href="javascript:void(0)" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        
      </td>
    </tr>

    <tr>
      <td width="45%"><strong>CV</strong></td>
      <td width="22%"><img src="/img/download.png"></td>
      <td id="apassport1">
        Anwar <a href="javascript:void(0)" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        
      </td>
    </tr>

    <tr>
      <td width="45%"><strong>OTHERS</strong></td>
      <td width="22%"><img src="/img/download.png"></td>
      <td id="apassport1">
        Anwar <a href="javascript:void(0)" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        
      </td>
    </tr>


    <tr>
      <td width="45%"><strong>ID and Proof of Address</strong></td>
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="upload_file" name="passport1"  id="passport1">
        </span></td>
      <td id="apassport1">&nbsp;</td>
    </tr>

    <tr>
      <td width="45%"><strong>Acadamic Certificate</strong></td>
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="upload_file" name="passport1"  id="passport1">
        </span></td>
      <td id="apassport1">&nbsp;</td>
    </tr>

    <tr>
      <td width="45%"><strong>Others</strong></td>
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="upload_file" name="passport1"  id="passport1">
        </span></td>
      <td id="apassport1">&nbsp;</td>
    </tr>

    <tr>
      <td width="45%"><strong>Copy of Signature</strong></td>
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="upload_file" name="passport1"  id="passport1">
        </span></td>
      <td id="apassport1">&nbsp;</td>
    </tr>
      
  </tbody>
</table>
<div class="clearfix"></div>
</div>





<div class="clearfix"></div>

</div>


<div class="add_client_btn">
<!-- <button class="btn btn-info">Next</button> -->
<button class="btn btn-info back" data-id="3" type="button">Prev</button>
<button class="btn btn-danger save" type="submit">Save</button>

</div>
<div class="clearfix"></div>
</div>
                   
                   
                   </div>
                   

                  
                    </div>
                      
                    </div>
                  </div>
                </div>
       

</div>
          </div>
          



            
          </div>
        
    



      </div>
    </section>

{{ Form::close() }}

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->





<!-- @include("home.include.client_modal_page") -->

@stop
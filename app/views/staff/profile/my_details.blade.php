@extends('layouts.layout')

@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/profile.js') }}" type="text/javascript"></script>
<script src="{{ URL :: asset('js/jquery.form.js') }}" type="text/javascript"></script>
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
    
     <input type="hidden"  name="page_name"  id="page_name" value="{{ $page_name }}">
     
       
<input type="hidden" name="oldstafffile1"  id="oldstafffile1" value="{{ $staff_details['step_data']['stafffile1']  or "" }}">
<input type="hidden" name="oldstafffile2"  id="oldstafffile2" value="{{ $staff_details['step_data']['stafffile2']  or "" }}">
<input type="hidden" name="oldstafffile3"  id="oldstafffile3" value="{{ $staff_details['step_data']['stafffile3']  or "" }}">
<input type="hidden" name="oldstafffile4"  id="oldstafffile4" value="{{ $staff_details['step_data']['stafffile4']  or "" }}">



<input type="hidden" name="oldprofilefile1"  id="oldprofilefile1" value="{{ $staff_details['step_data']['profilefile1']  or "" }}">
<input type="hidden" name="oldprofilefile2"  id="oldprofilefile2" value="{{ $staff_details['step_data']['profilefile2']  or "" }}">
<input type="hidden" name="oldprofilefile3"  id="oldprofilefile3" value="{{ $staff_details['step_data']['profilefile3']  or "" }}">
<input type="hidden" name="oldprofilefile4"  id="oldprofilefile4" value="{{ $staff_details['step_data']['profilefile4']  or "" }}">
     
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
    <option value="{{ $title_row->title_name }}" {{ (isset($staff_details['step_data']['title']) && ($title_row->title_name == $staff_details['step_data']['title']))?"selected":"" }}>{{ $title_row->title_name }}</option>
    @endforeach
  @endif
</select></div>

<input type="hidden" name="staff_id" id="staff_id" value="{{ $staff_id }}"/>
<div class="n_box2">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" id="fname" name="fname" value="{{ $staff_details['fname'] or "" }}" class="form-control toUpperCase"></div>
<div class="n_box3">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" id="mname" name="mname" value="{{ $staff_details['step_data']['mname'] or "" }}" class="form-control"></div>
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
  <option value="Male" {{ (isset($staff_details['step_data']['gender']) && $staff_details['step_data']['gender'] == "Male")?"selected":"" }}>Male</option>
  <option value="Female" {{ (isset($staff_details['step_data']['gender']) && $staff_details['step_data']['gender'] == "Female")?"selected":"" }}>Female</option>
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="dob" name="dob" value="{{ (isset($staff_details['step_data']['dob']))?date('d-m-Y', strtotime($staff_details['step_data']['dob'])):"" }}" class="form-control">
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
           
    <option value="{{ $status_row->marital_status_id }}" {{ (isset($staff_details['step_data']['marital_status']) && $status_row->marital_status_id == $staff_details['step_data']['marital_status'])?"selected":"" }}>{{ $status_row->status_name }}</option>
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
    <option value="{{ $nationality_row->nationality_id }}" {{ (isset($staff_details['step_data']['nationality']) && $nationality_row->nationality_id == $staff_details['step_data']['nationality'])?"selected":"" }}>{{ $nationality_row->nationality_name }}</option>
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
    <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['step_data']['country']) && $country_row->country_id == $staff_details['step_data']['country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
@if(!empty($countries))
  @foreach($countries as $key=>$country_row)
  @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
    <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['step_data']['country']) && $country_row->country_id == $staff_details['step_data']['country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Position/Job Title</label>
<a href="#" class="add_to_list" data-toggle="modal" data-target="#addcompose-modal"> Add/Edit list</a>
   <!-- <input type="text" id="position" name="position" value="{{ $staff_details['step_data']['position'] or "" }}" class="form-control"> 
   -->
   
   
   
   <select class="form-control" name="position_type" id="position_type">
                     
                      @if( isset($old_postion_types) && count($old_postion_types) >0 )
                        @foreach($old_postion_types as $key=>$old_org_row)
                        <option value="{{ $old_org_row->position_id }}" {{ (isset($staff_details['step_data']['position_type']) && $staff_details['step_data']['position_type'] == $old_org_row->position_id)?"selected":"" }}>{{ $old_org_row->name }}</option>
                        @endforeach
                      @endif

                      @if( isset($new_postion_types) && count($new_postion_types) >0 )
                        @foreach($new_postion_types as $key=>$new_org_row)
                        <option value="{{ $new_org_row->position_id }}" {{ (isset($staff_details['step_data']['position_type']) && $staff_details['step_data']['position_type'] == $new_org_row->position_id)?"selected":"" }}>{{ $new_org_row->name }}</option>
                        
                        @endforeach
                      @endif
                     
                     
                    </select>
   
 
   
<!--
<select class="form-control" name="position_type" id="position_type">
       
        @if( isset($old_postion_types) && count($old_postion_types) >0 )
          @foreach($old_postion_types as $key=>$old_org_row)
          <option value="{{ $old_org_row->position_id }}">{{ $old_org_row->name }}</option>
          @endforeach
        @endif

        @if( isset($new_postion_types) && count($new_postion_types) >0 )
          @foreach($new_postion_types as $key=>$new_org_row)
          <option value="{{ $new_org_row->position_id }}">{{ $new_org_row->name }}</option>
          @endforeach
        @endif
       
      </select> -->

</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">NI Number</label>
<input type="text" id="ni_number" name="ni_number" class="form-control" value="{{ $staff_details['step_data']['ni_number'] or "" }}" >
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="tax_reference" name="tax_reference" class="form-control" value="{{ $staff_details['step_data']['tax_reference'] or "" }}" >
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Professional body</label>
<input type="text" id="professional_body" name="professional_body" class="form-control" value="{{ $staff_details['step_data']['professional_body'] or "" }}" >
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Membership/Student number</label>
<input type="text" id="student_number" name="student_number" class="form-control" value="{{ $staff_details['step_data']['student_number'] or "" }}" >
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
      <input type="text" id="res_addr_line1" name="res_addr_line1" value="{{ $staff_details['step_data']['res_addr_line1']  or "" }}" class="form-control" />
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line2</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" value="{{ $staff_details['step_data']['res_addr_line2']  or "" }}" class="form-control" />
    </div>

    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">City/Town</label>
          <input type="text" id="res_city" name="res_city" value="{{ $staff_details['step_data']['res_city']  or "" }}" class="form-control">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">County</label>
          <input type="text" id="res_county" name="res_county" value="{{ $staff_details['step_data']['res_county']  or "" }}" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Postcode</label>
<input type="text" id="res_postcode" name="res_postcode" value="{{ $staff_details['step_data']['res_postcode']  or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Country</label> 

  <select class="form-control service_country" name="res_country" id="res_country">
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['step_data']['res_country']) && $country_row->country_id == $staff_details['step_data']['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
        <option value="{{ $country_row->country_id }}" {{ (isset($staff_details['step_data']['res_country']) && $country_row->country_id == $staff_details['step_data']['res_country'])?"selected":"" }}>{{ $country_row->country_name }}</option>
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
      <input type="text" id="serv_tele_code" value="{{ $staff_details['step_data']['serv_tele_code']  or "" }}" name="serv_tele_code" class="form-control" readonly />
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="serv_telephone" name="serv_telephone" value="{{ $staff_details['step_data']['serv_telephone']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_mobile_code" value="{{$staff_details['step_data']['serv_mobile_code']  or ""}}" name="serv_mobile_code" class="form-control" readonly />
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="serv_mobile" name="serv_mobile" value="{{ $staff_details['step_data']['serv_mobile']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>


    <div class="form-group">
    <label for="exampleInputPassword1">Email (Personal)</label>
    <input type="text" id="email" name="email" value="{{ $staff_details['email']  or "" }}" class="form-control">
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Skype</label>
    <input type="text" id="skype" name="skype" value="{{ $staff_details ['step_data']['skype']  or "" }}" class="form-control">
    </div>

    <div class="form-group">
      <h3>Emergency Contact</h3>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" id="emer_name" name="emer_name" value="{{ $staff_details['step_data']['emer_name']  or "" }}" class="form-control">
    </div>

    <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="emer_tele_code" value="{{ $staff_details['step_data']['serv_tele_code']  or "" }}" name="serv_tele_code" class="form-control" readonly />
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="emer_telephone" name="emer_telephone" value="{{ $staff_details['step_data']['emer_telephone']  or "" }}" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="emer_mobile_code" value="{{$staff_details['step_data']['serv_mobile_code']  or ""}}" name="serv_mobile_code" class="form-control" readonly />
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="emer_mobile" name="emer_mobile" value="{{ $staff_details['step_data']['emer_mobile']  or "" }}" class="form-control"></div>
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
          
           @if($page_name== 'staff')
          
    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">Start Date</label>
          <input type="text" id="sstart_date" name="start_date" value="{{ $staff_details['step_data']['start_date']  or "" }}" class="form-control" readonly="readonly" readonly="readonly">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">Holiday Entitlement</label>
          <input type="text" id="sholiday_entitlement" name="holiday_entitlement" value="{{ $staff_details['step_data']['holiday_entitlement']  or "" }}" class="form-control" readonly="readonly">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Salary</label>
<input type="text" id="salary" name="salary" value="{{ $staff_details['step_data']['salary']  or "" }}" class="form-control" readonly="readonly">
</div>
</div>

@endif
 @if($page_name== 'profile')
          
    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">Start Date</label>
          <input type="text" id="start_date" name="start_date" value="{{ $staff_details['step_data']['start_date']  or "" }}" class="form-control" >
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">Holiday Entitlement</label>
          <input type="text" id="sholiday_entitlement" name="holiday_entitlement" value="{{ $staff_details['step_data']['holiday_entitlement']  or "" }}" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Salary</label>
<input type="text" id="salary" name="salary" value="{{ $staff_details['step_data']['salary']  or "" }}" class="form-control">
</div>
</div>

@endif





<div class="twobox_2">
<div class="form-group">

<label for="exampleInputPassword1">Department</label>
<a href="#" class="add_to_list" data-toggle="modal" data-target="#adddeptcompose-modal"> Add/Edit list</a>
  
  <select class="form-control" name="department" id="department">
 
 
 
 @if( isset($old_department_types) && count($old_department_types) >0 )
                        @foreach($old_department_types as $key=>$old_department_row)
                        <option value="{{ $old_department_row->department_id }}" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == $old_department_row->department_id)?"selected":"" }}>{{ $old_department_row->name }}</option>
                        @endforeach
                      @endif

                      @if( isset($new_department_types) && count($new_department_types) >0 )
                        @foreach($new_department_types as $key=>$new_department_row)
                        <option value="{{ $new_department_row->department_id }}" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == $new_department_row->department_id)?"selected":"" }}>{{ $new_department_row->name }}</option>
                        
                        @endforeach
                      @endif
 
 
 
<!-- <option value="php" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == "php")?"selected":"" }} >PHP</option>
    <option value="java" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == "java")?"selected":"" }} >Java</option>
    <option value="net" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == "net")?"selected":"" }}>Net</option>
    <option value="ios" {{ (isset($staff_details['step_data']['department']) && $staff_details['step_data']['department'] == "ios")?"selected":"" }}  >IOs</option> -->
   
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>


  <div class="form-group">
    <label for="exampleInputPassword1">Qualifications</label>
    <input type="text" id="qualifications" name="qualifications" value="{{ $staff_details['step_data']['qualifications']  or "" }}" class="form-control">
  </div>

  
  <div class="twobox">
    <div class="twobox_1">
      <div class="form-group">
        <label for="exampleInputPassword1">Leaving Date</label>
        <input type="text" id="leaving_date" name="leaving_date" value="{{ $staff_details['step_data']['leaving_date']  or "" }}" class="form-control">
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
        <input type="text" id="bank_name" name="bank_name" value="{{ $staff_details['step_data']['bank_name']  or "" }}" class="form-control">
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
        <input type="text" id="short_code" name="short_code" value="{{ $staff_details['step_data']['short_code']  or "" }}" class="form-control">
      </div>
    </div>

    <div class="twobox_2">
      <div class="form-group">
        <label for="exampleInputPassword1">Account Number</label>
        <input type="text" id="acc_no" name="acc_no" value="{{ $staff_details['step_data']['acc_no']  or "" }}" class="form-control">
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  @if($page_name== 'staff')
  
  <div class="twobox">
    
    
    <div class="form-group">
        <label for="exampleInputPassword1">Note</label>
        <textarea rows="2" cols="50" id="note" name="note" value="{{ $staff_details['step_data']['note']  or "" }}" class="form-control"></textarea>
      </div>
    
  </div>
@endif

<div class="form-group">
<table width="100%" border="0" class="other_staff_table" id="other_staff_table">
  <tbody>
    <tr>
      <td width="45%"><strong>Employment Contract</strong></td>
      @if($page_name== 'profile')
      
      
      <td width="22%">
      @if ( (isset($staff_details['step_data']['stafffile1'])) && (!empty($staff_details['step_data']['stafffile1'])) )
      <a href="/uploads/stafffile/{{ $staff_details['step_data']['stafffile1'] }}" download="{{ $staff_details['step_data']['stafffile1'] }}">
      @endif
      <img src="/img/download.png"></a></td>
      <td id="apassport1">
        
        
        @if ( (isset($staff_details['step_data']['stafffile1'])) && (!empty($staff_details['step_data']['stafffile1'])) )

        {{ $staff_details['step_data']['stafffile1']  or "" }}
         <a href="/delete-stafffile/{{$staff_details['step_staffids']['stafffile1']}}" data-id="" data-column="passport1" data-path="uploads/stafffile/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        @endif
        
        
         @endif
         
         
      </td> 
     
      @if($page_name== 'staff')
         
         
        
         
          <td width="22%">
            <span class="btn btn-default btn-file"> Browse
                <input type="file" class="staffupload_file" name="stafffile1"  id="stafffile1" >
              
            </span>
          
          </td>
          
          
      <td id="default_staffile1"></td>
           @endif
      
    </tr>

    <tr>
    
      <td width="45%"><strong>Staff Handbook</strong></td>
      @if($page_name== 'profile')
      
      <td width="22%">
      @if ( (isset($staff_details['step_data']['stafffile2'])) && (!empty($staff_details['step_data']['stafffile2'])) )
      <a href="/uploads/stafffile/{{ $staff_details['step_data']['stafffile2'] }}" download="{{ $staff_details['step_data']['stafffile2'] }}">
      @endif
      <img src="/img/download.png"></a>
      
      </td>
      <td id="apassport1">
      
      @if ( (isset($staff_details['step_data']['stafffile2'])) && (!empty($staff_details['step_data']['stafffile2'])) )
        {{ $staff_details['step_data']['stafffile2']  or "" }} <a href="/delete-stafffile/{{$staff_details['step_staffids']['stafffile2']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>       @endif
        @endif
      </td>
      @if($page_name== 'staff')
         
          <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="stafffile2"  id="stafffile2">
        
        </span>
        
        </td>
      <td id="default_staffile2"></td>
           @endif
    </tr>

    <tr>
      <td width="45%"><strong>CV</strong></td>
      @if($page_name== 'profile')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['stafffile3'])) && (!empty($staff_details['step_data']['stafffile3'])) )
      <a href="/uploads/stafffile/{{ $staff_details['step_data']['stafffile3'] }}" download="{{ $staff_details['step_data']['stafffile3'] }}">
      @endif <img src="/img/download.png"></a></td>
      <td id="apassport1">
      @if ( (isset($staff_details['step_data']['stafffile3'])) && (!empty($staff_details['step_data']['stafffile3'])) )
        {{ $staff_details['step_data']['stafffile3']  or "" }} <a href="/delete-stafffile/{{$staff_details['step_staffids']['stafffile3']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>           
        @endif
        @endif
      </td>
      @if($page_name== 'staff')
         
          <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="stafffile3"  id="stafffile3">
        
        </span>
        
        </td>
      <td id="default_staffile3"></td>
           @endif
    </tr>

    <tr>
      <td width="45%"><strong>OTHERS</strong></td>
      @if($page_name== 'profile')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['stafffile4'])) && (!empty($staff_details['step_data']['stafffile4'])) )
      <a href="/uploads/stafffile/{{ $staff_details['step_data']['stafffile4'] }}" download="{{ $staff_details['step_data']['stafffile4'] }}">@endif <img src="/img/download.png"> 
      </a>
      </td>
      <td id="apassport1">
      @if ( (isset($staff_details['step_data']['stafffile4'])) && (!empty($staff_details['step_data']['stafffile4'])) )
        {{ $staff_details['step_data']['stafffile4']  or "" }} <a href="/delete-stafffile/{{$staff_details['step_staffids']['stafffile4']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
        @endif
        @endif
      </td>
      
        @if($page_name== 'staff')
         <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="stafffile4"  id="stafffile4">
        
        </span>
        
        </td>
      <td id="default_staffile4"></td>
           @endif
    </tr>


    <tr>
      <td width="45%"><strong>ID and Proof of Address</strong></td>
     
     @if($page_name== 'profile')
     
     
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file"  name="profilefile1"  id="profilefile1">
        
            
        
        </span></td>
      <td id="default_proffile1"></td>
      @endif
      @if($page_name== 'staff')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['profilefile1'])) && (!empty($staff_details['step_data']['profilefile1'])) )
      <a href="/uploads/profilefile/{{ $staff_details['step_data']['profilefile1'] }}" download="{{ $staff_details['step_data']['profilefile1'] }}">
      @endif <img src="/img/download.png"></a></td>
      <td id="apassport1">
        @if ( (isset($staff_details['step_data']['profilefile1'])) && (!empty($staff_details['step_data']['profilefile1'])) )
        {{ $staff_details['step_data']['profilefile1'] or "" }} <a href="/delete-stafffile/{{$staff_details['step_profids']['profilefile1']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
      @endif
      @endif
    </tr>

    <tr>
    
      <td width="45%"><strong>Acadamic Certificate</strong></td>
       @if($page_name== 'profile')
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="profilefile2"  id="profilefile2">
        
        </span>
        
        </td>
      <td id="default_proffile2"></td>
      @endif
      @if($page_name== 'staff')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['profilefile2'])) && (!empty($staff_details['step_data']['profilefile2'])) )
      <a href="/uploads/profilefile/{{ $staff_details['step_data']['profilefile2'] }}" download="{{ $staff_details['step_data']['profilefile2'] }}">
      @endif <img src="/img/download.png"></a></td>
      <td id="apassport1">
        @if ( (isset($staff_details['step_data']['profilefile2'])) && (!empty($staff_details['step_data']['profilefile2'])) )
        {{ $staff_details['step_data']['profilefile2']  or "" }} <a href="/delete-stafffile/{{$staff_details['step_profids']['profilefile2']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
      @endif
      @endif
    </tr>

    <tr>
    
      <td width="45%"><strong>Others</strong></td>
       @if($page_name== 'profile')
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="profilefile3"  id="profilefile3">
        
        </span></td>
      <td id="default_proffile3"></td>
      @endif
      @if($page_name== 'staff')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['profilefile3'])) && (!empty($staff_details['step_data']['profilefile3'])) )
      <a href="/uploads/profilefile/{{ $staff_details['step_data']['profilefile3'] }}" download="{{ $staff_details['step_data']['profilefile3'] }}">
      @endif <img src="/img/download.png"></a></td>
      <td id="apassport1">
        @if ( (isset($staff_details['step_data']['profilefile3'])) && (!empty($staff_details['step_data']['profilefile3'])) )
        {{ $staff_details['step_data']['profilefile3']  or "" }}<a href="/delete-stafffile/{{$staff_details['step_profids']['profilefile3']}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
      @endif
      @endif
    </tr>

    <tr>
    
      <td width="45%"><strong>Copy of Signature</strong></td>
      @if($page_name== 'profile')
      <td width="22%"><span class="btn btn-default btn-file"> Browse
        <input type="file" class="staffupload_file" name="profilefile4"  id="profilefile4">
        
        </span></td>
      <td id="default_proffile4"></td>
      @endif
      @if($page_name== 'staff')
      <td width="22%">
      
      @if ( (isset($staff_details['step_data']['profilefile4'])) && (!empty($staff_details['step_data']['profilefile4'])) )
      <a href="/uploads/profilefile/{{ $staff_details['step_data']['profilefile4'] or "" }}" download="{{ $staff_details['step_data']['profilefile4'] or "" }}">
      @endif <img src="/img/download.png"></a></td>
      <td id="apassport1">
      @if ( (isset($staff_details['step_data']['profilefile4'])) && (!empty($staff_details['step_data']['profilefile4'])) )
        {{ $staff_details['step_data']['profilefile4']  or "" }}<a href="/delete-stafffile/{{$staff_details['step_profids']['profilefile4'] or ""}}" data-id="" data-column="passport1" data-path="uploads/passports/" class="delete_files"><img src="/img/cross.png" height="12"></a>
      @endif
      @endif
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



<!-- add/edit list modal -->
<div class="modal fade" id="addcompose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
      
    {{ Form::open(array('url' => '/add-position-type', 'id'=>'field_form')) }}
    
    <!-- <input type="hidden" name="client_type" id="client_type" value="org"> -->
    
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        
        <input type="text" id="org_name" name="org_name" placeholder="Position/Job Title" class="form-control">
      </div>
      
      <div id="append_position_type">
      @if( isset($old_postion_types) && count($old_postion_types) >0 )
        @foreach($old_postion_types as $key=>$old_org_row)
        <div class="form-group">
          <label for="{{ $old_org_row->name }}">{{ $old_org_row->name }}</label>
        </div>
        @endforeach
      @endif

      @if( isset($new_postion_types) && count($new_postion_types) >0 )
        @foreach($new_postion_types as $key=>$new_org_row)
        <div class="form-group" id="hide_div_{{ $new_org_row->position_id }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_org_name" data-field_id="{{ $new_org_row->position_id }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $new_org_row->name }}">{{ $new_org_row->name }}</label>
        </div>
        @endforeach
      @endif
      </div>
      
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_position_type" name="save">Save</button>
          <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<!-- add/edit list modal for DEPT -->
<div class="modal fade" id="adddeptcompose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
      
    {{ Form::open(array('url' => '/add-department-type', 'id'=>'field_form')) }}
    
    <!-- <input type="hidden" name="client_type" id="client_type" value="org"> -->
    
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        
        <input type="text" id="dept_name" name="dept_name" placeholder="Department" class="form-control">
      </div>
      
      <div id="append_department_type">
      @if( isset($old_department_types) && count($old_department_types) >0 )
        @foreach($old_department_types as $key=>$old_department_row)
        <div class="form-group">
          <label for="{{ $old_department_row->name }}">{{ $old_department_row->name }}</label>
        </div>
        @endforeach
      @endif

      @if( isset($new_department_types) && count($new_department_types) >0 )
        @foreach($new_department_types as $key=>$new_department_row)
        <div class="form-group" id="hide_deptdiv_{{ $new_department_row->department_id }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_department_name" data-field_id="{{ $new_department_row->department_id }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $new_department_row->name }}">{{ $new_department_row->name }}</label>
        </div>
        @endforeach
      @endif
      </div>
      
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_department_type" name="save">Save</button>
          <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




@stop
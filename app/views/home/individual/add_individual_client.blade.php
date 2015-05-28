@extends('layouts.layout')

@section('mycssfile')
<!-- Date picker script -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<!-- Date picker script -->
@stop

@section('myjsfile')
<script src="{{ URL :: asset('js/clients.js') }}" type="text/javascript"></script>
<!-- Date picker script -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Date picker script -->
<script>
$(document).ready(function(){
    $("#dob").datepicker({minDate: new Date(1900, 12-1, 25), maxDate:0, dateFormat: 'dd/mm/yy'});
    $("#app_date").datepicker({ minDate: new Date(1900, 12-1, 25), dateFormat: 'dd/mm/yy' });
    $("#spouse_dob").datepicker({ minDate: new Date(1900, 12-1, 25), maxDate:0, dateFormat: 'dd/mm/yy' });
})
</script>

    
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ URL :: asset('img/user3.jpg') }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side {{ $right_class }}">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADD CLIENT
                        <!-- <small>CLIENT NAME  Limited</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li class="active">Add Clients</li> -->
                    </ol>
                </section>

    <!-- Main content -->
    {{ Form::open(array('url' => '/individual/insert-client-details', 'files' => true, 'id'=>'basicform')) }}
    <section class="content">

      <div class="row">
        <div class="top_bts">
          <ul>
            <!-- <li>
              <button class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </li>
            <li>
              <button class="btn btn-success"><i class="fa fa-download"></i> Generate PDF</button>
            </li>
            <li>
              <button class="btn btn-primary"><i class="fa fa fa-file-text-o"></i> Excel</button>
            </li>
            <li>
              <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
            </li>
            <li>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </li> -->
            <li>
              <button class="btn btn-success">IMPORT FROM CSV</button>
            </li>
            <li>
              <button class="btn btn-primary">REQUEST FROM CLIENT</button>
            </li>
            <li>
              <button class="btn btn-danger">REQUEST FROM OLD ACCOUNTANT</button>
            </li>
            <div class="clearfix"></div>
          </ul>
        </div>
      </div>

    <div class="practice_mid">
        

<div class="tabarea">
  
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs nav-tabsbg" id="header_ul">
        <li class="active" id="tab_1"><a class="open_header" data-id="1" href="javascript:void(0)">GENERAL</a></li>
        <li id="tab_2"><a class="open_header" data-id="2" href="javascript:void(0)">TAX INFORMATION</a></li>
        <li id="tab_3"><a class="open_header" data-id="3" href="javascript:void(0)">CONTACT INFORMATION</a></li>
        <li id="tab_4"><a class="open_header" data-id="4" href="javascript:void(0)">RELATIONSHIP</a></li>
        <li id="tab_5"><a class="open_header" data-id="5" href="javascript:void(0)">OTHERS</a></li>
         
        <li><a href="#" class=" btn-block btn-primary " data-toggle="modal" data-target="#compose-modal"><i class="fa fa-plus"></i> New Field
         
        </a></li>
        
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
<label for="exampleInputPassword1">Client Code</label>
  <input type="text" id="client_code" name="client_code" class="form-control"></div>
</div>

<div class="form-group">

<div class="clearfix"></div>
<div class="n_box1">
<label for="exampleInputPassword1">Title</label>
<select class="form-control" id="title" name="title">
  @if(!empty($titles))
    @foreach($titles as $key=>$title_row)
    <option value="{{ $title_row->title_id }}">{{ $title_row->title_name }}</option>
    @endforeach
  @endif
</select></div>
<div class="n_box2">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" id="fname" name="fname" class="form-control"></div>
<div class="n_box3">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" id="mname" name="mname" class="form-control"></div>
<div class="n_box4">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" id="lname" name="lname" class="form-control"></div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Sex</label>
<select class="form-control" name="sex" id="sex">
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Date of Birth</label>
<input type="text" id="dob" name="dob" class="form-control">
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
    <option value="{{ $status_row->merital_status_id }}">{{ $status_row->status_name }}</option>
    @endforeach
  @endif
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Spouse Date of Birth</label>
<input type="text" id="spouse_dob" name="spouse_dob" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>


<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Nationality</label>
<select class="form-control" name="nationality" id="nationality">
@if(!empty($countries))
  @foreach($countries as $key=>$country_row)
  @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
@if(!empty($countries))
  @foreach($countries as $key=>$country_row)
  @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
    <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
  @endif
  @endforeach
@endif
</select>
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Occupation</label>
<input type="text" id="occupation" name="occupation" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>


<!-- This portion is for user created field -->
@if(!empty($steps_fields_users) && count($steps_fields_users) > 0)
  @foreach($steps_fields_users as $row_fields)
    @if(!empty($row_fields->step_id) && $row_fields->step_id == "1")
      <div class="form-group">
      <div class="twobox_2">
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }} 
        &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_user_field" data-field_id="{{ $row_fields->field_id }}"><img src="/img/cross.png" width="12"></a></label>
      @if(!empty($row_fields->field_type) && $row_fields->field_type == "1")
        <input type="text" name="{{ strtolower($row_fields->field_name) }}" class="form-control">
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "2")
        <textarea  name="{{ strtolower($row_fields->field_name) }}" rows="4" cols="35"></textarea>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "3")
        <input type="checkbox"  name="{{ strtolower($row_fields->field_name) }}" />
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == 4)
        <select class="form-control"  name="{{ strtolower($row_fields->field_name) }}" >
          @if(!empty($row_fields->select_option) && count($row_fields->select_option) > 0)
            @foreach($row_fields->select_option as $key=>$value)
              <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          @endif
        </select>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "5")   
        <input type="date"  name="{{ strtolower($row_fields->field_name) }}">
      @endif
     
     
      </div>

        <div class="clearfix"></div>
      </div>
    @endif
  @endforeach
@endif
<!-- This portion is for user created field -->


<!-- Sub Section portion is for user created field -->
@if(!empty($subsections) && count($subsections) > 0)
  @foreach($subsections as $row_section)
    <div class="form-group">
      <div class="twobox_2">
      <label for="exampleInputPassword1">{{ ucwords($row_section['title']) }} 
        &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_section" data-step_id="{{ $row_section['step_id'] }}"><img src="/img/cross.png" width="12"></a></label>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="horizontal_line"></div>
    @if(isset($row_section['children']) && count($row_section['children']) >0 )
      @foreach($row_section['children'] as $row_fields)
        <div class="form-group">
          <div class="twobox_2">
          <label for="exampleInputPassword1">{{ ucwords($row_fields['field_name']) }} 
            &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_user_field" data-field_id="{{ $row_fields['field_id'] }}"><img src="/img/cross.png" width="12"></a></label>
          @if(!empty($row_fields['field_type']) && $row_fields['field_type'] == "1")
            <input type="text" name="{{ strtolower($row_fields['field_name']) }}" class="form-control">
          @elseif(!empty($row_fields['field_type']) && $row_fields['field_type'] == "2")
            <textarea  name="{{ strtolower($row_fields['field_name']) }}" rows="4" cols="35"></textarea>
          @elseif(!empty($row_fields['field_type']) && $row_fields['field_type'] == "3")
            <input type="checkbox"  name="{{ strtolower($row_fields['field_name']) }}" />
          @elseif(!empty($row_fields['field_type']) && $row_fields['field_type'] == 4)
            <select class="form-control"  name="{{ strtolower($row_fields['field_name']) }}" >
              @if(!empty($row_fields['select_option']) && count($row_fields['select_option']) > 0)
                @foreach($row_fields['select_option'] as $key=>$value)
                  <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
              @endif
            </select>
          @elseif(!empty($row_fields['field_type']) && $row_fields['field_type'] == "5")   
            <input type="date"  name="{{ strtolower($row_fields['field_name']) }}">
          @endif
         
         
          </div>

          <div class="clearfix"></div>
        </div>
      @endforeach
    @endif
  @endforeach
@endif
<!-- Sub Section portion is for user created field -->



                <div class="add_client_btn">
                    <button class="btn btn-info open" data-id="2" type="button">Next</button>
                    <!-- <button class="btn btn-success" type="button">Save</button> -->
                    <button class="btn btn-danger back" data-id="1" type="button">Cancel</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
                
                  
                </div>
            </div>
                  
                  <!--end table-->
        </div>
    </div>
         
        <div id="step2" class="tab-pane" style="display:none;">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      
                      <div class="row">  
                    
                    <div class="col-xs-12 col-xs-6">
                    
                    


<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">NI Number</label>
<input type="text" id="ni_number" name="ni_number" class="form-control">

</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="tax_reference" name="tax_reference" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>


<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Tax Office</label>
<select class="form-control" id="tax_office_id" name="tax_office_id">
  @if(!empty($tax_office))
    @foreach($tax_office as $key=>$office_row)
      @if($office_row->parent_id == 0)
        <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
      @endif
    @endforeach
  @endif
    
</select>

</div>
</div>
<div class="clearfix"></div>
</div>



<div id="show_other_office" style="display:none;">
  <div class="form-group">
    <label for="exampleInputPassword1">Other Address</label>
    <select class="form-control" id="other_office_id" name="other_office_id">
      <option value="">-- Select Address --</option>
      @if(!empty($tax_office))
        @foreach($tax_office as $key=>$office_row)
        @if(!empty($office_row->parent_id) && $office_row->parent_id != 0)
          <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
        @endif
        @endforeach
      @endif
        
    </select>
  </div>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<textarea id="tax_address" name="tax_address" class="form-control" rows="3">{{ $tax_office_by_id->address  or "" }}</textarea>

</div>


<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Postal/Zip Code</label>
<input type="text" id="tax_zipcode" name="tax_zipcode" value="{{ $tax_office_by_id->zipcode  or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Telephone</label>
<input type="text" id="tax_telephone" name="tax_telephone" value="{{ $tax_office_by_id->telephone  or "" }}" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>


<!-- This portion is for user created field -->
@if(!empty($steps_fields_users) && count($steps_fields_users) > 0)
  @foreach($steps_fields_users as $row_fields)
    @if(!empty($row_fields->step_id) && $row_fields->step_id == "2")
      <div class="form-group">
      <div class="twobox_2">
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }} 
        &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_user_field" data-field_id="{{ $row_fields->field_id }}"><img src="/img/cross.png" width="12"></a></label>
      @if(!empty($row_fields->field_type) && $row_fields->field_type == "1")
        <input type="text" name="{{ strtolower($row_fields->field_name) }}" class="form-control">
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "2")
        <textarea  name="{{ strtolower($row_fields->field_name) }}" rows="4" cols="35"></textarea>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "3")
        <input type="checkbox"  name="{{ strtolower($row_fields->field_name) }}" />
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == 4)
        <select class="form-control"  name="{{ strtolower($row_fields->field_name) }}" >
          @if(!empty($row_fields->select_option) && count($row_fields->select_option) > 0)
            @foreach($row_fields->select_option as $key=>$value)
              <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          @endif
        </select>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "5")   
        <input type="date"  name="{{ strtolower($row_fields->field_name) }}">
      @endif
     
     
      </div>

        <div class="clearfix"></div>
      </div>
    @endif
  @endforeach
@endif
<!-- This portion is for user created field -->


<div class="add_client_btn">
<button class="btn btn-info open"data-id="3" type="button">Next</button>
<!-- <button class="btn btn-success" type="button">Save</button> -->
<button class="btn btn-danger back"data-id="1" type="button">Cancel</button>
</div>
<div class="clearfix"></div>
                   </div>                  
                    
                    
                    
                    
                    
 
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
<h3 class="box-title">Residential Address</h3>  

<!-- <div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Select Address</label>
  <select class="form-control office_address" id="res_office_id" name="res_office_id" data-name="res">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
        @if($office_row->parent_id == 0)
          <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
        @endif
      @endforeach
    @endif
      
  </select>
</div>
</div>

<div class="twobox_2" id="show_other_resoffice" style="display:none;">
<div class="form-group">
<label for="exampleInputPassword1">Other Address</label>
  <select class="form-control office_address" id="other_res_office_id" name="other_res_office_id" data-name="res">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
      @if(!empty($office_row->parent_id) && $office_row->parent_id != 0)
        <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
      @endif
      @endforeach
    @endif
      
  </select>
</div>
</div>
<div class="clearfix"></div>
</div> -->

<!-- <div class="form-group">
<label for="exampleInputPassword1">Select Address</label>
  <select class="form-control" id="res_office_id" name="res_office_id">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
        @if($office_row->parent_id == 0)
          <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
        @endif
      @endforeach
    @endif
      
  </select>
</div> -->


<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<textarea id="res_address" name="res_address" class="form-control" rows="3"></textarea>

</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Town/City</label>
<input type="text" id="res_city" name="res_city" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">State/Region</label>
<input type="text" id="res_region" name="res_region" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Postal/Zip Code</label>
<input type="text" id="res_zipcode" name="res_zipcode" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Country</label>
  <select class="form-control" name="res_country" id="res_country">
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
        <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
        <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>

<!-- <div>
<h3 class="box-title">Service Address</h3> <p>Copy Residential address <input type="checkbox" name="res_service_same" id="res_service_same"> </p>
</div> -->

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<h3 class="box-title">Service Address</h3>
</div>
</div>

<div class="twobox_2" style="margin-top: 25px;">
<div class="form-group">
<label for="exampleInputPassword1"></label>
  Copy Residential address <input type="checkbox" name="res_service_same" id="res_service_same">
</div>
</div>
<div class="clearfix"></div>
</div>


<!-- <div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Select Address</label>
  <select class="form-control office_address" id="serv_office_id" name="serv_office_id" data-name="serv">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
        @if($office_row->parent_id == 0)
          <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
        @endif
      @endforeach
    @endif
      
  </select>
</div>
</div>

<div class="twobox_2" id="show_other_servoffice" style="display:none;">
<div class="form-group">
<label for="exampleInputPassword1">Other Address</label>
  <select class="form-control office_address" id="other_serv_office_id" name="other_serv_office_id" data-name="serv">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
      @if(!empty($office_row->parent_id) && $office_row->parent_id != 0)
        <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
      @endif
      @endforeach
    @endif
      
  </select>
</div>
</div>
<div class="clearfix"></div>
</div> -->


<!-- <div class="form-group">
<label for="exampleInputPassword1">Select Address</label>
  <select class="form-control" id="service_office_id" name="service_office_id">
    <option value="">-- Select Address --</option>
    @if(!empty($tax_office))
      @foreach($tax_office as $key=>$office_row)
        @if($office_row->parent_id == 0)
          <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
        @endif
      @endforeach
    @endif
      
  </select>
</div> -->

<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<textarea id="serv_address" name="serv_address" class="form-control" rows="3"></textarea>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Town/City</label>
<input type="text" id="serv_city" name="serv_city" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">State/Region</label>
<input type="text" id="serv_region" name="serv_region" class="form-control">
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Postal/Zip Code</label>
<input type="text" id="serv_zipcode" name="serv_zipcode" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Country</label>
  <select class="form-control service_country" name="serv_country" id="serv_country">
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
        <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
      @endif
      @endforeach
    @endif
    @if(!empty($countries))
      @foreach($countries as $key=>$country_row)
      @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
        <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
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
  <!-- <select class="form-control" id="serv_tele_code" name="serv_tele_code">
  <option value="44">44</option>
  </select> -->
  <input type="text" id="serv_tele_code" value="44" name="serv_tele_code" class="form-control" readonly />
</div>

<div class="telbox">
<label for="exampleInputPassword1">Telephone</label>
    <input type="text" id="serv_telephone" name="serv_telephone" class="form-control"></div>
<div class="clearfix"></div>
</div>

<div class="form-group">

<div class="n_box01">
  <label for="exampleInputPassword1">Country Code</label>
  <input type="text" id="serv_mobile_code" value="44" name="serv_mobile_code" class="form-control" readonly />
<!-- <select class="form-control" id="serv_mobile_code" name="serv_mobile_code">
<option value="44">44</option>
</select> -->
</div>
<div class="telbox">
<label for="exampleInputPassword1">Mobile</label>
    <input type="text" id="serv_mobile" name="serv_mobile" class="form-control"></div>
<div class="clearfix"></div>
</div>


<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input type="text" id="serv_email" name="serv_email" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Website</label>
<input type="text" id="serv_website" name="serv_website" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Skype</label>
<input type="text" id="serv_skype" name="serv_skype" class="form-control">
</div>


<!-- This portion is for user created field -->
@if(!empty($steps_fields_users) && count($steps_fields_users) > 0)
  @foreach($steps_fields_users as $row_fields)
    @if(!empty($row_fields->step_id) && $row_fields->step_id == "3")
      <div class="form-group">
      <div class="twobox_2">
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }} 
        &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_user_field" data-field_id="{{ $row_fields->field_id }}"><img src="/img/cross.png" width="12"></a></label>
      @if(!empty($row_fields->field_type) && $row_fields->field_type == "1")
        <input type="text" name="{{ strtolower($row_fields->field_name) }}" class="form-control">
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "2")
        <textarea  name="{{ strtolower($row_fields->field_name) }}" rows="4" cols="35"></textarea>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "3")
        <input type="checkbox"  name="{{ strtolower($row_fields->field_name) }}" />
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == 4)
        <select class="form-control"  name="{{ strtolower($row_fields->field_name) }}" >
          @if(!empty($row_fields->select_option) && count($row_fields->select_option) > 0)
            @foreach($row_fields->select_option as $key=>$value)
              <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          @endif
        </select>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "5")   
        <input type="date"  name="{{ strtolower($row_fields->field_name) }}">
      @endif
     
     
      </div>

        <div class="clearfix"></div>
      </div>
    @endif
  @endforeach
@endif
<!-- This portion is for user created field -->



<div class="add_client_btn">
<button class="btn btn-info open" data-id="4" type="button">Next</button>
<!-- <button class="btn btn-success" type="button">Save</button> -->
<button class="btn btn-danger back" data-id="2" type="button">Cancel</button>
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
                    
                   <div class="col-xs-12">
 <div class="col_m2"> 
 <div class="director_table"> 
<h3 class="box-title">RELATIONSHIP</h3>      
<div class="form-group">
  <a href="javascript:void(0)" class="btn btn-info" onClick="show_div()"><i class="fa fa-plus"></i> New Relationship</a> &nbsp <a href="/organisation/add-client" class="btn btn-info" target="_blank"><i class="fa fa-plus"></i> New Client - Organ</a>
</div>

<div class="box-body table-responsive">
<div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
<input type="hidden" id="app_hidd_array" name="app_hidd_array" value="">
<input type="hidden" id="search_client_type" name="search_client_type" value="org">
<input type="hidden" id="rel_client_id" name="rel_client_id" value="">
<table width="100%" class="table table-bordered table-hover dataTable" id="myRelTable">
  <tr>
    <td width="25%"><strong>Business Name</strong></td>
    <td width="30%" align="center"><strong>Appointment Date</strong></td>
    <td width="30%" align="center"><strong>Relationship Type</strong></td>
    <td width="15%" align="center"><strong>Action</strong></td>
    
  </tr>

  </table>

  <div class="contain_tab4" id="new_relationship" style="display:none;">
    <div class="contain_search">
      <input type="text" placeholder="Search..." class="form-control org_relclient_search" id="relname" name="relname">
      <div class="search_value" id="show_search_client"></div>
    </div>

    <div class="contain_date"><input type="text" id="app_date" name="app_date" class="form-control"></div>

    <div class="contain_type">
      <select class="form-control" name="rel_type_id" id="rel_type_id">
          @if(!empty($rel_types))
            @foreach($rel_types as $key=>$rel_row)
            <option value="{{ $rel_row->relation_type_id }}">{{ $rel_row->relation_type }}</option>
            @endforeach
          @endif
        </select>
    </div>
    
    <div class="contain_action"><button class="btn btn-success" onClick="saveRelationship()" type="button">Add</button></div>
  </div>
    


</div>
</div>

<div class="add_client_btn">
<button class="btn btn-info open" data-id="5" type="button">Next</button>
<!-- <button class="btn btn-success" type="button">Save</button> -->
<button class="btn btn-danger back" data-id="3" type="button">Cancel</button>
</div>
<div class="clearfix"></div>
</div>
</div>
                   
                   
                   </div>
                   

                  
                    </div>
                      
                    </div>
                  </div>
                </div>

        <div id="step5" class="tab-pane" style="display:none;">
                  <div class="box-body table-responsive">
                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
                      <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                      </div>
                      
                      <div class="row">  
                    
                   <div class="col-xs-12 col-xs-6">
 <div class="col_m2"> 
 <div class="director_table"> 
<h3 class="box-title">OTHERS</h3> 


<div class="twobox">
<div class="twobox_01">
<div class="form-group">
<label for="exampleInputPassword1">AML Checks Done</label>
<input type="checkbox" name="aml_checks" value="1" />
</div>
</div>

<div class="twobox_02">
<div class="form-group">
<label for="exampleInputPassword1">Acting?</label>
<input type="checkbox" name="acting" value="1" />
</div>
</div>

<div class="twobox_03">
<div class="form-group">
<label for="exampleInputPassword1">Tax Return Required</label>
<input type="checkbox" name="tax_ret_req" value="1" />
</div>
</div>

<div class="clearfix"></div>
</div>


<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Responsible Staff</label>
<select class="form-control" name="resp_staff" id="resp_staff">
  <option value="">None</option>
  @if(!empty($responsible_staff))
    @foreach($responsible_staff as $key=>$staff_row)
      <option value="{{ $staff_row->user_id }}">{{ $staff_row->fname or "" }} {{ $staff_row->lname or "" }}</option>
    @endforeach
  @endif

</select>
</div>
</div>
<div class="clearfix"></div>

</div>


<!-- This portion is for user created field -->
@if(!empty($steps_fields_users) && count($steps_fields_users) > 0)
  @foreach($steps_fields_users as $row_fields)
    @if(!empty($row_fields->step_id) && $row_fields->step_id == "5")
      <div class="form-group">
      <div class="twobox_2">
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }} 
        &nbsp;<a href="javascript:void(0)" title="Delete Field ?" class="delete_user_field" data-field_id="{{ $row_fields->field_id }}"><img src="/img/cross.png" width="12"></a></label>
      @if(!empty($row_fields->field_type) && $row_fields->field_type == "1")
        <input type="text" name="{{ strtolower($row_fields->field_name) }}" class="form-control">
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "2")
        <textarea  name="{{ strtolower($row_fields->field_name) }}" rows="4" cols="35"></textarea>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "3")
        <input type="checkbox"  name="{{ strtolower($row_fields->field_name) }}" />
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == 4)
        <select class="form-control"  name="{{ strtolower($row_fields->field_name) }}" >
          @if(!empty($row_fields->select_option) && count($row_fields->select_option) > 0)
            @foreach($row_fields->select_option as $key=>$value)
              <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          @endif
        </select>
      @elseif(!empty($row_fields->field_type) && $row_fields->field_type == "5")   
        <input type="date"  name="{{ strtolower($row_fields->field_name) }}">
      @endif
     
     
      </div>

        <div class="clearfix"></div>
      </div>
    @endif
  @endforeach
@endif
<!-- This portion is for user created field -->



<div class="add_client_btn">
<!-- <button class="btn btn-info">Next</button> -->
<button class="btn btn-success save" type="submit">Save</button>
<button class="btn btn-danger back" data-id="4" type="button">Cancel</button>
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



<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FIELD</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/individual/save-userdefined-field', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="ind" />
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputPassword1">Select Section</label>
          <select class="form-control" name="step_id" id="step_id">
            @if(!empty($steps))
              @foreach($steps as $key=>$step_row)
                @if(!empty($step_row->step_id) && $step_row->step_id != '4')
                  <option value="{{ $step_row->step_id }}">{{ $step_row->title }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Subsection Name</label>
          <input type="text" placeholder="Search or Add" id="subsec_name" name="subsec_name" class="form-control">
          <div class="search_value" id="show_addnew_section" style="width:86.5%;">
            <ul>
              <li class='putClientName'><a href="javascript:void(0)" class="add_subsec_name">Add new ...</a></li>
            </ul>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Name</label>
          <input type="text" id="field_name" name="field_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Type</label>
          <select class="form-control user_field_type" name="field_type" id="field_type">
            @if(!empty($field_types))
              @foreach($field_types as $key=>$field_row)
                <option value="{{ $field_row->field_type_id }}">{{ $field_row->field_type_name }}</option>
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group" style="display:none;" id="show_select_option">
          <label for="exampleInputPassword1">Options</label>
          <textarea name="select_option" cols="40" rows="3"></textarea>
          Give options width ',' separator
        </div>
        
        <div class="modal-footer1 clearfix">
          <div class="email_btns1">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary pull-left save_text" name="save">Save</button>
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
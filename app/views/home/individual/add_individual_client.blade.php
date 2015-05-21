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
    $("#dob").datepicker({minDate: new Date(1900, 12-1, 25), maxDate:0});
    $("#app_date").datepicker({ minDate: new Date(1900, 12-1, 25) });
    $("#spouse_dob").datepicker({ minDate: new Date(1900, 12-1, 25), maxDate:0 });
})
</script>

    
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
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
                            <a href="/">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADD CLIENT
                        <!-- <small>CLIENT NAME  Limited</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <!-- <li class="active">Add Clients</li> -->
                    </ol>
                </section>

    <!-- Main content -->
    {{ Form::open(array('url' => '/individual/insert-client-details', 'files' => true, 'id'=>'basicform')) }}
    <section class="content">

      <div class="row">
        <div class="top_bts">
          <ul>
            <li>
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
<option value="1">United Kingdom</option>
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
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }}</label>
        @if(!empty($row_fields->field_type) && $row_fields->field_type == "text")
          <input type="text" id="" class="form-control">
        @else
          <textarea name="" id="" rows="4" cols="40"></textarea>
        @endif
      </div>

        <div class="clearfix"></div>
      </div>
    @endif
  @endforeach
@endif
<!-- This portion is for user created field -->



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
                    
                    
  <div class="col_m2">  
<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">NI Number</label>
<input type="text" id="ni_number" name="ni_number" class="form-control">
</div>
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Tax Reference</label>
<input type="text" id="tax_reference" name="tax_reference" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">Tax Office</label>
<select class="form-control" id="tax_office_id" name="tax_office_id">
  @if(!empty($tax_office))
    @foreach($tax_office as $key=>$office_row)
    <option value="{{ $office_row->office_id }}">{{ $office_row->office_name }}</option>
    @endforeach
  @endif
    <option value="other">Other</option>
</select>
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Address</label>
<input type="text" id="tax_address" name="tax_address" value="{{ $tax_office_by_id->address  or "" }}" class="form-control">
</div>

<div class="twobox">
<div class="twobox_1">
<div class="form-group">
<label for="exampleInputPassword1">Town/City</label>
<input type="text" id="tax_city" name="tax_city" value="{{ $tax_office_by_id->city  or "" }}" class="form-control">
</div>
</div>

<div class="twobox_2">
<div class="form-group">
<label for="exampleInputPassword1">State Region</label>
<input type="text" id="tax_region" name="tax_region" value="{{ $tax_office_by_id->region  or "" }}" class="form-control">
</div>
</div>
<div class="clearfix"></div>
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
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }}</label>
        @if(!empty($row_fields->field_type) && $row_fields->field_type == "text")
          <input type="text" id="" class="form-control">
        @else
          <textarea name="" id="" rows="4" cols="40"></textarea>
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
<div class="form-group">
<label for="exampleInputPassword1">Residential Address</label>
<input type="text" id="res_address" name="res_address" class="form-control">
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
<label for="exampleInputPassword1">State Region</label>
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
    <option value="1">United Kingdom</option>
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>


<h3 class="box-title">Service Address</h3>                 
<div class="form-group">
<label for="exampleInputPassword1">Service Address</label>
<input type="text" id="serv_address" name="serv_address" class="form-control">
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
  <select class="form-control" name="serv_country" id="serv_country">
    <option value="1">United Kingdom</option>
  </select>
</div>
</div>
<div class="clearfix"></div>
</div>

<div class="form-group">

<div class="n_box01">
    <label for="exampleInputPassword1">Country Code</label>
<select class="form-control" id="serv_tele_code" name="serv_tele_code">
<option value="+91">+91</option>
<option value="+95">+95</option>
</select></div>
<div class="telbox">
<label for="exampleInputPassword1">Telephone</label>
    <input type="text" id="serv_telephone" name="serv_telephone" class="form-control"></div>
<div class="clearfix"></div>
</div>

<div class="form-group">

<div class="n_box01">
    <label for="exampleInputPassword1">Country Code</label>
<select class="form-control" id="serv_mobile_code" name="serv_mobile_code">
<option value="+91">+91</option>
<option value="+95">+95</option>
</select></div>
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
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }}</label>
        @if(!empty($row_fields->field_type) && $row_fields->field_type == "text")
          <input type="text" id="" class="form-control">
        @else
          <textarea name="" id="" rows="4" cols="40"></textarea>
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
  <a href="javascript:void(0)" class="btn btn-info" onClick="show_div()"><i class="fa fa-plus"></i> New</a>
</div>

<div class="box-body table-responsive">
<div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
<input type="hidden" id="app_hidd_array" name="app_hidd_array" value="">
<input type="hidden" id="search_client_type" name="search_client_type" value="org">
<input type="hidden" id="rel_client_id" name="rel_client_id" value="">
<table width="100%" class="table table-bordered table-hover dataTable" id="myRelTable">
  <tr>
    <td width="25%"><strong>Name</strong></td>
    <td width="30%" align="center"><strong>Appointment Date</strong></td>
    <td width="30%" align="center"><strong>Relationship Type</strong></td>
    <td width="15%" align="center"><strong>Action</strong></td>
    
  </tr>

  </table>

  <div class="contain_tab4" id="new_relationship" style="display:none;">
    <div class="contain_search">
      <input type="text" placeholder="Search..." class="form-control" id="relname" name="relname">
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
    
    <div class="contain_action"><button class="btn btn-success" onClick="saveRelationship()" type="button">Save</button></div>
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
      <label for="exampleInputPassword1">{{ ucwords($row_fields->field_name) }}</label>
        @if(!empty($row_fields->field_type) && $row_fields->field_type == "text")
          <input type="text" id="" class="form-control">
        @else
          <textarea name="" id="" rows="4" cols="40"></textarea>
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
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1"><a href="javascript:void(0)">Add new ...</a></label>
          <!-- <input type="text" id="field_name" name="field_name" class="form-control"> -->
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Name</label>
          <input type="text" id="field_name" name="field_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Field Type</label>
          <select class="form-control" name="field_type" id="field_type">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="checkbox">Checkbox</option>
            <option value="date">Date</option>
            <option value="dropdown">Dropdown</option>
          </select>
        </div>
        
        <div class="modal-footer clearfix">
          <div class="email_btns">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary pull-left save_t" name="save">Save</button>
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
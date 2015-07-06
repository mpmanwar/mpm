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
    <input type="hidden" name="client_type" value="org" />
    <input type="hidden" name="back_url" value="add_org" />
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputPassword1">Select Section</label>
          <select class="form-control show_subsec" name="step_id" id="step_id" data-client_type="org">
            @if( isset($steps) && count($steps) >0 )
              @foreach($steps as $key=>$step_row)
                @if($step_row->step_id != '4' && $step_row->status == "old")
                  <option value="{{ $step_row->step_id }}">{{ ($step_row->step_id == 1)?"BUSINESS INFORMATION":$step_row->title }}</option>
                @endif
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Subsection Name</label>
          <select class="form-control subsec_change" name="substep_id" id="substep_id">
            <option value="">-- Select sub section --</option>
            @if( isset($substep) && count($substep) >0 )
              @foreach($substep as $key=>$step_row)
                <option value="{{ $step_row->step_id }}">{{ $step_row->title }}</option>
              @endforeach
            @endif
            <option value="new">Add new ...</option>
          </select>
        </div>
        <div class="input-group show_new_div" style="display:none;">
            <input type="text" class="form-control" name="subsec_name" id="subsec_name">
           <span class="input-group-addon"> <a href="javascript:void(0)" class="add_subsec_name" data-client_type="org">Save<!-- <i class="fa fa-plus"></i> --></a></span>
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


<!-- add/edit list -->
<div class="modal fade" id="addcompose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/client/add-business-type', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" id="client_type" value="org">
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="org_name" name="org_name" placeholder="Business Type" class="form-control">
      </div>
      
      <div id="append_bussiness_type">
      @if( isset($old_org_types) && count($old_org_types) >0 )
        @foreach($old_org_types as $key=>$old_org_row)
        <div class="form-group">
          <label for="{{ $old_org_row->name }}">{{ $old_org_row->name }}</label>
        </div>
        @endforeach
      @endif

      @if( isset($new_org_types) && count($new_org_types) >0 )
        @foreach($new_org_types as $key=>$new_org_row)
        <div class="form-group" id="hide_div_{{ $new_org_row->organisation_id }}">
          <a href="javascript:void(0)" title="Delete Field ?" class="delete_org_name" data-field_id="{{ $new_org_row->organisation_id }}"><img src="/img/cross.png" width="12"></a>
          <label for="{{ $new_org_row->name }}">{{ $new_org_row->name }}</label>
        </div>
        @endforeach
      @endif
      </div>
      
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" data-client_type="org" id="add_business_type" name="save">Save</button>
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


<!-- Vat Scheme Modal -->
<div class="modal fade" id="vatScheme-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:430px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD to List</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/client/add-vat-scheme', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="org">
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="vat_scheme_name" id="vat_scheme_name" placeholder="Vat Scheme" class="form-control">
      </div>
      
      <div id="append_vat_scheme">
        @if( isset($old_vat_schemes) && count($old_vat_schemes) )
          @foreach($old_vat_schemes as $key=>$scheme_row)
            <div class="form-group">
              <label for="{{ $scheme_row->vat_scheme_name }}">{{ $scheme_row->vat_scheme_name }}</label>
            </div>
          @endforeach
        @endif

        @if( isset($new_vat_schemes) && count($new_vat_schemes) )
          @foreach($new_vat_schemes as $key=>$scheme_row)
            <div class="form-group" id="hide_vat_div_{{ $scheme_row->vat_scheme_id }}">
              <a href="javascript:void(0)" title="Delete Field ?" class="delete_vat_scheme" data-field_id="{{ $scheme_row->vat_scheme_id }}"><img src="/img/cross.png" width="12"></a>
              <label for="{{ $scheme_row->vat_scheme_name }}">{{ $scheme_row->vat_scheme_name }}</label>
            </div>
          @endforeach
        @endif
      </div>
     
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" id="add_vat_scheme" data-client_type="org" name="save">Save</button>
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


<!-- Services Modal Start-->
<div class="modal fade" id="services-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:430px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD to List</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/client/add-services', 'id'=>'field_form')) }}
    <input type="hidden" name="client_type" value="org">
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="service_name" id="service_name" placeholder="Service Name" class="form-control">
      </div>

      <div id="append_services">
      @if( isset($old_services) && count($old_services)>0 )
        @foreach($old_services as $key=>$service_row)
          <div class="form-group">
            <label for="{{ $service_row->service_id }}">{{ $service_row->service_name }}</label>
          </div>
        @endforeach
      @endif
      @if( isset($new_services) && count($new_services)>0 )
        @foreach($new_services as $key=>$service_row)
          <div class="form-group" id="hide_service_div_{{ $service_row->service_id }}">
            <a href="javascript:void(0)" title="Delete Field ?" class="delete_services" data-field_id="{{ $service_row->service_id }}"><img src="/img/cross.png" width="12"></a>
            <label for="{{ $service_row->service_id }}">{{ $service_row->service_name }}</label>
          </div>
        @endforeach
      @endif
      </div>
     
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="button" class="btn btn-primary pull-left save_t" id="save_services" name="save">Save</button>
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
<!-- Services Modal End-->


<!-- Add Subsec Modal Start-->
<div class="modal fade" id="addsubsec-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:430px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
    {{ Form::open(array('url' => '/client/add-services', 'id'=>'field_form')) }}
    <div class="modal-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="service_name" placeholder="Service Name" class="form-control">
      </div>

      @if(!empty($services))
        @foreach($services as $key=>$service_row)
          <div class="form-group">
            <a href="javascript:void(0)" title="Delete Field ?" class="delete_services" data-field_id="{{ $service_row->service_id }}"><img src="/img/cross.png" width="12"></a>
            <label for="{{ $service_row->service_id }}">{{ $service_row->service_name }}</label>
          </div>
        @endforeach
      @endif
     
      <div class="modal-footer1 clearfix">
        <div class="email_btns">
          <button type="submit" class="btn btn-primary pull-left save_t" name="save">Save</button>
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
<!-- Add Subsec Modal End-->


<!-- Relationship Add To List Modal Start-->
<div class="modal fade" id="add_to_list-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:404px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        <div id="add_to_msg_div" style="text-align: center; color: #00acd6"></div>
        <div class="form-group" style="width:70%">
          <label for="name">Type</label>
          <select class="form-control" name="add_to_type" id="add_to_type">
            <option value="ind">Individual</option>
            <option value="org">Organisation</option>
          </select>
        </div>

        <div class="form-group" id="add_to_client_text">

<div class="clearfix"></div>
<div class="n_box18_18">
<label for="exampleInputPassword1">Title</label>
<select class="form-control select_title" id="add_to_title" name="add_to_title">
          <option value="Mr" selected="">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
        <option value="Dr">Dr</option>
        <option value="Professor">Professor</option>
        <option value="Rev">Rev</option>
        <option value="Sir">Sir</option>
        <option value="Dame">Dame</option>
        <option value="Lord">Lord</option>
        <option value="Lady">Lady</option>
        <option value="Captain">Captain</option>
        <option value="The Hon">The Hon</option>
        <option value="Other">Other</option>
      </select></div>
<div class="n_box27_27">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" id="add_to_fname" name="add_to_fname" value="" class="form-control toUpperCase"></div>
<div class="n_box22_22">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" id="add_to_mname" name="add_to_mname" value="" class="form-control toUpperCase"></div>
<div class="n_box27_27">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" id="add_to_lname" name="add_to_lname" value="" class="form-control toUpperCase"></div>
<div class="clearfix"></div>
</div>

        <div class="form-group" style="width:70%; display:none;" id="add_to_business">
          <label for="name">Business Name</label>
          <input class="form-control toUpperCase" type="text" name="add_to_name" id="add_to_name">
        </div>
       
        <div class="modal-footer1 clearfix">
          <div class="email_btns">
            <button type="button" class="btn btn-primary pull-left save_t relation_add_client" id="add_to_save" name="save">Save</button>
            <button type="button" class="btn btn-danger pull-left save_t2" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Relationship Add To List Modal End-->

<!-- Officers Details Modal Start-->
<div class="modal fade" id="officers_details-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <!-- <h4 class="modal-title">Add to List</h4>
        <div class="clearfix"></div> -->
      </div>

    <div class="modal-body">
      <table width="100%" border="1" bordercolor="60aad2" class="officer_table">
          <tr class="td_color">
            <td align="center" colspan="3"><span class="table_tead_t">OFFICERS</span></td>
          </tr>
          <tr class="td_color">
            <td align="left" class="sub_header">Name</td>
            <td align="left" class="sub_header">Role</td>
            <td align="center" width="20%" class="sub_header">Add to Relationships</td>
          </tr>

        @if(isset($relationship) && count($relationship) >0 )
            @foreach($relationship as $key=>$relation_row)
              <tr id="database_tr{{ $relation_row['client_relationship_id'] }}">
                <td width="40%">{{ $relation_row['name'] or "" }}</td>
                <td width="40%" align="center">{{ $relation_row['relation_type'] }}</td>
                
                <td width="20%" align="center">
                    <div class="officer_selectbox">
                        <span>+ Add</span>
                        <div class="small_icon" data-id="{{ $relation_row['client_relationship_id'] }}"></div>
                        <div class="clr"></div>
                        <div class="select_toggle" id="status{{ $relation_row['client_relationship_id'] }}">
                          <ul>
                            <li data-value="org"><a href="{{ $relation_row['link'] }}" target="_blank">NEW CLIENT</a></li>
                            <li data-value="non"><a href="javascript:void(0)" data-relation_id="{{ $relation_row['client_relationship_id'] }}" class="officer_addto_relation">NON - CLIENT</a></li>
                          </ul>
                        </div>
                    </div>
                </td>
              </tr>
            @endforeach
        @endif
        </table>
    </div>

  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Officers Details Modal End-->
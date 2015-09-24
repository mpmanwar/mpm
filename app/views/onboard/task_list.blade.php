<tbody>
  <tr>
    <td width="5%" align="left">&nbsp;</td>
    <td width="30%" align="left"><strong>Checklist</strong>
    <!-- <a href="#" class="add_to_list" data-toggle="modal" id="positionopen" data-target="#checklist-modal"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a>
    </td> -->
    <td width="23%" align="left"><strong>Task Owner</strong></td>
    <td width="20%" align="left"><strong>Task Date</strong></td>
    <td width="22%" align="left"><strong>Status</strong></td>
    <!-- <td width="5%" align="left">Delete</td> -->
  </tr>

@if(isset($check_list) && count($check_list) > 0)
  @foreach($check_list as $key=>$check_row)
  <tr id="TemplateRow_{{ $check_row['checklist_id'] }}">
    <td align="left"><p class="custom_chk"><input type="checkbox" data-checklist_id="{{ $check_row['checklist_id'] }}" class="addto_task" name="addto_task[]" id="addto_task{{ $check_row['checklist_id'] }}" value="{{ $check_row['checklist_id'] }}" {{ (isset($check_row['task_details']['check_list']) && $check_row['task_details']['check_list'] == $check_row['checklist_id'])?'checked':'' }}><label for="addto_task{{ $check_row['checklist_id'] }}" style="width: 5px!important; margin: 1px 0 0 1px;">&nbsp;</label></p></td>
    
    <td align="left">{{ $check_row['name'] or "" }}</td>
 
    <td align="left" id="ownerdrop_{{ $check_row['checklist_id'] }}">
      <select class="form-control newdropdown status_dropdown" name="owner[]" id="owner" {{ (isset($check_row['task_details']['check_list']) && $check_row['task_details']['check_list'] == $check_row['checklist_id'])?'':'disabled' }}>
        <option value="">None</option>
        @if(!empty($owner_list))
          @foreach($owner_list as $key=>$staff_row)
          <option value="{{ $staff_row['owner_id'] }}_{{ $staff_row['contact_type'] }}" {{ (isset($check_row['task_details']['task_owner']) && $check_row['task_details']['task_owner'] == $staff_row['owner_id'].'_'.$staff_row['contact_type'])?'selected':'' }}>{{ ucwords($staff_row['name']) }}</option>
          @endforeach
        @endif
      </select>
    </td>
    <td align="left">
      <div style="position: relative;" class="edit_cal">
        <a href=""><span id="frequency">{{ (isset($check_row['task_details']['taskdate']) && $check_row['task_details']['taskdate'] != "")?date('d-m-Y', strtotime($check_row['task_details']['taskdate'])):'' }}</span> </a>
        <span class="glyphicon glyphicon-chevron-down open_adddrop" data-checklist_id="{{ $check_row['checklist_id'] }}" data-cleinttaskdate_id="{{ $check_row['task_details']['cleinttaskdate_id'] }}" data-client_id="{{ $check_row['task_details']['client_id'] or "" }}"></span> 
       <span></span>
        <div class="cont_add_to_date open_dropdown" id="idopen_dropdown_{{ $check_row['checklist_id'] }}" style="display: none;">
          <ul>
            <li>
              <a href="javascript:void(0)" id="addeditshow" class="open_calender_pop" data-cleinttaskdate_id="cleinttaskdate_id">Add/Edit Start Date</a>
            </li>
            <li>
              <a href="javascript:void(0)" id="gocalender" class="" data-client_id="">Add to Calender</a>
            </li>
            <!-- <li>
              <span id="view_calender_" class="addtocalendar atc-style-blue">
                <var class="atc_event">
                  <var class="atc_date_start">ss</var>
                  <var class="atc_date_end">ss</var>
                  <var class="atc_timezone">Europe/London</var>
                  <var class="atc_title"> - </var>
                  <var class="atc_description"> - </var>
                  <var class="atc_location">Office</var>
                  <var class="atc_organizer"></var>
                  <var class="atc_organizer_email"></var>
                </var>
              </span>
             </li> -->
          </ul>
        </div>
      </div>
    </td>

    <td align="left" id="statusdrop_{{ $check_row['checklist_id'] }}">
      <select class="form-control newdropdown status_dropdown" name="status[]" id="status" {{ (isset($check_row['task_details']['check_list']) && $check_row['task_details']['check_list'] == $check_row['checklist_id'])?'':'disabled' }}>
        <option value="N" {{ (isset($check_row['task_details']['status']) && $check_row['task_details']['status'] == 'N')?'selected':'' }}>Not Started</option>
        <option value="D" {{ (isset($check_row['task_details']['status']) && $check_row['task_details']['status'] == 'D')?'selected':'' }}>Done</option>
        <option value="W" {{ (isset($check_row['task_details']['status']) && $check_row['task_details']['status'] == 'W')?'selected':'' }}>WIP</option>
      </select>
    </td>

    <!-- <td align="left">
      <a href="javascript:void(0)" class="DeleteBoxRow" data-checklist_id="{{ $check_row['checklist_id'] }}"><img src="/img/cross.png"></a>
    </td> -->

  </tr>
  @endforeach
  @endif
  </tbody>
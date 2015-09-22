@if(isset($task_details) && count($task_details) > 0)
  @foreach($task_details as $key=>$task_row)
  <tr id="TemplateRow" class="makeCloneClass">
    <td align="center">
      <a href="javascript:void(0)" class="delete_single_task DeleteBoxRow" data-client_id="" data-tab=""><img src="/img/cross.png"></a>
    </td>
    
    <td align="center">
      <select class="form-control newdropdown status_dropdown" name="checklist_type" id="checklist_type">
        @if( isset($old_postion_types) && count($old_postion_types) >0 )
          @foreach($old_postion_types as $key=>$old_org_row)
            <option value="{{ $old_org_row->checklist_id }}" {{ (isset($task_row['check_list']) && $task_row['check_list'] == $old_org_row->checklist_id)?'selected':'' }}>{{ $old_org_row->name }}</option>
            @endforeach
          @endif

        @if( isset($new_postion_types) && count($new_postion_types) >0 )
          @foreach($new_postion_types as $key=>$new_org_row)
            <option value="{{ $new_org_row->checklist_id }}" {{ (isset($task_row['check_list']) && $task_row['check_list'] == $new_org_row->checklist_id)?'selected':'' }}>{{ $new_org_row->name }}</option>
          @endforeach
        @endif
      </select>
    </td>
 
    <td align="center" id="ownerdrop">
      <select class="form-control newdropdown status_dropdown" name="owner" id="owner">
        <option value="">None</option>
        @if(!empty($owner_list))
          @foreach($owner_list as $key=>$staff_row)
          <option value="{{ $staff_row['owner_id'] }}_{{ $staff_row['contact_type'] }}" {{ (isset($task_row['task_owner']) && $task_row['task_owner'] == $staff_row['owner_id'].'_'.$staff_row['contact_type'])?'selected':'' }}>{{ ucwords($staff_row['name']) }}</option>
          @endforeach
        @endif
      </select>
    </td>
    <td align="center" id="">
      <div style="position: relative;" class="edit_cal">
        <a href=""><span id="frequency"></span> </a>
        <span class="glyphicon glyphicon-chevron-down open_adddrop" data-onboarding_id="1"></span> 
       <span>
       
       </span>
        <div class="cont_add_to_date open_dropdown" id="idopen_dropdown_1" style="display: none;">
          <ul>
            <li>
              <a href="javascript:void(0)" id="addeditshow" class="open_calender_pop" data-client_id="">Add/Edit Start Date</a>
            </li>
            <li>
              <a href="javascript:void(0)" id="gocalender" class="" data-client_id="">Add to Calender</a>
            </li>
          </ul>
        </div>
      </div>
    </td>

    <td align="center">
      <select class="form-control newdropdown status_dropdown" name="status" id="status">
        <option value="N" {{ (isset($task_row['status']) && $task_row['status'] == 'N')?'selected':'' }}>Not Started</option>
        <option value="D" {{ (isset($task_row['status']) && $task_row['status'] == 'D')?'selected':'' }}>Done</option>
        <option value="W" {{ (isset($task_row['status']) && $task_row['status'] == 'W')?'selected':'' }}>WIP</option>
      </select>
    </td>

  </tr>
  @endforeach
  @endif
<tr id="TemplateRow" class="makeCloneClass">
    <td align="center">
      <a href="javascript:void(0)" class="delete_single_task DeleteBoxRow" data-client_id="" data-tab=""><img src="/img/cross.png"></a>
    </td>
    
    <td align="center">
      <select class="form-control newdropdown status_dropdown" name="checklist_type[]" id="checklist_type">
        @if( isset($old_postion_types) && count($old_postion_types) >0 )
          @foreach($old_postion_types as $key=>$old_org_row)
            <option value="{{ $old_org_row->checklist_id }}">{{ $old_org_row->name }}</option>
            @endforeach
          @endif

        @if( isset($new_postion_types) && count($new_postion_types) >0 )
          @foreach($new_postion_types as $key=>$new_org_row)
          <option value="{{ $new_org_row->checklist_id }}">{{ $new_org_row->name }}</option>
          
          @endforeach
        @endif
      </select>
    </td>
 
    <td align="center" id="ownerdrop">
      <select class="form-control newdropdown status_dropdown" name="owner[]" id="owner">
        <option value="">None</option>
        @if(!empty($owner_list))
          @foreach($owner_list as $key=>$staff_row)
          <option value="{{ $staff_row['owner_id'] }}_{{ $staff_row['contact_type'] }}">{{ ucwords($staff_row['name']) }}</option>
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
      <select class="form-control newdropdown status_dropdown" name="status[]" id="status">
        <option value="N">Not Started</option>
        <option value="D">Done</option>
        <option value="W">WIP</option>
      </select>
    </td>

  </tr>

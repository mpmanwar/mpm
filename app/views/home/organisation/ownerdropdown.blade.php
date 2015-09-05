 

<select class="form-control newdropdown status_dropdown" name="owner" id="owner">

    			
                	<option value="">None</option>
    					//@if(!empty($data))
                  @foreach($data as $key=>$staff_row)
                  <option value="{{ $staff_row['contact_type'] }}">{{ $staff_row['name'] }}</option>
                  @endforeach
                @endif
                      
                       </select>
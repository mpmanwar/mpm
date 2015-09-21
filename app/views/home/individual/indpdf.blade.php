<div class="col-4">
        <h1 style="color:blue">{{ $title or "" }}</h1>
    </div>

<table border="1" style="width: 100%;margin-bottom: 20px; border-collapse: collapse;">
            <input type="hidden" id="client_type" value="ind">  
            <thead>
              <tr role="row">
                
                <!-- <th>#</th> -->
                <!-- <th>STAFF</th> -->
                <th><span id="dob_text">DOB</span>
                  <span id="dob_select" style="display:none;">
                    <select id="four" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'dob') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th>CLIENT NAME</th>
                <th width="15%"><span id="business_name_text">BUSINESS NAME</span>
                  <span id="business_name_select" style="display:none;">
                    <select id="six" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'business_name') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                
                <th><span id="ni_number_text">NI NUMBER</span>
                  <span id="ni_number_select" style="display:none;">
                    <select id="seven" name="first" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'ni_number') ? 'selected':'' }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="tax_reference_text">TAX REFERENCE</span>
                  <span id="tax_reference_select" style="display:none;">
                    <select id="eight" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'tax_reference') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="acting_text">PTR</span>
                  <span id="acting_select" style="display:none;">
                    <select id="nine" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'acting') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
                <th><span id="res_address_text">RESIDENTIAL ADDRESS</span>
                  <span id="res_address_select" style="display:none;">
                    <select id="ten" style="width:100px;">
                      @if(!empty($client_fields))
                        @foreach($client_fields as $key=>$field_row)
                        <option value="{{ $field_row->field_name }}-{{ $field_row->field_label }}" {{ ($field_row->field_name == 'res_address') ? 'selected':"" }} >{{ $field_row->field_label }}</option>
                        @endforeach
                      @endif
                    </select>
                  </span>
                </th>
              
              </tr>
            </thead>

            <tbody role="alert" aria-live="polite" aria-relevant="all">
              @if(!empty($client_details))
              <?php $i=1; ?>
              @foreach($client_details as $key=>$client_row)
                <tr class="all_check" {{ ($client_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                  
                  <!-- <td align="left">{{ $client_row['staff_name'] or "" }}</td> -->
                  <td align="center">{{ isset($client_row['dob'])?date("d-m-Y", strtotime($client_row['dob'])):"" }}</td>
                  <td align="left"><a href="/client/edit-ind-client/{{ $client_row['client_id'] }}/{{ base64_encode('ind_client') }}">{{ (!empty($client_row['client_name']))? $client_row['client_name']: '' }}</a></td>
                  <td align="left">
                    
                    @if(isset($client_row['relationship']) && count($client_row['relationship']) >0 )
                      <select class="form-control newdropdown">
                      @foreach($client_row['relationship'] as $key=>$relation_row)
                        <option value="{{ $relation_row['client_id'] or "" }}">{{ $relation_row['name'] or "" }}</option>
                      @endforeach
                      </select>
                    @endif
                    
                  </td>
                  <td align="center">{{ (!empty($client_row['ni_number']))? $client_row['ni_number']: '' }}</td>
                  <td align="center">{{ (!empty($client_row['tax_reference']))? $client_row['tax_reference']: '' }}</td>
                  <td align="center">{{ (isset($client_row['other_services']) && in_array(10, unserialize($client_row['other_services'])))?"Yes":"No" }} </td>

                  <td align="left">
                    @if(isset($client_row['address']) && $client_row['address'] != "" )
                    <span title="{{ $client_row['address'] }}">{{ (strlen($client_row['address']) > 45)? substr($client_row['address'], 0, 42)."...": $client_row['address'] }}</span>
                    @endif
                  </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                
              @endif
              
            </tbody>
          </table>
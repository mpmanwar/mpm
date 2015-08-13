
             @if(!empty($limitimesheetstr))
<table class="table table-bordered table-hover dataTable" id="example545" aria-describedby="example2_info">
            
                            <thead>
                              <tr role="row">
                              <!-- <th align="center"><input type="checkbox" id="allCheckSelect"/></th> -->
                                <th align="center"><strong>Date</strong></th>
                                <th align="center"><strong>Staff Name</strong></th>
                                <th><strong>Client Name</strong></th>
                                <th align="left"><strong>Service</strong></th>
                                <th><strong>HRS</strong></th>
                                <th><strong>Notes</strong></th>
                               <!-- <th><strong>Action</strong></th> -->
                              </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
							
							@if(!empty($limitimesheetstr))
								  @foreach($limitimesheetstr as $key=>$staff_row)
								 <tr>
								<!--	<td align="center"><input type="checkbox" /></td> -->
									<td align="center">{{ $staff_row['created_date'] }}</td>
									<td align="center">{{ $staff_row['staff_detail']['fname'] }} {{ $staff_row['staff_detail']['lname'] }}</td>
									<td  align="left">{{ $staff_row['client_detail']['field_value'] }}</td>
									<td align="left">{{ $staff_row['old_vat_scheme']['vat_scheme_name'] }}</td>
									<td align="center">{{ $staff_row['hrs'] }}</td>
									<td align="center">{{ $staff_row['notes'] }}</td>
								<!--	<td align="center"><a href="#" data-toggle="modal" data-template_id="{{ $staff_row['timesheet_id'] }}" onclick="openModal('{{ $staff_row['timesheet_id'] }}')"><img src="/img/edit_icon.png" width="15"></a>
                                    <a href="#" onClick="return lmtdelfun('{{ $staff_row['timesheet_id'] }}')"  ><img src="/img/cross.png" width="15" ></a></td> -->
									</tr>
									@endforeach
								@endif
                                  
                              
                            </tbody>
                          </table>
                          @endif
                         
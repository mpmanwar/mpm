<div class="box-body table-responsive">
  <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper">
    <div class="row">
      <div class="col-xs-6"></div>
      <div class="col-xs-6"></div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="col_m2">
              <!--sub tab -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-tabsbg">
              <li class="{{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('611') }}/{{ base64_encode($owner_id) }}">OPEN</a></li>
              <li class="{{ ($page_open == 62)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('62') }}/{{ base64_encode($owner_id) }}">CLOSED (WON)</a></li>
              <li class="{{ ($page_open == 63)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('63') }}/{{ base64_encode($owner_id) }}">CLOSED (LOST)</a></li>
              <li class="{{ ($page_open == 64)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('64') }}/{{ base64_encode($owner_id) }}">COLD</a></li>
              <li><a href="/crm/report" target="_blank">REPORTS</a></li>
              <!-- <li class="{{ ($page_open == 65)?'active':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('65') }}/{{ base64_encode($owner_id) }}">REPORTS</a></li> -->

            </ul>
          <div class="tab-content">
            <div id="tab_611" class="tab-pane {{ ($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617)?'active':'' }}">
              <div class="tab_topcon">
                <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <li>
                            <div class="import_fromch_main" style="width:182px;">
                              <div class="import_fromch">
                                <a href="javascript:void(0)" class="import_fromch_link">+ NEW OPPORTUNITY</a>
                                <a href="javascript:void(0)" class="i_selectbox" id="select_icon"><img src="/img/arrow_icon.png"></a>
                                <div class="clearfix"></div>
                              </div>
                              <div class="crm_dropdown open_toggle">
                              <ul>
                                <li><a href="javascript:void(0)" data-type="ind" data-leads_id="0" class="open_form-modal">Individual</a></li>
                                <li><a href="javascript:void(0)" data-type="org" data-leads_id="0" class="open_form-modal">Organisation</a></li>
                              </ul>
                            </div>
                          </div>
                          </li>
                          <!-- <li>
                            <a class="btn btn-info" href="/crm/graph-page" target="_blank">GRAPHS</a>
                          </li>
                          <li>
                            <a class="btn btn-info" href="/crm/report" target="_blank">REPORT</a>
                          </li> -->
                        <div class="clearfix"></div>
                        </ul>
                      </div>
                      <!-- <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" id="archive_div"></a>
                          </li>
                          <li>
                            <button type="button" id="archivedButton" class="btn btn-warning">Archive</button>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div> -->
                      <div class="clearfix"></div>
                    </div>

                    <ul class="leads_tab">
                        <li style="width:9%;" class="{{ ($page_open == '611')?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('611') }}/{{ base64_encode($owner_id) }}"><h3 style="background:#0066FF;">All [<span id="task_count_11">{{ $all_count }}</span>]</h3></a>
                          <p>{{ ($all_total != '0.00')?round( ($all_total*100/$all_total), 2 ):'0.00' }}%</p>
                          <p>&#163;{{ $all_total or "0.00" }}</p>
                          <p>&#163;{{ $all_average or "0.00" }}</p>
                          <p>&#163;{{ $all_likely or "0.00" }}</p>
                        </li>

                        @if(isset($leads_tabs) && count($leads_tabs) >0)
                          <?php 
                            $i = 2;
                            $total    = 0;
                            $average  = 0;
                            $likely   = 0;
                          ?>
                          @foreach($leads_tabs as $key=>$tab_row)
                            @if($tab_row['status'] == 'S' && $tab_row['is_show'] == 'O')
                            <li class="{{ ($page_open == '61'.$i)?'active_leads':'' }}"><a href="{{ $goto_url }}/{{ base64_encode('61'.$i) }}/{{ base64_encode($owner_id) }}"><h3 style="background:#{{ $tab_row['color_code'] or "" }};"><span id="step_field_{{ $tab_row['tab_id'] or "" }}">{{ $tab_row['tab_name'] or "" }}</span> [<span id="task_count_1.$i">{{ $tab_row['count'] or "0" }}</span>]</h3></a>
                            <p>{{ (isset($tab_row['table_value']['total']) && $all_total != '0.00')?round(str_replace(',','',$tab_row['table_value']['total'])*100/str_replace(',','',$all_total), 2):'0.00' }}%</p>
                            <p>&#163;{{ $tab_row['table_value']['total'] or "0.00" }}</p>
                            <p>&#163;{{ $tab_row['table_value']['average'] or "0.00" }}</p>
                            <p>&#163;{{ $tab_row['table_value']['likely'] or "0.00" }}</p>
                            </li>
                            @endif
                          <?php $i++;?>
                          @endforeach
                        @endif

                        <li style="width:7%;"><h3 style="background:#FF3399;">METRIC</h3>
                          <p style="border-right: 0px"><strong>Percentages</strong></p>
                          <p style="border-right: 0px"><strong>Total</strong></p>
                          <p style="border-right: 0px"><strong>Average</strong></p>
                          <p style="border-right: 0px"><strong>Likely</strong></p>
                        </li>

                        <div class="clearfix"></div>
                    </ul>
                    
                  <div class="tab-content">

                  <div id="tab_611" class="tab-pane top_margin {{ ($page_open == '611')?'active':'' }}">
                    <table class="table table-bordered table-hover dataTable crm" id="example611" aria-describedby="example611_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Stage <a href="javascript:void(0)" class="lead_status-modal" style="float:right;" data-is_show="O"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && ($leads_row['lead_status'] != 8 && $leads_row['lead_status'] != 9 && $leads_row['lead_status'] != 10))
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <input type="hidden" name="close_date_{{ $leads_row['leads_id'] }}" id="close_date_{{ $leads_row['leads_id'] }}" value="{{ $leads_row['close_date'] }}">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      @if(isset($tab_row['is_show']) && $tab_row['is_show'] == 'O')
                                        <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                      @endif
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                    </div>

                    @for($k=2; $k <=7;$k++)                          
                    <div id="tab_61{{$k}}" class="tab-pane top_margin {{ ($page_open == '61'.$k)?'active':'' }}">
                      <table class="table table-bordered table-hover dataTable crm" id="example61{{$k}}" aria-describedby="example61{{$k}}_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="6%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Lead Status <a href="javascript:void(0)" class="lead_status-modal" style="float:right;" data-is_show="O"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="8%">Quoted Value</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == $k)
                            <tr>
                              <td><input type='checkbox' class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px;">
                                  <span>SEND</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      @if(isset($tab_row['is_show']) && $tab_row['is_show'] == 'O')
                                        <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                        @endif
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table> 
                    </div>
                    @endfor  



                  </div>


                  </div>


                <!-- Tab 62 Start-->
                  <div id="tab_62" class="tab-pane top_margin {{ ($page_open == '62')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='8'>{{$won_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='8' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example62" aria-describedby="example62_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Close Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                          <th width="6%">Client Onboarding</th>
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 8)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['close_date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  @if(isset($leads_row['is_onboarding']) && $leads_row['is_onboarding'] != 'N')
                                    <a href="javascript:void(0)" class="send_btn sendto_client_list" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-client_type="{{ $leads_row['client_type'] or "" }}">Start</a>
                                  @else
                                    <a href="javascript:void(0)" class="sent_btn">Started...</a>
                                  @endif
                                @endif
                              </td>
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                    </div>
                  <!-- Tab 62 End-->

                  <!-- Tab 63 Start-->
                  <div id="tab_63" class="tab-pane {{ ($page_open == '63')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='9'>{{$lost_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='9' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example63" aria-describedby="example63_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Close Date</th>
                          <th width="18%">Deal Owner</th>
                          <th width="18%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th width="5%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="8%">Amount</th>
                          <th width="5%">Notes</th>
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 9)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['close_date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- Tab 63 End-->

                  <!-- Tab 64 Start-->
                  <div id="tab_64" class="tab-pane {{ ($page_open == '64')?'active':'' }}">
                    <div class="tab_topcon">
                      <div class="top_bts" style="float:left;">
                        <ul style="padding:0;">
                          <li>
                            <a class="btn btn-danger deleteLeads" href="javascript:void(0)">DELETE</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul>
                      </div>
                      <div class="top_search_con">
                       <div class="top_bts">
                        <!-- <ul style="padding:0;">
                          <li style="margin-top: 8px;">
                            <a href="javascript:void(0)" class="archive_div" data-tab_id='9'>{{$lost_archive}}</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)" data-tab_id='9' class="btn btn-warning archivedButton">Archive</a>
                          </li>
                          <div class="clearfix"></div>
                        </ul> -->
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <table class="table table-bordered table-hover dataTable crm" id="example64" aria-describedby="example64_info">
                      <thead>
                        <tr role="row">
                          <th width="3%"><input type='checkbox' class="CheckallCheckbox"></th>
                          <th width="7%">Date</th>
                          <th width="12%">Deal Owner</th>
                          <th width="12%">Prospect Name</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th width="3%">Age</th>
                          <th width="9%">Quote</th>
                          <th width="6%">Emails <a href="javascript:void(0)" class="" style="float:right;"><img src="/img/question_frame.png"></a></th>
                          <th width="9%">Stage <a href="javascript:void(0)" class="lead_status-modal" style="float:right;" data-is_show="O"><i class="fa fa-cog fa-fw" style="color:#00c0ef"></i></a></th>
                          <th width="7%">Amount</th>
                          <th width="5%">Notes</th>
                          <!-- <th width="6%">Client Onboarding</th> -->
                        </tr>
                      </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @if(isset($leads_details) && count($leads_details) >0)
                          @foreach($leads_details as $key=>$leads_row)
                            @if(isset($leads_row['lead_status']) && $leads_row['lead_status'] == 10)
                            <tr {{ ($leads_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                              <td><input type='checkbox' data-archive="{{ $leads_row['show_archive'] }}" class="ads_Checkbox" name="leads_delete_id[]" value="{{ $leads_row['leads_id'] or "" }}"></td>
                              <td align="left">{{ $leads_row['date'] or "" }}</td>
                              <td align="left">{{ $leads_row['deal_owner'] or "" }}</td>
                              <td align="left">
                                @if(isset($leads_row['client_type']) && $leads_row['client_type'] == "org")
                                  <a href="javascript:void(0)" data-type="org" data-leads_id="{{ $leads_row['leads_id'] }}" class="open_form-modal">{{ $leads_row['prospect_name'] or "" }}</a>
                                @else
                                  <a href="javascript:void(0)" data-type="ind" data-leads_id="{{ $leads_row['leads_id'] or "" }}" class="open_form-modal">{{ $leads_row['prospect_title'] or "" }} {{ $leads_row['prospect_fname'] or "" }} {{ $leads_row['prospect_lname'] or "" }}</a>
                                @endif
                              </td>
                              <td align="left">{{ $leads_row['contact_title'] or "" }} {{ $leads_row['contact_fname'] or "" }} {{ $leads_row['contact_lname'] or "" }}</td>
                              <td align="left">{{ $leads_row['phone'] or "" }}</td>
                              <td align="left">{{ $leads_row['email'] or "" }}</td>
                              <td align="center">{{ $leads_row['deal_age'] or "0" }}</td>
                              <td align="center">
                                <div class="email_client_selectbox" style="height:24px; width:93px!important">
                                  <span>{{ (isset($leads_row['is_invoiced']) && $leads_row['is_invoiced'] == 'Y')?'Invoiced':'SEND' }}</span>
                                  <div class="small_icon" data-id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"></div><div class="clr"></div>
                                  <div class="select_toggle" id="status{{ $leads_row['leads_id'] or "" }}_11" style="display: none;">
                                    <ul>
                                      <li><a href="/quotes" class="send_template-modal">+ New</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">Resend</a></li>
                                      <li><a href="javascript:void(0)" class="send_template-modal">View</a></li>
                                      <li><a href="javascript:void(0)" class="sendto_invoiced" data-tab_id="12" data-leads_id="{{ $leads_row['leads_id'] or "" }}">Generate Invoice</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </td>
                              <td align="center">
                                <a href="javascript:void(0)" class="notes_btn" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11">View</a>
                              </td>
                              <td align="center">
                                <select class="form-control newdropdown status_dropdown" id="11_status_dropdown_{{ $leads_row['leads_id'] or "" }}" data-leads_id="{{ $leads_row['leads_id'] or "" }}">
                                  @if(isset($leads_tabs) && count($leads_tabs) >0)
                                    @foreach($leads_tabs as $key=>$tab_row)
                                      @if(isset($tab_row['is_show']) && $tab_row['is_show'] == 'O')
                                        <option value="{{ $tab_row['tab_id'] or "" }}" {{ (isset($leads_row['lead_status']) && $leads_row['lead_status'] == $tab_row['tab_id'])?'selected':'' }}>{{ $tab_row['tab_name'] or "" }}</option>
                                      @endif
                                    @endforeach
                                  @endif
                                </select>
                              </td>
                              <td align="center">{{ $leads_row['quoted_value'] or "" }}</td>
                              <td>
                                <input type="hidden" id="notes_{{ $leads_row['leads_id'] or "" }}" value="{{ $leads_row['notes'] or "" }}">
                                <a href="javascript:void(0)" class="notes_btn open_notes_popup" data-leads_id="{{ $leads_row['leads_id'] or "" }}" data-tab="11"><span style="{{ (isset($leads_row['notes']) && $leads_row['notes'] != '')?'border-bottom:3px dotted #3a8cc1 !important':''}}">notes</span></a>
                              </td>
                              <!-- <td align="center">
                                @if(isset($leads_row['existing_client']) && $leads_row['existing_client'] != '0')
                                  {{ "N/A" }}
                                @else
                                  <button type="button" class="send_btn send_manage_task" data-client_id="{{ $leads_row['leads_id'] or "" }}" data-field_name="ch_manage_task">START</button>
                                @endif
                              </td> -->
                            </tr>
                            @endif
                          @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- Tab 64 End-->

                  <!-- Tab 65 Start-->
                  <div id="tab_65" class="tab-pane {{ ($page_open == '65')?'active':'' }}">
                    Reports
                  </div>
                  <!-- Tab 64 End-->


                </div>
              </div>
              <!--end sub tab-->
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="col-4">
        <h1 style="color:blue">{{ $title }}</h1>
    </div>

<table border="1" style="width: 100%;margin-bottom: 20px; border-collapse: collapse;">
  
    <thead>
      <tr role="row">
          
          <th>D01</th>
          <th>CRN</th>
          <th>NAME</th>
          <th>YEAR END</th>
          <th>AUTHEN CODE</th>
          <th>LAST RETURN DATE</th>
          <th>NEXT RETURN DATE</th>
          <th>COUNT DOWN</th>
          <th>ADDRESS</th>
      </tr>
      
    </thead>

    <tbody role="alert" aria-live="polite" aria-relevant="all">
      @if(isset($company_details) && count($company_details) >0)
        @foreach($company_details as $key=>$details)
          @if(isset($details['display_in_ch']) && $details['display_in_ch'] == "Y")
            <tr class="{{ (isset($details['deadret_count']) && $details['deadret_count'] < 0 )?'sorting_disabled':"" }}">
                <td align="center">{{ isset($details['incorporation_date'])?date("d-m-Y", strtotime($details['incorporation_date'])):"" }}</td>
                <td align="center">{{ $details['registration_number'] or "" }}</td>
                <td align="left"><a href="/chdata-details/{{ $details['registration_number'] }}">{{ $details['business_name'] or "" }}</a></td>
                <td align="center">{{ $details['acc_ref_day'] or "" }}-{{ $details['ref_month'] or "" }}</td>
                <td align="center">{{ $details['ch_auth_code'] or "" }}</td>
                <td align="center">{{ isset($details['made_up_date'])?date("d-m-Y", strtotime($details['made_up_date'])):"" }}</td>
                <td align="center">{{ isset($details['next_ret_due'])?date("d-m-Y", strtotime($details['next_ret_due'])):"" }}</td>
                <td align="center">
                  @if( isset($details['deadret_count']) && $details['deadret_count'] < 0 )
                    <span style="color:red">{{ $details['deadret_count'] or "" }}</span>
                  @else
                     <p>{{ $details['deadret_count'] or "" }}</p>
                  @endif
                </td>
                <td align="center">{{ (strlen($details['res_address']) > 48)? substr($details['res_address'], 0, 45)."...": $details['res_address'] }}</td>
            </tr>
          @endif 
        @endforeach
      @endif
      
    </tbody>
  </table>
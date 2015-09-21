<table border="1" style="width: 100%;margin-bottom: 20px; border-collapse: collapse;">
      <input type="hidden" id="client_type" value="org"> 
        <thead>
            <tr role="row">
             
                <th>Business Type</th>
                <th>CRN</th>
                <th>Business Name</th>
                <th>Year End</th>
                <th>Accounts</th>
                <th>Annual returns</th>
                <th>Tax reference</th>
                <th>Vat number</th>
                <th>VAT Stagger</th>
                <th>Correspondence Address</th>
            </tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
            @if(!empty($client_details))
                <?php $i=1; ?>
                @foreach($client_details as $key=>$client_row)
                  <tr class="all_check" {{ ($client_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                    
                    <td align="center">{{ isset($client_row['business_type'])?$client_row['business_type']:"" }}</td>
                    <td align="center">{{ $client_row['registration_number'] or "" }}</td>
                    <td align="left"><a href="/client/edit-org-client/{{ $client_row['client_id'] }}/{{ base64_encode('org_client') }}">{{ isset($client_row['business_name'])?$client_row['business_name']:"" }}</a></td>
                    <td align="center">{{ $client_row['acc_ref_day'] or "" }}-{{ $client_row['ref_month'] or "" }}</td>
                    <td align="center">
                      @if( isset($client_row['deadacc_count']) && $client_row['deadacc_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadacc_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadacc_count'] or "" }}
                      @endif
                    </td>
                    <td align="center">
                      @if( isset($client_row['deadret_count']) && $client_row['deadret_count'] == "OVER DUE" )
                        <span style="color:red">{{ $client_row['deadret_count'] or "" }}</span>
                      @else
                         {{ $client_row['deadret_count'] or "" }}
                      @endif
                    </td>
                    <td align="center">{{ isset($client_row['tax_reference'])?$client_row['tax_reference']:"" }}</td>
                    <td align="center">{{ isset($client_row['vat_number'])?$client_row['vat_number']:"" }}</td>
                    <td align="center">{{ $client_row['vat_stagger'] or "" }}</td>
                    <td align="left">{{ (strlen($client_row['corres_address']) > 48)? substr($client_row['corres_address'], 0, 45)."...": $client_row['corres_address'] }}</td>
                  </tr>
                <?php $i++; ?>
              @endforeach
            @endif
          
          
        </tbody>
      </table>
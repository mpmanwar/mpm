<div class="col-4">
        <h1 style="color:blue">{{ $title or "" }}</h1>
    </div>

<table border="1" style="width: 100%;margin-bottom: 20px; border-collapse: collapse;">
           
           
            <thead>
            <tr role="row">
             
                <th>client_code</th>
                <th>client_name</th>
                <th>Date of Birth</th>
                <th>Spouse Date of Birth</th>
                <th>Occupation</th>
                <th>NI Number</th>
                <th>Tax Reference</th>
                <th>Tax Office Address</th>
                <th>Tax Postal/Zip Code</th>
                <th> Tax Telephone</th>
                <th> Service Address Line1</th>
                <th> Service Address Line2</th>
                <th> Service City/Town</th>
                <th> Service County</th>
                <th> Service Postcode</th>
                <th> Residential Address Line1</th>
                <th> Residential Address Line2</th>
                <th> Residential City/Town</th>
                <th> Residential County</th>
                <th> Residential Postcode</th>
                <th> Residential Telephone</th>
               <th> Residential Mobile</th>
                <th> Email</th>
                <th> Website</th>
                <th> Skype</th>
                
                
                
              </tr>
        </thead>
           <tbody role="alert" aria-live="polite" aria-relevant="all">
            @if(!empty($client_details))
                <?php $i=1; ?>
                @foreach($client_details as $key=>$client_row)
                  <tr class="all_check" {{ ($client_row['show_archive'] == "Y")?'style="background:#ccc"':"" }}>
                    
                    <td align="center">{{ isset($client_row['client_code'])?$client_row['client_code']:"" }}</td>
                    <td align="center">{{ $client_row['client_name'] or "" }}</td>
                    <td align="center">{{ $client_row['dob'] or "" }}</td>
                    <td align="center">{{ $client_row['spouse_dob'] or "" }}</td>
                    <td align="center">{{ $client_row['occupation'] or "" }}</td>
                    <td align="center">{{ $client_row['ni_number'] or "" }}</td>
                    <td align="center">{{ $client_row['tax_reference'] or "" }}</td>
                    <td align="center">{{ $client_row['tax_address'] or "" }}</td>
                    <td align="center">{{ $client_row['tax_zipcode'] or "" }}</td>
                    <td align="center">{{ $client_row['tax_telephone'] or "" }}</td>
                    <td align="center">{{ $client_row['serv_addr_line1'] or "" }}</td>
                    <td align="center">{{ $client_row['serv_addr_line2'] or "" }}</td>
                    <td align="center">{{ $client_row['serv_city'] or "" }}</td>
                    <td align="center">{{ $client_row['serv_county'] or "" }}</td>
                    <td align="center">{{ $client_row['serv_postcode'] or "" }}</td>
                    
                    <td align="center">{{ $client_row['res_addr_line1'] or "" }}</td>
                    <td align="center">{{ $client_row['res_addr_line2'] or "" }}</td>
                    <td align="center">{{ $client_row['res_city'] or "" }}</td>
                    <td align="center">{{ $client_row['res_county'] or "" }}</td>
                    <td align="center">{{ $client_row['res_postcode'] or "" }}</td>
                    <td align="center">{{ $client_row['res_telephone'] or "" }}</td>
                    <td align="center">{{ $client_row['res_mobile'] or "" }}</td>
                    <td align="center">{{ $client_row['res_email'] or "" }}</td>
                    <td align="center">{{ $client_row['res_website'] or "" }}</td>
                    <td align="center">{{ $client_row['res_skype'] or "" }}</td>
               
                 
              
                  </tr>
                <?php $i++; ?>
              @endforeach
            @endif
          
          
        </tbody>
           
          </table>
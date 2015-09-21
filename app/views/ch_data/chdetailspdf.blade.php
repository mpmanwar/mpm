 <table width="100%" border="1" bordercolor="60aad2">
          <tr class="td_color">
            <td colspan="2" align="center"><span class="table_tead_t">OVERVIEW</span></td>
          </tr>
          <tr>
            <td width="40%" class="td_color"><strong>Company Name</strong></td>
            <td width="60%">{{ $details->CompanyName or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Registration Number</strong></td>
            <td>{{ $details->CompanyNumber or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Registered in</strong></td>
            <td>{{ $client_data['registered_in'] or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Web Filing Authentication Code</strong></td>
            <td>{{ $client_data['ch_auth_code'] or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Company Category</strong></td>
            <td>{{ $details->CompanyCategory or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Company Status</strong></td>
            <td>{{ $details->CompanyStatus or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Country of Origin</strong></td>
            <td>{{ $details->CountryOfOrigin or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Incorporation Date</strong></td>
            <td>{{ $details->IncorporationDate or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Nature of Business</strong></td>
            <td>{{ $nature_of_business or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Accounting Reference Date</strong></td>
            <td>{{ $details->Accounts->AccountRefDay or "" }}/{{ $details->Accounts->AccountRefMonth or "" }}</td>
          </tr>
          <tr>
            <td class="td_color"><strong>Last Accounts made Up Date</strong></td>
            <td>{{ $details->Accounts->LastMadeUpDate or "" }}</td>
          </tr>
            <tr>
            <td class="td_color"><strong>Next Accounts Due</strong></td>
            <td>{{ $details->Accounts->NextDueDate or "" }}</td>
          </tr>
            <tr>
            <td class="td_color"><strong>Last Return Made Up To</strong></td>
            <td>{{ $details->Returns->LastMadeUpDate or "" }}</td>
          </tr>
            <tr>
            <td class="td_color"><strong>Next Return Due</strong></td>
            <td>{{ $details->Returns->NextDueDate or "" }}</td>
          </tr>
          
        </table>

        <table width="100%" border="1" bordercolor="60aad2" class="register_top">
            <tr class="td_color">
              <td align="center"><span class="table_tead_t">REGISTERED OFFICE</span></td>
            </tr>
            <tr>
              <td>
              {{ $registered_office->address_line_1 or "" }}<br>
              {{ $registered_office->address_line_2 or "" }}<br>
              {{ $registered_office->locality or "" }}<br>
              {{ $registered_office->country or "" }}<br>
              {{ $registered_office->postal_code or "" }}
              </td>
            </tr>
          </table>
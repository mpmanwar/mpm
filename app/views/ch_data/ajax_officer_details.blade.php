<table width="100%" border="1" bordercolor="60aad2">
  <tr class="td_color">
    <td colspan="2"><span class="table_tead_t">PERSONAL DETAILS</span></td>
  </tr>
  <tr>
    <td class="td_color">Name :</td><td>{{ $officers['name'] or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">DOB :</td><td>{{ $officers['date_of_birth'] or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Nationality :</td><td>{{ $officers['nationality'] or "" }}</td>
  </tr>
  <tr>
    <td class="td_color">Occupation :</td><td>{{ $officers['occupation'] or "" }}</td>
  </tr>
    <tr>
        <td class="td_color">Country of residence :</td><td>{{ $officers['country_of_residence'] or "" }}</td>
    </tr>
    <tr>
        <td class="td_color">Officer Role :</td><td>{{ $officers['officer_role'] or "" }}</td>
    </tr>
 
    <tr class="td_color">
        <td colspan="2"><span class="table_tead_t">ADDRESS</span></td>
    </tr>

    <tr>
        <td class="td_color">Address 1 :</td><td>{{ $officers['address']->address_line_1 or "" }}</td>
    </tr>
    <tr>
        <td class="td_color">Premises :</td><td>{{ $officers['address']->premises or "" }}</td>
    </tr>
    <tr>
        <td class="td_color">Town :</td><td>{{ $officers['address']->locality or "" }}</td>
    </tr>
    <tr>
        <td class="td_color">Post Code :</td><td>{{ $officers['address']->postal_code or "" }}</td>
    </tr>
    <tr>
        <td class="td_color">Country :</td><td>{{ $officers['address']->country or "" }}</td>
    </tr>
</table>
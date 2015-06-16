<tr class="td_color">
  <td colspan="3"><span class="sub_header">COMPANY NAME</span></td>
</tr>
@if(isset($company_details) && count($company_details) >0 )
  @foreach($company_details as $key=>$company_row)
    <tr>
      <td align="left" colspan="3"><a href="javascript:void(0)" data-number="{{ $company_row['company_number'] }}" class="link_color get_company_details" style="text-decoration: underline;">{{ $company_row['company_name'] }}</a></td>
    </tr>
  @endforeach
@else
  <tr>
    <td colspan="3" align="left">No result found...</td>
  </tr>
@endif
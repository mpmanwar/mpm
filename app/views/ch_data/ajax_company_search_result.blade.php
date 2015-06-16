<tr class="td_color">
  <td colspan="3"><span class="sub_header">COMPANY NAME</span></td>
</tr>
@if(isset($company_details) && count($company_details) >0 )
  @foreach($company_details as $key=>$company_row)
    <tr>
      <td align="left" colspan="3">
      <span><a href="javascript:void(0)" >{{ $company_row['company_name'] }}</a></span>
       <span class="ch_chkbox"><input type="checkbox" name="company_number[]" value="{{ $company_row['company_number'] }}"></span>
       <div class="clearfix"></div>
      </td>
    </tr>
  @endforeach
@else
  <tr>
    <td colspan="3" align="left">No result found...</td>
  </tr>
@endif
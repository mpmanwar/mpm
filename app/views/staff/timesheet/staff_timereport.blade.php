

@if(!empty($final_array))




             <table class="table table-bordered" style="margin-top:20px;">

<tr>
<td align="center" >
<table class="" width="100%" >
<tr>
<td width="20%" align="center">Client Name</td>
<td width="20%" align="center">Staff Name</td>
<td width="10%" align="center">Date</td>
<td width="40%" align="center">Service</td>
<td width="10%" align="center">HRS</td>
</tr>
</table>
</td>
</tr>
<?php $y=0; ?>
 @if(isset($final_array))
  @foreach($final_array as $key=>$nstaff_row)
<tr>
<td align="center">
<table width="100%" >
<tr>
<td width="20%" align="center">  {{$key}}</td>
<td width="80%" align="center">
<table width="100%" align="center">
<?php $i=0; ?>
@foreach($nstaff_row as $eachRE)
<tr>
<td width="25%" align="center">{{ $eachRE['staff_name'] }}</td>
<td width="15%" align="center"> {{ $eachRE['date'] }}</td>
<td width="45%" align="center">{{ $eachRE['service'] }}</td>
<td width="15%" align="center">{{ $eachRE['hrs'] }}<?php $i=$i+$eachRE['hrs']; ?></td>
</tr>
@endforeach

 <!--   
<tr>
<td align="center">Staff Name</td>
<td align="center">Date</td>
<td align="center">Service</td>
<td align="center">HRS</td>
</tr>
<tr>
<td align="center">Staff Name</td>
<td align="center">Date</td>
<td align="center">Service</td>
<td align="center">HRS</td>
</tr> -->
</table>

</td>
</tr>
</table>
</td>
</tr>





<tr>
<td align="center">
<table width="100%" align="center" >
<tr>
<td width="20%" align="center">&nbsp;</td>
<td width="80%" align="center">
<table width="100%">
<tr>
<td width="25%" align="center">&nbsp;</td>
<td width="15%" align="center">&nbsp;</td>
<td width="40%" align="center">&nbsp;</td>
<td width="20%" align="center"><b>Total&nbsp;&nbsp;&nbsp;<?php echo $i; $y=$y+$i; ?> </b></td>


</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
@endforeach
 @endif
 
 <tr>
<td align="center">
<table width="100%" align="center" >
<tr>
<td width="20%" align="center">&nbsp;</td>
<td width="80%" align="center">
<table width="100%">
<tr>
<td width="25%" align="center">&nbsp;</td>
<td width="15%" align="center">&nbsp;</td>
<td width="30%" align="center">&nbsp;</td>
<td width="30%" align="center"><b>GRAND TOTAL&nbsp;&nbsp;&nbsp;<?php echo $y; ?></b> </td>


</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
 @endif
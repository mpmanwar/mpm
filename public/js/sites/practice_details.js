function copyPostal()
{
  $("#phy_attention").val($("#reg_attention").val());
  $("#phy_street_address").val($("#reg_street_address").val());
  $("#phy_city").val($("#reg_city").val());
  $("#phy_state").val($("#reg_state").val());
  $("#phy_zip").val($("#reg_zip").val());
  $("#phy_country_id").val($("#reg_country_id").val());
  //$("#hid_phy_state_id").val($("#hid_reg_state_id").val());
  //$("#hid_phy_city_id").val($("#hid_reg_city_id").val());
}

function ajaxSearchByCity( value, div_id )
{
	$.ajax({
		type : "POST",
		url : "/ajaxSearchByCity",
		data : {"value" : value, "div_id" : div_id},
		success : function(resp){
			$("#"+div_id+"_div").show();
			$("#"+div_id+"_result").html(resp);
		}
	})
}

function ajaxGetState( city_id, state_id, value, div_id )
{//alert("sss")
	$("#"+div_id).val(value);
	$("#"+div_id+"_result").html("");
	$("#"+div_id+"_div").hide();
	$.ajax({
		type : "POST",
		url : "/ajaxSearchGetState",
		data : {"state_id" : state_id, "div_id" : div_id},
		success : function(resp){
			if(div_id == "reg_city_id"){
				$("#reg_state_id").val(resp);
				$("#hid_reg_state_id").val(state_id);
				$("#hid_reg_city_id").val(city_id);
			}else{
				$("#phy_state_id").val(resp);
				$("#hid_phy_state_id").val(state_id);
				$("#hid_phy_city_id").val(city_id);
			}
				
		}
	})
}

$(document).ready(function(){

	$('#CheckorgCheckbox').on('ifChecked', function(event){
        $(".org_alocation input[class='org_Checkbox']").iCheck('check');
    });

    $('#CheckorgCheckbox').on('ifUnchecked', function(event){
        $(".org_alocation input[class='org_Checkbox']").iCheck('uncheck');
    });

	$('.bulk_allocation').click(function() {
		var val = [];
	    $(".org_Checkbox:checked").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}
	    });
		//org_checkbox
		var ind_service_id = $("#ind_service_id").val();
		if(val.length>0){
			if(ind_service_id == ""){
				alert("Please select Service.");
				return false;
			}else{
				$('#bulk_allocation-modal').modal('show');
			}
		}else{
			alert("Please select atleast one client.");
			return false;
		}
		
		
    
 	});



});
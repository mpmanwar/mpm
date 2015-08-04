$(document).ready(function(){

	$('#CheckorgCheckbox').on('ifChecked', function(event){
        $(".org_alocation input[class='org_Checkbox']").iCheck('check');
    });

    $('#CheckorgCheckbox').on('ifUnchecked', function(event){
        $(".org_alocation input[class='org_Checkbox']").iCheck('uncheck');
    });

    $(".client_allocate").click(function(){
    	var client_type = $(this).data("type");
    	$("#client_type").val(client_type);
    });

	$('.bulk_allocation').click(function() {
		var client_type = $("#client_type").val();
		var val = [];
	    $("."+client_type+"_Checkbox:checked").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}
	    });
		
		var service_id = $("#"+client_type+"_service_id").val();
		if(val.length <=0){
			alert("Please select atleast one client.");
			return false;
		}else if(service_id == ""){
			alert("Please select Service.");
			return false;
		}else{
			$('#bulk_allocation-modal').modal('show');
		}
		
	});

	$(".service_dropdown").change(function(){
		var client_type = $("#client_type").val();
		var service_id = $("#"+client_type+"_service_id").val();
		if(service_id != ""){
			$.ajax({
			    type: "POST",
			    url: '/search-allocation-clients',
			    data: { 'service_id' : service_id, 'client_type' : client_type },
			    success : function(resp){
			    	if(client_type == 'org'){
			    		$("#example1 tbody").html(resp);
			    	}else{
			    		$("#example2 tbody").html(resp);
			    	}
			    	
			    }
			});
		}
	});



});
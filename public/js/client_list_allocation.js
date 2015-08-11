$(document).ready(function(){

	$('.CheckorgCheckbox').on('ifChecked', function(event){
        $(".org_Checkbox").iCheck('check');
    });

    $('.CheckorgCheckbox').on('ifUnchecked', function(event){
        $(".org_Checkbox").iCheck('uncheck');
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
			    		//$("#step1").html(resp);
			    		$("#example1 tbody").html(resp);
			    	}else{
			    		$("#example2 tbody").html(resp);
			    	}
			    	
			    }
			});
		}else{
			$("#example1 tbody").html("");
		}
	});

	/*$('.radio_column').on('ifChecked', function(event){
		var column 		= $(this).val();
		var client_type = $("#client_type").val();
		var val = [];
	    $("."+client_type+"_Checkbox:checked").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}
	    });
		
		
        
    });*/

    $(".save_bulk_allocation").click(function(){
    	var client_type = $("#client_type").val();
    	var column 		= $('input:radio[name=column]:checked').val();
    	var staff_id 	= $('#staff_id').val();
    	var service_id 	= $("#"+client_type+"_service_id").val();
    	//alert(service_id+", "+staff_id+", "+client_type);

    	if(staff_id == ""){
    		alert("Please Select Staff name");
    		return false;
    	}else if(column == "undefined" || column == ""){
    		alert("Please select column");
    		return false;
    	}else{
    		var val = [];
		    $("."+client_type+"_Checkbox:checked").each( function (i) {
				if($(this).is(':checked')){
					val[i] = $(this).val();
				}
		    });
    		$.ajax({
			    type: "POST",
			    url: '/save-bulk-allocation',
			    data: { 'service_id':service_id,'column':column,'client_type':client_type,'staff_id':staff_id,'client_array':val },
			    success : function(resp){
			    	//$("#success_msg").html("Successfully added bulk allocation");
			    	$("."+client_type+"_Checkbox:checked").each( function (i) {
						if($(this).is(':checked')){
							client_id = $(this).val();
							$('#'+client_id+"_"+client_type+'_staff_id'+column).val(staff_id);
						}
				    });
			    	
			    	$('#bulk_allocation-modal').modal('hide');
			    }
			});
    	}

    });

	$("body").on("change", ".save_manual_user", function(){
		var client_type = $("#client_type").val();
    	var column 		= $(this).data("column");
    	var client_id 	= $(this).data("client_id");
    	var staff_id 	= $(this).val();
    	var service_id 	= $("#"+client_type+"_service_id").val();

    	if(service_id == ""){
    		alert("Please Select Service name");
    		return false;
    	}else{
    		$.ajax({
			    type: "POST",
			    url: '/save-manual-staff',
			    data: { 'service_id':service_id,'column':column,'client_type':client_type,'staff_id':staff_id,'client_id':client_id },
			    success : function(resp){
			    	
			    }
			});
    	}
	});


	/* Change services from client start*/
	$('.applicable_Checkbox').on('ifChecked', function(event){
		var client_type = $("#client_type").val();
		var service_id = $("#"+client_type+"_service_id").val();
        var client_id = $(this).val();
        $.ajax({
		    type: "POST",
		    url: '/edit-service-id',
		    data: { 'service_id':service_id,'action_type':'add','client_id':client_id },
		    success : function(resp){
		    	$("#client_"+client_id).find('select').prop('disabled', false);
		    	$("#"+client_type+"_checkbox"+client_id).iCheck('enable');
		    	//$("#client_"+client_id+" input[type=checkbox]").prop('disabled', false);
		    }
		});
    });

    $('.applicable_Checkbox').on('ifUnchecked', function(event){
    	var client_type = $("#client_type").val();
		var service_id = $("#"+client_type+"_service_id").val();
        var client_id = $(this).val();
        $.ajax({
		    type: "POST",
		    url: '/edit-service-id',
		    data: { 'service_id':service_id,'action_type':'delete','client_id':client_id },
		    success : function(resp){
		    	$("#client_"+client_id).find('select').prop('disabled', true);
		    	$("#"+client_type+"_checkbox"+client_id).iCheck('disable');
		    }
		});
    });
    /* Change services from client end*/


});
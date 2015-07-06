$(document).ready(function (e) {

	// Get all the officers in the relationship section start //
	$(".imported_officers").click(function(){
	    
	    $.ajax({
	        type: "POST",
	        url: "/chdata/get-officers-client",
	        dataType: "json",
	        //data: { 'company_number': company_number, 'key' : key },
	        beforeSend: function() {
	            $("#officers_details-modal").modal('show');//return false;
	            //$("#officers_details-modal .modal-body").html('<img src="/img/spinner.gif" />');
	        },
	        success: function (resp) {//console.log(resp['link']);return false;
	            $("#officers_details-modal").modal('show');//return false;
	        }
	        
	    });

	});
	// Get all the officers in the relationship section End //


// ################Officers dropdown toggle in relationship section start ################### //
	$(document).click(function() {
	    $(".select_toggle").hide();
	});
	$(".small_icon").click(function(event) {
		var visable = 0;
		event.stopPropagation();
		var id = $(this).data("id");
		if($(".select_toggle").is(':visible')){
			visable = 1;
		}
		$(".select_toggle").hide();

		if(visable == 1){
			$("#status"+id).hide();
		}else{
			$("#status"+id).show();
		}    
	    
	});
// ################Officers dropdown toggle in relationship section end ################### //



});
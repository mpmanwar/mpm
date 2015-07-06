$(document).ready(function (e) {

	// Get all the officers in the relationship section start //
	$(".imported_officers").click(function(){
	    var client_id = $("#client_id").val();
	    $("#officers_details-modal").modal('show');
	    /*$.ajax({
	        type: "POST",
	        url: "/chdata/get-officers-client",
	        dataType: "json",
	        data: { 'client_id': client_id },
	        beforeSend: function() {
	            $("#officers_details-modal").modal('show');//return false;
	            //$("#officers_details-modal .modal-body").html('<img src="/img/spinner.gif" />');
	        },
	        success: function (resp) {//console.log(resp['link']);return false;
	            
	        }
	        
	    });*/

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


$(".officer_addto_relation").click(function(){
	var relation_id = $(this).data("relation_id");
	$.ajax({
        type: "POST",
        url: "/client/save-officers-into-relation",
        dataType: "json",
        data: { 'relation_id': relation_id },
        
        success: function (resp) {//console.log(resp['name']);return false;
            $('#rel_type_id').val(resp['relationship_type_id']);
    		$('#rel_client_id').val(resp['client_id']);
    		saveRelationship('add_org');
        }
        
    });
});



});
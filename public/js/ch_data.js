$(document).ready(function(){
	
	$(".get_officers").click(function(){
		var number = $(this).data("number");
		var key = $(this).data("key");

        $.ajax({
            type: "POST",
            url: "/officers-details",
            data: { 'number': number, 'key': key },
            success: function (resp) {
            	$("#officer_details_div").html(resp);
                $("#personal_details").modal('show');
                              
            }
        });
    });



});//end of main document ready

function getUserPermissions( value )
{
	alert('value')
	/*if(value == "admin"){
		$("#user_permissions").show();
	}else if(value == "staff"){
		$("#user_permissions").show();
	}else{
		$("#user_permissions").hide();
	}*/
}


$(function(){
	$("body").on("click", ".iradio_minimal", function(){
		console.log("here");
	});
	$(".radio").on("click", function(){
		console.log("hello");
		var type = $(this).find(".handle-change-user").data('type');
		console.log(type);
	});
	$(".radio").click(function(){
		var type = $(this).find(".handle-change-user").data('type');
		console.log(type);
	});

	console.log("hello");
});

$(document).ready(function(){



	/*$(".handle-change-user").on("click", function(){
		console.log("click");
	});*/

});

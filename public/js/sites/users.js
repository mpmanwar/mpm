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
	/*$("body").on("click", ".iradio_minimal", function(){
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
	});*/

	console.log("hello");
});

$(document).ready(function(){

	$('.iradio_minimal').on('ifChecked', function(event){
		$('#user_permissions checkbox').prop('disabled', true);

		var value = $(this).find(".handle-change-user").data('type');
	  	if(value == "admin"){
			$("#user_permissions").show();
		}else if(value == "staff"){
			$("#user_permissions").show();
		}else{
			$("#user_permissions").hide();
		}
	});

	$('#deleteUsers').click(function() {
	  	var val = [];
        $("input[name='user_delete_id[]']").each( function (i) {
			if($(this).is(':checked'))
       			val[i] = $(this).val();

   		});

		//alert(val.length);return false;
		if(val.length>0){
			if(confirm("Do you want to delete?")){
				$.ajax({
				    type: "POST",
				    url: '/delete-users',
				    data: { 'user_delete_id' : val },
				    success : function(resp){
				    	//window.location = 'http://mpm.com/user-list';
				    	window.location = '/user-list';
				    }
				});
			}

 		}else{
 			alert('Please select atleast one user');
 		}
 	});

	
 	$('#allCheckSelect').on('ifChecked', function(event){
		$('#example2 input[type=checkbox]').attr('checked', 'checked');
		$('.odd div').addClass('checked');
		
	});

 	$('#allCheckSelect').on('ifUnchecked', function(event){
		$('.odd div').removeClass('checked');
		$('#example2 input[type=checkbox]').removeAttr('checked');
	});


 	$("input[name='user_delete_id[]']").on('ifUnchecked', function(event){
		$(this).removeAttr('checked');
	});




    





});


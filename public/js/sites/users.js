$(document).ready(function(){

	$('.iradio_minimal').on('ifChecked', function(event){
		
		var value = $(this).find(".handle-change-user").data('type');
	  	if(value == "admin"){
			$("#user_permissions").show();
			/*$("input[name='permission[]']").each( function (i) {
				$(this).attr('checked', 'checked');
				$(this).prop('disabled', true);
       		});*/
		}else if(value == "staff"){
			$("#user_permissions").show();
			/*$("input[name='permission[]']").each( function (i) {
				$(this).removeAttr('disabled');
       		});*/
		}else{
			$("#user_permissions").hide();
		}
	});


	$('.handle-change-user').on('ifChecked', function(event){
		var value = $(this).data('type');//
	  	if(value == "client"){
			//$("#user_permissions").show();
			$("input[name='user_access[]']").each( function (i) {
				$(this).iCheck('uncheck');
			});

       		$("input[name='permission[]']").each( function (i) {
				$(this).iCheck('uncheck');
				$(this).iCheck('disable');
				//$(this).prop('disabled', true);
       		});

		}else if(value == "staff"){
			$("input[name='user_access[]']").each( function (i) {
				$(this).iCheck('check');
			});

       		$("input[name='permission[]']").each( function (i) {
				$(this).iCheck('check');
				$(this).iCheck('enable');
			});
		}
	});

	$("input[name='user_access[]']").on('ifChecked', function(event){
		var value = $(this).data('name');
	  	if(value == "JOBS"){
			$("input[name='permission[]']").each( function (i) {
				//$(this).prop('disabled', false);
				$(this).iCheck('enable');
       		});

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


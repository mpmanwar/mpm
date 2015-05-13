$(document).ready(function(){

	$('#allCheckSelect').on('ifChecked', function(event){
		/*$('#example2 input[type=checkbox]').attr('checked', 'checked');
		$('.all_check div').addClass('checked');*/
		$('input').iCheck('check');
	});

	$('#allCheckSelect').on('ifUnchecked', function(event){
		/*$('.all_check div').removeClass('checked');
		$("input[name='client_delete_id[]']").removeAttr('checked');*/
		$('input').iCheck('uncheck');
	});

	$("input[name='client_delete_id[]']").on('ifUnchecked', function(event){
		//$(this).removeAttr('checked');
		$(this).iCheck('uncheck');
	});


	$('#deleteClients').click(function() {
		var val = [];
        $("input[name='client_delete_id[]']").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}

       	});
        //alert(val.length);return false;
		if(val.length>0){
			if(confirm("Do you want to delete?")){
				$.ajax({
				    type: "POST",
				    url: '/delete-individual-clients',
				    data: { 'user_delete_id' : val },
				    success : function(resp){
				    	//window.location = 'http://mpm.com/user-list';
				    	window.location = '/individual-clients';
				    }
				});
			}

 		}else{
 			alert('Please select atleast one clients');
 		}
 	});


});
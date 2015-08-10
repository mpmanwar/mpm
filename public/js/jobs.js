$(document).ready(function () {

  $('#CheckallCheckbox').on('ifChecked', function(event){
        $(".jobs input[class='checkbox']").iCheck('check');
  });

  $('#CheckallCheckbox').on('ifUnchecked', function(event){
      $(".jobs input[class='checkbox']").iCheck('uncheck');
  });
	
/* ################# Send to Task Management Start ################### */
    $(".send_manage_task").click(function(){
        var client_id = $(this).data("client_id");
        var service_id = $("#service_id").val();
        $.ajax({
            type: "POST",
            url: "/jobs/send-manage-task",
            data: { 'client_id': client_id, 'service_id' : service_id },
            success: function (resp) {
                $("#after_send_"+client_id).html('<button type="button" class="sent_btn">Sent</button>');              
            }
        });
        
    });
/* ################# Send to Task Management End ################### */
	
    
    
    
	
});//document end

$(document).ready(function (e) {
  $('#allCheckSelect').on('ifChecked', function(event){
        $(".email_letter input[class='ads_Checkbox']").iCheck('check');
    });

    $('#allCheckSelect').on('ifUnchecked', function(event){
        $(".email_letter input[class='ads_Checkbox']").iCheck('uncheck');
    });

  	$(".more_address").click(function(){
        var client_id   = $(this).data('client_id');
        
        var address = $("#corres_add_"+client_id).val();
        $("#show_full_address").html(address);
        $("#full_address-modal").modal("show");
    });

  /* ################# Open Notes Popup Start ################### */
    $(".open_notes_popup").click(function(){
      var client_id     = $(this).data("client_id");
      var contact_type  = $(this).data("contact_type");
      $.ajax({
          type: "POST",
          dataType : "json",
          url: "/contacts/show-contacts-notes",
          data: { 'client_id': client_id, 'contact_type' : contact_type },
          success: function (resp) {
            $("#notes_client_id").val(client_id);
            $("#contact_type").val(contact_type);
            $("#notes").val(resp['notes']);
            $("#notes-modal").modal("show");             
          }
      });
        
    });
/* ################# Save Notes Popup End ################### */
	
/* ################# Save Notes Start ################### */
    $(".save_notes").click(function(){
      var client_id     = $("#notes_client_id").val();
      var contact_type  = $("#contact_type").val();
      var notes         = $("#notes").val();

      $.ajax({
          type: "POST",
          //dataType : "json",
          url: "/contacts/save-contacts-notes",
          data: { 'client_id': client_id, 'contact_type' : contact_type, 'notes' : notes },
          success: function (resp) {
            //$("#notes-modal").modal("hide");  
            window.location = '/contacts-letters-emails';           
          }
      });
        
    });
/* ################# Save Notes End ################### */
    
    
    
	
});

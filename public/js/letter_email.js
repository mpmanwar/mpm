$(document).ready(function (e) {

  $(document).click(function() {
    $(".address_type_down").hide();
  });

  $(".down_arrow").click(function(event) {
      $(".address_type_down").toggle();
      event.stopPropagation();
  });

  $('.allCheckSelect').on('ifChecked', function(event){
        $(".email_letter input[class='ads_Checkbox']").iCheck('check');
    });

    $('.allCheckSelect').on('ifUnchecked', function(event){
        $(".email_letter input[class='ads_Checkbox']").iCheck('uncheck');
    });

  	$("body").on("click", ".more_address", function(){
        var client_id   = $(this).data('client_id');
        var client_type   = $(this).data('client_type');
        if(client_type == "org"){
            var address = $("#corres_add_"+client_id).val();
        }else if(client_type == "ind"){
            var address_type   = $(this).data('address_type');
            if(address_type == "reg"){
              var address = $("#reg_add_"+client_id).val();
            }else{
              var address = $("#serv_add_"+client_id).val();
            }
        }else if(client_type == "staff"){

        }else if(client_type == "other"){
          var contact_id   = $(this).data('contact_id');
          var address = $("#other_address_"+contact_id).val();
        }else if(client_type == "custom"){
          var client_id   = $(this).data('client_id');
          var address = $("#custom_address_"+client_id).val();
        }

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
      var step_id       = $("#step_id").val();
      var address_type  = $("#encoded_type").val();

      $.ajax({
          type: "POST",
          //dataType : "json",
          url: "/contacts/save-contacts-notes",
          data: { 'client_id': client_id, 'contact_type' : contact_type, 'notes' : notes },
          success: function (resp) {
            //$("#notes-modal").modal("hide");  
            window.location = '/contacts-letters-emails/'+step_id+"/"+address_type;           
          }
      });
        
    });
/* ################# Save Notes End ################### */

/* ################# Create Group Start ################### */
    $(".create_groups").click(function(){
      var step_id       = $("#create_group_step_id").val();
      var tab_id        = $("#tab_id").val();
      var group_name    = $("#group_name").val();
      var address_type  = $("#encoded_type").val();

      $.ajax({
          type: "POST",
          dataType : "json",
          url: "/contacts/save-contacts-group",
          beforeSend : function(){
            $(".loader_class").html('<img src="/img/spinner.gif" />');
          },
          data: { 'step_id': step_id, 'group_name' : group_name },
          success: function (resp) {
            if(resp > 0){
              window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type;            
            }else{
              $(".loader_class").html('');
              alert("There are some error..., Please try again.");
              return false;
            }
          }
      });
        
    });
/* ################# Create Group End ################### */

/* ################# Open Group Popup Start ################### */
  $(".create_group").click(function(){
    var val = [];
    $(".ads_Checkbox:checked").each( function (i) {
      if($(this).is(':checked')){
        val[i] = $(this).val();
      }
    });
    //alert(val.length);return false;
    if(val.length>0){
      $("#clients_array").val(val);
      $("#create_group-modal").modal("show");
    }else{
      alert('You have not selected any contacts to group');
    }
  });

  $(".open_addto_group").click(function(){
      $("#addto_group-modal").modal("show");
  });

  $("#group_step_id").change(function(){
      var group_id = $(this).val();
      if(group_id == ""){
        $("#group_show").show();
      }else{
        $("#group_name").val("");
        $("#group_show").hide();
      }
  });

  $(".saveto_group").click(function(){
      var tab_id        = $("#tab_id").val();
      var address_type  = $("#encoded_type").val();

      var group_name  = $("#group_name").val();
      var group_id    = $("#group_step_id").val();
      var client_ids  = $("#clients_array").val();
      //alert(client_ids+", "+group_name);return false;
      if(group_name == "" && group_id == ""){
        alert("Please select or enter the group name");
        return false;
      }

      $.ajax({
          type: "POST",
          url: "/contacts/copy-to-group",
          beforeSend : function(){
            $(".loader_class").html('<img src="/img/spinner.gif" />');
          },
          data: { 'group_id':group_id, 'group_name':group_name, 'tab_id':tab_id, 'client_ids':client_ids },
          success: function (resp) {
            if(resp > 0){
              window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type;            
            }else{
              $(".loader_class").html('There are some error..., Please try again.');
              //alert("There are some error..., Please try again.");
              //return false;
            }
          }
      });
        
    });
/* ################# Open Group Popup End ################### */

/* ################# Search Client By Address Type Start ################### */
    $(".address_type").change(function(){
      var address_type  = $(this).val();
      var client_id = $(this).data('client_id');
      var key = $(this).data('key');
      $.ajax({
          type: "POST",
          dataType : "json",
          url: "/contacts/search-address",
          data: { 'address_type' : address_type, 'client_id' : client_id },
          success: function (resp) {
            if(resp['address'].length > '48'){
              var small_addr = resp['address'].substring(0,45)
              var address = small_addr+"...<a href='javascript:void(0)' class='more_address' data-client_id='"+client_id+"' data-client_type='org'>more</a>"
            }else{
              var address = resp['address'];
            }
            $("#corres_add_"+client_id).val(resp['address']);
            $(".tr_no_"+key+" td:nth-child(5)").html(resp['contact_person']);   
            $(".tr_no_"+key+" td:nth-child(6)").html(resp['telephone']);
            $(".tr_no_"+key+" td:nth-child(7)").html(resp['mobile']);   
            $(".tr_no_"+key+" td:nth-child(8)").html(resp['email']);
            $(".tr_no_"+key+" td:nth-child(9)").html(address);       
          }
      });
        
    });
/* ################# Search Client By Address Type End ################### */

/* ################# Search Client By Address Type Start ################### */
    $("#addto_group-modal").on("click", ".edit_status", function(){
        var step_id = $(this).data("step_id");
        var status_name = $("#status_span"+step_id).html();
        var text_field = "<input type='text' maxlength='12' id='status_name"+step_id+"' value='"+status_name+"' style='width:100%; height:30px'>";
        var action = "<a href='javascript:void(0)' class='save_new_status' data-step_id='"+step_id+"'>Save</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='cancel_edit' data-step_id='"+step_id+"'>Cancel</a>";
        $("#status_span"+step_id).html(text_field);
        $("#action_"+step_id).html(action);
    });

    $("#addto_group-modal").on("click", ".cancel_edit", function(){
        var step_id = $(this).data("step_id");
        var status_name = $("#status_name"+step_id).val();
        var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
        action += ' <a href="javascript:void(0)" class="delete_group" data-step_id="'+step_id+'"><img src="/img/cross.png" height="12" title="Delete Group?"></a>';
        $("#status_span"+step_id).html(status_name);
        $("#action_"+step_id).html(action);
    });

    $("#addto_group-modal").on("click", ".save_new_status", function(){
        var step_id       = $(this).data("step_id");
        var address_type  = $("#encoded_type").val();
        var tab_id        = $("#tab_id").val();
        var group_name    = $("#status_name"+step_id).val();
        //alert(group_name+" "+step_id);
        $.ajax({
            type: "POST",
            url: "/contacts/save-edit-group",
            //dataType: "json",
            data: { 'step_id': step_id, 'group_name' : group_name },
            beforeSend: function() {
                $(".loader_class").html('<img src="/img/spinner.gif" />');
            },
            success: function (resp) {
                if(resp != ""){
                  window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type; 
                  /*var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
                  $("#status_span"+step_id).html(status_name);
                  $("#action_"+step_id).html(action);

                  $("#step_field_"+step_id).text(status_name);*/
                }else{
                    alert("There are some problem to update status");
                }
                
            }
        });

    });
    
    $("#addto_group-modal").on("click", ".delete_group", function(){
        var address_type  = $("#encoded_type").val();
        var tab_id        = $("#tab_id").val();
        var step_id       = $(this).data("step_id");

        if(confirm("Do you want to delete this group?")){
          $.ajax({
            type: "POST",
            url: "/contacts/delete-group",
            data: { 'step_id': step_id },
            beforeSend: function() {
                $(".loader_class").html('<img src="/img/spinner.gif" />');
            },
            success: function (resp) {
                if(resp == 1){
                  window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type; 
                }else{
                    $(".loader_class").html("There are some problem to delete the group.");
                }
                
            }
          });
        }
    });

/* ################# Search Client By Address Type End ################### */ 

/* ################# Delete Client From group Type Start ################### */ 
  $(".delete_group_client").click(function(){
      var address_type  = $("#encoded_type").val();
      var tab_id        = $("#tab_id").val();
      var contact_type  = $(this).data("contact_type");
      var client_id     = $(this).data("client_id");

      if(confirm("Do you want to delete this address from the group?")){
          $.ajax({
            type: "POST",
            url: "/contacts/delete-from-group",
            data: { 'contact_type': contact_type, 'client_id' : client_id, 'tab_id' : tab_id },
            beforeSend: function() {
                $(".loader_class").html('<img src="/img/spinner.gif" />');
            },
            success: function (resp) {
                if(resp == 1){
                  window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type; 
                }else{
                    $(".loader_class").html("There are some problem to delete the group contact.");
                }
                
            }
          });
        }
  });
/* ################# Delete Client From group Type End ################### */ 

/* ################# Delete Client From group Type Start ################### */ 
  $(".change_address").change(function(){
      var contact_type  = $(this).val();
      
      $.ajax({
        type: "POST",
        url: "/contacts/show-contact-group",
        dataType: "json",
        data: { 'contact_type': contact_type },
        success: function (resp) {
            $("#addr_line1").val(resp['address1']);
            $("#addr_line2").val(resp['address2']);
            $("#city").val(resp['city']);
            $("#county").val(resp['county']);
            $("#postcode").val(resp['postcode']);
            $("#country").val(resp['country']);
        }
      });
       
  });
/* ################# Delete Client From group Type End ################### */ 
   
    $(".add_contact-modal").click(function(){
      var contact_id  = $(this).data("contact_id");
      $("#contact_id").val(contact_id);

      if(contact_id > 0){
        $.ajax({
          type: "POST",
          url: "/contacts/get-contact-details",
          dataType: "json",
          data: { 'contact_id': contact_id, 'contact_type': "other" },
          success: function (resp) {
            $("#contact_type").val(resp['contact_type']);
            $("#contact_name").val(resp['contact_name']);
            $("#telephone_code").val(resp['telephone_code']);
            $("#telephone").val(resp['telephone']);
            $("#mobile_code").val(resp['mobile_code']);
            $("#mobile").val(resp['mobile']);
            $("#email").val(resp['email']);
            $("#company_name").val(resp['company_name']);
            $("#addr_line1").val(resp['addr_line1']);
            $("#addr_line2").val(resp['addr_line2']);
            $("#city").val(resp['city']);
            $("#county").val(resp['county']);
            $("#postcode").val(resp['postcode']);
            $("#country").val(resp['country']);
            $("#website").val(resp['website']);

            $("#add_contact-modal").modal("show");
          }
        });
      }else{
        $("#add_contact-modal").modal("show");
      }
    });

/* ################# Delete Other Contact Details Start ################### */ 
  $(".delete_contact").click(function(){
      var address_type  = $("#encoded_type").val();
      var tab_id        = $("#tab_id").val();
      var contact_id     = $(this).data("contact_id");

      if(confirm("Do you want to delete this contact address?")){
          $.ajax({
            type: "POST",
            url: "/contacts/delete-contact-address",
            data: { 'contact_type': 'other', 'contact_id' : contact_id },
            success: function (resp) {
                if(resp == 1){
                  window.location = '/contacts-letters-emails/'+tab_id+'/'+address_type; 
                }else{
                    alert("There are some problem to delete the contact.");
                }
                
            }
          });
        }
  });
/* ################# Delete Other Contact Details End ################### */ 
    
	
});

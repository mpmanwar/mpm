$(document).ready(function () {
  $('#CheckallCheckbox').on('ifChecked', function(event){
      $(".crm input[class='ads_Checkbox']").iCheck('check');
  });

  $('#CheckallCheckbox').on('ifUnchecked', function(event){
      $(".crm input[class='ads_Checkbox']").iCheck('uncheck');
  });

    $(document).click(function() {
        $(".open_toggle").hide();
    });
    $("#select_icon").click(function(event) {
        $(".open_toggle").toggle();
        event.stopPropagation();
    });

    $(".small_icon").click(function(event) {
        var id = $(this).data("id");
        var tab = $(this).data("tab");
        $("#status"+id+"_"+tab).toggle();
        event.stopPropagation();
    });

    $(".open_form-modal").click(function(){
      var type  = $(this).data("type");
      $("#type").val(type);
      if(type == "org"){
        $("#prospect_name_div").hide();
        $("#contact_name_div").show();
        $("#org_name_div").show();
      }else{
        $("#contact_name_div").hide();
        $("#org_name_div").hide();
        $("#prospect_name_div").show();
      }

      $.ajax({
        type: "POST",
        url: '/crm/get-form-dropdown',
        dataType : 'json',
        data: { 'type' : type },
        success : function(resp){
          var client_dropdown = "<option value=''>-- None --</option>";
          $.each(resp['existing_clients'], function(key){
            client_dropdown+= "<option value='"+resp['existing_clients'][key].client_id+"'>"+resp['existing_clients'][key].client_name+"</option>";
          });
          $("#existing_client").html(client_dropdown);

          $("#open_form-modal").modal("show");
        }
      });
      
      
      
    });

// Save Business type while add organization client start //
$("#add_business_type").click(function(){
    var org_name      = $("#org_name").val();
    var client_type   = $(this).data("client_type");
    
    $.ajax({
      type: "POST",
      url: '/client/add-business-type',
      data: { 'org_name':org_name, 'client_type' : client_type },
      success : function(field_id){
        var append = '<div class="form-group" id="hide_div_'+field_id+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_org_name" data-field_id="'+field_id+'"><img src="/img/cross.png" width="12"></a><label for="'+org_name+'">'+org_name+'</label></div>';
        $("#append_bussiness_type").append(append);

        $("#org_name").val("");
        $("#business_type").append('<option value="'+field_id+'">'+org_name+'</option>');

      }
    });
});
// Save Business type while add organization client end //

//Delete Business Type end start //
$("#append_bussiness_type").on("click", ".delete_org_name", function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-org-name',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          //location.reload();
          $("#hide_div_"+field_id).hide();
          $("#business_type option[value='"+field_id+"']").remove();
        }else{
          alert("There are some error to delete this type, Please try again");
        }
      }
    });
  }
  
}); 
//Delete Business Type end //

$(".lead_source-modal").click(function(){
    $("#lead_source-modal").modal("show");
});

// Save Lead Source start //
$("#add_lead_source").click(function(){
    var source_name     = $("#new_source").val();
    var modal_type      = $("#modal_type").val();
    
    $.ajax({
      type: "POST",
      url: '/crm/add-new-source',
      data: { 'source_name':source_name, 'modal_type' : modal_type },
      success : function(field_id){
        var append = '<div class="form-group" id="hide_div_'+field_id+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_source" data-field_id="'+field_id+'"><img src="/img/cross.png" width="12"></a><label for="'+source_name+'">'+source_name+'</label></div>';
        $("#append_new_source").append(append);

        $("#new_source").val("");
        $("#lead_source").append('<option value="'+field_id+'">'+source_name+'</option>');

      }
    });
});
// Save Lead Source end //

//Delete Lead Source end start //
$("#append_new_source").on("click", ".delete_source", function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/crm/delete-source-name',
      data: { 'field_id' : field_id },
      success : function(resp){
        if(resp != ""){
          $("#hide_div_"+field_id).hide();
          $("#lead_source option[value='"+field_id+"']").remove();
        }else{
          alert("There are some error to delete this type, Please try again");
        }
      }
    });
  }
  
}); 
//Delete Lead Source end //



/* ================== Manage Tasks ================== */
  $(".lead_status-modal").click(function(){
    $("#lead_status-modal").modal("show");
  });
  $("#lead_status-modal").on("click", ".edit_status", function(){
      var step_id = $(this).data("step_id");
      var status_name = $("#status_span"+step_id).html();
      var text_field = "<input type='text'  maxlength='13' id='status_name"+step_id+"' value='"+status_name+"' style='width:37%; height:30px'>";
      var action = "<a href='javascript:void(0)' class='save_new_status' data-step_id='"+step_id+"'>Save</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='cancel_edit' data-step_id='"+step_id+"'>Cancel</a>";
      $("#status_span"+step_id).html(text_field);
      $("#action_"+step_id).html(action);
  });

  $("#lead_status-modal").on("click", ".cancel_edit", function(){
      var step_id = $(this).data("step_id");
      var status_name = $("#status_name"+step_id).val();
      var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
      $("#status_span"+step_id).html(status_name);
      $("#action_"+step_id).html(action);
  });

  $("#lead_status-modal").on("click", ".save_new_status", function(){
      var step_id = $(this).data("step_id");
      var status_name = $("#status_name"+step_id).val();
      //alert(status_name+" "+step_id);
      $.ajax({
          type: "POST",
          url: "/crm/save-edit-status",
          //dataType: "json",
          data: { 'step_id': step_id, 'status_name' : status_name, 'type' : 'title' },
          beforeSend: function() {
              //$("#goto"+key).html('<img src="/img/spinner.gif" />');
          },
          success: function (resp) {
              if(resp != ""){
                  var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
                  $("#status_span"+step_id).html(status_name);
                  $("#action_"+step_id).html(action);

                  $("#step_field_"+step_id).text(status_name);
                  $(".status_dropdown option[value='"+step_id+"']").html(status_name);

              }else{
                  alert("There are some problem to update status");
              }
              
          }
      });

  });

/* ################# Send to Task Management End ################### */

/* ################# View Notes Start ################### */
  $(".open_notes_popup").click(function(){
    var leads_id  = $(this).data("leads_id");
    var notes     = $("#notes_"+leads_id).val();
    $("#show_full_notes").html(notes);
    $("#full_notes-modal").modal("show");
  });
/* ################# View Notes End ################### */

/* ################# Delete Leads Details Start ################### */
$(".deleteLeads").click(function(){
    var val = [];
    $(".ads_Checkbox:checked").each( function (i) {
      if($(this).is(':checked')){
        val[i] = $(this).val();
      }
    });
    //alert(val.length);return false;
    if(val.length>0){
      var page_open = $("#encode_page_open").val();
      var owner_id = $("#encode_owner_id").val();
      if(confirm("Do you want to delete??")){
        $.ajax({
            type: "POST",
            url: '/crm/delete-leads-details',
            data: { 'leads_delete_id' : val },
            success : function(resp){
              window.location = '/crm/'+page_open+"/"+owner_id;
            }
        });
      }

    }else{
      alert('Please select atleast one details');
    }
  });
/* ################# Delete Leads Details End ################### */

/* ################# Delete Leads Details Start ################### */
  $(".status_dropdown").change(function(){
      var tab_id = $(this).val();
      var leads_id = $(this).data('leads_id');
      var page_open = $("#encode_page_open").val();
      var owner_id = $("#encode_owner_id").val();

      $.ajax({
          type: "POST",
          url: '/crm/sendto-another-tab',
          data: { 'tab_id' : tab_id, 'leads_id' : leads_id },
          success : function(resp){
            window.location = '/crm/'+page_open+"/"+owner_id;
          }
      });
  });




	
});//document end 

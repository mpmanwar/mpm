$(document).ready(function () {
  $('#CheckallCheckbox').on('ifChecked', function(event){
      $(".crm input[class='ads_Checkbox']").iCheck('check');
  });

  $('#CheckallCheckbox').on('ifUnchecked', function(event){
      $(".crm input[class='ads_Checkbox']").iCheck('uncheck');
  });

  $(".ads_Checkbox").on('ifChecked', function(event){
    $(".ads_Checkbox:checked").each( function (i) {
        if($(this).data("archive") == "Y"){
          $("#archivedButton").html('Un-Archive');
        }else{
          $("#archivedButton").html('Archive');
        }
    });
    
  });
  $(".ads_Checkbox").on('ifUnchecked', function(event){
    $(".ads_Checkbox:checked").each( function (i) {
        if($(this).data("archive") == "Y"){
          $("#archivedButton").html('Un-Archive');
        }else{
          $("#archivedButton").html('Archive');
        }
    });
    
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
      var type      = $(this).data("type");
      var leads_id  = $(this).data("leads_id");

      $("#type").val(type);
      $("#leads_id").val(leads_id);
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
        data: { 'type' : type, 'leads_id' : leads_id },
        success : function(resp){
          var client_dropdown = "<option value=''>-- None --</option>";
          $.each(resp['existing_clients'], function(key){
            client_dropdown+= "<option value='"+resp['existing_clients'][key].client_id+"'>"+resp['existing_clients'][key].client_name+"</option>";
          });
          $("#existing_client").html(client_dropdown);
//alert(resp['leads_details'].lead_source);
          //==================Edit =================//
          if(leads_id != "0" && resp['leads_details'].existing_client != "0"){
            $("#existing_client").val(resp['leads_details'].existing_client);
          }
          if(type == 'ind'){
            $("#prospect_title").val(resp['leads_details'].prospect_title);
            $("#prospect_fname").val(resp['leads_details'].prospect_fname);
            $("#prospect_lname").val(resp['leads_details'].prospect_lname);
          }
            $("#leads_id").val(resp['leads_details'].leads_id);
            $("#date").val(resp['leads_details'].date);
            $("#deal_certainty").val(resp['leads_details'].deal_certainty);
            $("#deal_owner").val(resp['leads_details'].deal_owner);
            $("#business_type").val(resp['leads_details'].business_type);
            $("#prospect_name").val(resp['leads_details'].prospect_name);
            $("#contact_title").val(resp['leads_details'].contact_title);
            $("#contact_fname").val(resp['leads_details'].contact_fname);
            $("#contact_lname").val(resp['leads_details'].contact_lname);
            $("#phone").val(resp['leads_details'].phone);
            $("#mobile").val(resp['leads_details'].mobile);
            $("#email").val(resp['leads_details'].email);
            $("#website").val(resp['leads_details'].website);
            $("#annual_revenue").val(resp['leads_details'].annual_revenue);
            $("#quoted_value").val(resp['leads_details'].quoted_value);
            $("#lead_source").val(resp['leads_details'].lead_source);
            $("#industry").val(resp['leads_details'].industry);
            $("#street").val(resp['leads_details'].street);
            $("#city").val(resp['leads_details'].city);
            $("#county").val(resp['leads_details'].county);
            $("#postal_code").val(resp['leads_details'].postal_code);
            $("#country").val(resp['leads_details'].country);
            $("#notes").val(resp['leads_details'].notes);
          //}

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

/* ################# Status change Start ################### */
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
  $(".sendto_invoiced").click(function(){
      var tab_id = $(this).data('tab_id');
      var leads_id = $(this).data('leads_id');
      var page_open = $("#encode_page_open").val();
      var owner_id = $("#encode_owner_id").val();

      $.ajax({
          type: "POST",
          url: '/crm/sendto-another-tab',
          data: { 'tab_id' : tab_id, 'leads_id' : leads_id },
          beforeSend : function(){
            $(".select_toggle").hide();
          },
          success : function(resp){
            window.location = '/crm/'+page_open+"/"+owner_id;
          }
      });
  });
/* ################# Status change End ################### */

/* ################# Existing Client Start ################### */
  $("#existing_client").change(function(){
      var client_type = $("#type").val();
      var client_id = $(this).val();

      $.ajax({
          type: "POST",
          dataType: "json",
          url: '/crm/get-client-address',
          data: { 'client_id' : client_id, 'client_type' : client_type },
          success : function(resp){
            if(client_type=="org"){
              $("#business_type").val(resp['address'].business_type);
              $("#prospect_name").val(resp['address'].business_name);
              $("#contact_fname").val(resp['address'].contact_fname);
              $("#contact_lname").val(resp['address'].contact_lname);
            }else{
              $("#prospect_title").val(resp['address'].prospect_title);
              $("#prospect_fname").val(resp['address'].prospect_fname);
              $("#prospect_lname").val(resp['address'].prospect_lname);
            }
            $("#phone").val(resp['address'].telephone);
            $("#mobile").val(resp['address'].mobile);
            $("#email").val(resp['address'].email);
            $("#website").val(resp['address'].website);
            $("#street").val(resp['address'].address1);
            $("#city").val(resp['address'].city);
            $("#county").val(resp['address'].county);
            $("#postal_code").val(resp['address'].postcode);
            $("#country_id").val(resp['address'].country);
          }
      });
  });
/* ################# Existing Client End ################### */

/* ################# Graphs Modal Start #################### */
  $(".graphs-modal").click(function(){
    $("#show_graph").html('');
    $("#show_graph_loader").html('');
    $("#from_date").val('');
    $("#to_date").val('');
    $("#graphs-modal").modal("show");
  });

  $("#show_graph_button").click(function(){
    var month = $("#month").val();
    var year = $("#year").val();
    var compare = $("#compare").val();

    $.ajax({
          type: "POST",
          url: '/crm/show-graph',
          data: { 'month' : month, 'year' : year, 'compare' : compare },
          beforeSend: function() {
            $("#show_graph").html('');
            $("#show_graph_loader").html('<img src="/img/spinner.gif" />');
          },
          success : function(resp){
            $("#show_graph_loader").html('');
            $("#show_graph").html(resp);
          }
      });
      
  });

/* ################# Graphs Modal Start #################### */

//Show Archived in add individual client
  $("#archive_div").click(function(){
    var page_open = $("#encode_page_open").val();
    var owner_id = $("#encode_owner_id").val();

    var is_archive;
    var html = $(this).html();
    if($.trim(html) == 'Show Archived'){
      is_archive  = 'N';
    }else{
      is_archive  = 'Y';
    }
    $.ajax({
      type: "POST",
      url: '/crm/show-archive-leads',
      data: { 'is_archive' : is_archive },
      success : function(resp){//return false;
        window.location = '/crm/'+page_open+"/"+owner_id;
      }
    });
  });

// Archive and Un-Archive client start //
  $("#archivedButton").click(function(){
    var page_open = $("#encode_page_open").val();
    var owner_id = $("#encode_owner_id").val();

    var val = [];
    $(".ads_Checkbox:checked").each( function (i) {
      if($(this).is(':checked')){
        val[i] = $(this).val();
      }
    });
    if(val.length>0){
      var status = $.trim($(this).html());
      if(confirm("Do you want to "+status+" the items?")){
        $.ajax({
            type: "POST",
            url: '/crm/archive-leads',
            data: { 'leads_ids' : val, 'status' : status },
            success : function(resp){
              window.location = '/crm/'+page_open+"/"+owner_id;
            }
        });
      }
    }else{
      alert('Please select atleast one item');
    }
  
  });
// Archive and Un-Archive client start //

  $("#display").click(function(){
    //var page_open = $("#encode_page_open").val();
    //var owner_id = $("#encode_owner_id").val();
    var status_id   = $("#status_id").val();
    var user_id     = $("#user_id").val();
    var date_from   = $("#date_from").val();
    var date_to     = $("#date_to").val();

    if($("#is_deleted").is(':checked')){
      var is_deleted  = 'Y';
    }else{
      var is_deleted  = 'N';
    }
    if($("#is_archive").is(':checked')){
      var is_archive  = 'Y';
    }else{
      var is_archive  = 'N';
    }

    if(status_id == ""){
      alert("Please select The status");
      $("#status_id").focus();
      return false;
    }
    if(date_from == ""){
      alert("Please select Date form field");
      $("#date_from").focus();
      return false;
    }
    if(date_to == ""){
      alert("Please select Date to field");
      $("#date_to").focus();
      return false;
    }

    $.ajax({
      type: "POST",
      url: '/crm/show-leads-report',
      //dataType:'json',
      data: { 'status_id' : status_id, 'user_id' : user_id, 'is_deleted' : is_deleted, 'is_archive' : is_archive, 'date_from' : date_from, 'date_to' : date_to },
      success : function(resp){//return false;
        $("#display_result").html(resp);
      }
    });
  });

	
});//document end 


/*function validation()
{
  var client_type = $("#type").val();//alert(client_type);return false;
  if(client_type == "org"){
    var prospect_name = $("#prospect_name").val();
    if(prospect_name == ""){
      aler("Please enter prospect name");
      return false;
    }
  }else{
    var prospect_fname = $("#prospect_fname").val();
    var prospect_lname = $("#prospect_lname").val();
    if(prospect_fname == ""){
      aler("Please enter first name");
      return false;
    }
    if(prospect_lname == ""){
      aler("Please enter last name");
      return false;
    }
  }

  return false;
  
}*/
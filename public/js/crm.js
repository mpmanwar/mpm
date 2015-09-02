$(document).ready(function () {
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
      if(type == "org"){
        $("#prospect_name_div").hide();
        $("#contact_name_div").show();
        $("#org_name_div").show();
      }else{
        $("#contact_name_div").hide();
        $("#org_name_div").hide();
        $("#prospect_name_div").show();
      }

      $("#type").val(type);
      $("#open_form-modal").modal("show");
      
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





	
});//document end 

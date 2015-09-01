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
      $("#open_form-modal").modal("show");
      
    });
	
});//document end 

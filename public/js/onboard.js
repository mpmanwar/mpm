$(document).on("click", "#businessclient", function(event){

   var client_id =$(event.target).attr("data-clientid");
    console.log($(event.target).attr("data-clientid"));
    
    //$('#checklist-modal').modal('show');
    $("#hiddenclient").val($(event.target).attr("data-clientid"));
    
    console.log($(event.target).attr("data-businessname"));
    $("#businessname").html($(event.target).attr("data-businessname"));
        
    
    $.ajax({
      type: "POST",
      url: '/client/getowner',
      data: { 'client_id':client_id },
      success : function(resp){
        
        console.log(resp);
        $("#ownerdrop").html(resp);
       

      }
    });
        
        
        
        
        

});

$("#add_position_type").click(function(){
    
                
     var type_name      = $("#checklist").val();
      var client_id      = $("#hiddenclient").val();
     console.log($(event.target).attr("data-clientid"));
    // var clientid = $("#businessclient").attr("data-clientid");
    // $("#hiddenclient").val();
    //alert(clientid);
   // return false;
        
        if(type_name !=""){
            
        
    $.ajax({
      type: "POST",
      url: '/client/add-checklist',
      data: { 'type_name':type_name, 'client_id':client_id },
      success : function(field_id){
        $("#checklist").val("");
        //alert(field_id)
       var append = '<div class="form-group" id="hide_div_'+field_id+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_checklist_name" data-field_id="'+field_id+'"><img src="/img/cross.png" width="12"></a><label for="'+type_name+'">'+type_name+'</label></div>';
        $("#append_position_type").append(append);

       $("#checklist").html("");
        $("#checklist_type").append('<option value="'+field_id+'">'+type_name+'</option>'); 

      }
    });
    }
    
});

$("#positionopen").click(function(){
    $("#checklist").html("");
    
   });
    

$("#append_position_type").on("click", ".delete_checklist_name", function(){
    
 
  var field_id = $(this).data('field_id');
  
  //alert(field_id);return false;
  
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/delete-checklist-type',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          //location.reload();
          $("#hide_div_"+field_id).hide();
          
          $("#position_type option[value='"+field_id+"']").remove();
        }else{
          alert("There are some error to delete this type, Please try again");
        }
      }
    });
  }
  
}); 


$(document).ready(function() {

	$("#txtboxToFilter").keydown(function(event) {
    
        
		if ( event.keyCode == 46 || event.keyCode == 8 ) {

			// let it happen, don't do anything

		}

		else {
		  
          
          if($("#txtboxToFilter").val().length>=3){
			event.preventDefault();	
        return false;
        }

			// Ensure that it is a number and stop the keypress

			 if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

            e.preventDefault();

        }	

		}

	});

});



function notes(){
    
    
     var notes      = $("#notess").val();
      var client_id      = $("#notescid").val();
    
    console.log(notes)
    console.log(client_id)
    
    $.ajax({
      type: "POST",
      url: '/client/onboardsnotes',
      data: { 'client_id':client_id,'notes':notes },
      success : function(resp){
        
        console.log(resp);
        
       $("#composenotes-modal").modal("hide");

      }
    });
    
    
    
    
    
    
        
}
$(document).on("click", "#notesmodal", function(event){
    
    
    $("#notess").val("");
    var client_id =$(this).attr('data-cid');
    
    console.log($(this).attr('data-cid'))
    $("#notescid").val(client_id);
    
    $.ajax({
      type: "POST",
      url: '/client/getonboardsnotes',
      data: { 'client_id':client_id },
      success : function(resp){
        
        console.log(resp);
        
      $("#notess").val(resp);

      }
    });
    
    
    
    
    
    $("#composenotes-modal").modal("show");
     
    
    
    
    event.preventDefault();
    
    
});


 $(".change_last_date").click(function(){
        var key         = $(this).data('key');
        var tab         = $(this).data('tab');
        var prev_date   = $(this).data('prev_date');
        $(this).hide();
        $("."+tab+"_save_made_span_"+key).show();
        $("#"+tab+"_made_up_date_"+key).val(prev_date); 
    });
    $(".cancel_made_date").click(function(){
        var key   = $(this).data('key');
        var tab   = $(this).data('tab');
        $("#"+tab+"_dateanchore_"+key).show();
        $("."+tab+"_save_made_span_"+key).hide();
    });

/*
function notesmodal(){
     $("#composenotes-modal").modal("show");
     return false;
 }*/
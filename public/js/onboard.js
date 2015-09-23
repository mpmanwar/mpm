$(document).ready(function(){

  $('#BoxTable').on('click', '.addto_task', function(event){
    var checklist_id = $(this).data('checklist_id');
      if($(this).is(':checked')){
          $('#ownerdrop_'+checklist_id+' select').removeAttr("disabled");
          $('#statusdrop_'+checklist_id+' select').removeAttr("disabled");
      } else {
          $('#ownerdrop_'+checklist_id+' select').attr("disabled","disabled");
          $('#statusdrop_'+checklist_id+' select').attr("disabled","disabled");
      }
    
  });

  $('.addnew_line').click(function() {
      var client_id =$('#c_id').val();
      $.ajax({
        type: "POST",
        //url: '/client/getowner',
        url: '/onboarding/ajax-new-task',
        data: { 'client_id' : client_id },
        success : function(resp){
          $('#BoxTable > tbody:last-child').append(resp);
          //var r = resp.split('|||');
          //$("#ownerdrop").html(r[1]);
        }
      });
  });

  $(document).on("click", ".DeleteBoxRow", function(){
    var cleinttaskdate_id = $(this).data('cleinttaskdate_id');
    if(cleinttaskdate_id == 0){
      $(this).closest("tr").remove();
    }else{
      $.ajax({
        type: "POST",
        url: '/onboarding/delete-task-details',
        data: { 'cleinttaskdate_id' : cleinttaskdate_id },
        success : function(resp){
          $("#TemplateRow_"+cleinttaskdate_id).hide();
        }
      });
      
    }
  });

});

$(document).on("click", "#businessclient", function(event){
  $("#idopen_dropdown").hide();
    var client_id =$(this).data("clientid");
    $("#clientspanid").html(client_id)
    $("#c_id").val(client_id)
    $("#hiddenclient").val(client_id);
    $("#businessname").html($(event.target).attr("data-businessname"));
        
    $.ajax({
      type: "POST",
      //url: '/client/getowner',
      url: '/onboarding/ajax-task-details',
      data: { 'client_id' : client_id },
      success : function(resp){
        $('#BoxTable').html(resp);
      }
    });

});


$(".open_adddrop").click(function(event) {
    var onboarding_id = $(this).data("onboarding_id");//alert(onboarding_id);
    $("#idopen_dropdown_"+onboarding_id).toggle();
    event.stopPropagation();
});

 $(".open_calender_pop").click(function(){
       
        $("#addto_calender-modal").modal("show");
    });
$("#add_position_type").click(function(){
    var type_name      = $("#checklist").val();
    var client_id      = $("#hiddenclient").val();
        
    if(type_name !=""){
      $.ajax({
        type: "POST",
        url: '/client/add-checklist',
        dataType:'json',
        data: { 'type_name':type_name, 'client_id':client_id },
        beforeSend: function() {
          $("#add_to_msg").html('<img src="/img/spinner.gif" />');
        },
        success : function(resp){
          window.location.reload();
          $("#checklist").val("");
          //alert(field_id)
          var append = '<div class="form-group" id="hide_div_'+resp['last_id']+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_checklist_name" data-field_id="'+resp['last_id']+'"><img src="/img/cross.png" width="12"></a>&nbsp;<label for="'+type_name+'">'+type_name+'</label></div>';
          //$("#append_position_type").append(append);
          $("#checklist").html("");

          var new_row = $('#new_row tbody').html();
          //$('#BoxTable > tbody:last-child').append(new_row);


        }//BoxTable
      });
    }
    
});

$("#positionopen").click(function(){
    $("#checklist").html("");
    
   });
    

$("#append_position_type").on("click", ".delete_checklist_name", function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/delete-checklist-type',
      data: { 'field_id' : field_id },
      beforeSend: function() {
        $("#add_to_msg").html('<img src="/img/spinner.gif" />');
      },
      success : function(resp){
        //return false;
        if(resp != ""){
          window.location.reload();
          $("#hide_div_"+field_id).hide();
          
          $("#checklist_type option[value='"+field_id+"']").remove();
        
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

			 if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {

            event.preventDefault();

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
    
    
    $(".save_made_date").click(function(){
        var client_id   = $(this).data('client_id');
       // var service_id  = $(this).data('service_id');
        var tab         = $(this).data('tab');
        var key         = $(this).data('key');
        var date        = $("#"+tab+"_made_up_date_"+key).val();
console.log(client_id);
//console.log(service_id);
console.log(tab);
console.log(key);
console.log(date);
//return false;
        $.ajax({
          type: "POST",
          //dataType : "json",
          url: "/onboardsave-made-up-date",
          data: { 'client_id': client_id, 'date': date },
          success: function (resp) {
            window.location = "/onboard";
            
            console.log(resp);
            //$("#"+tab+"_dateanchore_"+key).show();
            //$("."+tab+"_save_made_span_"+key).hide();         
          }
        });
    });
    
    

/*
function notesmodal(){
     $("#composenotes-modal").modal("show");
     return false;
 }*/
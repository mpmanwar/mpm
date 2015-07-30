/*
$(".pdf").click(function() {
	var id = $(this).attr("id").match(/\d+/);
	//alert(id);
	$('#add_pdffile' + id).on('change', function() {
		//alert("#pdfeform"+id);
		$("#pdfprev").html('');
		$("#pdfprev").html('Uploading Pdf.....');
		$("#pdfeform" + id).ajaxForm(
		//$('#div5').html();
		{
			//target: '#previewpdf+id',
			success: function(response) {
				//alert(response);
				x = response;
				$("#file_pdfvalue" + id).html('<img src="img/attachment.png" />');
				$("#pdfprev").html('');
			}
		}).submit();
		//$('#step4').html();
		//window.location='/noticeboard';
	});
});*/

$(document).ready(function (e) {
	
	
	$(function() {
		$(".staffupload_file").change(function() {
			//alert('fdffdf');
            var id = $(this).attr("id").match(/\d+/);
            
            	var type = $(this).attr("data-type");
            var file_id = $(this).attr("id");
			
           // alert(id);
            alert(file_id);
            
              
			var file = this.files[0];
            
            console.log(file.name);
			//var imagefile = file.type;
 var file_name = file.name+' <a href="javascript:void(0)" data-column="'+file_id+'" data-id="'+id+'"  class="staffdelete_files"><img src="/img/cross.png" height="12"></a>';
            
            if (file_id == "stafffile"+id) {
					$("#default_staffile"+id).html(file_name);
				}
            
	 if (file_id == "profilefile"+id) {
					$("#default_proffile"+id).html(file_name);
				}
        
        	var reader = new FileReader();
				
				reader.readAsDataURL(this.files[0],file_id);
			
		});
	});
    
	
});







$("#other_staff_table").on("click", ".staffdelete_files", function(){
    
    
    
    var column = $(this).data('column');
    var  id = $(this).data('id');
    
    //alert(column);
    
     if (column == "stafffile"+id) {
    
    $("#default_staffile"+id).html("");
    $("#stafffile"+id).val("");
  }
  
  
  
  if (column == "profilefile"+id) {
    
    $("#default_proffile"+id).html("");
    $("#profilefile"+id).val("");
  }
  
    
  });




// Save position type while add  start //
$("#add_position_type").click(function(){
    
    //alert('fsfsffg');return false;
    
    var org_name      = $("#org_name").val();
    
    //alert(org_name);return false;
    //var client_type   = $(this).data("client_type");
    
    $.ajax({
      type: "POST",
      url: '/add-position-type',
      data: { 'org_name':org_name },
      success : function(field_id){
        
        //alert(field_id)
        var append = '<div class="form-group" id="hide_div_'+field_id+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_org_name" data-field_id="'+field_id+'"><img src="/img/cross.png" width="12"></a><label for="'+org_name+'">'+org_name+'</label></div>';
        $("#append_position_type").append(append);

       $("#org_name").val("");
        $("#position_type").append('<option value="'+field_id+'">'+org_name+'</option>');

      }
    });
});



//Delete position name while  user start


$("#append_position_type").on("click", ".delete_org_name", function(){
    
 
  var field_id = $(this).data('field_id');
  
  //alert(field_id);
  
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/delete-position-type',
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
//Delete position name  user end






// Save Business type while add organization client end //



//function saveToDataBase(file, file_id)
//{
//    
//	//var client_id = '12';//alert(client_id)
//	if(file_id == "stafffile1" || file_id == "stafffile2" || file_id == "stafffile3" || file_id == "stafffile4" ){
//		var path = 'uploads/stafffile/';
//	}else{
//		var path = 'uploads/profilefile/'
//	}
//
//
//$("#default_staffile1").show();
//var file_name = file.name+' <a href="javascript:void(0)" class="delete_files"><img src="/img/cross.png" height="12"></a>';
//$("#default_staffile1").html(file_name);
//	
//    alert(file_name);
//	
//}
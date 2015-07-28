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
           // alert(file_id);
            
              
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
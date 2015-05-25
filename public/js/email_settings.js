function openModal( template_id )
{//console.log(template_id);
	$.ajax({
	    type: "POST",
	    dataType: "json",
	    url: '/template/edit_template',
	    data: { 'template_id' : template_id },
	    success : function(resp){
			$('#edit_email_template_id').val(resp['email_template_id']);
	    	$('#edit_name').val(resp['name']);
	    	$('#edit_title').empty().val(resp['title']);
	    	$('#hidd_file').empty().val(resp['file']);
	    	$('#edit_attach_file').empty().html(resp['file']);
			CKEDITOR.instances['edit_message'].setData(resp['message']);

			getTemplateType( resp['template_type_id'] );

	    	$('#edit-modal').modal('show');
			
			
	    }
	});
}

function getTemplateType( tmpl_typ_id )
{
	$.ajax({
	    type: "POST",
	    url: '/template/get-edit-template-type',
	    data: { 'tmpl_typ_id' : tmpl_typ_id },
	    success : function(resp){
	    	//console.log(resp);
	    	$('#edit_template_type').empty().html(resp);
	    }
	});
}

function getTemplate( template_id, process )
{
	$.ajax({
	    type: "POST",
	    dataType: "json",
	    url: '/template/get_template',
	    data: { 'template_id' : template_id },
	    success : function(resp){
	    	//console.log(resp);
	    	if(resp != "fail"){
	    		$('#'+process+'_title').empty().val(resp['title']);
	    		CKEDITOR.instances[process+'_message'].setData(resp['content']);
	    	}else{
	    		$('#'+process+'_title').val("");
	    		CKEDITOR.instances[process+'_message'].setData("");
	    	}
	    	
	    }
	});
}

function form_validation()
{
	if($('#edit_template_type').val() == ""){
		alert("Please select template type");
		return false;
	}else{
		$("#edit_form").submit();
		return true;
	}
}


$(document).ready(function(){

	$('.deleteTemplate').click(function(event){
		var eml_tmpl_id = $(this).data('eml_tmpl_id');
		if (confirm("Do you want to delete this template")) {
			$.ajax({
			    type: "POST",
			    url: '/template/delete-email-template',
			    data: { 'eml_tmpl_id' : eml_tmpl_id },
			    success : function(resp){
			    	if(resp == "success"){
			    		location.reload();
			    	}else{
			    		$('#msg').html('<p style="color:red; font-size:15px;">There are some error to delete this email template.</p>')
			    	}
			    }
			});
		}
		
	});

});


$(window).load(function() {
    
    CKEDITOR.replace( 'add_message',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
       
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
            
            
        }
    });
    
    
/*var editor = CKEDITOR.instances.doc_desc;
editor.on( 'key', function( evt ){
    limitChars(evt, 100, 'cke_wordcount_doc_desc');
   
}); */ 

CKEDITOR.replace( 'edit_message',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
            
            
        }
    });

    
});

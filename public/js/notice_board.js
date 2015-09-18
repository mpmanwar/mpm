function openModal(noticefont_id) {
    //alert('sfsfsfsf');return false;
    tinymce.remove();
    tinymce.init({
    selector: "#edit_message1",
   // elements : "notesmsg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
});
    
	//$('#edit-modal').modal('show');
	console.log(noticefont_id);
	$.ajax({
		type: "POST",
		//dataType: "html",
		url: '/editnotice-template',
		data: {
			'noticefont_id': noticefont_id
		},
		success: function(resp) {
			console.log(resp);
			// console.log("asdfhsdaghfjksdagkf")
			$("#compose-modal1").modal("show");
			//	$('#edit_notice_template_id').val(resp['edit_notice_template_id']);
			setTimeout(function() {
				//alert(resp['file'])
				if (resp['file'] != null) {
					var attachment = resp['file'];
					var res = attachment.substring(2);
				}
				//alert(res);
				// document.getElementById("edit_message1").value = resp['message'];
				//$('#edit_message1').val(resp.message);
				//$('#edit_message1').val(resp.message);
				$('#typecatagory1').val(resp.typecatagory);
				$('#edit_notice_template_id1').val(resp.noticefont_id);
				$('#message_subject1').val(resp.message_subject); //
				$('#edit_attach_file2').empty().html(res);
				$('#hidd_file').empty().val(resp['file']);
                
               // tinymce.activeEditor.setContent($('#edit_message1').val(resp.message));
                var tyn = tinyMCE.activeEditor.setContent(resp.message);
               
               // alert(tyn);return false;
                $('#edit_message1').val(tyn);
				//CKEDITOR.instances['edit_message1'].setData(resp['message']);
				//var hidden_chk = $('#hidd_chek').val(resp.checkbox);
				var ch = resp.checkbox;
				var str_array = ch.split(',');
				var gid = resp.group;
				var content = '';
				$.each(gid, function(key, value) {
					var groupids = value.user_id;
					console.log(groupids);
				});
				var str = resp.checkbox;
				$(".chknotifys").each(function(index, element) {
					//alert($(this).val());
					var box = $(this).val();
					//alert(box);
					//alert(resp.checkbox)
					if (str.indexOf(box) != -1) {
						$("#notifycheck" + box).iCheck('check');
					}
				});
				$('#edit_attach_file1').empty().html(resp['file']);
			}, 1000);
			//CKEDITOR.instances['edit_message'].setData(resp['message']);
			// $("#compose-modal").modal("toggle");
			//$('#modal').modal();
		}
	});
}

$("#fixed_add").click(function(){
    
    tinymce.remove();
     tinymce.init({
    selector: "#add_message",
   // elements : "notesmsg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
});
    
});
$("#fixed_add2").click(function(){
    
    tinymce.remove();
     tinymce.init({
    selector: "#add_message",
   // elements : "notesmsg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
});
    
});



function openbodyModal(noticefont_id,e) {
    
    
    
     tinymce.remove();
     tinymce.init({
    selector: "#edit_msgmessage",
   // elements : "notesmsg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    plugins: ["wordcount", "table", "charmap", "anchor", "insertdatetime", "link", "image", "media", "visualblocks", "preview", "fullscreen", "print", "code" ]
});
    
    
    
    //alert(event);
    
   if (!e) e = window.event;
   // alert(e.type);
    
	// console.log(noticefont_id);
	$.ajax({
		type: "POST",
		//dataType: "html",
		url: '/editnotice-template',
		data: {
			'noticefont_id': noticefont_id
		},
		success: function(resp) {
			//console.log(resp);
			//return false;
            
			$("#compose-msgmodal").modal("show");
            
			setTimeout(function(event) {
			 //alert( event.type );
				if (resp['file'] != null) {
					var attachment = resp['file'];
					var res = attachment.substring(2);
				}
				var msg = (resp.message);
                
				$('#edit_msgmessage').text($(msg).text());
				
			});
		}
	});
 
}
$(function() {
	$('#edit_msgmessage').attr('disabled', 'disabled');
});

$(".chknotifys").on('ifUnchecked', function(event) {
	var num = parseInt($(this).attr('id').match(/\d+/)[0], 10);
	$("#chknotify" + num).val('');
	// alert(num);
});
$(".chknotifys").on('ifChecked', function(event) {
	var num = parseInt($(this).attr('id').match(/\d+/)[0], 10);
	$("#chknotify" + num).val(num);
	//alert(num);
});
/*
$(window).load(function() {
	CKEDITOR.replace('add_message', {
		toolbar: [
			['Source'],
			['Cut', 'Copy', 'Paste', 'PasteText', 'SpellChecker'],
			['Undo', 'Redo', '-', 'SelectAll', 'RemoveFormat'],
			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
			['SpecialChar', 'PageBreak']
		],
		extraPlugins: 'wordcount',
		wordcount: {
			showCharCount: true,
			showWordCount: true
		}
	});

	CKEDITOR.editor.setReadOnly, CKEDITOR.replace('edit_message1', {
		toolbar: [
			['Source'],
			['Cut', 'Copy', 'Paste', 'PasteText', 'SpellChecker'],
			['Undo', 'Redo', '-', 'SelectAll', 'RemoveFormat'],
			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
			['SpecialChar', 'PageBreak']
		],
		extraPlugins: 'wordcount',
		wordcount: {
			showCharCount: true,
			showWordCount: true
		}
	});
}); */

function delfun() {
	return confirm("You want to delete??");
}

function delattachfun() {
	return confirm("You want to delete Attachment??");
}

var looper = $(".upload-buttons");
$.each(looper, function(key, value) {
	//console.log(value); 
	$(value).on('change', function() {
		var control = $(this);
		//console.log(that);
		var loop = $(this).attr("data-looper");
		console.log("in change", loop);
		//alert("#imageform"+id);
		$("#prev").html('');
		//alert('#imageform'+id);
		$("#prev").html('Uploading.....');
		$("#imageform" + loop).ajaxForm(
		//$('#div5').html();
		{
			//target: '#preview'+id,
			success: function(response) {
				control.replaceWith(control = control.clone(true));
				x = response;
				//if(!x){
				//alert('sfsf');
				//$("#prev").html('Upload Proper Excel File only');
				// }
				$("#file_value" + loop).html('<img src="img/attachment.png" />');
				$("#prev").html('');
				//console.log(x);              
				// alert(x);
			}
		}).submit();
		//$('#step4').html();
		//window.location='/noticeboard';
	});
}); /*;*/
//upload
// upload pdf




//

$(".upbutton").click(function() {

    //alert('fdsfsfs');return false;
    $("#upform").ajaxForm(
		
		{
			//target: '#previewpdf+id',
			success: function(response) {

			 //var value = editor.getData();
				//alert(value);
               console.log(response);
               
               var bno = $("#board_no").val();
               	
                //alert(bno);
                if(bno==1){
                $("#sortable").prepend(response);
                }
                if(bno==2){
                $("#sortable2").prepend(response);
                }
   	            //$("#font1_value").html(response);
                
                 $('#message_subject').val(""); 
                 $('#add_message').val("");	
                 $('#add_file').val("");	
                 //$('#notifycheckadd').prop('checked', false);
                 $("#notifycheckadd" ).iCheck('uncheck');
                 //$('#notifycheckadd').removeAttr('checked');
                 //$('#notifycheckadd').val("");
                 	
                 	//CKEDITOR.instances['add_message'].setData("");
                 $("#compose-modal").modal("hide");
                //$("#compose-modal").html("");
               
                
                
                //console.log("result",response);
                	
				//x = response;
			
			}
		});
    
  
});


//
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
});

//
// valid for excel
//$(function() {
//    
//		$("#add_file1").change(function() {
//		  
//          var id= $(this).attr("id").match(/\d+/);
//          alert(id);
//          
//			$("#preview").empty(); // To remove the previous error message
//			var file = this.files[0];
//			var excelfile = file.type;
//			var match= ["image/xls"];
//			if(!((excelfile==match[0])))
//			{
//				$("#preview").html("Only Excel allowed");
//				return false;
//			}
//			else
//			{
//				var reader = new FileReader();
//				reader.onload = imageIsLoaded;
//				reader.readAsDataURL(this.files[0]);
//			}
//		});
//	});
//
$(".open").click(function() {
	var data_id = $(this).data('id');
	//alert(data_id);
	///////////Validation//////////////
	//if(data_id == 3){
	//if($("#ni_number").val() == ""){
	//alert("ni_number can not be null");
	// $("#fname").focus();
	//  return false;
	// }
	//}
	///////////Validation//////////////
	var remove_id = data_id - 1;
	$("#tab_" + data_id).addClass("active");
	$("#tab_" + remove_id).removeClass("active");
	$(".tab-pane").fadeOut("fast");
	$("#step" + data_id).fadeIn("slow");
});
$(".open_header").click(function() {
	var data_id = $(this).data('id');
	//alert(data_id);
	$('#board_no').val(data_id);
	///////////Validation//////////////
	if (data_id == 3) {
		if ($("#ni_number").val() == "") {
			alert("ni_number name can not be null");
			$("#ni_number").focus();
			return false;
		}
	}
	///////////Validation//////////////
	$("#header_ul li").parent().find('li').removeClass("active");
	$(this).parent('li').addClass('active');
	$(".tab-pane").fadeOut("fast");
	$("#step" + data_id).fadeIn("slow");
});
$(".back").click(function() {
	var data_id = $(this).data('id');
	var remove_id = Number(data_id) + Number(1);
	$("#tab_" + data_id).addClass("active");
	$("#tab_" + remove_id).removeClass("active");
	$(".tab-pane").fadeOut("fast");
	$("#step" + data_id).fadeIn("slow");
});
//board 1 8 adding
$(".add_new").click(function() {
	//alert('');
	//$("#compose-modal").modal("show");

	//var numItems = $('.limitboard').size();
    //alert(numItems);

	var numItems = $('.limitboard').length;

	if (numItems < 8) {
		$("#compose-modal").modal("show");
	} else {
		alert("Delete existing  post first before adding New");
	}
	//alert(numItems);
});
//board 1 8 adding

//board 2 8 adding
$(".add_new2").click(function() {
	//alert('');
	//$("#compose-modal").modal("show");
	var numItems = $('.limitboard2').length;
    //alert('numItems');
	if (numItems < 8) {
		$("#compose-modal").modal("show");
	} else {
		alert("Delete existing  post first before adding New");
	}
	//alert(numItems);
});
//board 2 8 adding



// sortable
$(function() {
    
	$("#sortable").sortable({
		/*var order = $(this).sortable("serialize");
		console.log(order);*/
        
        stop: function(event, ui) {
           
                //ui.item.unbind("click");
            //console.log(ui);
            //var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );
            //$("#sortable").unbind('click');
            var toSend = [], param = {};
            var sorted = $( "#sortable" ).sortable( "toArray" );
            //alert(sorted);
            for(var i in sorted){
                //console.log(sorted[i]);
                var each = parseInt(sorted[i]);
                if(each){
                    toSend.push(each);
                }
            }
            param = {
                order: toSend.join(",")
            }
            
            console.log(param);
            $.ajax({
                url: '/swap-board1',
                type: 'POST',
                data: param,
                success: function(){
                    

                    //$("#compose-msgmodal").modal("hide");
                    	

                   // $("#compose-msgmodal").modal("hide");
                     //ui.item.find("p").unbind("click");	

                    console.log("updated");
                },
                error: function(data){
                    console.log("ERROR", data);
                }
            });
        }
/* start: function(event, ui) {
            ui.item.startPos = ui.item.index();
        },
        stop: function(event, ui) {
            //console.log("Start position: " + ui.item.startPos);
            //console.log("New position: " + ui.item.index());
            var id = this.id;
            console.log(id);
        }*/
	});
	$("#sortable").sortable({
        helper:'clone',
        //revert:true
        }).disableSelection();

 
});


$(function() {
	$("#sortable2").sortable({
    
        stop: function(event, ui) {
            var toSend = [], param = {};
            var sorted = $( "#sortable2" ).sortable( "toArray" );
            
            for(var i in sorted){
                //console.log(sorted[i]);
                var each = parseInt(sorted[i]);
                if(each){
                    toSend.push(each);
                }
            }
            param = {
                order: toSend.join(",")
            }
             console.log(param);
            $.ajax({
                url: '/swap-board1',
                type: 'POST',
                data: param,
                success: function(){
                     	
                    console.log("updated2");
                },
                error: function(data){
                    
                    console.log("ERROR2", data);
                }
            });
        }
            
            
    	});
        $("#sortable2").sortable({
        helper:'clone',
        //revert:true
        }).disableSelection();
	//$("#sortable2").disableSelection();
});
//save
/*$(".swapboard1").click(function() {
    
    //alert('aaaaa');
    
    $.ajax({
		type: "POST",
		//dataType: "html",
		url: '/swap-board1',
		data: {
			'noticefont_id': noticefont_id
		},
		success: function(resp) {
			     console.log(resp);
		
			
			
		
		          }
	       });
    
    });*/
//

//sortable

// ajax submit board 2 //////

$(document).ready(function(){

    
     $('#showpdfview').hide('');
    
})


$(function() {
/*$('.iradio_minimal').on('click' ,function(){
    console.log('clicked');
    //$(".pdfviwerclass").iCheck('uncheck');
   
    //$(this).iCheck('check');
       //alert('ttt');
        //return false;
});*/
$('input').on('ifClicked', function (event) {
        //$('#showpdfview').show('');
        $(".pdfviwerclass").iCheck('uncheck')
        $(this).iCheck('check')
        var value = $(this).val();
        
        
         var file_type =	$("#pdf").val();
         //alert("file type " + file_type);
                        
        //alert("You clicked " + value);
        
            
       
        
        $.ajax({
		type: "POST",
		//dataType: "html",
		url: '/viewfilenoticeboard',
		data: 
			{ 'file_type':file_type ,'value':value
		},
		success: function(resp) {
		  
		//	console.log(resp);return false;
            if(resp != "")
            {
                $('#showpdfview').attr('src', resp)
                $('#showpdfview').show('');
            }
            else{
                $('#showpdfview').hide('');
               
                
            }
            
            
            //$("#showpdfview").html(resp);
            
            
           
            }
	}); 
        
      
        
        
    });
});

/*$('.pdfviwerclass').on('ifChecked', function(event){
    
    $(".pdfviwerclass").iCheck('uncheck');
       alert('fafafaf');
        return false;
    });


 $('.pdfviwerclass').on('ifUnchecked', function(event){
        alert('unnnn');return false;
    });*/


$("#noticetab li").on('click', function(event) {
	//alert('fsfsf');
	var tabno = $(this).data("tabno");
	$('#board_no').val(tabno);
	$("#noticetab li a").removeClass("tab_active");
	$(this).find("a").addClass("tab_active");
	$(".show_div").removeClass("active");
	$("#step" + tabno).addClass("active");
});
//uploaded fiel
/*$(formname).ajaxSubmit({

                    url: '/excel-upload',

                    type: 'post',

                    beforeSend: function() {

                        // add some function

                    },

                    success: function(resp) {

                        // toastr options

                        if (resp==1) // error happend due to wrong email/password

                        {

                            // if part

                        }

                        else // error happend due to wrong email/password

                        {

                            // else part

                        }

                    },

                    error: function(resp) {

                    }

                });*/
//
/*
$(".open_header").click(function(){
  var data_id = $(this).data('id');
  alert(data_id);
  ///////////Validation//////////////
  if(data_id == 3){
    if($("#ni_number").val() == ""){
      alert("ni_number can not be null");
      $("#ni_number").focus();
      return false;
    }

  }
  ///////////Validation//////////////

  $("#header_ul li").parent().find('li').removeClass("active");
  $(this).parent('li').addClass('active');
  $(".tab-pane").fadeOut("fast");
  $("#step"+data_id).fadeIn("slow");
});


  $(".back").click(function(){
  var data_id = $(this).data('id');
  var remove_id = Number(data_id)+Number(1);
  $("#tab_"+data_id).addClass("active");
  $("#tab_"+remove_id).removeClass("active");
  $(".tab-pane").fadeOut("fast");
  $("#step"+data_id).fadeIn("slow");
});*/
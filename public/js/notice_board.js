function openModal( noticefont_id )
{
    
    //$('#edit-modal').modal('show');
    console.log(noticefont_id);
	$.ajax({
	    type: "POST",
	    //dataType: "html",
                
	    url: '/editnotice-template',
	    data: { 'noticefont_id' : noticefont_id },
	    success : function(resp){
	       
           console.log(resp);
          // console.log("asdfhsdaghfjksdagkf")
            $("#compose-modal1").modal("show");
		//	$('#edit_notice_template_id').val(resp['edit_notice_template_id']);
            setTimeout(function(){
                //alert(resp['file'])
                if(resp['file']!=null){
                    var attachment = resp['file'];
                    var res = attachment.substring(2);
                 }
                
                //alert(res);
                   // document.getElementById("edit_message1").value = resp['message'];
                  //$('#edit_message1').val(resp.message);
                  //$('#edit_message1').val(resp.message);
            $('#typecatagory1').val(resp.typecatagory);
            $('#edit_notice_template_id1').val(resp.noticefont_id);
            $('#message_subject1').val(resp.message_subject);//
            $('#edit_attach_file2').empty().html(res);
	    	$('#hidd_file').empty().val(resp['file']);
            CKEDITOR.instances['edit_message1'].setData(resp['message']);
            
            //var hidden_chk = $('#hidd_chek').val(resp.checkbox);
            
            var ch = resp.checkbox;
            
            var str_array = ch.split(',');
            
            
           var gid= resp.group;
           
           
           var content ='';
           $.each(gid , function(  key, value ) {

                var groupids= value.user_id;
                console.log(groupids);
            
          
            
            }); 
            
           
           
                var str = resp.checkbox;
                
                $( ".chknotifys" ).each( function( index, element ){
                    //alert($(this).val());
                    var box = $(this).val();
                    //alert(box);
                    //alert(resp.checkbox)
                    if(str.indexOf(box) != -1){
                        
                            $("#notifycheck"+box).iCheck('check');
                        }
                      
                });
              
            
	    	$('#edit_attach_file1').empty().html(resp['file']);
            },1000);
            
            
          
            
			//CKEDITOR.instances['edit_message'].setData(resp['message']);

			
                // $("#compose-modal").modal("toggle");
	            //$('#modal').modal();
               
			
			
	    }
	});
}


//$("#edit_attach_file2").mouseover(function(){
 
// return confirm("You want to delete ??");
        //alert('attachdel');

//});


$(".chknotifys").on('ifUnchecked', function(event){
        var num = parseInt($(this).attr('id').match(/\d+/)[0], 10);
       $("#chknotify"+num).val('');
       // alert(num);
    
    });
$(".chknotifys").on('ifChecked', function(event){
        var num = parseInt($(this).attr('id').match(/\d+/)[0], 10);
        $("#chknotify"+num).val(num);
        //alert(num);
    
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

CKEDITOR.replace( 'edit_message1',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
            
            
        }
    });
    
});





 function delfun()
    {
     
     return confirm("You want to delete??");
    
    }

 function delattachfun()
    {
     
     return confirm("You want to delete Attachment??");
    
    }






$(".open").click(function(){
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

  var remove_id = data_id-1;
  $("#tab_"+data_id).addClass("active");
  $("#tab_"+remove_id).removeClass("active");
  $(".tab-pane").fadeOut("fast");
  $("#step"+data_id).fadeIn("slow");
});

$(".open_header").click(function(){
  var data_id = $(this).data('id');
  //alert(data_id);
  
  
  $('#board_no').val(data_id);
  ///////////Validation//////////////
  if(data_id == 3){
    if($("#ni_number").val() == ""){
      alert("ni_number name can not be null");
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
});





$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });

$(function() {
    $( "#sortable2" ).sortable();
    $( "#sortable2" ).disableSelection();
  });




$("#noticetab li").on('click', function(event){
   //alert('fsfsf');
   var tabno = $(this).data("tabno");
   $('#board_no').val(tabno);
   $("#noticetab li a").removeClass("tab_active");
   $(this).find("a").addClass("tab_active");
   
   $(".show_div").removeClass("active");
   $("#step"+tabno).addClass("active");

});
    





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
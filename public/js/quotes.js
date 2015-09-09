$(document).ready(function () {
 

 
//$("#gentab1").hide();
$("#cwtab2").hide();
$("#rltab2").hide();

$("#covertab3").hide();
$("#tabletab4").hide();
$("#eltab5").hide();
$("#tctab6").hide();
 
 
 $('#ncwl').on('ifChecked', function(event){
		  $("#cwtab2").show("");
	});
  $('#ncwl').on('ifUnchecked', function(event){
      $("#cwtab2").hide("");
  });
  $('#rl').on('ifChecked', function(event){
		  $("#rltab2").show("");
	});
  $('#rl').on('ifUnchecked', function(event){
      $("#rltab2").hide("");
  });
 

  
 
  $('#qcl').on('ifChecked', function(event){
		  $("#covertab3").show("");
	});
  $('#qcl').on('ifUnchecked', function(event){
      $("#covertab3").hide("");
  });
 
  $('#qtnqs').on('ifChecked', function(event){
		  $("#tabletab4").show("");
	});
  $('#qtnqs').on('ifUnchecked', function(event){
      $("#tabletab4").hide("");
  });
 
 $('#el').on('ifChecked', function(event){
		  $("#eltab5").show("");
	});
  $('#el').on('ifUnchecked', function(event){
      $("#eltab5").hide("");
  });
  
  $('#tc').on('ifChecked', function(event){
		  $("#tctab6").show("");
	});
  $('#tc').on('ifUnchecked', function(event){
      $("#tctab6").hide("");
  });
  
 
 
  });
  
  $("body").on("click", "#tabletab4", function(){
    
    // $(".ltemised_services").hide("");
    
    $("#firsttable").hide("");
    $("#secondtable").hide("");
    $("#thirdtable").hide("");
    $("#forthtable").hide("");
    
    
   // if ($("#ltemisedservices input[type='radio']:checked").val() == 'Ltemised Services') {
    
  //  alert('fsfsf');
   // }
  
 
  
  });
  
  /* 
   $(".quotetype").change(function(){
    
   var value = $(this).val();
   console.log(value);
   });*/
   
   
   
   $('.quotetype').on('ifChecked', function(event){

      var value = $(this).val();
  if(value == "Ltemised Services"){
    $("#firsttable").show("");
    $("#secondtable").show("");
    $("#thirdtable").show("");
    $("#forthtable").show("");
    
    // $(".ltemised_services").show("");
  }
   console.log(value);
   
   if(value == "Tailored quote"){
    
    $("#firsttable").show("");
    $("#secondtable").show("");
    $("#thirdtable").hide("");
    $("#forthtable").hide("");
    
    
   }

  });
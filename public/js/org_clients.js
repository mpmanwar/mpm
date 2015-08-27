
var calCounter = function(){
    $("#countedit").val($('tr[id^="added_service_tr"]').length);
}

$(document).ready(function(){
 
  $("#bank_short_code").mask("99-99-99");

	$('#ann_ret_check').on('ifChecked', function(event){
		  $("#show_ann_ret").show("slow");
	});
  $('#ann_ret_check').on('ifUnchecked', function(event){
      $("#show_ann_ret").hide("slow");
  });

  $('#yearend_acc_check').on('ifChecked', function(event){
      $("#show_year_end").show("slow");
  });
  $('#yearend_acc_check').on('ifUnchecked', function(event){
      $("#show_year_end").hide("slow");
  });


//Registered for Vat
  $('#reg_for_vat').on('ifChecked', function(event){
      $("#show_reg_for_vat").show("slow");
  });
  $('#reg_for_vat').on('ifUnchecked', function(event){
      $("#show_reg_for_vat").hide("slow");
  });

//Tax
  $('#tax_div').on('ifChecked', function(event){
      $("#show_tax_div").show("slow");
  });
  $('#tax_div').on('ifUnchecked', function(event){
      $("#show_tax_div").hide("slow");
  });

  //Paye Registered
  $('#paye_reg').on('ifChecked', function(event){
      $("#show_paye_reg").show("slow");
  });
  $('#paye_reg').on('ifUnchecked', function(event){
      $("#show_paye_reg").hide("slow");
  });

  //Trading Address show while add organisation client start
  $('.cont_all_addr').on('ifChecked', function(event){//show_trad_office_addr  
      var value = $(this).val();
      $("#show_"+value+"_office_addr").show("slow");
  });
  $('.cont_all_addr').on('ifUnchecked', function(event){
      var value = $(this).val();
      $("#show_"+value+"_office_addr").hide("slow");
  });
  //Trading Address show while add organisation client end

  //Contact Name show while add organisation client start
  $('.cont_name_check').on('ifChecked', function(event){
      var value = $(this).val();
      $("#show_"+value).show("slow");
  });
  $('.cont_name_check').on('ifUnchecked', function(event){
      var value = $(this).val();
      $("#show_"+value).hide("slow");
  });
  //Contact Name show while add organisation client end

  //PAYE registered address show while add organisation client start
  $('.org_tax_payee_address').on('ifChecked', function(event){
      $("#employer_office").val("Customer Operations Employer Office, BP4009, Chillingham House, Benton Park View, Newcastle Upon Tyne");
      $("#employer_postcode").val("NE98 1ZZ");
      $("#employer_telephone").val("03002003200");
  });
  $('.org_tax_payee_address').on('ifUnchecked', function(event){
      $("#employer_office").val("");
      $("#employer_postcode").val("");
      $("#employer_telephone").val("");
  });
  //PAYE registered address show while add organisation client end


//Show organisation tax address type while adding client start
$(".org_tax_reference").change(function(){
  var field_type   = $(this).val();
  $.ajax({
    type: "POST",
    dataType: "json",
    url: '/client/search-tax-address',
    data: { 'field_type' : field_type },
    success : function(resp){
      if (resp.length != 0) {
        var content = '<option value="">-- Select Address --</option>';
        $.each(resp, function(key){
          content+= "<option value='"+resp[key].office_id+"'>"+resp[key].office_name+"</option>";
          //console.log(resp[key].client_name); 
        });
      }else{
        content+= "<option value=''></option>";
      }

      $("#show_other_office").hide();
      $("#tax_address").val("");
      $("#tax_zipcode").val("");
      $("#tax_telephone").val("");

      $("#tax_office_id").html(content);
    }
  });
}); 
//Show organisation tax address type while adding client end




//Delete organisation name while add individual/organisation user start
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
//Delete organisation name while add individual/organisation user end

// Vat Scheme change function start //
$("#vat_scheme_type").change(function(){
  var vat_scheme_type  = $(this).val();
  if(vat_scheme_type == 2){
    $("#ret_frequency").html('<option value="yearly">Yearly</option>');
    $("#vat_stagger").html('<option>Choose One</option><option value="jan">JAN</option><option value="feb">FEB</option><option value="mar">MAR</option><option value="apr">APR</option><option value="may">MAY</option><option value="jun">JUN</option><option value="jul">JUL</option><option value="aug">AUG</option><option value="sept">SEPT</option><option value="oct">OCT</option><option value="nov">NOV</option><option value="dec">DEC</option>');
  }else{
    $("#ret_frequency").html('<option value="quarterly">Quarterly</option><option value="monthly">Monthly</option><option value="yearly">Yearly</option>');
    $("#vat_stagger").html('<option>Choose One</option><option value="Jan-April-Jul-Oct">Jan-April-Jul-Oct</option><option value="Feb-May-Aug-Nov">Feb-May-Aug-Nov</option><option value="Mar-Jun-Sept-Dec">Mar-Jun-Sept-Dec</option>');
  }
});
//Vat Scheme change function start end //

//Add Vat Scheme while add individual/organisation user start
$("#add_vat_scheme").click(function(){
    var vat_scheme_name  = $("#vat_scheme_name").val();

    $.ajax({
      type: "POST",
      url: '/client/add-vat-scheme',
      data: { 'vat_scheme_name' : vat_scheme_name },
      success : function(field_id){//alert(client_type);return false;
        var append = '<div class="form-group" id="hide_vat_div_'+field_id+'"><a href="javascript:void(0)" title="Delete Field ?" class="delete_vat_scheme" data-field_id="'+field_id+'"><img src="/img/cross.png" width="12"></a><label for="'+field_id+'">'+vat_scheme_name+'</label></div>';
        $("#append_vat_scheme").append(append);

        $("#vat_scheme_name").val("");
        $("#vat_scheme_type").append('<option value="'+field_id+'">'+vat_scheme_name+'</option>');
		$("#vat_scheme_types").append('<option value="'+field_id+'">'+vat_scheme_name+'</option>');

      }
    });
});
//Add Vat Scheme while add individual/organisation user end

//Delete organisation name while add individual/organisation user start
$("#append_vat_scheme").on("click", ".delete_vat_scheme", function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-vat-scheme',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          $("#hide_vat_div_"+field_id).hide();
          $("#vat_scheme_type option[value='"+field_id+"']").remove();
        }else{
          alert("There are some error to delete this scheme, Please try again");
        }
      }
    });
  }
  
}); 
//Delete organisation name while add individual/organisation user end

$('.row').on('click' , '.delete_client_service' , function(event){
    //alert('alert');    
//$(".delete_client_service").click(function(){
    var id = $(this).attr('id');
    var str = new Array();
        str = id.split('*');
        delete_id = str[0];
        client_id = str[1];
        
        
        //alert(delete_id);
    if (confirm("Do you want to delete this section ?")) {
    //alert(delete_id);
         var count = $("#countedit").val();
         count--;
         $("#countedit").val(count);
         
    $.ajax({
      type: "POST",
      dataType: "html",
      url: '/organisation/delete-editservices',
      data: { 'delete_id' : delete_id,'client_id' : client_id },
      success : function(resp){
          //alert(resp);
         //console.log(resp);
         
         
         var arr = new Array();
         arr = resp.split('~');
         $("#myServTable").replaceWith(resp);
          //$("#countedit").val('');
         //$("#countedit").val(arr[1]);
         
        // console.log();
         calCounter();
        //location.reload(); 
      }
        
    
     });
    
    }
    
    
});




//Delete services name while add individual/organisation user start
$(".frequency_change").change(function(){
    var value = $(this).val();
    var option = "<option>Choose One</option>";
    if(value == "quarterly"){
      option+='<option value="Jan-April-Jul-Oct">Jan-April-Jul-Oct</option><option value="Feb-May-Aug-Nov">Feb-May-Aug-Nov</option><option value="Mar-Jun-Sept-Dec">Mar-Jun-Sept-Dec</option>';
    }
    if(value == "monthly"){
      option+='<option value="monthly">Monthly</option>';
    }
    if(value == "yearly"){
      option+='<option value="jan">JAN</option><option value="feb">FEB</option><option value="mar">MAR</option><option value="apr">APR</option><option value="may">MAY</option><option value="jun">JUN</option><option value="jul">JUL</option><option value="aug">AUG</option><option value="sept">SEPT</option><option value="oct">OCT</option><option value="nov">NOV</option><option value="dec">DEC</option>';
    }
    $("#vat_stagger").html(option);
     
}); 


//Delete services name while add individual/organisation user end

// Delete Allocate Serveces while adding organisation client start //
$(".row").on("click", ".delete_service", function(){
  var delete_index       = $(this).data("delete_index");
//alert('gjgkg');
  if(service_array.length > 0){
    for (var j = 0; j < service_array.length; j++) { 
        var element     = service_array[j];
        var rand_value  = element.split("mpm");
        if(rand_value[2] == delete_index){
          service_array.splice(j, 1);
          break;
        }
    }
  }
  
  $('#serv_hidd_array').val(service_array);
  $("#added_service_tr"+delete_index).hide();
  
});
// Delete Allocate Serveces while adding organisation client end //

// Delete Allocate Serveces while adding/editing organisation client start //
$(".delete_database_service").click(function(){
  var client_service_id  = $(this).data("client_service_id");
//alert('gjgkg');
  $.ajax({
      type: "POST",
      url: '/client/delete-client-service',
      data: { 'client_service_id':client_service_id },
      success : function(resp){
        if(resp > 0){
          $("#deleted_service_tr"+client_service_id).hide();
        }else{
          alert("Services has not deleted, Please try again")
        }
        
      }
    });
  
});
// Delete Allocate Serveces while adding/editing organisation client end //


$('.rel_acting').on('ifChecked', function(event){
  event.preventDefault();
  var edit_index  = $(this).data("edit_index");
  var client_id   = $(this).data("officer_id");
  var action = '<button class="btn btn-success rel_acting_save" data-edit_index="'+edit_index+'" data-client_id="'+client_id+'" type="button">Save</button>';
  $("#database_tr"+edit_index+" td:nth-child(5)").html(action);

  $("#rel_acting_"+client_id).iCheck('check');//rel_acting_94
});

$('.rel_acting').on('ifUnchecked', function(event){
  event.preventDefault();
  var edit_index  = $(this).data("edit_index");
  var client_id   = $(this).data("officer_id");
  //var action  = '<a href="javascript:void(0)" class="edit_database_rel" data-edit_index="'+edit_index+'" data-officer_id="'+client_id+'"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete_database_rel" data-delete_index="'+edit_index+'"><i class="fa fa-trash-o fa-fw"></i></a>';
  var action = '<button class="btn btn-success rel_acting_save" data-edit_index="'+edit_index+'" data-client_id="'+client_id+'" type="button">Save</button>';
  $("#database_tr"+edit_index+" td:nth-child(5)").html(action);

  $("#rel_acting_"+client_id).iCheck('uncheck');
});

// Save Acting while edit client start //
$("#myRelTable").on("click", ".rel_acting_save", function(){
    var edit_index  = $(this).data("edit_index");
    var client_id   = $(this).data("client_id");
    var rel_type    = $("#database_tr"+edit_index+" td:nth-child(3)").html();

    var client_type = "chd";
    var acting = "N";
    if($('#rel_acting_'+client_id).prop("checked") == true){
      client_type = "change";
      var acting = "Y";
    }
  //alert(client_id+", "+client_type);return false;
    $.ajax({
      type: "POST",
      url: '/client/save-acting-relationship',
      data: { 'acting':acting, 'client_type':client_type, 'client_id':client_id, 'edit_id':edit_index, 'rel_type':rel_type },
      success : function(resp){//alert(client_type);return false;
        var action  = '<a href="javascript:void(0)" class="edit_database_rel" data-edit_index="'+edit_index+'" data-officer_id="'+client_id+'"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete_database_rel" data-delete_index="'+edit_index+'"><i class="fa fa-trash-o fa-fw"></i></a>';
        $("#database_tr"+edit_index+" td:nth-child(5)").html(action);
      }
    });
});
// Save Acting while edit client end //

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

	
  

    
    
    
    //after add edit
    
 $("#myServTable").on("click", ".serviceclass", function(){
    var id = $(this).attr('id');
    var option = $("#"+id+" option:selected").val();
    var num = id.match(/[\d\.]+/g);
    $("#servicetxt_id"+num).val(option);
    //alert(num);
    })
 $("#myServTable").on("click", ".staffclass", function(){
    var id = $(this).attr('id');
    var option = $("#"+id+" option:selected").val();
    var num = id.match(/[\d\.]+/g);
    $("#stafftxt_id"+num).val(option);
    //alert(num);
    })
 $(".row").on("click", ".edit_service", function(){
  
  var id = $(this).attr('id');
  //alert(id);
  //alert($(this).attr('id'));
  
  //$("#added_service_tr'+service+'").hide('slow');
  var servicetxt_id = $("#servicetxt_id"+id).val();
  var stafftxt_id = $("#stafftxt_id"+id).val();
  //alert(servicetxt_id);
  //alert(stafftxt_id);
  
  //$('#service_id').contents().unwrap();
  
  //$("#added_service_tr'+id+'").html();
  
  
  $.ajax({
      type: "POST",
      dataType: "html",
      url: '/organisation/editserv-services',
      data: { 'servicetxt_id' : servicetxt_id, 'stafftxt_id' : stafftxt_id, 'id' : id },
      success : function(resp){
                //alert("#added_service_tr"+id);
                var arr = new Array();
                
                arr  = resp.split("*");
                //alert($("#serviceselect_id"+id).val());
                $("#added_service_tr"+id).find("td:eq(0)").html(arr[0]);
                $("#added_service_tr"+id).find("td:eq(1)").html(arr[1]);
                $("#added_service_tr"+id).find("td:eq(2)").html('<button class="btn btn-success saveclass" id="'+id+'" type="button" >save</button><input type="hidden" value="'+servicetxt_id+'" id="servicetxt_id'+id+'" name="stafftxt_id[]"><input type="hidden" value="'+stafftxt_id+'" id="stafftxt_id'+id+'" name="servicetxt_id[]">');
                
                //console.log(resp);
        }
        
      }); 
  
  
 // alert('resp');
  
  //var edit_index    = $(this).data("edit_index");
  //var service     = $("#service_tr"+edit_index+" td:nth-child(1)").html();
  //var staff     = $("#service_tr"+edit_index+" td:nth-child(2)").html();
  /* var second_staff = '<input type="text" id="edit_staff" value="'+staff+'" name="edit_staff" class="form-control staff edit_staff">';
  $('#save' + id).html('<input type="text" id="edit_staff" value="'+staff+'" name="edit_staff" class="form-control staff edit_staff">');  
  //alert(second_staff);
  }); */
  
  });
  
   $(".row").on("click", ".saveclass", function(){
        var id = $(this).attr('id');
      //alert();
        
        //alert(added_service_tr1);
        
        var service = $("#serviceselect_id"+id+" option:selected" ).text()
        
        $("#serviceselect_id"+id).remove();
        $("#added_service_tr"+id).find("td:eq(0)").html(service);
        
        var staff = $("#staffselect_id"+id+" option:selected" ).text()
        
        $("#staffselect_id"+id).remove();
        $("#added_service_tr"+id).find("td:eq(1)").html(staff);
        
        $("#added_service_tr"+id).find("td:eq(2)").html('<a href="javascript:void(0)" class="edit_service" data-edit_index="'+id+'" id="'+id+'"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete_service" data-delete_index="'+id+'"><i class="fa fa-trash-o fa-fw"></i><input type="hidden" value="'+$("#stafftxt_id"+id).val()+'" id="stafftxt_id'+id+'" name="stafftxt_id[]"><input type="hidden" value="'+$("#servicetxt_id"+id).val()+'" id="servicetxt_id'+id+'" name="servicetxt_id[]">');
        //alert(id);
        //$("#serviceselect_id"+id).prop("selectedIndex", );
         // $("#serviceselect_id"+id+" option[value='"+$("#servicetxt_id"+id).val()+"']").attr('selected','selected');
        
    });
     

// SYNC DATA upload from organisation client edit page start //
$("#sync_data_button").click(function(){
    var number = $("#registration_number").val();
    var encode_page_name = $("#encode_page_name").val();
    if(number == ""){
      alert("Please enter the company registration number");
      return false;
    }

    $.ajax({
        type: "POST",
        url: "/import-company-details/"+number+"=ajax",
        //data: { 'number': number },
        beforeSend: function() {
            $(".message_div").html('<img src="/img/spinner.gif" />');
        },
        success: function (client_id) {//return false;
            if(client_id > 0){
                $(".message_div").html("<span style='color:#3c8dbc;font-size:16px'>Company details successfully updated</span>");
                window.location.href='/client/edit-org-client/'+client_id+"/"+encode_page_name;
                    
            }else{
                $(".message_div").html("<span style='color:red;font-size:16px'>There are some error to importing data</span>");
            }
        }
    });
});
// SYNC DATA upload from organisation client edit page end //


//$("#notes_innermsg_top").hide();

$("#demo").hide();
//$("#notes_innermsg_top").css("display", "none");

$("#addnotes_button").click(function(){
    $("#notes_error").html('');
$("#notestitle").val("");
$("#notesmsg").val("");

$(".notes_innermsg_top").css("display", "block");

//alert('fsfsfsf');
$("#notes_font").hide();
$("#demo").show();
});

$("#cancle_notes").click(function(){
$(".notes_innermsg_top").css("display", "none");
$("#demo").hide();
$("#notes_font").show();
});





$("#savenotes").click(function(){
    
   if( $("#notestitle").val()==""){
     $("#notes_error").html('Please enter  Notes Title');
        return false;
   }
    else{
               
        $("#notes_error").html('');
        
        
        var notestitle= $("#notestitle").val();
    var notesmsg= $("#notesmsg").val();
    var client_id= $("#client_id").val();
        
       // console.log(notestitle);
        //console.log(notesmsg);
       // console.log(client_id);
       
       // var len = notestitle.length
        //  alert(len);
          
         
           //var toRemove = notestitle;
            //var gorge = toRemove.replace(toRemove,'');
            
            if(notestitle.length>"32"){
                 var title = notestitle.substr(0,32);
                  var finaltitle=title+'...' 
            }
            else{
                finaltitle=notestitle;
            }
            
            //alert(finaltitle);return false;
          //  var title = notestitle.substr(0,20);
            
           // alert(gorge);return false;
          
          
          //ar stripped = strip_tags($('#text').html()
          
          
          
          
         // return false;
        
        $.ajax({
		type: "POST",
		//dataType: "html",
		url: '/org-notes',
		data: 
			{ 'notestitle':notestitle, 'notesmsg' : notesmsg, 'client_id' : client_id 
		},
		success: function(resp) {
			console.log(resp);
          // var title=
            $("#notes_font").css("display", "block");
            $(".notes_innermsg_top").css("display", "none");
            
            var r = resp.split('|||');
            
            
            
            
            $("#notes_font").html(r[1]);
           // var len = notestitle.length
           // alert(len);
            
            $("#newaddnotes").prepend('<li id="listtitle'+r[0]+'"><a data-id="'+r[0]+'" class="title_view" href="javascript:void(0)">'+finaltitle+'</a></li>');
            
            
            }
	});
    
    
    
    
    
    
    
    
    }


  });
  
   $("body").on("click", "#editsave_notes", function(){

    
    //alert('adadadadada');return false;
    
   
    var editnotesval= $("#editnotestitle").val();
    var editnotesmsg= $("#editnotesmsg").val();
   var edited_id= $("#editorgnotes_id").val();
    var client_id= $("#editclient_id").val();
    
    /*console.log(editnotesval);
    console.log(editnotesmsg);
    console.log(edited_id);
    console.log(client_id);*/
    console.log(edited_id);
    
    
    
    
    //var edittitle = editnotesval.substr(0,20);
    
    if(editnotesval.length>"32"){
        
                 var edit_title = editnotesval.substr(0,32);
                  var finaledittitle=edit_title+'...' 
           
            //alert(finaledittitle);
            }
            
            else{
                finaledittitle=editnotesval;
                //alert(finaledittitle);
            }
            
    
    
    
    
    
    
    $.ajax({
		type: "POST",
		//dataType: "html",
		url: '/editorg-notes',
		data: 
			{ 'editnotesval':editnotesval, 'editnotesmsg' : editnotesmsg,'edited_id':edited_id, 'client_id' : client_id 
		},
		success: function(resp) {
			console.log(resp);
            
            $("#notes_font").html(resp);
           
           $("#listtitle"+edited_id).html('<a data-id='+edited_id+' class="title_view" href="javascript:void(0)">'+finaledittitle+'</a>');
           
            
            }
	});
    
    
    
    
    
    
    
    
    
   
    });
    
      $("body").on("click", "#delete_notes", function(){
        var deleted_id="";
        var edited_id= $("#editorgnotes_id").val();
         var client_id= $("#editclient_id").val();
        var notesmsgid= $("#msgid").val();
       if(notesmsgid){
        deleted_id=notesmsgid;
       }else{
        deleted_id=edited_id;
       }
       deleted_id = $.trim(deleted_id);
        //var edited_id= $("#editorgnotes_id").val();
         //var client_id= $("#editclient_id").val();
        
        console.log(deleted_id);
        console.log(edited_id);
        console.log(client_id);
        //console.log($("#listtitle"+deleted_id));return false;
        $("#listtitle"+deleted_id).remove();
        //var notesmsgid =$(this).attr('data-id');
        // if (confirm("Do you want to delete this field ?")) {
    $.ajax({
		type: "POST",
		//dataType: "html",
		url: '/deleteorg-notes',
		data: 
			{ 'edited_id':deleted_id,'client_id':client_id
		},
		success: function(resp) {
			//console.log(resp);
            console.log(deleted_id);
            $("#notes_font").html(resp);
            $("#listtitle"+deleted_id).remove();
            }
	});                        
        
       // }
        
                                                        
  
    });
  
});//end of main document ready

$("body").on("click", ".title_view", function(){

var notesmsgid =$(this).attr('data-id');
//alert(notesmsgid);
console.log(notesmsgid);
$.ajax({
		type: "POST",
		//dataType: "html",
		url: '/view-orgnotes',
		data: {
			'notesmsgid': notesmsgid
		},
		success: function(resp) {
			console.log(resp);
            $("#notes_font").html(resp);
            
            }
	});


});

$("body").on("click", "#editnotes", function(){

var notesmsgid= $("#msgid").val();
//alert(notesmsgid);return false;

//var notesmsgid =$(this).attr('data-id');
//alert(notesmsgid);
console.log(notesmsgid);
$.ajax({
		type: "POST",
		//dataType: "html",
		url: '/editmodeorg-notes',
		data: {
			'notesmsgid': notesmsgid
		},
		success: function(resp) {
			console.log(resp);
           $("#notes_font").html(resp);
            
            }
	});


});



function new_save(){
    alert('dffgaga');
    var id = $(this).attr('id');
    alert(id);
    
    $("#added_service_tr"+id).hide('slow');
}



function show_org_other_div()
{
  $("#service_id").val('');
  $("#staff_id").val('');
  $("#add_services_div").show('slow');
}

var service_array = [];
var service = 0;

function saveServices()
{
    var service_id  = $('#service_id').val();
    var staff_id    = $('#staff_id').val();

      $.ajax({
      type: "POST",
      dataType: "json",
      url: '/organisation/save-services',
      data: { 'service_id' : service_id, 'staff_id' : staff_id },
      success : function(resp){
        var content = "";
        content += '<tr id="added_service_tr'+service+'"><td align="center">'+resp['service']+'</td>';
        content += '<td width="30%" align="center">'+resp['staff']+'</td>';
        //content += '<td width="15%" align="center"><a href="javascript:void(0)" class="edit_service" data-edit_index="'+service+'" id="'+service+'"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete_service" data-delete_index="'+service+'"><i class="fa fa-trash-o fa-fw"></i><input type="hidden" value="'+staff_id+'" id="stafftxt_id'+service+'"><input type="hidden" value="'+service_id+'" id="servicetxt_id'+service+'"></a></td>';
        content += '<td width="15%" align="center"><a href="javascript:void(0)" class="delete_service" data-delete_index="'+service+'"><img src="/img/cross.png" height="15"></a></td>'
        content += '</tr>';
        $("#myServTable").last().append(content);

        var itemselected = service_id+"mpm"+staff_id+"mpm"+service;
        if(itemselected !== undefined && itemselected !== null){
            service_array.push(itemselected);
        }

        $('#serv_hidd_array').val(service_array);
        $("#add_services_div").hide('slow');
        
        service++;
      }
      
    });
        
    
    
}

//edit when edit

var editservice_array = [];
var editservice;

var countedit = $('#countedit').val();


if(countedit!=0){
    
    editservice = countedit;
    
}else{
    
    editservice = 0;
}
function editServices()
{
    //alert(countedit);
    var service_id  = $('#service_id').val();
    var staff_id    = $('#staff_id').val();

      $.ajax({
      type: "POST",
      dataType: "json",
      url: '/organisation/save-services',
      data: { 'service_id' : service_id, 'staff_id' : staff_id },
      success : function(resp){
        countedit++;
        var content = '<tr id="added_service_tr'+editservice+'"><td align="center">'+resp['service']+'</td><td width="30%" align="center">'+resp['staff']+'</td><td width="15%" align="center"><a href="javascript:void(0)" class="edit_service" data-edit_index="'+editservice+'" id="'+editservice+'"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete_service" data-delete_index="'+editservice+'"><i class="fa fa-trash-o fa-fw"></i><input type="hidden" value="'+staff_id+'" id="stafftxt_id'+editservice+'" name="stafftxt_id[]"><input type="hidden" value="'+service_id+'" id="servicetxt_id'+editservice+'" name="servicetxt_id[]"></a></td></tr>';
        $("#myServTable").last().append(content);

        var itemselected = service_id+"mpm"+staff_id+"mpm"+editservice;
        if(itemselected !== undefined && itemselected !== null){
            service_array.push(itemselected);
        }

        //$('#serv_hidd_array').val(service_array);
        $("#add_services_div").hide('slow');
        $('#countedit').val(countedit);
        //calCounter();
        editservice++;
      }
      
    });
    
    
    
    
    
    
    
        
    
    
}






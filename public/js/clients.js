$(document).ready(function(){

	$('#allCheckSelect').on('ifChecked', function(event){
		/*$('#example2 input[type=checkbox]').attr('checked', 'checked');
		$('.all_check div').addClass('checked');*/
		$('input').iCheck('check');
	});

	$('#allCheckSelect').on('ifUnchecked', function(event){
		/*$('.all_check div').removeClass('checked');
		$("input[name='client_delete_id[]']").removeAttr('checked');*/
		$('input').iCheck('uncheck');
	});

	/*$("input[name='client_delete_id[]']").on('ifUnchecked', function(event){
		//$(this).removeAttr('checked');
		$(this).iCheck('uncheck');
	});*/


	$('#deleteClients').click(function() {
		var val = [];
    $(".ads_Checkbox:checked").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}
    });
    //alert(val.length);return false;
		if(val.length>0){
      var client_type = $("#client_type").val();
			if(confirm("Do you want to delete?")){
				$.ajax({
				    type: "POST",
				    url: '/delete-individual-clients',
				    data: { 'client_delete_id' : val },
				    success : function(resp){
				    	//window.location = 'http://mpm.com/user-list';
              if(client_type == "org"){
                window.location = '/organisation-clients';
              }else{
                window.location = '/individual-clients';
              }
				    	
				    }
				});
			}

 		}else{
 			alert('Please select atleast one clients');
 		}
 	});

 	$('#show_search').click(function() {
		//$('#table_top_box').toggle();
    $('#example2_filter').toggle();
 	});

 	$('#search_client_text').keyup(function() {
    var search_value = $(this).val();
		$.ajax({
      type: "POST",
      dataType: "json",
      url: '/individual/search-individual-client',
      data: { 'search_value' : search_value, 'client_type' : "ind" },
      success : function(resp){
        if (resp.length != 0) {
          var content = '';
          $.each(resp, function(key){
            content+= "<tr class='all_check odd'><td align='center'><input type='checkbox' class='ads_Checkbox' name='client_delete_id[]' value='1' id='client_delete_id'/><td>"+resp[key].staff_name+"</td><td>"+resp[key].dob+"</td><td><a href='#'>"+resp[key].name+"</a></td><td>"+resp[key].business_name+"</td><td>"+resp[key].ni_number+"</td><td>"+resp[key].tax_reference+"</td><td>"+resp[key].acting+"</td><td>"+resp[key].res_address+", "+resp[key].res_city+", "+resp[key].res_zipcode+"</td></tr>";
            //console.log(resp[key].client_name); 
          });

          $("#example2 tbody").html(content);
          //$("#show_search_client").show();
        }
        
      }
    });
 	});





// Add individual client
$(".open").click(function(){
  var data_id = $(this).data('id');

///////////Validation//////////////
if(data_id == 2){
  if($("#client_code").val() == ""){
    alert("Client code can not be null");
    $("#client_code").focus();
    return false;
  }else if($("#fname").val() == ""){
    alert("First name can not be null");
    $("#fname").focus();
    return false;
  }else if($("#lname").val() == ""){
    alert("Last name can not be null");
    $("#lname").focus();
    return false;
  }else if($("#business_name").val() == ""){
    alert("Business name can not be null");
    $("#business_name").focus();
    return false;
  }

}
///////////Validation//////////////

  var remove_id = data_id-1;
  $("#tab_"+data_id).addClass("active");
  $("#tab_"+remove_id).removeClass("active");
  $(".tab-pane").fadeOut("fast");
  $("#step"+data_id).fadeIn("slow");
});

$(".open_header").click(function(){
  var data_id = $(this).data('id');
  ///////////Validation//////////////
  if(data_id == 2){
    if($("#client_code").val() == ""){
      alert("Client code can not be null");
      $("#client_code").focus();
      return false;
    }else if($("#fname").val() == ""){
      alert("First name can not be null");
      $("#fname").focus();
      return false;
    }else if($("#lname").val() == ""){
      alert("Last name can not be null");
      $("#lname").focus();
      return false;
    }else if($("#business_name").val() == ""){
      alert("Business name can not be null");
      $("#business_name").focus();
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

 
    
  $("#tax_office_id").change(function(){
    var office_id   = $(this).val();
    var tax_type   = $('#tax_reference_type').val();
    if(office_id == "4"){
      $('#tax_address').val("");
      $('#tax_zipcode').val("");
      $('#tax_telephone').val("");

      $('#show_other_office').fadeIn();
    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/individual/get-office-address',
        data: { 'office_id' : office_id },
        success : function(resp){
          $('#show_other_office').fadeOut();

          $('#tax_address').val(resp['address']);
          $('#tax_zipcode').val(resp['zipcode']);
          $('#tax_telephone').val(resp['telephone']);
        }
      });

    }
  });

  $("#other_office_id").change(function(){
    var office_id   = $(this).val();
    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: '/individual/get-office-address',
      data: { 'office_id' : office_id },
      success : function(resp){
        $('#tax_address').val(resp['address']);
        $('#tax_zipcode').val(resp['zipcode']);
        $('#tax_telephone').val(resp['telephone']);
      }
    });

    
  });

  $(".org_relclient_search").keyup(function(){
    var search_value  = $(this).val();
    var client_type   = $("#search_client_type").val();
    //alert(search_value+", "+client_type);
    if(search_value == ""){
      $("#show_search_client").hide();
    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/search/search-client',
        data: { 'search_value' : search_value, 'client_type' : client_type },
        success : function(resp){
          if (resp.length != 0) {
            var content = '<ul>';
            $.each(resp, function(key){
              content+= "<li class='putClientName' data-client_name='"+resp[key].client_name+"' data-client_id='"+resp[key].client_id+"'>"+resp[key].client_name+"</li>";
              //console.log(resp[key].client_name); 
            });

            content+= '</ul>';

            $("#show_search_client").html(content);
            $("#show_search_client").show();
          }
          
        }
      });

    }
  });

  $(".all_relclient_search").keyup(function(){
    var search_value  = $(this).val();
    var client_type   = $("#search_client_type").val();
    //alert(search_value+", "+client_type);
    if(search_value == ""){
      $("#show_search_client").hide();
    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/search/search-all-client',
        data: { 'search_value' : search_value, 'client_type' : client_type },
        success : function(resp){
          if (resp.length != 0) {
            var content = '<ul>';
            $.each(resp, function(key){
              content+= "<li class='putClientName' data-client_name='"+resp[key].client_name+"' data-client_id='"+resp[key].client_id+"'>"+resp[key].client_name+"</li>";
              //console.log(resp[key].client_name); 
            });

            content+= '</ul>';

            $("#show_search_client").html(content);
            $("#show_search_client").show();
          }
          
        }
      });

    }
  });


  //Relationship client search result
  $("#show_search_client").on("click",".putClientName", function(){
      var client_id  = $(this).data('client_id');
      var client_name  = $(this).data('client_name');
      if(client_name != ""){
        $("#relname").val(client_name);
        $("#rel_client_id").val(client_id);
        $("#show_search_client").hide();
      }
  });



//Individual table edited
  $("#edit_but").click(function(){
    $("#edit_but").hide();
    $("#save_but").show();

    $("#dob_select").show();
    $("#dob_text").hide();

    $("#business_name_select").show();
    $("#business_name_text").hide();

    $("#ni_number_select").show();
    $("#ni_number_text").hide();

    $("#tax_reference_select").show();
    $("#tax_reference_text").hide();

    $("#acting_select").show();
    $("#acting_text").hide();

    $("#res_address_select").show();
    $("#res_address_text").hide();

  });

//Individual table Save
  $("#save_but").click(function(){

    var four_col    = $("#four").val();
    var four        = four_col.split('-');
    var six_col     = $("#six").val();
    var six         = six_col.split('-');
    var seven_col   = $("#seven").val();
    var seven       = seven_col.split('-');
    var eight_col   = $("#eight").val();
    var eight       = eight_col.split('-');
    var nine_col    = $("#nine").val();
    var nine        = nine_col.split('-');
    var ten_col     = $("#ten").val();
    var ten         = ten_col.split('-');

    $.ajax({
      type: "POST",
      dataType: "json",
      url: '/individual/show-new-tables',
      data: { 'four' : four[0], 'six' : six[0], 'seven' : seven[0], 'eight' : eight[0], 'nine' : nine[0], 'ten' : ten[0] },
      success : function(resp){

        var content = '';
        var i = 1;
        $.each(resp, function(key){//alert(resp[key][four[0]])
          if(resp[key][four[0]].length != 0 || resp[key][four[0]] == "undefined"){
            resp[key][four[0]] = "";
          }
          if(resp[key][six[0]].length != 0 || resp[key][six[0]] == "undefined"){
            resp[key][six[0]] = "";
          }
          if(resp[key][seven[0]].length != 0 || resp[key][seven[0]] == "undefined"){
            resp[key][seven[0]] = "";
          }
          if(resp[key][eight[0]].length != 0 || resp[key][eight[0]] == "undefined"){
            resp[key][eight[0]] = "";
          }
          if(resp[key][nine[0]].length != 0 || resp[key][nine[0]] == "undefined"){
            resp[key][nine[0]] = "";
          }
          if(resp[key][ten[0]].length != 0 || resp[key][ten[0]] == "undefined"){
            resp[key][ten[0]] = "";
          }
          content += '<tr class="all_check"><td align="center"><input type="checkbox" class="ads_Checkbox" name="client_delete_id[]" value="1" id="client_delete_id"/></td><td>'+i+'</td><td>'+resp[key].staff_name+'</td><td>'+resp[key][four[0]]+'</td><td><a href="#">'+resp[key].name+'</a></td><td>'+resp[key][six[0]]+'</td><td>'+resp[key][seven[0]]+'</td><td>'+resp[key][eight[0]]+'</td><td>'+resp[key][nine[0]]+'</td><td>'+resp[key][ten[0]]+'</td></tr>';
          //console.log(resp[key].client_name); 
          i++;
        });

        $("#example2 tbody").html(content);

        $("#edit_but").show();
        $("#save_but").hide();

        $("#dob_select").hide();
        $("#dob_text").show();
        $("#dob_text").html(four[1]);

        $("#business_name_select").hide();
        $("#business_name_text").show();
        $("#business_name_text").html(six[1]);

        $("#ni_number_select").hide();
        $("#ni_number_text").show();
        $("#ni_number_text").html(seven[1]);

        $("#tax_reference_select").hide();
        $("#tax_reference_text").show();
        $("#tax_reference_text").html(eight[1]);

        $("#acting_select").hide();
        $("#acting_text").show();
        $("#acting_text").html(nine[1]);

        $("#res_address_select").hide();
        $("#res_address_text").show();
        $("#res_address_text").html(ten[1]);
      }
    });

  });


//Show Archived in add individual client
  $("#archive_div").click(function(){
    if($(this).html() == 'Show Archived'){
      $(this).html('Hide Archived');
    }else{
      $(this).html('Show Archived')
    }
    $("#archivedButton").toggle();
  });
  


//Get Service country code
$(".service_country").change(function(){
    var country_id   = $(this).val();
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/individual/get-country-code',
      data: { 'country_id' : country_id },
      success : function(resp){
        $('#serv_tele_code').val(resp);
        $('#serv_mobile_code').val(resp);
      }
    });
});

//Get same address as residential address start
$('#res_service_same').on('ifChecked', function(event){
  $(this).iCheck('check');
  $("#serv_addr_line1").val($("#res_addr_line1").val()); 
  $("#serv_addr_line2").val($("#res_addr_line2").val());
  $("#serv_city").val($("#res_city").val());
  $("#serv_county").val($("#res_county").val());
  $("#serv_postcode").val($("#res_postcode").val());
});

$('#res_service_same').on('ifUnchecked', function(event){
  $("#serv_addr_line1").val(""); 
  $("#serv_addr_line2").val("");
  $("#serv_city").val("");
  $("#serv_county").val("");
  $("#serv_postcode").val("");
  $(this).iCheck('uncheck');
});
//Get same address as residential address start

//Get office address in add individual client Contact information portion start
$(".office_address").change(function(){
  var data_name = $(this).data('name');
  var office_id   = $(this).val();
  if(office_id == "4"){
    $('#'+data_name+'_address').val("");
    $('#'+data_name+'_zipcode').val("");
    
    $('#show_other_'+data_name+'office').fadeIn();

    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/individual/get-office-address',
        data: { 'office_id' : office_id },
        success : function(resp){
          if(office_id <= 4){
            $('#show_other_'+data_name+'office').fadeOut();
          }

          $('#'+data_name+'_address').val(resp['address']);
          /*$('#res_city').val(resp['city']);
          $('#res_region').val(resp['region']);*/
          $('#'+data_name+'_zipcode').val(resp['zipcode']);
        }
      });

    }
}); 
//Get office address in add individual client Contact information portion end

//Delete user added field while add individual/organisation user start
$(".delete_user_field").click(function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/individual/delete-user-field',
      data: { 'field_id' : field_id },
      success : function(resp){
        if(resp != ""){
          location.reload();
        }
      }
    });
  }
  
}); 
//Delete user added field while add individual/organisation user end

//Delete Section individual/organisation user start
$(".delete_section").click(function(){
  var step_id = $(this).data('step_id');
  if (confirm("Do you want to delete this section ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-section',
      data: { 'step_id' : step_id },
      success : function(resp){
        if(resp != ""){
          location.reload();
        }
      }
    });
  }
  
}); 
//Delete Section individual/organisation user end


//Show select option while adding client start
$(".user_field_type").change(function(){
  var field_type   = $(this).val();
  if(field_type == "4"){
    $('#show_select_option').show();
  }else{
    $('#show_select_option').hide();
  }
}); 
//Show select option while adding client end

//Add sub section name while add individual/organisation user start
$("#subsec_name").focusin(function(){
  $(".search_value").show(); 
}); 
/*$("#subsec_name").focusout(function(){
  $(".search_value").hide(); 
});*/
//Add sub section name while add individual/organisation user end

//Add new header section name while add individual/organisation user start
$(".add_subsec_name").on("click", function(){
  var parent_id   = $("#step_id").val();
  var subsec_name = $("#subsec_name").val();
  var client_type = $(this).data('client_type');

  if(subsec_name == ""){
    alert("Please enter sub section name");
    $("#subsec_name").focus();
    return false;
  }
    $.ajax({
      type: "POST",
        dataType: "json",
        url: '/client/insert-section',
        data: { 'subsec_name' : subsec_name, 'parent_id' : parent_id, 'client_type' : client_type },
        success : function(resp){
          if (resp.length != 0) {
            var content = "<option value=''>-- Select sub section --</option>";
            $.each(resp, function(key){
              content+= "<option value='"+resp[key].step_id+"'>"+resp[key].title+"</option>";
            });
            content+= '<option value="new">Add new ...</option>';

            $("#substep_id").html(content);
            $(".show_new_div").hide();
            $("#subsec_name").val("");

          }
        }
    });
});
//Add new header section name while add individual/organisation user end

$('.toUpperCase').keyup(function() {
    $(this).val($(this).val().toUpperCase());
});


//Show old Contact address while adding client start
$(".get_oldcont_address").change(function(){
  var client_id   = $(this).val();
  var type   = $(this).data("type");
  if(client_id != "")
  {
    $.ajax({
      type: "POST",
      dataType: "json",
      url: '/client/get-oldcont-address',
      data: { 'client_id' : client_id },
      success : function(resp){
        //var value = $.parseJSON(resp);
        //alert(value.client_code);
        if (resp.length != 0) {
          $.each(resp, function(key){
            //console.log(resp[key].client_id); 
            $("#"+type+"_addr_line1").val(resp[key].cont_addr_line1);
            $("#"+type+"_addr_line2").val(resp[key].cont_addr_line2);
            $("#"+type+"_city").val(resp[key].cont_city);
            $("#"+type+"_county").val(resp[key].cont_county);
            $("#"+type+"_postcode").val(resp[key].cont_postcode);
            
          });

        }

      }
    });
  }else{
    $("#"+type+"_addr_line1").val("");
    $("#"+type+"_addr_line2").val("");
    $("#"+type+"_city").val("");
    $("#"+type+"_county").val("");
    $("#"+type+"_postcode").val("");
  }
  
}); 
//Show old Contact address while adding client end

// Select title for gender change while adding client start //
$(".select_title").change(function(){
  var value   = $(this).val();
  //alert(value);
  var male = ['Mr', 'Rev', 'Sir', 'Lord', 'Captain'];
  var female = ['Mrs', 'Miss', 'Dame', 'Lady'];
  if($.inArray(value, male) != -1){
    $("#gender").val('Male');
  }else if($.inArray(value, female) != -1){
    $("#gender").val('Female');
  }else{
    $("#gender").val('');
  }
  
});
// Select title for gender change while adding client end //

// Show add subsection text while adding client start //
$(".subsec_change").change(function(){
  var value   = $(this).val();
  //alert(value);
  if(value == "new"){
    $(".show_new_div").show();
  }else{
    $(".show_new_div").hide();
  }
  
});
// Show add subsection text while adding client end //

// Show subsection dropdown while adding client start //
$(".show_subsec").change(function(){
  var step_id     = $(this).val();
  var client_type = $(this).data("client_type");
  //alert(value);
  $.ajax({
    type: "POST",
    dataType: "json",
    url: '/client/get-subsection',
    data: { 'step_id' : step_id, 'client_type' : client_type },
    success : function(resp){
      var content = "<option value=''>-- Select sub section --</option>";
      if (resp.length != 0) {
        $.each(resp, function(key){
          content+= "<option value='"+resp[key].step_id+"'>"+resp[key].title+"</option>";
        });
      }
      content+= '<option value="new">Add new ...</option>';
      $("#substep_id").html(content);
    }
  });
  
});
// Show subsection dropdown while adding client end //




});//end of main document ready

function show_div()
{
  $("#new_relationship").show('slow');
}

var relationship_array = [];
function saveRelationship()
{
    var name = $('#relname').val();
    var app_date = $('#app_date').val();
    var rel_type_id = $('#rel_type_id').val();
    var rel_client_id = $('#rel_client_id').val();

    if(rel_client_id == ""){
      alert("Please search and select business name");
      return false;
    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/individual/save-relationship',
        data: { 'name' : name, 'app_date' : app_date, 'rel_type_id' : rel_type_id },
        success : function(resp){
          var content = '<tr><td width="25%">'+name+'</td><td width="30%" align="center">'+resp['appointment_date']+'</td><td width="30%" align="center">'+resp['relation_type']+'</td><td width="15%" align="center"><a href="javascript:void(0)"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)"><i class="fa fa-trash-o fa-fw"></i></a></td></tr>';
          $("#myRelTable").last().append(content);

          var itemselected = rel_client_id+"mpm"+resp['appointment_date']+"mpm"+rel_type_id;
          if(itemselected !== undefined && itemselected !== null){
              relationship_array.push(itemselected);
              /*relationship_array.push({
                  b_name: rel_client_id, 
                  app_date:  resp['appointment_date'],
                  r_type:  rel_type_id,
              });*/
          }
        //console.log(relationship_array);
          relationship_array.join(',');

          $('#app_hidd_array').val(relationship_array);

          $('#relname').val("");
          $('#app_date').val("");
          $("#new_relationship").hide('slow');
        }
      });
    }
    
}
$(document).ready(function(){

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
  $('#cont_trad_addr').on('ifChecked', function(event){
      $("#show_reg_office_addr").show("slow");
  });
  $('#cont_trad_addr').on('ifUnchecked', function(event){
      $("#show_reg_office_addr").hide("slow");
  });
  //Trading Address show while add organisation client end

  //Contact Name show while add organisation client start
  $('.cont_name_check').on('ifChecked', function(event){
      $("#show_org_contact").show("slow");
  });
  $('.cont_name_check').on('ifUnchecked', function(event){
      $("#show_org_contact").hide("slow");
  });
  //Contact Name show while add organisation client end

  //PAYE registered address show while add organisation client start
  $('.org_tax_payee_address').on('ifChecked', function(event){
      $("#employer_office").val("Customer Operations Employer Office, BP4009, Chillingham House, Benton Park View, Newcastle Upon Tyne");
      $("#employer_postcode").val("NE98 1ZZ");
      $("#employer_postcode").val("03002003200");
  });
  $('.org_tax_payee_address').on('ifUnchecked', function(event){
      $("#employer_office").val("");
      $("#employer_postcode").val("");
      $("#employer_postcode").val("");
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
$(".delete_org_name").click(function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-org-name',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          location.reload();
        }
      }
    });
  }
  
}); 
//Delete organisation name while add individual/organisation user end

//Delete organisation name while add individual/organisation user start
$(".delete_vat_scheme").click(function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-vat-scheme',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          location.reload();
        }
      }
    });
  }
  
}); 
//Delete organisation name while add individual/organisation user end

//Show old Contact address while adding client start
$("#get_oldcont_address").change(function(){
  var client_id   = $(this).val();
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
            $("#cont_addr_line1").val(resp[key].cont_addr_line1);
            $("#cont_addr_line2").val(resp[key].cont_addr_line2);
            $("#cont_city").val(resp[key].cont_city);
            $("#cont_county").val(resp[key].cont_county);
            $("#cont_postcode").val(resp[key].cont_postcode);
            
          });

        }

      }
    });
  }else{
    $("#cont_addr_line1").val("");
    $("#cont_addr_line2").val("");
    $("#cont_city").val("");
    $("#cont_county").val("");
    $("#cont_postcode").val("");
  }
  
}); 
//Show old Contact address while adding client end

//Delete services name while add individual/organisation user start
$(".delete_services").click(function(){
  var field_id = $(this).data('field_id');
  if (confirm("Do you want to delete this field ?")) {
    $.ajax({
      type: "POST",
      //dataType: "json",
      url: '/client/delete-services',
      data: { 'field_id' : field_id },
      success : function(resp){//console.log(resp);return false;
        if(resp != ""){
          location.reload();
        }
      }
    });
  }
  
}); 
//Delete services name while add individual/organisation user end




	
 	
});//end of main document ready

function show_org_other_div()
{
  $("#add_services_div").show('slow');
}

var service_array = [];
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
        var content = '<tr><td align="center">'+resp['service']+'</td><td width="30%" align="center">'+resp['staff']+'</td><td width="15%" align="center"><a href=""><i class="fa fa-edit"></i></a> <a href=""><i class="fa fa-trash-o fa-fw"></i></a></td></tr>';
        $("#myServTable").last().append(content);

        var itemselected = service_id+"mpm"+staff_id;
        if(itemselected !== undefined && itemselected !== null){
            service_array.push(itemselected);
        }

        service_array.join(',');

        $('#serv_hidd_array').val(service_array);

        //$('#relname').val("");
        //$('#app_date').val("");

        $("#add_services_div").hide('slow');
      }
    });

    
    
}


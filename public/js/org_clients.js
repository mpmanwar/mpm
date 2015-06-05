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


//Delete services name while add individual/organisation user start
$(".frequency_change").change(function(){
    var value = $(this).val();
    var option = "";
    if(value == "quarterly"){
      option+='<option>Choose One</option><option value="Jan-April-Jul-Oct">Jan-April-Jul-Oct</option><option value="Feb-May-Aug-Nov">Feb-May-Aug-Nov</option><option value="Mar-Jun-Sept-Dec">Mar-Jun-Sept-Dec</option>';
    }
    if(value == "monthly"){
      option+='<option>Choose One</option><option value="monthly">Monthly</option>';
    }
    if(value == "yearly"){
      option+='<option>Choose One</option><option value="jan">JAN</option><option value="feb">FEB</option><option value="mar">MAR</option><option value="apr">APR</option><option value="may">MAY</option><option value="jun">JUN</option><option value="jul">JUL</option><option value="aug">AUG</option><option value="sept">SEPT</option><option value="oct">OCT</option><option value="nov">NOV</option><option value="dec">DEC</option>';
    }
    $("#vat_stagger").html(option);
     
}); 
//Delete services name while add individual/organisation user end

// Delete Allocate Serveces while adding organisation client start //
$("#myServTable").on("click", ".delete_service", function(){
  var delete_index       = $(this).data("delete_index");

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
	
 	
});//end of main document ready

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
        var content = '<tr id="added_service_tr'+service+'"><td align="center">'+resp['service']+'</td><td width="30%" align="center">'+resp['staff']+'</td><td width="15%" align="center"><a href="javascript:void()" class="edit_service" data-edit_index="'+service+'"><i class="fa fa-edit"></i></a> <a href="javascript:void()" class="delete_service" data-delete_index="'+service+'"><i class="fa fa-trash-o fa-fw"></i></a></td></tr>';
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


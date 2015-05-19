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

  //Registered Office Address
  $('#reg_office_addr').on('ifChecked', function(event){
      $("#show_reg_office_addr").show("slow");
  });
  $('#reg_office_addr').on('ifUnchecked', function(event){
      $("#show_reg_office_addr").hide("slow");
  });


	
 	
});//end of main document ready

function show_org_other_div()
{
  $("#add_services_div").show('slow');
}

function saveServices()
{
    var services = $('#services').val();
    var staff = $('#staff').val();

    $.ajax({
      type: "POST",
      dataType: "json",
      url: '/organisation/save-services',
      data: { 'services' : services, 'staff' : staff },
      success : function(resp){
        var content = '<tr><td align="center">'+resp['services']+'</td><td width="30%" align="center">'+resp['staff']+'</td><td width="15%" align="center"><a href=""><i class="fa fa-edit"></i></a> <a href=""><i class="fa fa-trash-o fa-fw"></i></a></td></tr>';
        $("#myServTable").last().append(content);

        $("#add_services_div").hide('slow');
      }
    });

    
    
}


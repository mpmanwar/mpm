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
        //$("input[name='client_delete_id[]']").each( function (i) {
        $(".ads_Checkbox:checked").each( function (i) {
			if($(this).is(':checked')){
				val[i] = $(this).val();
			}

       	});
        //alert(val.length);return false;
		if(val.length>0){
			if(confirm("Do you want to delete?")){
				$.ajax({
				    type: "POST",
				    url: '/delete-individual-clients',
				    data: { 'user_delete_id' : val },
				    success : function(resp){
				    	//window.location = 'http://mpm.com/user-list';
				    	window.location = '/individual-clients';
				    }
				});
			}

 		}else{
 			alert('Please select atleast one clients');
 		}
 	});

 	$('#show_search').click(function() {
		$('#table_top_box').toggle();
 	});

 	$('#search_client_text').keyup(function() {
		//alert($(this).val());
 	});





// Add individual client

$(".open").click(function(){
  var data_id = $(this).data('id');
  var remove_id = data_id-1;
  $("#tab_"+data_id).addClass("active");
  $("#tab_"+remove_id).removeClass("active");
  $(".tab-pane").hide("fast");
  $("#step"+data_id).show("slow");
});

$(".open_header").click(function(){
  $("#header_ul li").parent().find('li').removeClass("active");
  $(this).parent('li').addClass('active');

  var data_id = $(this).data('id');
  $(".tab-pane").hide("fast");
  $("#step"+data_id).show("slow");
});

$(".back").click(function(){
  var data_id = $(this).data('id');
  var remove_id = Number(data_id)+Number(1);
  $("#tab_"+data_id).addClass("active");
  $("#tab_"+remove_id).removeClass("active");
  $(".tab-pane").hide("fast");
  $("#step"+data_id).show("slow");
});

 
    
  $("#tax_office_id").change(function(){
    var office_id   = $(this).val();
    if(office_id == "other"){
      $('#tax_address').val("");
      $('#tax_city').val("");
      $('#tax_region').val("");
      $('#tax_zipcode').val("");
      $('#tax_telephone').val("");
    }else{
      $.ajax({
        type: "POST",
        dataType: "json",
        url: '/individual/get-office-address',
        data: { 'office_id' : office_id },
        success : function(resp){
          //console.log(resp['address']);
          $('#tax_address').val(resp['address']);
          $('#tax_city').val(resp['city']);
          $('#tax_region').val(resp['region']);
          $('#tax_zipcode').val(resp['zipcode']);
          $('#tax_telephone').val(resp['telephone']);
        }
      });

    }
    

      
});





});//end of main document ready

function show_div()
{
  $("#new_relationship").show('slow');
}

function saveRelationship()
{
    var name = $('#relname').val();
    var date = $('#app_date').val();
    var type = $('#reltype').val();

    $.ajax({
      type: "POST",
      dataType: "json",
      url: '/individual/save-relationship',
      data: { 'name' : name, 'date' : date, 'type' : type },
      success : function(resp){
        var content = '<tr><td width="25%">'+name+'</td><td width="30%" align="center">'+resp['date']+'</td><td width="30%" align="center">'+resp['relation_type']+'</td><td width="15%" align="center"><a href=""><i class="fa fa-edit"></i></a> <a href=""><i class="fa fa-trash-o fa-fw"></i></a></td></tr>';
        $("#myRelTable").last().append(content);

        $('#relname').val("");
        $('#app_date').val("");
        $("#new_relationship").hide('slow');
      }
    });

    
    
}
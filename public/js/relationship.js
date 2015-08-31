$(document).ready(function (e) {

	// Get all the officers in the relationship section start //
	$(".imported_officers").click(function(){
		var company_number = $("#registration_number").val();

	    //var company_number = $(this).data("company_number");
	    	    
	    //alert(company_number);
	    $.ajax({
	        type: "POST",
	        url: "/client/get-officers-client",
	        dataType: "json",
	        data: { 'company_number': company_number },
	        beforeSend: function() {
	            $("#officers_details-modal").modal('show');
	            var loder = "";
	            loder +='<tr class="td_color"><td align="center" colspan="3">';
	            loder +='<span class="table_tead_t">OFFICERS</span></td></tr>';
		        loder +='<tr class="td_color"><td align="center" class="sub_header">Name</td><td align="center" class="sub_header">Role</td><td align="center" width="20%" class="sub_header">Add to Relationships</td></tr>';
	            loder +='<tr><td colspan="3" align="center"><img src="/img/spinner.gif" /></td></tr>';
	            $("#officers_details-modal .officer_table").html(loder);
	        	//return false;
	        },
	        success: function (resp) {//console.log(resp['link']);return false;
	            var content = "";
	            $.each(resp, function(key){
		            content += '<tr><td width="40%">'+resp[key].client_name+'</td>';
	                content += '<td width="40%" align="center">'+resp[key].officer_role+'</td>';
	                content += '<td width="20%" align="center" id="goto'+key+'"><div class="officer_selectbox"><span>+ Add</span><div class="small_icon" data-id="'+key+'"></div><div class="clr"></div>';
	                content += '<div class="select_toggle" id="status'+key+'" style="display: none;"><ul>';
	                content += '<li data-value="org"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="add_client_officers">NEW CLIENT</a></li>';
	                content += '<li data-value="non"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="officer_addto_relation">NON - CLIENT</a></li>';
	                content += '</ul></div></div></td></tr>';
                });
	            $('#officers_details-modal .officer_table tr:last').remove();
                $("#officers_details-modal .officer_table").last().append(content);
	        }
	        
	    });

	});
	// Get all the officers in the relationship section End //

// Get all the shareholders in the relationship section start //
    $(".view_shareholders").click(function(){
        var company_number = $("#registration_number").val();

        $.ajax({
            type: "POST",
            url: "/chdata/get-shareholders-client",
            dataType: "json",
            data: { 'company_number': company_number },
            beforeSend: function() {
                $("#view_shareholders-modal").modal('show');
                var loder = "";
                loder +='<tr class="td_color"><td align="center" colspan="3">';
                loder +='<span class="table_tead_t">VIEW SHAREHOLDERS</span></td></tr>';
                loder +='<tr class="td_color"><td align="center" class="sub_header">DATE</td><td align="center" class="sub_header">Category</td><td align="center" width="20%" class="sub_header">View/Download</td></tr>';
                loder +='<tr><td colspan="3" align="center"><img src="/img/spinner.gif" /></td></tr>';
                $("#view_shareholders-modal .shareholder_table").html(loder);
                //return false;
            },
            success: function (resp) {//console.log(resp['link']);return false;
                var content = "";
                $.each(resp, function(key){
                    content += '<tr><td width="40%" align="center">'+resp[key].date+'</td>';
                    content += '<td width="40%" align="center">'+resp[key].category+'</td>';
                    content += '<td width="20%" align="center"><a href="https://beta.companieshouse.gov.uk/company/'+resp[key].company_number+'/filing-history/'+resp[key].transaction_id+'/document?format=pdf&download=0" target="_blank">View PDF</a></td></tr>';
                });
                $('#view_shareholders-modal .shareholder_table tr:last').remove();
                $("#view_shareholders-modal .shareholder_table").last().append(content);
            }
            
        });

    });
// Get all the shareholders in the relationship section End //


// ################Officers dropdown toggle in relationship section start ################### //
	$(document).click(function() {
	    $(".select_toggle").hide();
	});
	//$(".small_icon").click(function(event) {
	$("#officers_details-modal").on("click", ".small_icon", function(event){
		var visable = 0;
		event.stopPropagation();
		var id = $(this).data("id");
		if($(".select_toggle").is(':visible')){
			visable = 1;
		}
		$(".select_toggle").hide();

		if(visable == 1){
			$("#status"+id).hide();
		}else{
			$("#status"+id).show();
		}    
	    
	});
// ################Officers dropdown toggle in relationship section end ################### //


$("#officers_details-modal").on("click", ".officer_addto_relation", function(){
	var key = $(this).data("key");
    var company_number = $(this).data("company_number");
    var client_id = $("#client_id").val();

	$.ajax({
        type: "POST",
        url: "/client/save-officers-into-relation",
        dataType: "json",
        data: { 'company_number': company_number, 'key': key, 'client_id' : client_id },
        beforeSend: function() {
            $('#rel_client_id').val("");
            $("#goto"+key).html('<img src="/img/spinner.gif" />');
        },
        success: function (resp) {//console.log(resp['relation_type_id']);return false;
        	var content = "";
            content += '<div class="officer_selectbox"><span>+ Add</span><div class="small_icon" data-id="'+key+'"></div><div class="clr"></div>';
            content += '<div class="select_toggle" id="status'+key+'" style="display: none;"><ul>';
            content += '<li data-value="org"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="add_client_officers">NEW CLIENT</a></li>';
            content += '<li data-value="non"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="officer_addto_relation">NON - CLIENT</a></li>';
            content += '</ul></div></div>';
        	$("#goto"+key).html(content);

        	var url, name;
        	if(resp['link'] == 'org'){
                url  = resp['base_url']+'/client/edit-org-client/'+resp['client_id']+"/"+resp['goto_link'];
                name = '<a href="'+url+'" target="_blank">'+resp['appointment_name']+'</a>';
            }
            else if(resp['link'] == 'ind'){
                url = resp['base_url']+'/client/edit-ind-client/'+resp['client_id']+"/"+resp['goto_link'];
                name = '<a href="'+url+'" target="_blank">'+resp['appointment_name']+'</a>'
            }else{
            	url = "";
            	name = resp['appointment_name'];
            }

        	var relcontent = "";
			relcontent += '<tr id="database_tr'+resp['relation_id']+'"><td width="40%">'+name+'</td>';
			relcontent += '<td width="40%" align="center">'+resp['relationship_type']+'</td>';
			relcontent += '<td width="20%" align="center"><a href="javascript:void(0)" data-link="'+url+'" data-rel_client_id="'+resp['rel_client_id']+'" class="delete_database_rel" data-delete_index="'+resp['relation_id']+'"><img src="/img/cross.png" height="15"></a></td>';

			$("#myRelTable").last().append(relcontent);
            
        }
        
    });
});


$("#officers_details-modal").on("click", ".add_client_officers", function(){
    var key = $(this).data("key");
    var company_number = $(this).data("company_number");
    var client_id = $("#client_id").val();

    $.ajax({
            type: "POST",
            url: "/goto-edit-client",
            dataType: "json",
            data: { 'company_number': company_number, 'key' : key, 'client_id' : client_id },
            beforeSend: function() {
                $("#goto"+key).html('<img src="/img/spinner.gif" />');
                $('#rel_client_id').val("");
            },
            success: function (resp) {//console.log(resp['link']);return false;
            	var content = "";
	            content += '<div class="officer_selectbox"><span>+ Add</span><div class="small_icon" data-id="'+key+'"></div><div class="clr"></div>';
	            content += '<div class="select_toggle" id="status'+key+'" style="display: none;"><ul>';
	            content += '<li data-value="org"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="add_client_officers">NEW CLIENT</a></li>';
	            content += '<li data-value="non"><a href="javascript:void(0)" data-company_number="'+company_number+'" data-key="'+key+'" class="officer_addto_relation">NON - CLIENT</a></li>';
	            content += '</ul></div></div>';
            	$("#goto"+key).html(content);
            	
            	if(resp == 0){
            		alert("This company can not import...");
            		return false;
            	}

            	var url, name;
            	if(resp['link'] == 'org'){
                    url  = resp['base_url']+'/client/edit-org-client/'+resp['client_id']+"/"+resp['goto_link'];
                    name = '<a href="'+url+'" target="_blank">'+resp['appointment_name']+'</a>';
                }
                else if(resp['link'] == 'ind'){
                    url = resp['base_url']+'/client/edit-ind-client/'+resp['client_id']+"/"+resp['goto_link'];
                    name = '<a href="'+url+'" target="_blank">'+resp['appointment_name']+'</a>'
                }else{
                	url = "";
                	name = resp['appointment_name'];
                }

            	


            	var relcontent = "";
				relcontent += '<tr id="database_tr'+resp['relation_id']+'"><td width="40%">'+name+'</td>';
				relcontent += '<td width="40%" align="center">'+resp['relationship_type']+'</td>';
				relcontent += '<td width="20%" align="center"><a href="javascript:void(0)" data-link="'+url+'" data-rel_client_id="'+resp['rel_client_id']+'" class="delete_database_rel" data-delete_index="'+resp['relation_id']+'"><img src="/img/cross.png" height="15"></a></td>';

				$("#myRelTable").last().append(relcontent);

            	
				var myWindow = window.open(url , '_blank');
                myWindow.focus();

                
            }
        });

});



});
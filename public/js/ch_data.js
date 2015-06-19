$(document).ready(function(){
	
	$(".get_officers").click(function(){
		var number = $(this).data("number");
		var key = $(this).data("key");

        $.ajax({
            type: "POST",
            url: "/officers-details",
            data: { 'number': number, 'key': key },
            beforeSend: function() {
                $("#officer_details_div").html('<img src="/img/ajax-loader1.gif" />');
                $("#personal_details").modal('show');//return false;
            },
            success: function (resp) {
            	$("#officer_details_div").html(resp);
            }
        });
    });

    $(".search_company").click(function(){
        var value = $("#search_value").val();
        $.ajax({
            url : "/company-search",
            type : "POST",
            data : { 'value' : value},
            beforeSend : function(){
                $("#result").html("");
                var result = '<tr class="td_color"><td colspan="3"><span class="sub_header">COMPANY NAME</span></td></tr><tr><td colspan="3" align="center"><img src="/img/spinner.gif"></td></tr>';
                $("#result").html(result);
            },
            success : function(resp){
                $("#result").html(resp);
            }
        });
    });

    $("#result").on("click", ".get_company_details", function(){//popup_align
        var number = $(this).data("number");
        
        $.ajax({
            type: "POST",
            url: "/company-details",
            data: { 'number': number },
            beforeSend: function() {
                $("#company_details_div").html('<img src="/img/ajax-loader1.gif" />');
                $("#company_details-modal").modal('show');//return false;
            },
            success: function (resp) {
                $("#company_details_div").html(resp);
            }
        });
    });

    $("#company_details_div").on("click", ".import_client", function(){
        var number = $(this).data("number");
        var back_url = $("#back_url").val();

        $.ajax({
            type: "POST",
            url: "/import-company-details/"+number,
            //data: { 'number': number },
            beforeSend: function() {
                $("#message_div").html('<img src="/img/spinner.gif" />');
            },
            success: function (client_id) {return false;
                if(client_id > 0){
                    //$("#message_div").html("<p style='color:#3c8dbc;font-size:16px'>Company details successfully imported</p>");
                    if(back_url == 'ch_list'){
                        window.location.href='/chdata/index';
                    }
                    if(back_url == 'org_list'){
                        window.location.href='/client/edit-org-client/'+client_id;
                    }
                        
                }else{
                    $("#message_div").html("<p style='color:red;font-size:16px'>There are some error to importing data</p>");
                }
            }
        });
    });


    



});//end of main document ready 

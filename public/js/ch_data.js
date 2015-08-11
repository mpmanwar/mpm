$(document).ready(function(){
    $('#CheckallCheckbox').on('ifChecked', function(event){
        $(".ch_returns input[class='checkbox']").iCheck('check');
    });

    $('#CheckallCheckbox').on('ifUnchecked', function(event){
        $(".ch_returns input[class='checkbox']").iCheck('uncheck');
    });

    $(document).click(function() {
        $(".open_toggle").hide();
    });
    $("#select_icon").click(function(event) {
        $(".open_toggle").toggle();
        event.stopPropagation();
    });

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
        var back_url = $("#back_url").val();
        
        $.ajax({
            type: "POST",
            url: "/company-details",
            data: { 'number': number, 'back_url' : back_url },
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
        var goto_url = $(this).data("goto_url");

        $.ajax({
            type: "POST",
            url: "/import-company-details/"+number+"=ajax",
            //data: { 'number': number },
            beforeSend: function() {
                $("#message_div").html('<img src="/img/spinner.gif" />');
            },
            success: function (client_id) {//return false;
                if(client_id > 0){
                    //$("#message_div").html("<p style='color:#3c8dbc;font-size:16px'>Company details successfully imported</p>");
                    if(back_url == 'ch_list'){
                        window.location.href='/chdata/index';
                    }
                    if(back_url == 'org_list'){
                        window.location.href='/client/edit-org-client/'+client_id+"/"+goto_url;
                    }
                    if(back_url == 'ind_list'){
                        window.location.href='/client/edit-ind-client/'+client_id+"/"+goto_url;
                    }
                        
                }else{
                    $("#message_div").html("<p style='color:red;font-size:16px'>There are some error to importing data</p>");
                }
            }
        });
    });


    $("#company_details_div").on("click", ".add_client_officers", function(){
        var key = $(this).data("key");
        var company_number = $(this).data("company_number");
        var goto_url = $(this).data("goto_url");

        $.ajax({
                type: "POST",
                url: "/goto-edit-client",
                dataType: "json",
                data: { 'company_number': company_number, 'key' : key },
                beforeSend: function() {
                    $("#goto"+key).html('<img src="/img/spinner.gif" />');
                },
                success: function (resp) {//console.log(resp['link']);return false;
                $("#goto"+key).html('<button class="btn btn-default btn-sm imp_but" type="button">+ Add</button>');
                    if(resp['link'] == 'org'){
                        var url = resp['base_url']+'/client/edit-org-client/'+resp['client_id']+"/"+goto_url;
                        var myWindow = window.open(url , '_blank');
                        myWindow.focus();
                    }
                    if(resp['link'] == 'ind'){
                        var url = resp['base_url']+'/client/edit-ind-client/'+resp['client_id']+"/"+goto_url;
                        var myWindow = window.open(url, '_blank');
                        myWindow.focus();
                    }
                }
            });

    });





  



});//end of main document ready 

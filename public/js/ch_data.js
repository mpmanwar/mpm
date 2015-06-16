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
                $("[type='checkbox']").closest("div").trigger("create"); 
            }
        });
    });

    $(".import_client").click(function(){
        var val = [];
        $("input[name='company_number[]']").each( function (i) {
            if($(this).is(':checked')){
                val[i] = $(this).val();
                console.log($(this).val());
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



});//end of main document ready 

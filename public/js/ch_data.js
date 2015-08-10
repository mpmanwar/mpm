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
                        window.location.href='/client/edit-org-client/'+client_id;
                    }
                    if(back_url == 'ind_list'){
                        window.location.href='/client/edit-ind-client/'+client_id;
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
                        var url = resp['base_url']+'/client/edit-org-client/'+resp['client_id'];
                        var myWindow = window.open(url , '_blank');
                        myWindow.focus();
                    }
                    if(resp['link'] == 'ind'){
                        var url = resp['base_url']+'/client/edit-ind-client/'+resp['client_id'];
                        var myWindow = window.open(url, '_blank');
                        myWindow.focus();
                    }
                }
            });

    });




/* ================== Manage Tasks ================== */
    $(document).on("click", ".edit_status", function(){
        var step_id = $(this).data("step_id");
        var status_name = $("#status_span"+step_id).html();
        var text_field = "<input type='text' id='status_name"+step_id+"' value='"+status_name+"' style='width:100%; height:30px'>";
        var action = "<a href='javascript:void(0)' class='save_new_status' data-step_id='"+step_id+"'>Save</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='cancel_edit' data-step_id='"+step_id+"'>Cancel</a>";
        $("#status_span"+step_id).html(text_field);
        $("#action_"+step_id).html(action);
    });

    $("#status-modal").on("click", ".cancel_edit", function(){
        var step_id = $(this).data("step_id");
        var status_name = $("#status_name"+step_id).val();
        var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
        $("#status_span"+step_id).html(status_name);
        $("#action_"+step_id).html(action);
    });

    $("#status-modal").on("click", ".save_new_status", function(){
        var step_id = $(this).data("step_id");
        var status_name = $("#status_name"+step_id).val();
        //alert(status_name+" "+step_id);
        $.ajax({
            type: "POST",
            url: "/chdata/save-edit-status",
            //dataType: "json",
            data: { 'step_id': step_id, 'status_name' : status_name, 'type' : "title" },
            beforeSend: function() {
                //$("#goto"+key).html('<img src="/img/spinner.gif" />');
            },
            success: function (resp) {
                if(resp != ""){
                    var action = "<a href='javascript:void(0)' class='edit_status' data-step_id='"+step_id+"'><img src='/img/edit_icon.png'></a>";
                    $("#status_span"+step_id).html(status_name);
                    $("#action_"+step_id).html(action);

                    $("#step_field_"+step_id).text(status_name);
                    $("#status_dropdown option[value='"+step_id+"']").html(status_name);

                }else{
                    alert("There are some problem to update status");
                }
                
            }
        });

    });

    $('#status-modal .status_check').on('ifChecked', function(event){
        var step_id = $(this).data("step_id");
        //alert(step_id);return false;
        if(step_id != ""){
            $.ajax({
                type: "POST",
                url: "/chdata/save-edit-status",
                data: { 'step_id': step_id, 'type' : "status" },
                success: function (resp) {
                    //$('#status_dropdown').append($("<option></option>").attr("value", step_id).text(resp));
                    $("#status_dropdown option[value='"+step_id+"']").show();    
                    $(".header_step_"+step_id).show();           
                }
            });
        }
        
    });

    $('#status-modal .status_check').on('ifUnchecked', function(event){
        var step_id = $(this).data("step_id");
        //alert(step_id);return false;
        if(step_id != ""){
            $.ajax({
                type: "POST",
                url: "/chdata/save-edit-status",
                data: { 'step_id': step_id, 'type' : "status" },
                success: function (resp) {
                    //$("#status_dropdown option[value='"+step_id+"']").remove(); 
                    $("#status_dropdown option[value='"+step_id+"']").hide();   
                    $(".header_step_"+step_id).hide();              
                }
            });
        }
    });

/* ################# Send to Task Management Start ################### */
    $(".send_manage_task").click(function(){
        var client_id = $(this).data("client_id");
        var field_name = $(this).data("field_name");
        //alert(step_id);return false;
        //if(confirm("Do you want to send the client to manage task ?")){
            $.ajax({
                type: "POST",
                url: "/chdata/send-manage-task",
                data: { 'client_id': client_id, 'field_name' : field_name },
                success: function (resp) {
                    $("#after_send_"+client_id).html('<button type="button" class="sent_btn">Sent</button>');              
                }
            });
        //}
        
    });
/* ################# Send to Task Management End ################### */


/* ################# Delete to Task Management Start ################### */
    $(".delete_manage_task").click(function(){
        var val = [];
        $(".checkbox:checked").each( function (i) {
            if($(this).is(':checked')){
                val[i] = $(this).val();
            }
        });
        //alert(val.length);return false;
        if(val.length>0){
            if(confirm("Do you want to Change the status?")){
                $.ajax({
                    type: "POST",
                    url: '/chdata/delete-manage-task',
                    data: { 'client_delete_id' : val },
                    success : function(resp){
                        
                            
                    }
                });
            }

        }else{
            alert('Please select atleast one clients');
        }
        
    });
/* ################# Delete to Task Management End ################### */

/* ################# Delete Single Task Management Start ################### */
    $(".delete_single_task").click(function(){
        var client_id = $(this).data('client_id');
        if(confirm("Do you want to Change the task?")){
            $.ajax({
                type: "POST",
                url: '/chdata/delete-single-task',
                data: { 'client_id' : client_id },
                success : function(resp){
                    
                        
                }
            });
        }
    });
/* ################# Delete Single Task Management End ################### */

/* ################# Job Status Change Start ################### */
    $(".status_dropdown").change(function(){
        var service_id = $("#service_id").val();
        var client_id = $(this).data("client_id");
        var status_id = $(this).val()
        //alert("val.length");return false;
        if(status_id != 2)
        {
            $.ajax({
                type: "POST",
                url: '/chdata/change-job-status',
                data: { 'service_id' : service_id, 'client_id' : client_id, 'status_id' : status_id },
                success : function(resp){
                    
                        
                }
            });
        }else{
            alert("This is some problem to delete");
            return false;
        }
    });
/* ################# Delete to Task Management End ################### */

/* ################# Global Task Management Start ################### */
    $('#manage_check').on('ifChecked', function(event){
        $("#dead_line").prop("disabled", true);
        var dead_line = $("#dead_line").val();
        var service_id = $("#service_id").val();
        if(dead_line == ""){
            alert("Please Put The Days Before Deadline value");
            return false;
        }else{
            $.ajax({
                type: "POST",
                dataType : 'json',
                url: '/chdata/send-global-task',
                data: { 'dead_line' : dead_line, 'service_id' : service_id },
                success : function(resp){ 
                    $.each(resp, function(key, value){
                        $("#after_send_"+value.client_id).html('<button type="button" class="sent_btn">Sent</button>');
                    });
                }
            });
        }
    });

    $('#manage_check').on('ifUnchecked', function(event){
        $("#dead_line").prop("disabled", false);
    });
/* ################# Global Task Management End ################### */
  

//send_manage_task

});//end of main document ready 

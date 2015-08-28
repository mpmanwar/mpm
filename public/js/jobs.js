$(document).ready(function () {
    /*$(document).click(function() {
        $(".cont_add_to_date").hide();
    });*/
    $(".open_adddrop").click(function(event) {
        var client_id = $(this).data("client_id");
        var tab = $(this).data("tab");
        //$(".atc-style-blue a").css("pointer-events", "pointer");
        
        //$(".cont_add_to_date").hide();
        $(".open_dropdown_"+client_id+"_"+tab).toggle();
        event.stopPropagation();
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
    /*$(".send_manage_task").click(function(){
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
        
    });*/
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
        var client_id   = $(this).data('client_id');
        var tab         = $(this).data('tab');
        var service_id  = $("#service_id").val();
        var page_open   = $("#page_open").val();
        var prev_status = $("#prev_status_"+client_id).val();

        if(confirm("Do you want to Delete the task?")){
            $.ajax({
                type: "POST",
                url: '/jobs/delete-single-task',
                data: { 'client_id' : client_id, 'service_id' : service_id, 'tab' : tab },
                success : function(resp){
                    if(page_open == 3){
                        $("#data_tr_"+client_id+"_"+tab).hide();
                    }

                    if(tab != 21){
                      var count_21 = $("#task_count_21").html();
                      $("#task_count_21").html(parseInt(count_21-1)); 
                    }else{
                      var prev_status = $("#"+tab+"_status_dropdown_"+client_id).val();
                      var task_count = $("#task_count_2"+prev_status).html();
                      $("#task_count_2"+prev_status).html(parseInt(task_count-1));
                    }
                    
                    $("#data_tr_"+client_id+"_"+tab).hide(); 
                    var count_2 = $("#task_count_"+tab).html();
                    $("#task_count_"+tab).html(parseInt(count_2)-1); 
                }
            });
        }
    });
/* ################# Delete Single Task Management End ################### */

/* ################# Job Status Change Start ################### */
    $(".status_dropdown").change(function(){
        var service_id  = $("#service_id").val();
        var client_id   = $(this).data("client_id");
        var status_id   = $(this).val();
        var page_open   = $("#page_open").val();
        //alert("val.length");return false;
        if(status_id != 2)
        {
            $.ajax({
                type: "POST",
                url: '/jobs/change-job-status',
                data: { 'service_id' : service_id, 'client_id' : client_id, 'status_id' : status_id },
                success : function(resp){
                    
                    /* ============Current Page ========== */
                    if(page_open != 21){
                        var task_count = $("#task_count_"+page_open).html();
                        var total_cnt = parseInt(task_count-1);
                        $("#task_count_"+page_open).html(total_cnt);
                        $("#data_tr_"+client_id+"_"+page_open).hide(); 

                        if(total_cnt>0){
                            $("#step_check_"+page_open).iCheck("disable");
                        }else{
                            $("#step_check_"+page_open).iCheck("enable");
                        }
                        

                    }else{
                        var prev_status = $("#"+page_open+"_prev_status_"+client_id).val();
                        var task_count = $("#task_count_2"+prev_status).html();
                        var total_cnt = parseInt(task_count-1);
                        $("#task_count_2"+prev_status).html(total_cnt);
                        $("#"+page_open+"_prev_status_"+client_id).val(status_id);

                        if(total_cnt>0){
                            $("#step_check_2"+prev_status).iCheck("disable");
                        }else{
                            $("#step_check_2"+prev_status).iCheck("enable");
                        }
                    }
                    /* ============Current Page ========== */

                    var count_2 = $("#task_count_2"+status_id).html();
                    var total = parseInt(count_2)+parseInt(1);
                    $("#task_count_2"+status_id).html(total); 

                    if(total>0){
                        $("#step_check_2"+status_id).iCheck("disable");
                    }else{console.log("7false"+status_id)
                        $("#step_check_2"+status_id).iCheck("enable");
                    }
                        
                }
            });
        }else{
            alert("This is some problem to change status");
            return false;
        }
    });
/* ################# Delete to Task Management End ################### */

/* ################# Global Task Management Start ################### */
    /*$('#manage_check').on('ifChecked', function(event){
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
                url: '/jobs/send-global-task',
                data: { 'dead_line' : dead_line, 'service_id' : service_id },
                success : function(resp){ 
                    $.each(resp, function(key, value){
                        $("#after_send_"+value.client_id).html('<button type="button" class="sent_btn">SENT</button>');
                    });
                }
            });
        }
    });

    $('#manage_check').on('ifUnchecked', function(event){
        $("#dead_line").prop("disabled", false);
    });*/

    $('#manage_check').click(function(event){
        var dead_line = $("#dead_line").val();
        var service_id = $("#service_id").val();
        if(dead_line == ""){
            alert("Please Put The Days Before Deadline value");
            return false;
        }else{
            $.ajax({
                type: "POST",
                dataType : 'json',
                url: '/jobs/send-global-task',
                data: { 'dead_line' : dead_line, 'service_id' : service_id },
                beforeSend : function(){
                    $(".loader_show").html('<img src="/img/spinner.gif" />');
                },
                success : function(resp){ 
                    $.each(resp, function(key, value){
                        $("#after_send_"+value.client_id).html('<button type="button" class="sent_btn">SENT</button>');
                    });
                    $("#auto_send-modal").modal("hide");
                    $(".loader_show").html('');
                }
            });
        }
    });
/* ################# Global Task Management End ################### */


/* ################# Filter By Staff Start ################### */
    $(".filter_by_staff").change(function(){
        var staff_id = $(this).val();
        var service_id = $("#service_id").val();
        var page_open = $("#encode_page_open").val();
        $.ajax({
            type: "POST",
            url: '/jobs/update-staff-filter',
            data: { 'staff_id' : staff_id, 'service_id' : service_id },
            success : function(resp){ 
                window.location = "/ch-annual-return/"+service_id+"/"+page_open+"/"+staff_id;
            }
        });
        
    });
/* ################# Filter By Staff Start ################### */

  $('#CheckallCheckbox').on('ifChecked', function(event){
        $(".jobs input[class='checkbox']").iCheck('check');
  });

  $('#CheckallCheckbox').on('ifUnchecked', function(event){
      $(".jobs input[class='checkbox']").iCheck('uncheck');
  });
	
/* ################# Send to Task Management Start ################### */
    $(".send_manage_task").click(function(){
        var client_id = $(this).data("client_id");
        var service_id = $("#service_id").val();
        $.ajax({
            type: "POST",
            url: "/jobs/send-manage-task",
            data: { 'client_id': client_id, 'service_id' : service_id },
            success: function (resp) {
                $("#after_send_"+client_id).html('<button type="button" class="sent_btn">Sent</button>');              
            }
        });
        
    });
/* ################# Send to Task Management End ################### */

/* ################# Open Notes Popup Start ################### */
    $(".open_notes_popup").click(function(){
      var client_id = $(this).data("client_id");
      var tab = $(this).data("tab");
      var service_id = $("#service_id").val();

      $.ajax({
          type: "POST",
          dataType : "json",
          url: "/jobs/show-jobs-notes",
          data: { 'client_id': client_id, 'service_id' : service_id },
          success: function (resp) {
            $("#notes_client_id").val(client_id);
            $("#notes_tab").val(tab);

            $("#notes").val(resp['notes']);
            $("#notes-modal").modal("show");             
          }
      });
        
    });
/* ################# Save Notes Popup End ################### */

/* ################# Save Notes Start ################### */
    $(".save_notes").click(function(){
      var client_id   = $("#notes_client_id").val();
      var tab         = $("#notes_tab").val();
      var service_id  = $("#service_id").val();
      var notes       = $("#notes").val();

      $.ajax({
          type: "POST",
          //dataType : "json",
          url: "/jobs/save-jobs-notes",
          data: { 'client_id': client_id, 'service_id' : service_id, 'notes' : notes, 'type':'note' },
          success: function (resp) {
            $("#notes-modal").modal("hide");             
          }
      });
        
    });
/* ################# Save Notes End ################### */

/* ################# Open date text in job completed section Start ################### */
    $(".change_last_date").click(function(){
        var key         = $(this).data('key');
        var tab         = $(this).data('tab');
        var prev_date   = $(this).data('prev_date');
        $(this).hide();
        $("."+tab+"_save_made_span_"+key).show();
        $("#"+tab+"_made_up_date_"+key).val(prev_date); 
    });
    $(".cancel_made_date").click(function(){
        var key   = $(this).data('key');
        var tab   = $(this).data('tab');
        $("#"+tab+"_dateanchore_"+key).show();
        $("."+tab+"_save_made_span_"+key).hide();
    });

    $(".save_made_date").click(function(){
        var client_id   = $(this).data('client_id');
        var service_id  = $(this).data('service_id');
        var tab         = $(this).data('tab');
        var key         = $(this).data('key');
        var date        = $("#"+tab+"_made_up_date_"+key).val();

        $.ajax({
          type: "POST",
          //dataType : "json",
          url: "/jobs/save-made-up-date",
          data: { 'client_id': client_id, 'service_id': service_id, 'date': date },
          success: function (resp) {
            $("#"+tab+"_dateanchore_"+key).show();
            $("."+tab+"_save_made_span_"+key).hide();         
          }
        });
    });
/* ################# Open date text in job completed section Start ################### */

/* ################# SYNC data in job section start ################### */
    $(".sync_jobs_data").click(function(){
        var service_id          = $("#service_id").val();
        var encode_staff_id     = $("#encode_staff_id").val();
        var encode_page_open    = $("#encode_page_open").val();
        var val = [];
        //alert('val');return false;
        $(".checkbox:checked").each( function (i) {
            if($(this).is(':checked')){
                val[i] = $(this).val();
            }
        });
        //alert(val.length);return false;
        if(val.length>0){
            $.ajax({
                type: "POST",
                url: '/jobs/sync-jobs-clients',
                data: { 'client_ids' : val, 'service_id' : service_id },
                beforeSend : function(){
                    $(".sync_jobs_data").attr('disabled', 'disabled');
                    $("#message_div").html('<img src="/img/spinner.gif" />');
                },
                success : function(resp){
                  window.location = '/ch-annual-return/'+service_id+'/'+encode_page_open+'/'+encode_staff_id;
                }
            });
            
        }else{
            alert('Please select atleast one job');
        }

    });
/* ################# SYNC data in job section end ################### */

/* ################# Job Start Date in job section start ################### */
    $(".open_calender_pop").click(function(){
        var client_id   = $(this).data('client_id');
        var service_id  = $("#service_id").val();
        var tab         = $(this).data('tab');
        $("#calender_client_id").val(client_id);
        $("#calender_tab").val(tab);

        $(".open_dropdown_"+client_id+"_"+tab).hide();
        $("#addto_calender-modal").modal("show");
    });

    $(".save_job_start_date").click(function(){
        var encode_staff_id     = $("#encode_staff_id").val();
        var encode_page_open    = $("#encode_page_open").val();
        var hour        = $("#calender_time").data('timepicki-tim');
        var date        = $("#calender_date").val();
        var service_id  = $("#service_id").val();
        var minute      = $("#calender_time").data('timepicki-mini');
        var client_id   = $("#calender_client_id").val();
        var tab         = $("#calender_tab").val();
        var job_start_date = date+" "+hour+":"+minute;

        $.ajax({
            type: "POST",
            url: '/jobs/save-jobs-notes',
            data: { 'client_id' : client_id, 'service_id' : service_id, 'job_start_date' : job_start_date, 'type':'startdate' },
            beforeSend : function(){
                $("#start_date_loader").html('<img src="/img/spinner.gif" />');
            },
            success : function(resp){
              window.location = '/ch-annual-return/'+service_id+'/'+encode_page_open+'/'+encode_staff_id;
            }
        });

        /*$("#date_view_"+client_id+"_"+tab).html(date+" "+hour+":"+minute);
        $("#addto_calender-modal").modal("hide");*/
        
    });

    $("body").on("click", ".atcb-item a", function(){
        $(".cont_add_to_date").hide();
    });
/* ################# Job Start Date in job section end ################### */


    $(".job_start_date-modal").click(function(){
        $("#job_start_date-modal").modal("show");
    });

    $(".email_client-modal").click(function(){
        $("#email_client-modal").modal("show");
    });

    $(".send_template-modal").click(function(){
        $("#send_template-modal").modal("show");
    });

    $(".enter_email-modal").click(function(){
        $("#enter_email-modal").modal("show");
    });

    $(".ch_returns").on("click", ".small_icon", function(event){
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

    $(document).click(function() {
        $(".select_toggle").hide();
    });

    /* ################# Job start date in job section start ################### */
    $("#jsd_save").click(function(){
        var service_id          = $("#service_id").val();
        var encode_staff_id     = $("#encode_staff_id").val();
        var encode_page_open    = $("#encode_page_open").val();

        var days  = $("#job_start_date").val();
        if(days == ""){
            alert("Please enter the days");
            return false;
        }
        //alert(days);return false;
        $.ajax({
            type: "POST",
            url: '/jobs/save-start-days',
            data: { 'days' : days, 'service_id' : service_id },
            beforeSend : function(){
                $(".loader_show").html('<img src="/img/spinner.gif" />');
            },
            success : function(resp){
                if(resp > 0){
                    window.location = '/ch-annual-return/'+service_id+'/'+encode_page_open+'/'+encode_staff_id;
                }else{
                    $(".loader_show").html('There are some error..Please try again...');
                }
                
            }
        });
    });
    /* ################# Job start date in job section end ################### */


    /* ################# Email Client in job section start ################### */
    $("#save_send_email").click(function(){
        var service_id          = $("#service_id").val();
        var encode_staff_id     = $("#encode_staff_id").val();
        var encode_page_open    = $("#encode_page_open").val();

        var template_id  = $("#email_tmplt_id").val();
        var days         = $("#email_days").val();
        var deadline     = $("#email_deadline").val();
        var remind_days  = $("#remind_days").val();

        //alert(days);return false;
        $.ajax({
            type: "POST",
            url: '/jobs/save-email-client-days',
            data: { 'template_id' : template_id, 'days' : days, 'deadline' : deadline, 'remind_days' : remind_days, 'service_id' : service_id },
            beforeSend : function(){
                $(".loader_show").html('<img src="/img/spinner.gif" />');
            },
            success : function(resp){
                if(resp > 0){
                    window.location = '/ch-annual-return/'+service_id+'/'+encode_page_open+'/'+encode_staff_id;
                }else{
                    $(".loader_show").html('There are some error..Please try again...');
                }
                
            }
        });
    });
    /* ################# Email Client in job section end ################### */
    
    
	
});//document end 

$(document).ready(function(){

//############## Get Client details portion start ################//
    $("#view_edit_company").hide();
    $('#getClientDetails').change(function() {
        
        var client_id = $(this).val();
      
        
        //alert(client_id);return false;
        if(client_id != "" ){
            $("#view_edit_company").show();
            
            $.ajax({
                type: "GET",
                //dataType: "json",
                url: '/client/client-details-by-client_id/'+client_id+"=ajax",
                //data: { 'client_id' : client_id },
                beforeSend: function() {
                    $(".show_client_details").html('<img src="/img/spinner.gif" />');
                    //return false;
                },
                success : function(resp){
                    if(resp != ""){
                        $(".show_client_details").html(resp);
                    }else{
                        $(".show_client_details").html("");
                    }
                }
            });
        }else{
            $("#view_edit_company").hide();
            $(".show_client_details").html("");
        }
    });
    //############## Get Client details portion end ################//

    //############## Go to view/edit details portion start ################//
    $('#view_edit_company').click(function() {
        var type_id = $(this).data('type');
        console.log(type_id);
        var client_id = $("#getClientDetails").val();
        if(client_id == ""){
            alert("Please select client first");
            //return false;
        }else{
            window.location.href = "/client/edit-org-client/"+client_id+"/"+type_id;
        }
    });
    //############## Go to view/edit details portion end ################//

    
});
$(document).ready(function(){
//############## Get Client details portion start ################//
    $('#getClientDetails').change(function() {
        var client_id = $(this).val();
        if(client_id != "" ){
            $.ajax({
                type: "GET",
                //dataType: "json",
                url: '/client/client-details-by-client_id/'+client_id+"=ajax",
                //data: { 'client_id' : client_id },
                success : function(resp){
                    if(resp != ""){
                        $(".show_client_details").html(resp);
                    }else{
                        $(".show_client_details").html("");
                    }
                }
            });
        }else{
            $(".show_client_details").html("");
        }
    });
    //############## Get Client details portion end ################//
    
});
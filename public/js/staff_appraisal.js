$(document).ready(function(){

    //############## View Staff Appraisal Table Start ################//
    $('.show_staff_appraisal').click(function() {
        $(".show_form_content").hide();
        $("#appraisal_div").toggle();
    });
    //############## View Staff Appraisal Table end ################//

    //############## View Staff Appraisal Table Start ################//
    $('.show_new_form').click(function() {
        //$("#appraisal_div").hide();
        $("#show_form_content").toggle();
    });
    //############## View Staff Appraisal Table end ################//

    $('.show_set_objective').click(function() {
        $(".review_last").hide();
        $(".set_objective").toggle();
    });

    $('.show_review_last').click(function() {
        $(".set_objective").hide();
        $(".review_last").toggle();
    });

    $('.show_identifying').click(function() {
        $(".performance_table").hide();
        $(".identifying_table").toggle();
    });

    $('.show_performance').click(function() {
        $(".identifying_table").hide();
        $(".performance_table").toggle();
    });

    
});
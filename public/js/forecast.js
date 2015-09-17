$(function() {
var cloneCount = 0;
   
   
 	
    $('.addnew_line').click(function() {
		
				//alert('AAAAAAAAAAAA');	
				
				
               // $(".dpick").datepicker("destroy");      
				
				
				
				var $newRow = $('#TemplateRow').clone(true);
			
            	//$newRow.find('#date_picker').val('');
			//	$newRow.find('.dpick').val('');
        		$newRow.find('#details').val('');
                $newRow.find('#date').val('');
				$newRow.find('#owner').val('');
				$newRow.find('#ammount').val('');
               
        		
				var noOfDivs = $('.makeCloneClass').length + 1;
				
                // $newRow.find('input[type="text"]').attr('id', 'dpick'+ noOfDivs);
			
				$('#BoxTable tr:last').after($newRow);
				//$(".dpick").datepicker({dateFormat: 'dd-mm-yy'});    
				return false;
			
	})
    	});
        
        
        $('.DeleteBoxRow').click(function() {
    
    //find the closest parent row and remove it
	var size = $(".DeleteBoxRow").size();
		if(size>1){
        	$(this).closest('tr').remove();
		}
    });
        
        

$(".forecasttext").keydown(function(event) {
    
        
		if ( event.keyCode == 46 || event.keyCode == 8 ) {

			// let it happen, don't do anything

		}

		else {
		  
			// Ensure that it is a number and stop the keypress

			 if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {

            event.preventDefault();

        }	

		}

	});
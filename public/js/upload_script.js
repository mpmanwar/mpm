$(document).ready(function (e) {
	
	// Function to preview image after validation
	$(function() {
		$("#practice_logo").change(function() {
			$("#error_image_type").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				$("#error_image_type").html("Please Select A valid Image File. Only jpeg, jpg and png Images type allowed");
				return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	
	function imageIsLoaded(e) {
		
		$('#image_preview').html( '<img src="'+e.target.result+'" class="browse_img">' );
		//$('#image_preview').attr('src', e.target.result);
	};

});
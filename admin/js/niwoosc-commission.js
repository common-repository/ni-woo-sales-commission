jQuery(document).ready(function($) {
	$( "#frm_niwoosc" ).submit(function( event ) {
			$(".niwoosc_ajax_content").html("Please wait..");
		$.ajax({
			url:niwoosc_ajax_object.niwoosc_ajaxurl,
			data: $(this).serialize(),
			success:function(data) {
				$(".niwoosc_ajax_content").html(data);
				//alert(JSON.stringify(data));
				
			},
			error: function(errorThrown){
				console.log(errorThrown);
				//alert("e");
			}
		}); 
		return false; 
	});
	
	
	$("#frm_niwoosc").trigger("submit");
});

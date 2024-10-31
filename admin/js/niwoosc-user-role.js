var obj;
var data = [];
jQuery(document).ready(function($) {
	
	$( document ).on("click","#btnTest",function( event ) {
		event.preventDefault();
		//alert("dasdas");
		
		jQuery(".niwoomcr_ajax_content_message").show();
			jQuery(".niwoomcr_ajax_content_message").html("Please wait..");
		 save_user_role_commission();
	});
	
}); 
/**
 * save user role commission
 *
 * @return void
 */ 
function save_user_role_commission(){
	data  =[];
	//alert("dasdas");
	jQuery('#tbl_user_role > tbody  > tr').each(function() {
			
		var niwoosc_user_role 	= "";
		var niwoosc_mode 		= "p";
		var niwoosc_commission 	= 0;
		
		
		niwoosc_user_role    = jQuery(this).find('._niwoosc_user_role').val();
		niwoosc_mode 		 = jQuery(this).find('._niwoosc_mode').val();
		niwoosc_commission   = jQuery(this).find('._niwoosc_commission').val();
		
		obj =  new Object();
		obj.niwoosc_user_role = niwoosc_user_role;
		obj.niwoosc_mode = niwoosc_mode;
		obj.niwoosc_commission = niwoosc_commission;
		
		data.push(obj);
		
		//alert(jQuery(this).find('._niwoosc_mode').val());
		//alert(jQuery(this).find('._niwoosc_user_role').val());
		//alert(jQuery(this).find('._niwoosc_commission').val());
	});
	
	var reqData = {};
	reqData["data"] 		= data;
	reqData["action"] 		= "niwoosc_ajax";
	reqData["sub_action"] 	= "save-user-role-commission";
	jQuery.ajax({
			url:niwoosc_ajax_object.niwoosc_ajaxurl,
			data: reqData,
		  	type: 'POST',
			success:function(response) {
				//jQuery(".niwoomcr_ajax_content").html(data);
				
				var Jdata  = JSON.parse(response);
				jQuery(".niwoomcr_ajax_content_message").show();
				if (Jdata.status =="1" ){
					jQuery(".niwoomcr_ajax_content_message").html(Jdata.message );
				}else{
					jQuery(".niwoomcr_ajax_content_message").html("Record Not saved");
					
				}
			},
			error: function(response){
				console.log(response);
					alert(JSON.stringify(response));
				//alert("e");
			}
		}); 
	
	
	
	
	//alert(JSON.stringify(data));
	
}
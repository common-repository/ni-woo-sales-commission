<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooSC_Hook' ) ) {
	include_once('niwoosc-function.php');
	class NiWooSC_Hook extends NiWooMCR_Function{
		var $niwoosc_constant = array();  
		function __construct($niwoosc_constant = array()){
			
			add_action('woocommerce_checkout_update_order_meta',    array($this,'woocommerce_checkout_update_order_meta'),	100,1);		
		}
		function woocommerce_checkout_update_order_meta($order_id){
			
			if(isset($this->niwoosc_constant['checkout_update'])){
				return true;
			}
			$this->niwoosc_constant['checkout_update'] = 'do_it';
			
			$user_id = get_current_user_id();
			$user_role = '';
			if ($user_id>0 && is_user_logged_in() ){
				
				$user = new WP_User( $user_id );
				//error_log(json_encode( $user) );
				if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
					
					
					foreach ( $user->roles as $role ){
						$user_role =  $role;
					}
					//error_log(json_encode($user_role ));	
				
					$commission = $this->get_user_role_commission($user_role );
					
					if (count($commission)>0){
						
						$niwoosc_mode = isset($commission[$user_role]->niwoosc_mode)?$commission[$user_role]->niwoosc_mode:'P';
						$niwoosc_commission = isset($commission[$user_role]->niwoosc_commission)?$commission[$user_role]->niwoosc_commission:0;
						
						update_post_meta( $order_id, '_niwoosc_mode', sanitize_text_field($niwoosc_mode) );	
						update_post_meta( $order_id, '_niwoosc_commission', sanitize_text_field($niwoosc_commission) );	
						
					}
					
					
				}
				
			}
			else{
				
				//error_log("dasdsadsad");	
			}
			
			
		}
	}
}
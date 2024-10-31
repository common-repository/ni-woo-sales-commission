<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooMCR_Function' ) ) {
	class NiWooMCR_Function {
		function __construct(){
		}
		function get_country_name($code){	
			$name = "";
			if (strlen($code)>0){
				$name= WC()->countries->countries[ $code];	
				$name  = isset($name) ? $name : $code;
			}
			return $name;
		}
		/*Start Request*/
		function get_request($name,$default = NULL,$set = false){
			if(isset($_REQUEST[$name])){
				$newRequest = $_REQUEST[$name];
				
				if(is_array($newRequest)){
					$newRequest = implode(",", $newRequest);
					//$newRequest = implode("','", $newRequest);
				}else{
					$newRequest = trim($newRequest);
				}
				
				return $newRequest;
			}else{
				
				return $default;
			}
		}
		/*End Request*/
		/*Start Print*/
		function prettyPrint($a, $t='pre') {echo "<$t>".print_r($a,1)."</$t>";}
		/*End Print*/
		
		/*Order Currency*/
		function get_order_currency(){
			global $wpdb;
			$query = "";
			$query .= " SELECT ";
			$query .= "	order_currency.meta_value as order_currency";
			$query .= "	FROM {$wpdb->prefix}posts as posts	";
			$query .= " LEFT JOIN  {$wpdb->prefix}postmeta as order_currency ON order_currency.post_id=posts.ID ";
			$query .= " WHERE 1 = 1";  
			$query .= " AND	posts.post_type ='shop_order' ";
			$query .= " AND order_currency.meta_key = '_order_currency'";	
			$query .= " GROUP BY order_currency.meta_value";
			
			$rows = $wpdb->get_results( $query );
			$data = array();
			foreach($rows as $key=>$value){
				$data [$value->order_currency]  =$value->order_currency;
			}
			return $data;
		}
		/*End Order Currency*/
		
		/*Order Country*/
		function get_order_country(){
			global $wpdb;
			$query = "";
			$query .= " SELECT ";
			$query .= "	billing_country.meta_value as billing_country";
			$query .= "	FROM {$wpdb->prefix}posts as posts	";
			$query .= "  LEFT JOIN  {$wpdb->prefix}postmeta as billing_country ON billing_country.post_id=posts.ID ";
			$query .= " WHERE 1 = 1";  
			$query .= " AND	posts.post_type ='shop_order' ";
			$query .= " AND billing_country.meta_key = '_billing_country'";		
			$query .= " GROUP BY  billing_country.meta_value";
			
			$rows = $wpdb->get_results( $query );
			$data = array();
			foreach($rows as $key=>$value){
				$data [$value->billing_country]  =$value->billing_country;
			}
			return $data;
		}
		/*End Order country*/
		
		/*=================== niwoosc =================*/
		
		/**
		 * Get user role list
		 *
		 * @return roles
		 */ 
		function get_user_role(){
			global $wp_roles;
			$roles = $wp_roles->get_names();
		
			return $roles;
		}
		/**
		 * Get commission mode fixed or percentage
		 *
		 * @return mode
		 */ 
		function get_commission_mode(){
			$mode = array();
			
			$mode["p"] = __("Percentage", 'niwoosc');
			$mode["f"] = __("Fixed", 'niwoosc');
			
			return  apply_filters('niwoosc_commission_mode', $mode );
		}
		/**
		 * Get Commission Full Name
		 *
		 * @return name
		 */ 
		function get_commission_full_name($mode){
			
			$_mode = $this-> get_commission_mode();
			
			return isset($_mode[$mode])?$_mode[$mode]:'';
			
		}
		/**
		 * Get user role commission
		 *
		 * @user_role option parameter
		 *
		 * @return rows
		 */ 
		function get_user_role_commission($user_role = NULL){
			global $wpdb;
			$new_rows =array();
			$table_user_role_commission =  $wpdb->prefix.'niwoosc_user_role_commission';
			$query  = '';
			$query  .= 'SELECT * FROM ' .  $table_user_role_commission;  
			$query .= ' WHERE 1 = 1 ';
			
			if ($user_role ){
				$query .= 'AND  niwoosc_user_role =  "'.  $user_role .'"';
			}
			
			$rows = $wpdb->get_results($query);
			
			foreach($rows as $key=>$value ){
				$new_rows[$value->niwoosc_user_role] = 	$value;
			}
			
			return $new_rows;
		}
		/**
		 * Get user role commission
		 *
		 * @user_role option parameter
		 *
		 * @return rows
		 */ 
		 function calculate_commission($mode = 'P', $total= 0, $commission_value=0){
			 $total_commission  = 0;
			 
			 if ( strtoupper($mode) =='P'){
				 //error_log("if" . $mode ." ". $total ." ". $commission_value );
				 $total_commission = ($total*$commission_value)/100;
			 }else{
				// error_log("else" . $mode ." ". $total ." ". $commission_value );
				  $total_commission  = $commission_value;
			 }
			 
			 return $total_commission;
		 }
		
	} 
}
?>
<?php
/*
Plugin Name: Ni Sales Commission For WooCommerce 
Description: Ni Sales Commission For WooCommerce plug-in provides the option to give the commission on sales order.
Author: 	 anzia
Version: 	 1.2.4
Author URI:  http://naziinfotech.com/
Plugin URI:  https://wordpress.org/plugins/ni-woo-sales-commission/
License:	 GPLv3 or later
License URI: http://www.gnu.org/licenses/agpl-3.0.html
Text Domain: niwoosc
Domain Path: /languages/
Requires at least: 4.7
Tested up to: 6.4.2
WC requires at least: 3.0.0
WC tested up to: 8.4.0
Last Updated Date: 17-December-2023
Requires PHP: 7.0

*/
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Sales_Commission_For_WooCommerce' ) ) { 
	class Ni_Sales_Commission_For_WooCommerce {
		function __construct(){
			
			//add_action( 'activated_plugin', 'cyb_activation_redirect' );
			
			add_action( 'activated_plugin',  array(&$this,'niwoosc_activation_redirect' ));
			add_action( 'plugins_loaded',  array(&$this,'plugins_loaded') );
			include_once('includes/niwoosc-core.php'); 
			$obj = new NiWooSC_Core();
		}
		function plugins_loaded(){
			load_plugin_textdomain('niwoosc', WP_PLUGIN_DIR.'/ni-woo-sales-commission/languages','ni-woo-sales-commission/languages');
				include_once('includes/niwoosc-commission-meta-box.php'); 
			$NiWooSC_Commission_Meta_Box = new NiWooSC_Commission_Meta_Box();
		 }	
		static   function niwoosc_activation_redirect($plugin){
			 if( $plugin == plugin_basename( __FILE__ ) ) {
				exit( wp_redirect( admin_url( 'admin.php?page=niwoosc-user-role' ) ) );
			}
		}
		static function  activation(){
			global $wpdb;
			$prefix 				= $wpdb->prefix;
			$niwoosc_user_role_commission 			= $wpdb->prefix."niwoosc_user_role_commission";
			
			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
			if($wpdb->get_var("SHOW TABLES LIKE '$niwoosc_user_role_commission'") != $niwoosc_user_role_commission) {
					$sql = "CREATE TABLE IF NOT EXISTS `{$niwoosc_user_role_commission}` (
							 `ID` bigint(20) NOT NULL AUTO_INCREMENT,
							  `niwoosc_user_role` varchar(100) NOT NULL,
							  `niwoosc_mode` varchar(1) NOT NULL,
							  `niwoosc_commission` decimal(10,2) NOT NULL,
							  PRIMARY KEY (`ID`)
					) $charset_collate;";					
					dbDelta( $sql );
			}
			
			
		}
		function create_tables(){
			
		}
	}
	register_activation_hook( __FILE__, array('Ni_Sales_Commission_For_WooCommerce','activation'));	
	$obj_niwoosc =  new Ni_Sales_Commission_For_WooCommerce();
}
?>
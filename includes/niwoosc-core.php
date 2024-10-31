<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooMCR_Core' ) ) { 
	include_once('niwoosc-function.php');
	class NiWooSC_Core extends NiWooMCR_Function{
		function __construct(){
			
			add_action( 'admin_menu',  array(&$this,'admin_menu' ));
			add_action( 'admin_enqueue_scripts',  array(&$this,'admin_enqueue_scripts' ));
			add_action( 'wp_ajax_niwoosc_ajax',  array(&$this,'niwoosc_ajax' )); /*used in form field name="action" value="my_action"*/
			//add_filter( 'gettext', array($this, 'get_text'),20,3);
			$this->add_niwoosc_hook();
		}
		function get_text($translated_text, $text, $domain){
			if($domain == 'niwoosc'){
				return '['.$translated_text.']';
			}		
			return $translated_text;
		}
		function add_niwoosc_hook(){
			include_once("niwoosc-hook.php");
			$niwooschook =  new NiWooSC_Hook();
		}
		
		/**
		*Report ajax
		*/
		function niwoosc_ajax(){
			//echo json_encode($_REQUEST);
			//die;
			$sub_action =	$this->get_request("sub_action");
			if ($sub_action  =="niwoosc-currency-report"){
				include_once("niwoosc-currency-report.php");
				$obj = new NiWooMCR_Currency_Report();
				$obj->get_ajax_action();	
			}
			if ($sub_action  =="niwoosc-order-report"){
				include_once("niwoosc-order-report.php");
				$obj = new NiWooMCR_Order_Report();
				$obj->get_ajax_action();	
			}
			
			/*Start niwoosc*/
			
			if ($sub_action  =="niwoosc-user-role"){
				include_once("niwoosc-user-role.php");
				$obj = new NiWooSC_User_Role();
				$obj->get_ajax_action();	
			}
			if ($sub_action  =="save-user-role-commission"){
				include_once("niwoosc-user-role.php");
				$obj = new NiWooSC_User_Role();
				$obj->save_user_role_commission();	
			}
			
			if ($sub_action  =="niwoosc-commission-report"){
				include_once("niwoosc-commission-report.php");
				$obj = new NiWooSC_Commission_Report();
				$obj->get_ajax_action();	
			}
			
			/*End*/
			//niwoomcr-order-report
			//echo json_encode($_REQUEST);
			
			
			die;
		}
		function admin_enqueue_scripts(){
			$page =	$this->get_request("page");
			if ($page =="niwoosc-currency-report" || $page =="niwoosc-order-report" || $page =="niwoosc-dashboard" || $page =="niwoosc-user-role" 
			|| $page =="niwoosc-other-plugin"
			|| $page =="niwoosc-commission-report"){
				wp_enqueue_script( 'niwoosc-script', plugins_url( '../admin/js/niwoosc-commission.js', __FILE__ ), array('jquery') );	
			
				wp_enqueue_script( 'niwoosc-script', plugins_url( '../admin/js/script.js', __FILE__ ), array('jquery') );	
				wp_localize_script( 'niwoosc-script','niwoosc_ajax_object',array('niwoosc_ajaxurl'=>admin_url('admin-ajax.php')));
				
				
				wp_register_style('niwoosc-bootstrap-css', plugins_url('../admin/css/lib/bootstrap.min.css', __FILE__ ));
		 		wp_enqueue_style('niwoosc-bootstrap-css' );
				
				
				wp_register_style('niwoosc-font-awesome-css', plugins_url('../admin/css/font-awesome.min.css', __FILE__ ));
		 		wp_enqueue_style('niwoosc-font-awesome-css' );
				
				
				wp_register_style('niwoosc-currency-report-css', plugins_url('../admin/css/niwoomcr-currency-report.css', __FILE__ ));
		 		wp_enqueue_style('niwoosc-currency-report-css' );
				
				wp_enqueue_script('niwoosc-bootstrap-script', plugins_url( '../admin/js/lib/bootstrap.min.js', __FILE__ ) );
				
				if ($page == "niwoosc-user-role"){
					wp_enqueue_script( 'niwoosc-user-role-script', plugins_url( '../admin/js/niwoosc-user-role.js', __FILE__ ), array('jquery') );	
				}
				
			}
		}
		/*Add Menu Page*/
		function admin_menu(){
			add_menu_page(__(  'Sales Commission', 'niwoosc')
			,__(  'Sales Commission', 'niwoosc')
			,'manage_options'
			,'niwoosc-dashboard'
			,array(&$this,'add_page')
			,'dashicons-chart-pie'
			,59.85);
			
			add_submenu_page('niwoosc-dashboard'
			,__( 'Dashboard', 'niwoosc' )
			,__( 'Dashboard', 'niwoosc' )
			,'manage_options'
			,'niwoosc-dashboard' 
			,array(&$this,'add_page'));
			
		
			add_submenu_page('niwoosc-dashboard'
			,__( 'Order Report', 'niwoosc' )
			,__( 'Order Report', 'niwoosc' )
			, 'manage_options', 'niwoosc-order-report' 
			, array(&$this,'add_page'));
			
		

			
			
			add_submenu_page('niwoosc-dashboard'
			,__( 'Commission Report', 'niwoosc' )
			,__( 'Commission Report', 'niwoosc' )
			, 'manage_options', 'niwoosc-commission-report' 
			, array(&$this,'add_page'));
			
			
						
			add_submenu_page('niwoosc-dashboard'
			,__( 'User Role', 'niwoosc' )
			,__( 'User Role', 'niwoosc' )
			, 'manage_options', 'niwoosc-user-role' 
			, array(&$this,'add_page'));
			
			add_submenu_page('niwoosc-dashboard'
			,__( 'Other Plugins', 'niwoosc' )
			,__( 'Other Plugins', 'niwoosc' )
			, 'manage_options', 'niwoosc-other-plugin' 
			, array(&$this,'add_page'));
			
		}
		function add_page(){
			$page =	$this->get_request("page");
		
			$page =	$this->get_request("page");
			if ($page =="niwoosc-dashboard"){
				include_once("niwoosc-dashboard.php");
				$obj =  new NiWooMCR_Dashboard();
				$obj->get_page_init();
			}
			if ($page =="niwoosc-order-report"){
				include_once("niwoosc-order-report.php");
				$obj = new NiWooMCR_Order_Report();
				$obj->get_page_init();
			}
			if ($page =="niwoosc-order-product-report"){
				include_once("niwoosc-order-product-report.php");
				$obj = new NiWooMCR_Order_Product_Report();
				$obj->get_page_init();
			}
			if ($page =="niwoosc-currency-report"){
				include_once("niwoosc-currency-report.php");
				$obj = new NiWooMCR_Currency_Report();
				$obj->get_page_init();
			}
			
			/*start niwoosc*/
			if ($page =="niwoosc-user-role"){
				include_once("niwoosc-user-role.php");
				$obj = new NiWooSC_User_Role();
				$obj->get_page_init();
			}
			
			if ($page =="niwoosc-commission-report"){
				include_once("niwoosc-commission-report.php");
				$obj = new NiWooSC_Commission_Report();
				$obj->get_page_init();
			}
			if ($page =="niwoosc-other-plugin"){
				include_once("niwoosc-other-plugin.php");
				$obj = new NiWooMCR_Other_Plugin();
				$obj->get_page_init();
			}
			
			/*End */
			
			
		}
	}
}
?>
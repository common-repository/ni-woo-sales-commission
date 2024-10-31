<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooMCR_Dashboard' ) ) {
	include_once('niwoosc-function.php');
	class NiWooMCR_Dashboard  extends NiWooMCR_Function{
		function __construct(){
		
		}
		function get_page_init(){
		$today 			 				 = date_i18n("Y-m-d");
		$last_order_date 				 = $this->get_last_order_date();
		$last_order_string 				 = $this->time_elapsed_string($last_order_date);
		$status		 	 				 = $this->get_order_status($today ,$today,"wc-completed" );
	    $today_completed_order_count 	 = $this->get_order_count($today , $today, "wc-completed"  );
		
		$today_total_customer 			 = $this->get_total_today_order_customer('custom',false,$today,$today);
		$today_total_guest_customer 	 = $this->get_total_today_order_customer('custom',true,$today,$today);
		
		//$this->prettyPrint($status	);
		  
		?>
       
      	<div class="container" id="niwoomcr">
       		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 4"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                   <div class="card bg-rgba-green-slight">
                            <div class="card-header bg-rgba-salmon-strong"> <?php _e('Monitor your sales and grow your online business with naziinfotech plugins', 'niwoopvt'); ?> </div>
                            <div class="card-body">
                                <h2 class="card-title text-center color-rgba-salmon-strong">Buy Ni Display Product Variation Table Pro $34.00</h2>
                               	<div class="row" style="font-size:16px">
                                	<div  class="col-md-6">
                                    	  <span class="font-weight-bold color-rgba-black-strong">Show variation product table on product detail page</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Show the variation dropdown on product page and category page</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Show the variation product on shop page and category page</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Add to cart bulk quantity on product detail page in variation table</span>	<br />					<span class="font-weight-bold color-rgba-black-strong">Set the default quantity in variation table</span><br />
                                    </div>
                                   
                                    <div  class="col-md-3">
                                    	
                                        <span class="font-weight-bold color-rgba-black-strong">Change the display order for table variation columns</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Set columns of product variation table</span>	<br />	
                                        
                                    </div>
                                   <div  class="col-md-3">
                                   		<h5> <span class="font-weight-bold" >Coupon Code: <span class="text-warning">ni10</span>  Get 10% OFF</span></h5> 
                                        <span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                                        <span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                                   </div>
                                </div>
                                
                                <div class="text-center">
                                    <a href="http://demo.naziinfotech.com/product/hoodie/" class="btn btn-rgba-salmon-strong btn-lg" target="_blank">View Demo</a>
                                    <a href="http://naziinfotech.com/?product=ni-woocommerce-sales-report-pro" target="_blank" class="btn btn-rgba-salmon-strong btn-lg">Buy Now</a>
                                </div>
                                <br />
                                <br />
                                
                                 
                           </div>
                        </div>
                </div>
                <div class="carousel-item">
                        <div class="card bg-rgba-green-slight">
                            <div class="card-header bg-rgba-green-strong"> <?php _e('Monitor your sales and grow your online business with naziinfotech plugins', 'niwoopvt'); ?> </div>
                            <div class="card-body">
                                <h2 class="card-title text-center color-rgba-green-strong">Buy Ni WooCommerce Sales Report Pro $24.00</h2>
                               	<div class="row" style="font-size:16px">
                                	<div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Dashboard order Summary</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Order List - Display order list</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Order Detail - Display Product information</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Sold Product variation Report</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Customer Sales Report</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Payment Gateway Sales Report</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Country Sales Report</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Coupon Sales Report</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Order Export To CSV</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Custom Date Filter, Start Date and End Date</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Ajax pagination </span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Easy to use </span>	<br />	
                                    </div>
                                   <div  class="col-md-3">
                                   		<h5> <span class="font-weight-bold" >Coupon Code: <span class="text-warning">ni10</span>  Get 10% OFF</span></h5> 
                                        <span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                                        <span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                                   </div>
                                </div>
                                <div class="text-center">
                                    <a href="http://demo.naziinfotech.com?demo_login=woo_sales_report" class="btn btn-green-strong btn-lg" target="_blank">View Demo</a>
                                    <a href="http://naziinfotech.com/?product=ni-woocommerce-sales-report-pro" target="_blank" class="btn btn-green-strong btn-lg">Buy Now</a>
                                </div>
                                  <br />
                                <br />
                           </div>
                        </div>
                    </div>
                <div class="carousel-item">
                        <div class="card bg-rgba-cyan-slight">
                            <div class="card-header bg-rgba-cyan-strong"> <?php _e('Monitor your sales and grow your online business with naziinfotech plugins', 'niwoopvt'); ?> </div>
                            <div class="card-body">
                                <h2 class="card-title text-center color-rgba-cyan-strong">Buy Ni WooCommerce cost of goods Pro @ $34.00</h2>


                               	<div class="row" style="font-size:16px">
                                	<div  class="col-md-3">
                                    	 <span class="font-weight-bold color-rgba-black-strong">Sales Profit Report</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Dashboard order Summary</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Daily profit Report</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Monthly profit Report</span>	<br />	
                                       
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Add Cost of goods for simple product</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Add Cost of goods for variation product</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Top Profit Product</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Stock valuation</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Order Export To CSV</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Custom Date Filter, Start Date and End Date</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Ajax pagination </span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Easy to use </span>	<br />	
                                    </div>
                                   <div  class="col-md-3">
                                   		<h5> <span class="font-weight-bold" >Coupon Code: <span class="text-warning">ni10</span>  Get 10% OFF</span></h5> 
                                        <span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                                        <span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                                   </div>
                                </div>
                                <div class="text-center">
                                    <a href="http://demo.naziinfotech.com/?demo_login=woo_cost_of_goods" class="btn btn-rgba-cyan-strong btn-lg" target="_blank">View Demo</a>
                                    <a href="http://naziinfotech.com/product/ni-woocommerce-cost-of-good-pro/" target="_blank" class="btn btn-rgba-cyan-strong btn-lg">Buy Now</a>
                                </div>
                                <br />
                                <br />  
                           </div>
                        </div>
                    </div>
                <div class="carousel-item">
                        <div class="card bg-rgba-indigo-slight">
                            <div class="card-header bg-rgba-indigo-strong"> <?php _e('Monitor your sales and grow your online business with naziinfotech plugins', 'niwoopvt'); ?> </div>
                            <div class="card-body">
                                <h2 class="card-title text-center color-rgba-indigo-strong"> <?php _e('Buy Ni WooCommerce Product Enquiry Pro @ $24.00', 'niwoopvt'); ?> </h2>
                               	<div class="row" style="font-size:16px">
                                	<div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong"><?php esc_html_e('Dashboard Summary (Today, Total Enquiry)', 'niwoopvt'); ?></span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Monthly Enquiry Graph</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Recent Enquiry</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Last Enquiry Date</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Enquiry List</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Enquiry Export</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Top Enquiry Product</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Top Enquiry Visitor</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Order Export To CSV</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Custom Date Filter, Start Date and End Date</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Ajax pagination </span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Easy to use </span>	<br />	
                                    </div>
                                   <div  class="col-md-3">
                                   		<h5> <span class="font-weight-bold" >Coupon Code: <span class="text-warning">ni10</span>  Get 10% OFF</span></h5> 
                                        <span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                                        <span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                                   </div>
                                </div>
                                <div class="text-center">
                                    <a href="http://demo.naziinfotech.com/enquiry-demo/" class="btn btn-rgba-indigo-strong btn-lg" target="_blank">View Demo</a>
                                    <a href="http://naziinfotech.com/product/ni-woocommerce-product-enquiry-pro/" target="_blank" class="btn btn-rgba-indigo-strong btn-lg">Buy Now</a>
                                </div>
                                  <br />
                                <br />
                           </div>
                        </div>
                    </div>
                <div class="carousel-item">
                        <div class="card bg-rgba-blue-slight">
                            <div class="card-header bg-rgba-blue-strong"> <?php _e('Monitor your sales and grow your online business with naziinfotech plugins', 'niwoopvt'); ?> </div>
                            <div class="card-body">
                                <h2 class="card-title text-center color-rgba-blue-strong"> <?php _e('Ni One Page Inventory Management System For WooCommerce', 'niwoopvt'); ?> </h2>
                               	<div class="row" style="font-size:16px">
                                	<div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong"><?php esc_html_e('Dashboard Summary stock status', 'niwoopvt'); ?></span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Manage Purchase order</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Multi location inventory management</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Stock Center</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Purchase History</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Mange product</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Vendor management</span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Product Vendor</span>	<br />	
                                    </div>
                                    <div  class="col-md-3">
                                    	<span class="font-weight-bold color-rgba-black-strong">Order Export To CSV</span><br />
                                        <span class="font-weight-bold color-rgba-black-strong">Custom Date Filter, Start Date and End Date</span>	<br />
                                        <span class="font-weight-bold color-rgba-black-strong">Ajax pagination </span>	<br />	
                                        <span class="font-weight-bold color-rgba-black-strong">Easy to use </span>	<br />	
                                    </div>
                                   <div  class="col-md-3">
                                   		<span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                                        <span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                                   </div>
                                </div>
                                <div class="text-center">
                                    <a href="https://wordpress.org/plugins/ni-one-page-inventory-management-system-for-woocommerce/" class="btn btn-rgba-blue-strong btn-lg" target="_blank">View</a>
                                    <a href="https://downloads.wordpress.org/plugin/ni-one-page-inventory-management-system-for-woocommerce.zip" target="_blank" class="btn btn-rgba-blue-strong btn-lg">Download</a>
                                </div>
                                  <br />
                                <br />
                           </div>
                        </div>
                    </div>        
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            
         <div class="row" >
             	<div class="col-md-12"  style="padding:0px;">
                	<div class="card">
                      <div class="card-body">
                      <h5 style="text-align:center"> Buy <span class="text-success fs-2" >Ni WooCommerce Sales Agent And Sales Commission</span>  for more reports and exports</h5>
                      <h5> <span class="font-weight-bold" >Coupon Code: <span class="text-warning">ni10</span>  Get 10% OFF</span></h5> 
                    	<span> <span class="font-weight-bold" >Email at:</span><a href="mailto:support@naziinfotech.com" target="_blank">support@naziinfotech.com</a></span><br />
                    	<span> <span class="font-weight-bold" >Website: </span><a href="http://naziinfotech.com/" target="_blank">www.naziinfotech.com</a></span>	<br />	
                        
                        <br />
                                    <br />
                                    <a href="http://demo.naziinfotech.com/?demo_login=woo_agent_commission" class="btn btn-green-strong btn-lg" target="_blank">View Demo</a>
                                    <a href="http://naziinfotech.com/product/ni-woocommerce-sales-agent-and-sales-commission/" target="_blank" class="btn btn-green-strong btn-lg">Buy Now</a>
             
                      </div>
                    </div>
                </div>
            </div>   
        </div>
        <div class="container" id="niwoomcr-dashboard">
        	
        	
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block p-2">
                            <h6 class="m-b-20"><?php esc_html_e('Last Orders Received', 'niwoosc'); ?> </h6>
                            <h2 class="text-right">
                                <i class="fa fa-cart-plus f-left"></i>
                                <span>&nbsp;&nbsp;</span>
                            </h2>
                            <p class="m-b-0"> &nbsp;&nbsp;
                                <span class="f-right"><?php  echo $last_order_string; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block p-2">
                            <h6 class="m-b-20"><?php esc_html_e('Today Orders Received', 'niwoosc'); ?> </h6>
                            <h2 class="text-right">
                                <i class="fa fa-rocket f-left"></i>
                                <span><?php echo  $today_completed_order_count; ?></span>
                            </h2>
                            <p class="m-b-0"><?php esc_html_e('Completed Orders', 'niwoosc'); ?> 
                                <span class="f-right"> &nbsp;&nbsp;</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block p-2">
                            <h6 class="m-b-20"><?php esc_html_e('Today registered Customer', 'niwoosc'); ?> </h6>
                            <h2 class="text-right">
                                <i class="fa fa-refresh f-left"></i>
                                <span>&nbsp;&nbsp;</span>
                            </h2>
                            <p class="m-b-0">&nbsp;&nbsp;
                                <span class="f-right"><?php echo $today_total_customer; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block p-2">
                            <h6 class="m-b-20"><?php esc_html_e('Today GUEST Customer', 'niwoosc'); ?> </h6>
                            <h2 class="text-right">
                                <i class="fa fa-credit-card f-left"></i>
                                <span>&nbsp;&nbsp;</span>
                            </h2>
                            <p class="m-b-0">&nbsp;&nbsp;
                                <span class="f-right"><?php  echo $today_total_guest_customer ; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
        <?php
		}
		function get_order_count($start_date = NULL, $end_date =NULL, $order_status){
			global $wpdb;
			$query = "";
			$query .= " SELECT ";
			$query .= "	count(*)as 'order_count'";
			$query .= "	FROM {$wpdb->prefix}posts as posts	";
			$query .= " WHERE 1 = 1";  
			if ($start_date &&  $end_date)
			$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}'";
			$query .= " AND	posts.post_type ='shop_order' ";
			
			if ($order_status !=NULL){
				$query .= " AND	posts.post_status IN ('{$order_status}')";
			}
			
			
			$query .= " ORDER BY posts.post_date DESC";
			
			
			
			return $rows = $wpdb->get_var( $query );	
		}
		function get_last_order_date(){
			global $wpdb;
			$query = "";
			$query .= " SELECT ";
			$query .= "	posts.post_date as order_date";
			$query .= "	FROM {$wpdb->prefix}posts as posts	";
			$query .= " WHERE 1 = 1";  
			$query .= " AND	posts.post_type ='shop_order' ";
			
			
			
			
			$query .= " ORDER BY posts.post_date DESC";
			
			return $rows = $wpdb->get_var( $query );
			
		}
		function get_order_status($start_date, $end_date,$order_status =NULL){
			global $wpdb;
			$query = "";
			$query .= " SELECT ";
			$query .= "	posts.post_status as order_status";
			
			$query .= "	,SUM(ROUND(order_total.meta_value,2)) as order_total";
			
			$query .= "	,COUNT(*) as order_count";
			
			
			$query .= "	FROM {$wpdb->prefix}posts as posts	";
			
			$query .= "  LEFT JOIN  {$wpdb->prefix}postmeta as order_total ON order_total.post_id=posts.ID ";
			
			$query .= " WHERE 1 = 1";  
			$query .= " AND	posts.post_type ='shop_order' ";
			
			$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}'";
			$query .= " AND order_total.meta_key = '_order_total'";	
			
			if ($order_status !=NULL){
				$query .= " AND	posts.post_status IN ('{$order_status}')";
			}
			
			//$query .= " GROUP BY posts.post_status ";
			
			//$query .= " GROUP BY posts.post_status ";
			
			return $rows = $wpdb->get_results( $query );
			
		}
		function get_total_today_order_customer($type = 'total', $guest_user = false,$start_date = '',$end_date = ''){
			global $wpdb;
		
			
			$query = "SELECT ";
			if(!$guest_user){
				$query .= " users.ID, ";
			}else{
				$query .= " email.meta_value AS  billing_email,  ";
			}
			$query .= " posts.post_date
			FROM {$wpdb->prefix}posts as posts
			LEFT JOIN  {$wpdb->prefix}postmeta as postmeta ON postmeta.post_id = posts.ID";
			
			if(!$guest_user){
				$query .= " LEFT JOIN  {$wpdb->prefix}users as users ON users.ID = postmeta.meta_value";
			}else{
				$query .= " LEFT JOIN  {$wpdb->prefix}postmeta as email ON email.post_id = posts.ID";
			}
			
			$query .= " WHERE  posts.post_type = 'shop_order'";
			
			$query .= " AND postmeta.meta_key = '_customer_user'";
			
			if($guest_user){
				$query .= " AND postmeta.meta_value = 0";
				
				if($type == "today")		{$query .= " AND DATE(posts.post_date) = '{$this->today}'";}
				if($type == "yesterday")	{$query .= " AND DATE(posts.post_date) = '{$this->yesterday}'";}
				if($type == "custom")		{
						$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}' ";
				}
				
				$query .= " AND email.meta_key = '_billing_email'";
				
				$query .= " AND LENGTH(email.meta_value)>0";
			}else{
				$query .= " AND postmeta.meta_value > 0";
				if($type == "today")		{$query .= " AND DATE(users.user_registered) = '{$this->today}'";}
				if($type == "yesterday")	{$query .= " AND DATE(users.user_registered) = '{$this->yesterday}'";}
				if($type == "custom")		{
						$query .= " AND  date_format( users.user_registered, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}' ";
				}
				
				
			}
			
			if(!$guest_user){
				$query .= " GROUP BY  users.ID";
			}else{
				$query .= " GROUP BY  email.meta_value";		
			}
			
			$query .= " ORDER BY posts.post_date desc";
			
			
			$user =  $wpdb->get_results($query);
			
		
			
			$count = count($user);
			return $count;
		}
		function time_elapsed_string($datetime, $full = false) {
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => __('year','niwoosc'),
				'm' => __('month','niwoosc'),
				'w' => __('week','niwoosc'),
				'd' => __('day','niwoosc'),
				'h' => __('hour','niwoosc'),
				'i' => __('minute','niwoosc'),
				's' => __('second','niwoosc'),
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) .  __(' ago','niwoosc')  : __( 'just now','niwoosc') ;
		}
	} 
}
?>
<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooMCR_Order_Report' ) ) {
	include_once('niwoosc-function.php');
	class NiWooMCR_Order_Report extends NiWooMCR_Function{
		function __construct(){
		}
		function get_page_init(){
		$currency   = $this->get_order_currency();
		?>
        <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <h6> <?php esc_html_e('Search Order Report', 'niwoosc'); ?></h6>
              </div>
              <div class="card-body">
            <form name="frm_niwoosc" id="frm_niwoosc">
                              <div class="form-group row">
                                <label for="order_period" class="col-sm-2 col-form-label"><?php _e('Order Period', 'niwoosc'); ?></label>
                                <div class="col-sm-4">
                                <select name="order_period"  id="order_period" class="form-control" >
                                      <option value="today"><?php _e('Today', 'niwoosc'); ?></option>
                                      <option value="yesterday"><?php _e('Yesterday', 'niwoosc'); ?></option>
                                      <option value="last_7_days"><?php _e('Last 7 days', 'niwoosc'); ?></option>
                                      <option value="last_10_days"><?php _e('Last 10 days', 'niwoosc'); ?></option>
                                       <option value="last_15_days"><?php _e('Last 15 days', 'niwoosc'); ?></option>
                                      <option value="last_30_days"><?php _e('Last 30 days', 'niwoosc'); ?></option>
                                      <option value="last_60_days"><?php _e('Last 60 days', 'niwoosc'); ?></option>
                                      <option value="this_year"><?php _e('This year', 'niwoosc'); ?></option>
                                </select>
                                </div>
                                
                               
                                </div>
                              
                              <div class="form-group row" >
                               <div class="col-sm-12" style="text-align:right">
                                 <input type="submit" class="btn btn-primary" value="<?php esc_html_e('Search', 'niwoosc'); ?>"   />
                               </div>
                                 
                                
                              </div>
                              
                              <input type="hidden" name="sub_action" id="sub_action" value="niwoosc-order-report" />
                              <input type="hidden" name="action" id="action" value="niwoosc_ajax" />
                            
                            </form>
              </div>
            </div>
 			
            <div class="niwoosc_ajax_content" style="padding-top:20px;"></div>
		</div>
        <?php			
		}
		function get_order_data(){
			$rows  = $this->get_query();
			foreach($rows  as $row_key=>$row_value ){
				$order_id =$row_value->order_id;
				$order_detail = $this->get_order_detail($order_id);
				foreach($order_detail as $dkey => $dvalue){
							$rows[$row_key]->$dkey =$dvalue;
						
				}
				//$rows[$row_key]->qty =  isset($rows[$key]->niwoosc_mode) ? $rows[$key]->niwoosc_mode : 0;
			}
			foreach($rows  as $row_key=>$row_value ){
				
				$commission_mode = isset($rows[$row_key]->niwoosc_mode) ? $rows[$row_key]->niwoosc_mode: "";
				$commission = isset($rows[$row_key]->niwoosc_commission) ? $rows[$row_key]->niwoosc_commission: "";
				$order_total = isset($rows[$row_key]->order_total) ? $rows[$row_key]->order_total: "";
				
				$rows[$row_key]->commission_mode =   $this->get_commission_full_name( 	$commission_mode );
				$rows[ $row_key]->commission_total =   $this->calculate_commission($commission_mode ,$order_total,	$commission);
			}
			
			//$this->prettyPrint($rows);
			return $rows;
		}
		function get_ajax_action(){
			//echo json_encode($_REQUEST);
			$this->get_report_table();
		}
		function get_report_table(){
			$columns  		= $this->get_columns();
			$rows			= $this->get_order_data();
			$td_vale  = "";
			$td_class = ""; 
			?>
            <div class="table-responsive">
            	<table class="table  table-bordered">
           		<thead class="thead-light">
                	<tr>
                	<?php foreach($columns as $key=>$value): ?>
                    	<th><?php echo $value; ?></th>
                    <?php endforeach; ?>
                	</tr>
                </thead>
                <tbody>
                 <?php if (count($rows) == 0):  ?>
                 <tr>
                 	<td colspan="<?php echo count($columns); ?>"><?php esc_html_e('no order found', 'niwoosc'); ?></td>
                </tr>
				<?php else: ?>
                	<?php foreach($rows  as $row_key=>$row_value): ?>
                  		<tr>
                  	 <?php foreach($columns  as $col_key=>$col_value): ?>
                     	<?php switch($col_key): case 1: break; ?>
                        
                          <?php case "billing_country": ?>
                          <?php $td_vale = $this->get_country_name($row_value->billing_country) ;  ?>
                          <?php break; ?>
                        
                         <?php case "order_status": ?>	
                         <?php $td_vale =  ucfirst ( str_replace("wc-","", $row_value->order_status));   ?>
                         <?php break; ?>
                        
                         <?php default; ?>
                         <?php $td_vale = isset($row_value->$col_key)?$row_value->$col_key:""; ?>
                        <?php endswitch; ?>
                     <td <?php echo $td_class; ?>><?php echo $td_vale ;  ?></td>
                     <?php endforeach; ?>
                    
                  </tr>
                	 <?php endforeach; ?>	
                <?php endif; ?>
                 	
                 
                </tbody>
            </table>
            </div>
            
            <?php	
		}
		function get_query($type='rows'){
			global $wpdb;
			$today 			= date_i18n("Y-m-d");
			$order_period	= $this->get_request("order_period");
		
			
			$query  = "";
			$query = "SELECT ";
			$query .= "	posts.ID as order_id ";
			$query .= "		,posts.post_status as order_status ";
			$query .= "		, date_format( posts.post_date, '%Y-%m-%d') as order_date  ";
			$query .= "		FROM {$wpdb->prefix}posts as posts	";
			
			$query .= "  WHERE 1 = 1";  
			$query .= " AND	posts.post_type ='shop_order' ";
			
			
			
			switch ($order_period) {
					case "today":
						$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$today}' AND '{$today}'";
						break;
					case "yesterday":
						$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') = date_format( DATE_SUB(CURDATE(), INTERVAL 1 DAY), '%Y-%m-%d')";
						break;
					case "last_7_days":
						$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN date_format(DATE_SUB(CURDATE(), INTERVAL 7 DAY), '%Y-%m-%d') AND   '{$today}' ";
						break;
					case "last_10_days":
						$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN date_format(DATE_SUB(CURDATE(), INTERVAL 10 DAY), '%Y-%m-%d') AND   '{$today}' ";
						break;	
					case "last_30_days":
							$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN date_format(DATE_SUB(CURDATE(), INTERVAL 30 DAY), '%Y-%m-%d') AND   '{$today}' ";
					case "last_15_days":
							$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN date_format(DATE_SUB(CURDATE(), INTERVAL 15 DAY), '%Y-%m-%d') AND   '{$today}' ";		
					 case "last_60_days":
							$query .= " AND  date_format( posts.post_date, '%Y-%m-%d') BETWEEN date_format(DATE_SUB(CURDATE(), INTERVAL 60 DAY), '%Y-%m-%d') AND   '{$today}' ";		
						break;	
					case "this_year":
						$query .= " AND  YEAR(date_format( posts.post_date, '%Y-%m-%d')) = YEAR(date_format(CURDATE(), '%Y-%m-%d'))";			
						break;		
					default:
						$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$today}' AND '{$today}'";
				}
				
			$query .= "order by posts.post_date DESC";	
		
			$rows = $wpdb->get_results( $query );
			
			return $rows;
		}
		function get_order_detail($order_id){
			$order_detail	= get_post_meta($order_id);
			$order_detail_array = array();
			foreach($order_detail as $k => $v){
				$k =substr($k,1);
				$order_detail_array[$k] =$v[0];
			}
			return 	$order_detail_array;
		}
		function get_columns(){
			//echo json_encode($_REQUEST);
			
			$columns 		= array();
			
			$columns["order_id"] = __("#ID","niwoosc");
			$columns["order_date"] = __("Date","niwoosc");
			$columns["billing_first_name"] = __("First Name","niwoosc");
			$columns["billing_email"] = __("Email","niwoosc");
			$columns["order_status"] = __("Status","niwoosc");
			
			$columns["payment_method_title"] = __("Payment Method","niwoosc");
			$columns["billing_country"] = __("Country","niwoosc");
			
			$columns["order_currency"] = __("Currency","niwoosc");
			
			$columns["cart_discount"] = __("Cart Discount","niwoosc");
			$columns["cart_discount_tax"] = __("Cart Discount Tax","niwoosc");
			$columns["order_shipping"] = __("Order Shipping","niwoosc");
			$columns["order_shipping_tax"] = __("Order Shipping Tax","niwoosc");
			$columns["order_tax"] = __("Order Tax","niwoosc");
			$columns["order_total"] = __("Order Total","niwoosc");
			
			$columns["niwoosc_commission"] = __("Commission","niwoosc");
			//$columns["niwoosc_mode"] = __("niwoosc_mode","niwoosc");
			
			$columns["commission_mode"] = __("Mode","niwoosc");
			$columns["commission_total"] = __("Commission Total","niwoosc");
			
			
			
			return $columns;
		}
	} 
}
?>
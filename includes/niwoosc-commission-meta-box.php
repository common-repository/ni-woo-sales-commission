<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooSC_Commission_Meta_Box' ) ) {
	include_once('niwoosc-function.php');
	class NiWooSC_Commission_Meta_Box extends NiWooMCR_Function{
		function __construct(){		
			add_action( 'add_meta_boxes',   array(&$this,'add_commission_add_meta_box') , 10, 2 );
			add_action( 'admin_init',  array(&$this,'admin_init' ));
		}
		function admin_init(){
			if (isset($_REQUEST["post_type"])){
				if ($_REQUEST["post_type"] == "shop_order"){
					if(isset($_REQUEST["post_ID"])){
						$post_id =  $_REQUEST["post_ID"];
						
						
						$niwoosc_mode =  isset($_REQUEST["niwoosc_mode"])?$_REQUEST["niwoosc_mode"]:'p';
						update_post_meta($post_id, '_niwoosc_mode', $niwoosc_mode);
						
						
						$niwoosc_commission =  isset($_REQUEST["niwoosc_commission"])?$_REQUEST["niwoosc_commission"]:'0';
						update_post_meta($post_id, '_niwoosc_commission', $niwoosc_commission);
					}
				}
			
			}
			//echo json_encode($_REQUEST);
			//die;
		}
		function add_commission_add_meta_box(){
			 add_meta_box(
				'smashing-post-class',      // Unique ID
				esc_html__( 'Order Commission', 'niwoosc' ),    // Title
				   array($this, 'render_meta_boxa'),   // Callback function
				'shop_order',         // Admin page (or post type)
				'side',         // Context
				'default'         // Priority
			  );
		}
		function render_meta_boxa(){
			$niwoosc_mode = get_post_meta( get_the_ID(), '_niwoosc_mode', true ); 
			$niwoosc_commission = get_post_meta( get_the_ID(), '_niwoosc_commission', true ); 
			$order_total = get_post_meta( get_the_ID(), '_order_total', true ); 
			?>
            <table style="width:100%;">
            	<tr>
                	<td style="width:70%;height:30px;"> Mode </td>
                    <td>
                    <select name="niwoosc_mode" id="niwoosc_mode" class="_niwoosc_mode" style="width:120px">
						<option value="p"  <?php echo $niwoosc_mode=='p'?'selected':'';  ?> >Percentage</option>
						<option value="f" <?php echo $niwoosc_mode=='f'?'selected':'';  ?> >Fixed</option>
						</select>
                    </td>
                </tr>
                <tr style="height:30px;">
                	<td >Commission</td>
                    <td><input type="text" name="niwoosc_commission" id="niwoosc_commission" style="width:100px" value="<?php echo $niwoosc_commission;  ?>" /> </td>
                </tr>
                
                 <tr style="height:30px;">
                	<td >Order toal</td>
                    <td ><?php echo wc_price($order_total); ?></td>
                </tr>
                
                <tr style="height:30px;" >
                	<td><span  style="width:100px">Order commission</span></td>
                    <td ><?php echo wc_price( $this->calculate_commission($niwoosc_mode ,$order_total,	$niwoosc_commission)); ?></td>
                </tr>
            </table>
            <?php
		
		}
	}
}
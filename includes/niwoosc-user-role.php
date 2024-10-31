<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'NiWooSC_User_Role' ) ) {
	include_once('niwoosc-function.php');
	class NiWooSC_User_Role extends NiWooMCR_Function{
		function __construct(){
		}
		function get_page_init(){
			
		?>
		<div class="container">
 			<div class="card" style="max-width:100%; display: none">
              <div class="card-body">
               	<div class="card-header">
               <h3> <?php _e('Search Order Report', 'niwoomcr'); ?></h3>
                </div>
                <div class="card-body">
                  <form name="frm_niwoosc" id="frm_niwoosc">
               
                  <div class="form-group row" >
                   <div class="col-sm-12" style="text-align:right">
                   	 <input type="submit" class="btn btn-primary" value="<?php esc_html_e('Search', 'niwoosc'); ?>"   />
                   </div>
                  	 
                  </div>
                  
                  <input type="hidden" name="sub_action" id="sub_action" value="niwoosc-user-role" />
                  <input type="hidden" name="action" id="action" value="niwoosc_ajax" />
                
                </form>
                </div>
              </div>
            </div>
            
            <div class="niwoosc_ajax_content" style="padding-top:20px;"></div>
			
		
		</div>
		<?php
			
		}
		function get_ajax_action(){
			
			//echo json_encode($_REQUEST);
			$this->get_report_table();
			die;
			
		}
		function get_report_table(){
			
			$roles = $this->get_user_role();
			$mode = $this->get_commission_mode();
			
			$rows = $this->get_user_role_commission();
			
			//$this->prettyPrint($rows);
			
			//$this->prettyPrint($rows["administrator"]->niwoosc_commission);

			?>
			

            <div class="table-responsive">
            	<div style="padding-bottom: 10px;">
					
					<div style="float: left; width: 50%;">
					<div class="niwoomcr_ajax_content_message alert alert-success" role="alert" style="display: none">
						
					
					</div>
					</div>
					<div style="float: right">
					<input type="button" id="btnTest" value="<?php esc_html_e('Save', 'niwoosc'); ?>" class="btn btn-primary">
					</div>
						
					
				</div>
				<table class="table  table-bordered" id="tbl_user_role">
           		<thead class="thead-light">
                	<tr>
						<th><?php esc_html_e('User Role', 'niwoosc'); ?> </th>
						<th><?php esc_html_e('Mode', 'niwoosc'); ?>  </th>
						<th><?php esc_html_e('Commission', 'niwoosc'); ?> </th>
                	</tr>
                </thead>
                <tbody>
                  <?php foreach($roles as $key=>$value ): ?>
					<?php $commission =  isset($rows[$key]->niwoosc_commission)?$rows[$key]->niwoosc_commission:0;?>
						<?php $niwoosc_mode =  isset($rows[$key]->niwoosc_mode)?$rows[$key]->niwoosc_mode:0;?>
					
					<tr>
					 	<td><input type="hidden" value="<?php echo $key; ?>" class="_niwoosc_user_role">   <?php echo $value; ?> </td>
						<td> 
							<select name="niwoosc_mode" class="_niwoosc_mode">
								<?php foreach($mode as $key=>$value): ?>
								<option value="<?php echo $key; ?>"    <?php if($niwoosc_mode == $key) echo"selected"; ?>    ><?php echo $value; ?></option>
								<?php endforeach; ?>
							</select> 
						</td>
						<td> 
							<input type="number" name="niwoosc_commission"  class="_niwoosc_commission" value="<?php echo $commission; ?>" > 
						</td>
					 </tr>	
				<?php endforeach; ?>
				</tbody>
            </table>
            </div>
            
            <?php
			
		}
		function save_user_role_commission(){
			global $wpdb;
			
			
			$message = array();
			
			$message["status"] = '1';
			$message["message"] = 'Record  saved';
			
			$data = array();
			$user_role_commission =  isset($_REQUEST["data"])?$_REQUEST["data"]:array();

			$table_user_role_commission =  $wpdb->prefix.'niwoosc_user_role_commission';

			/*Firts Delete*/
			$wpdb->query('TRUNCATE TABLE '.$table_user_role_commission );

			foreach($user_role_commission  as $key=>$value ){
				$data 				= array();

				$niwoosc_user_role 	=  $value["niwoosc_user_role"];
				$niwoosc_mode 		=  $value["niwoosc_mode"];
				$niwoosc_commission =  isset($value["niwoosc_commission"])?$value["niwoosc_commission"]:0;

				$data["niwoosc_user_role"] 	=  $niwoosc_user_role;
				$data["niwoosc_mode"] 		=  $niwoosc_mode;
				$data["niwoosc_commission"] =  $niwoosc_commission;

				$wpdb->insert($table_user_role_commission, $data );

			}
			
			if($wpdb->last_error !== '') {
				$message["status"] = '0';
				$message["message"] = 'Record not  saved';
			}
				
			echo json_encode($message);	
			
			die;
		}
		
	}
}
?>

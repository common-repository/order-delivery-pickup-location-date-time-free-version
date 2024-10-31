<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://webchunky.com/
 * @since      1.0.0
 *
 * @package    Woo_Delivery
 * @subpackage Woo_Delivery/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

$this->enqueue_scripts();

if (!function_exists('arch_woodelivery_create_time_range')) {
    function arch_woodelivery_create_time_range($start, $end, $interval, $format) {
        $startTime = strtotime($start); 
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12')?'g:i A':'G:i';

        $current   = time(); 
        $addTime   = strtotime('+'.$interval, $current); 
        $diff      = $addTime - $current;

        $times = array(); 
        while ($startTime < $endTime) { 
            $times[] = gmdate($returnTimeFormat, $startTime); 
            $startTime += $diff; 
        } 
        $times[] = gmdate($returnTimeFormat, $startTime); 
        return $times; 
    }
}
?>
<section id="tab-3" class="tab-body entry-content active active-content">

<?php

		global $wpdb;

		$plugin_name = $this->plugin_name;
		$time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');
		$times_arr = arch_woodelivery_create_time_range('0:00', '23:59', $time_slot.' mins', '12');

        $start_time = get_option('archtechwoodelivery_activation_default_start_time');
        $end_time = get_option('archtechwoodelivery_activation_default_end_time');

		?>
		<div class="arch_woodelivery_setting_main_div">

			<h2>WooDeliveryPickup Time Settings</h2>
			<form class="arch_woo_setting_form" name="arch_woo_setting_form" method="post" id="arch_woo_setting_form" action="">
                <input type="hidden" name="site_url" id="site_url" value="<?php echo esc_url(site_url()); ?>">
				<table class="setting_tbl" id="set_tbl">
					<tr><td>Time Slot Intervals: </td><td><?php if(isset($time_slot)){ echo esc_html($time_slot); } ?> Minutes</td></tr>
					<tr><td>Pickup Hours by days:</td></tr>
					<?php
					

					$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';

        			$results = $wpdb->get_results($wpdb->prepare( "SELECT * FROM {$table_name} "));

        			if(!empty($results)) { 
        				//$count = 1;
            			foreach( $results as $value ) {
            		?>
            					<tr id="<?php echo esc_html($value->id); ?>" class="day_ch"><td></td><td><input class="day_check" type="checkbox" id="day<?php echo esc_html($value->id); ?>" name="days[]" value="1" <?php if($value->time_status == '1'){ ?>checked <?php } ?> ><label for="day<?php echo esc_html($value->id); ?>"> <?php echo esc_html($value->day); ?></label></td><td class="time_from_ch">From: 

            						<?php
                                   
            						if(!empty($times_arr)){
                                    $start_time_n = strtoupper(gmdate("g:i A",strtotime($value->start_time)));
            						?>
            							<select id="start_time<?php echo esc_html($value->id); ?>" name="start_time<?php echo esc_html($value->id); ?>">
            								<?php
            								foreach(array_unique($times_arr) as $time_key=>$time_val){
            								?>
            									<option value="<?php echo strtoupper(gmdate("H:i",strtotime(esc_html($time_val)))); ?>" <?php if($start_time_n == $time_val){ echo 'selected'; } ?> ><?php echo esc_html($time_val); ?></option>
            								<?php
            								}
            								?>
            							</select>

            						<?php
            						}
            						?>
            					</td><td class="time_to_ch">To: 
            						<?php
                                    
            						if(!empty($times_arr)){
                                    $end_time_n = strtoupper(gmdate("g:i A",strtotime($value->end_time)));
            						?>
            							<select id="end_time<?php echo esc_html($value->id); ?>" name="end_time<?php echo esc_html($value->id); ?>">
            								<?php
            								foreach(array_unique($times_arr) as $time_key=>$time_val){
            								?>
            									<option value="<?php echo strtoupper(gmdate("H:i",strtotime(esc_html($time_val)))); ?>" <?php if($end_time_n == $time_val){ echo 'selected'; } ?> ><?php echo esc_html($time_val); ?></option>
            								<?php
            								}
            								?>
            							</select>

            						<?php
            						}
            						?>
            					 </td><td>Pickup Time for <?php esc_html($value->day) ?> </td></tr>
            				<?php
            				
            				?>
            					
            				<?php
            				
            			}
            		}else{
                        ?>
                        <tr>No time slots available</tr>
                        <?php
                    }
					?>
					
					<tr><td><input type="submit" name="arch_woo_setting_form_submit" id="arch_woo_setting_form_submit" value="Save Settings"></td></tr>
					
				</table>
			</form>
            <div class="slot_settings_form_response com_response"></div>

		
		</div>

</section>

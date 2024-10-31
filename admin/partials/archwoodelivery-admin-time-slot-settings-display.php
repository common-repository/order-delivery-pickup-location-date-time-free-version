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
global $wpdb;
$plugin_name = $this->plugin_name;
$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';
$table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
$day_results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name}"));

?>
<div class="all_day_wise_time_slot_main_div">
	<h2>Manage Time Slots</h2>

	<div class="mng_time_slots_div">
		<label>All Days</label>
		<select id="select_days" name="select_days">
			
<?php
			if(!empty($day_results)) { 
			        foreach( $day_results as $day_value ) {
			            $day_id = $day_value->id;
			            $day_slug = $day_value->day_slug;
			            $day = $day_value->day;
			            $start_time = $day_value->start_time;
			            $end_time = $day_value->end_time;
			            $time_slot = $day_value->time_slot;
			            $time_status = $day_value->time_status;

			            ?>
			            	<option slot_intervals="<?php echo esc_html($time_slot); ?>" value="<?php echo esc_html($day_slug); ?>" ><?php echo esc_html($day); ?> </option>
			            <?php
			        }
			}

?>
		</select>
	</div>

	<div class="all_intervals com_intervals">
		<?php
			if ( function_exists( 'get_woocommerce_currency' ) ) {
				$curr_symbol = get_woocommerce_currency();
			}else{
				$curr_symbol = '';
			}

			if(!empty($day_results)) { 
			        foreach( $day_results as $day_value ) {
			            $day_id = $day_value->id;
			            $day_slug = $day_value->day_slug;
			            $day = $day_value->day;
			            $start_time = $day_value->start_time;
			            $end_time = $day_value->end_time;
			            $time_slot = $day_value->time_slot;
			            $time_status = $day_value->time_status;
			            ?>
			            	<div id="day-<?php echo esc_html($day_slug); ?>" class="woo_days" <?php if($day_id !='1'){ ?> style="display: none;" <?php } ?> >
			            		<?php
			            		if($time_status == '1'){
			            		?>
			            		<div class="time_break_tb" id="time_break_tb">
			            			<?php
			            			$slot_results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE beak_time_day= %s AND break_time_intervals = %s ", $day_slug, $time_slot));

			            			if(!empty($slot_results)){
			            				?>
			            				<div class="slot_hdd"><strong>Available Time Slots</strong><strong>Extra Fee</strong></div>
			            				<?php
				            			foreach( $slot_results as $slot_value ) {
				            			?>
				            				<div class="slot_tr"><div class="slot_sub_tr"><?php echo esc_html($slot_value->break_time_slot); ?></div><form class="fees_form" name="fees_form" method="post"><div><strong class="slot_lb"><?php echo esc_html($curr_symbol); ?></strong> <input class="site_u_cls" type="hidden" name="site_url" class="site_url" value="<?php echo esc_url(site_url()); ?>"> <input type="hidden" name="woo_delivery_extra_fee_id" class="woo_delivery_extra_fee_id" value="<?php echo esc_html($slot_value->break_id); ?>"><input type="text" name="woo_delivery_extra_fee" class="woo_delivery_extra_fee" value="<?php if($slot_value->break_extra_fee !=''){ echo esc_html($slot_value->break_extra_fee); }else{ echo '0'; } ?>" onkeypress="return isNumber(event)" ></div><div><input type="submit" name="update_fee" class="update_fee" value="Update Fee"></div><div id="res_<?php echo esc_html($slot_value->break_id); ?>" class="fees_update_response com_response"></div></form></div>
			            			<?php
			            				} // end of foreachloop(slot)
			            			} // end of if condition
			            			?>
			            		</div>
			            		<?php
			            		}else{
			            			echo '<span class="no_slot_av">No slots are available on this day</span>';
			            		}
			            		?>
			            	</div>
			            <?php
			        	
			        }
			}else{
				echo 'No days are available!';
			}

		?>
		
	</div>
</div>
<?php
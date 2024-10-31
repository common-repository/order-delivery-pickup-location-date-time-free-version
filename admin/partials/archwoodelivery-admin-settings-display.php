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
<section id="tab-2" class="tab-body entry-content active active-content">

<?php

		global $wpdb;

		$plugin_name = $this->plugin_name;
		$time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');
		$times_arr = arch_woodelivery_create_time_range('0:00', '23:59', $time_slot.' mins', '12');

		$order_type = get_option( 'archtechwoodelivery_activation_default_order_type' );
        $aks_time = get_option( 'archtechwoodelivery_activation_default_ask_time' );
        $time_required = get_option( 'archtechwoodelivery_activation_default_time_validation' );
        $time_interval = get_option( 'archtechwoodelivery_activation_default_interval_time' );
        //update_option( 'archtechwoodelivery_activation_default_time_slot_range', $time_interval );

       	$pickup_text =  get_option( 'archtechwoodelivery_activation_default_pickup_label_text' );
        $date_field_text = get_option( 'archtechwoodelivery_activation_default_date_label_text' );
        $time_field_text = get_option( 'archtechwoodelivery_activation_default_time_label_text' );
        $charge_field_text = get_option( 'archtechwoodelivery_activation_default_special_time_text' );
        $additional_charge_text = get_option( 'archtechwoodelivery_activation_default_additional_charge_text' );
        $tip_amounts = get_option( 'archtechwoodelivery_activation_default_tips' );

		?>

		<div class="arch_woodelivery_setting_main_div">

			<div class="settings_form_response"></div>
			<h2>WooDeliveryPickup Settings</h2>
			<hr>
			<form class="arch_woo_setting_form" name="arch_woo_setting_form" id="arch_woo_setting_form" method="post" action="">
				<input type="hidden" name="site_url" id="site_url" value="<?php echo esc_url(site_url()); ?>">
				<table class="setting_tbl" id="set_tbl">
					<tr><td>Allow Order for: </td><td><span class="td_item"><input type="radio" id="order_type" name="order_type" value="pick_up" <?php if(isset($order_type)){ if($order_type =='pick_up'){ ?>checked <?php } } ?> ><label for="order_type">Pickup</label></span><span class="td_item"><input type="radio" id="order_type1" name="order_type" value="delivery" <?php if(isset($order_type)){ if($order_type =='delivery'){ ?>checked <?php } } ?> ><label for="order_type">Delivery</label></span><span class="td_item"><input type="radio" id="order_type2" name="order_type" value="both" <?php if(isset($order_type)){ if($order_type =='both'){ ?>checked <?php } } ?> ><label for="order_type">Both</label></span></td></tr>
					<tr><td>Aks for time: </td><td><input type="checkbox" id="aks_time" name="aks_time" value="1" <?php if(isset($aks_time)){ if($aks_time =='1'){ ?>checked <?php } } ?> ><label for="aks_time"> aks for pickup time</label></td></tr>
					<tr><td>Pickup Time field validation?:</td><td><input type="checkbox" id="time_required" name="time_required" value="1" <?php if(isset($time_required)){ if($time_required =='1'){ ?>checked <?php } } ?> ><label for="aks_time"> Pickup time section mandatory</label></td></tr>
					<tr><td>Pickup Inverval time:</td><td>
						<select class="time_interval_cls" name="time_interval" id="time_interval">
							<option value="30" <?php if(isset($time_interval)){ if($time_interval == '30'){ echo 'selected'; } } ?> >30 minutes</option>
							<option value="60" <?php if(isset($time_interval)){ if($time_interval == '60'){ echo 'selected'; } } ?> >60 minutes</option>
						</select>
					</td></tr>
					<tr><td>Pickup label text:</td><td>
						<input type="text" name="pickup_text" id="pickup_text" value="<?php if(isset($pickup_text)){ echo esc_html($pickup_text); } ?>" required>
					</td></tr>

					<tr><td>Date Field text:</td><td>
						<input type="text" name="date_field_text" id="date_field_text" value="<?php if(isset($date_field_text)){ echo esc_html($date_field_text); } ?>" required>
					</td></tr>

					<tr><td>Time Field text:</td><td>
						<input type="text" name="time_field_text" id="time_field_text" value="<?php if(isset($time_field_text)){ echo esc_html($time_field_text); } ?>" required>
					</td></tr>

					<tr><td>Special time slot charge text:</td><td>
						<input type="text" name="charge_field_text" id="charge_field_text" value="<?php if(isset($charge_field_text)){ echo esc_html($charge_field_text); } ?>" required>
					</td></tr>

					<tr><td>Additional Charge text:</td><td>
						<input type="text" name="additional_charge_text" id="additional_charge_text" value="<?php if(isset($additional_charge_text)){ echo esc_html($additional_charge_text); } ?>" required>
					</td></tr>

					<tr><td>Tip Amounts:</td>
						<td>
							<div class="tip_main_div">
								<div class="tip_sub" id="tip_sub_d">
									<?php
									if(isset($tip_amounts)){
										//print_r($tip_amounts);
										$flag = 1;
										foreach(array_filter($tip_amounts,'strlen') as $tip_val){
											
										?>
										<div class="tip_vv"><span class="tip_inp"><input type="text" name="tip_amount[]" class="tip_amount" placeholder="Tip Amount" onkeypress="return isNumber(event)" value="<?php echo esc_html($tip_val); ?>" ></span>
											<?php
											if($flag !=1 ){
												echo '<span class="add_remv_btn">Remove</span>';
											}
											?>
										</div>
										<?php
											$flag++;
										}
									}
									?>
								</div>

								<div class="tip_sub_btn">
									<span id="tip_btn">Add</span>
								</div>
							</div>
						</td>
					</tr>
					
					<tr><td><input type="submit" name="arch_woo_setting_form_submit" id="arch_woo_setting_form_submit" value="Save Settings"></td></tr>
					
				</table>

				<div class="woo_delivery_primary_settings com_response"></div>
			</form>

		</div>

		

</section>

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
$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
$store_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_name}"));

?>

	<div class="Woostores_main_div">
		<div class="store_details_pop"></div>
		<div class="stores_hd"><h2>All Stores</h2> <span class="new_store_cr"><a href="<?php echo 'admin.php?page='.esc_html($plugin_name).'-add-stores'; ?>"><img src="<?php echo esc_url(plugin_dir_url(__FILE__));  ?>../images/add.png"> Add a Store</a></span></div>

		<input type="hidden" name="site_url" class="site_url" id="site_url" value="<?php echo esc_url(site_url()); ?>">
			<div class="woo_delivery_all_store_div" id="arch_all_stores">
				<div class="all_stores_response com_response"></div>
				<table class="all_store_tb" id="all_store_tb" border="2">
					<thead>
						<th>Store Name</th>
						<th>Store Email</th>
						<th>Store Contact</th>
						<th>Status</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php
						if(!empty($store_results)) { 
			        		foreach( $store_results as $store_val ) {
						?>
								<tr>
									<td><?php echo esc_html($store_val->store_name); ?></td>
									<td><?php echo esc_html($store_val->store_email); ?></td>
									<td><?php echo esc_html($store_val->store_phone); ?></td>
									<td>
										<?php 
											if($store_val->store_status == '1'){
									  	?>
									  		<div class="ac">Active</div><div class="l_inactive"><a href="javascript:void(0);" onclick="change_store_status(<?php echo esc_js($store_val->store_id); ?>,'0')">Click to Deactive</a></div>
									  	<?php
									  		}elseif($store_val->store_status == '0'){
									  	?>
									  		<div class="dc" >Inactive</div><div class="l_inactive"><a href="javascript:void(0);" onclick="change_store_status(<?php echo esc_js($store_val->store_id); ?>,'1')">Click to Active</a></div>
									  	<?php
									  		}
									  	?>

									</td>

									<td>
		                                <span class="viewdetails"><a class="store_view" href="javascript:void(0);" onclick="store_view(<?php echo esc_js($store_val->store_id); ?>)"><img src="<?php echo esc_url(plugin_dir_url(__FILE__));  ?>../images/eye.png"> View</a></span>
		                                <span class="editdetails"><a class="edit_view" href="javascript:void(0);" onclick="store_edit(<?php echo esc_js($store_val->store_id); ?>)"><img src="<?php echo esc_url(plugin_dir_url(__FILE__));  ?>../images/edit.png"> Edit</a></span>
		                                <span class="deldetails"><a class="store_view" href="javascript:void(0);" onclick="store_delete(<?php echo esc_js($store_val->store_id); ?>)"><img src="<?php echo esc_url(plugin_dir_url(__FILE__));  ?>../images/bin.png"> Delete</a></span>
		                            </td>

								</tr>
						<?php
							}
						}else{
							echo '<tr><td colspan="5"> No Stores Found</td></tr>';
						}
						?>
					</tbody>
				</table>
			</div>
	</div>


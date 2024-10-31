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
 * @subpackage Woo_Delivery/admin/partials/
 */
$plugin_name = $this->plugin_name;
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="Woo_Delivery_add_store_main_div">
	<div class="add_store_sub_div">
		<div class="store_hdd"><span class="add_st_rg"><h2>Add New Stores</h2></span><span class="view_st_lf"><a href="<?php echo 'admin.php?page='.esc_html($plugin_name).'-stores'; ?>">View Stores</a></span></div>

		<div class="add_st_fld">
			<form class="add_st_form_cls" id="woo_delivery_add_store" name="woo_delivery_add_store" method="post" enctype="multipart/form-data">
				<input type="hidden" name="site_url" id="site_url" value="<?php echo esc_url(site_url()); ?>">
				<div class="form-field">
					<label>Store Name: <span class="req">*</span></label>
					<input type="text" name="store_name" id="store_name" placeholder="Enter Store Name" required>
				</div>

				<div class="form-field">
					<label>Store Address: <span class="req">*</span></label>
					<textarea name="store_address" id="store_address" placeholder="Enter Store Full Address" required></textarea>
				</div>

				<div class="form-field">
					<label>Store Email Address: <span class="req">*</span></label>
					<input type="email" name="store_email" id="store_email" placeholder="Enter Store Email Address" required>
				</div>

				<div class="form-field">
					<label>Store Contact Number: <span class="req">*</span></label>
					<input type="text" name="store_contact_no" id="store_contact_no" placeholder="Enter Store Contact Number" onkeypress="return isNumber(event)" required>
				</div>

				<div class="form-field">
					<input type="submit" name="add_store_submit" id="add_store_submit" value="Add">
				</div>

				<div class="add_store_response com_response"></div>
			</form>
		</div>
	</div>
</div>
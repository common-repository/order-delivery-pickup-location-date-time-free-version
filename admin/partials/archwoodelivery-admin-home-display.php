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
    $time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');
    //$times_arr = arch_woodelivery_create_time_range('0:00', '23:59', $time_slot.' mins', '12');

    /** order timezone options start **/
    $time_zone = get_option( 'archtechwoodelivery_activation_default_time_zone' );
    /** order timezone options end **/

    /** order settings options start **/
    $order_type = get_option( 'archtechwoodelivery_activation_default_order_type' );
    $order_type_checkout = get_option( 'archtechwoodelivery_activation_default_order_type_checkout' );
    $order_type_label = get_option( 'archtechwoodelivery_activation_default_order_type_field_label' );
    $delivery_option_label = get_option( 'archtechwoodelivery_activation_default_delivery_option_field_label' );
    $pickup_option_label = get_option( 'archtechwoodelivery_activation_default_pickup_option_field_label' );
    /** order settings options end **/

    /** Delivery Date settings options start **/
    $archtechwoodelivery_activation_default_delivery_date_show_hide = get_option( 'archtechwoodelivery_activation_default_delivery_date_show_hide' );
    $archtechwoodelivery_activation_default_delivery_date_mandatory = get_option( 'archtechwoodelivery_activation_default_delivery_date_mandatory' );
    $archtechwoodelivery_activation_default_delivery_date_label_text = get_option( 'archtechwoodelivery_activation_default_delivery_date_label_text' );
    $archtechwoodelivery_activation_default_delivery_date_start_from = get_option( 'archtechwoodelivery_activation_default_delivery_date_start_from' );
    $archtechwoodelivery_activation_default_delivery_date_format = get_option( 'archtechwoodelivery_activation_default_delivery_date_format' );
    $archtechwoodelivery_activation_default_delivery_date_delivery_days = get_option( 'archtechwoodelivery_activation_default_delivery_date_delivery_days' );

    $week_start = $archtechwoodelivery_activation_default_delivery_date_start_from;
    $del_date_format = $archtechwoodelivery_activation_default_delivery_date_format;
    $missing_date = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_delivery_date_delivery_days);

    $missing_date_arr = explode(",", $missing_date);
    /** Delivery Date settings options end **/

    /** Pickup Date settings options start **/
    $archtechwoodelivery_activation_default_pickup_date_show_hide = get_option( 'archtechwoodelivery_activation_default_pickup_date_show_hide' );
    $archtechwoodelivery_activation_default_pickup_date_mandatory = get_option( 'archtechwoodelivery_activation_default_pickup_date_mandatory' );
    $archtechwoodelivery_activation_default_pickup_date_label_text = get_option( 'archtechwoodelivery_activation_default_pickup_date_label_text' );
    $archtechwoodelivery_activation_default_pickup_date_start_from = get_option( 'archtechwoodelivery_activation_default_pickup_date_start_from' );
    $archtechwoodelivery_activation_default_pickup_date_format = get_option( 'archtechwoodelivery_activation_default_pickup_date_format' );
    $archtechwoodelivery_activation_default_pickup_date_delivery_days = get_option( 'archtechwoodelivery_activation_default_pickup_date_delivery_days' );

    $p_week_start = $archtechwoodelivery_activation_default_pickup_date_start_from;
    $p_del_date_format = $archtechwoodelivery_activation_default_pickup_date_format;
    $p_missing_date = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_pickup_date_delivery_days);
    $p_missing_date_arr = explode(",", $p_missing_date);
    /** Pickup Date settings options end **/

    /** Delivery Time settings options start **/
    $archtechwoodelivery_activation_default_delivery_time_show_hide = get_option( 'archtechwoodelivery_activation_default_delivery_time_show_hide' );
    $archtechwoodelivery_activation_default_delivery_time_mandatory = get_option( 'archtechwoodelivery_activation_default_delivery_time_mandatory' );
    $archtechwoodelivery_activation_default_delivery_time_label_text = get_option( 'archtechwoodelivery_activation_default_delivery_time_label_text' );

    $archtechwoodelivery_activation_default_delivery_time_slot_starts_hour = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_hour' );
    $archtechwoodelivery_activation_default_delivery_time_slot_starts_min = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_min' );
    $archtechwoodelivery_activation_default_delivery_time_slot_starts_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_format' );
    $archtechwoodelivery_activation_default_delivery_time_slot_ends_hour = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_hour' );
    $archtechwoodelivery_activation_default_delivery_time_slot_ends_min = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_min' );
    $archtechwoodelivery_activation_default_delivery_time_slot_ends_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_format' );

    $archtechwoodelivery_activation_default_delivery_time_slot_breaks = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_breaks' );
    $delivery_slot_break = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_delivery_time_slot_breaks);
    $delivery_slot_break_arr = explode(",", $delivery_slot_break);

    $archtechwoodelivery_activation_default_delivery_time_slot_duration_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_duration_format' );
    $archtechwoodelivery_activation_default_delivery_time_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_format' );
    /** Delivery Time settings options end **/

    /** Pickup Time settings options start **/
    $archtechwoodelivery_activation_default_pickup_time_show_hide = get_option( 'archtechwoodelivery_activation_default_pickup_time_show_hide' );
    $archtechwoodelivery_activation_default_pickup_time_mandatory = get_option( 'archtechwoodelivery_activation_default_pickup_time_mandatory' );
    $archtechwoodelivery_activation_default_pickup_time_label_text = get_option( 'archtechwoodelivery_activation_default_pickup_time_label_text' );

    $archtechwoodelivery_activation_default_pickup_time_slot_starts_hour = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_hour' );
    $archtechwoodelivery_activation_default_pickup_time_slot_starts_min = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_min' );
    $archtechwoodelivery_activation_default_pickup_time_slot_starts_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_format' );
    $archtechwoodelivery_activation_default_pickup_time_slot_ends_hour = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_hour' );
    $archtechwoodelivery_activation_default_pickup_time_slot_ends_min = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_min' );
    $archtechwoodelivery_activation_default_pickup_time_slot_ends_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_format' );

    $archtechwoodelivery_activation_default_pickup_time_slot_breaks = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_breaks' );
    $pickup_slot_break = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_pickup_time_slot_breaks);
    $pickup_slot_break_arr = explode(",", $pickup_slot_break);

    $archtechwoodelivery_activation_default_pickup_time_slot_duration_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_duration_format' );
    $archtechwoodelivery_activation_default_pickup_time_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_format' );
    /** Pickup Time settings options end **/

    /** Pickup Location settings options start **/
    $archtechwoodelivery_activation_default_pickup_location_show_hide = get_option( 'archtechwoodelivery_activation_default_pickup_location_show_hide' );
    $archtechwoodelivery_activation_default_pickup_location_mandatory = get_option( 'archtechwoodelivery_activation_default_pickup_location_mandatory' );
    $archtechwoodelivery_activation_default_pickup_location_label_text = get_option( 'archtechwoodelivery_activation_default_pickup_location_label_text' );
    /** Pickup Location settings options start **/

    /** Others settings options start **/
    $archtechwoodelivery_activation_default_checkout_page_heading = get_option( 'archtechwoodelivery_activation_default_checkout_page_heading' );
    $archtechwoodelivery_activation_default_checkout_field_possition = get_option( 'archtechwoodelivery_activation_default_checkout_field_possition' );
    $archtechwoodelivery_activation_default_custom_css = get_option( 'archtechwoodelivery_activation_default_custom_css' );
    /** Others settings options start **/

    $aks_time = get_option( 'archtechwoodelivery_activation_default_ask_time' );
    $time_required = get_option( 'archtechwoodelivery_activation_default_time_validation' );
    $time_interval = get_option( 'archtechwoodelivery_activation_default_interval_time' );

    $pickup_text =  get_option( 'archtechwoodelivery_activation_default_pickup_label_text' );
    $date_field_text = get_option( 'archtechwoodelivery_activation_default_date_label_text' );
    $time_field_text = get_option( 'archtechwoodelivery_activation_default_time_label_text' );
    $charge_field_text = get_option( 'archtechwoodelivery_activation_default_special_time_text' );
    $additional_charge_text = get_option( 'archtechwoodelivery_activation_default_additional_charge_text' );
    $tip_amounts = get_option( 'archtechwoodelivery_activation_default_tips' );

?>


<!---- New dashboard Code ----->
<div class="archt-woo-delivery-wrap">

	<input type="hidden" name="site_url" id="site_url" value="<?php echo esc_url(site_url()); ?>">
    <div class="archt-woo-delivery-container"  >
        <div class="archt-woo-delivery-container-header"  >
            <img style="max-width: 75px;float: left;display: block;padding-bottom: 2px;" src="<?php echo esc_url(site_url()); ?>/wp-content/plugins/order-delivery-pickup-location-date-time-free-version/admin/images/plugin-icon.jpg" alt="arch-woo-delivery-logo">

            <div style="float:left;margin-left:15px;"  >
                <p style="margin: 0!important;text-transform:uppercase;border-bottom:2px solid #1F9E60;padding-bottom:3px;font-size: 20px;font-weight: 700;color: #654C29;">WooDelivery</p>
                <p style="margin: 0!important;text-transform:uppercase;padding-top:3px;font-size: 11px;color: #654C29;font-weight: 600;">WooCommerce Order Delivery &amp; Pickup Date Time</p>
            </div>

            <div class="">
                <div class="arch_plugin_version">Version 1.1.0</div>
                <a href="https://webchunky.com/order-delivery-and-pickup-date-and-time/" target="_blank" class="archt-woo-delivery-buy-now-btn">Live Demo</a>
            </div>
            
            <!-- <a style="float: right; margin-top: 4px; margin-right: 4px;" href="#" target="_blank" class="archt-woo-delivery-buy-now-btn">Get Pro</a> -->
        </div>

        <div class="archt-woo-delivery-free-vertical-tabs">
            <div class="archt-woo-delivery-free-tabs">
                <button data-tab="tab1" class="tabs delivery_pickup_home_tab archt-woo-delivery-active"><i class="dashicons dashicons-admin-home"></i>Home</button>
                <button data-tab="tab2" class="tabs"><i class="dashicons dashicons-location-alt"></i>Timezone Settings</button>
                <!-- <button data-tab="tab3" class="tabs delivery_pickup_calender_tab"><i class="dashicons dashicons-calendar-alt"></i>Order Calendar</button> -->
                <!-- <button data-tab="tab4" class="tabs delivery_pickup_order_report_tab"><i class="dashicons dashicons-admin-home"></i>Order Reports</button> -->
                <button data-tab="tab5" class="tabs"><i class="dashicons dashicons-plugins-checked"></i>Order Settings</button>
                <button data-tab="tab6" class="tabs"><i class="dashicons dashicons-calendar-alt"></i>Delivery Date Settings</button>
                <button data-tab="tab7" class="tabs"><i class="dashicons dashicons-calendar"></i>Pickup Date Settings</button>
                <!-- pro version
                <button data-tab="tab8" class="tabs"><i class="dashicons dashicons-hidden"></i>Off Days/Holidays</button>
                -->
                <button data-tab="tab9" class="tabs"><i class="dashicons dashicons-clock"></i>Delivery Time</button>
                <!-- <button data-tab="tab10" class="tabs"><i class="dashicons dashicons-clock" ></i>Custom Time Slots</button> -->
                <button data-tab="tab11" class="tabs"><i class="dashicons dashicons-cart"></i>Pickup Time</button>
                <button data-tab="tab12" class="tabs"><i class="dashicons dashicons-location"></i>Pickup Location Settings</button>
                <button data-tab="tab26" class="tabs"><i class="dashicons dashicons-location-alt"></i>Pickup Locations</button>
                <!-- pro version
                <button data-tab="tab13" class="tabs"><i class="dashicons dashicons-cart"></i>Order Delivery Tips</button>
                -->
                <!-- <button data-tab="tab14" class="tabs"><i class="dashicons dashicons-cart" ></i>Cutoff Time</button>
			<button data-tab="tab15" class="tabs"><i class="dashicons dashicons-cart" ></i>Proccessing Days</button>
			<button data-tab="tab16" class="tabs"><i class="dashicons dashicons-cart" ></i>Proccessing Time</button> -->
            <!-- pro version
                <button data-tab="tab17" class="tabs"><i class="dashicons dashicons-cart"></i>Additional Fees</button>
                <button data-tab="tab18" class="tabs"><i class="dashicons dashicons-cart"></i>Email Settings</button>
                <button data-tab="tab19" class="tabs"><i class="dashicons dashicons-cart"></i>Addition Fields</button>
                <button data-tab="tab20" class="tabs"><i class="dashicons dashicons-translation"></i>Localization</button>
                <button data-tab="tab21" class="tabs"><i class="dashicons dashicons-translation"></i>Exclusion</button>
            -->
                <!-- <button data-tab="tab22" class="tabs"><i class="dashicons dashicons-translation" ></i>Google Calendar</button>
			<button data-tab="tab23" class="tabs"><i class="dashicons dashicons-translation" ></i>Laundry Service</button> -->
                <button data-tab="tab24" class="tabs"><i class="dashicons dashicons-admin-settings"></i>Others</button>
                <!-- pro version
                <button data-tab="tab25" class="tabs"><i class="dashicons dashicons-clipboard"></i>Free VS Pro</button>
                -->
                <button data-tab="tab27" class="tabs"><i class="dashicons dashicons-email-alt"></i>Support</button>
            </div>

            <div class="archt-woo-delivery-maincontent">
                <p class="archt-woo-delivery-timezone-tab-notice"><span class="dashicons dashicons-yes"></span> <span class="succ_save" id="successfully_saved"></span></p>
                <p class="archt-woo-delivery-timezone-tab-notice"><span class="dashicons dashicons-no"></span> <span class="succ_not_save" id="not_saved"></span></p>

                <div id="tab1" class="archt-woo-delivery-tabcontent delivery_pickup_home_tab_content">
                    <div class="archt-woo-delivery-card">


                        <p class="arch-woo-delivery-card-header">Welcome to Order Delivery Pickup Location Date Time for WooCommerce</p>


                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">
                                <div class="arch_woo_delivery_main_section">


                                    <div class="plg_main_content">
                                        <div class="plgin_sub_content sub1">
                                            <div class="cnt1">
                                                Order Delivery & Pickup Location Date Time is a complimentary plugin designed to empower your customers by allowing them to select the date and time for order delivery directly during the WooCommerce checkout process
                                            </div>
                                        </div>

                                        <div class="plgin_sub_content sub2">
                                            <div class="cnt2">
                                                Getting Started with WooDeliveryPickup
                                            </div>
                                        </div>

                                        <div class="plgin_sub_content sub3">
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab2" class="archt-woo-delivery-tabcontent delivery_pickup_timezone_settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Timezone Settings</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                	<div class="arch_set_div">
                                		<div class="arch_message_right_div">
		                                    <p class="side_notice_div arch_woo_delivery_timezone_setting_notice"></p>
		                                </div>

		                                <div class="arch_message_left_div">
		                                	<p class="arch-woo-delivery-timezone-tab-warning"><span class="dashicons dashicons-megaphone"></span> Before All the Settings, Please Set Your Timezone First.</p>
		                                </div>
		                            </div>

                                    
                                    <form action="" method="post" id="arch_woo_delivery_timezone_setting_form">

                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group" id="arch_delivery_time_timezone_div">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_timezone">Store Location Timezone</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery date and time of all orders will set according to the selected timezone"><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field select2-hidden-accessible" name="arch_delivery_time_timezone" tabindex="-1" aria-hidden="true" id="arch_delivery_time_timezone">
                                                    <option value="">Select Timezone</option>
                                                    <optgroup label="General">
                                                        <option value="GMT" <?php if($time_zone == 'GMT'){ echo 'selected'; } ?> >GMT timezone</option>
                                                        <option value="UTC" <?php if($time_zone == 'UTC'){ echo 'selected'; } ?> >UTC timezone</option>
                                                    </optgroup>
                                                    <optgroup label="Africa">
                                                        <option value="Africa/Abidjan" <?php if($time_zone == 'Africa/Abidjan'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Abidjan</option>
                                                        <option value="Africa/Accra" <?php if($time_zone == 'Africa/Accra'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Accra</option>
                                                        <option value="Africa/Addis_Ababa" <?php if($time_zone == 'Africa/Addis_Ababa'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Addis Ababa</option>
                                                        <option value="Africa/Algiers" <?php if($time_zone == 'Africa/Algiers'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Algiers</option>
                                                        <option value="Africa/Asmara" <?php if($time_zone == 'Africa/Asmara'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Asmara</option>
                                                        <option value="Africa/Bamako" <?php if($time_zone == 'Africa/Bamako'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Bamako</option>
                                                        <option value="Africa/Bangui" <?php if($time_zone == 'Africa/Bangui'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Bangui</option>
                                                        <option value="Africa/Banjul" <?php if($time_zone == 'Africa/Banjul'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Banjul</option>
                                                        <option value="Africa/Bissau" <?php if($time_zone == 'Africa/Bissau'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Bissau</option>
                                                        <option value="Africa/Blantyre" <?php if($time_zone == 'Africa/Blantyre'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Blantyre</option>
                                                        <option value="Africa/Brazzaville" <?php if($time_zone == 'Africa/Brazzaville'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Brazzaville</option>
                                                        <option value="Africa/Bujumbura" <?php if($time_zone == 'Africa/Bujumbura'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Bujumbura</option>
                                                        <option value="Africa/Cairo" <?php if($time_zone == 'Africa/Cairo'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Cairo</option>
                                                        <option value="Africa/Casablanca" <?php if($time_zone == 'Africa/Casablanca'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Casablanca</option>
                                                        <option value="Africa/Ceuta" <?php if($time_zone == 'Africa/Ceuta'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Ceuta</option>
                                                        <option value="Africa/Conakry" <?php if($time_zone == 'Africa/Conakry'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Conakry</option>
                                                        <option value="Africa/Dakar" <?php if($time_zone == 'Africa/Dakar'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Dakar</option>
                                                        <option value="Africa/Dar_es_Salaam" <?php if($time_zone == 'Africa/Dar_es_Salaam'){ echo 'selected'; } ?>>(GMT/UTC + 03:00) Dar es Salaam</option>
                                                        <option value="Africa/Djibouti" <?php if($time_zone == 'Africa/Djibouti'){ echo 'selected'; } ?>>(GMT/UTC + 03:00) Djibouti</option>
                                                        <option value="Africa/Douala" <?php if($time_zone == 'Africa/Douala'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Douala</option>
                                                        <option value="Africa/El_Aaiun" <?php if($time_zone == 'Africa/El_Aaiun'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) El Aaiun</option>
                                                        <option value="Africa/Freetown" <?php if($time_zone == 'Africa/Freetown'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Freetown</option>
                                                        <option value="Africa/Gaborone" <?php if($time_zone == 'Africa/Gaborone'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Gaborone</option>
                                                        <option value="Africa/Harare" <?php if($time_zone == 'Africa/Harare'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Harare</option>
                                                        <option value="Africa/Johannesburg" <?php if($time_zone == 'Africa/Johannesburg'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Johannesburg</option>
                                                        <option value="Africa/Juba" <?php if($time_zone == 'Africa/Juba'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Juba</option>
                                                        <option value="Africa/Kampala" <?php if($time_zone == 'Africa/Kampala'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Kampala</option>
                                                        <option value="Africa/Khartoum" <?php if($time_zone == 'Africa/Khartoum'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Khartoum</option>
                                                        <option value="Africa/Kigali" <?php if($time_zone == 'Africa/Kigali'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Kigali</option>
                                                        <option value="Africa/Kinshasa" <?php if($time_zone == 'Africa/Kinshasa'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Kinshasa</option>
                                                        <option value="Africa/Lagos" <?php if($time_zone == 'Africa/Lagos'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Lagos</option>
                                                        <option value="Africa/Libreville" <?php if($time_zone == 'Africa/Libreville'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Libreville</option>
                                                        <option value="Africa/Lome" <?php if($time_zone == 'Africa/Lome'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Lome</option>
                                                        <option value="Africa/Luanda" <?php if($time_zone == 'Africa/Luanda'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Luanda</option>
                                                        <option value="Africa/Lubumbashi" <?php if($time_zone == 'Africa/Lubumbashi'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Lubumbashi</option>
                                                        <option value="Africa/Lusaka" <?php if($time_zone == 'Africa/Lusaka'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Lusaka</option>
                                                        <option value="Africa/Malabo" <?php if($time_zone == 'Africa/Malabo'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Malabo</option>
                                                        <option value="Africa/Maputo" <?php if($time_zone == 'Africa/Maputo'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Maputo</option>
                                                        <option value="Africa/Maseru" <?php if($time_zone == 'Africa/Maseru'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Maseru</option>
                                                        <option value="Africa/Mbabane" <?php if($time_zone == 'Africa/Mbabane'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Mbabane</option>
                                                        <option value="Africa/Mogadishu" <?php if($time_zone == 'Africa/Mogadishu'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Mogadishu</option>
                                                        <option value="Africa/Monrovia" <?php if($time_zone == 'Africa/Monrovia'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Monrovia</option>
                                                        <option value="Africa/Nairobi" <?php if($time_zone == 'Africa/Nairobi'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Nairobi</option>
                                                        <option value="Africa/Ndjamena" <?php if($time_zone == 'Africa/Ndjamena'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Ndjamena</option>
                                                        <option value="Africa/Niamey" <?php if($time_zone == 'Africa/Niamey'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Niamey</option>
                                                        <option value="Africa/Nouakchott" <?php if($time_zone == 'Africa/Nouakchott'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Nouakchott</option>
                                                        <option value="Africa/Ouagadougou" <?php if($time_zone == 'Africa/Ouagadougou'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Ouagadougou</option>
                                                        <option value="Africa/Porto-Novo" <?php if($time_zone == 'Africa/Porto-Novo'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Porto-Novo</option>
                                                        <option value="Africa/Sao_Tome" <?php if($time_zone == 'Africa/Sao_Tome'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Sao Tome</option>
                                                        <option value="Africa/Tripoli" <?php if($time_zone == 'Africa/Tripoli'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Tripoli</option>
                                                        <option value="Africa/Tunis" <?php if($time_zone == 'Africa/Tunis'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Tunis</option>
                                                        <option value="Africa/Windhoek" <?php if($time_zone == 'Africa/Windhoek'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Windhoek</option>
                                                    </optgroup>
                                                    <optgroup label="America">
                                                        <option value="America/Adak" <?php if($time_zone == 'America/Adak'){ echo 'selected'; } ?> >(GMT/UTC - 10:00) Adak</option>
                                                        <option value="America/Anchorage" <?php if($time_zone == 'America/Anchorage'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Anchorage</option>
                                                        <option value="America/Anguilla" <?php if($time_zone == 'America/Anguilla'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Anguilla</option>
                                                        <option value="America/Antigua" <?php if($time_zone == 'America/Antigua'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Antigua</option>
                                                        <option value="America/Araguaina" <?php if($time_zone == 'America/Araguaina'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Araguaina</option>
                                                        <option value="America/Argentina/Buenos_Aires" <?php if($time_zone == 'America/Argentina/Buenos_Aires'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Buenos Aires</option>
                                                        <option value="America/Argentina/Catamarca" <?php if($time_zone == 'America/Argentina/Catamarca'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Catamarca</option>
                                                        <option value="America/Argentina/Cordoba" <?php if($time_zone == 'America/Argentina/Cordoba'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Cordoba</option>
                                                        <option value="America/Argentina/Jujuy" <?php if($time_zone == 'America/Argentina/Jujuy'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Jujuy</option>
                                                        <option value="America/Argentina/La_Rioja" <?php if($time_zone == 'America/Argentina/La_Rioja'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/La Rioja</option>
                                                        <option value="America/Argentina/Mendoza" <?php if($time_zone == 'America/Argentina/Mendoza'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Mendoza</option>
                                                        <option value="America/Argentina/Rio_Gallegos" <?php if($time_zone == 'America/Argentina/Rio_Gallegos'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Rio Gallegos</option>
                                                        <option value="America/Argentina/Salta" <?php if($time_zone == 'America/Argentina/Salta'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Salta</option>
                                                        <option value="America/Argentina/San_Juan" <?php if($time_zone == 'America/Argentina/San_Juan'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/San Juan</option>
                                                        <option value="America/Argentina/San_Luis" <?php if($time_zone == 'America/Argentina/San_Luis'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/San Luis</option>
                                                        <option value="America/Argentina/Tucuman" <?php if($time_zone == 'America/Argentina/Tucuman'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Tucuman</option>
                                                        <option value="America/Argentina/Ushuaia" <?php if($time_zone == 'America/Argentina/Ushuaia'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Argentina/Ushuaia</option>
                                                        <option value="America/Aruba" <?php if($time_zone == 'America/Aruba'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Aruba</option>
                                                        <option value="America/Asuncion" <?php if($time_zone == 'America/Asuncion'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Asuncion</option>
                                                        <option value="America/Atikokan" <?php if($time_zone == 'America/Atikokan'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Atikokan</option>
                                                        <option value="America/Bahia" <?php if($time_zone == 'America/Bahia'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Bahia</option>
                                                        <option value="America/Bahia_Banderas" <?php if($time_zone == 'America/Bahia_Banderas'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Bahia Banderas</option>
                                                        <option value="America/Barbados" <?php if($time_zone == 'America/Barbados'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Barbados</option>
                                                        <option value="America/Belem" <?php if($time_zone == 'America/Belem'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Belem</option>
                                                        <option value="America/Belize" <?php if($time_zone == 'America/Belize'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Belize</option>
                                                        <option value="America/Blanc-Sablon" <?php if($time_zone == 'America/Blanc-Sablon'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Blanc-Sablon</option>
                                                        <option value="America/Boa_Vista" <?php if($time_zone == 'America/Boa_Vista'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Boa Vista</option>
                                                        <option value="America/Bogota" <?php if($time_zone == 'America/Bogota'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Bogota</option>
                                                        <option value="America/Boise" <?php if($time_zone == 'America/Boise'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Boise</option>
                                                        <option value="America/Cambridge_Bay" <?php if($time_zone == 'America/Cambridge_Bay'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Cambridge Bay</option>
                                                        <option value="America/Campo_Grande" <?php if($time_zone == 'America/Campo_Grande'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Campo Grande</option>
                                                        <option value="America/Cancun" <?php if($time_zone == 'America/Cancun'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Cancun</option>
                                                        <option value="America/Caracas" <?php if($time_zone == 'America/Caracas'){ echo 'selected'; } ?> >(GMT/UTC - 04:30) Caracas</option>
                                                        <option value="America/Cayenne" <?php if($time_zone == 'America/Cayenne'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Cayenne</option>
                                                        <option value="America/Cayman" <?php if($time_zone == 'America/Cayman'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Cayman</option>
                                                        <option value="America/Chicago" <?php if($time_zone == 'America/Chicago'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Chicago</option>
                                                        <option value="America/Chihuahua" <?php if($time_zone == 'America/Chihuahua'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Chihuahua</option>
                                                        <option value="America/Costa_Rica" <?php if($time_zone == 'America/Costa_Rica'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Costa Rica</option>
                                                        <option value="America/Creston" <?php if($time_zone == 'America/Creston'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Creston</option>
                                                        <option value="America/Cuiaba" <?php if($time_zone == 'America/Cuiaba'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Cuiaba</option>
                                                        <option value="America/Curacao" <?php if($time_zone == 'America/Curacao'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Curacao</option>
                                                        <option value="America/Danmarkshavn" <?php if($time_zone == 'America/Danmarkshavn'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Danmarkshavn</option>
                                                        <option value="America/Dawson" <?php if($time_zone == 'America/Dawson'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Dawson</option>
                                                        <option value="America/Dawson_Creek" <?php if($time_zone == 'America/Dawson_Creek'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Dawson Creek</option>
                                                        <option value="America/Denver" <?php if($time_zone == 'America/Denver'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Denver</option>
                                                        <option value="America/Detroit" <?php if($time_zone == 'America/Detroit'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Detroit</option>
                                                        <option value="America/Dominica" <?php if($time_zone == 'America/Dominica'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Dominica</option>
                                                        <option value="America/Edmonton" <?php if($time_zone == 'America/Edmonton'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Edmonton</option>
                                                        <option value="America/Eirunepe" <?php if($time_zone == 'America/Eirunepe'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Eirunepe</option>
                                                        <option value="America/El_Salvador" <?php if($time_zone == 'America/El_Salvador'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) El Salvador</option>
                                                        <option value="America/Fort_Nelson" <?php if($time_zone == 'America/Fort_Nelson'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Fort Nelson</option>
                                                        <option value="America/Fortaleza" <?php if($time_zone == 'America/Fortaleza'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Fortaleza</option>
                                                        <option value="America/Glace_Bay" <?php if($time_zone == 'America/Glace_Bay'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Glace Bay</option>
                                                        <option value="America/Godthab" <?php if($time_zone == 'America/Godthab'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Godthab</option>
                                                        <option value="America/Goose_Bay" <?php if($time_zone == 'America/Goose_Bay'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Goose Bay</option>
                                                        <option value="America/Grand_Turk" <?php if($time_zone == 'America/Grand_Turk'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Grand Turk</option>
                                                        <option value="America/Grenada" <?php if($time_zone == 'America/Grenada'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Grenada</option>
                                                        <option value="America/Guadeloupe" <?php if($time_zone == 'America/Guadeloupe'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Guadeloupe</option>
                                                        <option value="America/Guatemala" <?php if($time_zone == 'America/Guatemala'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Guatemala</option>
                                                        <option value="America/Guayaquil" <?php if($time_zone == 'America/Guayaquil'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Guayaquil</option>
                                                        <option value="America/Guyana" <?php if($time_zone == 'America/Guyana'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Guyana</option>
                                                        <option value="America/Halifax" <?php if($time_zone == 'America/Halifax'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Halifax</option>
                                                        <option value="America/Havana" <?php if($time_zone == 'America/Havana'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Havana</option>
                                                        <option value="America/Hermosillo" <?php if($time_zone == 'America/Hermosillo'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Hermosillo</option>
                                                        <option value="America/Indiana/Indianapolis" <?php if($time_zone == 'America/Indiana/Indianapolis'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Indianapolis</option>
                                                        <option value="America/Indiana/Knox" <?php if($time_zone == 'America/Indiana/Knox'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Indiana/Knox</option>
                                                        <option value="America/Indiana/Marengo" <?php if($time_zone == 'America/Indiana/Marengo'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Marengo</option>
                                                        <option value="America/Indiana/Petersburg" <?php if($time_zone == 'America/Indiana/Petersburg'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Petersburg</option>
                                                        <option value="America/Indiana/Tell_City" <?php if($time_zone == 'America/Indiana/Tell_City'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Indiana/Tell City</option>
                                                        <option value="America/Indiana/Vevay" <?php if($time_zone == 'America/Indiana/Vevay'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Vevay</option>
                                                        <option value="America/Indiana/Vincennes" <?php if($time_zone == 'America/Indiana/Vincennes'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Vincennes</option>
                                                        <option value="America/Indiana/Winamac" <?php if($time_zone == 'America/Indiana/Winamac'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Indiana/Winamac</option>
                                                        <option value="America/Inuvik" <?php if($time_zone == 'America/Inuvik'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Inuvik</option>
                                                        <option value="America/Iqaluit" <?php if($time_zone == 'America/Iqaluit'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Iqaluit</option>
                                                        <option value="America/Jamaica" <?php if($time_zone == 'America/Jamaica'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Jamaica</option>
                                                        <option value="America/Juneau" <?php if($time_zone == 'America/Juneau'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Juneau</option>
                                                        <option value="America/Kentucky/Louisville" <?php if($time_zone == 'America/Kentucky/Louisville'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Kentucky/Louisville</option>
                                                        <option value="America/Kentucky/Monticello" <?php if($time_zone == 'America/Kentucky/Monticello'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Kentucky/Monticello</option>
                                                        <option value="America/Kralendijk" <?php if($time_zone == 'America/Kralendijk'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Kralendijk</option>
                                                        <option value="America/La_Paz" <?php if($time_zone == 'America/La_Paz'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) La Paz</option>
                                                        <option value="America/Lima" <?php if($time_zone == 'America/Lima'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Lima</option>
                                                        <option value="America/Los_Angeles" <?php if($time_zone == 'America/Los_Angeles'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Los Angeles</option>
                                                        <option value="America/Lower_Princes" <?php if($time_zone == 'America/Lower_Princes'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Lower Princes</option>
                                                        <option value="America/Maceio" <?php if($time_zone == 'America/Maceio'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Maceio</option>
                                                        <option value="America/Managua" <?php if($time_zone == 'America/Managua'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Managua</option>
                                                        <option value="America/Manaus" <?php if($time_zone == 'America/Manaus'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Manaus</option>
                                                        <option value="America/Marigot" <?php if($time_zone == 'America/Marigot'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Marigot</option>
                                                        <option value="America/Martinique" <?php if($time_zone == 'America/Martinique'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Martinique</option>
                                                        <option value="America/Matamoros" <?php if($time_zone == 'America/Matamoros'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Matamoros</option>
                                                        <option value="America/Mazatlan" <?php if($time_zone == 'America/Mazatlan'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Mazatlan</option>
                                                        <option value="America/Menominee" <?php if($time_zone == 'America/Menominee'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Menominee</option>
                                                        <option value="America/Merida" <?php if($time_zone == 'America/Merida'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Merida</option>
                                                        <option value="America/Metlakatla" <?php if($time_zone == 'America/Metlakatla'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Metlakatla</option>
                                                        <option value="America/Mexico_City" <?php if($time_zone == 'America/Mexico_City'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Mexico City</option>
                                                        <option value="America/Miquelon" <?php if($time_zone == 'America/Miquelon'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Miquelon</option>
                                                        <option value="America/Moncton" <?php if($time_zone == 'America/Moncton'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Moncton</option>
                                                        <option value="America/Monterrey" <?php if($time_zone == 'America/Monterrey'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Monterrey</option>
                                                        <option value="America/Montevideo" <?php if($time_zone == 'America/Montevideo'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Montevideo</option>
                                                        <option value="America/Montserrat" <?php if($time_zone == 'America/Montserrat'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Montserrat</option>
                                                        <option value="America/Nassau" <?php if($time_zone == 'America/Nassau'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Nassau</option>
                                                        <option value="America/New_York" <?php if($time_zone == 'America/New_York'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) New York</option>
                                                        <option value="America/Nipigon" <?php if($time_zone == 'America/Nipigon'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Nipigon</option>
                                                        <option value="America/Nome" <?php if($time_zone == 'America/Nome'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Nome</option>
                                                        <option value="America/Noronha" <?php if($time_zone == 'America/Noronha'){ echo 'selected'; } ?> >(GMT/UTC - 02:00) Noronha</option>
                                                        <option value="America/North_Dakota/Beulah" <?php if($time_zone == 'America/North_Dakota/Beulah'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) North Dakota/Beulah</option>
                                                        <option value="America/North_Dakota/Center" <?php if($time_zone == 'America/North_Dakota/Center'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) North Dakota/Center</option>
                                                        <option value="America/North_Dakota/New_Salem" <?php if($time_zone == 'America/North_Dakota/New_Salem'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) North Dakota/New Salem</option>
                                                        <option value="America/Ojinaga" <?php if($time_zone == 'America/Ojinaga'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Ojinaga</option>
                                                        <option value="America/Panama" <?php if($time_zone == 'America/Panama'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Panama</option>
                                                        <option value="America/Pangnirtung" <?php if($time_zone == 'America/Pangnirtung'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Pangnirtung</option>
                                                        <option value="America/Paramaribo" <?php if($time_zone == 'America/Paramaribo'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Paramaribo</option>
                                                        <option value="America/Phoenix" <?php if($time_zone == 'America/Phoenix'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Phoenix</option>
                                                        <option value="America/Port-au-Prince" <?php if($time_zone == 'America/Port-au-Prince'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Port-au-Prince</option>
                                                        <option value="America/Port_of_Spain" <?php if($time_zone == 'America/Port_of_Spain'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Port of Spain</option>
                                                        <option value="America/Porto_Velho" <?php if($time_zone == 'America/Porto_Velho'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Porto Velho</option>
                                                        <option value="America/Puerto_Rico" <?php if($time_zone == 'America/Puerto_Rico'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Puerto Rico</option>
                                                        <option value="America/Rainy_River" <?php if($time_zone == 'America/Rainy_River'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Rainy River</option>
                                                        <option value="America/Rankin_Inlet" <?php if($time_zone == 'America/Rankin_Inlet'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Rankin Inlet</option>
                                                        <option value="America/Recife" <?php if($time_zone == 'America/Recife'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Recife</option>
                                                        <option value="America/Regina" <?php if($time_zone == 'America/Regina'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Regina</option>
                                                        <option value="America/Resolute" <?php if($time_zone == 'America/Resolute'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Resolute</option>
                                                        <option value="America/Rio_Branco" <?php if($time_zone == 'America/Rio_Branco'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Rio Branco</option>
                                                        <option value="America/Santarem" <?php if($time_zone == 'America/Santarem'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Santarem</option>
                                                        <option value="America/Santiago" <?php if($time_zone == 'America/Santiago'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Santiago</option>
                                                        <option value="America/Santo_Domingo" <?php if($time_zone == 'America/Santo_Domingo'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Santo Domingo</option>
                                                        <option value="America/Sao_Paulo" <?php if($time_zone == 'America/Sao_Paulo'){ echo 'selected'; } ?> >(GMT/UTC - 02:00) Sao Paulo</option>
                                                        <option value="America/Scoresbysund" <?php if($time_zone == 'America/Scoresbysund'){ echo 'selected'; } ?> >(GMT/UTC - 01:00) Scoresbysund</option>
                                                        <option value="America/Sitka" <?php if($time_zone == 'America/Sitka'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Sitka</option>
                                                        <option value="America/St_Barthelemy" <?php if($time_zone == 'America/St_Barthelemy'){ echo 'selected'; } ?>>(GMT/UTC - 04:00) St. Barthelemy</option>
                                                        <option value="America/St_Johns" <?php if($time_zone == 'America/St_Johns'){ echo 'selected'; } ?> >(GMT/UTC - 03:30) St. Johns</option>
                                                        <option value="America/St_Kitts" <?php if($time_zone == 'America/St_Kitts'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) St. Kitts</option>
                                                        <option value="America/St_Lucia" <?php if($time_zone == 'America/St_Lucia'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) St. Lucia</option>
                                                        <option value="America/St_Thomas" <?php if($time_zone == 'America/St_Thomas'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) St. Thomas</option>
                                                        <option value="America/St_Vincent" <?php if($time_zone == 'America/St_Vincent'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) St. Vincent</option>
                                                        <option value="America/Swift_Current" <?php if($time_zone == 'America/Swift_Current'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Swift Current</option>
                                                        <option value="America/Tegucigalpa" <?php if($time_zone == 'America/Tegucigalpa'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Tegucigalpa</option>
                                                        <option value="America/Thule" <?php if($time_zone == 'America/Thule'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Thule</option>
                                                        <option value="America/Thunder_Bay" <?php if($time_zone == 'America/Thunder_Bay'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Thunder Bay</option>
                                                        <option value="America/Tijuana" <?php if($time_zone == 'America/Tijuana'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Tijuana</option>
                                                        <option value="America/Toronto" <?php if($time_zone == 'America/Toronto'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Toronto</option>
                                                        <option value="America/Tortola" <?php if($time_zone == 'America/Tortola'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Tortola</option>
                                                        <option value="America/Vancouver" <?php if($time_zone == 'America/Vancouver'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Vancouver</option>
                                                        <option value="America/Whitehorse" <?php if($time_zone == 'America/Whitehorse'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Whitehorse</option>
                                                        <option value="America/Winnipeg" <?php if($time_zone == 'America/Winnipeg'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Winnipeg</option>
                                                        <option value="America/Yakutat" <?php if($time_zone == 'America/Yakutat'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Yakutat</option>
                                                        <option value="America/Yellowknife" <?php if($time_zone == 'America/Yellowknife'){ echo 'selected'; } ?> >(GMT/UTC - 07:00) Yellowknife</option>
                                                    </optgroup>
                                                    <optgroup label="Antarctica">
                                                        <option value="Antarctica/Casey" <?php if($time_zone == 'Antarctica/Casey'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Casey</option>
                                                        <option value="Antarctica/Davis" <?php if($time_zone == 'Antarctica/Davis'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Davis</option>
                                                        <option value="Antarctica/DumontDUrville" <?php if($time_zone == 'Antarctica/DumontDUrville'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) DumontDUrville</option>
                                                        <option value="Antarctica/Macquarie" <?php if($time_zone == 'Antarctica/Macquarie'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Macquarie</option>
                                                        <option value="Antarctica/Mawson" <?php if($time_zone == 'Antarctica/Mawson'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Mawson</option>
                                                        <option value="Antarctica/McMurdo" <?php if($time_zone == 'Antarctica/McMurdo'){ echo 'selected'; } ?> >(GMT/UTC + 13:00) McMurdo</option>
                                                        <option value="Antarctica/Palmer" <?php if($time_zone == 'Antarctica/Palmer'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Palmer</option>
                                                        <option value="Antarctica/Rothera" <?php if($time_zone == 'Antarctica/Rothera'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Rothera</option>
                                                        <option value="Antarctica/Syowa" <?php if($time_zone == 'Antarctica/Syowa'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Syowa</option>
                                                        <option value="Antarctica/Troll" <?php if($time_zone == 'Antarctica/Troll'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Troll</option>
                                                        <option value="Antarctica/Vostok" <?php if($time_zone == 'Antarctica/Vostok'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Vostok</option>
                                                    </optgroup>
                                                    <optgroup label="Arctic">
                                                        <option value="Arctic/Longyearbyen" <?php if($time_zone == 'Antarctica/Longyearbyen'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Longyearbyen</option>
                                                    </optgroup>
                                                    <optgroup label="Asia">
                                                        <option value="Asia/Aden" <?php if($time_zone == 'Asia/Aden'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Aden</option>
                                                        <option value="Asia/Almaty" <?php if($time_zone == 'Asia/Almaty'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Almaty</option>
                                                        <option value="Asia/Amman" <?php if($time_zone == 'Asia/Amman'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Amman</option>
                                                        <option value="Asia/Anadyr" <?php if($time_zone == 'Asia/Anadyr'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Anadyr</option>
                                                        <option value="Asia/Aqtau" <?php if($time_zone == 'Asia/Aqtau'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Aqtau</option>
                                                        <option value="Asia/Aqtobe" <?php if($time_zone == 'Asia/Aqtobe'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Aqtobe</option>
                                                        <option value="Asia/Ashgabat" <?php if($time_zone == 'Asia/Ashgabat'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Ashgabat</option>
                                                        <option value="Asia/Baghdad" <?php if($time_zone == 'Asia/Baghdad'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Baghdad</option>
                                                        <option value="Asia/Bahrain" <?php if($time_zone == 'Asia/Bahrain'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Bahrain</option>
                                                        <option value="Asia/Baku" <?php if($time_zone == 'Asia/Baku'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Baku</option>
                                                        <option value="Asia/Bangkok" <?php if($time_zone == 'Asia/Bangkok'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Bangkok</option>
                                                        <option value="Asia/Barnaul" <?php if($time_zone == 'Asia/Barnaul'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Barnaul</option>
                                                        <option value="Asia/Beirut" <?php if($time_zone == 'Asia/Beirut'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Beirut</option>
                                                        <option value="Asia/Bishkek" <?php if($time_zone == 'Asia/Bishkek'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Bishkek</option>
                                                        <option value="Asia/Brunei" <?php if($time_zone == 'Asia/Brunei'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Brunei</option>
                                                        <option value="Asia/Chita" <?php if($time_zone == 'Asia/Chita'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Chita</option>
                                                        <option value="Asia/Choibalsan" <?php if($time_zone == 'Asia/Choibalsan'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Choibalsan</option>
                                                        <option value="Asia/Colombo" <?php if($time_zone == 'Asia/Colombo'){ echo 'selected'; } ?> >(GMT/UTC + 05:30) Colombo</option>
                                                        <option value="Asia/Damascus" <?php if($time_zone == 'Asia/Damascus'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Damascus</option>
                                                        <option value="Asia/Dhaka" <?php if($time_zone == 'Asia/Dhaka'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Dhaka</option>
                                                        <option value="Asia/Dili" <?php if($time_zone == 'Asia/Dili'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Dili</option>
                                                        <option value="Asia/Dubai" <?php if($time_zone == 'Asia/Dubai'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Dubai</option>
                                                        <option value="Asia/Dushanbe" <?php if($time_zone == 'Asia/Dushanbe'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Dushanbe</option>
                                                        <option value="Asia/Gaza" <?php if($time_zone == 'Asia/Gaza'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Gaza</option>
                                                        <option value="Asia/Hebron" <?php if($time_zone == 'Asia/Hebron'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Hebron</option>
                                                        <option value="Asia/Ho_Chi_Minh" <?php if($time_zone == 'Asia/Ho_Chi_Minh'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Ho Chi Minh</option>
                                                        <option value="Asia/Hong_Kong" <?php if($time_zone == 'Asia/Hong_Kong'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Hong Kong</option>
                                                        <option value="Asia/Hovd" <?php if($time_zone == 'Asia/Hovd'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Hovd</option>
                                                        <option value="Asia/Irkutsk" <?php if($time_zone == 'Asia/Irkutsk'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Irkutsk</option>
                                                        <option value="Asia/Jakarta" <?php if($time_zone == 'Asia/Jakarta'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Jakarta</option>
                                                        <option value="Asia/Jayapura" <?php if($time_zone == 'Asia/Jayapura'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Jayapura</option>
                                                        <option value="Asia/Jerusalem" <?php if($time_zone == 'Asia/Jerusalem'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Jerusalem</option>
                                                        <option value="Asia/Kabul" <?php if($time_zone == 'Asia/Kabul'){ echo 'selected'; } ?> >(GMT/UTC + 04:30) Kabul</option>
                                                        <option value="Asia/Kamchatka" <?php if($time_zone == 'Asia/Kamchatka'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Kamchatka</option>
                                                        <option value="Asia/Karachi" <?php if($time_zone == 'Asia/Karachi'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Karachi</option>
                                                        <option value="Asia/Kathmandu" <?php if($time_zone == 'Asia/Kathmandu'){ echo 'selected'; } ?> >(GMT/UTC + 05:45) Kathmandu</option>
                                                        <option value="Asia/Khandyga" <?php if($time_zone == 'Asia/Khandyga'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Khandyga</option>
                                                        <option value="Asia/Kolkata" <?php if($time_zone == 'Asia/Kolkata'){ echo 'selected'; } ?> >(GMT/UTC + 05:30) Kolkata</option>
                                                        <option value="Asia/Krasnoyarsk" <?php if($time_zone == 'Asia/Krasnoyarsk'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Krasnoyarsk</option>
                                                        <option value="Asia/Kuala_Lumpur" <?php if($time_zone == 'Asia/Kuala_Lumpur'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Kuala Lumpur</option>
                                                        <option value="Asia/Kuching" <?php if($time_zone == 'Asia/Kuching'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Kuching</option>
                                                        <option value="Asia/Kuwait" <?php if($time_zone == 'Asia/Kuwait'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Kuwait</option>
                                                        <option value="Asia/Macau" <?php if($time_zone == 'Asia/Macau'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Macau</option>
                                                        <option value="Asia/Magadan" <?php if($time_zone == 'Asia/Magadan'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Magadan</option>
                                                        <option value="Asia/Makassar" <?php if($time_zone == 'Asia/Makassar'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Makassar</option>
                                                        <option value="Asia/Manila" <?php if($time_zone == 'Asia/Manila'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Manila</option>
                                                        <option value="Asia/Muscat" <?php if($time_zone == 'Asia/Muscat'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Muscat</option>
                                                        <option value="Asia/Nicosia" <?php if($time_zone == 'Asia/Nicosia'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Nicosia</option>
                                                        <option value="Asia/Novokuznetsk" <?php if($time_zone == 'Asia/Novokuznetsk'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Novokuznetsk</option>
                                                        <option value="Asia/Novosibirsk" <?php if($time_zone == 'Asia/Novosibirsk'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Novosibirsk</option>
                                                        <option value="Asia/Omsk" <?php if($time_zone == 'Asia/Omsk'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Omsk</option>
                                                        <option value="Asia/Oral" <?php if($time_zone == 'Asia/Oral'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Oral</option>
                                                        <option value="Asia/Phnom_Penh" <?php if($time_zone == 'Asia/Phnom_Penh'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Phnom Penh</option>
                                                        <option value="Asia/Pontianak" <?php if($time_zone == 'Asia/Pontianak'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Pontianak</option>
                                                        <option value="Asia/Pyongyang" <?php if($time_zone == 'Asia/Pyongyang'){ echo 'selected'; } ?> >(GMT/UTC + 08:30) Pyongyang</option>
                                                        <option value="Asia/Qatar" <?php if($time_zone == 'Asia/Qatar'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Qatar</option>
                                                        <option value="Asia/Qyzylorda" <?php if($time_zone == 'Asia/Qyzylorda'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Qyzylorda</option>
                                                        <option value="Asia/Rangoon" <?php if($time_zone == 'Asia/Rangoon'){ echo 'selected'; } ?> >(GMT/UTC + 06:30) Rangoon</option>
                                                        <option value="Asia/Riyadh" <?php if($time_zone == 'Asia/Riyadh'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Riyadh</option>
                                                        <option value="Asia/Sakhalin" <?php if($time_zone == 'Asia/Sakhalin'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Sakhalin</option>
                                                        <option value="Asia/Samarkand" <?php if($time_zone == 'Asia/Samarkand'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Samarkand</option>
                                                        <option value="Asia/Seoul" <?php if($time_zone == 'Asia/Seoul'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Seoul</option>
                                                        <option value="Asia/Shanghai" <?php if($time_zone == 'Asia/Shanghai'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Shanghai</option>
                                                        <option value="Asia/Singapore" <?php if($time_zone == 'Asia/Singapore'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Singapore</option>
                                                        <option value="Asia/Srednekolymsk" <?php if($time_zone == 'Asia/Srednekolymsk'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Srednekolymsk</option>
                                                        <option value="Asia/Taipei" <?php if($time_zone == 'Asia/Taipei'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Taipei</option>
                                                        <option value="Asia/Tashkent" <?php if($time_zone == 'Asia/Tashkent'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Tashkent</option>
                                                        <option value="Asia/Tbilisi" <?php if($time_zone == 'Asia/Tbilisi'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Tbilisi</option>
                                                        <option value="Asia/Tehran" <?php if($time_zone == 'Asia/Tehran'){ echo 'selected'; } ?> >(GMT/UTC + 03:30) Tehran</option>
                                                        <option value="Asia/Thimphu" <?php if($time_zone == 'Asia/Thimphu'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Thimphu</option>
                                                        <option value="Asia/Tokyo" <?php if($time_zone == 'Asia/Tokyo'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Tokyo</option>
                                                        <option value="Asia/Ulaanbaatar" <?php if($time_zone == 'Asia/Ulaanbaatar'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Ulaanbaatar</option>
                                                        <option value="Asia/Urumqi" <?php if($time_zone == 'Asia/Urumqi'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Urumqi</option>
                                                        <option value="Asia/Ust-Nera" <?php if($time_zone == 'Asia/Ust-Nera'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Ust-Nera</option>
                                                        <option value="Asia/Vientiane" <?php if($time_zone == 'Asia/Vientiane'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Vientiane</option>
                                                        <option value="Asia/Vladivostok" <?php if($time_zone == 'Asia/Vladivostok'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Vladivostok</option>
                                                        <option value="Asia/Yakutsk" <?php if($time_zone == 'Asia/Yakutsk'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Yakutsk</option>
                                                        <option value="Asia/Yekaterinburg" <?php if($time_zone == 'Asia/Yekaterinburg'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Yekaterinburg</option>
                                                        <option value="Asia/Yerevan" <?php if($time_zone == 'Asia/Yerevan'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Yerevan</option>
                                                    </optgroup>
                                                    <optgroup label="Atlantic">
                                                        <option value="Atlantic/Azores" <?php if($time_zone == 'Atlantic/Azores'){ echo 'selected'; } ?> >(GMT/UTC - 01:00) Azores</option>
                                                        <option value="Atlantic/Bermuda" <?php if($time_zone == 'Atlantic/Bermuda'){ echo 'selected'; } ?> >(GMT/UTC - 04:00) Bermuda</option>
                                                        <option value="Atlantic/Canary" <?php if($time_zone == 'Atlantic/Canary'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Canary</option>
                                                        <option value="Atlantic/Cape_Verde" <?php if($time_zone == 'Atlantic/Cape_Verde'){ echo 'selected'; } ?> >(GMT/UTC - 01:00) Cape Verde</option>
                                                        <option value="Atlantic/Faroe" <?php if($time_zone == 'Atlantic/Faroe'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Faroe</option>
                                                        <option value="Atlantic/Madeira" <?php if($time_zone == 'Atlantic/Madeira'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Madeira</option>
                                                        <option value="Atlantic/Reykjavik" <?php if($time_zone == 'Atlantic/Reykjavik'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Reykjavik</option>
                                                        <option value="Atlantic/South_Georgia" <?php if($time_zone == 'Atlantic/South_Georgia'){ echo 'selected'; } ?> >(GMT/UTC - 02:00) South Georgia</option>
                                                        <option value="Atlantic/St_Helena" <?php if($time_zone == 'Atlantic/St_Helena'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) St. Helena</option>
                                                        <option value="Atlantic/Stanley" <?php if($time_zone == 'Atlantic/Stanley'){ echo 'selected'; } ?> >(GMT/UTC - 03:00) Stanley</option>
                                                    </optgroup>
                                                    <optgroup label="Australia">
                                                        <option value="Australia/Adelaide" <?php if($time_zone == 'Australia/Adelaide'){ echo 'selected'; } ?> >(GMT/UTC + 10:30) Adelaide</option>
                                                        <option value="Australia/Brisbane" <?php if($time_zone == 'Australia/Brisbane'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Brisbane</option>
                                                        <option value="Australia/Broken_Hill" <?php if($time_zone == 'Australia/Broken_Hill'){ echo 'selected'; } ?> >(GMT/UTC + 10:30) Broken Hill</option>
                                                        <option value="Australia/Currie" <?php if($time_zone == 'Australia/Currie'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Currie</option>
                                                        <option value="Australia/Darwin" <?php if($time_zone == 'Australia/Darwin'){ echo 'selected'; } ?> >(GMT/UTC + 09:30) Darwin</option>
                                                        <option value="Australia/Eucla" <?php if($time_zone == 'Australia/Eucla'){ echo 'selected'; } ?> >(GMT/UTC + 08:45) Eucla</option>
                                                        <option value="Australia/Hobart" <?php if($time_zone == 'Australia/Hobart'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Hobart</option>
                                                        <option value="Australia/Lindeman" <?php if($time_zone == 'Australia/Lindeman'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Lindeman</option>
                                                        <option value="Australia/Lord_Howe" <?php if($time_zone == 'Australia/Lord_Howe'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Lord Howe</option>
                                                        <option value="Australia/Melbourne" <?php if($time_zone == 'Australia/Melbourne'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Melbourne</option>
                                                        <option value="Australia/Perth" <?php if($time_zone == 'Australia/Perth'){ echo 'selected'; } ?> >(GMT/UTC + 08:00) Perth</option>
                                                        <option value="Australia/Sydney" <?php if($time_zone == 'Australia/Sydney'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Sydney</option>
                                                    </optgroup>
                                                    <optgroup label="Europe">
                                                        <option value="Europe/Amsterdam" <?php if($time_zone == 'Europe/Amsterdam'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Amsterdam</option>
                                                        <option value="Europe/Andorra" <?php if($time_zone == 'Europe/Andorra'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Andorra</option>
                                                        <option value="Europe/Astrakhan" <?php if($time_zone == 'Europe/Astrakhan'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Astrakhan</option>
                                                        <option value="Europe/Athens" <?php if($time_zone == 'Europe/Athens'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Athens</option>
                                                        <option value="Europe/Belgrade" <?php if($time_zone == 'Europe/Belgrade'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Belgrade</option>
                                                        <option value="Europe/Berlin" <?php if($time_zone == 'Europe/Berlin'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Berlin</option>
                                                        <option value="Europe/Bratislava" <?php if($time_zone == 'Europe/Bratislava'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Bratislava</option>
                                                        <option value="Europe/Brussels" <?php if($time_zone == 'Europe/Brussels'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Brussels</option>
                                                        <option value="Europe/Bucharest" <?php if($time_zone == 'Europe/Bucharest'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Bucharest</option>
                                                        <option value="Europe/Budapest" <?php if($time_zone == 'Europe/Budapest'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Budapest</option>
                                                        <option value="Europe/Busingen" <?php if($time_zone == 'Europe/Busingen'){ echo 'selected'; } ?>v >(GMT/UTC + 01:00) Busingen</option>
                                                        <option value="Europe/Chisinau" <?php if($time_zone == 'Europe/Chisinau'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Chisinau</option>
                                                        <option value="Europe/Copenhagen" <?php if($time_zone == 'Europe/Copenhagen'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Copenhagen</option>
                                                        <option value="Europe/Dublin" <?php if($time_zone == 'Europe/Dublin'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Dublin</option>
                                                        <option value="Europe/Gibraltar" <?php if($time_zone == 'Europe/Gibraltar'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Gibraltar</option>
                                                        <option value="Europe/Guernsey" <?php if($time_zone == 'Europe/Guernsey'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Guernsey</option>
                                                        <option value="Europe/Helsinki" <?php if($time_zone == 'Europe/Helsinki'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Helsinki</option>
                                                        <option value="Europe/Isle_of_Man" <?php if($time_zone == 'Europe/Isle_of_Man'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Isle of Man</option>
                                                        <option value="Europe/Istanbul" <?php if($time_zone == 'Europe/Istanbul'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Istanbul</option>
                                                        <option value="Europe/Jersey" <?php if($time_zone == 'Europe/Jersey'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Jersey</option>
                                                        <option value="Europe/Kaliningrad" <?php if($time_zone == 'Europe/Kaliningrad'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Kaliningrad</option>
                                                        <option value="Europe/Kiev" <?php if($time_zone == 'Europe/Kiev'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Kiev</option>
                                                        <option value="Europe/Lisbon" <?php if($time_zone == 'Europe/Lisbon'){ echo 'selected'; } ?> >(GMT/UTC + 00:00) Lisbon</option>
                                                        <option value="Europe/Ljubljana" <?php if($time_zone == 'Europe/Ljubljana'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Ljubljana</option>
                                                        <option value="Europe/London" <?php if($time_zone == 'Europe/London'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) London</option>
                                                        <option value="Europe/Luxembourg" <?php if($time_zone == 'Europe/Luxembourg'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Luxembourg</option>
                                                        <option value="Europe/Madrid" <?php if($time_zone == 'Europe/Madrid'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Madrid</option>
                                                        <option value="Europe/Malta" <?php if($time_zone == 'Europe/Malta'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Malta</option>
                                                        <option value="Europe/Mariehamn" <?php if($time_zone == 'Europe/Mariehamn'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Mariehamn</option>
                                                        <option value="Europe/Minsk" <?php if($time_zone == 'Europe/Minsk'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Minsk</option>
                                                        <option value="Europe/Monaco" <?php if($time_zone == 'Europe/Monaco'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Monaco</option>
                                                        <option value="Europe/Moscow" <?php if($time_zone == 'Europe/Moscow'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Moscow</option>
                                                        <option value="Europe/Oslo" <?php if($time_zone == 'Europe/Oslo'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Oslo</option>
                                                        <option value="Europe/Paris" <?php if($time_zone == 'Europe/Paris'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Paris</option>
                                                        <option value="Europe/Podgorica" <?php if($time_zone == 'Europe/Podgorica'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Podgorica</option>
                                                        <option value="Europe/Prague" <?php if($time_zone == 'Europe/Prague'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Prague</option>
                                                        <option value="Europe/Riga" <?php if($time_zone == 'Europe/Riga'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Riga</option>
                                                        <option value="Europe/Rome" <?php if($time_zone == 'Europe/Rome'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Rome</option>
                                                        <option value="Europe/Samara" <?php if($time_zone == 'Europe/Samara'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Samara</option>
                                                        <option value="Europe/San_Marino" <?php if($time_zone == 'Europe/San_Marino'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) San Marino</option>
                                                        <option value="Europe/Sarajevo" <?php if($time_zone == 'Europe/Sarajevo'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Sarajevo</option>
                                                        <option value="Europe/Simferopol" <?php if($time_zone == 'Europe/Simferopol'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Simferopol</option>
                                                        <option value="Europe/Skopje" <?php if($time_zone == 'Europe/Skopje'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Skopje</option>
                                                        <option value="Europe/Sofia" <?php if($time_zone == 'Europe/Sofia'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Sofia</option>
                                                        <option value="Europe/Stockholm" <?php if($time_zone == 'Europe/Stockholm'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Stockholm</option>
                                                        <option value="Europe/Tallinn" <?php if($time_zone == 'Europe/Tallinn'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Tallinn</option>
                                                        <option value="Europe/Tirane" <?php if($time_zone == 'Europe/Tirane'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Tirane</option>
                                                        <option value="Europe/Ulyanovsk" <?php if($time_zone == 'Europe/Ulyanovsk'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Ulyanovsk</option>
                                                        <option value="Europe/Uzhgorod" <?php if($time_zone == 'Europe/Uzhgorod'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Uzhgorod</option>
                                                        <option value="Europe/Vaduz" <?php if($time_zone == 'Europe/Vaduz'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Vaduz</option>
                                                        <option value="Europe/Vatican" <?php if($time_zone == 'Europe/Vatican'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Vatican</option>
                                                        <option value="Europe/Vienna" <?php if($time_zone == 'Europe/Vienna'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Vienna</option>
                                                        <option value="Europe/Vilnius" <?php if($time_zone == 'Europe/Vilnius'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Vilnius</option>
                                                        <option value="Europe/Volgograd" <?php if($time_zone == 'Europe/Volgograd'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Volgograd</option>
                                                        <option value="Europe/Warsaw" <?php if($time_zone == 'Europe/Warsaw'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Warsaw</option>
                                                        <option value="Europe/Zagreb" <?php if($time_zone == 'Europe/Zagreb'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Zagreb</option>
                                                        <option value="Europe/Zaporozhye" <?php if($time_zone == 'Europe/Zaporozhye'){ echo 'selected'; } ?> >(GMT/UTC + 02:00) Zaporozhye</option>
                                                        <option value="Europe/Zurich" <?php if($time_zone == 'Europe/Zurich'){ echo 'selected'; } ?> >(GMT/UTC + 01:00) Zurich</option>
                                                    </optgroup>
                                                    <optgroup label="Indian">
                                                        <option value="Indian/Antananarivo" <?php if($time_zone == 'Indian/Antananarivo'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Antananarivo</option>
                                                        <option value="Indian/Chagos" <?php if($time_zone == 'Indian/Chagos'){ echo 'selected'; } ?> >(GMT/UTC + 06:00) Chagos</option>
                                                        <option value="Indian/Christmas" <?php if($time_zone == 'Indian/Christmas'){ echo 'selected'; } ?> >(GMT/UTC + 07:00) Christmas</option>
                                                        <option value="Indian/Cocos" <?php if($time_zone == 'Indian/Cocos'){ echo 'selected'; } ?> >(GMT/UTC + 06:30) Cocos</option>
                                                        <option value="Indian/Comoro" <?php if($time_zone == 'Indian/Comoro'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Comoro</option>
                                                        <option value="Indian/Kerguelen" <?php if($time_zone == 'Indian/Kerguelen'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Kerguelen</option>
                                                        <option value="Indian/Mahe" <?php if($time_zone == 'Indian/Mahe'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Mahe</option>
                                                        <option value="Indian/Maldives" <?php if($time_zone == 'Indian/Maldives'){ echo 'selected'; } ?> >(GMT/UTC + 05:00) Maldives</option>
                                                        <option value="Indian/Mauritius" <?php if($time_zone == 'Indian/Mauritius'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Mauritius</option>
                                                        <option value="Indian/Mayotte" <?php if($time_zone == 'Indian/Mayotte'){ echo 'selected'; } ?> >(GMT/UTC + 03:00) Mayotte</option>
                                                        <option value="Indian/Reunion" <?php if($time_zone == 'Indian/Reunion'){ echo 'selected'; } ?> >(GMT/UTC + 04:00) Reunion</option>
                                                    </optgroup>
                                                    <optgroup label="Pacific">
                                                        <option value="Pacific/Apia" <?php if($time_zone == 'Pacific/Apia'){ echo 'selected'; } ?> >(GMT/UTC + 14:00) Apia</option>
                                                        <option value="Pacific/Auckland" <?php if($time_zone == 'Pacific/Auckland'){ echo 'selected'; } ?> >(GMT/UTC + 13:00) Auckland</option>
                                                        <option value="Pacific/Bougainville" <?php if($time_zone == 'Pacific/Bougainville'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Bougainville</option>
                                                        <option value="Pacific/Chatham" <?php if($time_zone == 'Pacific/Chatham'){ echo 'selected'; } ?> >(GMT/UTC + 13:45) Chatham</option>
                                                        <option value="Pacific/Chuuk" <?php if($time_zone == 'Pacific/Chuuk'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Chuuk</option>
                                                        <option value="Pacific/Easter" <?php if($time_zone == 'Pacific/Easter'){ echo 'selected'; } ?> >(GMT/UTC - 05:00) Easter</option>
                                                        <option value="Pacific/Efate" <?php if($time_zone == 'Pacific/Efate'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Efate</option>
                                                        <option value="Pacific/Enderbury" <?php if($time_zone == 'Pacific/Enderbury'){ echo 'selected'; } ?> >(GMT/UTC + 13:00) Enderbury</option>
                                                        <option value="Pacific/Fakaofo" <?php if($time_zone == 'Pacific/Fakaofo'){ echo 'selected'; } ?> >(GMT/UTC + 13:00) Fakaofo</option>
                                                        <option value="Pacific/Fiji" <?php if($time_zone == 'Pacific/Fiji'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Fiji</option>
                                                        <option value="Pacific/Funafuti" <?php if($time_zone == 'Pacific/Funafuti'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Funafuti</option>
                                                        <option value="Pacific/Galapagos" <?php if($time_zone == 'Pacific/Galapagos'){ echo 'selected'; } ?> >(GMT/UTC - 06:00) Galapagos</option>
                                                        <option value="Pacific/Gambier" <?php if($time_zone == 'Pacific/Gambier'){ echo 'selected'; } ?> >(GMT/UTC - 09:00) Gambier</option>
                                                        <option value="Pacific/Guadalcanal" <?php if($time_zone == 'Pacific/Guadalcanal'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Guadalcanal</option>
                                                        <option value="Pacific/Guam" <?php if($time_zone == 'Pacific/Guam'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Guam</option>
                                                        <option value="Pacific/Honolulu" <?php if($time_zone == 'Pacific/Honolulu'){ echo 'selected'; } ?> >(GMT/UTC - 10:00) Honolulu</option>
                                                        <option value="Pacific/Johnston" <?php if($time_zone == 'Pacific/Johnston'){ echo 'selected'; } ?> >(GMT/UTC - 10:00) Johnston</option>
                                                        <option value="Pacific/Kiritimati" <?php if($time_zone == 'Pacific/Kiritimati'){ echo 'selected'; } ?> >(GMT/UTC + 14:00) Kiritimati</option>
                                                        <option value="Pacific/Kosrae" <?php if($time_zone == 'Pacific/Kosrae'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Kosrae</option>
                                                        <option value="Pacific/Kwajalein" <?php if($time_zone == 'Pacific/Kwajalein'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Kwajalein</option>
                                                        <option value="Pacific/Majuro" <?php if($time_zone == 'Pacific/Majuro'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Majuro</option>
                                                        <option value="Pacific/Marquesas" <?php if($time_zone == 'Pacific/Marquesas'){ echo 'selected'; } ?> >(GMT/UTC - 09:30) Marquesas</option>
                                                        <option value="Pacific/Midway" <?php if($time_zone == 'Pacific/Midway'){ echo 'selected'; } ?> >(GMT/UTC - 11:00) Midway</option>
                                                        <option value="Pacific/Nauru" <?php if($time_zone == 'Pacific/Nauru'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Nauru</option>
                                                        <option value="Pacific/Niue" <?php if($time_zone == 'Pacific/Niue'){ echo 'selected'; } ?> >(GMT/UTC - 11:00) Niue</option>
                                                        <option value="Pacific/Norfolk" <?php if($time_zone == 'Pacific/Norfolk'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Norfolk</option>
                                                        <option value="Pacific/Noumea" <?php if($time_zone == 'Pacific/Noumea'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Noumea</option>
                                                        <option value="Pacific/Pago_Pago" <?php if($time_zone == 'Pacific/Pago_Pago'){ echo 'selected'; } ?> >(GMT/UTC - 11:00) Pago Pago</option>
                                                        <option value="Pacific/Palau" <?php if($time_zone == 'Pacific/Palau'){ echo 'selected'; } ?> >(GMT/UTC + 09:00) Palau</option>
                                                        <option value="Pacific/Pitcairn" <?php if($time_zone == 'Pacific/Pitcairn'){ echo 'selected'; } ?> >(GMT/UTC - 08:00) Pitcairn</option>
                                                        <option value="Pacific/Pohnpei" <?php if($time_zone == 'Pacific/Pohnpei'){ echo 'selected'; } ?> >(GMT/UTC + 11:00) Pohnpei</option>
                                                        <option value="Pacific/Port_Moresby" <?php if($time_zone == 'Pacific/Port_Moresby'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Port Moresby</option>
                                                        <option value="Pacific/Rarotonga" <?php if($time_zone == 'Pacific/Rarotonga'){ echo 'selected'; } ?> >(GMT/UTC - 10:00) Rarotonga</option>
                                                        <option value="Pacific/Saipan" <?php if($time_zone == 'Pacific/Saipan'){ echo 'selected'; } ?> >(GMT/UTC + 10:00) Saipan</option>
                                                        <option value="Pacific/Tahiti" <?php if($time_zone == 'Pacific/Tahiti'){ echo 'selected'; } ?> >(GMT/UTC - 10:00) Tahiti</option>
                                                        <option value="Pacific/Tarawa" <?php if($time_zone == 'Pacific/Tarawa'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Tarawa</option>
                                                        <option value="Pacific/Tongatapu" <?php if($time_zone == 'Pacific/Tongatapu'){ echo 'selected'; } ?> >(GMT/UTC + 13:00) Tongatapu</option>
                                                        <option value="Pacific/Wake" <?php if($time_zone == 'Pacific/Wake'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Wake</option>
                                                        <option value="Pacific/Wallis" <?php if($time_zone == 'Pacific/Wallis'){ echo 'selected'; } ?> >(GMT/UTC + 12:00) Wallis</option>
                                                    </optgroup>
                                                </select>
                                            </div>

                                        </div>

                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_timezone_form_submit" value="Save Changes">

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div id="tab3" class="archt-woo-delivery-tabcontent delivery_pickup_order_delivery_pickup_calendar_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Order Delivery Pickup Calendar</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div id="tab4" class="archt-woo-delivery-tabcontent delivery_pickup_order_reports_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Order Reports</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                            </div>
                        </div>
                    </div>
                </div> -->

                <div id="tab5" class="archt-woo-delivery-tabcontent delivery_pickup_Order_Settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">

                        <p class="arch-woo-delivery-card-header">Order Settings</p>

                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">


                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_delivery_order_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_woo_delivery_order_setting_form_submit">
                                        
                                        <div class="arch-woo-delivery-form-group">

                                            <span class="arch-woo-delivery-form-label" style="width:330px">Allow Order for:</span>

                                            <p class="arch-woo-delivery-tooltip" tooltip="Choose if you want to give the freedom to customer whether he wants Home delivery or he picks the ordered products from a pickup location. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>

                                            <div class="arch_order_type">
                                                <span class="td_item"><input type="radio" id="order_type" name="order_type" value="pick_up" <?php if(isset($order_type)){ if($order_type =='pick_up'){ ?>checked <?php } } ?> ><label for="order_type">Pickup</label></span><span class="td_item"><input type="radio" id="order_type1" name="order_type" value="delivery" <?php if(isset($order_type)){ if($order_type =='delivery'){ ?>checked <?php } } ?> ><label for="order_type">Delivery</label></span><span class="td_item"><input type="radio" id="order_type2" name="order_type" value="both" <?php if(isset($order_type)){ if($order_type =='both'){ ?>checked <?php } } ?> ><label for="order_type">Both</label></span>

                                            </div> 
                                            
                                        </div>


                                        <div class="arch-woo-delivery-form-group">

                                            <span class="arch-woo-delivery-form-label" style="width:330px">Default Order Type:</span>

                                            <p class="arch-woo-delivery-tooltip" tooltip="Choose if you want set default order type on checkout page. Default is Delivery."><span class="dashicons dashicons-editor-help"></span></p>

                                            <div class="arch_default_order_type_checkout">
                                                <span class="td_item"><input type="radio" id="default_order_type" name="default_order_type" value="pick_up" <?php if(isset($order_type_checkout)){ if($order_type_checkout =='pick_up'){ ?>checked <?php } } ?> ><label for="default_order_type">Pickup</label></span><span class="td_item"><input type="radio" id="default_order_type2" name="default_order_type" value="delivery" <?php if(isset($order_type_checkout)){ if($order_type_checkout =='delivery'){ ?>checked <?php } } ?> ><label for="default_order_type2">Delivery</label></span>

                                            </div> 
                                            
                                        </div>


                                        <div class="arch-woo-delivery-form-group_flex">

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_order_type_field_label">Order Type Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Order Type field label. Default is Order Type."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_order_type_field_label" name="arch_woo_order_type_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($order_type_label)){ echo esc_html($order_type_label); } ?>" placeholder="Order Type" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_option_label">Delivery Option Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Order Type's Home Delivery option label. Default is Delivery."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_option_label" name="arch_woo_delivery_option_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($delivery_option_label)){ echo esc_html($delivery_option_label); } ?>" placeholder="Delivery" autocomplete="off">
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_pickup_option_label">Self Pickup Option Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Order Type's Self Pickup option label. Default is Pickup."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_pickup_option_label" name="arch_woo_pickup_option_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($pickup_option_label)){ echo esc_html($pickup_option_label); } ?>" placeholder="Pickup" autocomplete="off">
                                            </div>

                                        </div>

                                        <!-- for pro 
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Dynamically Enable/Disable Delivery/Pickup Based on WooCommerce Shipping</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to see the delivery or pickup option based on your WoCommerce Shipping. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_enable_dynamic_order_type">
                                                <input type="checkbox" name="arch_woo_delivery_enable_dynamic_order_type" id="arch_woo_delivery_enable_dynamic_order_type" class="arch_woo_delivery_enable_dynamic_order_type">
                                                <div class="arch-woo-delivery-toogle-slider"></div>
                                            </label>
                                        </div>

                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Dynamically Change Shipping Method Based on Delivery/Pickup</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to see the delivery or pickup option based on your WoCommerce Shipping. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_enable_dynamic_order_type">
                                                <input type="checkbox" name="arch_woo_delivery_enable_dynamic_order_type" id="arch_woo_delivery_enable_dynamic_order_type" class="arch_woo_delivery_enable_dynamic_order_type">
                                                <div class="arch-woo-delivery-toogle-slider"></div>
                                            </label>
                                        </div>
                                        -->
                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_delivery_option_form_submit" value="Save Changes">

                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab6" class="archt-woo-delivery-tabcontent delivery_pickup_Delivery_Date_Settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Delivery Date Settings</p>
                        <?php
                        
                        ?>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">


                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_delivery_date_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_delivery_date_settings_form_submit">
                                       
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Delivery Date</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable Delivery Date input field in woocommerce order checkout page."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_enable_delivery_date">
                                                <input type="checkbox" name="arch_enable_delivery_date" id="arch_enable_delivery_date" <?php if(isset($archtechwoodelivery_activation_default_delivery_date_show_hide)){ if($archtechwoodelivery_activation_default_delivery_date_show_hide == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Delivery Date Field Mandatory</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make Delivery Date input field mandatory in woocommerce order checkout page. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_delivery_date_mandatory">
                                                <input type="checkbox" name="arch_delivery_date_mandatory" id="arch_delivery_date_mandatory" <?php if(isset($archtechwoodelivery_activation_default_delivery_date_mandatory)){ if($archtechwoodelivery_activation_default_delivery_date_mandatory == '1'){ echo 'checked'; } } ?>>
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>


                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_date_field_label">Delivery Date Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Date input field label and placeholder. Default is Delivery Date."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_delivery_date_field_label" name="arch_delivery_date_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_date_label_text)){ echo esc_html($archtechwoodelivery_activation_default_delivery_date_label_text); } ?>" placeholder="" autocomplete="off">
                                            </div>

                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_date_selectable_date">Allow Delivery in Next Available Days</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="User can only select the number of date from calander that is specified Here. Other dates are disabled. Only numerical value is excepted. Default is 365 days."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" id="arch_delivery_date_selectable_date" name="arch_delivery_date_selectable_date" type="number" class="arch-woo-delivery-number-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            -->

                                            <div class="arch-woo-delivery-form-group ">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_date_week_starts_from">Week Starts From</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Date's calendar will start from the day that is selected Here. Default is Sunday."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_delivery_date_week_starts_from" id="arch_delivery_date_week_starts_from">
                                                    <option value="">Select Day</option>
                                                    <option value="0" <?php if($week_start==0){ echo 'selected="selected"'; } ?>>Sunday</option>
                                                    <option value="1" <?php if($week_start==1){ echo 'selected="selected"'; } ?>>Monday</option>
                                                    <option value="2" <?php if($week_start==2){ echo 'selected="selected"'; } ?>>Tuesday</option>
                                                    <option value="3" <?php if($week_start==3){ echo 'selected="selected"'; } ?>>Wednesday</option>
                                                    <option value="4" <?php if($week_start==4){ echo 'selected="selected"'; } ?>>Thursday</option>
                                                    <option value="5" <?php if($week_start==5){ echo 'selected="selected"'; } ?>>Friday</option>
                                                    <option value="6" <?php if($week_start==6){ echo 'selected="selected"'; } ?>>Saturday</option>
                                                </select>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_date_format">Delivery Date Format</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Date format that is used in everywhere which is available by this plugin. Default is F j, Y ( ex. March 6, 2011 )."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_delivery_date_format" id="arch_delivery_date_format">
                                                    <option value="MM d, yy" <?php if($del_date_format=="MM d, yy"){ echo 'selected="selected"'; } ?>>F j, Y ( ex. March 6, 2011 )</option>
                                                    <option value="dd-mm-yy" <?php if($del_date_format=="dd-mm-yy"){ echo 'selected="selected"'; } ?>>d-m-Y ( ex. 29-03-2011 )</option>
                                                    <option value="mm/dd/yy" <?php if($del_date_format=="mm/dd/yy"){ echo 'selected="selected"'; } ?>>m/d/Y ( ex. 03/29/2011 )</option>
                                                    <option value="dd.mm.yy" <?php if($del_date_format=="dd.mm.yy"){ echo 'selected="selected"'; } ?>>d.m.Y ( ex. 29.03.2011 )</option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Auto Select 1st Available Date</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable the option if you want to select the first available date automatically and shown in the delivery date field. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_auto_select_first_date">
                                                <input type="checkbox" name="arch_auto_select_first_date" id="arch_auto_select_first_date" checked="">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->

                                        <div class="arch-woo-delivery-form-group arc_ali_fir">
                                            <label class="arch-woo-delivery-form-label arch-woo-delivery-checkbox-label" for="arch_delivery_date_delivery_days">Delivery Days</label>
                                            <p class="arch-woo-delivery-tooltip arch-woo-delivery-checkbox-tooltip" tooltip="Delivery is only available in those days that are checked. Other dates corresponding to the unchecked days are disabled in the calendar."><span class="dashicons dashicons-editor-help"></span></p>
                                            <div id="arch_delivery_date_delivery_days" style="display:inline-block">

                                                <label class="arch-woo-delivery-checkbox-field-text"> <input type="checkbox" name="arch_delivery_date_delivery_days[]" value="6" <?php if(in_array(6, $missing_date_arr)){ ?> checked <?php } ?>> Saturday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_delivery_date_delivery_days[]" value="0" <?php if(in_array(0, $missing_date_arr)){ ?> checked <?php } ?>> Sunday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"> <input type="checkbox" name="arch_delivery_date_delivery_days[]" value="1" <?php if(in_array(1, $missing_date_arr)){ ?> checked <?php } ?>> Monday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_delivery_date_delivery_days[]" value="2" <?php if(in_array(2, $missing_date_arr)){ ?> checked <?php } ?>> Tuesday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_delivery_date_delivery_days[]" value="3" <?php if(in_array(3, $missing_date_arr)){ ?> checked <?php } ?>> Wednesday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_delivery_date_delivery_days[]" value="4" <?php if(in_array(4, $missing_date_arr)){ ?> checked <?php } ?>> Thursday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_delivery_date_delivery_days[]" value="5" <?php if(in_array(5, $missing_date_arr)){ ?> checked <?php } ?>> Friday</label><br>


                                            </div>
                                        </div>



                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_date_form_submit" value="Save Changes">

                                    </form>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab7" class="archt-woo-delivery-tabcontent delivery_pickup_Pickup_Date_Settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Pickup Date Settings</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_delivery_pickup_date_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_delivery_pickup_date_form_submit">
                                        
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Pickup Date</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable Pickup Date input field in woocommerce order checkout page."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_enable_pickup_date">
                                                <input type="checkbox" name="arch_enable_pickup_date" id="arch_enable_pickup_date" <?php if(isset($archtechwoodelivery_activation_default_pickup_date_show_hide)){ if($archtechwoodelivery_activation_default_pickup_date_show_hide == '1'){ echo 'checked'; } } ?>>
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Pickup Date Field Mandatory</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make Pickup Date input field mandatory in woocommerce order checkout page. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_pickup_date_mandatory">
                                                <input type="checkbox" name="arch_pickup_date_mandatory" id="arch_pickup_date_mandatory" <?php if(isset($archtechwoodelivery_activation_default_pickup_date_mandatory)){ if($archtechwoodelivery_activation_default_pickup_date_mandatory == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>

                                        <div class="arch-woo-delivery-form-group_flex">

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_date_field_label">Pickup Date Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Pickup Date input field heading. Default is Pickup Date."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_pickup_date_field_label" name="arch_pickup_date_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_date_label_text)){ echo esc_html($archtechwoodelivery_activation_default_pickup_date_label_text); } ?>" placeholder="" autocomplete="off">
                                            </div>

                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_date_selectable_date">Allow Pickup in Next Available Days</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="User can only select the number of date from calander that is specified Here. Other dates are disabled. Only numerical value is excepted. Default is 365 days."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" id="arch_pickup_date_selectable_date" name="arch_pickup_date_selectable_date" type="number" class="arch-woo-delivery-number-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            -->

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_date_week_starts_from">Week Starts From</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Pickup Date's calendar will start from the day that is selected Here. Default is Sunday."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_pickup_date_week_starts_from" id="arch_pickup_date_week_starts_from">
                                                    <option value="" selected="">Select Day</option>
                                                    <option value="0" <?php if($p_week_start==0){ echo 'selected="selected"'; } ?>>Sunday</option>
                                                    <option value="1" <?php if($p_week_start==1){ echo 'selected="selected"'; } ?>>Monday</option>
                                                    <option value="2" <?php if($p_week_start==2){ echo 'selected="selected"'; } ?>>Tuesday</option>
                                                    <option value="3" <?php if($p_week_start==3){ echo 'selected="selected"'; } ?>>Wednesday</option>
                                                    <option value="4" <?php if($p_week_start==4){ echo 'selected="selected"'; } ?>>Thursday</option>
                                                    <option value="5" <?php if($p_week_start==5){ echo 'selected="selected"'; } ?>>Friday</option>
                                                    <option value="6" <?php if($p_week_start==6){ echo 'selected="selected"'; } ?>>Saturday</option>
                                                </select>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_date_format">Pickup Date Format</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Date format that is used in everywhere which is available by this plugin. Default is F j, Y ( ex. March 6, 2011 )."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_pickup_date_format" id="arch_pickup_date_format">
                                                     <option value="MM d, yy" <?php if($p_del_date_format=="MM d, yy"){ echo 'selected="selected"'; } ?>>F j, Y ( ex. March 6, 2011 )</option>
                                                    <option value="dd-mm-yy" <?php if($p_del_date_format=="dd-mm-yy"){ echo 'selected="selected"'; } ?>>d-m-Y ( ex. 29-03-2011 )</option>
                                                    <option value="mm/dd/yy" <?php if($p_del_date_format=="mm/dd/yy"){ echo 'selected="selected"'; } ?>>m/d/Y ( ex. 03/29/2011 )</option>
                                                    <option value="dd.mm.yy" <?php if($p_del_date_format=="dd.mm.yy"){ echo 'selected="selected"'; } ?>>d.m.Y ( ex. 29.03.2011 )</option>

                                                </select>
                                            </div>

                                        </div>


                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Auto Select 1st Available Date</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable the option if you want to select the first available date automatically and shown in the pickup date field. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_auto_select_first_pickup_date">
                                                <input type="checkbox" name="arch_auto_select_first_pickup_date" id="arch_auto_select_first_pickup_date">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->

                                        <div class="arch-woo-delivery-form-group arc_ali_fir">
                                            <label class="arch-woo-delivery-form-label arch-woo-delivery-checkbox-label" for="arch_pickup_date_delivery_days">Pickup Days</label>
                                            <p class="arch-woo-delivery-tooltip arch-woo-delivery-checkbox-tooltip" tooltip="Pickup is only available in those days that are checked. Other dates corresponding to the unchecked days are disabled in the calendar."><span class="dashicons dashicons-editor-help"></span></p>
                                            <div id="arch_pickup_date_delivery_days" style="display:inline-block">
                                                <label class="arch-woo-delivery-checkbox-field-text"> <input type="checkbox" name="arch_pickup_date_delivery_days[]" value="6" <?php if(in_array(6, $p_missing_date_arr)){ ?> checked <?php } ?>> Saturday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_pickup_date_delivery_days[]" value="0" <?php if(in_array(0, $p_missing_date_arr)){ ?> checked <?php } ?>> Sunday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"> <input type="checkbox" name="arch_pickup_date_delivery_days[]" value="1" <?php if(in_array(1, $p_missing_date_arr)){ ?> checked <?php } ?>> Monday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_pickup_date_delivery_days[]" value="2" <?php if(in_array(2, $p_missing_date_arr)){ ?> checked <?php } ?>> Tuesday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_pickup_date_delivery_days[]" value="3" <?php if(in_array(3, $p_missing_date_arr)){ ?> checked <?php } ?>> Wednesday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_pickup_date_delivery_days[]" value="4" <?php if(in_array(4, $p_missing_date_arr)){ ?> checked <?php } ?>> Thursday</label><br>
                                                <label class="arch-woo-delivery-checkbox-field-text"><input type="checkbox" name="arch_pickup_date_delivery_days[]" value="5" <?php if(in_array(5, $p_missing_date_arr)){ ?> checked <?php } ?>> Friday</label><br>
                                            </div>
                                        </div>

                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_pickup_date_form_submit" value="Save Changes">

                                    </form>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab8" class="archt-woo-delivery-tabcontent delivery_pickup_Off_Days_Holidays_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Off Days/Holidays</p>
                        <div class="archt-woo-delivery-card-body">
                            <div class="archt-woo-delivery-body-content">
                            <div class="archt-delivery-ofday">
                                <div class="arch-woo-delivery-form-group">
                                   
                                        <input type="text" name="" id="" placeholder="Year (ex. 2019)">
                                
                                </div>

                                <div class="arch-woo-delivery-form-group">
                                  
                                        <select style="" class="arch_select_month_mandatory" name="coderockz_woo_delivery_offdays_month_2024[]">
                                            <option value="">Select Month</option>
                                            <option value="january">January</option>
                                            <option value="february">February</option>
                                            <option value="march">March</option>
                                            <option value="april">April</option>
                                            <option value="may">May</option>
                                            <option value="june">June</option>
                                            <option value="july">July</option>
                                            <option value="august">August</option>
                                            <option value="september">September</option>
                                            <option value="october">October</option>
                                            <option value="november">November</option>
                                            <option value="december">December</option>
                                        </select>
                                    
                                </div>
                                
                                    <div class="arch-woo-delivery-form-group">
                                                                         <input type="text" name="" id="" placeholder="Comma(,) Separeted Date">
                                                                   </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab9" class="archt-woo-delivery-tabcontent delivery_pickup_Delivery_Time_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Delivery Time</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">


                                <div class="woo-delivery-body-form">
                                     <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_delivery_time_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_delivery_time_form_submit">
                                        
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Delivery Time</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable Delivery Time select field in woocommerce order checkout page."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_enable_delivery_time">
                                                <input type="checkbox" name="arch_enable_delivery_time" id="arch_enable_delivery_time" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_show_hide)){ if($archtechwoodelivery_activation_default_delivery_time_show_hide == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Delivery Time Field Mandatory</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make Delivery Time select field mandatory in woocommerce order checkout page. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_delivery_time_mandatory">
                                                <input type="checkbox" name="arch_delivery_time_mandatory" id="arch_delivery_time_mandatory" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_mandatory)){ if($archtechwoodelivery_activation_default_delivery_time_mandatory == '1'){ ?> checked <?php } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>

                                        <div class="arch-woo-delivery-form-group_flex">


                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_field_label">Delivery Time Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Time select field label and placeholder. Default is Delivery Time."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_delivery_time_field_label" name="arch_delivery_time_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_time_label_text)){ echo esc_html($archtechwoodelivery_activation_default_delivery_time_label_text); } ?>" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_slot_starts">Time Slot Starts From</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Time starts from the time that is specified here. Only numerical value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_delivery_time_slot_starts" class="arch_delivery_time_slot_starts">

                                                    <input id="arch_delivery_time_slot_starts_hour" name="arch_delivery_time_slot_starts_hour" type="number" class="arch-woo-delivery-number-field" max="12" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 12 || this.value < 1) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_starts_hour)){ echo esc_html($archtechwoodelivery_activation_default_delivery_time_slot_starts_hour); } ?>" placeholder="Hour" autocomplete="off">
                                                    <input id="arch_delivery_time_slot_starts_min" name="arch_delivery_time_slot_starts_min" type="number" class="arch-woo-delivery-number-field" max="59" min="0" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 59 || this.value < 0) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_starts_min)){ echo esc_html($archtechwoodelivery_activation_default_delivery_time_slot_starts_min); } ?>" placeholder="Minute" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_delivery_time_slot_starts_format" id="arch_delivery_time_slot_starts_format">
                                                        <option value="am" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_starts_format)){ if(strtolower($archtechwoodelivery_activation_default_delivery_time_slot_starts_format) =='am'){ echo 'selected'; } } ?> >AM</option>
                                                        <option value="pm" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_starts_format)){ if(strtolower($archtechwoodelivery_activation_default_delivery_time_slot_starts_format) =='pm'){ echo 'selected'; } } ?> >PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_slot_ends">Time Slot Ends At</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Time ends at the time that is specified here. Only numerical value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_delivery_time_slot_ends" class="arch_delivery_time_slot_ends">
                                                    <input id="arch_delivery_time_slot_ends_hour" name="arch_delivery_time_slot_ends_hour" type="number" class="arch-woo-delivery-number-field" max="12" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 12 || this.value < 1) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_ends_hour)){ echo esc_html($archtechwoodelivery_activation_default_delivery_time_slot_ends_hour); } ?>" placeholder="Hour" autocomplete="off">
                                                    <input id="arch_delivery_time_slot_ends_min" name="arch_delivery_time_slot_ends_min" type="number" class="arch-woo-delivery-number-field" max="59" min="0" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 59 || this.value < 0) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_ends_min)){ echo esc_html($archtechwoodelivery_activation_default_delivery_time_slot_ends_min); } ?>" placeholder="Minute" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_delivery_time_slot_ends_format" id="arch_delivery_time_slot_ends_format">
                                                        <option value="am" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_ends_format)){ if(strtolower($archtechwoodelivery_activation_default_delivery_time_slot_ends_format) == 'am'){ echo 'selected'; } } ?> >AM</option>
                                                        <option value="pm" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_ends_format)){ if(strtolower($archtechwoodelivery_activation_default_delivery_time_slot_ends_format) == 'pm'){ echo 'selected'; } } ?> >PM</option>
                                                    </select>
                                                </div>
                                                <p class="arch_end_time_greater_notice">End Time Must after Start Time</p>
                                            </div>


                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_slot_duration">Each Time Slot Duration</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each delivery time slot duration that is specified here. Only numerical value is accepted. Default is 3 hours."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_delivery_time_slot_duration" class="arch_delivery_time_slot_duration">
                                                   
                                                    <select class="arch-woo-delivery-select-field" name="arch_delivery_time_slot_duration_format" id="arch_delivery_time_slot_duration_format">
                                                        <option value="30" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_duration_format)){ if($archtechwoodelivery_activation_default_delivery_time_slot_duration_format == '30'){ echo 'selected'; } } ?> >30 Minutes</option>
                                                        <option value="60" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_slot_duration_format)){ if($archtechwoodelivery_activation_default_delivery_time_slot_duration_format == '60'){ echo 'selected'; } } ?> >60 Minutes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_slot_duration">Each Time Slot Duration</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each delivery time slot duration that is specified here. Only numerical value is accepted. Default is 3 hours."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_delivery_time_slot_duration" class="arch_delivery_time_slot_duration">
                                                    <input name="arch_delivery_time_slot_duration_time" type="number" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" class="arch-woo-delivery-number-field" value="10" placeholder="" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_delivery_time_slot_duration_format" id="arch_delivery_time_slot_duration_format">
                                                        <option value="min">Minutes</option>
                                                        <option value="hour" selected="selected">Hour</option>
                                                    </select>
                                                </div>
                                            </div>
                                            -->

                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_maximum_order">Maximum Order Per Time Slot</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each time slot take maximum number of orders that is specified here. After reaching the maximum order, the time slot is disabled automaticaly. Only numerical value is accepted. Blank this field or 0 value means each time slot takes unlimited order."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_delivery_time_maximum_order" name="arch_delivery_time_maximum_order" type="number" class="arch-woo-delivery-number-field" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" value="1" placeholder="" autocomplete="off">
                                            </div>
                                            -->

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_format">Delivery Time format</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Time format that is used in everywhere which is available by this plugin. Default is 12 Hours."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_delivery_time_format" id="arch_delivery_time_format">
                                                    <option value="12" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_format)){ if($archtechwoodelivery_activation_default_delivery_time_format == '12'){ echo 'selected'; } } ?> >12 Hours</option>
                                                    <option value="24" <?php if(isset($archtechwoodelivery_activation_default_delivery_time_format)){ if($archtechwoodelivery_activation_default_delivery_time_format == '24'){ echo 'selected'; } } ?> >24 Hours</option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Disable Current Time Slot</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make the time slot disabled that has the current time. In default, the time slot isn't disabled that has the current time."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_delivery_time_disable_current_time_slot">
                                                <input type="checkbox" name="arch_delivery_time_disable_current_time_slot" id="arch_delivery_time_disable_current_time_slot">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->
                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Auto Select 1st Available Time</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable the option if you want to select the first available time based on date automatically and shown in the delivery time field. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_auto_select_first_time">
                                                <input type="checkbox" name="arch_auto_select_first_time" id="arch_auto_select_first_time">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->

                                        <input class="arch-woo-delivery-submit-btn" type="submit" id="arch_delivery_time_form_submit" name="arch_delivery_time_form_submit" value="Save Changes">

                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div id="tab10" class="archt-woo-delivery-tabcontent delivery_pickup_Custom_Time_Slots_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Custom Time Slots</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->


                <div id="tab11" class="archt-woo-delivery-tabcontent delivery_pickup_Pickup_Time_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Pickup Time</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                     <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_pickup_time_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_pickup_time_form_submit">
                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="1b198b441f"><input type="hidden" name="_wp_http_referer" value="/orderdelivery/wp-admin/admin.php?page=arch-woo-delivery-settings">
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Pickup Time</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable arch select field in woocommerce order checkout page."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_enable_pickup_time">
                                                <input type="checkbox" name="arch_enable_pickup_time" id="arch_enable_pickup_time" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_show_hide)){ if($archtechwoodelivery_activation_default_pickup_time_show_hide == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Pickup Time Field Mandatory</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make arch select field mandatory in woocommerce order checkout page. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_pickup_time_mandatory">
                                                <input type="checkbox" name="arch_pickup_time_mandatory" id="arch_pickup_time_mandatory" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_mandatory)){ if($archtechwoodelivery_activation_default_pickup_time_mandatory == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group_flex">

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_field_label">Pickup Time Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="arch select field heading. Default is arch."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_pickup_time_field_label" name="arch_pickup_time_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_time_label_text)){ echo esc_html($archtechwoodelivery_activation_default_pickup_time_label_text); } ?>" placeholder="" autocomplete="off">
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_slot_starts">Pickup Time Slot Starts From</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="arch starts from the time that is specified here. Only numerical value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_pickup_time_slot_starts" class="arch_pickup_time_slot_starts">

                                                    <input id="arch_pickup_time_slot_starts_hour" name="arch_pickup_time_slot_starts_hour" type="number" class="arch-woo-delivery-number-field" max="12" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 12 || this.value < 1) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_starts_hour)){ echo esc_html($archtechwoodelivery_activation_default_pickup_time_slot_starts_hour); } ?>" placeholder="Hour" autocomplete="off">
                                                    <input id="arch_pickup_time_slot_starts_min" name="arch_pickup_time_slot_starts_min" type="number" class="arch-woo-delivery-number-field" max="59" min="0" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 59 || this.value < 0) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_starts_min)){ echo esc_html($archtechwoodelivery_activation_default_pickup_time_slot_starts_min); } ?>" placeholder="Minute" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_pickup_time_slot_starts_format" id="arch_pickup_time_slot_starts_format">
                                                        <option value="am" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_starts_format)){ if(strtolower($archtechwoodelivery_activation_default_pickup_time_slot_starts_format) =='am'){ echo 'selected'; } } ?> >AM</option>
                                                        <option value="pm" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_starts_format)){ if(strtolower($archtechwoodelivery_activation_default_pickup_time_slot_starts_format) =='pm'){ echo 'selected'; } } ?> >PM</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_delivery_time_slot_ends">Pickup Time Slot Ends At</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="arch ends at the time that is specified here. Only numerical value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_pickup_time_slot_ends" class="arch_pickup_time_slot_ends">
                                                    <input id="arch_pickup_time_slot_ends_hour" name="arch_pickup_time_slot_ends_hour" type="number" class="arch-woo-delivery-number-field" max="12" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 12 || this.value < 1) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_ends_hour)){ echo esc_html($archtechwoodelivery_activation_default_pickup_time_slot_ends_hour); } ?>" placeholder="Hour" autocomplete="off">
                                                    <input id="arch_pickup_time_slot_ends_min" name="arch_pickup_time_slot_ends_min" type="number" class="arch-woo-delivery-number-field" max="59" min="0" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value > 59 || this.value < 0) this.value = null;" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_ends_min)){ echo esc_html($archtechwoodelivery_activation_default_pickup_time_slot_ends_min); } ?>" placeholder="Minute" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_pickup_time_slot_ends_format" id="arch_pickup_time_slot_ends_format">
                                                        <option value="am" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_ends_format)){ if(strtolower($archtechwoodelivery_activation_default_pickup_time_slot_ends_format) =='am'){ echo 'selected'; } } ?> >AM</option>
                                                        <option value="pm" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_ends_format)){ if(strtolower($archtechwoodelivery_activation_default_pickup_time_slot_ends_format) =='pm'){ echo 'selected'; } } ?> >PM</option>
                                                    </select>
                                                </div>
                                                <!-- <p class="arch_pickup_end_time_greater_notice">End Time Must after Start Time</p> -->
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_slot_duration">Each Time Slot Duration</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each Pickup time slot duration that is specified here. Only numerical value is accepted. Default is 30 Minutes."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_pickup_time_slot_duration" class="arch_pickup_time_slot_duration">
                                                   
                                                    <select class="arch-woo-pickup-select-field" name="arch_pickup_time_slot_duration_format" id="arch_pickup_time_slot_duration_format">
                                                        <option value="30" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_duration_format)){ if($archtechwoodelivery_activation_default_pickup_time_slot_duration_format == '30'){ echo 'selected'; } } ?> >30 Minutes</option>
                                                        <option value="60" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_slot_duration_format)){ if($archtechwoodelivery_activation_default_pickup_time_slot_duration_format == '60'){ echo 'selected'; } } ?> >60 Minutes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group slot_dur_cont">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_slot_duration">Each Pickup Time Slot Duration</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each arch slot duration that is specified here. Only numerical value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <div id="arch_pickup_time_slot_duration" class="arch_pickup_time_slot_duration">
                                                    <input name="arch_pickup_time_slot_duration_time" type="number" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" class="arch-woo-delivery-number-field" value="" placeholder="" autocomplete="off">
                                                    <select class="arch-woo-delivery-select-field" name="arch_pickup_time_slot_duration_format">
                                                        <option value="min" selected="selected">Minutes</option>
                                                        <option value="hour">Hour</option>
                                                    </select>
                                                </div>
                                            </div>
                                            -->
                                            <!-- for pro
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_maximum_order">Maximum Pickup Per Time Slot</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Each time slot take maximum number of pickups that is specified here. After reaching the maximum pickup, the time slot is disabled automaticaly. Only numerical value is accepted. Blank this field means each time slot takes unlimited pickup."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_pickup_time_maximum_order" name="arch_pickup_time_maximum_order" type="number" class="arch-woo-delivery-number-field" min="1" onkeyup="if(!Number.isInteger(Number(this.value)) || this.value < 1) this.value = null;" value="" placeholder="" autocomplete="off">
                                            </div>
                                            -->

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_time_format">Pickup Time format</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Time format that is used in everywhere which is available by this plugin. Default is 12 Hours."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_pickup_time_format" id="arch_pickup_time_format">
                                                    <option value="12" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_format)){ if($archtechwoodelivery_activation_default_pickup_time_format == '12'){ echo 'selected'; } } ?> >12 Hours</option>
                                                    <option value="24" <?php if(isset($archtechwoodelivery_activation_default_pickup_time_format)){ if($archtechwoodelivery_activation_default_pickup_time_format == '24'){ echo 'selected'; } } ?> >24 Hours</option>
                                                </select>
                                            </div>


                                        </div>

                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Disable Current Time Slot</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make the time slot disabled that has the current time. In default, the time slot isn't disabled that has the current time."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_pickup_time_disable_current_time_slot">
                                                <input type="checkbox" name="arch_pickup_time_disable_current_time_slot" id="arch_pickup_time_disable_current_time_slot">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->
                                        <!-- for pro
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Auto Select 1st Available Time</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable the option if you want to select the first available time based on date automatically and shown in the arch field. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_auto_select_first_pickup_time">
                                                <input type="checkbox" name="arch_auto_select_first_pickup_time" id="arch_auto_select_first_pickup_time">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->
                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_pickup_time_form_submit" value="Save Changes">

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div id="tab12" class="archt-woo-delivery-tabcontent delivery_pickup_Pickup_Location_Settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Pickup Location Settings</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_pickup_location_setting_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <form action="" method="post" id="arch_pickup_location_settings_form_submit">
                                        
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Pickup Location</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable Pickup Location select field in woocommerce order checkout page."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_enable_pickup_location">
                                                <input type="checkbox" name="arch_enable_pickup_location" id="arch_enable_pickup_location" <?php if(isset($archtechwoodelivery_activation_default_pickup_location_show_hide)){ if($archtechwoodelivery_activation_default_pickup_location_show_hide == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>

                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Pickup Location Field Mandatory</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Make Pickup Location select field mandatory in woocommerce order checkout page. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_pickup_location_mandatory">
                                                <input type="checkbox" name="arch_pickup_location_mandatory" id="arch_pickup_location_mandatory" <?php if(isset($archtechwoodelivery_activation_default_pickup_location_mandatory)){ if($archtechwoodelivery_activation_default_pickup_location_mandatory == '1'){ echo 'checked'; } } ?> >
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>

                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_location_field_label">Pickup Location Field Heading</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Pickup Location input field heading. Default is Pickup Location."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_pickup_location_field_label" name="arch_pickup_location_field_label" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_pickup_location_label_text)){ echo esc_html($archtechwoodelivery_activation_default_pickup_location_label_text); } ?>" placeholder="" autocomplete="off">
                                            </div>
                                            <!-- pro version
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_pickup_location_field_placeholder">Pickup Location Field Placeholder</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Pickup Location input field placeholder. Default is Pickup Location."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_pickup_location_field_placeholder" name="arch_pickup_location_field_placeholder" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            -->
                                        </div>
                                        <!-- pro version
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Disable Location Wise Pickup Days Popup</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="When a customer select the pickup as order type, a popup is appeared with the location wise available pickup days. Default is enable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_pickup_location_popup">
                                                <input type="checkbox" name="arch_woo_delivery_pickup_location_popup" id="arch_woo_delivery_pickup_location_popup">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->
                                        <!-- pro version
                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_pickup_location_popup_heading">Location Wise Pickup Days Popup Heading</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Location Wise Pickup Days Popup Heading. Default is Location Wise Pickup Days."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_pickup_location_popup_heading" name="arch_woo_delivery_pickup_location_popup_heading" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                        </div>

                                        -->
                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_pickup_location_form_submit" value="Save Changes">

                                    </form>








                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab26" class="archt-woo-delivery-tabcontent delivery_pickup_Pickup_Locations_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Pickup Locations</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_pickup_locations_notice"></p>
                                        </div>
                                        
                                    </div>

                                    <?php

                                    global $wpdb;
                                    $plugin_name = $this->plugin_name;
                                    $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
                                    $store_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_name}"));

                                    ?>

                                        <div class="Woostores_main_div">
                                            <div class="store_details_pop"></div>
                                            <div class="stores_hd"><h2>All Stores</h2> <span class="new_store_cr"><a href="javascript:void(0);" class="add_pickup_location_btn"><img src="<?php echo esc_url(plugin_dir_url(__FILE__));  ?>../images/add.png"> Add Pickup Location</a></span></div>
                                            
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

                                        <div class="Woo_Delivery_add_store_main_div" style="display: none;">
                                            <div class="add_store_sub_div">
                                                <div class="store_hdd"><span class="add_st_rg"><h2>Add New Pickup Location</h2></span></div>

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

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- pro version
                <div id="tab13" class="archt-woo-delivery-tabcontent delivery_pickup_Order_Delivery_Tips_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Order Delivery Tips</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <p class="arch-woo-delivery-tips-notice"><span class="dashicons dashicons-yes"></span> Settings Changed Successfully</p>
                                    <form action="" method="post" id="arch_woo_delivery_tips_settings_submit">
                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="07269352dc"><input type="hidden" name="_wp_http_referer" value="/wp-admin/admin.php?page=arch-woo-delivery-settings">
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Enable Delivery Tips Field</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to give customer the opportunity to give a tip amount for the delivery boy. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_enable_delivery_tips">
                                                <input type="checkbox" name="arch_woo_delivery_enable_delivery_tips" id="arch_woo_delivery_enable_delivery_tips">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Make Delivery Tips Field Required</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to force customer give a delivery tips. Default is optional."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_delivery_tips_required">
                                                <input type="checkbox" name="arch_woo_delivery_delivery_tips_required" id="arch_woo_delivery_delivery_tips_required">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label">Delivery Tips Field Label</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Default is Tips to Delivery Person."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input type="text" class="arch-woo-delivery-input-field" name="arch_woo_delivery_tips_field_label" value="" placeholder="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Change Delivery Tips Input Field to Dropdown Field</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to give customer some limited option to choose. Default is a input field where customer can put any amount."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch">
                                                <input type="checkbox" name="arch_woo_delivery_enable_delivery_tips_dropdown" class="arch_woo_delivery_enable_delivery_tips_dropdown">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        <div class="arch_woo_delivery_tips_dropdown_section" style="display: none;">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label">Delivery Tips Values for Dropdown</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Comma separarted values. Only fixed numerical value or percentage value is accepted."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input type="text" class="arch-woo-delivery-input-field" name="arch_woo_delivery_tips_dropdown_value" value="" placeholder="Comma separarted values. Ex. 2%,5,10,5%" autocomplete="off">
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_delivery_tips_precentage_rounding">Delivery Tips Percentage Rounding</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Default is no rounding. Round up setting will transform $10.55 to $11.00 and Round down will transform $10.55 to $10.00."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select class="arch-woo-delivery-select-field" name="arch_woo_delivery_delivery_tips_precentage_rounding">
                                                    <option value="no_round">No Rounding</option>
                                                    <option value="up">Round Up</option>
                                                    <option value="down">Round Down</option>
                                                </select>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <span class="arch-woo-delivery-form-label">Add Input Field Option to Dropdown</span>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to give customer a input field option in the dropdown where customer can put any amount."><span class="dashicons dashicons-editor-help"></span></p>
                                                <label class="arch-woo-delivery-toogle-switch">
                                                    <input type="checkbox" name="arch_woo_delivery_enable_input_field_dropdown" class="arch_woo_delivery_enable_input_field_dropdown">
                                                    <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                                </label>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <span class="arch-woo-delivery-form-label">Percentage Calculation for Order Total Including Discount</span>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to calculate the cart amount including discount for delivery tips percantage calculation. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                                <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_tips_percentage_calculate_discount">
                                                    <input type="checkbox" name="arch_woo_delivery_tips_percentage_calculate_discount" id="arch_woo_delivery_tips_percentage_calculate_discount">
                                                    <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                                </label>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <span class="arch-woo-delivery-form-label">Percentage Calculation for Order Total Including Tax</span>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to calculate the cart amount including tax for delivery tips percantage calculation. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                                <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_tips_percentage_calculate_tax">
                                                    <input type="checkbox" name="arch_woo_delivery_tips_percentage_calculate_tax" id="arch_woo_delivery_tips_percentage_calculate_tax">
                                                    <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                                </label>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <span class="arch-woo-delivery-form-label">Percentage Calculation for Order Total Including Shipping Cost</span>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to calculate the cart amount including shipping cost for delivery tips percantage calculation. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                                <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_tips_percentage_calculate_shipping">
                                                    <input type="checkbox" name="arch_woo_delivery_tips_percentage_calculate_shipping" id="arch_woo_delivery_tips_percentage_calculate_shipping">
                                                    <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                                </label>
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <span class="arch-woo-delivery-form-label">Percentage Calculation for Order Total Including All Fees</span>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Enable it if you want to calculate the cart amount including all fees for delivery tips percantage calculation. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                                <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_tips_percentage_fees">
                                                    <input type="checkbox" name="arch_woo_delivery_tips_percentage_fees" id="arch_woo_delivery_tips_percentage_fees">
                                                    <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label">Add Tax for Delivery Tips</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="If you want to add tax for the delivery tips fee, enable it."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_woo_delivery_tips_add_tax">
                                                <input type="checkbox" name="arch_woo_delivery_tips_add_tax" id="arch_woo_delivery_tips_add_tax">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>

                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_woo_delivery_tips_settings_submit" value="Save Changes">
                                    </form>



                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                -->

                <!-- <div id="tab14" class="archt-woo-delivery-tabcontent delivery_pickup_Cutoff_Time_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Cutoff Time</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->

                <!-- <div id="tab15" class="archt-woo-delivery-tabcontent delivery_pickup_Proccessing_Days_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Proccessing Days</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->

                <!-- <div id="tab16" class="archt-woo-delivery-tabcontent delivery_pickup_Proccessing_Time_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Proccessing Time</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->
            <!-- pro version
                <div id="tab17" class="archt-woo-delivery-tabcontent delivery_pickup_Additional_Fees_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Additional Fees</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <p class="arch-woo-delivery-time-slot-fee-warning"><span class="dashicons dashicons-megaphone"></span> Before This Settings, Please Set Time Slot Starts From &amp; Time Slot Ends At From Delivery Time Tab and <span class="arch-woo-delivery-refresh-btn">refresh the page</span></p>
                                    <p class="arch-woo-delivery-time-slot-fee-notice"><span class="dashicons dashicons-yes"></span> Settings Changed Successfully</p>
                                    <form action="" method="post" id="arch_woo_delivery_time_slot_fee_form_submit">
                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="07269352dc"><input type="hidden" name="_wp_http_referer" value="/wp-admin/admin.php?page=arch-woo-delivery-settings">
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label" style="width: 160px!important;text-align:unset!important">Enable Time Slot Fee</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="By enabling this option, any fee for a specific time slot can be added."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_delivery_date_enable_time_slot_fee">
                                                <input type="checkbox" name="arch_delivery_date_enable_time_slot_fee" id="arch_delivery_date_enable_time_slot_fee">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>


                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-time-slot-fees">
                                                <div class="arch-woo-delivery-form-group">
                                                    <img class="arch-arrow" src="https://woodelivery.arch.com/wp-content/plugins/arch-woocommerce-delivery-date-time-pro//admin/images/arrow.png" alt="" style="width: 20px;vertical-align: top;margin-top: 12px;margin-right: 15px;">
                                                    <select class="arch-woo-delivery-select-field" name="arch_delivery_time_slot[]">
                                                        <option value="">Select Time Slot</option>
                                                        <option value="900-1020">03:00 PM - 05:00 PM</option>
                                                        <option value="1020-1140">05:00 PM - 07:00 PM</option>
                                                        <option value="1140-1260">07:00 PM - 09:00 PM</option>
                                                        <option value="1260-1380">09:00 PM - 11:00 PM</option>
                                                    </select>
                                                    <input type="text" class="arch-woo-delivery-input-field" value="" onkeyup="if(isNaN(parseFloat(Number(this.value))) || isNaN(parseInt(Number(this.value), 10))) this.value = null;" style="vertical-align:top;width: 100px!important;" autocomplete="off" placeholder="Fee" disabled="disabled"><span class="arch-woo-delivery-currency-code">USD</span>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="arch-woo-delivery-time-slot-fee-btn"><span class="dashicons dashicons-plus"></span></button>
                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_woo_delivery_time_slot_fee_form_submit" value="Save Changes">
                                    </form>





                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            -->
                <!-- pro version
                <div id="tab18" class="archt-woo-delivery-tabcontent delivery_pickup_Email_Settings_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Email Settings</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                            </div>
                        </div>
                    </div>
                </div>
            -->
            <!-- pro version
                <div id="tab19" class="archt-woo-delivery-tabcontent delivery_pickup_Addition_Fields_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Addition Fields</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                            </div>
                        </div>
                    </div>
                </div>
            -->
            <!-- pro version
                <div id="tab20" class="archt-woo-delivery-tabcontent delivery_pickup_localization_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Localization</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <p class="arch-woo-delivery-localization-settings-notice"><span class="dashicons dashicons-yes"></span> Settings Changed Successfully</p>

                                    <form action="" method="post" id="arch_delivery_localization_settings_form_submit">
                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="1b198b441f"><input type="hidden" name="_wp_http_referer" value="/orderdelivery/wp-admin/admin.php?page=arch-woo-delivery-settings">
                                        <div class="arch-woo-delivery-form-group_flex">

                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_order_limit_notice">Maximum Delivery Limit Exceed</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Maximum Order Limit Notice. Default is Maximum Order Limit Exceed."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_order_limit_notice" name="arch_woo_delivery_order_limit_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_pickup_limit_notice">Maximum Pickup Limit Exceed</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Maximum Pickup Limit Notice. Default is Maximum Pickup Limit Exceed."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_pickup_limit_notice" name="arch_woo_delivery_pickup_limit_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_delivery_details_text">Delivery Details</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Delivery Details text in order page, single order page, customer account page. Default is Delivery Details."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_delivery_details_text" name="arch_woo_delivery_delivery_details_text" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_order_metabox_heading">Single Order Page Metabox Heading</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Single order page metabox heading text. Default is Delivery Date &amp; Time."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_order_metabox_heading" name="arch_woo_delivery_order_metabox_heading" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_checkout_delivery_option_notice">Order Type Checkout Page Notice</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Notice if you make the order type field required but not given any value to the field. Default is Please Select Your Order Type."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_checkout_delivery_option_notice" name="arch_woo_delivery_checkout_delivery_option_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_checkout_date_notice">Delivery Date Checkout Page Notice</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Notice if you make the delivery date field required but not given any value to the field. Default is Please Enter Delivery Date."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_checkout_date_notice" name="arch_woo_delivery_checkout_date_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_checkout_pickup_date_notice">Pickup Date Checkout Page Notice</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Notice if you make the pickup date field required but not given any value to the field. Default is Please Enter Pickup Date."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_checkout_pickup_date_notice" name="arch_woo_delivery_checkout_pickup_date_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_checkout_time_notice">Delivery Time Checkout Page Notice</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Notice if you make the delivery time field required but not given any value to the field. Default is Please Enter Delivery Time."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_checkout_time_notice" name="arch_woo_delivery_checkout_time_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_checkout_pickup_time_notice">arch Checkout Page Notice</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Notice if you make the arch field required but not given any value to the field. Default is Please Enter arch."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_checkout_pickup_time_notice" name="arch_woo_delivery_checkout_pickup_time_notice" type="text" class="arch-woo-delivery-input-field" value="" placeholder="" autocomplete="off">
                                            </div>

                                        </div>
                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_localization_settings_form_submit" value="Save Changes">

                                    </form>


                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab21" class="archt-woo-delivery-tabcontent delivery_pickup_Exclusion_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Exclusion</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                            </div>
                        </div>
                    </div>
                </div>
            -->

                <!-- <div id="tab22" class="archt-woo-delivery-tabcontent delivery_pickup_Google_Calendar_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Google Calendar</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->

                <!-- <div id="tab23" class="archt-woo-delivery-tabcontent delivery_pickup_Laundry_Service_tab_content" style="display: none;" >
				<div class="archt-woo-delivery-card" >
					<p class="arch-woo-delivery-card-header">Laundry Service</p>
					<div class="archt-woo-delivery-card-body" >
						
						<div class="archt-woo-delivery-body-content">
							
						</div>
					</div>
				</div>
			</div> -->

                <div id="tab24" class="archt-woo-delivery-tabcontent delivery_pickup_Others_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Others</p>
                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <div class="woo-delivery-body-form">

                                    <div class="arch_set_div">
                                        <div class="arch_message_right_div">
                                            <p class="side_notice_div arch_woo_other_setting_notice"></p>
                                        </div>
                                        
                                    </div>


                                    <form action="" method="post" id="arch_delivery_other_settings_form_submit">
                                        
                                        <!-- Pro version
                                        <div class="arch-woo-delivery-form-group">
                                            <span class="arch-woo-delivery-form-label" style="display:unset!important">Enable Delivery Field For Virtual Or Downloadable Products</span>
                                            <p class="arch-woo-delivery-tooltip" tooltip="Enable the delivery fields if there is any virtual or downloadable products in the cart. Default is disable."><span class="dashicons dashicons-editor-help"></span></p>
                                            <label class="arch-woo-delivery-toogle-switch" for="arch_disable_fields_for_downloadable_products">
                                                <input type="checkbox" name="arch_disable_fields_for_downloadable_products" id="arch_disable_fields_for_downloadable_products" checked="">
                                                <div class="arch-woo-delivery-toogle-slider arch-woo-delivery-toogle-round"></div>
                                            </label>
                                        </div>
                                        -->

                                        <div class="arch-woo-delivery-form-group_flex">
                                            <div class="arch-woo-delivery-form-group">
                                                <label class="arch-woo-delivery-form-label" for="arch_woo_delivery_delivery_heading_checkout" style="display:unset!important">Heading On The Checkout Page</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Checkout heading text of delivery section. Default is Delivery Information."><span class="dashicons dashicons-editor-help"></span></p>
                                                <input id="arch_woo_delivery_delivery_heading_checkout" name="arch_woo_delivery_delivery_heading_checkout" type="text" class="arch-woo-delivery-input-field" value="<?php if(isset($archtechwoodelivery_activation_default_checkout_page_heading)){ echo esc_html($archtechwoodelivery_activation_default_checkout_page_heading); } ?>" placeholder="" autocomplete="off">
                                            </div>

                                            <div class="arch-woo-delivery-form-group">
                                                <label style="" class="arch-woo-delivery-form-label" for="arch_woo_delivery_field_position">Field Position</label>
                                                <p class="arch-woo-delivery-tooltip" tooltip="Position of all the fields that are enabled by this plugin in checkout page. Default is Before Customer Details."><span class="dashicons dashicons-editor-help"></span></p>
                                                <select id="arch_woo_delivery_field_position" class="arch-woo-delivery-select-field" name="arch_woo_delivery_field_position">
                                                    <option value="">Select Position</option>
                                                    <option value="woocommerce_checkout_before_customer_details" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_checkout_before_customer_details'){ echo 'selected="selected"'; } ?> >Before Customer Details</option>
                                                    <option value="woocommerce_before_checkout_billing_form" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_before_checkout_billing_form'){ echo 'selected="selected"'; } ?> >Before Billing Address</option>
                                                    <option value="woocommerce_after_checkout_billing_form" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_after_checkout_billing_form'){ echo 'selected="selected"'; } ?> >After Billing Address</option>
                                                    <option value="woocommerce_before_checkout_shipping_form" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_before_checkout_shipping_form'){ echo 'selected="selected"'; } ?> >Before Shipping Address</option>
                                                    <option value="woocommerce_after_checkout_shipping_form" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_after_checkout_shipping_form'){ echo 'selected="selected"'; } ?> >After Shipping Address</option>
                                                    <option value="woocommerce_before_order_notes" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_before_order_notes'){ echo 'selected="selected"'; } ?> >Before Order Notes</option>
                                                    <option value="woocommerce_after_order_notes" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_after_order_notes'){ echo 'selected="selected"'; } ?> >After Order Notes</option>
                                                    <option value="woocommerce_review_order_before_payment" <?php if($archtechwoodelivery_activation_default_checkout_field_possition=='woocommerce_review_order_before_payment'){ echo 'selected="selected"'; } ?> >Between Your Order And Payment Section</option>
                                                    
                                                </select>
                                            </div>

                                        </div>

                                        <div class="arch-woo-delivery-form-group custom_css">
                                            <label class="arch-woo-delivery-form-label" style="display:unset!important">Custom CSS</label>
                                            <p class="arch-woo-delivery-tooltip" tooltip="If you want some custom css to avoid the plugin/theme conflict, put the css code here."><span class="dashicons dashicons-editor-help"></span></p>
                                            <textarea id="arch_woo_delivery_code_editor_css" name="arch_woo_delivery_code_editor_css" class="arch-woo-delivery-textarea-field" placeholder="" autocomplete="off" ><?php if(isset($archtechwoodelivery_activation_default_custom_css)){ echo esc_html($archtechwoodelivery_activation_default_custom_css); } ?></textarea>
                                            
                                        </div>
                                        

                                        <input class="arch-woo-delivery-submit-btn" type="submit" name="arch_delivery_other_settings_form_submit" value="Save Changes">

                                    </form>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- pro version
                <div id="tab25" class="archt-woo-delivery-tabcontent delivery_pickup_Free_VS_Pro_tab_content" style="display: none;">
                    <div class="archt-woo-delivery-card">
                        <p class="arch-woo-delivery-card-header">Free VS Pro</p>

                        <div class="archt-woo-delivery-card-body">

                            <div class="archt-woo-delivery-body-content">

                                <table width="100%" class="archtech_woo_table">
                                    <tbody>
                                        <tr>
                                            <th style="padding: 20px 20px 20px 10px;font-size: 18px;text-align: left;" width="50%">Features</th>
                                            <th width="25%" style="text-align: center;font-size:18px">Free</th>
                                            <th width="25%" style="text-align: center;font-size:18px">PRO</th>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Date</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Individual Pickup Date</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Individual arch</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Option for Selecting Home Delivery or Self Pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Holidays</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Field Position Setting</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Every Texts are Translatable</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Separate Holidays for Delivery &amp; Pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide Plugin Module Completely for Specific Categories/Products</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide Plugin Module For Specific Shipping Method</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide Plugin Module For Specific User Role</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Category/product/zone/state/postcode wise offdays</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Specific dates as offdays for category/product/zone</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Set Specific dates/Weekdays as offdays for Delivery and Pickup individually</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Next Month Off for Certain Category</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Current Week Off/Next Week Off for Certain Category</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Shipping method wise Offdays</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Date Calendar Language</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Custom Delivery Time Slot</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Ability To Sort Orders Based on Delivery Details on The Woocommerce Orders Page</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Custom arch Slot</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show Timeslot Based on Shipping Zone</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show Timeslot Based on Shipping State</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show Timeslot Based on Shipping PostCode</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show Timeslot Based on Cart Products</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show Timeslot Based on Cart Categories</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide Timeslot at a Specific Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide Timeslot for Current day</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Enable Timeslot only for Specific Date</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show archslot Based on Pickup Location</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Time slot with single time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Pickup Location</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Disable same day delivery/pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery/Pickup Details on a Calendar View</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Google Calendar Sync</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">WooCommerce shipping methods automatically changed based on Delivey/Pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Dynamically Enable/Disable Delivery/Pickup Based on WooCommerce Shipping</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Tips Option</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Disable Delivery for Specific Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Disable Self Pickup for Specific Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Restrict Delivery Option(Cart Amount Base)</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Restrict Pickup Option(Cart Amount Base)</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Restrict Delivery Option Based on Category/Product</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Restrict Pickup Option Based on Category/Product</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Restrict Free Shipping(Cart Amount Base)</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Hide/Show free shipping only for today or some specific dates or any weekdays</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Enable/disable Free Shipping only for current date delivery</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Special Open Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Set Category Wise Special Open Days for Delivery and Pickup Individually</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Reports with auto sorting</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Report of Product Quantity</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">One Tab To Control All Deliveries</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Reports As Excel Sheet(xlsx format)</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Product Quantity Reports As Excel Sheet(xlsx format)</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">WooCommerce App Support Using Order Note</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Filtering and Bulk Action Functionality on WooCommerce Order page </td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Controlling Store closing Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Different Store closing Time for Different Weekdays</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Disable Current day or Next Day or Further Day After a Certain Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Category wise Cutoff Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Different Processing Days for Delivery and Pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Category Wise Processing Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Product Wise Processing Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Weekday Wise Processing Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Shipping Zone Wise Processing Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Shipping Method Wise Processing Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Different Processing Time for Delivery and Pickup</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Category Wise Processing Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Product Wise Processing Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Weekday Wise Processing Time</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Time Slot Fee</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Deliver Date Fee</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Weekday wise Delivery Fee</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Delivery Fee/Shipping Method within X Minutes/Hours</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Specific Shipping Method Only for First X Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Discount Coupon wise Specific Delivery Days</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Additional Field</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Change Delivery Details from Order Page</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-yes"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Notify Customer About Delivery Details Changing</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Laundry Service</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature">Google Calendar Sync</td>
                                            <td class="archt-woo-delivery-proFree-free"><span class="dashicons dashicons-no-alt"></span></td>
                                            <td class="archt-woo-delivery-proFree-pro"><span class="dashicons dashicons-yes"></span></td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="archt-woo-delivery-proFree-feature"></td>
                                            <td class="archt-woo-delivery-proFree-free"></td>
                                            <td class="archt-woo-delivery-proFree-pro"><a href="https://archt.com/order-delivery-and-pickup-date-and-time/" target="_blank" class="archt-woo-delivery-buy-now-btn">Buy Now</a></td>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                -->


                <div id="tab27" class="archt-woo-delivery-tabcontent delivery_pickup_support_tab_content" style="display: none;" >
                    <div class="archt-woo-delivery-card" >
                        <p class="arch-woo-delivery-card-header">Support</p>
                        <div class="archt-woo-delivery-card-body" >
                            
                            <div class="archt-woo-delivery-body-content">
                                <div class="supp_div" bis_skin_checked="1">For any queries mail us <a href="mailto:info@webchunky.com"><strong>info@webchunky.com</strong></a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<!---- New dashboard Code ----->


<?php
/**
 * Order Delivery Date Lite Uninstall
 *
 * Uninstalling Order Delivery Date Lite delets all settings for the plugin
 *
 * @author      Archtech Design
 * @package     Order-Pickup/Delivery-Date-Free-for-WooCommerce/Admin/Uninstaller
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly /** 

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}
require plugin_dir_path( __FILE__ ) . 'includes/archtechwoodelivery-class-admin.php';
    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
    global $wpdb;

    /** Order Timezone option and db start **/
    delete_option('archtechwoodelivery_activation_default_time_zone');
    /** Order Timezone option and db end **/

    /** Order Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_order_type');
    delete_option('archtechwoodelivery_activation_default_order_type_checkout');
    delete_option('archtechwoodelivery_activation_default_order_type_field_label');
    delete_option('archtechwoodelivery_activation_default_delivery_option_field_label');
    delete_option('archtechwoodelivery_activation_default_pickup_option_field_label');
    /** Order Settings options and db end **/

    /** Delivery Date Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_delivery_date_show_hide');
    delete_option('archtechwoodelivery_activation_default_delivery_date_mandatory');
    delete_option('archtechwoodelivery_activation_default_delivery_date_label_text');
    delete_option('archtechwoodelivery_activation_default_delivery_date_start_from');
    delete_option('archtechwoodelivery_activation_default_delivery_date_format');
    delete_option('archtechwoodelivery_activation_default_delivery_date_delivery_days');
    /** Delivery Date Settings options and db end **/

    /** Pickup Date Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_pickup_date_show_hide');
    delete_option('archtechwoodelivery_activation_default_pickup_date_mandatory');
    delete_option('archtechwoodelivery_activation_default_pickup_date_label_text');
    delete_option('archtechwoodelivery_activation_default_pickup_date_start_from');
    delete_option('archtechwoodelivery_activation_default_pickup_date_format');
    delete_option('archtechwoodelivery_activation_default_pickup_date_delivery_days');
    /** Pickup Date Settings options and db end **/

    /** Delivery Time Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_delivery_time_show_hide');
    delete_option('archtechwoodelivery_activation_default_delivery_time_mandatory');
    delete_option('archtechwoodelivery_activation_default_delivery_time_label_text');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_hour');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_min');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_format');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_hour');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_min');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_format');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_breaks');
    delete_option('archtechwoodelivery_activation_default_delivery_time_slot_duration_format');
    delete_option('archtechwoodelivery_activation_default_delivery_time_format');
    /** Delivery Time Settings options and db end **/

    /** Pickup Time Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_pickup_time_show_hide');
    delete_option('archtechwoodelivery_activation_default_pickup_time_mandatory');
    delete_option('archtechwoodelivery_activation_default_pickup_time_label_text');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_hour');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_min');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_format');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_hour');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_min');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_format');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_breaks');
    delete_option('archtechwoodelivery_activation_default_pickup_time_slot_duration_format');
    delete_option('archtechwoodelivery_activation_default_pickup_time_format');
    /** Pickup Time Settings options and db end **/

    /** Pickup Location Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_pickup_location_show_hide');
    delete_option('archtechwoodelivery_activation_default_pickup_location_mandatory');
    delete_option('archtechwoodelivery_activation_default_pickup_location_label_text');
    /** Pickup Location Settings options and db end **/

    /** Others Settings options and db start **/
    delete_option('archtechwoodelivery_activation_default_checkout_page_heading');
    delete_option('archtechwoodelivery_activation_default_checkout_field_possition');
    delete_option('archtechwoodelivery_activation_default_custom_css');
    /** Others Settings options and db end **/

    delete_option('archtechwoodelivery_activation_date');
    delete_option('archtechwoodelivery_activation_default_time_slot_range');
    delete_option('archtechwoodelivery_activation_default_slot_interval_option');

    delete_option('archtechwoodelivery_activation_default_start_time');
    delete_option('archtechwoodelivery_activation_default_end_time');
    
    delete_option('archtechwoodelivery_activation_default_ask_time');

    delete_option('archtechwoodelivery_activation_default_time_validation');
    delete_option('archtechwoodelivery_activation_default_interval_time');
    delete_option('archtechwoodelivery_activation_default_pickup_label_text');
    delete_option('archtechwoodelivery_activation_default_date_label_text');
    delete_option('archtechwoodelivery_activation_default_time_label_text');
    delete_option('archtechwoodelivery_activation_default_special_time_text');
    delete_option('archtechwoodelivery_activation_default_additional_charge_text');
    delete_option('archtechwoodelivery_activation_default_all_days');
    delete_option('archtechwoodelivery_activation_default_tips');

    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
    $wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS {$table_name1}") );

    $table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';
    $wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS {$table_name2}") );

    $table_name3 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
    $wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS {$table_name3}") );

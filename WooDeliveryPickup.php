<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly /** 
/*

Plugin Name:  Order Delivery & Pickup Location Date Time ( Free Version)
Plugin URI:   https://webchunky.com/order-delivery-pickup-location-date-time-for-woocommerce/
Description:  This plugin allows buyers to choose their preferred Store, Order Delivery/Pickup Date and Time during checkout(Need to have Woocommerce installed first). 
Version:      1.1.0
Author:       Web Chunky 
Author URI:   https://webchunky.com/
License:      GPLv3
License URI:  https://www.gnu.org/licenses/
Text Domain:  webchunky-order-delivery-pickup-date-time
Domain Path:  /languages
Requires PHP: 5.6
WC requires at least: 3.0.0
WC tested up to: 6.4

*/

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */


define( 'ARCH_WOODELIVERY_VERSION', '1.0.0' );

global $wpdb; //define wpdb global variable

require plugin_dir_path( __FILE__ ) . 'includes/archtechwoodelivery-class-admin.php';
// require plugin_dir_path( __FILE__ ) . 'public/js/settings-page-public.js';


/**
 * Add Woocommerce HPOS compatability
 *
 * @since 1.0.2
 */
    add_action( 'before_woocommerce_init', function() {
        if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
            $file = __FILE__;       
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', $file , true );
        }
    } );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_archtechwoodelivery_admin_class() {

    $plugin = new Arch_Woo_Delivery_Pickup_admin();
    $plugin->arch_woodelivery_run();

}
run_archtechwoodelivery_admin_class();

/************************* plugin activation/deactivation/delete functions start *****************************/
function Archtech_WooDelivery_activation()
{
    $msg = 'It requires WooCommerce version 7.6.0 or higher installed and active. You can download WooCommerce latest version <strong><a href="https://wordpress.org/plugins/woocommerce/">from here</a></strong> Or go back to <strong><a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">plugins page</a></strong>';

    if( !class_exists( 'WooCommerce' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die( 'WooDeliverPickup plugin could not be activated.' . $msg );
       // wp_die( __( 'Please install and Activate WooCommerce.', 'woocommerce-addon-slug' ), 'Plugin dependency check', array( 'back_link' => true ) );
    }

    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = (sanitize_text_field($_REQUEST['plugin'])  !== '') ? sanitize_text_field($_REQUEST['plugin']) : '';
    check_admin_referer( "activate-plugin_{$plugin}" );
    //register_uninstall_hook(    __FILE__, 'Archtech_WooDelivery_uninstall' );

    flush_rewrite_rules();

/********************** set option and db tbl **************************/

    /** Timezone settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_time_zone(); // for archtechwoodelivery_activation_default_time_zone option
    /** Timezone settings option values fn end **/

    /** order settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_order_type(); // for archtechwoodelivery_activation_default_order_type option
        $admin_obj->Arch_Woodelivery_plugin_activation_order_type_checkout(); // for archtechwoodelivery_activation_default_order_type_checkout option
        $admin_obj->Arch_Woodelivery_plugin_activation_order_type_field_label(); // for archtechwoodelivery_activation_default_order_type_field_label option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_option_field_label(); // for archtechwoodelivery_activation_default_delivery_option_field_label option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_option_field_label(); // for archtechwoodelivery_activation_default_pickup_option_field_label option
    /** order settings option values fn end **/

    /** Delivery date settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_date_show_hide(); // for archtechwoodelivery_activation_default_delivery_date_show_hide option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_date_mandatory(); // for archtechwoodelivery_activation_default_delivery_date_mandatory option
        $admin_obj->Arch_Woodelivery_plugin_activation_date_label_text(); // for archtechwoodelivery_activation_default_delivery_date_label_text option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_date_start_from(); // for archtechwoodelivery_activation_default_delivery_date_start_from option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_date_format(); // for archtechwoodelivery_activation_default_delivery_date_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_date_delivery_days(); // for archtechwoodelivery_activation_default_delivery_date_delivery_days option
    /** Delivery date settings option values fn end **/

    /** Pickup date settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_show_hide(); // for archtechwoodelivery_activation_default_pickup_date_show_hide option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_mandatory(); // for archtechwoodelivery_activation_default_pickup_date_mandatory option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_label_text(); // for archtechwoodelivery_activation_default_pickup_date_label_text option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_start_from(); // for archtechwoodelivery_activation_default_pickup_date_start_from option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_format(); // for archtechwoodelivery_activation_default_pickup_date_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_date_delivery_days(); // for archtechwoodelivery_activation_default_pickup_date_delivery_days option
    /** Pickup date settings option values fn end **/

    /** Delivery Time settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_show_hide(); // for archtechwoodelivery_activation_default_delivery_time_show_hide option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_mandatory(); // for archtechwoodelivery_activation_default_delivery_time_mandatory option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_label_text(); // for archtechwoodelivery_activation_default_delivery_time_label_text option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_hour(); // for archtechwoodelivery_activation_default_delivery_time_slot_starts_hour option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_min(); // for archtechwoodelivery_activation_default_delivery_time_slot_starts_min option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_format(); // for archtechwoodelivery_activation_default_delivery_time_slot_starts_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_hour(); // for archtechwoodelivery_activation_default_delivery_time_slot_ends_hour option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_min(); // for archtechwoodelivery_activation_default_delivery_time_slot_ends_min option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_format(); // for archtechwoodelivery_activation_default_delivery_time_slot_ends_format option

        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_breaks(); // for archtechwoodelivery_activation_default_delivery_time_slot_breaks option

        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_slot_duration_format(); // for archtechwoodelivery_activation_default_delivery_time_slot_duration_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_delivery_time_format(); // for archtechwoodelivery_activation_default_delivery_time_format option

    /** Delivery Time settings option values fn end **/

    /** Pickup Time settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_show_hide(); // for archtechwoodelivery_activation_default_pickup_time_show_hide option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_mandatory(); // for archtechwoodelivery_activation_default_pickup_time_mandatory option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_label_text(); // for archtechwoodelivery_activation_default_pickup_time_label_text option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_hour(); // for archtechwoodelivery_activation_default_pickup_time_slot_starts_hour option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_min(); // for archtechwoodelivery_activation_default_pickup_time_slot_starts_min option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_format(); // for archtechwoodelivery_activation_default_pickup_time_slot_starts_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_hour(); // for archtechwoodelivery_activation_default_pickup_time_slot_ends_hour option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_min(); // for archtechwoodelivery_activation_default_pickup_time_slot_ends_min option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_format(); // for archtechwoodelivery_activation_default_pickup_time_slot_ends_format option

        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_breaks(); // for archtechwoodelivery_activation_default_pickup_time_slot_breaks option

        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_slot_duration_format(); // for archtechwoodelivery_activation_default_pickup_time_slot_duration_format option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_time_format(); // for archtechwoodelivery_activation_default_pickup_time_format option

    /** Pickup Time settings option values fn end **/

    /** Pickup loation settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_location_show_hide(); // for archtechwoodelivery_activation_default_pickup_location_show_hide option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_location_mandatory(); // for archtechwoodelivery_activation_default_pickup_location_mandatory option
        $admin_obj->Arch_Woodelivery_plugin_activation_pickup_location_label_text(); // for archtechwoodelivery_activation_default_pickup_location_label_text option
    /** Pickups loation settings option values fn end **/


    /** Others settings option values fn start **/
        $admin_obj->Arch_Woodelivery_plugin_activation_others_checkout_heading(); // for archtechwoodelivery_activation_default_checkout_page_heading option
        $admin_obj->Arch_Woodelivery_plugin_activation_others_field_possition(); // for archtechwoodelivery_activation_default_checkout_field_possition option
        $admin_obj->Arch_Woodelivery_plugin_activation_others_custom_css(); // for archtechwoodelivery_activation_default_custom_css option
    /** Others settings option values fn end **/


    $admin_obj->Arch_Woodelivery_plugin_activation_date();
    $admin_obj->Arch_Woodelivery_plugin_activation_time_slot();
    $admin_obj->Arch_Woodelivery_plugin_activation_time_slot_interval_option();
    $admin_obj->Arch_Woodelivery_plugin_activation_default_slot_start_time();
    $admin_obj->Arch_Woodelivery_plugin_activation_default_slot_end_time();
    
    
    $admin_obj->Arch_Woodelivery_plugin_activation_ask_time();
    $admin_obj->Arch_Woodelivery_plugin_activation_time_validation();
    $admin_obj->Arch_Woodelivery_plugin_activation_interval_time();
    $admin_obj->Arch_Woodelivery_plugin_activation_pickup_label_text();
    $admin_obj->Arch_Woodelivery_plugin_activation_date_label_text();
    $admin_obj->Arch_Woodelivery_plugin_activation_time_label_text();
    $admin_obj->Arch_Woodelivery_plugin_activation_special_time_text();
    $admin_obj->Arch_Woodelivery_plugin_activation_additional_charge_text();
    $admin_obj->Arch_Woodelivery_plugin_activation_all_days();
    $admin_obj->Arch_Woodelivery_plugin_activation_delivery_tips();

    $admin_obj->arch_woodelivery_create_store_table();
    $admin_obj->arch_woodelivery_create_time_slot_table();
    $admin_obj->arch_woodelivery_insert_value_time_slot_table();
    $admin_obj->arch_woodelivery_create_time_slot_break_fees();
    $admin_obj->arch_woodelivery_insert_value_time_slot_break_table();

}

function Archtech_WooDelivery_deactivation(){

    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = sanitize_text_field($_REQUEST['plugin'] !== '' ) ? sanitize_text_field($_REQUEST['plugin']) : '';
    check_admin_referer( "deactivate-plugin_{$plugin}" );
    flush_rewrite_rules();   // Flash rewrite rule

//delete_option('archtechwoodelivery_activation_default_tips');

}

// function Archtech_WooDelivery_uninstall(){
//     if ( ! current_user_can( 'activate_plugins' ) )
//         return;
//     check_admin_referer( 'bulk-plugins' );
//     if ( __FILE__ != WP_UNINSTALL_PLUGIN )
//         return;

//     flush_rewrite_rules();
// }
register_activation_hook(   __FILE__, 'Archtech_WooDelivery_activation' );
register_deactivation_hook( __FILE__, 'Archtech_WooDelivery_deactivation' );

/**
* Add links to Plugins page in admin.
*
* @hook plugin_action_links_
*
* @param array  $links Links to be displayed.
* @param string $file Path of the file.
*
* @since 1.0.0
*/
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'Arch_WooDelivery_settings_link');
function Arch_WooDelivery_settings_link( $links ) {

    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();

//     $link = 'https://webchunky.com/order-delivery-and-pickup-date-and-time/';

//     $setting_link['buy_pro'] = '<a target="_blank" style="font-weight:bold; color:#ea0000;" href="'.$link.'" >Buy Pro</a>';

    $setting_link['settings'] = '<a href="' . esc_url( get_admin_url( null, 'admin.php?page='.$plugin_name ) ) . '">Settings</a>';
    $links = $setting_link + $links;
    return $links;

}

/************************* plugin activation/deactivation/delete functions end *****************************/

/********************************** plugin admin notic functions start ************************************/

function Archtech_WooDelivery_plugin_activation_admin_notice_error() {

$free_plugins_activated_date = get_option('archtechwoodelivery_activation_date');

$free_plugins_activated_after_date = gmdate('m/d/Y', strtotime($free_plugins_activated_date. ' + 3 days'));

$currentDate = gmdate("m/d/Y");

    if($free_plugins_activated_after_date <= $currentDate){ 

        $message = '<div class="notice ciplugin-review">
        <p><img height="20" width="20" src="'.esc_url(site_url()).'/wp-content/plugins/order-delivery-pickup-location-date-time-free-version/admin/images/confetti-ball.svg"> Thanks for using WooDeliveryPickup for WooCommerce.</strong><br> It has been more than 3 days you are using <b>WooDeliveryPickup</b>, please help us by leaving a 5 star review on WordPress.org.</p>
        <p class="dfwc-message-actions">
            <a style="margin-right:5px;" href="https://archtechdesign.net/" target="_blank" class="button button-primary button-primary">Happy To Help</a>
            <a style="margin-right:5px;" href="/wp-admin/?page=archwoodelivery&amp;wcpg-later-dismiss=1" class="button button-alt">Maybe later</a>
            <a href="/wp-admin/edit.php?post_type=shop_order&amp;wcpg-review-dismiss=1" class="dfwc-button-notice-dismiss button button-link">Hide Notification </a>
        </p>
        </div>';

        echo '<p class="notice notice-warning is-dismissible" style="padding: 1%;margin-bottom: 2%;">'.wp_kses_post($message).'</p>'; 

    }

}

add_action( 'admin_notices', 'Archtech_WooDelivery_plugin_activation_admin_notice_error' );


/********************************** plugin admin notic functions end ************************************/

add_action('wp_ajax_arch_woo_delivery_add_store', 'arch_woo_delivery_add_store');
add_action('wp_ajax_nopriv_arch_woo_delivery_add_store', 'arch_woo_delivery_add_store');
function arch_woo_delivery_add_store(){

    if(isset($_REQUEST['store_name']) && !empty($_REQUEST['store_address']) && !empty($_REQUEST['store_email']) && !empty($_REQUEST['store_contact_no'])){
        global $wpdb;
        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';

        $store_name = sanitize_text_field( $_REQUEST['store_name'] );
        $store_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $store_name)));

        $store_address = sanitize_text_field( $_REQUEST['store_address'] );
        $store_email = sanitize_email( $_REQUEST['store_email'] );
        $store_phone = sanitize_text_field( $_REQUEST['store_contact_no'] );

        $store_status ='1';

        $store_insert = $wpdb->query($wpdb->prepare("INSERT INTO {$table_name}
      ( store_name, store_slug, store_address, store_email, store_phone, store_status ) VALUES ( %s, %s, %s, %s, %s, %s )",$store_name, $store_slug, $store_address, $store_email, $store_phone,$store_status
        ));

        if($store_insert == true){
            echo '1';
        }else{
            echo '0';
        }
    }

    wp_die();
}

add_action('wp_ajax_arch_woo_delivery_update_store', 'arch_woo_delivery_update_store');
add_action('wp_ajax_nopriv_arch_woo_delivery_update_store', 'arch_woo_delivery_update_store');
function arch_woo_delivery_update_store(){

    if(isset($_REQUEST['store_name']) && !empty($_REQUEST['store_address']) && !empty($_REQUEST['store_email']) && !empty($_REQUEST['store_contact_no']) && !empty($_REQUEST['store_id']) ){
        global $wpdb;
        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';

        $store_name = sanitize_text_field( $_REQUEST['store_name'] );
        $store_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $store_name)));

        $store_address = sanitize_text_field( $_REQUEST['store_address'] );
        $store_email = sanitize_email( $_REQUEST['store_email'] );
        $store_phone = sanitize_text_field( $_REQUEST['store_contact_no'] );
        $store_id = sanitize_text_field($_REQUEST['store_id']);

        $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET store_name= %s,store_slug= %s,store_address=%s,store_email= %s,store_phone= %s WHERE store_id= %d",$store_name, $store_slug, $store_address, $store_email, $store_phone, $store_id));

        if(true === $tb_update){
            echo '0';
        }else{
            echo '1';
        }
    }

    wp_die();
}

add_action('wp_ajax_arch_woo_delivery_store_actions', 'arch_woo_delivery_store_actions');
add_action('wp_ajax_nopriv_arch_woo_delivery_store_actions', 'arch_woo_delivery_store_actions');
function arch_woo_delivery_store_actions(){

    if(isset($_REQUEST['store_id']) && !empty($_REQUEST['action_id'])){
        global $wpdb;
        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';

        $store_id = sanitize_text_field($_REQUEST['store_id']);

        if(sanitize_text_field($_REQUEST['action_id']) == '1'){
            $status = sanitize_text_field($_REQUEST['status']);

            if($status == '1'){
                $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET store_status= %s WHERE store_id= %d",$status,$store_id));
                if(false === $tb_update){
                    echo '0';
                }else{
                    echo '1';
                }
            }elseif($status == '0'){
                $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET store_status= %s WHERE store_id= %d",$status,$store_id));
                if(false === $tb_update){
                    echo '0';
                }else{
                    echo '2';
                }
            }

        }elseif(sanitize_text_field($_REQUEST['action_id']) == '2'){
            $store_result = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_id= %d ",$store_id));
            if(!empty($store_result)) {
                foreach( $store_result as $store_value ) {
                    $store_id_n = $store_value->store_id;
                    $store_name = $store_value->store_name;
                    $store_slug = $store_value->store_slug;
                    $store_address = $store_value->store_address;
                    $store_email = $store_value->store_email;
                    $store_phone = $store_value->store_phone;
                    $store_status = $store_value->store_status;
                }

                if($store_status == '1'){
                    $st_status = 'Active';
                }elseif($store_status == '0'){
                    $st_status = 'Inactive';
                }else{
                    $st_status = '';
                }

                echo '<div class="main_pop_div">
                        <div class="overlay" onclick="popup_close();"></div>
                            <div class="sub_pop_div">
                                <a href="javascript:void(0)" class="close_pop" onclick="popup_close();"><span class="dashicons dashicons-no"></span></a>   
                                <div class="profile-section padding-top padding-bottom">
                                    <div class="container">
                                        <div class="row">
                                            <h3>View of '.esc_html($store_name).'</h3>
                                            <hr>
                                            <div class="store-view store_one">
                                                <div class="fld"><strong>Address : </strong><span>'.esc_html($store_address).'</span></div>
                                                <div class="fld"><strong>Email : </strong><span>'.esc_html($store_email).'</span></div>
                                                <div class="fld"><strong>Contact No : </strong><span>'.esc_html($store_phone).'</span></div>
                                                <div class="fld"><strong>Status : </strong><span>'.esc_html($st_status).'</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';

                
            }else{
                echo 'Store Details not found!';
            }
        }elseif(sanitize_text_field($_REQUEST['action_id']) == '3'){
            $store_result = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_id= %d ",$store_id));
            if(!empty($store_result)) {
                foreach( $store_result as $store_value ) {
                    $store_id_n = $store_value->store_id;
                    $store_name = $store_value->store_name;
                    $store_slug = $store_value->store_slug;
                    $store_address = $store_value->store_address;
                    $store_email = $store_value->store_email;
                    $store_phone = $store_value->store_phone;
                    $store_status = $store_value->store_status;
                }

                echo '<div class="main_pop_div">
                        <div class="overlay" onclick="popup_close();"></div>
                            <div class="sub_pop_div">
                                <a href="javascript:void(0)" class="close_pop" onclick="popup_close();"><span class="dashicons dashicons-no"></span></a>   
                                <div class="profile-section padding-top padding-bottom">
                                    <div class="container">
                                        <div class="row">
                                            <h3>Update '.esc_html($store_name).'</h3>
                                            <hr>
                                            <div class="store-view store_one">
                                                <form class="add_st_form_cls" id="woo_delivery_update_store" name="woo_delivery_update_store" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="site_url" id="site_url" value="'.site_url().'">
                                                    <input type="hidden" name="store_id" id="store_id" value="'.esc_html($store_id_n).'">
                                                    <div class="form-field">
                                                        <label>Store Name: <span class="req">*</span></label>
                                                        <input type="text" name="store_name" id="store_name" placeholder="Enter Store Name" value="'.esc_html($store_name).'" required>
                                                    </div>

                                                    <div class="form-field">
                                                        <label>Store Address: <span class="req">*</span></label>
                                                        <textarea name="store_address" id="store_address" placeholder="Enter Store Full Address" required>'.esc_html($store_address).'</textarea>
                                                    </div>

                                                    <div class="form-field">
                                                        <label>Store Email Address: <span class="req">*</span></label>
                                                        <input type="email" name="store_email" id="store_email" placeholder="Enter Store Email Address" value="'.esc_html($store_email).'" required>
                                                    </div>

                                                    <div class="form-field">
                                                        <label>Store Contact Number: <span class="req">*</span></label>
                                                        <input type="text" name="store_contact_no" id="store_contact_no" placeholder="Enter Store Contact Number" onkeypress="return isNumber(event)" value="'.esc_html($store_phone).'" required>
                                                    </div>

                                                    <div class="form-field">
                                                        <input type="submit" name="add_store_submit" id="add_store_submit" value="Update">
                                                    </div>

                                                    <div class="add_store_response com_response"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                
            }else{
                echo 'Store Details not found!';
            }

        }elseif(sanitize_text_field($_REQUEST['action_id']) == '4'){
            $tb_delete = $wpdb->query( $wpdb->prepare("DELETE FROM {$table_name} WHERE store_id= %d", $store_id ) );
            if($tb_delete == true){
                echo '1';
            }else{
                echo '0';
            }
        }
        
    }

    wp_die();
}

add_action('wp_ajax_arch_WooDelivery_time_slots', 'arch_WooDelivery_time_slots');
add_action('wp_ajax_arch_nopriv_WooDelivery_time_slots', 'arch_WooDelivery_time_slots');
function arch_WooDelivery_time_slots(){
    global $wpdb;

    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

    if(isset($_REQUEST['order_type'])){

            $pick_date = $_REQUEST['pick_date'];
            $time_zone = get_option( 'archtechwoodelivery_activation_default_time_zone' );

            $archtechwoodelivery_activation_default_delivery_time_slot_duration_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_duration_format' );
            $archtechwoodelivery_activation_default_delivery_time_format = get_option( 'archtechwoodelivery_activation_default_delivery_time_format' );

            $tz = $time_zone;
            $tz_obj = new DateTimeZone($tz);
            $today = new DateTime("now", $tz_obj);
            $today_formatted = $today->format('g:i a');

            $formatted_pickup_date = strtotime($pick_date);
            $formatted_todays_date = strtotime(date('Y-m-d'));

        if($_REQUEST['order_type'] == '1'){

            $archtechwoodelivery_activation_default_pickup_time_slot_breaks = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_breaks' );
            $pickup_slot_break = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_pickup_time_slot_breaks);
            $pickup_slot_break_arr = explode(",", $pickup_slot_break);

                if(!empty($pickup_slot_break_arr)){
                    echo '<option day="0" value="0">Select pickup time</option>';
                    foreach($pickup_slot_break_arr as $pickup_slot){

                        $slot_b_arr = explode('-',$pickup_slot);
                        if($formatted_pickup_date == $formatted_todays_date){
                            if(strtotime($slot_b_arr[0]) <= strtotime($today_formatted)){ $prop ='disabled';  }else{ $prop='';  }
                            echo '<option day="'.esc_html($pickup_slot).'" value="'.esc_html($pickup_slot).'" '.$prop.' >'.esc_html($pickup_slot).'</option>'; 
                        }else{
                            echo '<option day="'.esc_html($pickup_slot).'" value="'.esc_html($pickup_slot).'" '.$prop.' >'.esc_html($pickup_slot).'</option>'; 
                        }
                        
                    }
                }else{
                    echo '<option>No slots available!</option>';
                }
                
        }elseif($_REQUEST['order_type'] == '2'){
            $archtechwoodelivery_activation_default_pickup_time_slot_duration_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_slot_duration_format' );
            $archtechwoodelivery_activation_default_pickup_time_format = get_option( 'archtechwoodelivery_activation_default_pickup_time_format' );

            $archtechwoodelivery_activation_default_delivery_time_slot_breaks = get_option( 'archtechwoodelivery_activation_default_delivery_time_slot_breaks' );
            $delivery_slot_break = str_replace(array( '[', ']', '"' ), '', $archtechwoodelivery_activation_default_delivery_time_slot_breaks);
            $delivery_slot_break_arr = explode(",", $delivery_slot_break);

                if(!empty($delivery_slot_break_arr)){
                    echo '<option day="0" value="0">Select delivery time</option>';
                    foreach($delivery_slot_break_arr as $delivery_slot){
                        $slot_b_arr = explode('-',$delivery_slot);

                        if($formatted_pickup_date == $formatted_todays_date){
                            if(strtotime($slot_b_arr[0]) <= strtotime($today_formatted)){ $prop ='disabled';  }else{ $prop='';  }
                            echo '<option '.strtotime($slot_b_arr[0]).' - '.strtotime($today_formatted).' day="'.esc_html($delivery_slot).'" value="'.esc_html($delivery_slot).'" '.$prop.' >'.esc_html($delivery_slot).'</option>';
                        }else{
                            echo '<option day="'.esc_html($delivery_slot).'" value="'.esc_html($delivery_slot).'" '.$prop.' >'.esc_html($delivery_slot).'</option>';
                        }
                    }
                }else{
                    echo '<option>No slots available!</option>';
                }
        }else{
            echo '<option>No slots available!</option>';
        }
    }

    // $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    // $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';
    // $table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';

    // $slot_range = get_option( 'archtechwoodelivery_activation_default_time_slot_range' );

    // //$output ='';
    // //$address_details = array();
    // echo '<option day="0" value="0">Select delivery time</option>';
    // $dayofweek = sanitize_text_field($_REQUEST['dayOfWeek']);
    // //$time_status = '1';
    // $day_results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name1} WHERE day= %s AND time_status= %s",$dayofweek, '1'));
    //  if(!empty($day_results)) { 
    //     foreach( $day_results as $day_value ) {
    //         $day_slug = $day_value->day_slug;

    //     }

        
    //     $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE beak_time_day= %s AND break_time_intervals = %s AND break_status= %s",$day_slug, $slot_range, '1'));
    //     if(!empty($results)) {
        
    //         foreach( $results as $value ) {
    //             if($value->break_extra_fee !='0' || $value->break_extra_fee !=''){

    //                 if($value->break_extra_fee !='0'){
    //                     echo '<option day="'.esc_html($dayofweek).'" value="'.esc_html($value->break_id).'" extra_fee="true">'.esc_html($value->break_time_slot).' - (Additional charge applied: '.esc_html($value->break_extra_fee_currency).' '.esc_html($value->break_extra_fee).')'.'</option>';
    //                 }elseif($value->break_extra_fee =='' || $value->break_extra_fee =='0'){
    //                     echo '<option day="'.esc_html($dayofweek).'" value="'.esc_html($value->break_id).'" extra_fee="false">'.esc_html($value->break_time_slot).'</option>';
    //                 }
                    
    //             }else{
    //                 echo '<option day="'.esc_html($dayofweek).'" value="'.esc_html($value->break_id).'">'.esc_html($value->break_time_slot).'</option>';
    //             }
    //         }
            
    //     }else{
    //         echo '<option>No slots available on this day</option>';
    //     }
    // }else{
    //     echo '<option>No slots available on this day</option>';
    // }
    
    wp_die();
}

add_action('wp_ajax_arch_time_intervals_settings', 'arch_time_intervals_settings');
add_action('wp_ajax_nopriv_arch_time_intervals_settings', 'arch_time_intervals_settings');
function arch_time_intervals_settings(){
    global $wpdb;
    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';
    $update_flag = '0';
    $setting_form = sanitize_text_field( $_REQUEST['setting_form'] );

    //print_r($setting_form);

    if(isset($setting_form)){

        foreach($setting_form as $setting_form_val){
            foreach($setting_form_val as $setting_val){
                $day_id = $setting_val['day_id'];
                $status = $setting_val['status'];
                $start_time = $setting_val['start_time'];
                $end_time = $setting_val['end_time'];

                $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET start_time= %s,end_time= %s,time_status= %s WHERE id= %d",$start_time, $end_time, $status, $day_id));

                if(false === $tb_update){
                    $update_flag = '000';
                   
                }else{

                    $table_name3 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
                    $wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS {$table_name3})" ));
                    $admin_obj->arch_create_time_slot_break_fees();
                    $admin_obj->arch_insert_value_time_slot_break_table_on_updated();
                    $update_flag = '1';
                }
            }
        }

        
    }else{
        $update_flag = '00';
    }

    echo esc_html($update_flag);

    wp_die();
}

add_action('wp_ajax_arch_time_slots_settings_update', 'arch_time_slots_settings_update');
add_action('wp_ajax_nopriv_arch_time_slots_settings_update', 'arch_time_slots_settings_update');
function arch_time_slots_settings_update(){
    global $wpdb;

    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';

    if(isset($_REQUEST['woo_delivery_extra_fee_id']) && !empty($_REQUEST['woo_delivery_extra_fee'])){
        $woo_delivery_extra_fee_id = sanitize_text_field($_REQUEST['woo_delivery_extra_fee_id']);
        $woo_delivery_extra_fee = sanitize_text_field($_REQUEST['woo_delivery_extra_fee']);

        $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET break_extra_fee= %s WHERE break_id= %d ",$woo_delivery_extra_fee, $woo_delivery_extra_fee_id));

                if(false === $tb_update){
                    $update_flag = '0';
                   
                }else{
                    $update_flag = '1';
                }
    }else{
        $update_flag = '00';
    }

    echo esc_html($update_flag);

    wp_die();
}

/**** Order Timezone action code start ******/
add_action('wp_ajax_arch_woo_time_zone_settings', 'arch_woo_time_zone_settings');
add_action('wp_ajax_nopriv_arch_woo_time_zone_settings', 'arch_woo_time_zone_settings');
function arch_woo_time_zone_settings(){
    global $wpdb;

    if(!empty($_REQUEST['arch_delivery_time_timezone'])){
        $arch_delivery_time_timezone = sanitize_text_field($_REQUEST['arch_delivery_time_timezone']);
    }else{
        $arch_delivery_time_timezone = 'GMT';
    }

    update_option( 'archtechwoodelivery_activation_default_time_zone', $arch_delivery_time_timezone );

    echo '1';
    wp_die();
}
/**** Order Timezone action code end ******/

/**** Order Settings action code start ******/
add_action('wp_ajax_arch_woo_delivery_order_settings_form', 'arch_woo_delivery_order_settings_form');
add_action('wp_ajax_nopriv_arch_woo_delivery_order_settings_form', 'arch_woo_delivery_order_settings_form');
function arch_woo_delivery_order_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['order_type'])){
        $order_type = sanitize_text_field($_REQUEST['order_type']);
    }else{
        $order_type = 'both';
    }
    if(!empty($_REQUEST['default_order_type'])){
        $default_order_type = sanitize_text_field($_REQUEST['default_order_type']);
    }else{
        $default_order_type = 'delivery';
    }
    if(!empty($_REQUEST['arch_woo_order_type_field_label'])){
        $arch_woo_order_type_field_label = sanitize_text_field($_REQUEST['arch_woo_order_type_field_label']);
    }else{
        $arch_woo_order_type_field_label = 'Order Type';
    }
    if(!empty($_REQUEST['arch_woo_delivery_option_label'])){
        $arch_woo_delivery_option_label = sanitize_text_field($_REQUEST['arch_woo_delivery_option_label']);
    }else{
        $arch_woo_delivery_option_label = 'Delivery';
    }
    if(!empty($_REQUEST['arch_woo_pickup_option_label'])){
        $arch_woo_pickup_option_label = sanitize_text_field($_REQUEST['arch_woo_pickup_option_label']);
    }else{
        $arch_woo_pickup_option_label = 'Pickup';
    }

    if(isset($_REQUEST['order_type']) && !empty($_REQUEST['default_order_type']) && !empty($_REQUEST['arch_woo_order_type_field_label']) && !empty($_REQUEST['arch_woo_delivery_option_label']) && !empty($_REQUEST['arch_woo_pickup_option_label'])){

        update_option( 'archtechwoodelivery_activation_default_order_type', $order_type );
        update_option( 'archtechwoodelivery_activation_default_order_type_checkout', $default_order_type );
        update_option( 'archtechwoodelivery_activation_default_order_type_field_label', $arch_woo_order_type_field_label );
        update_option( 'archtechwoodelivery_activation_default_delivery_option_field_label', $arch_woo_delivery_option_label );
        update_option( 'archtechwoodelivery_activation_default_pickup_option_field_label', $arch_woo_pickup_option_label );

        echo '1';
    }else{
        echo '0';
    }

    wp_die();
    
}
/**** Order Settings action code end ******/

/**** Delivery Date Settings action code start ******/
add_action('wp_ajax_arch_woo_delivery_date_settings_form', 'arch_woo_delivery_date_settings_form');
add_action('wp_ajax_nopriv_arch_woo_delivery_date_settings_form', 'arch_woo_delivery_date_settings_form');
function arch_woo_delivery_date_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_enable_delivery_date'])){
        $arch_enable_delivery_date = sanitize_text_field($_REQUEST['arch_enable_delivery_date']);
    }else{
        $arch_enable_delivery_date = '0';
    }
    if(!empty($_REQUEST['arch_delivery_date_mandatory'])){
        $arch_delivery_date_mandatory = sanitize_text_field($_REQUEST['arch_delivery_date_mandatory']);
    }else{
        $arch_delivery_date_mandatory = '0';
    }
    if(!empty($_REQUEST['arch_delivery_date_field_label'])){
        $arch_delivery_date_field_label = sanitize_text_field($_REQUEST['arch_delivery_date_field_label']);
    }else{
        $arch_delivery_date_field_label = 'Delivery Date';
    }
    if(!empty($_REQUEST['arch_delivery_date_week_starts_from'])){
        $arch_delivery_date_week_starts_from = sanitize_text_field($_REQUEST['arch_delivery_date_week_starts_from']);
    }else{
        $arch_delivery_date_week_starts_from = '0';
    }
    if(!empty($_REQUEST['arch_delivery_date_format'])){
        $arch_delivery_date_format = sanitize_text_field($_REQUEST['arch_delivery_date_format']);
    }else{
        $arch_delivery_date_format = 'dd-mm-yy';
    }

    if(!empty($_REQUEST['arch_delivery_date_delivery_days_arr'])){
        $arch_delivery_date_delivery_days_arr = sanitize_text_field(stripslashes($_REQUEST['arch_delivery_date_delivery_days_arr']));
    }else{
        $arch_delivery_date_delivery_days_arr = '';
    }

    update_option( 'archtechwoodelivery_activation_default_delivery_date_show_hide', $arch_enable_delivery_date );
    update_option( 'archtechwoodelivery_activation_default_delivery_date_mandatory', $arch_delivery_date_mandatory );
    update_option( 'archtechwoodelivery_activation_default_delivery_date_label_text', $arch_delivery_date_field_label );
    update_option( 'archtechwoodelivery_activation_default_delivery_date_start_from', $arch_delivery_date_week_starts_from );
    update_option( 'archtechwoodelivery_activation_default_delivery_date_format', $arch_delivery_date_format );
    update_option( 'archtechwoodelivery_activation_default_delivery_date_delivery_days', $arch_delivery_date_delivery_days_arr );

    echo '1';

    wp_die();
}

/**** Delivery Date Settings action code end ******/

/**** Pickup Date Settings action code start ******/
add_action('wp_ajax_arch_woo_pickup_date_settings_form', 'arch_woo_pickup_date_settings_form');
add_action('wp_ajax_nopriv_arch_woo_pickup_date_settings_form', 'arch_woo_pickup_date_settings_form');
function arch_woo_pickup_date_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_enable_pickup_date'])){
        $arch_enable_pickup_date = sanitize_text_field($_REQUEST['arch_enable_pickup_date']);
    }else{
        $arch_enable_pickup_date = '0';
    }
    if(!empty($_REQUEST['arch_pickup_date_mandatory'])){
        $arch_pickup_date_mandatory = sanitize_text_field($_REQUEST['arch_pickup_date_mandatory']);
    }else{
        $arch_pickup_date_mandatory = '0';
    }
    if(!empty($_REQUEST['arch_pickup_date_field_label'])){
        $arch_pickup_date_field_label = sanitize_text_field($_REQUEST['arch_pickup_date_field_label']);
    }else{
        $arch_pickup_date_field_label = 'Pickup Date';
    }
    if(!empty($_REQUEST['arch_pickup_date_week_starts_from'])){
        $arch_pickup_date_week_starts_from = sanitize_text_field($_REQUEST['arch_pickup_date_week_starts_from']);
    }else{
        $arch_pickup_date_week_starts_from = '0';
    }
    if(!empty($_REQUEST['arch_pickup_date_format'])){
        $arch_pickup_date_format = sanitize_text_field($_REQUEST['arch_pickup_date_format']);
    }else{
        $arch_pickup_date_format = 'dd-mm-yy';
    }

    if(!empty($_REQUEST['arch_pickup_date_delivery_days_arr'])){
        $arch_pickup_date_delivery_days_arr = sanitize_text_field(stripslashes($_REQUEST['arch_pickup_date_delivery_days_arr']));
    }else{
        $arch_pickup_date_delivery_days_arr = '';
    }

    update_option( 'archtechwoodelivery_activation_default_pickup_date_show_hide', $arch_enable_pickup_date );
    update_option( 'archtechwoodelivery_activation_default_pickup_date_mandatory', $arch_pickup_date_mandatory );
    update_option( 'archtechwoodelivery_activation_default_pickup_date_label_text', $arch_pickup_date_field_label );
    update_option( 'archtechwoodelivery_activation_default_pickup_date_start_from', $arch_pickup_date_week_starts_from );
    update_option( 'archtechwoodelivery_activation_default_pickup_date_format', $arch_pickup_date_format );
    update_option( 'archtechwoodelivery_activation_default_pickup_date_delivery_days', $arch_pickup_date_delivery_days_arr );

    echo '1';

    wp_die();
}

/**** Pickup Date Settings action code end ******/

/**** Delivery Time Settings action code start ******/
add_action('wp_ajax_arch_woo_delivery_time_settings_form', 'arch_woo_delivery_time_settings_form');
add_action('wp_ajax_nopriv_arch_woo_delivery_time_settings_form', 'arch_woo_delivery_time_settings_form');
function arch_woo_delivery_time_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_enable_delivery_time'])){
        $arch_enable_delivery_time = sanitize_text_field($_REQUEST['arch_enable_delivery_time']);
    }else{
        $arch_enable_delivery_time = '1';
    }
    if(!empty($_REQUEST['arch_delivery_time_mandatory'])){
        $arch_delivery_time_mandatory = sanitize_text_field($_REQUEST['arch_delivery_time_mandatory']);
    }else{
        $arch_delivery_time_mandatory = '0';
    }
    if(!empty($_REQUEST['arch_delivery_time_field_label'])){
        $arch_delivery_time_field_label = sanitize_text_field($_REQUEST['arch_delivery_time_field_label']);
    }else{
        $arch_delivery_time_field_label = 'Delivery Time';
    }
    if(!empty($_REQUEST['arch_delivery_time_slot_starts_hour'])){
        $arch_delivery_time_slot_starts_hour = sanitize_text_field($_REQUEST['arch_delivery_time_slot_starts_hour']);
    }else{
        $arch_delivery_time_slot_starts_hour = 12;
    }
    if(!empty($_REQUEST['arch_delivery_time_slot_starts_min'])){
        $arch_delivery_time_slot_starts_min = sanitize_text_field($_REQUEST['arch_delivery_time_slot_starts_min']);
    }else{
        $arch_delivery_time_slot_starts_min = 00;
    }

    if(!empty($_REQUEST['arch_delivery_time_slot_starts_format'])){
        $arch_delivery_time_slot_starts_format = sanitize_text_field($_REQUEST['arch_delivery_time_slot_starts_format']);
    }else{
        $arch_delivery_time_slot_starts_format = 'AM';
    }

    if(!empty($_REQUEST['arch_delivery_time_slot_ends_hour'])){
        $arch_delivery_time_slot_ends_hour = sanitize_text_field($_REQUEST['arch_delivery_time_slot_ends_hour']);
    }else{
        $arch_delivery_time_slot_ends_hour = 11;
    }
    if(!empty($_REQUEST['arch_delivery_time_slot_ends_min'])){
        $arch_delivery_time_slot_ends_min = sanitize_text_field($_REQUEST['arch_delivery_time_slot_ends_min']);
    }else{
        $arch_delivery_time_slot_ends_min = 59;
    }

    if(!empty($_REQUEST['arch_delivery_time_slot_ends_format'])){
        $arch_delivery_time_slot_ends_format = sanitize_text_field($_REQUEST['arch_delivery_time_slot_ends_format']);
    }else{
        $arch_delivery_time_slot_ends_format = 'PM';
    }

    if(!empty($_REQUEST['arch_delivery_time_slot_duration_format'])){
        $arch_delivery_time_slot_duration_format = sanitize_text_field($_REQUEST['arch_delivery_time_slot_duration_format']);
    }else{
        $arch_delivery_time_slot_duration_format = 12;
    }
    if(!empty($_REQUEST['arch_delivery_time_format'])){
        $arch_delivery_time_format = sanitize_text_field($_REQUEST['arch_delivery_time_format']);
    }else{
        $arch_delivery_time_format = 30;
    }

    if(!empty($_REQUEST['timevar'])){
        $timevar_breaks_arr = sanitize_text_field(stripslashes($_REQUEST['timevar']));
        // $timevar_breaks = str_replace(array('[', ']', '"'),'',$timevar);
        // $timevar_breaks_arr = explode(',', $timevar_breaks);

    }

    update_option( 'archtechwoodelivery_activation_default_delivery_time_show_hide', $arch_enable_delivery_time );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_mandatory', $arch_delivery_time_mandatory );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_label_text', $arch_delivery_time_field_label );


    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_hour', $arch_delivery_time_slot_starts_hour );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_min', $arch_delivery_time_slot_starts_min );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_starts_format', $arch_delivery_time_slot_starts_format );

    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_hour', $arch_delivery_time_slot_ends_hour );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_min', $arch_delivery_time_slot_ends_min );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_ends_format', $arch_delivery_time_slot_ends_format );

    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_breaks', $timevar_breaks_arr );

    update_option( 'archtechwoodelivery_activation_default_delivery_time_slot_duration_format', $arch_delivery_time_slot_duration_format );
    update_option( 'archtechwoodelivery_activation_default_delivery_time_format', $arch_delivery_time_format );

    echo '1';

    wp_die();
}

/**** Delivery Time Settings action code end ******/

/**** Pickup Time Settings action code start ******/
add_action('wp_ajax_arch_woo_pickup_time_settings_form', 'arch_woo_pickup_time_settings_form');
add_action('wp_ajax_nopriv_arch_woo_pickup_time_settings_form', 'arch_woo_pickup_time_settings_form');
function arch_woo_pickup_time_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_enable_pickup_time'])){
        $arch_enable_pickup_time = sanitize_text_field($_REQUEST['arch_enable_pickup_time']);
    }else{
        $arch_enable_pickup_time = '1';
    }
    if(!empty($_REQUEST['arch_pickup_time_mandatory'])){
        $arch_pickup_time_mandatory = sanitize_text_field($_REQUEST['arch_pickup_time_mandatory']);
    }else{
        $arch_pickup_time_mandatory = '0';
    }
    if(!empty($_REQUEST['arch_pickup_time_field_label'])){
        $arch_pickup_time_field_label = sanitize_text_field($_REQUEST['arch_pickup_time_field_label']);
    }else{
        $arch_pickup_time_field_label = 'Delivery Time';
    }
    if(!empty($_REQUEST['arch_pickup_time_slot_starts_hour'])){
        $arch_pickup_time_slot_starts_hour = sanitize_text_field($_REQUEST['arch_pickup_time_slot_starts_hour']);
    }else{
        $arch_pickup_time_slot_starts_hour = 12;
    }
    if(!empty($_REQUEST['arch_pickup_time_slot_starts_min'])){
        $arch_pickup_time_slot_starts_min = sanitize_text_field($_REQUEST['arch_pickup_time_slot_starts_min']);
    }else{
        $arch_pickup_time_slot_starts_min = 00;
    }

    if(!empty($_REQUEST['arch_pickup_time_slot_starts_format'])){
        $arch_pickup_time_slot_starts_format = sanitize_text_field($_REQUEST['arch_pickup_time_slot_starts_format']);
    }else{
        $arch_pickup_time_slot_starts_format = 'AM';
    }

    if(!empty($_REQUEST['arch_pickup_time_slot_ends_hour'])){
        $arch_pickup_time_slot_ends_hour = sanitize_text_field($_REQUEST['arch_pickup_time_slot_ends_hour']);
    }else{
        $arch_pickup_time_slot_ends_hour = 11;
    }
    if(!empty($_REQUEST['arch_pickup_time_slot_ends_min'])){
        $arch_pickup_time_slot_ends_min = sanitize_text_field($_REQUEST['arch_pickup_time_slot_ends_min']);
    }else{
        $arch_pickup_time_slot_ends_min = 59;
    }

    if(!empty($_REQUEST['arch_pickup_time_slot_ends_format'])){
        $arch_pickup_time_slot_ends_format = sanitize_text_field($_REQUEST['arch_pickup_time_slot_ends_format']);
    }else{
        $arch_pickup_time_slot_ends_format = 'PM';
    }

    if(!empty($_REQUEST['arch_pickup_time_slot_duration_format'])){
        $arch_pickup_time_slot_duration_format = sanitize_text_field($_REQUEST['arch_pickup_time_slot_duration_format']);
    }else{
        $arch_pickup_time_slot_duration_format = 12;
    }
    if(!empty($_REQUEST['arch_pickup_time_format'])){
        $arch_pickup_time_format = sanitize_text_field($_REQUEST['arch_pickup_time_format']);
    }else{
        $arch_pickup_time_format = 30;
    }

    if(!empty($_REQUEST['timevar'])){
        $timevar_breaks_arr = sanitize_text_field(stripslashes($_REQUEST['timevar']));
        // $timevar_breaks = str_replace(array('[', ']', '"'),'',$timevar);
        // $timevar_breaks_arr = explode(',', $timevar_breaks);

    }

    update_option( 'archtechwoodelivery_activation_default_pickup_time_show_hide', $arch_enable_pickup_time );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_mandatory', $arch_pickup_time_mandatory );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_label_text', $arch_pickup_time_field_label );


    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_hour', $arch_pickup_time_slot_starts_hour );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_min', $arch_pickup_time_slot_starts_min );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_starts_format', $arch_pickup_time_slot_starts_format );

    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_hour', $arch_pickup_time_slot_ends_hour );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_min', $arch_pickup_time_slot_ends_min );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_ends_format', $arch_pickup_time_slot_ends_format );

    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_breaks', $timevar_breaks_arr );

    update_option( 'archtechwoodelivery_activation_default_pickup_time_slot_duration_format', $arch_pickup_time_slot_duration_format );
    update_option( 'archtechwoodelivery_activation_default_pickup_time_format', $arch_pickup_time_format );

    echo '1';

    wp_die();
}

/**** Pickup Time Settings action code end ******/

/**** pickup location Settings action code start ******/
add_action('wp_ajax_arch_woo_pickup_location_settings_form', 'arch_woo_pickup_location_settings_form');
add_action('wp_ajax_nopriv_arch_woo_pickup_location_settings_form', 'arch_woo_pickup_location_settings_form');
function arch_woo_pickup_location_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_enable_pickup_location'])){
        $arch_enable_pickup_location = sanitize_text_field($_REQUEST['arch_enable_pickup_location']);
    }else{
        $arch_enable_pickup_location = '0';
    }
    if(!empty($_REQUEST['arch_pickup_location_mandatory'])){
        $arch_pickup_location_mandatory = sanitize_text_field($_REQUEST['arch_pickup_location_mandatory']);
    }else{
        $arch_pickup_location_mandatory = '0';
    }
    if(!empty($_REQUEST['arch_pickup_location_field_label'])){
        $arch_pickup_location_field_label = sanitize_text_field($_REQUEST['arch_pickup_location_field_label']);
    }else{
        $arch_pickup_location_field_label = '';
    }
   
    update_option( 'archtechwoodelivery_activation_default_pickup_location_show_hide', $arch_enable_pickup_location );
    update_option( 'archtechwoodelivery_activation_default_pickup_location_mandatory', $arch_pickup_location_mandatory );
    update_option( 'archtechwoodelivery_activation_default_pickup_location_label_text', $arch_pickup_location_field_label );

    echo '1';

    wp_die();
}

/**** pickup location Settings action code end ******/

/**** Others Settings action code start ******/
add_action('wp_ajax_arch_woo_others_settings_form', 'arch_woo_others_settings_form');
add_action('wp_ajax_nopriv_arch_woo_others_settings_form', 'arch_woo_others_settings_form');
function arch_woo_others_settings_form(){
    global $wpdb;

    if(!empty($_REQUEST['arch_woo_delivery_delivery_heading_checkout'])){
        $arch_woo_delivery_delivery_heading_checkout = sanitize_text_field($_REQUEST['arch_woo_delivery_delivery_heading_checkout']);
    }else{
        $arch_woo_delivery_delivery_heading_checkout = '';
    }
    if(!empty($_REQUEST['arch_woo_delivery_field_position'])){
        $arch_woo_delivery_field_position = sanitize_text_field($_REQUEST['arch_woo_delivery_field_position']);
    }else{
        $arch_woo_delivery_field_position = '0';
    }
    if(!empty($_REQUEST['arch_woo_delivery_code_editor_css'])){
        $arch_woo_delivery_code_editor_css = sanitize_text_field($_REQUEST['arch_woo_delivery_code_editor_css']);
    }else{
        $arch_woo_delivery_code_editor_css = '';
    }
   
    update_option( 'archtechwoodelivery_activation_default_checkout_page_heading', $arch_woo_delivery_delivery_heading_checkout );
    update_option( 'archtechwoodelivery_activation_default_checkout_field_possition', $arch_woo_delivery_field_position );
    update_option( 'archtechwoodelivery_activation_default_custom_css', $arch_woo_delivery_code_editor_css );

    echo '1';

    wp_die();
}

/**** Others Settings action code end ******/

add_action('wp_ajax_arch_woo_delivery_main_settings', 'arch_woo_delivery_main_settings');
add_action('wp_ajax_nopriv_arch_woo_delivery_main_settings', 'arch_woo_delivery_main_settings');
function arch_woo_delivery_main_settings(){
    global $wpdb;

    if(isset($_REQUEST['order_type']) && !empty($_REQUEST['time_interval']) && !empty($_REQUEST['pickup_text']) && !empty($_REQUEST['date_field_text']) && !empty($_REQUEST['time_field_text']) && !empty($_REQUEST['charge_field_text']) && !empty($_REQUEST['additional_charge_text']) && !empty($_REQUEST['tip_values'])){


        $order_type = sanitize_text_field($_REQUEST['order_type']);
        $aks_time = sanitize_text_field($_REQUEST['aks_time']);
        $time_required = sanitize_text_field($_REQUEST['time_required']);
        $time_interval = sanitize_text_field($_REQUEST['time_interval']);
        $pickup_text = sanitize_text_field($_REQUEST['pickup_text']);
        $date_field_text = sanitize_text_field($_REQUEST['date_field_text']);
        $time_field_text = sanitize_text_field($_REQUEST['time_field_text']);
        $charge_field_text = sanitize_text_field($_REQUEST['charge_field_text']);
        $additional_charge_text = sanitize_text_field($_REQUEST['additional_charge_text']);

        $tip_values = array_map( 'sanitize_text_field', $_REQUEST['tip_values'] );

        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';

        update_option( 'archtechwoodelivery_activation_default_order_type', $order_type );
        update_option( 'archtechwoodelivery_activation_default_ask_time', $aks_time );
        update_option( 'archtechwoodelivery_activation_default_time_validation', $time_required );
        update_option( 'archtechwoodelivery_activation_default_interval_time', $time_interval );
        update_option( 'archtechwoodelivery_activation_default_time_slot_range', $time_interval );

        update_option( 'archtechwoodelivery_activation_default_pickup_label_text', $pickup_text );
        update_option( 'archtechwoodelivery_activation_default_date_label_text', $date_field_text );
        update_option( 'archtechwoodelivery_activation_default_time_label_text', $time_field_text );
        update_option( 'archtechwoodelivery_activation_default_special_time_text', $charge_field_text );
        update_option( 'archtechwoodelivery_activation_default_additional_charge_text', $additional_charge_text );

        update_option( 'archtechwoodelivery_activation_default_tips', $tip_values );

        $tb_update = $wpdb->query($wpdb->prepare("UPDATE {$table_name} SET time_slot= %s ",$time_interval));

        echo '1';
        wp_die();
    }

}

add_action('wp_ajax_arch_WooDelivery_change_delivery_type', 'arch_WooDelivery_change_delivery_type');
add_action('wp_ajax_nopriv_arch_WooDelivery_change_delivery_type', 'arch_WooDelivery_change_delivery_type');
function arch_WooDelivery_change_delivery_type(){
    global $wpdb;

    if(isset($_REQUEST['delivery_type'])){
        $delivery_type = sanitize_text_field($_REQUEST['delivery_type']);
        update_option( 'archtechwoodelivery_activation_default_order_type_checkout', $delivery_type );

        echo '1';
    }
    wp_die();
}


if(!empty(get_option( 'archtechwoodelivery_activation_default_checkout_field_possition' ))){
    $archtechwoodelivery_activation_default_checkout_field_possition = get_option( 'archtechwoodelivery_activation_default_checkout_field_possition' );
}else{
    $archtechwoodelivery_activation_default_checkout_field_possition = 'woocommerce_checkout_before_customer_details';
}


add_action( $archtechwoodelivery_activation_default_checkout_field_possition, 'arch_woodelivery_checkout_radio_choice' );
  
function arch_woodelivery_checkout_radio_choice() {

    global $wpdb;
    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';

    
    /** order settings options start **/

    /** order settings options start **/

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
    $pickup_text = get_option( 'archtechwoodelivery_activation_default_pickup_label_text' );
    $date_field_text = get_option( 'archtechwoodelivery_activation_default_date_label_text' );
    $time_field_text = get_option( 'archtechwoodelivery_activation_default_time_label_text' );

    $tip_amounts = get_option( 'archtechwoodelivery_activation_default_tips' );

    $curr_symbol = get_woocommerce_currency();

    $check_attr_p = '';
    $check_cls_p = '';

    $check_attr_d = '';
    $check_cls_d = '';

    if(isset($order_type_checkout)){
        if($order_type_checkout == 'pick_up'){
            $check_attr_p = 'checked';
            $check_cls_p = 'r_checked';
        }elseif($order_type_checkout == 'delivery'){
            $check_attr_d = 'checked';
            $check_cls_d = 'r_checked';
        }
    }

    echo '<div class="woodelivery_main_div">';
	echo '<input type="hidden" name="site_url" id="site_url" value="'.esc_url(site_url()).'">';

    if(isset($archtechwoodelivery_activation_default_checkout_page_heading)){
        echo '<p class="checkout_page_heading">'.esc_html($archtechwoodelivery_activation_default_checkout_page_heading).'</p>';
    }

    if(isset($order_type)){
        if($order_type == 'both'){
            echo '<p class="form-row woo_delivery_type validate-required" id="woo_delivery_type_field" data-priority=""><label for="woo_delivery_type_take_away" class="woo_delivery_ordertype_label">'.esc_html($order_type_label).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="radio" class="radio_clk input-radio '.esc_html($check_cls_p).'" value="1" name="woo_delivery_type_take_away" id="woo_delivery_type_take_away" '.esc_html($check_attr_p).'> '.esc_html($pickup_option_label).'</span>
            <span class="woocommerce-input-wrapper"><input type="radio" class="radio_clk input-radio '.esc_html($check_cls_d).'" value="2" name="woo_delivery_type_take_away" id="woo_delivery_type_delivery" '.esc_html($check_attr_d).'> '.esc_html($delivery_option_label).'</span>
            </p>';

            echo '</div>';

            echo '<div class="delivery_main_div">';

            if($order_type_checkout == 'pick_up'){

                if($archtechwoodelivery_activation_default_pickup_date_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_pickup_date_mandatory == '1'){
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input order_type="1" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_pickup_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_pickup_date_format).'" data-arr="'.esc_html(json_encode($p_missing_date_arr)).'" placeholder="Select a Date" required></span></p>';
                    }else{
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'</label><span class="woocommerce-input-wrapper"><input order_type="1" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_pickup_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_pickup_date_format).'" data-arr="'.esc_html(json_encode($p_missing_date_arr)).'" placeholder="Select a Date"></span></p>';
                    }
                
                }

                if($archtechwoodelivery_activation_default_pickup_time_show_hide == '1'){
                    if($archtechwoodelivery_activation_default_pickup_time_mandatory == '1'){
                      echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_time_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" required>
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }else{
                        echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_time_label_text).'</label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" >
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }

                }

                if($archtechwoodelivery_activation_default_pickup_location_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_pickup_location_mandatory == '1'){
                        echo '<p class="form-row woo_delivery_pickup_location validate-required" id="woo_delivery_pickup_location_field" data-priority=""><label for="woo_delivery_pickup_location" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_location_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_pickup_location" id="woo_delivery_pickup_location" class="select" data-placeholder="Choose pickup location" required><option value="">Select a pickup point</option>';

                        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_status= %s ",'1'));

                        if(!empty($results)) {   
                            foreach( $results as $value ) {
                                echo '<option value="'.esc_html($value->store_id).'">'.esc_html($value->store_name).'</option>';
                            }
                        }else{
                            echo '<option value="">No Pickup Points are available right now</option>';
                        }

                        echo '</select></span></p>';
                        echo '<div class="woo_delivery_pickup_store_details com_details" id="store_details"></div>';
                    }else{
                        echo '<p class="form-row woo_delivery_pickup_location validate-required" id="woo_delivery_pickup_location_field" data-priority=""><label for="woo_delivery_pickup_location" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_location_label_text).'</label><span class="woocommerce-input-wrapper"><select name="woo_delivery_pickup_location" id="woo_delivery_pickup_location" class="select" data-placeholder="Choose pickup location"><option value="">Select a pickup point</option>';

                        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_status= %s ",'1'));

                        if(!empty($results)) {   
                            foreach( $results as $value ) {
                                echo '<option value="'.esc_html($value->store_id).'">'.esc_html($value->store_name).'</option>';
                            }
                        }else{
                            echo '<option value="">No Pickup Points are available right now</option>';
                        }

                        echo '</select></span></p>';
                        echo '<div class="woo_delivery_pickup_store_details com_details" id="store_details"></div>';
                    }
                    
                }
            }

            if($order_type_checkout == 'delivery'){

                if($archtechwoodelivery_activation_default_delivery_date_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_delivery_date_mandatory == '1'){

                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input order_type="2" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_delivery_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_delivery_date_format).'" data-arr="'.esc_html(json_encode($missing_date_arr)).'" placeholder="Select a Date" required></span></p>';
                    }else{
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'</label><span class="woocommerce-input-wrapper"><input order_type="2" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_delivery_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_delivery_date_format).'" data-arr="'.esc_html(json_encode($missing_date_arr)).'" placeholder="Select a Date" ></span></p>';
                    }
                }

                if($archtechwoodelivery_activation_default_delivery_time_show_hide == '1'){
                    if($archtechwoodelivery_activation_default_delivery_time_mandatory == '1'){
                      echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_delivery_time_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" required>
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }else{
                        echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_delivery_time_label_text).'</label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" >
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }

                }

                echo '<p class="form-row woo_delivery_location validate-required" id="woo_delivery_location_field" data-priority=""><label for="woo_delivery_location" class="">Select your delivery area<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_location" id="woo_delivery_location" class="select delivery_location" data-placeholder="Choose Delivery location" required><option value="">Select your delivery area</option>';

                    echo '<option value="1">Same as my billing address</option>';

                echo '</select></span></p>';
            }

            /** For pro
            if($order_type_checkout == 'delivery'){
               echo '<p class="form-row wooDelivery_add_tips" id="wooDelivery_add_tips_field" data-priority=""><label for="woo_delivery_add_tips" class="">Tips for delivery person<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_add_tips" id="woo_delivery_add_tips" class="select " data-allow_clear="true" data-placeholder="Select tips amount">
                                    <option value="">Select tips amount</option>';
                        if(isset($tip_amounts)){
                            foreach(array_filter($tip_amounts,'strlen') as $tip_val){
                                echo '<option value="'.esc_html($tip_val).'">'.esc_html($curr_symbol).' '.esc_html($tip_val).'</option>';
                            }
                        }
                echo '</select></span></p>';
            }
            
            For pro **/

        }elseif($order_type == 'pick_up'){
           echo '<p class="form-row woo_delivery_type validate-required" id="woo_delivery_type_field" data-priority=""><label for="woo_delivery_type_take_away" class="woo_delivery_ordertype_label">'.esc_html($order_type_label).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="radio" class="radio_clk input-radio '.esc_html($check_cls_p).'" value="1" name="woo_delivery_type_take_away" id="woo_delivery_type_take_away" '.esc_html($check_attr_p).'> '.esc_html($pickup_option_label).'</span>
           
            </p>';

            echo '</div>';

            echo '<div class="delivery_main_div">';

            if($order_type == 'pick_up'){

                if($archtechwoodelivery_activation_default_pickup_date_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_pickup_date_mandatory == '1'){
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input order_type="1" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_pickup_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_pickup_date_format).'" data-arr="'.esc_html(json_encode($p_missing_date_arr)).'" placeholder="Select a Date" required></span></p>';
                    }else{
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'</label><span class="woocommerce-input-wrapper"><input order_type="1" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_pickup_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_pickup_date_format).'" data-arr="'.esc_html(json_encode($p_missing_date_arr)).'" placeholder="Select a Date"></span></p>';
                    }
                
                }

                if($archtechwoodelivery_activation_default_pickup_time_show_hide == '1'){
                    if($archtechwoodelivery_activation_default_pickup_time_mandatory == '1'){
                      echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_time_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" required>
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }else{
                        echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_time_label_text).'</label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" >
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }

                }


                if($archtechwoodelivery_activation_default_pickup_location_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_pickup_location_mandatory == '1'){
                        echo '<p class="form-row woo_delivery_pickup_location validate-required" id="woo_delivery_pickup_location_field" data-priority=""><label for="woo_delivery_pickup_location" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_location_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_pickup_location" id="woo_delivery_pickup_location" class="select" data-placeholder="Choose pickup location" required><option value="">Select a pickup point</option>';

                        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_status= %s ",'1'));

                        if(!empty($results)) {   
                            foreach( $results as $value ) {
                                echo '<option value="'.esc_html($value->store_id).'">'.esc_html($value->store_name).'</option>';
                            }
                        }else{
                            echo '<option value="">No Pickup Points are available right now</option>';
                        }

                        echo '</select></span></p>';
                        echo '<div class="woo_delivery_pickup_store_details com_details" id="store_details"></div>';

                    }else{
                        echo '<p class="form-row woo_delivery_pickup_location validate-required" id="woo_delivery_pickup_location_field" data-priority=""><label for="woo_delivery_pickup_location" class="">'.esc_html($archtechwoodelivery_activation_default_pickup_location_label_text).'</label><span class="woocommerce-input-wrapper"><select name="woo_delivery_pickup_location" id="woo_delivery_pickup_location" class="select" data-placeholder="Choose pickup location"><option value="">Select a pickup point</option>';

                        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE store_status= %s ",'1'));

                        if(!empty($results)) {   
                            foreach( $results as $value ) {
                                echo '<option value="'.esc_html($value->store_id).'">'.esc_html($value->store_name).'</option>';
                            }
                        }else{
                            echo '<option value="">No Pickup Points are available right now</option>';
                        }

                        echo '</select></span></p>';
                        echo '<div class="woo_delivery_pickup_store_details com_details" id="store_details"></div>';
                    }
                    
                }
            }

        }elseif($order_type == 'delivery'){
            echo '<p class="form-row woo_delivery_type validate-required" id="woo_delivery_type_field" data-priority=""><label for="woo_delivery_type_take_away" class="woo_delivery_ordertype_label">'.esc_html($order_type_label).'<abbr class="required" title="required">*</abbr></label>
            <span class="woocommerce-input-wrapper"><input type="radio" class="radio_clk input-radio '.esc_html($check_cls_d).'" value="2" name="woo_delivery_type_take_away" id="woo_delivery_type_delivery" '.esc_html($check_attr_d).'> '.esc_html($delivery_option_label).'</span>
            </p>';

            echo '</div>';

            echo '<div class="delivery_main_div">';

                if($archtechwoodelivery_activation_default_delivery_date_show_hide == '1'){

                    if($archtechwoodelivery_activation_default_delivery_date_mandatory == '1'){

                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input order_type="2" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_delivery_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_delivery_date_format).'" data-arr="'.esc_html(json_encode($missing_date_arr)).'" placeholder="Select a Date" required></span></p>';
                    }else{
                        echo '<p class="form-row woo_delivery_delivery_date validate-required" id="woo_delivery_delivery_date_field" data-priority=""><label for="woo_delivery_delivery_date" class="">'.esc_html($date_field_text).'</label><span class="woocommerce-input-wrapper"><input order_type="2" type="text" id="pick_date" class="datepicker" name="start_date" data-start-week="'.esc_html($archtechwoodelivery_activation_default_delivery_date_start_from).'" data-date-format="'.esc_html($archtechwoodelivery_activation_default_delivery_date_format).'" data-arr="'.esc_html(json_encode($missing_date_arr)).'" placeholder="Select a Date" ></span></p>';
                    }
                }


                if($archtechwoodelivery_activation_default_delivery_time_show_hide == '1'){
                    if($archtechwoodelivery_activation_default_delivery_time_mandatory == '1'){
                      echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_delivery_time_label_text).'<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" required>
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }else{
                        echo '<p class="form-row wooDelivery_delivery_time validate-required" id="wooDelivery_delivery_time_field" data-priority="" ><label for="woo_delivery_delivery_tm" class="">'.esc_html($archtechwoodelivery_activation_default_delivery_time_label_text).'</label><span class="woocommerce-input-wrapper"><select name="wooDelivery_time" id="wooDelivery_time" >
                            <option value="0">Select delivery time</option>
                            </select></p></span>';
                    }

                }

            if($order_type == 'delivery'){
                echo '<p class="form-row woo_delivery_location validate-required" id="woo_delivery_location_field" data-priority=""><label for="woo_delivery_location" class="">Select your delivery area<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_location" id="woo_delivery_location" class="select delivery_location" data-placeholder="Choose Delivery location" required><option value="">Select your delivery area</option>';

                    echo '<option value="1">Same as my billing address</option>';

                echo '</select></span></p>';    
            }

            /** For pro
            if($order_type_checkout == 'delivery'){

                echo '<p class="form-row wooDelivery_add_tips" id="wooDelivery_add_tips_field" data-priority=""><label for="woo_delivery_add_tips" class="">Tips for delivery person<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><select name="woo_delivery_add_tips" id="woo_delivery_add_tips" class="select " data-allow_clear="true" data-placeholder="Select tips amount">
                                    <option value="">Select tips amount</option>';
                        if(isset($tip_amounts)){
                            foreach(array_filter($tip_amounts,'strlen') as $tip_val){
                                echo '<option value="'.esc_html($tip_val).'">'.esc_html($curr_symbol).' '.esc_html($tip_val).'</option>';
                            }
                        }
                echo '</select></span></p>';
            }
            For pro **/
        }
    }
    echo '<div class="custom_css"><style>'.esc_html($archtechwoodelivery_activation_default_custom_css).'</style></div>';
    echo '</div>';
    //echo $output;
}

add_action( 'woocommerce_after_checkout_validation', 'archtech_woo_delivery_custom_validation', 10, 2 );
 
function archtech_woo_delivery_custom_validation( $fields, $errors ){

    $time_required = get_option( 'archtechwoodelivery_activation_default_time_validation' );

    $delivery_type = get_option( 'archtechwoodelivery_activation_default_order_type_checkout' );

    if ( isset( $_REQUEST['post_data'] ) ) {
        parse_str( sanitize_text_field($_REQUEST['post_data']), $post_data );
    } else {
        $post_data = array_map('sanitize_text_field', $_REQUEST );
    }
    
    if($delivery_type == 'pick_up'){
        if ( empty( $_REQUEST['woo_delivery_pickup_location'] ) ){
            $errors->add( 'validation', '<strong>Pickup Location</strong> is a required field.' );
        }
    }elseif($delivery_type == 'delivery'){
        if ( empty( $_REQUEST['woo_delivery_location'] ) ){
            $errors->add( 'validation', '<strong>Delivery Location</strong> is a required field.' );
        }
    }
    

    if ( empty( $_REQUEST['start_date'] ) ){
        $errors->add( 'validation', '<strong>Pickup Date</strong> is a required field.' );
    }

    if($time_required == '1'){
        if ( empty( $_REQUEST['wooDelivery_time'] ) ){
            $errors->add( 'validation', '<strong>Pickup Time</strong> is a required field.' );
        }
    }
    
}

function arch_woo_delivery_demo_scripts() {
	wp_enqueue_script('jquery-ui-datepicker');
	//Enqueue the jQuery UI theme css file from google:
    //$dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('te2b-admin-ui-css', plugin_dir_url(__FILE__) . '/public/css/jquery-ui.css', false, '1.9.0', false);
}
add_action( 'wp_enqueue_scripts', 'arch_woo_delivery_demo_scripts' );


add_action( 'woocommerce_cart_calculate_fees', 'arch_wooDelivery_add_cart_fee' );
function arch_wooDelivery_add_cart_fee( $cart ){
    global $wpdb;
    $admin_obj = new Arch_Woo_Delivery_Pickup_admin();

    $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
    //$table_name1 = $wpdb->prefix .$plugin_name.'_'.'time_table';
    $table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';

    if ( ! $_REQUEST || ( is_admin() && ! is_ajax() ) ) {
        return;
    }

    if ( isset( $_REQUEST['post_data'] ) ) {
        parse_str( sanitize_text_field($_REQUEST['post_data']), $post_data );
    } else {
        $post_data = array_map('sanitize_text_field', $_REQUEST );
    }

    if (isset($post_data['wooDelivery_time'])) {

        $wooDelivery_time = sanitize_text_field($post_data['wooDelivery_time']);

        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} WHERE break_id= %s AND break_status=%s ",$wooDelivery_time, '1'));
        if(!empty($results)) {
            foreach( $results as $value ) {
                $break_extra_fee = $value->break_extra_fee;
                $break_extra_fee_currency = $value->break_extra_fee_currency;
            }
        }

        if(isset($wooDelivery_time) && !empty($break_extra_fee)){
            if($wooDelivery_time !='' && $break_extra_fee !='' && $break_extra_fee !='0'){
                WC()->cart->add_fee( 'Special time slot charge', $break_extra_fee );
            } 
        }
        unset($break_extra_fee,$break_extra_fee_currency);
    }

    if (isset($post_data['woo_delivery_add_tips'])) {
        $tip_ammount = $post_data['woo_delivery_add_tips'];
            if($tip_ammount !=''){
                WC()->cart->add_fee( 'Tips', $tip_ammount );
            }
        
        
    }

}

add_action( 'woocommerce_checkout_create_order', 'archtech_WooDelivery_checkout_field_update_order_meta' );
function archtech_WooDelivery_checkout_field_update_order_meta( $order ) {
    if ( isset($_REQUEST['woo_delivery_type_take_away']) && ! empty($_REQUEST['woo_delivery_type_take_away']) ) {
        $order->update_meta_data( 'woo_delivery_type_take_away', sanitize_text_field( $_REQUEST['woo_delivery_type_take_away'] ) );
    }
    if ( isset($_REQUEST['woo_delivery_pickup_location']) && ! empty($_REQUEST['woo_delivery_pickup_location']) ) {
        $order->update_meta_data( 'woo_delivery_pickup_location', sanitize_text_field( $_REQUEST['woo_delivery_pickup_location'] ) );
    }
    if ( isset($_REQUEST['start_date']) && ! empty($_REQUEST['start_date']) ) {
        $order->update_meta_data( 'pick_date', sanitize_text_field( $_REQUEST['start_date'] ) );
    }
    if ( isset($_REQUEST['wooDelivery_time']) && ! empty($_REQUEST['wooDelivery_time']) ) {
        $order->update_meta_data( 'wooDelivery_time', sanitize_text_field( $_REQUEST['wooDelivery_time'] ) );
    }
    if ( isset($_REQUEST['woo_delivery_location']) && ! empty($_REQUEST['woo_delivery_location']) ) {
        $order->update_meta_data( 'woo_delivery_location', sanitize_text_field( $_REQUEST['woo_delivery_location'] ) );
    }
    if ( isset($_REQUEST['woo_delivery_add_tips']) && ! empty($_REQUEST['woo_delivery_add_tips']) ) {
        $order->update_meta_data( 'woo_delivery_add_tips', sanitize_text_field( $_REQUEST['woo_delivery_add_tips'] ) );
    }
}

add_action( 'woocommerce_order_details_before_order_table_items', 'archtech_WooDelivery_add_content_thankyou' );
  
function archtech_WooDelivery_add_content_thankyou() {
        global $wpdb;
        global $wp;

        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
        // $table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
       
        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name1} WHERE store_status= %s ",'1'));

        $store_arr = array();
        $store_arr1 = array();
        $store_arr2 = array();
        $store_arr3 = array();
        if(!empty($results)) { 
            foreach( $results as $value ) {
                $store_arr[$value->store_id] = $value->store_name;
                $store_arr1[$value->store_id] = $value->store_address;
                $store_arr2[$value->store_id] = $value->store_email;
                $store_arr3[$value->store_id] = $value->store_phone;
            }
        }
        

        if ( isset($wp->query_vars['order-received']) ) {
            $order_id = absint($wp->query_vars['order-received']); // The order ID
            $order    = wc_get_order( $order_id ); // The WC_Order object
        }


        $woo_delivery_type_take_away = $order->get_meta('woo_delivery_type_take_away');
        $woo_delivery_pickup_location = $order->get_meta('woo_delivery_pickup_location');
        $pick_date = $order->get_meta('pick_date');
        $wooDelivery_time = $order->get_meta('wooDelivery_time');
        $woo_delivery_location = $order->get_meta('woo_delivery_location');
        $woo_delivery_add_tips = $order->get_meta('woo_delivery_add_tips');


        if($woo_delivery_type_take_away == '1'){
            echo '<p><strong>Order type:</strong> Pickup</p>';

            if($woo_delivery_pickup_location){
                $pick_result = $store_arr[$woo_delivery_pickup_location] ?? null;
                echo '<p><strong>Picup from:</strong> '.esc_html($pick_result).'</p>';


                echo '<div class="store_det"><strong>Store Details- </strong>';
                    $store_address = $store_arr1[$woo_delivery_pickup_location] ?? null;

                    if($store_address != null){
                        echo '<p><strong>Address:</strong> '.esc_html($store_address).'</p>';
                    }

                    $store_email = $store_arr2[$woo_delivery_pickup_location] ?? null;
                    if($store_email != null){
                        echo '<p><strong>Email:</strong> <a href="mailto:'.esc_html($store_email).'" >'.esc_html($store_email).'</a></p>';
                    }

                    $store_phone = $store_arr3[$woo_delivery_pickup_location] ?? null;
                    if($store_phone != null){
                        echo '<p><strong>Phone:</strong> <a href="tel:'.esc_html($store_phone).'" >'.esc_html($store_phone).'</a></p>';
                    }
                echo '</div>';
            }

            if($pick_date){
                echo '<p><strong>Pickup date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time,'1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Pickup time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }
        }elseif($woo_delivery_type_take_away == '2'){
            echo '<p><strong>Order type:</strong> Delivery</p>';

            if($woo_delivery_location){
                if($woo_delivery_location == '1'){
                    echo '<p><strong>Delivery area:</strong> On billing address</p>';
                
                }
            }

            if($pick_date){
                echo '<p><strong>Delivery date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time,'1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Delivery time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }
        }

        if($woo_delivery_type_take_away == '1'){
            if($pick_date && $wooDelivery_time){
                echo '<p><strong>The order can be Picked Up on </strong> '.gmdate("d/m/Y", strtotime($pick_date)).' between '.esc_html($wooDelivery_time).'</p>';
            }

        }elseif($woo_delivery_type_take_away == '2'){
            if($pick_date && $wooDelivery_time){
                echo '<p><strong>The order can be Delivered on </strong> '.gmdate("d/m/Y", strtotime($pick_date)).' between '.esc_html($wooDelivery_time).'</p>';
            }
        }

}

function archtech_WooDelivery_display_order_data_in_admin( $order ){  ?>

    <?php
    global $wpdb;

        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
        $table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';

        $order_id = $order->get_id();

        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name1} WHERE store_status= %s ",'1'));

        $store_arr = array();
        $store_arr1 = array();
        $store_arr2 = array();
        $store_arr3 = array();
        if(!empty($results)) { 
            foreach( $results as $value ) {
                $store_arr[$value->store_id] = $value->store_name;
                $store_arr1[$value->store_id] = $value->store_address;
                $store_arr2[$value->store_id] = $value->store_email;
                $store_arr3[$value->store_id] = $value->store_phone;
            }
        }

        $woo_delivery_type_take_away = $order->get_meta('woo_delivery_type_take_away');
        $woo_delivery_pickup_location = $order->get_meta('woo_delivery_pickup_location');
        $pick_date = $order->get_meta('pick_date');
        $wooDelivery_time = $order->get_meta('wooDelivery_time');
        $woo_delivery_location = $order->get_meta('woo_delivery_location');
        $woo_delivery_add_tips = $order->get_meta('woo_delivery_add_tips');

    ?>
    <div class="order_data_column">
        <h3>Order Delivery Details</h3>
        <?php
        if($woo_delivery_type_take_away == '1'){
            echo '<p><strong>Order type:</strong> Pickup</p>';

            if($woo_delivery_pickup_location){
                $pick_result = $store_arr[$woo_delivery_pickup_location] ?? null;
                echo '<p><strong>Picup from:</strong> '.esc_html($pick_result).'</p>';

                echo '<div class="store_det"><strong>Store Details- </strong>';
                    $store_address = $store_arr1[$woo_delivery_pickup_location] ?? null;

                    if($store_address != null){
                        echo '<p><strong>Address:</strong> '.esc_html($store_address).'</p>';
                    }

                    $store_email = $store_arr2[$woo_delivery_pickup_location] ?? null;
                    if($store_email != null){
                        echo '<p><strong>Email:</strong> <a href="mailto:'.esc_html($store_email).'" >'.esc_html($store_email).'</a></p>';
                    }

                    $store_phone = $store_arr3[$woo_delivery_pickup_location] ?? null;
                    if($store_phone != null){
                        echo '<p><strong>Phone:</strong> <a href="tel:'.esc_html($store_phone).'" >'.esc_html($store_phone).'</a></p>';
                    }
                echo '</div>';
            }

            if($pick_date){
                echo '<p><strong>Pickup date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time, '1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Pickup time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }
        }elseif($woo_delivery_type_take_away == '2'){
            echo '<p><strong>Order type:</strong> Delivery</p>';

            if($woo_delivery_location){
                if($woo_delivery_location == '1'){
                    echo '<p><strong>Delivery area:</strong> On billing address</p>';
                
                }
            }

            if($pick_date){
                echo '<p><strong>Delivery date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time, '1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Delivery time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }
        }

        //  if($pick_date && $wooDelivery_time){
        //     echo '<p><strong>The order can be Picked Up on </strong> '.date("d/m/Y", strtotime($pick_date)).' at '.$break_time_slot.'</p>';
        // }
        ?>
       
    </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'archtech_WooDelivery_display_order_data_in_admin' );


add_action( 'woocommerce_email_before_order_table', 'archtech_WooDelivery_add_content_specific_email', 20, 4 );
  
function archtech_WooDelivery_add_content_specific_email( $order, $sent_to_admin, $plain_text, $email ) {
   //if ( $email->id == 'customer_processing_order' ) {
        
        global $wpdb;
        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
        $table_name2 = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';

        $order_id = $order->get_id();

        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name1} WHERE store_status= %s ",'1'));

        $store_arr = array();
        $store_arr1 = array();
        $store_arr2 = array();
        $store_arr3 = array();
        if(!empty($results)) { 
            foreach( $results as $value ) {
                $store_arr[$value->store_id] = $value->store_name;
                $store_arr1[$value->store_id] = $value->store_address;
                $store_arr2[$value->store_id] = $value->store_email;
                $store_arr3[$value->store_id] = $value->store_phone;
            }
        }

        $woo_delivery_type_take_away = $order->get_meta('woo_delivery_type_take_away');
        $woo_delivery_pickup_location = $order->get_meta('woo_delivery_pickup_location');
        $pick_date = $order->get_meta('pick_date');
        $wooDelivery_time = $order->get_meta('wooDelivery_time');
        $woo_delivery_location = $order->get_meta('woo_delivery_location');
        $woo_delivery_add_tips = $order->get_meta('woo_delivery_add_tips');

        if($woo_delivery_type_take_away == '1'){
            echo '<p><strong>Order type:</strong> Pickup</p>';

            if($woo_delivery_pickup_location){
                $pick_result = $store_arr[$woo_delivery_pickup_location] ?? null;
                echo '<p><strong>Picup from:</strong> '.esc_html($pick_result).'</p>';


                echo '<div class="store_det"><strong>Store Details- </strong>';
                    $store_address = $store_arr1[$woo_delivery_pickup_location] ?? null;

                    if($store_address != null){
                        echo '<p><strong>Address:</strong> '.esc_html($store_address).'</p>';
                    }

                    $store_email = $store_arr2[$woo_delivery_pickup_location] ?? null;
                    if($store_email != null){
                        echo '<p><strong>Email:</strong> <a href="mailto:'.esc_html($store_phone).'" >'.esc_html($store_email).'</a></p>';
                    }

                    $store_phone = $store_arr3[$woo_delivery_pickup_location] ?? null;
                    if($store_phone != null){
                        echo '<p><strong>Phone:</strong> <a href="tel:'.esc_html($store_phone).'" >'.esc_html($store_phone).'</a></p>';
                    }
                echo '</div>';
            }

            if($pick_date){
                echo '<p><strong>Pickup date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time,'1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Pickup time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }

            if($pick_date && $wooDelivery_time){
                echo '<p><strong>The order can be Picked Up on </strong> '.gmdate("d/m/Y", strtotime($pick_date)).' between '.esc_html($wooDelivery_time).'</p>';
            }
        }elseif($woo_delivery_type_take_away == '2'){
            echo '<p><strong>Order type:</strong> Delivery</p>';

            if($woo_delivery_location){
                if($woo_delivery_location == '1'){
                    echo '<p><strong>Delivery area:</strong> On billing address</p>';
                
                }
            }

            if($pick_date){
                echo '<p><strong>Delivery date:</strong> '.esc_html($pick_date).'</p>';
            }

            if($wooDelivery_time){

                // $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name2} WHERE break_id= %s AND break_status= %s ",$wooDelivery_time,'1'));
                // if(!empty($results)) {
                //     foreach( $results as $value ) {
                //         $break_time_slot = $value->break_time_slot;
                        
                //     }
                // }

                echo '<p><strong>Delivery time:</strong> '.esc_html($wooDelivery_time).'</p>';
            }
            if($pick_date && $wooDelivery_time){
                echo '<p><strong>The order can be Delivered on </strong> '.gmdate("d/m/Y", strtotime($pick_date)).' between '.esc_html($wooDelivery_time).'</p>';
            }
        }

   //}
}


function archtech_woo_delivery_admin_new_order_email_recipient( $recipient, $order ) {
    global $woocommerce;

    global $wpdb;
        $admin_obj = new Arch_Woo_Delivery_Pickup_admin();
        $plugin_name = $admin_obj->arch_woodelivery_get_plugin_name();
        $table_name1 = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';

        $order_id = $order->get_id();
        $woo_delivery_pickup_location = get_post_meta($order_id, 'woo_delivery_pickup_location', true);

        $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name1} WHERE store_status= %s ",'1'));

        $store_arr = array();
        if(!empty($results)) { 
            foreach( $results as $value ) {
                $store_arr[$value->store_id] = $value->store_email;
            }
        }

        if($woo_delivery_pickup_location){
            $pick_result = $store_arr[$woo_delivery_pickup_location] ?? null;
            
        }
        $recipient .= ', '.$pick_result;
        //$recipient = $pick_result;
    
    return $recipient;
}
add_filter('woocommerce_email_recipient_new_order', 'archtech_woo_delivery_admin_new_order_email_recipient', 1, 2);
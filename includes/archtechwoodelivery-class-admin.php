<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://webchunky.com/
 * @since      1.0.0
 *
 * @package    Woo_Delivery_Pickup_admin
 * @subpackage Woo_Delivery_Pickup_admin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_Delivery_Pickup_admin
 * @subpackage Woo_Delivery_Pickup_admin/includes
 * @author     Archtechdesing <support@archtechdesign.com>
 */
class Arch_Woo_Delivery_Pickup_admin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woo_Delivery_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	protected $arch_wooDelivery_fontawesome;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'Arch_Woo_Delivery_VERSION' ) ) {
			$this->version = Arch_Woo_Delivery_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'archwoodelivery';
		

		$this->arch_woodelivery_load_dependencies();
		$this->arch_woodelivery_set_locale();
		$this->arch_woodelivery_define_admin_hooks();
		$this->arch_woodelivery_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_Delivery_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_Delivery_i18n. Defines internationalization functionality.
	 * - Arch_Woo_Delivery_Admin. Defines all hooks for the admin area.
	 * - Woo_Delivery_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function arch_woodelivery_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/archtechwoodelivery-class-settings-page-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/archtechwoodelivery-class-settings-page-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-settings-page-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-settings-page-public.php';

		$this->loader = new Arch_Woo_Delivery_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woo_Delivery_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function arch_woodelivery_set_locale() {

		$plugin_i18n = new Arch_Woo_Delivery_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function arch_woodelivery_define_admin_hooks() {

		$plugin_admin = new Arch_Woo_Delivery_Admin( $this->arch_woodelivery_get_plugin_name(), $this->arch_woodelivery_get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function arch_woodelivery_define_public_hooks() {

		$plugin_public = new Arch_Woo_Delivery_Public( $this->arch_woodelivery_get_plugin_name(), $this->arch_woodelivery_get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function arch_woodelivery_run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function arch_woodelivery_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woo_Delivery_Loader    Orchestrates the hooks of the plugin.
	 */
	public function arch_woodelivery_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function arch_woodelivery_get_version() {
		return $this->version;
	}

	public function Arch_Woodelivery_plugin_activation_date() {
		$currentActivatedDate = gmdate("m/d/Y");
		add_option('archtechwoodelivery_activation_date',$currentActivatedDate);
		//return $currentActivatedDate;
	}

	/*** functions for time zone setting form start ***/
	public function Arch_Woodelivery_plugin_activation_time_zone() {
		add_option('archtechwoodelivery_activation_default_time_zone','GMT');
	}
	/*** functions for time zone setting form start ***/ 

	/*** functions for order settings form start ***/ 
	public function Arch_Woodelivery_plugin_activation_order_type() {
		add_option('archtechwoodelivery_activation_default_order_type','both');
	}

	public function Arch_Woodelivery_plugin_activation_order_type_checkout() {
		add_option('archtechwoodelivery_activation_default_order_type_checkout','delivery');
	}

	public function Arch_Woodelivery_plugin_activation_order_type_field_label() {
		add_option('archtechwoodelivery_activation_default_order_type_field_label','Order Type');
	}

	public function Arch_Woodelivery_plugin_activation_delivery_option_field_label() {
		add_option('archtechwoodelivery_activation_default_delivery_option_field_label','Delivery');
	}

	public function Arch_Woodelivery_plugin_activation_pickup_option_field_label() {
		add_option('archtechwoodelivery_activation_default_pickup_option_field_label','Pickup');
	}
	/*** functions for order settings form end ***/ 

	/*** functions for delivery date settings form start ***/
	public function Arch_Woodelivery_plugin_activation_delivery_date_show_hide() {
		add_option('archtechwoodelivery_activation_default_delivery_date_show_hide','1');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_date_mandatory() {
		add_option('archtechwoodelivery_activation_default_delivery_date_mandatory','1');
	}
	public function Arch_Woodelivery_plugin_activation_date_label_text() {
		add_option('archtechwoodelivery_activation_default_delivery_date_label_text','Delivery Date');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_date_start_from() {
		add_option('archtechwoodelivery_activation_default_delivery_date_start_from','0');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_date_format() {
		add_option('archtechwoodelivery_activation_default_delivery_date_format','dd-mm-yy');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_date_delivery_days() {
		add_option('archtechwoodelivery_activation_default_delivery_date_delivery_days','');
	}
	/*** functions for delivery date settings form end ***/

	/*** functions for pickup date settings form start ***/
	public function Arch_Woodelivery_plugin_activation_pickup_date_show_hide() {
		add_option('archtechwoodelivery_activation_default_pickup_date_show_hide','1');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_date_mandatory() {
		add_option('archtechwoodelivery_activation_default_pickup_date_mandatory','1');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_date_label_text() {
		add_option('archtechwoodelivery_activation_default_pickup_date_label_text','Pickup Date');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_date_start_from() {
		add_option('archtechwoodelivery_activation_default_pickup_date_start_from','0');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_date_format() {
		add_option('archtechwoodelivery_activation_default_pickup_date_format','dd-mm-yy');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_date_delivery_days() {
		add_option('archtechwoodelivery_activation_default_pickup_date_delivery_days','');
	}
	/*** functions for pickup date settings form end ***/

	/*** functions for delivery time settings form start ***/
	public function Arch_Woodelivery_plugin_activation_delivery_time_show_hide() {
		add_option('archtechwoodelivery_activation_default_delivery_time_show_hide','1');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_mandatory() {
		add_option('archtechwoodelivery_activation_default_delivery_time_mandatory','0');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_label_text() {
		add_option('archtechwoodelivery_activation_default_delivery_time_label_text','Delivery Time');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_hour() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_hour',12);
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_min() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_min',00);
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_starts_format() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_starts_format','AM');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_hour() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_hour',11);
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_min() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_min',00);
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_ends_format() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_ends_format','PM');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_breaks() { //default time slot break.

		$default_time_slot_break = '["12:00 AM - 12:30 AM","12:30 AM - 1:00 AM","1:00 AM - 1:30 AM","1:30 AM - 2:00 AM","2:00 AM - 2:30 AM","2:30 AM - 3:00 AM","3:00 AM - 3:30 AM","3:30 AM - 4:00 AM","4:00 AM - 4:30 AM","4:30 AM - 5:00 AM","5:00 AM - 5:30 AM","5:30 AM - 6:00 AM","6:00 AM - 6:30 AM","6:30 AM - 7:00 AM","7:00 AM - 7:30 AM","7:30 AM - 8:00 AM","8:00 AM - 8:30 AM","8:30 AM - 9:00 AM","9:00 AM - 9:30 AM","9:30 AM - 10:00 AM","10:00 AM - 10:30 AM","10:30 AM - 11:00 AM","11:00 AM - 11:30 AM","11:30 AM - 12:00 PM","12:00 PM - 12:30 PM","12:30 PM - 1:00 PM","1:00 PM - 1:30 PM","1:30 PM - 2:00 PM","2:00 PM - 2:30 PM","2:30 PM - 3:00 PM","3:00 PM - 3:30 PM","3:30 PM - 4:00 PM","4:00 PM - 4:30 PM","4:30 PM - 5:00 PM","5:00 PM - 5:30 PM","5:30 PM - 6:00 PM","6:00 PM - 6:30 PM","6:30 PM - 7:00 PM","7:00 PM - 7:30 PM","7:30 PM - 8:00 PM","8:00 PM - 8:30 PM","8:30 PM - 9:00 PM","9:00 PM - 9:30 PM","9:30 PM - 10:00 PM","10:00 PM - 10:30 PM","10:30 PM - 11:00 PM","11:00 PM - 11:30 PM","11:30 PM - 11:59 PM"]';

		add_option('archtechwoodelivery_activation_default_delivery_time_slot_breaks',$default_time_slot_break);
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_slot_duration_format() {
		add_option('archtechwoodelivery_activation_default_delivery_time_slot_duration_format','30');
	}
	public function Arch_Woodelivery_plugin_activation_delivery_time_format() {
		add_option('archtechwoodelivery_activation_default_delivery_time_format','12');
	}
	
	/*** functions for delivery time settings form start ***/

	/*** functions for pickup time settings form start ***/
	public function Arch_Woodelivery_plugin_activation_pickup_time_show_hide() {
		add_option('archtechwoodelivery_activation_default_pickup_time_show_hide','1');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_mandatory() {
		add_option('archtechwoodelivery_activation_default_pickup_time_mandatory','0');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_label_text() {
		add_option('archtechwoodelivery_activation_default_pickup_time_label_text','Pickup Time');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_hour() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_hour',12);
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_min() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_min',00);
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_starts_format() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_starts_format','AM');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_hour() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_hour',11);
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_min() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_min',00);
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_ends_format() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_ends_format','PM');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_breaks() { //default time slot break.

		$default_time_slot_break = '["12:00 AM - 12:30 AM","12:30 AM - 1:00 AM","1:00 AM - 1:30 AM","1:30 AM - 2:00 AM","2:00 AM - 2:30 AM","2:30 AM - 3:00 AM","3:00 AM - 3:30 AM","3:30 AM - 4:00 AM","4:00 AM - 4:30 AM","4:30 AM - 5:00 AM","5:00 AM - 5:30 AM","5:30 AM - 6:00 AM","6:00 AM - 6:30 AM","6:30 AM - 7:00 AM","7:00 AM - 7:30 AM","7:30 AM - 8:00 AM","8:00 AM - 8:30 AM","8:30 AM - 9:00 AM","9:00 AM - 9:30 AM","9:30 AM - 10:00 AM","10:00 AM - 10:30 AM","10:30 AM - 11:00 AM","11:00 AM - 11:30 AM","11:30 AM - 12:00 PM","12:00 PM - 12:30 PM","12:30 PM - 1:00 PM","1:00 PM - 1:30 PM","1:30 PM - 2:00 PM","2:00 PM - 2:30 PM","2:30 PM - 3:00 PM","3:00 PM - 3:30 PM","3:30 PM - 4:00 PM","4:00 PM - 4:30 PM","4:30 PM - 5:00 PM","5:00 PM - 5:30 PM","5:30 PM - 6:00 PM","6:00 PM - 6:30 PM","6:30 PM - 7:00 PM","7:00 PM - 7:30 PM","7:30 PM - 8:00 PM","8:00 PM - 8:30 PM","8:30 PM - 9:00 PM","9:00 PM - 9:30 PM","9:30 PM - 10:00 PM","10:00 PM - 10:30 PM","10:30 PM - 11:00 PM","11:00 PM - 11:30 PM","11:30 PM - 11:59 PM"]';

		add_option('archtechwoodelivery_activation_default_pickup_time_slot_breaks',$default_time_slot_break);
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_slot_duration_format() {
		add_option('archtechwoodelivery_activation_default_pickup_time_slot_duration_format','30');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_time_format() {
		add_option('archtechwoodelivery_activation_default_pickup_time_format','12');
	}
	
	/*** functions for pickup time settings form start ***/

	/*** functions for pickup location settings form start ***/
	public function Arch_Woodelivery_plugin_activation_pickup_location_show_hide() {
		add_option('archtechwoodelivery_activation_default_pickup_location_show_hide','1');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_location_mandatory() {
		add_option('archtechwoodelivery_activation_default_pickup_location_mandatory','1');
	}
	public function Arch_Woodelivery_plugin_activation_pickup_location_label_text() {
		add_option('archtechwoodelivery_activation_default_pickup_location_label_text','Pickup Location');
	}
	/*** functions for pickup locationsettings form end ***/

	/*** functions for others settings form start ***/
	public function Arch_Woodelivery_plugin_activation_others_checkout_heading() {
		add_option('archtechwoodelivery_activation_default_checkout_page_heading','Order Delivery Informations');
	}
	public function Arch_Woodelivery_plugin_activation_others_field_possition() {
		add_option('archtechwoodelivery_activation_default_checkout_field_possition','woocommerce_checkout_before_customer_details');
	}
	public function Arch_Woodelivery_plugin_activation_others_custom_css() {
		add_option('archtechwoodelivery_activation_default_custom_css','');
	}
	/*** functions for others settings form end ***/


	public function Arch_Woodelivery_plugin_activation_time_slot() {
		add_option('archtechwoodelivery_activation_default_time_slot_range','30');
	}

	public function Arch_Woodelivery_plugin_activation_time_slot_interval_option() {
		$intervals_option_arr = ['30','60'];
		add_option('archtechwoodelivery_activation_default_slot_interval_option', $intervals_option_arr);
	}

	public function Arch_Woodelivery_plugin_activation_default_slot_start_time() {
		add_option('archtechwoodelivery_activation_default_start_time','09:00');
	}

	public function Arch_Woodelivery_plugin_activation_default_slot_end_time() {
		add_option('archtechwoodelivery_activation_default_end_time','22:00');
	}

	public function Arch_Woodelivery_plugin_activation_ask_time() {
		add_option('archtechwoodelivery_activation_default_ask_time','1');
	}

	public function Arch_Woodelivery_plugin_activation_time_validation() {
		add_option('archtechwoodelivery_activation_default_time_validation','1');
	}

	public function Arch_Woodelivery_plugin_activation_interval_time() {
		add_option('archtechwoodelivery_activation_default_interval_time','30');
	}

	public function Arch_Woodelivery_plugin_activation_pickup_label_text() {
		add_option('archtechwoodelivery_activation_default_pickup_label_text','Select a Pickup Point');
	}

	// public function Arch_Woodelivery_plugin_activation_date_label_text() {
	// 	add_option('archtechwoodelivery_activation_default_date_label_text','Choose a Date');
	// }

	public function Arch_Woodelivery_plugin_activation_time_label_text() {
		add_option('archtechwoodelivery_activation_default_time_label_text','Choose Time');
	}

	public function Arch_Woodelivery_plugin_activation_special_time_text() {
		add_option('archtechwoodelivery_activation_default_special_time_text','Special time slot charge');
	}

	public function Arch_Woodelivery_plugin_activation_additional_charge_text() {
		add_option('archtechwoodelivery_activation_default_additional_charge_text','Additional charge applied');
	}

	public function Arch_Woodelivery_plugin_activation_all_days() {
		$all_days_arr = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
		add_option('archtechwoodelivery_activation_default_all_days', $all_days_arr);
	}

	public function Arch_Woodelivery_plugin_activation_delivery_tips() {
		$tips_arr = ['2','5','7','10','15'];
		add_option('archtechwoodelivery_activation_default_tips', $tips_arr);
	}

	public function arch_woodelivery_create_store_table() {
		global $wpdb;
		//global $jal_db_version;
		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'stores';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			store_id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			store_name text NOT NULL,
			store_slug text,
			store_address text,
			store_email text,
			store_phone text,
			store_details text,
			store_status text NOT NULL,
			PRIMARY KEY  (store_id)
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		//add_option( 'jal_db_version', $jal_db_version );
	}

	public function arch_woodelivery_create_time_slot_table() {
		global $wpdb;
		//global $jal_db_version;
		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				day text NOT NULL,
				day_slug text NOT NULL,
				start_time text,
				end_time text,
				time_slot text,
				time_slot_break text,
				time_slot_details text,
				time_status text NOT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		//add_option( 'jal_db_version', $jal_db_version );
	}

	public function arch_woodelivery_insert_value_time_slot_table() {
		global $wpdb;
		//global $jal_db_version;
		$all_days_arr = get_option('archtechwoodelivery_activation_default_all_days');
		$start_time = get_option('archtechwoodelivery_activation_default_start_time');
		$end_time = get_option('archtechwoodelivery_activation_default_end_time');
		$time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');

		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';

		$store_slot_result = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name}"));

		if(empty($store_slot_result)){
			foreach($all_days_arr as $days){

				$wpdb->query( $wpdb->prepare(
					"INSERT INTO $table_name( time, day, day_slug, start_time, end_time, time_slot, time_status )VALUES ( %d, %s, %s, %s, %s, %s, %s )",
				      current_time( 'mysql' ), $days, strtolower($days), $start_time, $end_time, $time_slot, '1' 
				      
					)
				);
			}
		}
		

	}

	public function arch_woodelivery_create_time_slot_break_fees() {
		global $wpdb;
		//global $jal_db_version;
		
		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
				break_id mediumint(9) NOT NULL AUTO_INCREMENT,
				time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				beak_time_day text NOT NULL,
				break_time_slot text NOT NULL,
				break_time_intervals text,
				break_extra_fee_currency text,
				break_extra_fee text,
				break_details text,
				break_status text NOT NULL,
				PRIMARY KEY  (break_id)
			) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		//add_option( 'jal_db_version', $jal_db_version );
	}

	public function arch_woodelivery_insert_value_time_slot_break_table() {
		global $wpdb;
		//global $jal_db_version;
		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
		$all_days_arr = get_option('archtechwoodelivery_activation_default_all_days');
		$intervals_option_arr = get_option('archtechwoodelivery_activation_default_slot_interval_option');
		$time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');

		$start_time = get_option('archtechwoodelivery_activation_default_start_time');
		$end_time = get_option('archtechwoodelivery_activation_default_end_time');
		//get_woocommerce_currency_symbol();
			if ( function_exists( 'get_woocommerce_currency' ) ) {
				$curr_symbol = get_woocommerce_currency();
			}else{
				$curr_symbol = '';
			}

		$store_slot_break_result = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name}"));

		if(empty($store_slot_break_result)){

			foreach($intervals_option_arr as $intervals_option_val){

				foreach($all_days_arr as $all_days_val){

					$days_start_slot=strtotime($start_time);
	            	$days_end_slot=strtotime($end_time);

	            	while ($days_start_slot<$days_end_slot) {
	                
		                $timeslct_start = gmdate("h:i A",$days_start_slot);

		                $j = $days_start_slot + $time_slot*60;
		                $timeslct_end = gmdate("h:i A",$j);

		                $slot_val = $timeslct_start.' - '.$timeslct_end;

		                $wpdb->query( $wpdb->prepare(
							"INSERT INTO $table_name( time, beak_time_day, break_time_slot, break_time_intervals, break_extra_fee_currency, break_extra_fee, break_details, break_status )VALUES ( %d, %s, %s, %s, %s, %s, %s, %s )",
						      current_time( 'mysql' ), strtolower($all_days_val), $slot_val, $intervals_option_val, esc_html($curr_symbol), '0', '', '1' 
						      
							));

		           
		                $days_start_slot=$j;
		               
		                
		            }


				}

				
			}

		}
		

	}

	public function arch_woodelivery_insert_value_time_slot_break_table_on_updated() {
		global $wpdb;
		//global $jal_db_version;
		$plugin_name = $this->plugin_name;
		$table_name = $wpdb->prefix .esc_html($plugin_name).'_'.'time_slot_break_fees';
		$all_days_arr = get_option('archtechwoodelivery_activation_default_all_days');
		$intervals_option_arr = get_option('archtechwoodelivery_activation_default_slot_interval_option');
		$time_slot = get_option('archtechwoodelivery_activation_default_time_slot_range');

		// $start_time = get_option('archtechwoodelivery_activation_default_start_time');
		// $end_time = get_option('archtechwoodelivery_activation_default_end_time');
		//get_woocommerce_currency_symbol();

		$slot_table = $wpdb->prefix .esc_html($plugin_name).'_'.'time_table';

			if ( function_exists( 'get_woocommerce_currency' ) ) {
				$curr_symbol = get_woocommerce_currency();
			}else{
				$curr_symbol = '';
			}

		foreach($intervals_option_arr as $intervals_option_val){

			foreach($all_days_arr as $all_days_val){
				$day_slug = strtolower($all_days_val);
				$day_results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$slot_table} WHERE day_slug= $s ",$day_slug));

				foreach( $day_results as $day_value ) {
		            $start_time = $day_value->start_time;
		            $end_time = $day_value->end_time;
		        }

				$days_start_slot=strtotime($start_time);
            	$days_end_slot=strtotime($end_time);

            	while ($days_start_slot<$days_end_slot) {
                
	                $timeslct_start = gmdate("h:i A",$days_start_slot);

	                $j = $days_start_slot + $time_slot*60;
	                $timeslct_end = gmdate("h:i A",$j);

	                $slot_val = $timeslct_start.' - '.$timeslct_end;

	                $wpdb->query( $wpdb->prepare(
							"INSERT INTO $table_name( time, beak_time_day, break_time_slot, break_time_intervals, break_extra_fee_currency, break_extra_fee, break_details, break_status )VALUES ( %d, %s, %s, %s, %s, %s, %s, %s )",
						      current_time( 'mysql' ), strtolower($all_days_val), $slot_val, $intervals_option_val, esc_html($curr_symbol), '0', '', '1' 
						      
							));

	                $days_start_slot=$j;
	               
	                
	            }


			}

			
		}
		

	}


}

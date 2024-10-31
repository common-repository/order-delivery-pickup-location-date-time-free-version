<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webchunky.com/
 * @since      1.0.0
 *
 * @package    Woo_Delivery
 * @subpackage Woo_Delivery/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Delivery
 * @subpackage Woo_Delivery/admin
 * @author     archtech
 */
class Arch_Woo_Delivery_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array( $this, 'Archtech_addPluginAdminMenu' ), 9);   
		//add_action('admin_init', array( $this, 'registerAndBuildFields' )); 

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Delivery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Delivery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, esc_url(plugin_dir_url( __FILE__ )) . 'css/settings-page-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Delivery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Delivery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, esc_url(plugin_dir_url( __FILE__ )) . 'js/archtech-woodelivery-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function Archtech_addPluginAdminMenu() {

		add_menu_page(  'Woo Delivery Pickup ODT', 'Woo Delivery Pickup ODT', 'administrator', $this->plugin_name, array( $this, 'Archtech_WooDelivery_Home' ), 'dashicons-store', 26 );

		// add_submenu_page( $this->plugin_name, 'Stores', 'Stores', 'shop_manager', $this->plugin_name.'-stores', array( $this, 'Archtech_WooDelivery_Stores' ));

		// //add_submenu_page( null, 'Add stores', 'Add Stores', 'administrator', $this->plugin_name.'-add-stores', array( $this, 'Archtech_WooDelivery_Add_Stores' ));

		// add_submenu_page(
		// 		'',
		// 		'Add stores',
		// 		'Add stores',
		// 		'manage_options',
		// 		$this->plugin_name.'-add-stores', array( $this, 'Archtech_WooDelivery_Add_Stores' ) );
		

		// add_submenu_page( $this->plugin_name, 'Settings', 'Settings', 'administrator', $this->plugin_name.'-settings', array( $this, 'Archtech_WooDelivery_Settings' ));

		// add_submenu_page( $this->plugin_name, 'Pickup Times', 'Pickup Times', 'administrator', $this->plugin_name.'-manage-pickup-time', array( $this, 'Archtech_WooDelivery_pickup_Settings' ));

		// add_submenu_page( $this->plugin_name, 'Manage Time Slots', 'Manage Time Slots', 'administrator', $this->plugin_name.'-manage-time-slots', array( $this, 'Archtech_WooDelivery_time_slots_Settings' ));

		// add_submenu_page( $this->plugin_name, 'Support', 'Support', 'administrator', $this->plugin_name.'-support', array( $this, 'Archtech_WooDelivery_Support' ));


	}

	public function Archtech_WooDelivery_Home() {
		require_once 'partials/'.$this->plugin_name.'-admin-home-display.php';
	}
	// public function Archtech_WooDelivery_Booking_calender() {
	// 	echo 'Comming Soon';
 //  	}

 //  	public function Archtech_WooDelivery_Stores() {
	// 	require_once 'partials/'.$this->plugin_name.'-admin-stores-display.php';


 //  	}

 //  	public function Archtech_WooDelivery_Add_Stores() {
	// 	require_once 'partials/'.$this->plugin_name.'-admin-add-stores.php';

 //  	}

 //  	public function Archtech_WooDelivery_Settings() {
	// 	require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';

		
 //  	}

 //  	public function Archtech_WooDelivery_pickup_Settings() {
	// 	require_once 'partials/'.$this->plugin_name.'-admin-pickup-time-settings-display.php';
		
 //  	}

 //  	public function Archtech_WooDelivery_time_slots_Settings() {
	// 	require_once 'partials/'.$this->plugin_name.'-admin-time-slot-settings-display.php';
		
 //  	}

 //  	public function Archtech_WooDelivery_Support() {
	// 	//require_once 'partials/'.$this->plugin_name.'-admin-display.php';

	// 	echo '<div class="supp_div">For any queries mail us <a href="mailto:info@webchunky.com"><strong>info@webchunky.com</strong></a></div>';
 //  	}




}

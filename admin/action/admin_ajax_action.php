<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly /** 

function arch_woodelivery_checkout_timepic() {
    echo 'hello world';
    wp_die();
}

add_action( 'wp_ajax_arch_woodelivery_checkout_timepic', 'arch_woodelivery_checkout_timepic' );
add_action( 'wp_ajax_arch_woodelivery_checkout_timepic', 'arch_woodelivery_checkout_timepic' );
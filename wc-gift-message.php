<?php
/**
 * Plugin Name: WooCommerce Gift Message
 * Description: Adds a gift message field to WooCommerce products.
 * Author: Vamshi Rapolu
 */

if (!defined('ABSPATH')) exit;

define('WCGM_DIR', plugin_dir_path(__FILE__));

require_once WCGM_DIR . 'includes/class-gift-message-handler.php';

function wcgm_init() {
    if (class_exists('WC_Gift_Message_Handler')) {
        new WC_Gift_Message_Handler();
    }
}
add_action('plugins_loaded', 'wcgm_init');

add_action('rest_api_init',function(){
    register_rest_route('giftmessages/v1','/orders',[
        'methods'=>'GET',
        'callback'=>'wcgm_get_latest_orders_with_gift_messages',
        'permission_callback'=>function(){
            return current_user_can('manage_woocommerce');
        }
    ]);
})

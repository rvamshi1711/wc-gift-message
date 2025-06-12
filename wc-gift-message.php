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


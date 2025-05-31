<?php
if (!defined('ABSPATH')) exit;

class WC_Gift_Message_Handler {
    public function __construct() {
        
        add_action('woocommerce_before_add_to_cart_button', [$this, 'add_gift_message_field']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        add_filter('woocommerce_add_cart_item_data', [$this, 'save_gift_message_to_cart'], 10, 2);
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'save_gift_message_order'], 10, 4);

    }

    public function add_gift_message_field() {
    echo '<div class="gift-message-wrap"><label for="gift_message">Gift Message</label>';
    echo '<textarea name="gift_message" id="gift_message" maxlength="150" rows="3" placeholder="Write a message (max 150 characters)"></textarea>';
    echo '<div id="char-count">150 characters remaining</div></div>';

    // Added inline CSS as script not working
    // Also added code in CSS/style.css & js/script.js
    echo '<style>
        .gift-message-wrap {
            margin-top: 20px;
            font-family: sans-serif;
        }
        #gift_message {
            width: 100%;
            max-width: 500px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        #char-count {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        </style>';
    }

    public function save_gift_message_to_cart($cart_item_data, $product_id) {
        if (!empty($_POST['gift_message'])) {
            $message = sanitize_text_field($_POST['gift_message']);
            $cart_item_data['gift_message'] = $message;
        }
        return $cart_item_data;
    }

    public function save_gift_message_order($item, $cart_item_key, $values, $order) {
        if (!empty($values['gift_message'])) {
            $item->add_meta_data('Gift Message', $values['gift_message'], true);
        }
    }


}

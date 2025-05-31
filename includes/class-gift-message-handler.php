<?php
if (!defined('ABSPATH')) exit;

class WC_Gift_Message_Handler {
    public function __construct() {
        
        add_action('woocommerce_before_add_to_cart_button', [$this, 'add_gift_message_field']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

    }

    public function add_gift_message_field() {
    echo '<div class="gift-message-wrap"><label for="gift_message">Gift Message</label>';
    echo '<textarea name="gift_message" id="gift_message" maxlength="150" rows="3" placeholder="Write a message (max 150 characters)"></textarea>';
    echo '<div id="char-count">150 characters remaining</div></div>';

    // Added inline CSS as script not working
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

}

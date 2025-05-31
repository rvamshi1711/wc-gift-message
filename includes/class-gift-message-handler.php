<?php
if (!defined('ABSPATH')) exit;

class WC_Gift_Message_Handler {
    public function __construct() {
        
        add_action('woocommerce_before_add_to_cart_button', [$this, 'add_gift_message_field']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        add_filter('woocommerce_add_cart_item_data', [$this, 'save_gift_message_to_cart'], 10, 2);
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'save_gift_message_order'], 10, 4);

        add_filter('woocommerce_get_item_data', [$this, 'display_gift_message_cart'], 10, 2);
        add_filter('woocommerce_order_item_name', [$this, 'show_gift_message_order'], 10, 2);
        add_filter('woocommerce_email_order_meta_fields', [$this, 'email_gift_message'], 10, 3);

        add_filter('manage_shop_order_posts_columns', [$this, 'add_admin_column']);
        add_action('manage_shop_order_posts_custom_column', [$this, 'render_admin_column'], 10, 2);

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

    public function display_gift_message_cart($item_data, $cart_item) {
        if (!empty($cart_item['gift_message'])) {
            $item_data[] = [
                'name' => 'Gift Message',
                'value' => wc_clean($cart_item['gift_message']),
            ];
        }
        return $item_data;
    }

    public function email_gift_message($fields, $sent_to_admin, $order) {
        foreach ($order->get_items() as $item_id => $item) {
            $message = wc_get_order_item_meta($item_id, 'Gift Message', true);
                if ($message) {
                    $fields[] = [
                    'label' => 'Gift Message',
                    'value' => $message,
                ];
            }
        }
        return $fields;
    }

    public function show_gift_message_order($item_name, $item) {
        $message = $item->get_meta('Gift Message');
            if ($message) {
            $item_name .= '<br><small><strong>Gift Message:</strong> ' . esc_html($message) . '</small>';
        }
        return $item_name;
    }       

    public function add_admin_column($columns) {
        $columns['gift_message'] = 'Gift Message';
        return $columns;
    }

    public function render_admin_column($column, $post_id) {
        if ('gift_message' === $column) {
            $order = wc_get_order($post_id);
            $messages = [];

            foreach ($order->get_items() as $item) {
                $message = $item->get_meta('Gift Message');
                if ($message) {
                    $messages[] = $message;
                }
            }

            echo esc_html(implode(', ', $messages));
        }
    }


}

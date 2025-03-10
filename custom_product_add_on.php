<?php
/**
 * Plugin Name: WooCommerce Custom Upload Addon
 * Description: Adds a custom file upload field to WooCommerce variable products and adjusts price dynamically.
 * Version: 1.0
 * Author: Suryansh 
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// 1. Add file upload field to product page
add_action('woocommerce_before_add_to_cart_button', 'add_custom_upload_field');
function add_custom_upload_field() {
    echo '<div class="custom-upload-wrapper">';
    echo '<label for="custom_upload">Upload Your Design (Extra ₹50):</label>';
    echo '<input type="file" id="custom_upload" name="custom_upload" data-price="50" accept="image/png, image/jpeg, image/jpg" />';
    echo '<span id="upload-price-notice" style="display:none; color: green; margin-top: 5px;">Extra ₹50 will be added for this upload.</span>';
    echo '</div>';
}

// 2. Handle the uploaded file and adjust price in cart
add_filter('woocommerce_add_cart_item_data', 'handle_custom_upload', 10, 2);
function handle_custom_upload($cart_item_data, $product_id) {
    if (!empty($_FILES['custom_upload']['name'])) {
        $upload = wp_upload_bits($_FILES['custom_upload']['name'], null, file_get_contents($_FILES['custom_upload']['tmp_name']));
        if (!$upload['error']) {
            $cart_item_data['custom_upload'] = $upload['url'];
            $cart_item_data['custom_upload_fee'] = 50; // Increase price by ₹50
            wc_add_notice('Your file was uploaded successfully!', 'success');
        } else {
            wc_add_notice('Failed to upload file.', 'error');
        }
    }
    return $cart_item_data;
}

// 3. Display uploaded file in cart and checkout
add_filter('woocommerce_get_item_data', 'display_upload_in_cart', 10, 2);
function display_upload_in_cart($item_data, $cart_item) {
    if (isset($cart_item['custom_upload'])) {
        $item_data[] = array(
            'name' => 'Uploaded File',
            'value' => '<a href="' . esc_url($cart_item['custom_upload']) . '" target="_blank">View Uploaded File</a>'
        );
    }
    return $item_data;
}

// 4. Adjust cart price dynamically based on uploaded file
add_action('woocommerce_before_calculate_totals', 'adjust_cart_item_price', 10, 1);
function adjust_cart_item_price($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['custom_upload_fee'])) {
            $cart_item['data']->set_price($cart_item['data']->get_price() + $cart_item['custom_upload_fee']);
        }
    }
}

// 5. Save uploaded file data in order details
add_action('woocommerce_checkout_create_order_line_item', 'save_upload_to_order', 10, 4);
function save_upload_to_order($item, $cart_item_key, $values, $order) {
    if (isset($values['custom_upload'])) {
        $item->add_meta_data('Uploaded File', $values['custom_upload']);
    }
}

// 6. Display uploaded file in admin order details
add_action('woocommerce_order_item_meta_end', 'display_upload_in_admin', 10, 4);
function display_upload_in_admin($item_id, $item, $order, $plain_text) {
    $uploaded_file = wc_get_order_item_meta($item_id, 'Uploaded File', true);
    if ($uploaded_file) {
        echo '<p><strong>Uploaded File:</strong> <a href="' . esc_url($uploaded_file) . '" target="_blank">View File</a></p>';
    }
}

// 7. Enqueue custom JS for live price update
add_action('wp_enqueue_scripts', 'enqueue_custom_upload_scripts');
function enqueue_custom_upload_scripts() {
    if (is_product()) {
        wp_enqueue_script(
            'custom-upload-addon-js',
            plugin_dir_url(__FILE__) . 'custom_product_add_on.js',
            array('jquery'),
            null,
            true
        );
    }
}

// 8. Add CSS styles for better display (Optional)
add_action('wp_head', 'custom_upload_addon_styles');
function custom_upload_addon_styles() {
    ?>
    <style>
        .custom-upload-wrapper {
            margin-top: 15px;
        }

        .custom-upload-wrapper label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .custom-upload-wrapper input[type="file"] {
            border: 1px solid #ccc;
            padding: 8px;
            width: 100%;
            border-radius: 4px;
        }

        #upload-price-notice {
            font-size: 14px;
            color: #28a745;
        }
    </style>
    <?php
}

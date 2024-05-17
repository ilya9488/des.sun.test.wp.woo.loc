<?php

class CustomMiniCart_Class {

  public function __construct() {
    add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    add_shortcode( 'custom-woo-minicart', array( $this, 'woo_minicart_shortcode' ) );
  }

  public function scripts() {
    wp_enqueue_script('woo-minicart-defer', get_theme_file_uri('/inc/custm-woo-minicart/assets/js/woo-minicart.js'), array('my-jquery'), '', true);
  }

  public function woo_minicart_shortcode() {
    if( !is_cart() && !is_checkout() ) {
      ob_start();
      require get_template_directory() . '/inc/custm-woo-minicart/shortcode-template.php';
      $shortcode = ob_get_clean();
      return $shortcode;
    }
  }
}


// Minimum amount for free delivery
function get_free_shipping_minimum() {
  $delivery_zones = WC_Shipping_Zones::get_zones();
  foreach ($delivery_zones as $key => $the_zone) {
    $shipping_methods = $the_zone['shipping_methods'];
    foreach ($shipping_methods as $method) {
      if ($method->id == 'free_shipping') {
        return $method->min_amount;
      }
    }
  }
  return false;
}


// add to cart - action
function update_mini_cart_on_add_to_cart() {
  ob_start();
  require get_template_directory() . '/inc/custm-woo-minicart/content.php';
  $mini_cart_content = ob_get_clean();
  $mini_cart_count = WC()->cart->get_cart_contents_count();
  $mini_cart_subtotal = wp_kses_post(WC()->cart->get_cart_subtotal());

  wp_send_json_success(array(
    'mini_cart_content' => $mini_cart_content,
    'mini_cart_count' => $mini_cart_count,
    'mini_cart_subtotal' => $mini_cart_subtotal,
  ));
}
//  update mini cart on add to cart - action
add_action('wp_ajax_update_mini_cart_on_add_to_cart', 'update_mini_cart_on_add_to_cart');
add_action('wp_ajax_nopriv_update_mini_cart_on_add_to_cart', 'update_mini_cart_on_add_to_cart');


// remove - action
function remove_from_cart_ajax() {
  if (isset($_POST['cart_item_key']) && isset($_POST['product_id'])) {
      $cart_item_key = $_POST['cart_item_key'];
      $product_id = $_POST['product_id'];
      
      // Remove the goods from the basket
      WC()->cart->remove_cart_item($cart_item_key);
      // Update the basket after removing the goods
      WC()->cart->calculate_totals();
      // Get the total quantity of goods in the basket
      $total_quantity = WC()->cart->get_cart_contents_count();
      // Get the total cost of all goods in the basket
      $total_price = WC()->cart->get_cart_total();
      
      $response_data = array(
        'id_remove_item' => $product_id,
        'updated_quantity' => $threeball_product_quantity,
        'product_id' => $cart_item_key,
        'total_quantity' => $total_quantity,
        'total_price' => $total_price,
      );
  
      $min_order_for_free_shipping = get_free_shipping_minimum();
  
      if ($min_order_for_free_shipping !== false) {
        // Calculate total cost of the cart
        $total_cart_cost = 0;
        foreach (WC()->cart->get_cart() as $cart_item) {
          $total_cart_cost += $cart_item['data']->get_price() * $cart_item['quantity'];
        }
        $progress_percent = ($total_cart_cost / $min_order_for_free_shipping) * 100;
        $progress_percent = round($progress_percent, 2);
  
        // add to response
        $response_data['min_order_for_free_shipping'] = $min_order_for_free_shipping;
        $response_data['progress_percent'] = $progress_percent;
        $response_data['price_difference'] = number_format($min_order_for_free_shipping - $total_cart_cost, 2, '.', '');
        
      }
  
      // Return the Ajax response
      wp_send_json_success($response_data);
  } else {
      wp_send_json_error("Bad Request", 400);
  }
  
  die();
}
add_action('wp_ajax_remove_from_cart', 'remove_from_cart_ajax');
add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart_ajax');


// quantity cgange - action
function ajax_my_cart_qty() {
  if (isset($_POST['cart_item_key']) && isset($_POST['quantity'])) {
    // set the product key and quantity from the request
    $cart_item_key = $_POST['cart_item_key'];
    $quantity = $_POST['quantity'];

    // Get the old price of goods
    $old_price = WC()->cart->get_cart_item($cart_item_key)['data']->get_price();

    // Update the quantity of goods in the basket
    $threeball_product_values = WC()->cart->get_cart_item($cart_item_key);
    $threeball_product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);
    $passed_validation  = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity);

    if ($passed_validation) {
      WC()->cart->set_quantity($cart_item_key, $threeball_product_quantity, true);
    }

    // Update the basket after changes
    WC()->cart->calculate_totals();
    // Get the total quantity of goods in the basket
    $total_quantity = WC()->cart->get_cart_contents_count();
    // Get the total cost of all goods in the basket
    $total_price = WC()->cart->get_cart_total();

    $response_data = array(
      'updated_quantity' => $threeball_product_quantity,
      'product_id' => $cart_item_key,
      'total_quantity' => $total_quantity,
      'total_price' => $total_price,
    );

    $min_order_for_free_shipping = get_free_shipping_minimum();

    if ($min_order_for_free_shipping !== false) {
      // Calculate total cost of the cart
      $total_cart_cost = 0;
      foreach (WC()->cart->get_cart() as $cart_item) {
        $total_cart_cost += $cart_item['data']->get_price() * $cart_item['quantity'];
      }
      $progress_percent = ($total_cart_cost / $min_order_for_free_shipping) * 100;
      $progress_percent = round($progress_percent, 2);

      // add to response
      $response_data['min_order_for_free_shipping'] = $min_order_for_free_shipping;
      $response_data['progress_percent'] = $progress_percent;
      $response_data['price_difference'] = number_format($min_order_for_free_shipping - $total_cart_cost, 2, '.', '');
      
    }

    // Return the Ajax response
    wp_send_json_success($response_data);

  } else {
    wp_send_json_error("Bad Request", 400);
  }

  die();
}
add_action('wp_ajax_my_cart_qty', 'ajax_my_cart_qty');
add_action('wp_ajax_nopriv_my_cart_qty', 'ajax_my_cart_qty');
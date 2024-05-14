<?php
  if( empty( WC()->cart ) ){
    $items = array();
  }else{
    $items = WC()->cart->get_cart();
    $cart_count = WC()->cart->get_cart_contents_count();
    $item_text  = ( $cart_count == 1 ) ? __( 'item', 'woo-minicart' ) : __( 'items', 'woo-minicart' );
  }
?>

<?php function cu_wmc_html_empty_cart(){ ?>
    <div class="cu_wmc__header">
      <div class="title"><?php _e('Shopping cart', 'woo-minicart') ?></div>
      <button type="button" class="cu_wmc-close">
        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.4 14.5L0 13.1L5.6 7.5L0 1.9L1.4 0.5L7 6.1L12.6 0.5L14 1.9L8.4 7.5L14 13.1L12.6 14.5L7 8.9L1.4 14.5Z" fill="currentColor"/>
        </svg>
      </button>
    </div>
    <div class="cu_wmc__content">
      <svg class="cu_wmc__content-image" width="101" height="100" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.1" d="M65.3515 34.1463L54.9554 23.9024L44.5594 34.1463L37.6287 27.3171L48.0247 17.0732L37.6287 6.82927L44.5594 0L54.9554 10.2439L65.3515 0L72.2822 6.82927L61.8861 17.0732L72.2822 27.3171L65.3515 34.1463ZM30.203 80.4878C35.6485 80.4878 40.104 84.8781 40.104 90.2439C40.104 95.6098 35.6485 100 30.203 100C24.7574 100 20.302 95.6098 20.302 90.2439C20.302 84.8781 24.7574 80.4878 30.203 80.4878ZM79.7079 80.4878C85.1535 80.4878 89.6089 84.8781 89.6089 90.2439C89.6089 95.6098 85.1535 100 79.7079 100C74.2624 100 69.8069 95.6098 69.8069 90.2439C69.8069 84.8781 74.2624 80.4878 79.7079 80.4878ZM31.1931 64.8781C31.1931 65.3659 31.6881 65.8537 32.1832 65.8537H89.6089V75.6098H30.203C24.7574 75.6098 20.302 71.2195 20.302 65.8537C20.302 63.9024 20.797 62.439 21.2921 60.9756L27.7277 49.2683L10.401 12.1951H0.5V2.43902H16.8366L38.1238 46.3415H72.7772L92.0842 12.1951L100.5 17.0732L81.1931 51.2195C79.7079 54.1463 76.2426 56.0976 72.7772 56.0976H35.6485L31.1931 63.9024V64.8781Z" fill="#777777"/>
      </svg>
      <div class="title"><?php  _e('No products in the cart.', 'woo-minicart'); ?></div>
      <a class="btn-gold" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php _e('RETURN TO SHOP', 'your-text-domain'); ?></a>    
    </div>
<?php } ?>

<?php function cu_wmc_html_cart($items){ ?>

  <div class="cu_wmc__header">
    <div class="title"><?php _e('Shopping cart', 'woo-minicart') ?></div>
    <button type="button" class="cu_wmc-close">
      <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.4 14.5L0 13.1L5.6 7.5L0 1.9L1.4 0.5L7 6.1L12.6 0.5L14 1.9L8.4 7.5L14 13.1L12.6 14.5L7 8.9L1.4 14.5Z" fill="currentColor"/>
      </svg>
    </button>
  </div>

  <ul class="wmc-products">
    <?php foreach($items as $item => $values) :
      $_product =  wc_get_product( $values['data']->get_id() ); 
    ?>

      <li class="wmc-products__item <?php echo $_product->id; ?>">
      
        <!-- too trash pverlay-->
        <div class="wmc-products__load-remove-pverlay <?php echo $_product->id; ?>"></div>

        <div class="wmc-products__img">
          <a href="<?php echo esc_url( $_product->get_permalink() ); ?>">
            <?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $values, $item ); ?>
          </a>
        </div>  

        <div class="wmc-products__details">

          <a class="wmc-products__title" href="<?php echo esc_url($_product->get_permalink()); ?>">
            <?php echo esc_html($_product->get_title()); ?>
          </a>

          <div class="wmc-products__quantity">
            <button type="button" class="qty-minus" data-id="<?php echo 'qty_'.$_product->id ?>">-</button>
            <input type="number" id="<?php echo 'qty_'.$_product->id ?>" class="qty" step="1" min="1" max="999"
                  name="cart[<?php echo $item ?>][qty]" value="<?php echo $values['quantity']  ?>"
                  title="Qty" size="4" placeholder="" inputmode="numeric">
            <button type="button" class="qty-plus" data-id="<?php echo 'qty_'.$_product->id ?>">+</button>
          </div>

          <p>
            <?php $price = $_product->get_price_html(); ?>
            <?php echo '<span class="wmc-products__price">' . '<span class="wmc-products__item-price wmc-item-qty-'. $item . '">'. esc_html($values["quantity"]) .'</span>' . ' x ' . wp_kses_post($price) .'</span>';?>
          </p>

          <div class="wmc-products__remove">
          <?php // @codingStandardsIgnoreLine
            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
              '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.26732 9.66683L0.333984 8.7335L4.06732 5.00016L0.333984 1.26683L1.26732 0.333496L5.00065 4.06683L8.73398 0.333496L9.66732 1.26683L5.93398 5.00016L9.66732 8.7335L8.73398 9.66683L5.00065 5.9335L1.26732 9.66683Z" fill="currentColor"/>
                  </svg>           
                </a>',
              esc_url( wc_get_cart_remove_url( $item ) ),
              __( 'Remove this item', 'woo-minicart' ),
              esc_attr( $_product->get_id() ),
              esc_attr( $item ),
              esc_attr( $_product->get_sku() )
            ), $item );
          ?>
        </div><!-- /.wmc-products__remove -->
        </div> <!-- /.wmc-products__details -->
      </li>

    <?php endforeach; ?>
  </ul>
  
  <div class="cu_wmc__footer">
    <div class="wmc-subtotal">
  
      <?php $min_order_for_free_shipping = get_free_shipping_minimum();
        if ($min_order_for_free_shipping !== false) {
          // Calculate total cost of the cart
          $total_cart_cost = 0;
          foreach (WC()->cart->get_cart() as $cart_item) {
            $total_cart_cost += $cart_item['data']->get_price() * $cart_item['quantity'];
          }
          $progress_percent = ($total_cart_cost / $min_order_for_free_shipping) * 100;
          $progress_percent = round($progress_percent, 2);
          $mwc_price_difference = number_format($min_order_for_free_shipping - $total_cart_cost, 2, '.', '');
  
          if($progress_percent >= 100){ $progress_percent = 100; }
        }
      ?>
  
      <div class="subtotal">
        <?php _e( '<span class="title-sub">Subtotal:&nbsp;</span>', 'woo-minicart' ); echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?>
      </div>
  
      <div class="wmc-min-free-ship">
        <div class="have-free-shipping <?php echo $progress_percent >= 100?'':'hide'; ?>">You have reached free shipping!</div>
        <div class="have-no-free-shipping <?php echo $progress_percent >= 100?'hide':''; ?>">
          Add 
          <span class="symbol"><?php echo get_woocommerce_currency_symbol();?></span><span class="mwc-price-difference"><?php echo $mwc_price_difference? $mwc_price_difference :''; ?></span>
          to cart and get 
          <span class="free-ship">free shipping!</span>
        </div>
        <div class="wmc-progress">
          <div class="wmc-percent" style="width: <?php echo $progress_percent.'%'; ?>;">
            <!-- lines -> / / / / / /...-->
            <div class="lines">
              <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  
    <div class="wmc-bottom-buttons">
      <a class="btn-gray" href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php _e( 'View Cart', 'woo-minicart' ) ?></a>
      <a class="btn-gold" href="<?php echo esc_url(wc_get_checkout_url()); ?>"><?php _e( 'Checkout', 'woo-minicart' ) ?></a>
    </div>
  </div>
  
<?php } ?>


<?php if( $items ): ?>
  <div class="cu_wmc-content">
    <div class="cu_wmc-content-has-items">
      <?php cu_wmc_html_cart($items); ?>
    </div>
    <div class="cu_wmc-content-empty hide">
      <?php cu_wmc_html_empty_cart(); ?>
    </div>
  </div>
  <div class="cu_wmc-content-bg"></div>
<?php else: ?>
  <div class="cu_wmc-content">
    <div class="cu_wmc-content-empty">
      <?php cu_wmc_html_empty_cart(); ?>
    </div>
  </div>
<div class="cu_wmc-content-bg"></div>

<?php endif; ?>
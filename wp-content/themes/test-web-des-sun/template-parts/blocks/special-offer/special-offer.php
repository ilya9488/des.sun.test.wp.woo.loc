<?php
/**
 * Block Name: Special Offer
 */

  $class = 'special-offer special-offer-' . $block['id'];
  $className = '.special-offer-' . $block['id'];
  if (!empty($block['className'])){
    $class .= ' ' . $block['className'];
  }
  $id_block = '';
  if( !empty($block['anchor']) ) {
    $id_block = 'id=' . $block['anchor'];
  }

  $fields = get_fields();
  $blockStyle = get_style_acf_gut_block($fields['settings_section'], $className);
  $blockUniqid = uniqid();

  $image = $fields['image'];
  $set_as_background = $fields['set_as_background'];
  $sub_title_top = $fields['sub_title_top'];
  $title = $fields['title'];
  $sub_title_bottom = $fields['sub_title_bottom'];
  $text = $fields['text'];
  $link = $fields['link'];
  $special_offer_products_category = $fields['special_offer_products_category'];

?>

<div <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

  <div class="container">
    <div class="special-offer__wrap">
  
      
      <?php if( !empty($image)): ?>
        <div class="special-offer__image <?php echo $set_as_background? 'special-offer__image-bg':'special-offer__image-img'; ?>">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <div class="special-offer__text-wrap">

            <?php if (!empty($sub_title_top)): ?>
              <div class="special-offer__sub-title-top">
                <?php echo esc_html($sub_title_top); ?>
              </div>
            <?php endif; ?>
        
            <?php if (!empty($title)): ?>
              <h2 class="special-offer__title">
                <?php echo $title; ?>
              </h2>
            <?php endif; ?>
      
            <?php if (!empty($sub_title_bottom)): ?>
              <div class="special-offer__sub-title-bottom">
                <?php echo esc_html($sub_title_bottom); ?>
              </div>
            <?php endif; ?>
    
            <?php if( $link ): $link_url = $link['url']; $link_title = $link['title']; $link_target = $link['target'] ? $link['target'] : '_self';?>
              <a class="btn-gray special-offer__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <?php echo esc_html( $link_title ); ?>
              </a>
            <?php endif; ?>
    
          </div>
        </div>
      <?php endif;?>
  
      <div class="special-offer__products-wrap">
        <?php 
          /* 
          * featured Products In Category -> $special_offer_products_category
          */
          $featured_loop = new WP_Query(
            array( 
              'post_type' => 'product',
              'posts_per_page' => 3,
              'orderby' => 'date',
              'order' => 'DESC',
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'product_cat',
                  'field'    => 'term_id',
                  'terms'    => $special_offer_products_category,
                ),
                array(
                  'taxonomy' => 'product_visibility',
                  'field'    => 'name',
                  'terms'    => 'featured',
                ),
              ),
              'meta_query' => array(
                'relation' => 'AND',
                array(
                  'key' => '_stock_status',
                  'value' => 'instock',
                  'compare' => '='
                ),
                array(
                  'key' => '_price',
                  'value' => 0,
                  'compare' => '>',
                  'type' => 'NUMERIC'
                )
              )
            )
          );
        ?>
        <?php if ( $featured_loop->have_posts() ): ?>
          <div class="special-offer__products-col">
            <h4 class="special-offer__products-title">
              <?php _e('featured products','web-des-sun') ?>
            </h4>
            <?php while ( $featured_loop->have_posts() ) : $featured_loop->the_post();
              global $product;
              $product_name = $product->get_name(); 
              $product_price = $product->get_price_html();
              $product_link = $product->get_permalink();

              $stock_status = get_post_meta( $product->get_id(), '_stock_status', true );
              $stock_quantity = get_post_meta( $product->get_id(), '_stock', true );
              
            ?>
              <div class="special-offer__product">
                <a href="<?php echo $product_link; ?>" class="special-offer__product-image">
                  <?php echo woocommerce_get_product_thumbnail(); ?>
                </a>
                <div class="special-offer__product-text-wrap">
                  <div class="special-offer__product-name">
                    <a href="<?php echo $product_link; ?>">
                      <?php echo get_the_title(); ?>
                    </a>
                  </div>
                  <div class="special-offer__product-price">
                    <?php echo $product_price? $product_price:'-'; ?>
                  </div>                 
                </div>
              </div>
            <?php endwhile;  ?>
          </div>
        <?php else: _e( 'No products found' ); ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

        
        <?php
          /* 
          * New Products In Category -> $special_offer_products_category
          */
         $new_products_loop = new WP_Query(
          array( 
            'post_type' => 'product',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
              array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $special_offer_products_category,
              ),
            ),
            'meta_query' => array(
              'relation' => 'AND',
              array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '='
              ),
              array(
                'key' => '_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
              )
            )
          ));
        ?>
        <?php if ( $new_products_loop->have_posts() ): ?>
          <div class="special-offer__products-col">
            <h4 class="special-offer__products-title">
              <?php _e('new products','web-des-sun') ?>
            </h4>
            <?php while ( $new_products_loop->have_posts() ) : $new_products_loop->the_post();
              global $product;
              $product_name = $product->get_name(); 
              $product_price = $product->get_price_html();
              $product_link = $product->get_permalink();
            ?>
      
              <div class="special-offer__product">
                <div class="special-offer__product-image">
                  <?php echo woocommerce_get_product_thumbnail(); ?>
                </div>
                <div class="special-offer__product-text-wrap">
                  <div class="special-offer__product-name">
                    <a href="<?php echo $product_link; ?>">
                      <?php echo get_the_title(); ?>
                    </a>
                  </div>
                  <div class="special-offer__product-price">
                    <?php echo $product_price; ?>
                  </div>                 
                </div>
              </div>
            <?php endwhile;  ?>
          </div>
        <?php else: _e( 'No products found' ); ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
                
        </div>
      </div>
  
    </div>
  </div>

  <style><?php echo $blockStyle; ?></style>
</div>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php bloginfo('name'); if (!is_front_page() ){ echo ' |'; } ?>
    <?php is_front_page() ? '' : wp_title(''); ?></title>
    <?php wp_head(); ?>
    <?php if( is_single() ) { echo '<meta property="og:image" content="'. get_the_post_thumbnail_url(get_the_ID(),'full')   .'" />'; } ?>
  </head>
  <body <?php body_class(); ?>>

    <header class="header">

      <div class="container">
        <div class="header__wrap">

          <a href="<?= site_url(); ?>">
            <?php 
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
              if ( has_custom_logo() ) {
                echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
              }
            ?>
          </a>
          
        </div>
      </div>
		</header>

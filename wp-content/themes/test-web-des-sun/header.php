<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <?php wp_head(); ?>
    <?php if( is_single() ) { echo '<meta property="og:image" content="'. get_the_post_thumbnail_url(get_the_ID(),'full')   .'" />'; } ?>
  </head>
  <body <?php body_class(); ?>>

    <header class="header" id="header">

      <div class="container">
        <div class="header__wrap">
          <div class="header__logo">
            <a href="<?= site_url(); ?>">
              <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) {
                  echo '<img width="110" height="40" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                }
              ?>
            </a>
          </div>

          <div class="header__block" id="collapse_menu">
            <?php wp_nav_menu( array( 
                  'theme_location' => 'header_menu',
                  'container'      => 'nav',
                  'items_wrap'     => '<ul class="header-menu__wrap">%3$s</ul>',
                  'walker'         => new My_ACF_Walker_Header_Menu,
              )); 
            ?>
            <div id="header_search_form" class="header__search-form">
              <div class="header__search-form-wrap">
                <?php get_search_form(); ?>
                <button class="close">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.4 14L0 12.6L5.6 7L0 1.4L1.4 0L7 5.6L12.6 0L14 1.4L8.4 7L14 12.6L12.6 14L7 8.4L1.4 14Z" fill="currentColor"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <button id="search_togler" class="search-togler">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.089 0C8.96878 0.000795208 10.7713 0.747957 12.1004 2.07726C13.4296 3.40656 14.1765 5.20922 14.177 7.089C14.1762 8.96861 13.4292 10.771 12.1001 12.1001C10.771 13.4292 8.96861 14.1762 7.089 14.177C5.20939 14.1765 3.40689 13.4297 2.07761 12.1008C0.748339 10.7719 0.00106021 8.96961 0 7.09C0.000265068 5.20987 0.747193 3.40681 2.07655 2.07726C3.40591 0.747712 5.20887 0.000530268 7.089 0ZM7.089 12.602C7.81301 12.6021 8.52996 12.4596 9.19889 12.1826C9.86782 11.9056 10.4756 11.4995 10.9876 10.9876C11.4995 10.4756 11.9056 9.86782 12.1826 9.19889C12.4596 8.52996 12.6021 7.81301 12.602 7.089C12.6023 6.3649 12.4599 5.64785 12.1829 4.9788C11.906 4.30976 11.4999 3.70184 10.9879 3.18978C10.476 2.67772 9.86811 2.27155 9.19912 1.99448C8.53013 1.71741 7.8131 1.57487 7.089 1.575C6.36478 1.57461 5.64758 1.71696 4.97842 1.99393C4.30925 2.27089 3.70123 2.67703 3.18913 3.18913C2.67703 3.70123 2.27089 4.30925 1.99393 4.97842C1.71696 5.64758 1.57461 6.36478 1.575 7.089C1.57487 7.8131 1.71741 8.53013 1.99448 9.19912C2.27155 9.86811 2.67772 10.476 3.18978 10.9879C3.70184 11.4999 4.30976 11.906 4.9788 12.1829C5.64785 12.4599 6.3649 12.6023 7.089 12.602ZM13.772 12.658L16 14.885L14.886 16L12.658 13.772L13.772 12.658Z" fill="currentColor"/>
            </svg>
          </button>

          <?= do_shortcode('[custom-woo-minicart] ') ?>

          <div id="menu_btn" class="menu-btn">
            <div class="burger-lines"></div>
            <span><?php _e('MENU','web-des-sun'); ?></span>
          </div>
          <!-- must be last (!) -->
          <div id="collapse_menu_bg" class="collapse-menu-bg"></div>
        </div>
      </div>
		</header>
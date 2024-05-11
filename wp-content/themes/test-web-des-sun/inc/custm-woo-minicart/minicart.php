<?php

  /**
   *  Main Class
   */
  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    require get_template_directory() . '/inc/custm-woo-minicart/woo-minicart-custm.php';
    new CustomMiniCart_Class();
  }
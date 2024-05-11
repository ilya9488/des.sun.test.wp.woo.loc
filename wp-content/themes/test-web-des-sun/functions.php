<?php

add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );

        // Add support for title tag
        add_theme_support( 'title-tag' );

        // Add support for post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );
    }
);

get_template_part('inc/custom_fields');
get_template_part('inc/remove_emoji');
get_template_part('inc/enqueue_scripts');
get_template_part('inc/site_settings');
// get_template_part('inc/custm-woo-minicart/minicart');
// custоm woocomerce minicart
require get_template_directory() . '/inc/custm-woo-minicart/minicart.php';

add_action('after_setup_theme', function(){
    register_nav_menus( array(
        'header_menu' => 'Header menu',
        'footer_menu1' => 'Footer menu 1',
        'footer_menu2' => 'Footer menu 2',
    ) );
    register_sidebar( array(
        'name'          => 'Footer col 1',
        'id'            => 'footer_col_1',
        'before_widget' => '<div class="footer-col-menu">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer col 2',
        'id'            => 'footer_col_2',
        'before_widget' => '<div class="footer-col-menu">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
});

// add ACF to menu items
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
  if( $args->theme_location == 'header_menu' ){
    foreach( $items as &$item ) {
      $to_the_right = get_field('to_the_right',$item);
      $header_sub_menus = have_rows('header_sub_menus', $item);
      $fields = get_fields($item);
      $non_empty_fields = array_filter($fields, function($value) {
        return !empty($value);
      });
      if($non_empty_fields && !empty($non_empty_fields)){
        $item->classes[] = $header_sub_menus?'menu-item-has-children-acf':'';
        $item->classes[] = $to_the_right?'to-the-right':'';
        ob_start();
        set_query_var( 'menu_item', $item );
          get_template_part('template-parts/parts/header-sub-menu');
        $sub_menu = ob_get_clean();
        $item->acf_content = $sub_menu;
      }
    }
  }
  return $items;
}

// extract ACF content to <li>
class My_Walker_Header_Menu extends Walker_Nav_Menu {
  // Function to start the element
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    // Standard output of the menu element
    $output .= '<li class="' . implode(' ', $item->classes) . '">';
    // Add a link if it is
    if ( $item->url && $item->url != '#' ) {
      $output .= '<a href="' . $item->url . '">';
      $output .= $item->title;
      $output .= '</a>';
    } else {
      $output .= $item->title;
    }

    // We display an additional html if it is => ACF
    if ( $item->acf_content ) {
      $output .= $item->acf_content;
    }
  }
  
  // add wrapper to standart sub-menu wp
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div class='sub-menu__wrap'><ul class='sub-menu'>\n";
  }
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul></div>\n";
  }
}
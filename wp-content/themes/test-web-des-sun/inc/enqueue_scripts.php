<?php 

// production version
// define('_S_VERSION', '1.0.0');
// development version
define('_S_VERSION', time());

function wp_my_theme_enq() {

  wp_enqueue_style( 'style_header', get_template_directory_uri() . '/src/css/header.css',array(),_S_VERSION,false);

  wp_enqueue_script( 'my-jquery-async', get_template_directory_uri() . '/src/libs/jquery-3.2.1.min.js',array(),false,true);
  wp_enqueue_script( 'my-common-async', get_template_directory_uri() . '/src/js/common.js',array(),false ,true);

  wp_localize_script( 'my-common', 'myajax',
    array(
      'url' => admin_url('admin-ajax.php')
    )
  );

}
add_action( 'wp_enqueue_scripts', 'wp_my_theme_enq', 9999 );

// Async/Defer Funtion - only on the front-end
if(!is_admin()) {
  function add_asyncdefer_attribute($tag, $handle) {
    if (strpos($handle, 'async') !== false) {
      return str_replace( '<script ', '<script async ', $tag );
    }
    else if (strpos($handle, 'defer') !== false) {
      return str_replace( '<script ', '<script defer ', $tag );
    }
    else {
      return $tag;
    }
  }
  add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}

function dev_sun_add_footer_styles() {
  wp_enqueue_style( 'style', get_template_directory_uri() . '/src/css/style.css', array(), _S_VERSION, false );
}
add_action( 'get_footer', 'dev_sun_add_footer_styles' );


add_action('acf-main-style', 'admin_style');
function admin_style() {
  wp_enqueue_style( 'acf-main-style', get_template_directory_uri() . '/src/css/admin-style.css',array(),false,false);
}

add_action('enqueue_slick', 'enqueue_slick');
function enqueue_slick() {
  wp_enqueue_style( 'slick', get_template_directory_uri() . '/src/libs/slick/slick.css',array(),false,false);
  wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/src/libs/slick/slick-theme.css',array(),false,false);
  wp_enqueue_script( 'slick', get_template_directory_uri() . '/src/libs/slick/slick.min.js',array('my-jquery'),false,true);
}
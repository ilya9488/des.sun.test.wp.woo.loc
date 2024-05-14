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
get_template_part('inc/custm-woo-minicart/minicart');

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
<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}

/*================== acf gutenberg init ======================*/
function my_acf_block_render_callback( $block ) {

  $slug = str_replace('acf/', '', $block['name']);

  if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/{$slug}.php") ) ) {
    include( get_theme_file_path("/template-parts/blocks/{$slug}/{$slug}.php") );
  }
}
function my_acf_block_style($slug){

  if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/{$slug}.css") ) ) {
    return get_stylesheet_directory_uri() . "/template-parts/blocks/{$slug}/{$slug}.css";
  }

}

// DEFAULT ( 'category' => 'layout', )
function custom_block_category( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'custom-sections',
				'title' => 'Custom Sections',
				// 'icon'  => 'wordpress',
			),
      array(
        'slug' => 'footer-blocks',
        'title' => 'Footer Blocks',
        // 'icon'  => 'wordpress',
      ),
		),
		$categories,
	);
}
add_filter( 'block_categories_all', 'custom_block_category', 10, 2);

add_action('acf/init', 'my_acf_init');
function my_acf_init() {

	// check function exists
	if( function_exists('acf_register_block') ) {

    // Custom Blocks (Home)
		acf_register_block(array(
			'name'			    	=> 'hero-section',
			'title'			    	=> __('Hero Section'),
			'description'	  	=> __('A custom Hero Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'hero-section' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('hero-section'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));

		acf_register_block(array(
			'name'			    	=> 'about-us',
			'title'			    	=> __('About Us Section'),
			'description'	  	=> __('A custom About Us Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'about-us' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('about-us'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));

		acf_register_block(array(
			'name'			    	=> 'featured-products',
			'title'			    	=> __('Featured Products Section'),
			'description'	  	=> __('A custom Featured Products Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'featured-products' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('featured-products'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));

		acf_register_block(array(
			'name'			    	=> 'single-special-offer',
			'title'			    	=> __('Single Special Offer Section'),
			'description'	  	=> __('A custom Single Special Offer Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'single-special-offer' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('single-special-offer'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style');
			}
		));
    
		acf_register_block(array(
			'name'			    	=> 'discount-section',
			'title'			    	=> __('Discount Section'),
			'description'	  	=> __('A custom Discount Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'discount-section' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('discount-section'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style');
			}
		));

    acf_register_block(array(
			'name'			    	=> 'special-offer',
			'title'			    	=> __('Special Offer Section'),
			'description'	  	=> __('A custom Special Offer Section'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'custom-sections',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'special-offer' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('special-offer'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style');
			}
		));
    
    // Footer Blocks
		acf_register_block(array(
			'name'			    	=> 'footer-logo-description-contact',
			'title'			    	=> __('Footer Logo, Description, Contact'),
			'description'	  	=> __('A custom Footer: Logo | Description | Contact'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'footer-blocks',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'footer-logo-description-contact' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('footer-logo-description-contact'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));

		acf_register_block(array(
			'name'			    	=> 'footer-recent-posts',
			'title'			    	=> __('Footer Recent Posts'),
			'description'	  	=> __('A custom Footer Recent Posts.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'footer-blocks',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'footer-recent-posts' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('footer-recent-posts'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));

		acf_register_block(array(
			'name'			    	=> 'footer-menu',
			'title'			    	=> __('Footer Menu'),
			'description'	  	=> __('A custom Footer Menu.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'		  	=> 'footer-blocks',
			'icon'				    => 'admin-page',
			'keywords'		  	=> array( 'footer-menu' ),
			'supports'        => array( 'anchor' => true ),
			'enqueue_style'   => my_acf_block_style('footer-menu'),
			'enqueue_assets'  => function () {
        if (is_admin()) do_action('acf-main-style'); 
			}
		));
    
	}
}
/*================== acf gutenberg init ======================*/

function get_style_param_acf_gut_block($style, $settings_sections){
	if (!isset($settings_sections) || empty($settings_sections) && $settings_sections !== '0') {
		return '';
	}
	return str_replace('%value%', $settings_sections, $style);
}

function get_style_acf_gut_block($settings_sections, $block_class){

	$styles = array(
		'background_color' => 'background-color: %value%;',
		'background_image' => 'background-image: url(%value%);',
		'background_image_position' => 'background-position: %value%;',
		'background_size' => 'background-size: %value%;',
		'background_repeat' => 'background-repeat: %value%;',
		'padding_top' => 'padding-top: %value%px;',
		'padding_bottom' => 'padding-bottom: %value%px;',
		'margin_top' => 'margin-top: %value%px;',
		'margin_bottom' => 'margin-bottom: %value%px;',
	);

	$section_style = '';
	foreach($styles as $key => $val) {
		$section_style .= get_style_param_acf_gut_block($val, $settings_sections[$key]);
	}

	$styles_mob = array(
		'background_color_mobile' => 'background-color: %value%;',
		'background_image_mobile' => 'background-image: url(%value%);',
		'background_image_position_mobile' => 'background-position: %value%;',
		'background_size_mobile' => 'background-size: %value%;',
		'background_repeat_mobile' => 'background-repeat: %value%;',
		'padding_top_mobile' => 'padding-top: %value%px;',
		'padding_bottom_mobile' => 'padding-bottom: %value%px;',
		'margin_top_mobile' => 'margin-top: %value%px;',
		'margin_bottom_mobile' => 'margin-bottom: %value%px;',
	);

	$section_style_mobile = '';
	foreach($styles_mob as $key => $val) {
		$section_style_mobile .= get_style_param_acf_gut_block($val, $settings_sections[$key]);
	}
	
	$style =  $block_class . ' {' . $section_style	.'}';
	if (!empty($section_style_mobile)) {
		$style .=	'@media only screen and (max-width: 992px){ '. $block_class . '{ ' . $section_style_mobile  . ' }' .' }';
	}
	return $style;
}

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
class My_ACF_Walker_Header_Menu extends Walker_Nav_Menu {
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

// Automatic list of all the menu of the site for the block: "Select Menu"
function acf_select_menu( $field ) {
  $choices = array();
  $choices[ '0' ] = 'Choose the menu';
  $menus = wp_get_nav_menus();
  foreach ( $menus as $menu ) {
    $choices[ $menu->term_id ] = $menu->name;
  }
  $field['choices'] = $choices;
  return $field;
}
add_filter( 'acf/load_field/name=select_menu', 'acf_select_menu' );



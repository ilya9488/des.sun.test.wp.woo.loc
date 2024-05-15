<?php
/**
 * Block Name: Footer Menu: Col-3
 */

  $class = 'footer-menu footer-menu-' . $block['id'];
  $className = '.footer-menu-' . $block['id'];
  if (!empty($block['className'])){
    $class .= ' ' . $block['className'];
  }
  $id_block = '';
  if( !empty($block['anchor']) ) {
    $id_block = 'id=' . $block['anchor'];
  }

  $fields = get_fields();
  $blockStyle = get_style_acf_gut_block($fields['settings_section'], $className);

  $title = $fields['title'];
  $menu_id = $fields['select_menu'];

?>

<div <?php echo esc_attr($id_block); ?> class="footer__col <?php echo $class;  ?>" >

  <div class="footer-menu__wrap">
    
    <?php if($title){ ?>
      <h4 class="footer-menu__title">
        <?= $title; ?>
      </h4>
    <?php } ?>

    <?php
      if ($menu_id) {
        $menu = wp_get_nav_menu_object($menu_id);
        if ($menu) {
          wp_nav_menu(array(
            'menu' => $menu->slug,
            'container' => 'div',
            'container_class' => 'footer-menu__links',
            'echo' => true
          ));
        } 
      }
    ?>
    
  </div>
  
  <style><?php echo $blockStyle; ?></style>
</div>
<?php
  $menu_item = get_query_var( 'menu_item' );
  $header_list_title = get_field('header_list_title', $menu_item);
?>

<?php if( have_rows('header_sub_menus', $menu_item) ): ?>
  <div class="sub-menu__wrap">
    <ul class="sub-menu">
      
      <?php while ( have_rows('header_sub_menus', $menu_item) ) : the_row(); 
        $header_sub_menu_title = get_sub_field('header_sub_menu_title');
        $text_tooltip = get_sub_field('header_sub_menu_title_tooltip')['text_tooltip'];
        $color_tooltip = get_sub_field('header_sub_menu_title_tooltip')['color_tooltip'];
        $link = get_sub_field('header_sub_menu_title_link');
      ?>
        <li class="menu-item menu-item-has-children <?= $text_tooltip?'has-tooltip':''; ?>">

          <?php if( $link ): 
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self'; ?>

            <a class="sub-menu-title" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
              <?= $header_sub_menu_title ? $header_sub_menu_title : esc_html( $link_title ); ?>
              <?php if($text_tooltip){ ?> 
                <span class="sub-menu-title-tooltip" style="background-color: <?= $color_tooltip ? $color_tooltip:''; ?>;">
                  <?= $text_tooltip ?>
                  <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0H8L4 2.5L0 5V0Z" fill="<?= $color_tooltip ? $color_tooltip:''; ?>"/>
                  </svg>
                </span>
              <?php } ?>
            </a>
          <?php else: ?>
            <div class="sub-menu-title">
              <?= $header_sub_menu_title ? $header_sub_menu_title:''; ?>
              <?php if($text_tooltip){ ?> 
                <span class="sub-menu-title-tooltip" style="background-color: <?= $color_tooltip ? $color_tooltip:''; ?>;">
                  <?= $text_tooltip ?>
                  <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0H8L4 2.5L0 5V0Z" fill="<?= $color_tooltip ? $color_tooltip:''; ?>"/>
                  </svg>
                </span>
              <?php } ?>
            </div>
          <?php endif; ?>
          
          <?php if( have_rows('sub_menu_list') ): ?>
            <div class="sub-menu__wrap">
              <ul class="sub-menu">
                <?php while ( have_rows('sub_menu_list') ) : the_row(); ?>

                  <?php  $link = get_sub_field('item_link');  
                    if( $link ): 
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                      <li class="menu-item menu">
                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                      </li>
                    <?php endif; ?>

                <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
<?php endif; ?>
<?php
/**
 * Block Name: Discount Section
 */

  $class = 'discount-section discount-section-' . $block['id'];
  $className = '.discount-section-' . $block['id'];
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
  $discount_percent = $fields['discount_percent'];
  $sub_title = $fields['sub_title'];
  $text = $fields['text'];
  $list_description = $fields['list_description'];
  $image = $fields['image'];

?>

<div <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

  <div class="container">
    <div class="discount-section__wrap">
  
      <div class="discount-section__text-wrap">
    
        <?php if (!empty($title)): ?>
          <h2 class="discount-section__title">
            <?php echo esc_html($title); ?>&nbsp;<span class="discount-section__percent"><?php echo esc_html($discount_percent.'%'); ?></span>
          </h2>
        <?php endif; ?>
  
        <?php if (!empty($sub_title)): ?>
          <span class="discount-section__sub-title">
            <?php echo esc_html($sub_title); ?>
          </span>
        <?php endif; ?>
    
        <?php if (!empty($text)): ?>
          <div class="discount-section__text">
            <p>
              <?php echo esc_html($text); ?>
            </p>
          </div>
        <?php endif; ?>

        <?php if( $list_description ): ?>
          <ul class="discount-section__list-description">
            <?php foreach( $list_description as $row ): $item = $row['item']; ?>
              <?php if (!empty($item)): ?>
                <li class="discount-section__list-item">
                  <svg class="icon" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.9173 9.37533L18.7507 4.16699H6.25065L2.08398 9.37533M22.9173 9.37533L12.5007 21.8753M22.9173 9.37533H2.08398M22.9173 9.37533L20.834 6.77116M12.5007 21.8753L2.08398 9.37533M12.5007 21.8753L8.33398 9.37533M12.5007 21.8753L16.6673 9.37533M2.08398 9.37533L4.16732 6.77116" stroke="#C3935B" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span>
                    <?php echo esc_html($item); ?>
                  </span>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
    
        <?php if( have_rows('links_button') ): ?>
          <div class="discount-section__links-btn">
            <?php while( have_rows('links_button') ): the_row(); 
              $link = get_sub_field('link'); 
              $link_style = get_sub_field('link_style'); 
            ?>
              <?php if( $link ): $link_url = $link['url']; $link_title = $link['title']; $link_target = $link['target'] ? $link['target'] : '_self';?>
                <a class="<?php echo $link_style? 'btn-'.$link_style:''; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                  <?php echo esc_html( $link_title ); ?>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>

      </div>

      <?php  if( !empty( $image ) ): ?>
        <div class="discount-section__image">
          <img width="585" height="520" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy" >
        </div>
      <?php endif; ?>
  
    </div>
  </div>

  <style><?php echo $blockStyle; ?></style>
</div>
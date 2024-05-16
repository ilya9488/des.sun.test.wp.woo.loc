<?php
/**
 * Block Name: About Us
 */

  $class = 'about-us about-us-' . $block['id'];
  $className = '.about-us-' . $block['id'];
  if (!empty($block['className'])){
    $class .= ' ' . $block['className'];
  }
  $id_block = '';
  if( !empty($block['anchor']) ) {
    $id_block = 'id=' . $block['anchor'];
  }

  $fields = get_fields();
  $blockStyle = get_style_acf_gut_block($fields['settings_section'], $className);

  $sub_title_top = $fields['sub_title_top'];
  $title = $fields['title'];
  $sub_title_bottom = $fields['sub_title_bottom'];
  $image = $fields['image'];
  $text = $fields['text'];

?>

<div style="background-image: url();" <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

  <div class="container">
    <div class="about-us__wrap">
  
      <?php  if( !empty( $image ) ): ?>
        <div class="about-us__image">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        </div>
      <?php endif; ?>
  
      <div class="about-us__text-wrap">
  
        <?php if (!empty($sub_title_top)): ?>
          <span class="about-us__sub-title-top">
            <?php echo esc_html($sub_title_top); ?>
          </span>
        <?php endif; ?>
    
        <?php if (!empty($title)): ?>
          <h2 class="about-us__title">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>
  
        <?php if (!empty($sub_title_bottom)): ?>
          <span class="about-us__sub-title-bottom">
            <?php echo esc_html($sub_title_bottom); ?>
          </span>
        <?php endif; ?>
    
        <?php if (!empty($text)): ?>
          <div class="about-us__text">
            <p>
              <?php echo esc_html($text); ?>
            </p>
          </div>
        <?php endif; ?>
    
        <?php if( have_rows('links_button') ): ?>
          <div class="about-us__links-btn">
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
  
    </div>
  </div>

  <style><?php echo $blockStyle; ?></style>
</div>
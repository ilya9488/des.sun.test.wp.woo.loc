<?php
/**
 * Block Name: Hero Section
 */

  $class = 'hero-section hero-section-' . $block['id'];
  $className = '.hero-section-' . $block['id'];
  if (!empty($block['className'])){
    $class .= ' ' . $block['className'];
  }
  $id_block = '';
  if( !empty($block['anchor']) ) {
    $id_block = 'id=' . $block['anchor'];
  }

  $fields = get_fields();
  $blockStyle = get_style_acf_gut_block($fields['settings_section'], $className);

  $sub_title = $fields['sub_title'];
  $title = $fields['title'];
  $image = $fields['image'];
  $text = $fields['text'];

?>

<div <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

  <div class="hero-section__wrap">

    <div class="hero-section__text-wrap">
      <?php if (!empty($sub_title)): ?>
        <span class="hero-section__sub-title">
          <?php echo esc_html($sub_title); ?>
        </span>
      <?php endif; ?>
  
      <?php if (!empty($title)): ?>
        <h1 class="hero-section__title">
          <?php echo esc_html($title); ?>
        </h1>
      <?php endif; ?>
  
      <?php if (!empty($text)): ?>
        <div class="hero-section__text">
          <p>
            <?php echo esc_html($text); ?>
          </p>
        </div>
      <?php endif; ?>
  
      <?php if( have_rows('links_button') ): ?>
        <div class="hero-section__links-btn">
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
      <div class="hero-section__image">
        <img width="600" height="650" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
      </div>
    <?php endif; ?>

  </div>
  
  <style><?php echo $blockStyle; ?></style>
</div>
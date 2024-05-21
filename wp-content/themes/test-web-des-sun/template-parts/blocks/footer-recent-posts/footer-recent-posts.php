<?php
/**
 * Block Name: Footer Recent Posts: Col-2
 */

  $class = 'footer-recent-posts footer-recent-posts-' . $block['id'];
  $className = '.footer-recent-posts-' . $block['id'];
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

?>

<div <?php echo esc_attr($id_block); ?> class="footer__col <?php echo $class;  ?>" >

  <div class="footer-recent-posts__wrap">

    <?php if (!empty($title)): ?>
      <h4 class="footer-recent-posts__title">
        <?php echo esc_html($title); ?>
      </h4>
    <?php endif; ?>

    <?php $query = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 2, 'orderby' => 'date', 'order' => 'DESC' ));
      if ($query->have_posts()) : 
    ?>
      <div class="footer-recent-posts__posts-list">
        <?php while ($query->have_posts()) : $query->the_post();
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail_url();
            $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            $title = get_the_title();
            $date = get_the_date('F j, Y');
            $datetime = get_the_date('Y-m-d');
        ?>
          <div class="footer-recent-posts__post">
            <?php if ($thumbnail) : ?>
              <a href="<?= $permalink ?>" class="footer-recent-posts__post-thumbnail">
                <img width="75" height="65" src="<?php echo $thumbnail; ?>" alt="<?php echo $alt; ?>" loading="lazy" >
              </a>
            <?php endif; ?>
            <div class="footer-recent-posts__post-text">
              <h5 class="footer-recent-posts__post-title">
                <a href="<?= $permalink ?>">
                  <?php echo $title; ?>
                </a>
              </h5>
              <time class="footer-recent-posts__post-date" datetime="<?php echo $datetime; ?>"><?php echo $date; ?></time>
            </div>
          </div>

        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>

  </div>
  
  <style><?php echo $blockStyle; ?></style>
</div>
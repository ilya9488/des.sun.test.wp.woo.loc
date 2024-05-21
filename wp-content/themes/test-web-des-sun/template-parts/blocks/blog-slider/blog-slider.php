<?php
/**
 * Block Name: Blog Slider
 */

  $class = 'blog-slider blog-slider-' . $block['id'];
  $className = '.blog-slider-' . $block['id'];
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
  $text = $fields['text'];
  
  $posts = $fields['posts'];
?>

<div <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

<div class="container blog-slider__wrap-content">

    <div class="blog-slider__text-wrap">

      <?php if (!empty($sub_title)): ?>
        <div class="blog-slider__sub-title">
          <?php echo esc_html($sub_title); ?>
        </div>
      <?php endif; ?>
  
      <?php if (!empty($title)): ?>
        <h3 class="blog-slider__title">
          <?php echo esc_html($title); ?>
        </h3>
      <?php endif; ?>
  
      <?php if (!empty($text)): ?>
        <div class="blog-slider__text">
          <p>
            <?php echo esc_html($text); ?>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <?php if( $posts ): ?>
      <div class="blog-slider__wrap">
        <?php foreach( $posts as $post ): 
                $permalink = get_permalink( $post->ID );
                $title = get_the_title( $post->ID );
                $image = get_the_post_thumbnail_url( $post->ID, 'full' );
                $image_alt = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
                $category = get_the_category( $post->ID )[0]->name;
                $excerpt = get_the_excerpt( $post->ID );
                $date_day = get_the_date( 'd', $post->ID );
                $date_month = strtoupper( get_the_date( 'M', $post->ID ) );
                $author_name = get_the_author_meta( 'display_name', $post->post_author );
                $author_avatar = get_avatar_url( $post->post_author, array('size' => 20) );
        ?>

          <div class="blog-slider__slide">
            <div class="blog-slider__post-img">
              <a href="<?php echo esc_url( $permalink ); ?>">
                <img width="346" height="261" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>" loading="lazy" >
                <div class="blog-slider__img-hover">
                  <span class="dot-1"></span>
                  <span class="dot-2"></span>
                  <span class="dot-3"></span>
                </div>
              </a>
              <div class="blog-slider__post-date">
                <span class="blog-slider__post-day">
                  <?php echo $date_day; ?>
                </span>
                <span class="blog-slider__post-month">
                  <?php echo $date_month; ?>
                </span>
              </div>
            </div>
            <div class="blog-slider__post-category">
              <?php echo $category; ?>
            </div>
            <h4 class="blog-slider__post-title">
              <a href="<?php echo esc_url( $permalink ); ?>">
                <?php echo esc_html( $title ); ?>
              </a>
            </h4>
            <div class="blog-slider__post-author">
              <span class="blog-slider__post-posted-by">
                <?php _e('Posted by','web-des-sun') ?>:
              </span>
              <img width="20" height="20" src="<?php echo $author_avatar; ?>" alt="<?php echo $author_name; ?>" loading="lazy" >
              <span class="blog-slider__post-name">
                <?php echo $author_name; ?>
              </span>
            </div>
            <div class="blog-slider__post-excerpt">
              <?php echo $excerpt; ?>
            </div>
            <a class="blog-slider__post-link" href="<?php echo esc_url( $permalink ); ?>">
              <?php _e('Continue reading','web-des-sun') ?>
            </a>
          </div>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>

  <style><?php echo $blockStyle; ?></style>
</div>
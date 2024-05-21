<?php
/**
 * Block Name: Single Special Offer
 */

  $class = 'single-special-offer single-special-offer-' . $block['id'];
  $className = '.single-special-offer-' . $block['id'];
  if (!empty($block['className'])){
    $class .= ' ' . $block['className'];
  }
  $id_block = '';
  if( !empty($block['anchor']) ) {
    $id_block = 'id=' . $block['anchor'];
  }

  $fields = get_fields();
  $blockStyle = get_style_acf_gut_block($fields['settings_section'], $className);
  $blockUniqid = uniqid();

  $image_or_video = $fields['image_or_video'];
  $video_poster = $fields['video_poster'];
  $sub_title_top = $fields['sub_title_top'];
  $title = $fields['title'];
  $sub_title_bottom = $fields['sub_title_bottom'];
  $text = $fields['text'];
  $link = $fields['link'];

?>

<div <?php echo esc_attr($id_block); ?> class="<?php echo $class;  ?>">

  <div class="container">
    <div class="single-special-offer__wrap">
  
      
      <?php if( !empty($image_or_video)): ?>

        <?php /* type: video */ if ($image_or_video['type'] === 'video'): ?>
          <div class="single-special-offer__video">
            <video id="<?php echo 'video-'.$blockUniqid; ?>">
              <source src="<?php echo esc_url($image_or_video['url']); ?>" type="video/<?php echo esc_attr($image_or_video['subtype']); ?>">
            </video>
            <button class="play-button" data-id="<?php echo $blockUniqid; ?>">
              <svg class="icon-play" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_d_325_34)">
                  <path d="M50 10.9375C42.2742 10.9375 34.7219 13.2285 28.2981 17.5207C21.8743 21.813 16.8675 27.9137 13.911 35.0514C10.9544 42.1892 10.1809 50.0433 11.6881 57.6207C13.1953 65.1981 16.9157 72.1584 22.3787 77.6214C27.8416 83.0843 34.8019 86.8047 42.3793 88.3119C49.9567 89.8192 57.8108 89.0456 64.9486 86.089C72.0863 83.1325 78.1871 78.1258 82.4793 71.702C86.7715 65.2782 89.0625 57.7258 89.0625 50C89.0419 39.6463 84.9197 29.7226 77.5986 22.4014C70.2774 15.0803 60.3537 10.9581 50 10.9375ZM50 85.9375C42.8923 85.9375 35.9441 83.8298 30.0342 79.8809C24.1243 75.9321 19.5181 70.3194 16.7981 63.7527C14.0781 57.186 13.3664 49.9601 14.753 42.9889C16.1397 36.0177 19.5624 29.6143 24.5884 24.5883C29.6143 19.5624 36.0178 16.1397 42.989 14.753C49.9602 13.3664 57.186 14.0781 63.7527 16.7981C70.3194 19.5181 75.9321 24.1243 79.881 30.0342C83.8298 35.9441 85.9375 42.8922 85.9375 50C85.9272 59.528 82.1376 68.6629 75.4002 75.4002C68.6629 82.1376 59.5281 85.9272 50 85.9375ZM63.3594 48.7109L44.6094 36.2109C44.3744 36.0544 44.1014 35.9645 43.8194 35.9508C43.5374 35.937 43.2569 35.9999 43.0078 36.1328C42.7582 36.2627 42.5493 36.4592 42.4045 36.7005C42.2597 36.9419 42.1846 37.2186 42.1875 37.5V62.5C42.1846 62.7814 42.2597 63.0581 42.4045 63.2995C42.5493 63.5408 42.7582 63.7373 43.0078 63.8672C43.2378 63.9862 43.4913 64.0529 43.75 64.0625C44.0587 64.0682 44.3607 63.9721 44.6094 63.7891L63.3594 51.2891C63.5773 51.1518 63.7568 50.9616 63.8812 50.7362C64.0057 50.5108 64.0709 50.2575 64.0709 50C64.0709 49.7425 64.0057 49.4892 63.8812 49.2638C63.7568 49.0384 63.5773 48.8482 63.3594 48.7109ZM45.3125 59.5703V40.4297L59.6875 50L45.3125 59.5703Z" fill="white" />
                </g>
                <defs>
                  <filter id="filter0_d_325_34" x="0.9375" y="0.9375" width="98.125" height="98.125" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset />
                    <feGaussianBlur stdDeviation="5" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_325_34" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_325_34" result="shape" />
                  </filter>
                </defs>
              </svg>
              <svg class="icon-pause" width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.5 25V53" stroke="white" stroke-width="3" stroke-linecap="round"/>
                <path d="M49.5 25V53" stroke="white" stroke-width="3" stroke-linecap="round"/>
                <circle cx="39" cy="39" r="37.5" stroke="white" stroke-width="3"/>
              </svg>
            </button>
            <?php /* video poster */ if($video_poster): ?>
              <div class="single-special-offer__video-poster">
                <img width="581" height="327" src="<?php echo esc_url($video_poster['url']); ?>" alt="<?php echo esc_attr($video_poster['alt']); ?>" loading="lazy" >
              </div>
            <?php endif; // video poster ?>
          </div>
        <?php endif; // type: video ?>

        <?php /* type: imag */ if($image_or_video['type'] === 'image' ): ?>
          <div class="single-special-offer__image">
            <img width="581" height="327" src="<?php echo esc_url($image_or_video['url']); ?>" alt="<?php echo esc_attr($image_or_video['alt']); ?>" loading="lazy" >
          </div>
        <?php endif; // type: image ?>

      <?php endif; ?>
  
      <div class="single-special-offer__text-wrap">
  
        <?php if (!empty($sub_title_top)): ?>
          <div class="single-special-offer__sub-title-top">
            <?php echo esc_html($sub_title_top); ?>
          </div>
        <?php endif; ?>
    
        <?php if (!empty($title)): ?>
          <h2 class="single-special-offer__title">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>
  
        <?php if (!empty($sub_title_bottom)): ?>
          <div class="single-special-offer__sub-title-bottom">
            <?php echo esc_html($sub_title_bottom); ?>
          </div>
        <?php endif; ?>

        <?php if( $link ): $link_url = $link['url']; $link_title = $link['title']; $link_target = $link['target'] ? $link['target'] : '_self';?>
          <a class="btn-gray single-special-offer__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
            <?php echo esc_html( $link_title ); ?>
          </a>
        <?php endif; ?>

      </div>
  
    </div>
  </div>

  <style><?php echo $blockStyle; ?></style>
</div>
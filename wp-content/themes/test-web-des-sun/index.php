<?php get_header();

$queried_object = get_queried_object();
$fields = get_fields($queried_object->ID);
?>
<main class="clearfix post">
        
  <?php if (have_posts()) : while (have_posts()) : the_post();
      the_content();
      // get_template_part('template-parts/parts/part-post');
      endwhile;
  ?>
  <?php else : ?>
    <p><?php __('No posts found', 'theme_domine_example');?></p>
  <?php endif; ?>

</main>
<?php get_footer(); ?>
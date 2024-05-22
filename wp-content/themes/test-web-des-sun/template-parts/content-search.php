<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package your-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			// Display the posted date and author
			echo '<span class="posted-on">' . get_the_date() . '</span>';
			echo '<span class="byline"> by ' . get_the_author() . '</span>';
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php 
	// Display the post thumbnail wrapped in a link, size 'medium'
	if ( has_post_thumbnail() ) {
		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		the_post_thumbnail( 'medium' );
		echo '</a>';
	}
	?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
		// Display categories and tags
		echo '<span class="cat-links">' . get_the_category_list(', ') . '</span>';
		echo '<span class="tags-links">' . get_the_tag_list('', ', ') . '</span>';
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

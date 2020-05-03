<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'container mb-5' ); ?>>
	<header class="entry-header mb-5">
		
		<h1 class="entry-title"><?php esc_html_e( get_the_title() ); ?></h1>
		
		<?php get_template_part( 'template-parts/post/part', 'post-meta' ); ?>

	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'dshedd-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content mb-5">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php comments_template(); ?>

</article><!-- #post-## -->

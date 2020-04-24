<?php
/**
 * Template part for displaying posts with excerpts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5 pb-5 border-bottom border-light container'); ?>>

	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( get_the_title() ); ?></a>
		</h2>
		
		<div class="entry-meta">
			<?php esc_html_e( get_the_date() ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->

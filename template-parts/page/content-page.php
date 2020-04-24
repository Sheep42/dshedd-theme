<?php
/**
 * Template part for displaying page content in page.php
 */

$content_blocks = get_field( 'content_blocks' );
set_query_var( 'content_blocks', $content_blocks );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	
	<header class="entry-header mb-5">
		<h1 class="entry-title">
			<?php esc_html_e( get_the_title() ); ?>
		</h1>
	</header><!-- .entry-header -->

	<div class="entry-content mb-5">
		<?php get_template_part( 'template-parts/content', 'blocks' ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

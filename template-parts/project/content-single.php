<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card bg-dark mb-5' ); ?>>
	<header class="entry-header card-header mb-5">
		
		<h1 class="entry-title"><?php esc_html_e( get_the_title() ); ?></h1>
		
		<?php get_template_part( 'template-parts/project/part', 'post-meta' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content card-body mb-5">
		<?php if ( '' !== get_the_post_thumbnail() ) : ?>
			<div class="post-thumbnail text-center mb-4">
				<?php 
					the_post_thumbnail( 'dshedd-featured-image', array( 
						'class' => 'img-fluid',
						'alt' => esc_attr( get_the_title() ) 
					)); 
				?>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>

		<?php
			$content_blocks = get_field( 'content_blocks' );
			set_query_var( 'content_blocks', $content_blocks ); 
			get_template_part( 'template-parts/content', 'blocks' ); 
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

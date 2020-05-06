<?php
/**
 * Displays content for front page
 */

$content_blocks = get_field( 'content_blocks' );
set_query_var( 'content_blocks', $content_blocks );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?> >

	<section class="entry-summary text-center text-lg-left mb-5">

		<?php 
			$photo = get_field( 'photo' );
			$summary = wp_kses_post( get_field( 'summary_text' ) );
		?>

		<?php 
		
			echo wp_get_attachment_image( 
				$photo['ID'], 
				'dshedd-thumbnail-headshot', 
				false, 
				array( 
					'class' => 'headshot' 
				) 
			);

		?>

		<div class="summary-text">
			<div class="mb-4">
				<?php echo apply_filters( 'the_content', $summary ); ?>
			</div>

			<?php get_template_part( 'template-parts/navigation/navigation', 'social' ); ?>
		</div>

	</section><!-- .container -->

	<section class="entry-content mb-5">

		<?php get_template_part( 'template-parts/content', 'blocks' ); ?>
			
	</section><!-- .entry-content -->

</article><!-- #post-## -->

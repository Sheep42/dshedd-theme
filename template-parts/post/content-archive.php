<?php
/**
 * Template part for displaying posts with excerpts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5 pb-5 border-bottom w-100 row'); ?>>

	<?php if( has_post_thumbnail() ): ?>
		<div class="col-5">
			<a href="<?php the_permalink(); ?>" class="btn-img btn-img-gradient mb-4" title="Read <?php esc_attr_e( get_the_title() ) ?>">
				<?php
					the_post_thumbnail( 'dshedd-featured-image', array( 
						'class' => 'img-fluid',
						'alt' => esc_attr( get_the_title() ) 
					));
				?>
			</a>
		</div>
	<?php endif; ?>

	<?php if( has_post_thumbnail() ): ?>
	<div class="col-7">
	<?php endif; ?>

		<header class="entry-header mb-3">
			
			<h2 class="entry-title mb-0">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( get_the_title() ); ?></a>
			</h2>
			
			<?php get_template_part( 'template-parts/post/part', 'post-meta' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content">

				<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

	<?php if( has_post_thumbnail() ): ?>
	</div><!-- .col-7 -->
	<?php endif; ?>
	
</article><!-- #post-## -->

<?php
/**
 * Template part for displaying posts with excerpts
 */

?>

<article id="project-<?php the_ID(); ?>" <?php post_class('col-lg-4 mb-4 mb-lg-0'); ?>>

	<div class="project-card card bg-dark">
		<?php 
			if( has_post_thumbnail() ) {
				$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id() ); 
			}
		?>

		<header class="card-header">

			<h2 class="entry-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="View Details for <?php esc_attr_e( get_the_title() ) ?>"><?php esc_html_e( get_the_title() ); ?></a>
			</h2>
			
			<?php get_template_part( 'template-parts/project/part', 'post-meta' ); ?>

		</header><!-- .entry-header -->

		<div class="card-body">
			<a href="<?php the_permalink(); ?>" class="btn-img btn-img-gradient mb-4" title="View Details for <?php esc_attr_e( get_the_title() ) ?>">
				<?php
					the_post_thumbnail( 'dshedd-featured-image', array( 
						'class' => 'img-fluid',
						'alt' => esc_attr( get_the_title() ) 
					));
				?>
			</a>

			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="card-footer text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary" title="View Details for <?php esc_attr_e( get_the_title() ) ?>">Project Details</a>
		</div>
	</div>

</article><!-- #post-## -->

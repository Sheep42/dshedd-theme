<?php
/**
 * Template part for displaying posts with excerpts
 */

?>

<article id="project-<?php the_ID(); ?>" <?php post_class('col-lg-4 mb-4 mb-lg-0'); ?>>

	<div class="project-card card bg-dark">
		<header class="card-header">
			
			<h2 class="entry-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( get_the_title() ); ?></a>
			</h2>
			
			<?php get_template_part( 'template-parts/project/part', 'post-meta' ); ?>

		</header><!-- .entry-header -->

		<div class="card-body">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="card-footer text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Project Details</a>
		</div>
	</div>

</article><!-- #post-## -->

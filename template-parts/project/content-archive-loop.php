<main id="main" class="site-main w-100" role="main">

<?php if ( have_posts() ) : ?>

	<section class="posts">
		<?php
		/* Start the Loop */

		$counter = 1;
		$total_posts = $wp_query->found_posts;

		while ( have_posts() ) : the_post();
			?>

			<?php if( $counter % 4 == 0 || $counter == 1 ): ?>
				<div class="row mb-0 mb-md-4">
			<?php endif; ?>

				<?php get_template_part( 'template-parts/' . get_post_type() . '/content', 'archive' ); ?>
			
			<?php if( ($counter % 3 == 0 && $counter !== 0) || $counter == $total_posts ): ?>
				</div>
			<?php endif; ?>

			<?php
			$counter++;
		endwhile;
		?>
	</section>

	<?php
	dshedd_bootstrap_pagination( array(
		'prev_text' => '&lsaquo; <span class="screen-reader-text">' . __( 'Previous page', 'dshedd' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'dshedd' ) . '</span> &rsaquo;',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dshedd' ) . ' </span>',
	) );

else :

	get_template_part( 'template-parts/' . get_post_type() . '/content', 'none' );

endif; ?>

</main><!-- #main -->
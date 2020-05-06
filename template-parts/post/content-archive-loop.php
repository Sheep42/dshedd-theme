<main id="main" class="site-main col-lg-9 order-lg-2" role="main">

<?php if ( have_posts() ) : ?>

	<section class="posts container">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/' . get_post_type() . '/content', 'archive' );

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

<?php get_sidebar(); ?>
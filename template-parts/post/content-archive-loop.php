<main id="main" class="site-main col-lg-9 order-2" role="main">

<?php if ( have_posts() ) : ?>

	<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/' . get_post_type() . '/content', 'archive' );

	endwhile;

	// the_posts_pagination( array(
	// 	'prev_text' => dshedd_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'dshedd' ) . '</span>',
	// 	'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'dshedd' ) . '</span>' . dshedd_get_svg( array( 'icon' => 'arrow-right' ) ),
	// 	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dshedd' ) . ' </span>',
	// ) );

else :

	get_template_part( 'template-parts/' . get_post_type() . '/content', 'none' );

endif; ?>

</main><!-- #main -->

<?php get_sidebar(); ?>
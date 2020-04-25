<?php

	get_header(); 

	$the_term = get_queried_object();
?>

<div class="wrap container">

	<?php if ( have_posts() ) : ?>
		<header class="page-header mb-5">
			<h1 class="page-title"><?php esc_html_e( $the_term->name ); ?></h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area row">

		<?php get_template_part( 'template-parts/post/content', 'archive-loop' ); ?>

	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer();

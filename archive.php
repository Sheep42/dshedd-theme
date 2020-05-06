<?php

	get_header(); 

	$queried_object = get_queried_object();

	if( is_category() ) {
		$page_title = 'Blog Category: ' . $queried_object->name;
	} elseif( is_post_type_archive() ) {
		$labels = get_post_type_labels( $queried_object );
		$page_title = $labels->name;
	} elseif( is_tax( 'project-category' ) ) {
		$page_title = 'Project Type: ' . $queried_object->name;
	}
?>

<div class="wrap container">

	<?php if ( have_posts() ) : ?>
		<header class="page-header mb-5">
			<h1 class="page-title"><?php esc_html_e( $page_title ); ?></h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area row">

		<?php get_template_part( 'template-parts/' . get_post_type() . '/content', 'archive-loop' ); ?>

	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer();

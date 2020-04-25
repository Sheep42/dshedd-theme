<?php

get_header(); ?>

<div class="wrap container">

	<?php if ( have_posts() ) : ?>
		<header class="page-header mb-5">
			<h1 class="page-title">
				<?php esc_html_e(  get_the_title( get_option( 'page_for_posts', true ) ) ); ?>
			</h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area row">

		<?php get_template_part( 'template-parts/post/content', 'archive-loop' ); ?>

	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer();

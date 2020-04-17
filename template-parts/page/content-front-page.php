<?php
/**
 * Displays content for front page
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<div class="panel-content">
		<div class="container">

			<header class="entry-header">
				<h1><?php esc_html_e( get_the_title() ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		</div><!-- .container -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->

<?php
/**
 * Displays top navigation
 */

?>
<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-dark" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'dshedd' ); ?>">

	<?php $header_text = get_field( 'header_text', 'options' ); ?>
	<?php if( !empty( $header_text ) ): ?>
		<div class="navbar-brand header-text mb-3">
			<span class="terminal-text"><?php esc_html_e( $header_text ); ?></span>
		</div>
	<?php endif; ?>

	<button class="menu-toggle navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#top-navigation-menu-container" aria-controls="top-navigation-menu-container" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		<span class="screen-reader-text"><?php _e( 'Menu', 'dshedd' ); ?></span>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'container_id' => 'top-navigation-menu-container',
		'container_class' => 'menu-main-navigation-container collapse navbar-collapse',
		'menu_id'        => 'top-navigation-menu',
		'menu_class' 	=> 'menu navbar-nav ml-auto',
	) ); ?>

	<?php if ( ( dshedd_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'dshedd' ); ?></span></a>
	<?php endif; ?>
	
</nav><!-- #site-navigation -->

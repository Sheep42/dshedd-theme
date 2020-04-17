<?php
/**
 * Displays top navigation
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'dshedd' ); ?>">

	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php _e( 'Menu', 'dshedd' ); ?>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

	<?php if ( ( dshedd_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'dshedd' ); ?></span></a>
	<?php endif; ?>
	
</nav><!-- #site-navigation -->

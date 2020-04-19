<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php  
	
	$body_style = '';
	$background_image = get_field( 'background_image', 'options' );

	if( !empty( $background_image ) ) {

		$body_style = sprintf( "style=\"background-image: url( '%s' );\"", esc_attr( $background_image['url'] ) );

	}

?>
<body <?php body_class('bg-dark text-white container-fluid'); ?> <?php echo $body_style; ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'dshedd' ); ?></a>

	<header id="masthead" class="site-header container" role="banner">

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<div class="site-content-contain">
		<div id="content" class="site-content">

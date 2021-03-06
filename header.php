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
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">

	<?php wp_head(); ?>
</head>

<?php  
	
	$body_style = '';
	$background_image = get_field( 'background_image', 'options' );

	if( !empty( $background_image ) ) {

		$body_style = sprintf( "style=\"background-image: url( '%s' );\"", esc_attr( $background_image['url'] ) );

	}

?>
<body <?php body_class('bg-dark text-white d-flex flex-column'); ?> <?php echo $body_style; ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'dshedd' ); ?></a>

	<header id="masthead" class="page-header site-header mb-5 px-5" role="banner">

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<div class="site-content-contain">
		<div id="content" class="site-content">

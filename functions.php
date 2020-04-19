<?php

function dshedd_init() {

	// remove editor from pages
	remove_post_type_support('page', 'editor');
	
	if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
			'page_title' 	=> 'Global Options',
			'menu_title'	=> 'Global Options',
			'menu_slug' 	=> 'global-content',
			'capability'	=> 'edit_posts',
			'icon_url' => 'dashicons-admin-generic', 
			'position' => 2,
			'redirect'		=> false
		));	
		
	}

}
add_action( 'init', 'dshedd_init' );

function dshedd_admin_init() {

}
add_action( 'admin_init', 'dshedd_admin_init' );

function dshedd_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'dshedd' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes
	add_image_size( 'dshedd-featured-image', 2000, 1200, true );
	add_image_size( 'dshedd-thumbnail-avatar', 100, 100, true );

	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'dshedd' ),
		'social'    => __( 'Social Menu', 'dshedd' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	dshedd_front_page_template( 'front-page.php' );

	dshedd_register_post_type( 'Project', 'Projects', 'project', 5, 'projects' );

}
add_action( 'after_setup_theme', 'dshedd_setup' );

/**
 *  Abstraction for SIMPLE post type registration, to override arguments
 *  or change post capability type you should use register_post_type directly.
 *
 *  Remember to flush permalinks after registering a new post type
 *
 * @param 	string 	$singular 			The singular display name for the post type
 * @param 	string 	$plural 			The plural display name for the post type
 * @param   string 	$slug 	 			The post type slug
 * @param   int 	$menu_position 	 	The menu position for the post type - defaults to 5
 * @param   string 	$rewrite 	 		Override the archive slug for this post type - defaults to $slug
 * @param   bool 	$archive 	 		True / False - Create an archive for this post type
 * @param   bool 	$hierarchical 		True / False - Is this post type hierarchical? (Does it have parent / child relationships)
 * @param 	array 	$supports 			The supports array for this post type - See codex for details
 */
function dshedd_register_post_type( 
	$singular, 
	$plural, 
	$slug, 
	$menu_position = 5, 
	$rewrite = '', 
	$archive = true, 
	$hierarchical = true, 
	$supports = array( 'title', 'editor', 'thumbnail' ) 
) {

	// Bail if missing any of the 3 absolute requirements
	if( empty( $singular ) || empty( $plural ) || empty( $slug ) ) {
		return;
	}

	$rewrite = empty( $rewrite ) ? $slug : $rewrite;

	$labels = array(
        'name'                  => _x( $plural, '', 'dshedd' ),
        'singular_name'         => _x( $singular, '', 'dshedd' ),
        'menu_name'             => _x( $plural, '', 'dshedd' ),
        'name_admin_bar'        => _x( $singular, '', 'dshedd' ),
        'add_new'               => __( 'Add New', 'dshedd' ),
        'add_new_item'          => __( 'Add New ' . $singular, 'dshedd' ),
        'new_item'              => __( 'New ' . $singular, 'dshedd' ),
        'edit_item'             => __( 'Edit ' . $singular, 'dshedd' ),
        'view_item'             => __( 'View ' . $singular, 'dshedd' ),
        'all_items'             => __( 'All '. $plural, 'dshedd' ),
        'search_items'          => __( 'Search ' . $plural, 'dshedd' ),
        'parent_item_colon'     => __( 'Parent ' . $plural . ':', 'dshedd' ),
        'not_found'             => __( 'No ' . $plural .' found.', 'dshedd' ),
        'not_found_in_trash'    => __( 'No ' . $plural . ' found in Trash.', 'dshedd' ),
        'featured_image'        => _x( $singular . ' Featured Image', '', 'dshedd' ),
        'set_featured_image'    => _x( 'Set featured image', '', 'dshedd' ),
        'remove_featured_image' => _x( 'Remove featured image', '', 'dshedd' ),
        'use_featured_image'    => _x( 'Use as featured image', '', 'dshedd' ),
        'archives'              => _x( $singular . ' archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'dshedd' ),
        'insert_into_item'      => _x( 'Insert into ' . $singular, '', 'dshedd' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this ' . $singular, '', 'dshedd' ),
        'filter_items_list'     => _x( 'Filter ' . $plural . ' list', '', 'dshedd' ),
        'items_list_navigation' => _x( $plural . ' list navigation', '', 'dshedd' ),
        'items_list'            => _x( $plural . ' list', '', 'dshedd' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => ( $rewrite ) ),
        'capability_type'    => 'post',
        'has_archive'        => $archive,
        'hierarchical'       => $hierarchical,
        'menu_position'      => $menu_position,
        'supports'           => $supports,
    );
 
    register_post_type( $slug, $args );
}

/**
 * 	Register google fonts.
 */
function dshedd_google_fonts_url() {
	$fonts_url = '';
	$font_families = array(
		'Roboto Mono: 400',
		'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
	);

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * 	Add DNS prefetching for external resources
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function dshedd_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( 'dshedd-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;

}
add_filter( 'wp_resource_hints', 'dshedd_resource_hints', 10, 2 );

/**
 * Register widget area.
 */
function dshedd_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'dshedd' ),
		'id'            => 'footer-widgets',
		'description'   => __( 'Add widgets here to appear in your footer', 'dshedd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dshedd_widgets_init' );

// Appends the nav-link class to nav menu li tags
// for bootstrap
function dshedd_add_nav_item_class( $classes, $item, $args ) {
 
    $classes[] = "nav-item";
 
    return $classes;

}
add_filter( 'nav_menu_css_class' , 'dshedd_add_nav_item_class' , 10, 4 );

// Appends the nav-link class to nav menu a tags
// for bootstrap
function dshedd_add_menu_link_class( $atts, $item, $args ) {

    $atts['class'] = ( empty( $atts['class'] ) ) ? 'nav-link' : $atts['class'] . 'nav-link';

    return $atts;

}
add_filter( 'nav_menu_link_attributes', 'dshedd_add_menu_link_class', 1, 3 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function dshedd_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dshedd' ), get_the_title( get_the_ID() ) )
	);

	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'dshedd_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function dshedd_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dshedd_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function dshedd_enqueue_scripts() {

	// Add google fonts, used in the main stylesheet.
	wp_enqueue_style( 'dshedd-fonts', dshedd_google_fonts_url(), array(), null );

	// Theme base stylesheet.
	wp_enqueue_style( 'dshedd-style', get_stylesheet_uri(), array(), _dshedd_get_cache_version( 'style.css' ) );

	// enqueue main.min.js
	wp_enqueue_script( 'dshedd-main-scripts', get_theme_file_uri( '/assets/js/build/theme/main.min.js' ), array( 'jquery' ), _dshedd_get_cache_version( 'main.min.js' ), true );

	/**
	 *  Move scripts to the footer
	 */
	foreach( wp_scripts()->registered as $script ) {
		// don't defer jquery
		$dont_defer = array( 'jquery' );

		if( in_array( $script->handle, $dont_defer ) ) {
			wp_script_add_data( $script->handle, 'group', 0 );
		} else {
			wp_script_add_data( $script->handle, 'group', 1 );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'dshedd_enqueue_scripts' );

/**
 * Enqueue Admin scripts and styles
 */
function dshedd_admin_enqueue_scripts() {
	
	// enqueue admin.min.js
	wp_enqueue_script( 'dshedd-admin-scripts', get_theme_file_uri( '/assets/js/build/admin/admin.min.js' ), array( 'jquery' ), null );

}
add_action( 'admin_enqueue_scripts', 'dshedd_admin_enqueue_scripts' );

/**
 * Get the cache version for a given file 
 * from the asset manifest file
 * 
 * @param  string $filename  The file
 *
 * @return The caching version of the file
 */
function _dshedd_get_cache_version( $filename ) {

	$found = false;
	$cache_version = null;

	if ( defined('WP_DEBUG') && WP_DEBUG && !defined( 'ALWAYS_CACHE' ) ) {
		// always bust cache when WP_DEBUG is turned on 
		$cache_version = wp_cache_get( 'cache_version', 'dshedd', false, $found );

		if( false === $found ) {
			$cache_version = bin2hex(random_bytes(4));
			wp_cache_set( 'cache_version', $cache_version, 'dshedd' );
		}

	} else {
		$asset_manifest = wp_cache_get( 'asset_cache_manifest', 'dshedd', false, $found );

		if( false === $found ) {

			$asset_manifest = file_get_contents( get_template_directory() . '/asset_cache_manifest.json' );

			if ( false === $asset_manifest ) {
				error_log('warning: cache version is missing. run gulp to regenerate it.');

				// null will make sure WP 
				// appends no cache version
				$cache_version = null;
			}

			// cache the asset manifest for this page load
			wp_cache_set( 'asset_cache_manifest', $asset_manifest, 'dshedd' );

		}

		$asset_manifest_json = json_decode( $asset_manifest );

		if( !empty( $asset_manifest_json->$filename ) )
			$cache_version = $asset_manifest_json->$filename;
	}

	return $cache_version;
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dshedd_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'dshedd_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function dshedd_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'dshedd_widget_tag_cloud_args' );

/**
 * Checks to see if we're on the homepage or not.
 */
function dshedd_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

function dshedd_doing_ajax() {
	return function_exists('wp_doing_ajax') ? wp_doing_ajax() : (defined('DOING_AJAX') && DOING_AJAX);
}

function dshedd_doing_cron() {
	return function_exists('wp_doing_cron') ? wp_doing_cron() : (defined('DOING_CRON') && DOING_CRON);
}

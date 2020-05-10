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
	add_image_size( 'dshedd-featured-image', 1128, 1200, true );
	add_image_size( 'dshedd-thumbnail-avatar', 100, 100, true );
	add_image_size( 'dshedd-thumbnail-headshot', 250, 250, true );

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

	dshedd_register_post_type( 'Project', 'Projects', 'project', 'projects', array( 'supports' => array( 'title', 'thumbnail', 'excerpt' ) ) );
	dshedd_register_project_categories();

	function dshedd_sender_email( $email_address ) {

		$custom_site_email = get_field( 'custom_site_email', 'options' );

		if( !empty( $custom_site_email ) && false !== is_email( $custom_site_email ) ) {
			$email_address = $custom_site_email;
		}

	    return $email_address;
	}
	 
	function dshedd_sender_name( $sender ) {

		$custom_site_sender = get_field( 'custom_site_sender', 'options' );

		if( !empty( $custom_site_sender ) ) {
			$sender = $custom_site_sender;
		}

	    return $sender;

	}

	add_filter( 'wp_mail_from', 'dshedd_sender_email' );
	add_filter( 'wp_mail_from_name', 'dshedd_sender_name' );

}
add_action( 'after_setup_theme', 'dshedd_setup' );

function dshedd_register_project_categories() {

	register_taxonomy( 'project-category', 'project', array(

		'labels'             => array(
				'name'              => 'Project Categories',
				'singular_name'     => 'Project Category',
				'search_items'      => 'Search Project Categories',
				'all_items'         => 'All Project Categories',
				'parent_item'       => 'Parent Project Category',
				'parent_item_colon' => 'Parent Project Category:',
				'edit_item'         => 'Edit Project Category',
				'update_item'       => 'Update Project Category',
				'add_new_item'      => 'Add New Project Category',
				'new_item_name'     => 'New Project Category Name',
				'menu_name'         => 'Project Categories',
			),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_admin_column'  => true

	));

}

/**
 *  Abstraction for SIMPLE post type registration, to override arguments
 *  or change post capability type you should use register_post_type directly.
 *
 *  Remember to flush permalinks after registering a new post type
 *
 * @param 	string 	$singular 			The singular display name for the post type
 * @param 	string 	$plural 			The plural display name for the post type
 * @param   string 	$slug 	 			The post type slug
 * @param   string 	$rewrite 	 		Override the archive slug for this post type - defaults to $slug
 * @param   bool 	$args 	 			Additonal register_post_type args
 */
function dshedd_register_post_type( 
	$singular, 
	$plural, 
	$slug,
	$rewrite = '',
	$args = array() 
) {

	// Bail if missing any of the 3 absolute requirements
	if( empty( $singular ) || empty( $plural ) || empty( $slug ) ) {
		return;
	}

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
 
    $args = array_merge( array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
		'hierarchical' 		 => true, 
        'menu_position'      => 5,
        'supports' => array( 'title', 'editor', 'thumbnail' )
    ), $args );

    if( !empty( $rewrite ) )
    	$args['rewrite'] = array( 'slug' => ( $rewrite ) );
 
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

		$urls[] = array(
			'href' => 'https://kit.fontawesome.com',
			'crossorigin'
		);

		$urls[] = array(
			'href' => 'https://kit-free.fontawesome.com',
			'crossorigin'
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

function dshedd_bootstrap_pagination( $args = array(), $echo = true ) {

	global $wp_query;

	if( empty( $wp_query ) )
		return;

	$args = array_merge(

		array(
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( '« Prev' ),
			'next_text'    => __( 'Next »' ),
			'add_args'     => false,
			'add_fragment' => ''
		),
		$args

	);

	$pages = paginate_links( $args );

	if ( is_array( $pages ) ) {

		$pagination = '<nav class="pagination-wrapper"><ul class="pagination">';

		foreach( $pages as $page ) {
            
            $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';

        }

		$pagination .= '</ul></nav>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}

	}

	return null;
}

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

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="p-2 more-link rounded float-right btn-primary">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More &raquo;<span class="screen-reader-text"> "%s"</span>', 'dshedd' ), get_the_title( get_the_ID() ) )
	);

	return '&hellip; ' . $link;
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

function dshedd_load_fontawesome() {

	$fontawesome_id = _dshedd_get_fontawesome_id();

	if( false !== $fontawesome_id )
		echo sprintf( '<script src="https://kit.fontawesome.com/%s.js" crossorigin="anonymous" async></script>', urlencode( trim( $fontawesome_id ) ) );

}

function _dshedd_get_fontawesome_id() {

	$fontawesome_id = wp_cache_get( 'fontawesome_id', 'dshedd', false, $found );

	if( true === $found )
		return $fontawesome_id;

	$fontawesome_id = get_field( 'fontawesome_id', 'options' );

	if( empty( $fontawesome_id ) )
		return false;

	wp_cache_set( 'fontawesome_id', $fontawesome_id, 'dshedd' );

	return $fontawesome_id;

}

function dshedd_bootstrap_comments( $comment, $args, $depth ) {
	$unapproved_id = !empty( $_GET['unapproved'] ) ? intval( $_GET['unapproved'] ) : '';
	?>
	<?php if ( $comment->comment_approved == '1' || ( !empty( $unapproved_id ) && intval( $comment->comment_ID ) === $unapproved_id ) ): ?>
		
		<li class="comment card bg-dark">

			<div class="card-header">
				<div class="float-left mr-4"><?php echo get_avatar( $comment ); ?></div>
				<h4><?php comment_author_link(); ?></h4>
				<time><a href="#comment-<?php comment_ID(); ?>" pubdate><?php comment_date(); ?> at <?php comment_time(); ?></a></time>
			</div>

			<div class="card-body">
				<?php comment_text(); ?>

				<?php if( $comment->comment_approved !== '1' ): ?>
					<div class="mb-4">
						<em>Your comment has not yet been approved by a moderator. This is a preview that only you are able to view.</em>
					</div>
				<?php endif; ?>

				<div>
				<?php 
					$comment_reply_link = get_comment_reply_link( array( 
						'depth' => 1,
						'max_depth' => 3,
					) ); 

					$comment_reply_link = str_replace( 'comment-reply-link', 'comment-reply-link btn btn-primary', $comment_reply_link );

					echo $comment_reply_link;
				?>
				</div>
			</div>

	<?php endif;
}

function dshedd_google_analytics() {

	$ga_id = _dshedd_get_ga_id();

	if( !empty( $ga_id ) ) {

		printf( "<script async src=\"//www.googletagmanager.com/gtag/js?id=%s\"></script>", urlencode( trim( $ga_id ) ) );

		printf( "<script>"
					. "window.dataLayer = window.dataLayer || [];"
					. "function gtag(){dataLayer.push(arguments);}"
					. "gtag('js', new Date());"
					. "gtag('config', '%s');"
				. "</script>", 
				esc_js( trim( $ga_id ) ) 
		);

	}

}

function _dshedd_get_ga_id() {

	$google_analytics_id = wp_cache_get( 'google_analytics_id', 'dshedd', false, $found );

	if( true === $found )
		return $google_analytics_id;

	$google_analytics_id = get_field( 'google_analytics_id', 'options' );

	if( empty( $google_analytics_id ) )
		return false;

	wp_cache_set( 'google_analytics_id', $google_analytics_id, 'dshedd' );

	return $google_analytics_id;

}
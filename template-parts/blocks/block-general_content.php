<?php 
	if( !defined('ABSPATH') ) wp_die( 'Cannot access directly' );

	$content_block = get_query_var( 'content_block', false );

	if( !empty( $content_block ) ) {

		echo apply_filters( 'the_content', $content_block['content'] );
		
	}
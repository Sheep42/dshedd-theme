<?php

class ThemeFunctionsTest extends WP_UnitTestCase {
	
	function tearDown() {
		$this->remove_added_uploads();
		parent::tearDown();
	}

	function test_theme_enabled() {
		
		$this->assertTrue( 
			'dshedd' == wp_get_theme(), 
			'Registered theme name does not equal "dshedd"' 
		);

	}

	function test_page_editor_removed() {
		$this->assertFalse( 
			post_type_supports( 'page', 'editor' ),
			'Expected page editor support to be disabled'
		);
	}

	function test_theme_support() {

		$features = [
			'title-tag',
			'post-thumbnails',
		];

		foreach( $features as $feature ) {
			$this->assertTrue( 
				current_theme_supports( $feature ),
				sprintf( 'Expected feature "%s" is not supported', $feature ) 
			);
		}

	}

	function test_custom_image_sizes() {

		$sizes = [
			'dshedd-featured-image',
			'dshedd-thumbnail-avatar',
		];

		foreach( $sizes as $size ) {
			$this->assertTrue( 
				has_image_size( $size ), 
				sprintf( 'Expected size "%s" is not registered', $size ) 
			);
		}

	}

}

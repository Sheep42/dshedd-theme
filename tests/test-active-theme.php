<?php
/**
 * Class SampleTest
 *
 * @package Dshedd
 */

/**
 * Sample test case.
 */
class ActiveThemeTest extends WP_UnitTestCase {

	function testThemeEnabled() {
		$this->assertTrue( 'dshedd' == wp_get_theme() );
	}

}

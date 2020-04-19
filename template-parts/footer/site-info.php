<?php
/**
 * Displays footer site info
 */

?>
<div class="site-info row m-auto">
	
	<div class="col-lg-4 mb-2 mb-lg-0">Proudly made with <a href="https://wordpress.org/">WordPress</a></div> 
	<div class="copyright col-lg-4 mb-2 mb-lg-0"><?php esc_html_e( get_bloginfo( 'name' ) . ' &copy;' . date('Y') ); ?></div>
	<div class="col-lg-4 mb-2 mb-lg-0">Made with <span aria-hidden="true"><span class="screen-reader-text">heart</span>&hearts;</span> in Lowell, MA</div>

</div><!-- .site-info -->

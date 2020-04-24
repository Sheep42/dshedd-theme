<?php

	if( !defined('ABSPATH') ) wp_die( 'Cannot access directly' );

	$content_blocks = get_query_var( 'content_blocks', false );

	if( !empty( $content_blocks ) ):

		$counter = 1;
		?>

	 	<?php foreach( $content_blocks as $content_block ): ?>

	 		<div id="content-block-<?php esc_attr_e( $counter ); ?>" class="content-block content-block-<?php esc_attr_e( $content_block['acf_fc_layout'] ); ?>">
					<?php 
						set_query_var( 'content_block', $content_block );
						get_template_part('template-parts/blocks/block', $content_block['acf_fc_layout']);
					?>
	 		</div>

	 		<?php $counter++; ?>

	 	<?php endforeach; ?>

		<?php

	endif;
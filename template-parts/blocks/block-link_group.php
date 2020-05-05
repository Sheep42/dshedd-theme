<?php 
	if( !defined('ABSPATH') ) wp_die( 'Cannot access directly' );

	$content_block = get_query_var( 'content_block', false );

	if( !empty( $content_block ) && !empty( $content_block['links'] ) ):
		?>

		<?php if($content_block['section_title']): ?>
			<h2><?php esc_html_e( $content_block['section_title'] ); ?></h2>
		<?php endif; ?>

		<div class="list-group">
			<?php foreach( $content_block['links'] as $link_row ): ?>

				<a href="<?php echo esc_url( $link_row['url'] ); ?>" <?php echo true === $link_row['new_tab'] ? 'target="_blank"' : ''; ?> class="list-group-item list-group-item-dark list-group-item-action">
					<?php if( true === $content_block['use_icons'] && !empty( $link_row['icon'] ) ): ?>
						<i class="<?php esc_attr_e( $link_row['icon'] ); ?> mr-2"></i>
					<?php endif; ?>

					<?php esc_html_e( $link_row['label'] ); ?>
				</a>

			<?php endforeach; ?>
		</div>

		<?php
	endif;
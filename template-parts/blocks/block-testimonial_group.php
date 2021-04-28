<?php 
	if( !defined('ABSPATH') ) wp_die( 'Cannot access directly' );

	$content_block = get_query_var( 'content_block', false );
	
	// var_dump( $content_block );

	if( !empty( $content_block ) && !empty( $content_block['testimonials'] ) ):
		?>

		<div class="testimonials p-5">

			<?php if( $content_block['section_title'] ): ?>
				<h2><?php esc_html_e( $content_block['section_title'] ); ?></h2>
			<?php endif; ?>

			<?php 
				
				if( $content_block['section_content'] ) {
					echo wp_kses_post( $content_block['section_content'] ); 
				}

			?>

			<?php foreach( $content_block['testimonials'] as $testimonial ): ?>

				<div class="testimonial mt-4">

					<blockquote class="blockquote">
						<?php echo wp_kses_post( $testimonial['quote'] ); ?>
					</blockquote>

					<p class="author-details">

						<span class="author-name"><?php esc_html_e( $testimonial['name'] ); ?></span>
						
						<?php if( !empty( $testimonial['position'] ) ): ?>
							<span class="px-1">&mdash;</span>
							<span class="author-position"><?php esc_html_e( $testimonial['position'] ); ?></span>
						<?php endif; ?>

						<?php if( !empty( $testimonial['company'] ) ): ?>
							<span class="px-1">&mdash;</span>
							<span class="author-company">
								<?php if( $testimonial['company_link'] ): ?>
									<a href="<?php echo esc_url( $testimonial['company_link'] ); ?>" target="_blank"><?php esc_html_e( $testimonial['company'] ); ?></a>
								<?php else: ?>
									<?php esc_html_e( $testimonial['company'] ); ?>
								<?php endif; ?>
							</span>	
						<?php endif; ?>

					</p>

				</div>
			
			<?php endforeach; ?>

		</div>

		<?php
	endif;
<div class="entry-meta">
	<span class="entry-date"><?php esc_html_e( get_the_date() ); ?></span>

	<?php 
		$categories = wp_get_post_categories( get_the_ID(), array( 
			'fields' => 'all'
		));
	?>

	<?php if( !empty( $categories ) ): ?>

		<?php
			$counter = 1; 
			$category_count = count( $categories ); 
		?>

		<span class="mr-2 m-2">&bull;</span>

		<?php foreach( $categories as $category ): ?>
			
			<span class="category-link">
				<a href="<?php echo get_category_link( $category ); ?>">
					<?php esc_html_e( $category->name ); ?>
				</a><?php echo ( $counter < $category_count ) ? ', ' : ''; ?>
			</span>

			<?php $counter++; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div><!-- .entry-meta -->
<div class="entry-meta">

	<?php 
		$categories = wp_get_post_terms( array( 
			'taxonomy' => 'project-category' 
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
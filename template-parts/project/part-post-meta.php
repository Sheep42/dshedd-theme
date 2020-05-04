<div class="project-categories">

	<?php $project_categories = get_the_terms( $post, 'project-category' ); ?>

	<?php if( !empty( $project_categories ) ): ?>

		<?php foreach( $project_categories as $category ): ?>
			
			<a href="<?php echo get_category_link( $category ); ?>" class="badge badge-pill badge-secondary">
				<?php esc_html_e( $category->name ); ?>
			</a>

		<?php endforeach; ?>
	<?php endif; ?>
</div><!-- .entry-meta -->
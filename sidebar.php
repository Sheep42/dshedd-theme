<?php
/**
 * The main sidebar 
 */

$queried_obj = get_queried_object();
?>

<aside id="sidebar" class="widget-area col-lg-3 order-1 mb-4 mb-lg-0" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'dshedd' ); ?>">
	
	<?php 
		$all_categories = get_categories( array(
			'taxonomy' => 'category',
			'hide_empty' => true
		)); 
	?>

	<h2 class="mb-4">Categories</h2>

	<?php if( !empty( $all_categories ) ): ?>
		<div class="list-group">
			<?php foreach( $all_categories as $category ): ?>
				<?php 
					$link_classes = array(
						'list-group-item',
						'list-group-item-dark', 
						'list-group-item-action',
						'd-flex', 
						'justify-content-between',
						'align-items-center',
					);

					if( !empty( $queried_obj->term_id ) && is_category() ) {
						
						if( $category->term_id == $queried_obj->term_id )
							$link_classes[] = 'active';

					}

					$link_classes_str = implode( ' ', $link_classes );
					$label = ( $category->category_count > 1 ) ? 'Posts' : 'Post';
 				?>

				<a href="<?php echo get_category_link( $category ); ?>" class="<?php esc_attr_e( $link_classes_str ); ?>" title="<?php esc_attr_e( $category->category_count . ' ' . $label . ' in ' . $category->name ); ?>">
					<?php esc_html_e( $category->name ); ?>
					<span class="badge badge-pill badge-light">
						<?php esc_html_e( $category->category_count ); ?>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p>No categories at the moment</p>
	<?php endif; ?>

</aside><!-- #secondary -->

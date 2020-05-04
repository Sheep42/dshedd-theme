<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if( !comments_open() ) {
	return;
} 
?>

<h2 class="mb-4">Comments</h2>

<div id="comments" class="comments card bg-dark p-4">

	<div class="comments-inner w-75 m-auto">

		<?php $comments_number = absint( get_comments_number() ); ?>
		<div class="comments-header">

			<h2 class="comment-reply-title">
				<?php
					if ( ! have_comments() ) {
						_e( 'Leave a comment', 'dshedd' );
					} elseif ( '1' === $comments_number ) {
						/* translators: %s: post title */
						printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'dshedd' ), esc_html( get_the_title() ) );
					} else {
						echo sprintf(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'%1$s reply on &ldquo;%2$s&rdquo;',
								'%1$s replies on &ldquo;%2$s&rdquo;',
								$comments_number,
								'comments title',
								'dshedd'
							),
							number_format_i18n( $comments_number ),
							esc_html( get_the_title() )
						);
					}
				?>
			</h2><!-- .comments-title -->

		</div><!-- .comments-header -->

		<div class="comments-list">

			<?php
				wp_list_comments( array(
					'callback' => 'dshedd_bootstrap_comments'
				));
				
				$comment_pagination = paginate_comments_links(
					array(
						'echo'      => false,
						'end_size'  => 0,
						'mid_size'  => 0,
						'next_text' => __( 'Newer Comments', 'dshedd' ) . ' <span aria-hidden="true">&rarr;</span>',
						'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'dshedd' ),
					)
				);

				if ( $comment_pagination ) {
					$pagination_classes = '';

					// If we're only showing the "Next" link, add a class indicating so.
					if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
						$pagination_classes = ' only-next';
					}
					?>

					<nav class="comments-pagination pagination<?php echo $pagination_classes; ?>">
						<?php echo wp_kses_post( $comment_pagination ); ?>
					</nav>

					<?php
				}
			?>

		</div><!-- .comments-list -->	

		<div class="new-comment-form">
			<?php 
 
				$funny_comments = array(
					'Ain\'t no planet X coming cuz ain\'t no space cuz ain\'t no globe earth',
					'I believe in swordfish',
					'Vim or Emacs?',
					'Spaces or Tabs?',
					'Somebody is wrong on the internet!',
					'This comment has been closed as off-topic',
					'Zalgo is upon us',
					'ALL GLORY TO THE HYPNOTOAD',
				);

				$max_elem = count( $funny_comments ) - 1;
 				$element = rand( 0, $max_elem );

				if ( $comments ) {
					echo '<hr class="separator" />';
				}

				comment_form(
					array(
						'fields' => array(
							'<div class="form-group form-row">',
								'<div class="col"><label for="comment_author" class="screen-reader-text">Your Name</label><input id="comment-author" type="text" placeholder="Your Name*" name="author" class="form-control" /></div>',
								'<div class="col"><label for="comment_email" class="screen-reader-text">Email Address</label><input type="email" placeholder="Email Address*" name="email" class="form-control" /></div>',
							'</div>',
						),
						'comment_field' => '<label for="comment_text" class="screen-reader-text">Your Comment</label><textarea id="comment_text" name="comment" placeholder="' . esc_attr( $funny_comments[$element] ) . '" class="form-control mb-4" rows="5"></textarea>',
						'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary float-right" value="%4$s" />',
						'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
						'title_reply_after'  => '</h3>',
					)
				);

			?>
		</div><!-- .new-comment-form -->

	</div><!-- .comments-inner -->

</div><!-- #comments -->
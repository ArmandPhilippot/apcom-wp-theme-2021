<?php
/**
 * Overwrite default WordPress walker comment.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

namespace APCom\Includes;

use Walker_Comment;

/**
 * Custom Walker Comment
 */
class Custom_Walker_Comment extends Walker_Comment {
	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.', 'APCom' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'APCom' );
		}
		?>
		<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'comment--parent' : '', $comment ); ?>>
			<article class="comment__inner" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
				<header class="comment__header">
					<div class="comment__author">
						<?php
						if ( 0 !== $args['avatar_size'] ) {
							?>
							<div class="author__avatar">
								<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							</div>
							<?php
						}
						?>

						<div class="author__name" itemprop="author">
							<?php
							$comment_author = get_comment_author_link( $comment );

							if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
								$comment_author = get_comment_author( $comment );
							}

							echo wp_kses_post( $comment_author );
							?>
						</div>

						<?php
						global $post;
						if ( $comment->user_id === $post->post_author ) {
							?>
							<div class="author__post"><?php esc_html_e( 'Author', 'APCom' ); ?></div>
							<?php
						}
						?>
					</div>
					<dl class="comment__date">
						<dt><?php esc_html_e( 'Published on:', 'APCom' ); ?></dt>
						<dd>
							<?php
							printf(
								'<a href="%s" title="%s"><time datetime="%s" itemprop="datePublished">%s</time></a>',
								esc_url( get_comment_link( $comment, $args ) ),
								sprintf(
									/* translators: 1: Comment date, 2: Comment time. */
									esc_html__( '%1$s at %2$s', 'APCom' ),
									esc_html( get_comment_date( '', $comment ) ),
									esc_html( get_comment_time() )
								),
								esc_attr( get_comment_time( 'c' ) ),
								esc_html( get_comment_date( '', $comment ) )
							);
							?>
						</dd>
					</dl>
				</header>

				<div class="comment__body">
					<?php comment_text(); ?>
				</div>

				<footer class="comment__footer">
					<?php edit_comment_link( __( 'Edit', 'APCom' ), ' <div class="comment__edit">', '</div>' ); ?>

					<?php if ( '0' === $comment->comment_approved ) : ?>
						<p class="comment__awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></p>
					<?php endif; ?>

					<?php
					if ( '1' === $comment->comment_approved || $show_pending_links ) {
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below'  => 'comment',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
									'before'     => '<div class="comment__reply">',
									'after'      => '</div>',
									'reply_text' => __( 'Reply', 'APCom' ),
								)
							)
						);
					}
					?>
				</footer>
			</article>
		<?php
	}
}

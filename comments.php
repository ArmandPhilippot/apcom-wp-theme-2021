<?php
/**
 * The template for displaying the comments and comment form.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$apcom_comment_form_args = array(
	'class_container'    => 'comments__form',
	'class_form'         => 'comment-form',
	'class_submit'       => 'comment-form__btn',
	'title_reply_before' => '<h2 id="reply-title" class="comment-form__title">',
	'title_reply_after'  => '</h2>',
	'submit_field'       => '<p class="comment-form__submit">%1$s %2$s</p>',
	'format'             => 'html5',
);
?>
<section class="page__comments comments" id="comments">
	<div class="comments__header">
		<h2 class="comments__title" id="comments__title">
			<?php
			$apcom_comment_count = get_comments_number();
			if ( '0' === $apcom_comment_count ) {
				// translators: %s: post title.
				printf( esc_html_x( 'No comments to &ldquo;%s&rdquo; yet.', 'comments title', 'APCom' ), esc_html( get_the_title() ) );
			} else {
				printf(
					esc_html(
						// translators: 1: number of comments, 2: post title.
						_nx(
							'%1$s reply to &ldquo;%2$s&rdquo;',
							'%1$s replies to &ldquo;%2$s&rdquo;',
							$apcom_comment_count,
							'comments title',
							'APCom'
						)
					),
					esc_html( number_format_i18n( $apcom_comment_count ) ),
					esc_html( get_the_title() )
				);
			}
			?>
		</h2>
		<a href="<?php echo esc_url( get_permalink() ); ?>feed/" class="feed">
			<?php esc_html_e( 'Subscribe to comments', 'APCom' ); ?>
		</a>
	</div>
	<?php if ( have_comments() ) { ?>
		<ol class="comments__list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'reply_text'  => __( 'Reply', 'APCom' ),
					'walker'      => new APCom\Includes\Custom_Walker_Comment(),
				)
			)
			?>
		</ol>
		<?php
		the_comments_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( 'Previous', 'APCom' ),
				'next_text' => __( 'Next', 'APCom' ),
			)
		);
	}
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>
		<p class="no-comments">
			<?php
			esc_html_e( 'Comments are closed.', 'APCom' );
			?>
		</p>
		<?php
	}
	comment_form( $apcom_comment_form_args );
	?>
</section>

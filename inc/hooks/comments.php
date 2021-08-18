<?php
/**
 * Hooks related to comments.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Modify HTML markup for the submit button of comment form.
 *
 * @since  0.0.1
 *
 * @param  string $button HTML markup used to render the submit button.
 * @return string HTML output modified.
 */
function apcom_comment_form_submit_button( $button ) {
	$button =
	'<button class="comment-form__btn btn btn--primary" type="submit"><span class="btn__body">' . __( 'Leave a comment', 'APCom' ) . '</span></button>';
	return $button;
}
add_filter( 'comment_form_submit_button', 'apcom_comment_form_submit_button' );

/**
 * Add classes to comment reply link.
 *
 * @param string $link The HTML markup for the comment reply link.
 * @return string The modified link.
 */
function apcom_comment_reply_link( $link ) {
	$extra_classes = 'comment__link comment__link--reply btn btn--secondary';
	return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $link );
}
add_filter( 'comment_reply_link', 'apcom_comment_reply_link', 10, 1 );

/**
 * Add classes to edit comment link.
 *
 * @param string $link The HTML markup for the edit comment link.
 * @return string The modified link.
 */
function apcom_edit_comment_link( $link ) {
	$extra_classes = 'comment__link comment__link--edit btn btn--secondary';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $link );
}
add_filter( 'edit_comment_link', 'apcom_edit_comment_link', 10, 1 );

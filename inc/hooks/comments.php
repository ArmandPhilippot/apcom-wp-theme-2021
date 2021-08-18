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
	'<button class="form__btn btn btn--primary" type="submit"><span class="btn__body">' . __( 'Leave a comment', 'APCom' ) . '</span></button>';
	return $button;
}
add_filter( 'comment_form_submit_button', 'apcom_comment_form_submit_button' );

/**
 * Add classes to comment reply link.
 *
 * @since  1.2.0
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
 * @since  1.2.0
 *
 * @param string $link The HTML markup for the edit comment link.
 * @return string The modified link.
 */
function apcom_edit_comment_link( $link ) {
	$extra_classes = 'comment__link comment__link--edit btn btn--secondary';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $link );
}
add_filter( 'edit_comment_link', 'apcom_edit_comment_link', 10, 1 );

/**
 * Add classes to cancel comment reply link.
 *
 * @since  1.2.0
 *
 * @param string $formatted_link The HTML-formatted cancel comment reply link.
 * @return string The modified markup.
 */
function apcom_cancel_comment_reply_link( $formatted_link ) {
	$classes = 'comment__link comment__link--cancel btn btn--secondary';
	return preg_replace( '/cancel-comment-reply-link"/', 'cancel-comment-reply-link" class="' . $classes . '"', $formatted_link );
}
add_filter( 'cancel_comment_reply_link', 'apcom_cancel_comment_reply_link', 10, 1 );

/**
 * Change comment form fields order and add class to label.
 *
 * @param array $fields Default fields.
 * @return string $fields Custom fields order with label classes.
 *
 * @since 1.2.0
 */
function apcom_comment_form_fields( $fields ) {
	$label_classes = 'form__label';
	$comment_field = preg_replace( '/<label /', '<label class="' . $label_classes . '" ', $fields['comment'] );
	$author_field  = preg_replace( '/<label /', '<label class="' . $label_classes . '" ', $fields['author'] );
	$email_field   = preg_replace( '/<label /', '<label class="' . $label_classes . '" ', $fields['email'] );
	$url_field     = preg_replace( '/<label /', '<label class="' . $label_classes . '" ', $fields['url'] );

	// Unset array fields.
	unset( $fields['comment'] );
	unset( $fields['author'] );
	unset( $fields['email'] );
	unset( $fields['url'] );

	// Declare new order.
	$fields['author']  = $author_field;
	$fields['email']   = $email_field;
	$fields['url']     = $url_field;
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'apcom_comment_form_fields', 10, 1 );


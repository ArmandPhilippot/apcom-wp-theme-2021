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

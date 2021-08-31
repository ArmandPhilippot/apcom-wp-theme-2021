<?php
/**
 * Contact form functions to control inputs and sending.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.2
 */

/**
 * Custom contact form
 *
 * @since 0.0.1
 */
function apcom_contact_form() {
	if ( isset( $_POST['contact-submitted'] ) && isset( $_POST['contact-form'] ) ) {
		$submitted = sanitize_text_field( wp_unslash( $_POST['contact-submitted'] ) );

		if ( wp_verify_nonce( sanitize_key( $_POST['contact-form'] ), 'contact' ) ) {
			if ( empty( $_POST['contact-phone'] ) ) {
				if ( isset( $_POST['contact-name'] ) ) {
					$name = sanitize_text_field( wp_unslash( $_POST['contact-name'] ) );
				}
				if ( isset( $_POST['contact-email'] ) ) {
					$email = sanitize_email( wp_unslash( $_POST['contact-email'] ) );
				}
				if ( isset( $_POST['contact-object'] ) ) {
					$object = sanitize_text_field( wp_unslash( $_POST['contact-object'] ) );
				}
				if ( isset( $_POST['contact-message'] ) ) {
					$message = sanitize_textarea_field( wp_unslash( $_POST['contact-message'] ) );
				}
				if ( empty( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
					$url = add_query_arg( 'contact-validation', 'email', wp_get_referer() );
					wp_safe_redirect( $url );
					exit();
				} elseif ( empty( $name ) || empty( $message ) ) {
					$url = add_query_arg( 'contact-validation', 'empty', wp_get_referer() );
					wp_safe_redirect( $url );
					exit();
				} elseif ( '1' === $submitted ) {
					$to            = get_option( 'admin_email' );
					$from          = $name . ' <' . $to . '>';
					$reply_to      = $name . ' <' . $email . '>';
					$subject       = '[' . get_bloginfo( 'name' ) . '] ' . $object;
					$mail_content  = 'From: ' . $reply_to . "\r\n\r\n";
					$mail_content .= wp_strip_all_tags( $message );
					$headers[]     = 'From: ' . $from;
					$headers[]     = 'Reply-To: ' . $reply_to;
					wp_mail( $to, $subject, $mail_content, $headers );
					$url = add_query_arg( 'contact-validation', 'ok', wp_get_referer() );
					wp_safe_redirect( $url );
					exit();
				}
			} else {
				$url = add_query_arg( 'contact-validation', 'nice-try', wp_get_referer() );
				wp_safe_redirect( $url );
				exit();
			}
		}
	}
}
add_action( 'template_redirect', 'apcom_contact_form' );

/**
 * Pass variable as parameter in URL.
 *
 * @since 0.0.1
 *
 * @param  array $vars The array of allowed query variable names.
 * @return array Allowed query variable names.
 */
function apcom_add_query_vars_filter( $vars ) {
	$vars[] = 'contact-validation';
	return $vars;
}
add_filter( 'query_vars', 'apcom_add_query_vars_filter' );


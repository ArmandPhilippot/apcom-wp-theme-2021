<?php
/**
 * The contact form template.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from page-contact.
 */

?>
<form method="post" class="form form--contact">
	<?php
	wp_nonce_field( 'contact', 'contact-form' );
	if ( get_query_var( 'contact-validation' ) ) {
		$apcom_validation = get_query_var( 'contact-validation' );
		switch ( $apcom_validation ) {
			case 'empty':
				echo '<p class="modal modal--error">' . esc_html__( 'Some required fields have not been completed.', 'APCom' ) . '</p>';
				break;
			case 'email':
				echo '<p class="modal modal--error">' . esc_html__( 'Your email address contains errors.', 'APCom' ) . '</p>';
				break;
			case 'ok':
				echo '<p class="modal modal--valid">' . esc_html__( 'Your message has been sent.', 'APCom' ) . '</p>';
				break;
			case 'nice-try':
				echo '<p class="modal modal--nice-try">' . esc_html__( 'Nice try', 'APCom' ) . '</p>';
				break;
			default:
				echo '<p class="modal modal--error">' . esc_html__( 'An error has occurred.', 'APCom' ) . '</p>';
		}
	}
	?>
	<p class="form__item">
		<label for="contact-name" class="form__label">
			<?php esc_html_e( 'Name', 'APCom' ); ?>
			<span class="required"> *</span>
		</label>
		<input type="text" id="contact-name" name="contact-name" maxlength="64" pattern="([^\s][A-z0-9À-ž ,.'’-]+)" placeholder="<?php esc_attr_e( 'Firstname Lastname', 'APCom' ); ?>" class="form__field" required />
	</p>
	<p class="form__item">
		<label for="contact-email" class="form__label">
			<?php esc_html_e( 'Email', 'APCom' ); ?>
			<span class="required"> *</span>
		</label>
		<input type="email" id="contact-email" name="contact-email" placeholder="<?php esc_attr_e( 'your@email.com', 'APCom' ); ?>" class="form__field" required />
	</p>
	<p class="form__item">
		<label for="contact-object" class="form__label">
			<?php esc_html_e( 'Object', 'APCom' ); ?>
		</label>
		<input type="text" id="contact-object" name="contact-object" placeholder="<?php esc_attr_e( 'Mail subject', 'APCom' ); ?>" class="form__field" />
	</p>
	<p class="form__item">
		<label for="contact-message" class="form__label">
			<?php esc_html_e( 'Message', 'APCom' ); ?>
			<span class="required"> *</span>
		</label>
		<textarea id="contact-message" name="contact-message" placeholder="<?php esc_attr_e( 'Your message here...', 'APCom' ); ?>" class="form__field form__field--textarea" required></textarea>
	</p>
	<p class="form__item form__item--none">
		<label for="contact-phone" class="form__label">
			<?php esc_html_e( 'Phone', 'APCom' ); ?>
		</label>
		<input type="text" name="contact-phone" id="contact-phone" pattern="[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}" value="" />
	</p>
	<input type="hidden" name="contact-submitted" value="1">
	<button class="form__btn btn btn--primary" type="submit">
		<span><?php esc_attr_e( 'Send', 'APCom' ); ?></span>
	</button>
</form>

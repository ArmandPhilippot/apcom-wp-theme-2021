<?php
/**
 * The meta template for reading time.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

?>
<div class="meta__item meta__item--has-icon meta__item--reading-time">
	<dt class="meta__term">
	<?php esc_html_e( 'Reading time', 'APCom' ); ?>
	</dt>
	<dd class="meta__description">
	<?php echo wp_kses_post( apcom_get_reading_time( $post->post_content ) ); ?>
	</dd>
</div>

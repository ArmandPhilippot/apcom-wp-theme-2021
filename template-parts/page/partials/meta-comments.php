<?php
/**
 * The meta template for comments.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

$apcom_comment_count = get_comments_number();
if ( comments_open() || $apcom_comment_count > 0 ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--comments">
		<dt class="meta__term">
		<?php esc_html_e( 'Comments', 'APCom' ); ?>
		</dt>
		<dd class="meta__description">
		<?php
		comments_popup_link();
		echo '<meta itemprop="interactionCount" content="UserComments:' . esc_html( $apcom_comment_count ) . '" />';
		?>
		</dd>
	</div>
	<?php
}

<?php
/**
 * The meta template to display attachment parent.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

?>
<div class="meta__item meta__item--attachment">
	<dt class="meta__term">
		<?php echo esc_html__( 'Published in:', 'APCom' ); ?>
	</dt>
	<dd class="meta__description">
		<?php
		$apcom_attachment_parent_link  = get_permalink( $post->post_parent );
		$apcom_attachment_parent_title = get_the_title( $post->post_parent );
		if ( $post->post_parent ) {
			?>
			<a href="<?php echo esc_url( $apcom_attachment_parent_link ); ?>"><?php echo esc_html( $apcom_attachment_parent_title ); ?></a>
			<?php
		} else {
			esc_html_e( 'Is not attached to any article.', 'APCom' );
		}
		?>
	</dd>
</div>

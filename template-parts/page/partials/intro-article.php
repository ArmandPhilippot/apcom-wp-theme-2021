<?php
/**
 * The introduction template displayed in articles header.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from page-header.
 */

$apcom_post_parts   = get_extended( $post->post_content );
$apcom_post_teaser  = $apcom_post_parts['main'];
$apcom_post_content = $apcom_post_parts['extended'];

if ( '' !== $apcom_post_content ) {
	?>
	<div class="page__introduction">
		<?php
		echo wp_kses_post( $apcom_post_teaser );
		?>
	</div>
	<?php
}

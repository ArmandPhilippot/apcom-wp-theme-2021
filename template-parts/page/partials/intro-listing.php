<?php
/**
 * The introduction template displayed on pages listing header (ie. blog,
 * archives...).
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from page-header.
 */

if ( is_archive() ) {
	the_archive_description( '<div class="page__introduction">', '</div>' );
} else {
	$apcom_page_for_posts_id      = get_option( 'page_for_posts' );
	$apcom_page_for_posts_content = get_the_content( null, false, $apcom_page_for_posts_id );

	if ( '' !== $apcom_page_for_posts_content ) {
		?>
		<div class="page__introduction">
			<?php
			echo wp_kses_post( $apcom_page_for_posts_content );
			?>
		</div>
		<?php
	}
}

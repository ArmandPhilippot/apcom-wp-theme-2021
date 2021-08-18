<?php
/**
 * Hooks related to scripts.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Add async/defer attributes to enqueued scripts.
 *
 * @since  1.2.0
 *
 * @param  string $tag The <script> tag for the enqueued script.
 * @param  string $handle The script's registered handle.
 * @return string  $tag The modified script tag.
 */
function apcom_add_async_defer_attributes( $tag, $handle ) {
	if ( is_admin() ) {
		return $tag;
	}

	if ( strpos( $handle, 'async' ) !== false ) {
		$tag = str_replace( '<script ', '<script async ', $tag );
	}

	if ( strpos( $handle, 'defer' ) !== false ) {
		$tag = str_replace( '<script ', '<script defer ', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'apcom_add_async_defer_attributes', 10, 2 );

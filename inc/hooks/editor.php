<?php
/**
 * Hooks related to editor.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Simulate non-empty content to enable Gutenberg editor on Blog page.
 *
 * @since  0.0.1
 * @see https://wordpress.stackexchange.com/a/350563
 *
 * @param bool    $replace Whether to replace the editor.
 * @param WP_Post $post    Post object.
 * @return bool
 */
function apcom_enable_gutenberg_editor_for_blog_page( $replace, $post ) {
	if ( ! $replace && absint( get_option( 'page_for_posts' ) ) === $post->ID && empty( $post->post_content ) ) {
		// This comment will be removed by Gutenberg since it won't parse into block.
		$post->post_content = '<!--non-empty-content-->';
	}
	return $replace;
}
add_filter( 'replace_editor', 'apcom_enable_gutenberg_editor_for_blog_page', 10, 2 );

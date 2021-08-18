<?php
/**
 * Hooks related to body tag.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Overwrite default body classes.
 *
 * @since  0.0.1
 *
 * @param  array $classes An array of body class names.
 * @return array The custom body classes.
 */
function apcom_body_class( $classes ) {
	global $wp_query;
	$post_id = $wp_query->get_queried_object_id();
	$classes = array();

	$classes[] = 'body';

	if ( is_rtl() ) {
		$classes[] = 'rtl';
	}

	if ( is_user_logged_in() ) {
		$classes[] = 'logged-in';
	}

	if ( is_admin_bar_showing() ) {
		$classes[] = 'admin-bar';
		$classes[] = 'no-customize-support';
	}

	if ( is_paged() ) {
		$classes[] = 'paged';
	}

	if ( apcom_is_frontpage() ) {
		$classes[] = 'front-page';
	}

	if ( is_single() || ( is_page() && ! apcom_is_frontpage() ) ) {
		$classes[] = 'single-page';
	}

	if ( is_attachment() ) {
		$classes[] = 'attachment';
	}

	if ( ! is_page() && ! is_single() ) {
		$classes[] = 'articles-list';
	}

	if ( is_singular( array( 'thematic', 'subject' ) ) ) {
		$classes[] = 'cpt';
	}

	if ( is_search() || is_404() ) {
		$classes[] = 'search';
	}

	if ( is_404() || apcom_is_search_has_results() === false ) {
		$classes[] = 'no-results';
	}

	if ( is_author() ) {
		$classes[] = 'author';
	}

	if ( is_category() ) {
		$classes[] = 'category';
	}

	if ( is_page_template() ) {
		$template_slug  = get_page_template_slug( $post_id );
		$template_parts = explode( '/', $template_slug );

		foreach ( $template_parts as $part ) {
			$classes[] = 'template__' . sanitize_html_class( str_replace( array( '.', '/' ), '-', basename( $part, '.php' ) ) );
		}
	}

	$comment_count = get_comments_number( $post_id );
	if ( ( is_page() || is_single() ) && ! apcom_is_frontpage() && false === comments_open() && ! $comment_count > 0 ) {
		$classes[] = 'no-comments';
	}

	if ( has_block( 'code' ) ) {
		$classes[] = 'has-code-block';
	}

	return $classes;
}
add_filter( 'body_class', 'apcom_body_class' );

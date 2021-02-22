<?php
/**
 * Helpers functions.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

/**
 * Check if we're on the front-page and not in the home (articles list) view.
 *
 * @since  0.0.1
 *
 * @return boolean  True if is front-page; false, otherwise.
 */
function apcom_is_frontpage() {
	return is_front_page() && ! is_home();
}

/**
 * Determine whether or not the current post is a paginated post.
 *
 * @since   0.0.1
 *
 * @return  boolean  True if the post is paginated; false, otherwise.
 */
function apcom_is_paginated_post() {
	global $multipage;
	return 0 !== $multipage;
}

/**
 * Check if search return results.
 *
 * @since 0.0.1
 *
 * @return bool True if search has results, else false.
 */
function apcom_is_search_has_results() {
	if ( is_search() ) {
		global $wp_query;
		$result = ( 0 !== $wp_query->found_posts ) ? true : false;
		return $result;
	}
}

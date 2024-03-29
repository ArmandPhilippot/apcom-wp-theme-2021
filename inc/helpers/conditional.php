<?php
/**
 * Helpers functions for checking purposes.
 *
 * This file gathers all "is" functions which return a boolean.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
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
	return $multipage && 0 !== $multipage;
}

/**
 * Check if search return results.
 *
 * @since 0.0.1
 *
 * @return boolean True if search has results, else false.
 */
function apcom_is_search_has_results() {
	if ( is_search() ) {
		global $wp_query;
		$result = ( 0 !== $wp_query->found_posts ) ? true : false;
		return $result;
	}
}

/**
 * Check if current page is contact page.
 *
 * @since  1.2.0
 *
 * @return boolean True if is contact page.
 */
function apcom_is_contact_page() {
	return is_page_template( 'page-contact.php' );
}

/**
 * Check if current page is CV page.
 *
 * @since  1.2.0
 *
 * @return boolean True if is CV page.
 */
function apcom_is_cv_page() {
	return is_page_template( 'page-cv.php' );
}

/**
 * Check if current page is a page with ToC but no other sidebar.
 *
 * @since  1.2.0
 *
 * @return boolean True if is page has no sidebar.
 */
function apcom_is_page_no_sidebar() {
	return is_page_template( 'page-toc-no-sidebar.php' );
}

/**
 * Check if current page is an article CPT.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID. Default is current page.
 * @return boolean True if is an article CPT.
 */
function apcom_is_article_cpt( $post_id = null ) {
	if ( ! $post_id || ! is_integer( $post_id ) ) {
		$post_id = get_queried_object_id();
	}

	return 0 !== $post_id && 'article' === get_post_type( $post_id );
}

/**
 * Check if current page is a project CPT.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID. Default is current page.
 * @return boolean True if is a project CPT.
 */
function apcom_is_project_cpt( $post_id = null ) {
	if ( ! $post_id || ! is_integer( $post_id ) ) {
		$post_id = get_queried_object_id();
	}

	return 0 !== $post_id && 'project' === get_post_type( $post_id );
}

/**
 * Check if current page is a subject CPT.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID. Default is current page.
 * @return boolean True if is a subject CPT.
 */
function apcom_is_subject_cpt( $post_id = null ) {
	if ( ! $post_id || ! is_integer( $post_id ) ) {
		$post_id = get_queried_object_id();
	}

	return 0 !== $post_id && 'subject' === get_post_type( $post_id );
}

/**
 * Check if current page is a thematic CPT.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID. Default is current page.
 * @return boolean True if is a thematic CPT.
 */
function apcom_is_thematic_cpt( $post_id = null ) {
	if ( ! $post_id || ! is_integer( $post_id ) ) {
		$post_id = get_queried_object_id();
	}

	return 0 !== $post_id && 'thematic' === get_post_type( $post_id );
}

/**
 * Check if current page is a CPT used by the theme.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID. Default is current page.
 * @return boolean True if is CPT.
 */
function apcom_is_cpt( $post_id = null ) {
	return apcom_is_article_cpt( $post_id ) || apcom_is_project_cpt( $post_id ) || apcom_is_subject_cpt( $post_id ) || apcom_is_thematic_cpt( $post_id );
}

/**
 * Check if current page is a post, a page or an article CPT.
 *
 * @since  1.2.0
 *
 * @return boolean True if is a single page.
 */
function apcom_is_single_page() {
	return apcom_is_article_cpt() || is_single() || is_page();
}

/**
 * Check if current page contains a list of posts like archive or blog index.
 *
 * @since  1.2.0
 *
 * @return boolean True if is a listing page.
 */
function apcom_is_listing_page() {
	return ( is_home() && ! is_front_page() ) || is_archive() || is_search();
}

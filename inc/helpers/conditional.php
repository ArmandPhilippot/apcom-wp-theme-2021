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
 * Check if current page is a CPT used by the theme.
 *
 * @since  1.2.0
 *
 * @return boolean True if is CPT.
 */
function apcom_is_cpt() {
	return is_singular( array( 'article', 'project', 'subject', 'thematic' ) );
}

/**
 * Check if current page is an article CPT.
 *
 * @since  1.2.0
 *
 * @return boolean True if is an article CPT.
 */
function apcom_is_article_cpt() {
	return is_singular( array( 'article' ) );
}

/**
 * Check if current page is a project CPT.
 *
 * @since  1.2.0
 *
 * @return boolean True if is a project CPT.
 */
function apcom_is_project_cpt() {
	return is_singular( array( 'project' ) );
}

/**
 * Check if current page is a subject CPT.
 *
 * @since  1.2.0
 *
 * @return boolean True if is a subject CPT.
 */
function apcom_is_subject_cpt() {
	return is_singular( array( 'subject' ) );
}

/**
 * Check if current page is a thematic CPT.
 *
 * @since  1.2.0
 *
 * @return boolean True if is a thematic CPT.
 */
function apcom_is_thematic_cpt() {
	return is_singular( array( 'thematic' ) );
}

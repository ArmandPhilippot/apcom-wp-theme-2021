<?php
/**
 * Helpers functions related to classes.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Define classes for current page.
 *
 * @since  1.2.0
 *
 * @param  int $post_id The post ID.
 * @return string $classes The page classes.
 */
function apcom_get_page_classes( $post_id ) {
	$post = get_post( $post_id );

	$classes = 'page';

	if ( apcom_is_frontpage() ) {
		$classes .= ' page--is-home';
	}

	if ( is_category() ) {
		$classes .= ' page--is-category';
	}

	if ( is_tag() ) {
		$classes .= ' page--is-tag';
	}

	if ( is_page() && $post->post_parent > 0 ) {
		$classes .= ' page--is-child';
	}

	if ( is_attachment() ) {
		$classes .= ' page--is-attachment';
	}

	if ( is_author() ) {
		$classes .= ' page--is-author';
	}

	if ( is_date() ) {
		$classes .= ' page--is-date';
	}

	if ( is_search() ) {
		$classes .= ' page--is-search';
	}

	if ( is_404() ) {
		$classes .= ' page--is-404';
	}

	if ( ! is_page() && ! is_single() ) {
		$classes .= ' page--is-listing';
	}

	if ( apcom_is_contact_page() ) {
		$classes .= ' page--is-contact';
	}

	if ( apcom_is_cv_page() ) {
		$classes .= ' page--is-cv';
	}

	if ( apcom_is_article_cpt() ) {
		$classes .= ' page--is-article';
	}

	if ( apcom_is_project_cpt() ) {
		$classes .= ' page--is-project';
	}

	if ( apcom_is_subject_cpt() ) {
		$classes .= ' page--is-subject';
	}

	if ( apcom_is_thematic_cpt() ) {
		$classes .= ' page--is-thematic';
	}

	if ( apcom_is_paginated_post() ) {
		$classes .= ' page--is-paginated';
	}

	if ( has_post_thumbnail( $post_id ) && ! is_attachment( $post ) ) {
		$classes .= ' page--has-thumbnail';
	}

	if ( has_block( 'code' ) ) {
		$classes .= ' page--has-code';
	}

	$comment_count = get_comments_number( $post_id );
	if ( ( is_page() || is_single() ) && ( true === comments_open() || $comment_count > 0 ) ) {
		$classes .= ' page--has-comments';
	}

	if ( is_404() || apcom_is_search_has_results() === false ) {
		$classes .= ' page--has-no-results';
	}

	return $classes;
}

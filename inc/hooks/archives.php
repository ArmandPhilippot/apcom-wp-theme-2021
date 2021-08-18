<?php
/**
 * Hooks related to archive pages.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Remove archive labels
 *
 * @since  0.0.2
 *
 * @param string $title Archive title.
 * @return string Archive title without labels.
 */
function apcom_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_year() ) {
		$title = ucfirst( get_the_date( _x( 'Y', 'yearly archives date format', 'APCom' ) ) );
	} elseif ( is_month() ) {
		$title = ucfirst( get_the_date( _x( 'F Y', 'monthly archives date format', 'APCom' ) ) );
	} elseif ( is_day() ) {
		$title = ucfirst( get_the_date( _x( 'F j, Y', 'daily archives date format', 'APCom' ) ) );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'apcom_archive_title' );

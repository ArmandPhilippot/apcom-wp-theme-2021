<?php
/**
 * Custom template tags for this theme.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( ! function_exists( 'apcom_get_page_title' ) ) {
	/**
	 * Get the current page title.
	 *
	 * @return string $title The current page title.
	 */
	function apcom_get_page_title() {
		$title = '';

		if ( is_single() || ( is_page() && ! apcom_is_frontpage() ) || ( is_home() && ! is_front_page() ) ) {
			$title = single_post_title( '', false );
		}

		if ( is_search() ) {
			$search_query = get_search_query( false );
			$title        = sprintf(
				// translators: %s: search query.
				esc_html__( 'Search results for: %s', 'APCom' ),
				esc_html( $search_query )
			);
		}

		if ( is_404() ) {
			$title = esc_html__( 'Nothing found', 'APCom' );
		}

		if ( is_archive() ) {
			if ( is_category() || is_tag() ) {
				$title = single_term_title( '', false );
			} else {
				$title = get_the_archive_title();
			}
		}

		if ( is_author() ) {
			$author_data = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$author_id   = $author_data->ID;
			$title       = get_the_author_meta( 'nickname', $author_id );
		}

		return $title;
	}
}

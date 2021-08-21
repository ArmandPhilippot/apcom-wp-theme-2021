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

if ( ! function_exists( 'apcom_get_pagination' ) ) {
	/**
	 * Print the pagination if available.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	function apcom_get_pagination() {
		if ( get_next_posts_link() || get_previous_posts_link() ) {
			the_posts_pagination(
				array(
					'mid_size'           => 2,
					'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="pagination__icon pagination__icon--previous"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg>' . __( 'Previous', 'APCom' ),
					'next_text'          => __( 'Next', 'APCom' ) . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="pagination__icon pagination__icon--next"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg>',
					'type'               => 'list',
					'class'              => 'articles',
					'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'APCom' ) . ' </span>',
				)
			);
		}
	}
}

if ( ! function_exists( 'apcom_get_breadcrumb' ) ) {
	/**
	 * Generate a breadcrumb.
	 *
	 * @return array $breadcrumb An array representing the breadcrumb.
	 */
	function apcom_get_breadcrumb() {
		$breadcrumb = array(
			1 => array(
				'url' => get_bloginfo( 'url' ),
				'txt' => __( 'Home', 'APCom' ),
			),
		);

		if ( is_home() ) {
			$breadcrumb += array(
				2 => array(
					'txt' => single_post_title( '', false ),
				),
			);
		} elseif ( is_page() ) {
			$breadcrumb += array(
				2 => array(
					'txt' => single_post_title( '', false ),
				),
			);
		} elseif ( is_search() ) {
			$breadcrumb += array(
				2 => array(
					'txt' => sprintf(
						// translators: %s: search query.
						esc_html__( 'Search results for: %s', 'APCom' ),
						get_search_query()
					),
				),
			);
		} elseif ( is_404() ) {
			$breadcrumb += array(
				2 => array(
					'txt' => __( 'Page not found', 'APCom' ),
				),
			);
		} else {
			$breadcrumb += array(
				2 => array(
					'url' => get_post_type_archive_link( 'post' ),
					'txt' => get_the_title( get_option( 'page_for_posts' ) ),
				),
			);
			if ( is_archive() ) {
				if ( is_category() ) {
					$breadcrumb += array(
						3 => array(
							'txt' => single_cat_title( '', false ),
						),
					);
				} elseif ( is_tag() ) {
					$breadcrumb += array(
						3 => array(
							'txt' => single_tag_title( '', false ),
						),
					);
				} elseif ( is_author() ) {
					$breadcrumb += array(
						3 => array(
							'txt' => get_the_author(),
						),
					);
				} elseif ( is_date() ) {
					$apcom_year         = get_the_date( _x( 'Y', 'yearly archives date format', 'APCom' ) );
					$apcom_month        = get_the_date( _x( 'F', 'monthly archives date format', 'APCom' ) );
					$apcom_month_number = get_the_date( _x( 'm', 'monthly archives date format', 'APCom' ) );
					$apcom_day          = get_the_date( _x( 'd', 'daily archives date format', 'APCom' ) );
					if ( is_day() ) {
						$breadcrumb += array(
							3 => array(
								'url' => get_year_link( $apcom_year ),
								'txt' => $apcom_year,
							),
						);
						$breadcrumb += array(
							4 => array(
								'url' => get_month_link( $apcom_year, $apcom_month_number ),
								'txt' => $apcom_month,
							),
						);
						$breadcrumb += array(
							5 => array(
								'txt' => $apcom_day,
							),
						);
					} elseif ( is_month() ) {
						$breadcrumb += array(
							3 => array(
								'url' => get_year_link( $apcom_year ),
								'txt' => $apcom_year,
							),
						);
						$breadcrumb += array(
							4 => array(
								'txt' => $apcom_month,
							),
						);
					} elseif ( is_year() ) {
						$breadcrumb += array(
							3 => array(
								'txt' => $apcom_year,
							),
						);
					}
				} else {
					$breadcrumb += array(
						3 => array(
							'txt' => get_the_archive_title(),
						),
					);
				}
			} elseif ( is_singular( 'project' ) ) {
				$apcom_post_type_object = get_post_type_object( 'project' );
				$breadcrumb            += array(
					3 => array(
						'url' => get_post_type_archive_link( 'project' ),
						'txt' => $apcom_post_type_object->labels->singular_name,
					),
					4 => array(
						'txt' => single_post_title( '', false ),
					),
				);
			} elseif ( is_single() ) {
				$breadcrumb += array(
					3 => array(
						'txt' => single_post_title( '', false ),
					),
				);
			}
		}

		return $breadcrumb;
	}
}

<?php
/**
 * Custom template tags for this theme.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( ! function_exists( 'apcom_get_reading_time' ) ) {
	/**
	 * Get a reading time estimation.
	 *
	 * @since  0.0.1
	 *
	 * @param  string $content The content to estimate.
	 * @return int $reading_time An estimate time in minutes.
	 */
	function apcom_get_reading_time( $content ) {
		$cleaned_content           = wp_strip_all_tags( strip_shortcodes( $content ) );
		$words_number              = str_word_count( $cleaned_content );
		$words_per_minute          = 245;
		$words_per_second          = $words_per_minute / 60;
		$estimated_time_in_seconds = $words_number / $words_per_second;
		$estimated_time_in_minutes = floor( $estimated_time_in_seconds / 60 );
		$remaining_seconds         = round( $estimated_time_in_seconds - $estimated_time_in_minutes * 60 );

		if ( $estimated_time_in_minutes <= 0 ) {
			$reading_time = $remaining_seconds . ' ' . __( 'seconds', 'APCom' );
		} else {
			if ( $remaining_seconds > 30 ) {
				$estimated_time_in_minutes = $estimated_time_in_minutes + round( $remaining_seconds / 60 );
			}
			// translators: %s : reading time in minutes.
			$reading_time = _nx(
				'%s minute',
				'%s minutes',
				$estimated_time_in_minutes,
				'reading time',
				'APCom'
			);
			$reading_time = $estimated_time_in_minutes . ' ' . __( 'minutes', 'APCom' );
		}

		$reading_time_markup = sprintf(
			'<span title="%s">%2s</span>',
			sprintf(
				// translators: %s : number of words.
				__( 'Approximately %1$s words read at %2$s words per minute.', 'APCom' ),
				$words_number,
				$words_per_minute
			),
			$reading_time
		);

		return $reading_time_markup;
	}
}

if ( ! function_exists( 'apcom_get_page_title' ) ) {
	/**
	 * Get the current page title.
	 *
	 * @since  1.2.0
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
	 * @since  1.2.0
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
	 * @since  1.2.0
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

if ( ! function_exists( 'apcom_get_svg_icon' ) ) {
	/**
	 * Get the SVG markup for a given icon name.
	 *
	 * @since  1.2.0
	 *
	 * @param string $icon_name The icon name.
	 * @param string $svg_classes Optional. A list of classes.
	 * @return string The SVG markup.
	 */
	function apcom_get_svg_icon( $icon_name, $svg_classes = '' ) {
		$icons = array(
			'arrow_right' => '<svg viewBox="0 0 64.645 23.476" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="m0 15.45 40.008-.018v8.044l24.637-11.761L39.845 0v8.044L0 8.186z"/></svg>',
			'arrow_top'   => '<svg viewBox="0 0 23.476 64.644" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="m15.45 64.645-.018-40.008h8.044L11.715 0 0 24.8h8.044l.142 39.845z"/></svg>',
			'close'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" aria-hidden="true"><path d="m10 10 80 80m0-80L10 90" style="stroke-width:20"/></svg>',
			'copyright'   => '<svg viewBox="0 0 211.998 64" xmlns="http://www.w3.org/2000/svg"><title>' . esc_attr__( 'CC BY SA', 'APCom' ) . '</title><path d="M175.54 15.83c0-3.009 1.484-4.515 4.457-4.515s4.457 1.504 4.457 4.514c0 2.971-1.486 4.457-4.457 4.457-2.97 0-4.458-1.486-4.458-4.457zm13.086 8.227v13.085h-3.656v15.542h-9.944v-15.54h-3.656V24.056c0-.572.2-1.057.6-1.457.4-.399.886-.6 1.456-.6h13.144c.533 0 1.01.2 1.428.6.417.4.628.886.628 1.457z"/><path d="M179.941 0c-8.839 0-16.341 3.085-22.513 9.258-6.285 6.4-9.43 13.981-9.43 22.742 0 8.762 3.145 16.284 9.43 22.57 6.36 6.286 13.864 9.43 22.513 9.43 8.8 0 16.437-3.182 22.913-9.545 6.096-5.98 9.144-13.464 9.144-22.455 0-8.952-3.106-16.532-9.314-22.742C196.512 3.086 188.929 0 179.94 0zm.114 5.771c7.238 0 13.41 2.553 18.513 7.657 5.103 5.106 7.657 11.294 7.657 18.57 0 7.391-2.514 13.506-7.543 18.344-5.295 5.22-11.506 7.828-18.63 7.828-7.161 0-13.332-2.59-18.513-7.772-5.18-5.178-7.77-11.31-7.77-18.396 0-7.047 2.609-13.238 7.829-18.572 5.029-5.104 11.18-7.659 18.457-7.659zM91.999 27.114c.609-3.924 2.189-6.962 4.742-9.114 2.552-2.152 5.656-3.228 9.314-3.228 5.027 0 9.029 1.62 12 4.856 2.97 3.238 4.457 7.391 4.457 12.457 0 4.915-1.543 9-4.627 12.256-3.088 3.256-7.086 4.886-12.002 4.886-3.62 0-6.743-1.085-9.371-3.257-2.63-2.172-4.21-5.257-4.743-9.257h8.059c.19 3.886 2.533 5.83 7.029 5.83 2.246 0 4.057-.973 5.428-2.915 1.373-1.942 2.059-4.534 2.059-7.77 0-3.392-.63-5.972-1.885-7.744-1.258-1.77-3.066-2.657-5.43-2.657-4.268 0-6.667 1.885-7.2 5.656h2.343l-6.342 6.343-6.343-6.343z"/><path d="M105.942 0c-8.8 0-16.304 3.105-22.513 9.316-6.285 6.4-9.43 13.963-9.43 22.686 0 8.763 3.145 16.283 9.43 22.568 6.36 6.286 13.864 9.43 22.513 9.43 8.836 0 16.476-3.162 22.913-9.486 6.096-6.057 9.144-13.56 9.144-22.514 0-8.952-3.106-16.514-9.314-22.686C122.474 3.104 114.893 0 105.942 0zm.114 5.771c7.275 0 13.446 2.57 18.513 7.715 5.103 5.028 7.657 11.201 7.657 18.514 0 7.353-2.514 13.468-7.543 18.344-5.295 5.219-11.506 7.828-18.63 7.828-7.161 0-13.332-2.59-18.513-7.772-5.18-5.143-7.77-11.275-7.77-18.4 0-7.046 2.609-13.218 7.829-18.514 5.029-5.143 11.18-7.715 18.457-7.715zM31.942 0C23.066 0 15.58 3.107 9.485 9.315 6.4 12.4 4.047 15.896 2.428 19.8A31.545 31.545 0 0 0 0 32.001c0 4.267.8 8.324 2.4 12.172 1.6 3.848 3.934 7.306 7 10.372 3.068 3.066 6.535 5.41 10.401 7.027A31.105 31.105 0 0 0 31.944 64c4.228 0 8.325-.817 12.286-2.455 3.963-1.638 7.506-4.003 10.63-7.088 3.007-2.933 5.284-6.315 6.827-10.143C63.228 40.487 64 36.382 64 32c0-4.343-.783-8.448-2.344-12.315-1.562-3.866-3.847-7.306-6.855-10.315C48.515 3.124 40.894 0 31.942 0zm.116 5.772c7.238 0 13.428 2.572 18.574 7.715 2.474 2.478 4.36 5.297 5.653 8.459 1.295 3.162 1.943 6.514 1.943 10.057 0 7.354-2.494 13.468-7.484 18.344-2.592 2.514-5.494 4.437-8.713 5.772a25.828 25.828 0 0 1-9.973 1.998c-3.467 0-6.783-.657-9.944-1.97-3.164-1.317-6-3.22-8.514-5.716-2.515-2.495-4.448-5.333-5.8-8.516a25.046 25.046 0 0 1-2.03-9.912c0-3.467.675-6.792 2.03-9.973 1.351-3.181 3.285-6.047 5.8-8.6 4.991-5.104 11.143-7.658 18.458-7.658z"/><path d="m50.115 26.688-4.23 2.229c-.457-.951-1.02-1.62-1.686-2-.668-.38-1.307-.571-1.914-.571-2.857 0-4.287 1.885-4.287 5.657 0 1.714.363 3.084 1.086 4.113.723 1.03 1.79 1.544 3.201 1.544 1.865 0 3.18-.915 3.941-2.743l4 2c-.874 1.563-2.057 2.791-3.54 3.686a9.234 9.234 0 0 1-4.858 1.343c-2.896 0-5.209-.875-6.94-2.629-1.737-1.752-2.603-4.19-2.603-7.313 0-3.048.885-5.466 2.658-7.257 1.77-1.79 4.008-2.686 6.713-2.686 3.962-.002 6.783 1.54 8.459 4.627zm-18.458 0-4.287 2.229c-.458-.951-1.02-1.62-1.685-2-.667-.38-1.286-.571-1.858-.571-2.856 0-4.286 1.885-4.286 5.657 0 1.714.362 3.084 1.085 4.113.724 1.03 1.79 1.544 3.2 1.544 1.868 0 3.182-.915 3.945-2.743l3.942 2c-.838 1.563-2 2.791-3.486 3.686-1.484.896-3.123 1.343-4.914 1.343-2.857 0-5.163-.875-6.915-2.629-1.753-1.752-2.629-4.19-2.629-7.313 0-3.048.886-5.466 2.658-7.257 1.77-1.79 4.009-2.686 6.715-2.686 3.963-.002 6.8 1.54 8.515 4.627z"/></svg>',
			'feed'        => '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 256 256"><defs><linearGradient x1=".085" y1=".085" x2=".915" y2=".915" id="a"><stop offset="0" stop-color="#E3702D"/><stop offset=".107" stop-color="#EA7D31"/><stop offset=".35" stop-color="#F69537"/><stop offset=".5" stop-color="#FB9E3A"/><stop offset=".702" stop-color="#EA7C31"/><stop offset=".887" stop-color="#DE642B"/><stop offset="1" stop-color="#D95B29"/></linearGradient></defs><rect width="256" height="256" rx="55" ry="55" fill="#CC5D15"/><rect width="246" height="246" rx="50" ry="50" x="5" y="5" fill="#F49C52"/><rect width="236" height="236" rx="47" ry="47" x="10" y="10" fill="url(#a)"/><circle cx="68" cy="189" r="24" fill="#FFF"/><path d="M160 213h-34a82 82 0 0 0-82-82V97a116 116 0 0 1 116 116z" fill="#FFF"/><path d="M184 213A140 140 0 0 0 44 73V38a175 175 0 0 1 175 175z" fill="#FFF"/><script/></svg>',
			'search'      => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M98.687 88.602 73.012 62.929a4.368 4.368 0 0 0-1.902-1.111c4.552-6.39 7.252-14.19 7.252-22.639C78.362 17.545 60.816 0 39.182 0 17.545 0 0 17.545 0 39.18c0 21.633 17.546 39.178 39.181 39.178 8.45 0 16.25-2.7 22.654-7.251.2.72.57 1.36 1.104 1.902l25.675 25.673c2.144 2.144 6.112 1.617 8.897-1.176 2.786-2.785 3.313-6.76 1.176-8.904zM39.18 64.112c-13.763 0-24.933-11.17-24.933-24.933 0-13.762 11.17-24.932 24.933-24.932 13.764 0 24.934 11.17 24.934 24.932 0 13.763-11.17 24.932-24.934 24.932z"/></svg>',
		);

		$svg = '';

		if ( array_key_exists( $icon_name, $icons ) ) {
			$classes     = esc_html( $svg_classes );
			$icon        = $icons [ $icon_name ];
			$replacement = '<svg class="' . $classes . '" ';
			$svg         = preg_replace( '/^<svg /', $replacement, $icon );
		}

		return $svg;
	}
}

if ( ! function_exists( 'apcom_get_posts_count' ) ) {
	/**
	 * Get the total of posts for the current page.
	 *
	 * The blog index will show the total of published posts meanwhile an
	 * archive page will show the total of published posts for this archive
	 * page.
	 *
	 * @since  1.2.0
	 *
	 * @param int $page_id A page ID to identify the caller.
	 * @return int $total_posts The total of posts.
	 */
	function apcom_get_posts_count( $page_id ) {
		$total_posts = 0;

		if ( $page_id && apcom_is_cpt( $page_id ) ) {
			if ( ! apcom_is_article_cpt( $page_id ) ) {
				$meta_id  = get_the_ID();
				$meta_key = null;

				if ( apcom_is_thematic_cpt() ) {
					$meta_key = 'posts_in_thematic';
				}

				if ( apcom_is_subject_cpt() ) {
					$meta_key = 'posts_in_subject';
				}

				if ( $meta_key ) {
					$query       = new WP_Query(
						array(
							'post_type'         => array( 'post', 'article' ),
							'post_status'       => 'publish',
							'posts_per_page'    => -1,
							'meta_query'        => array( // phpcs:ignore WordPress.DB.SlowDBQuery
								array(
									'key'     => $meta_key,
									'value'   => $meta_id,
									'compare' => 'LIKE',
								),
							),
						)
					);
					$total_posts = $query->found_posts;
					wp_reset_postdata();
				}
			}
		} else {
			if ( is_archive() || ! $page_id ) {
				$total_posts = $GLOBALS['wp_query']->found_posts;
			}

			if ( is_home() && ! is_front_page() ) {
				$posts_count   = wp_count_posts( 'post', 'readable' )->publish;
				$article_count = post_type_exists( 'article', 'readable' ) ? wp_count_posts( 'article' )->publish : 0;
				$total_posts   = intval( $posts_count ) + intval( $article_count );
			}
		}

		return $total_posts;
	}
}

if ( ! function_exists( 'apcom_get_page_classes' ) ) {
	/**
	 * Define classes for current page.
	 *
	 * @since  1.2.0
	 *
	 * @return string $classes The page classes.
	 */
	function apcom_get_page_classes() {
		$post    = get_post();
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

		if ( apcom_is_listing_page() ) {
			$classes .= ' page--is-listing';
		}

		if ( apcom_is_contact_page() ) {
			$classes .= ' page--is-contact';
		}

		if ( apcom_is_cv_page() ) {
			$classes .= ' page--is-cv';
		}

		if ( is_singular() && apcom_is_article_cpt() ) {
			$classes .= ' page--is-article';
		}

		if ( is_singular() && apcom_is_project_cpt() ) {
			$classes .= ' page--is-project';
		}

		if ( is_singular() && apcom_is_subject_cpt() ) {
			$classes .= ' page--is-subject';
		}

		if ( is_singular() && apcom_is_thematic_cpt() ) {
			$classes .= ' page--is-thematic';
		}

		if ( apcom_is_paginated_post() ) {
			$classes .= ' page--is-paginated';
		}

		if ( is_singular() && has_post_thumbnail( $post ) && ! is_attachment( $post ) ) {
			$classes .= ' page--has-thumbnail';
		}

		if ( is_singular() && has_block( 'code' ) ) {
			$classes .= ' page--has-code';
		}

		$comment_count = get_comments_number( $post );
		if ( ( is_page() || is_single() ) && ( true === comments_open() || $comment_count > 0 ) ) {
			$classes .= ' page--has-comments';
		}

		if ( is_404() || apcom_is_search_has_results() === false ) {
			$classes .= ' page--has-no-results';
		}

		if ( ( apcom_is_single_page() && ! apcom_is_cv_page() && ! apcom_is_contact_page() ) && ! apcom_is_frontpage() && ! apcom_is_page_no_sidebar() && is_active_sidebar( 'sidebar__pages-widgets' ) ) {
			$classes .= ' page--has-sidebar';
		}

		if ( apcom_is_contact_page() && is_active_sidebar( 'sidebar__contact-widgets' ) ) {
			$classes .= ' page--has-sidebar';
		}

		if ( apcom_is_cv_page() && is_active_sidebar( 'sidebar__cv-widgets' ) ) {
			$classes .= ' page--has-sidebar';
		}

		if ( apcom_is_listing_page() && ( is_active_sidebar( 'sidebar__blog1' ) || is_active_sidebar( 'sidebar__blog2' ) ) ) {
			$classes .= ' page--has-sidebar';
		}

		return $classes;
	}
}

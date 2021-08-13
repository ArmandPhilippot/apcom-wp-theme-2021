<?php
/**
 * Overwrite default WordPress functions.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
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

/**
 * Overwrite default post classes.
 *
 * @since  0.0.1
 *
 * @param  array $classes An array of post class names.
 * @param  array $class An array of additional class names added to the post.
 * @param  int   $post_id The post ID.
 * @return array The custom post classes.
 */
function apcom_post_class( $classes, $class, $post_id ) {
	$post    = get_post( $post_id );
	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		$class = array();
	}

	$classes[] = 'article';
	$classes[] = 'article-' . $post->ID;

	if ( post_type_supports( $post->post_type, 'post-formats' ) ) {
		$post_format = get_post_format( $post->ID );

		if ( $post_format && ! is_wp_error( $post_format ) ) {
			$classes[] = 'format-' . sanitize_html_class( $post_format );
		} else {
			$classes[] = 'format-standard';
		}
	}

	if ( has_post_thumbnail( $post->ID ) && ! is_attachment( $post ) ) {
		$classes[] = 'has-post-thumbnail';
	}

	if ( is_sticky( $post->ID ) ) {
		if ( is_home() && ! is_paged() ) {
			$classes[] = 'sticky';
		} elseif ( is_admin() ) {
			$classes[] = 'status-sticky';
		}
	}

	return $classes;
}
add_filter( 'post_class', 'apcom_post_class', 10, 3 );

/**
 * Overwrite default menu item classes (`li`).
 *
 * @since  0.0.1
 *
 * @param  array  $classes Array of the CSS classes that are applied to the menu item's <li> element.
 * @param  object $item The current menu item.
 * @param  object $args An object of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return array  The custom menu item classes.
 */
function apcom_menu_css_class( $classes, $item, $args, $depth ) {
	if ( 'main-menu' === $args->theme_location ) {
		$class_name = 'main-nav__item';
	} else {
		$class_name = 'nav__item';
	}

	$classes[] = $class_name;

	if ( $depth > 0 ) {
		$classes[] = 'sub-menu__item';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'apcom_menu_css_class', 10, 4 );

/**
 * Add classes to menu items link.
 *
 * @since 0.0.1
 *
 * @param  array  $atts The HTML attributes applied to the menu item's <a> element, empty strings are ignored.
 * @param  object $item The current menu item.
 * @param  object $args An object of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return array  The custom classes for menu items link.
 */
function apcom_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( 'main-menu' === $args->theme_location ) {
		$class_name = 'main-nav__link';
	} else {
		$class_name = 'nav__link';
	}

	$atts['class'] = $class_name;

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'apcom_nav_menu_link_attributes', 10, 4 );

/**
 * Overwrite default more tag with styling and screen reader class.
 *
 * @since  0.0.1
 *
 * @return string "Continue reading" link.
 */
function apcom_content_more_link() {
	$link = sprintf(
		'<a href="%1$s" class="more-link" itemprop="url"><span class="more-link__body">%2$s</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="more-link__icon"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg></a>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf(
			// translators: %1$s + $3$s : screen reader wrapper. %2$s: Name of the current post.
			__( 'Continue reading %1$s%2$s%3$s', 'APCom' ),
			'<span class="screen-reader-text">',
			get_the_title(),
			'</span>'
		)
	);
	return $link;
}
add_filter( 'the_content_more_link', 'apcom_content_more_link' );

/**
 * Custom excerpt.
 *
 * Replace "[...]" with a "Continue reading" link with styling and screen reader
 * class.
 *
 * @since  0.0.1
 *
 * @param  string $output The default HTML markup for the more tag.
 * @return string "Continue reading" link.
 */
function apcom_excerpt_more_link( $output ) {
	$link = sprintf(
		'<a href="%1$s" class="more-link" itemprop="url"><span class="more-link__body">%2$s</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="more-link__icon"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg></a>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf(
			// translators: %1$s + $3$s : screen reader wrapper. %2$s: Name of the current post.
			__( 'Continue reading %1$s%2$s%3$s', 'APCom' ),
			'<span class="screen-reader-text">',
			get_the_title(),
			'</span>'
		)
	);
	return $output . $link;
}
add_filter( 'the_excerpt', 'apcom_excerpt_more_link' );

/**
 * Overwrite the default pagination template.
 *
 * @since  0.0.1
 *
 * @param  string $template The default template.
 * @param  string $class The class passed by the calling function.
 * @return string The custom template.
 */
function apcom_navigation_markup_template( $template, $class ) {
	$class ? $modifier = 'pagination--' . $class : $modifier = '';

	$template = '
	<nav class="pagination ' . $modifier . '" aria-labelledby="pagination__title">
		<h2 class="screen-reader-text" id="pagination__title">' . __( 'Pagination', 'APCom' ) . '</h2>
		%3$s
	</nav>';

	return $template;
}
add_filter( 'navigation_markup_template', 'apcom_navigation_markup_template', 10, 2 );

/**
 * Modify HTML markup for the submit button of comment form.
 *
 * @since  0.0.1
 *
 * @param  string $button HTML markup used to render the submit button.
 * @return string HTML output modified.
 */
function apcom_comment_form_submit_button( $button ) {
	$button =
	'<button class="comment-form__button" type="submit"><span class="button__body">' . __( 'Leave a comment', 'APCom' ) . '</span></button>';
	return $button;
}
add_filter( 'comment_form_submit_button', 'apcom_comment_form_submit_button' );

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

/**
 * Add article & project CPT to the main query.
 *
 * @since  0.0.2
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 * @return WP_Query The custom query.
 */
function apcom_add_cpt_to_query( $query ) {
	if ( ( $query->is_home() || $query->is_date() ) && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'article', 'project' ) );

		return $query;
	}
}
add_action( 'pre_get_posts', 'apcom_add_cpt_to_query' );

/**
 * Add article & project CPT to the main RSS feed.
 *
 * @since  0.0.2
 *
 * @param array $query_vars The array of requested query variables.
 * @return array The modified array of requested query variables.
 */
function apcom_feed_request( $query_vars ) {
	if ( isset( $query_vars['feed'] ) && ! isset( $query_vars['post_type'] ) ) {
		$query_vars['post_type'] = array( 'post', 'article', 'project' );
	}
	return $query_vars;
}
add_filter( 'request', 'apcom_feed_request' );

/**
 * Add article & project CPT to the recent posts.
 *
 * @since  0.0.2
 *
 * @param array $args An array of arguments used to retrieve the recent posts.
 * @return array The custom arguments
 */
function apcom_widget_posts_args_add_cpt( $args ) {
	$args['post_type'] = array( 'post', 'article', 'project' );
	return $args;
}
add_filter( 'widget_posts_args', 'apcom_widget_posts_args_add_cpt' );

/**
 * Add article & project CPT to the WHERE clause for retrieving archives.
 *
 * @since  0.0.2
 *
 * @param string $sql_where Portion of SQL query containing the WHERE clause.
 * @return string The custom where clause.
 */
function apcom_getarchives_where( $sql_where ) {
	$sql_where = str_replace( "post_type = 'post'", "post_type IN ( 'post', 'article', 'project' )", $sql_where );
	return $sql_where;
}
add_filter( 'getarchives_where', 'apcom_getarchives_where' );

/**
 * Add async/defer attributes to enqueued scripts.
 *
 * @since  1.2.0
 *
 * @param  string $tag The <script> tag for the enqueued script.
 * @param  string $handle The script's registered handle.
 * @return string  $tag The modified script tag.
 */
function apcom_add_async_defer_attributes( $tag, $handle ) {
	if ( is_admin() ) {
		return $tag;
	}

	if ( strpos( $handle, 'async' ) !== false ) {
		$tag = str_replace( '<script ', '<script async ', $tag );
	}

	if ( strpos( $handle, 'defer' ) !== false ) {
		$tag = str_replace( '<script ', '<script defer ', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'apcom_add_async_defer_attributes', 10, 2 );

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

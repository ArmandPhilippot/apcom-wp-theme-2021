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

	if ( is_search() || is_404() ) {
		$classes[] = 'search';
	}

	if ( is_404() || apcom_is_search_has_results() === false ) {
		$classes[] = 'no-results';
	}

	if ( is_author() ) {
		$classes[] = 'author';
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
		'<a href="%1$s" class="more-link" itemprop="url"><span class="more-link__body">%2$s</span></a>',
		esc_url( get_permalink( get_the_ID() ) ),
		// translators: %s: Name of the current post.
		sprintf( __( 'Continue reading %s', 'APCom' ), the_title( '<span class="screen-reader-text">', '</span>', false ) )
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
		'<a href="%1$s" class="more-link" itemprop="url"><span class="more-link__body">%2$s</span></a>',
		esc_url( get_permalink( get_the_ID() ) ),
		// translators: %s: Name of the current post.
		sprintf( __( 'Continue reading %s', 'APCom' ), the_title( '<span class="screen-reader-text">', '</span>', false ) )
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
	<nav class="pagination ' . $modifier . ' box">
		<h2 class="screen-reader-text">%2$s</h2>
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
	'<button class="comment-form__submit button" type="submit"><span class="button__body">' . __( 'Leave a comment', 'APCom' ) . '</span></button>';
	return $button;
}
add_filter( 'comment_form_submit_button', 'apcom_comment_form_submit_button' );

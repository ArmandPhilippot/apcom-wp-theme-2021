<?php
/**
 * Hooks related to posts.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

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

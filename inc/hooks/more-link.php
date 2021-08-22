<?php
/**
 * Hooks related to more-link.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from hooks.php
 */

/**
 * Overwrite default more tag with styling and screen reader class.
 *
 * @since  0.0.1
 *
 * @return string "Continue reading" link.
 */
function apcom_content_more_link() {
	$link = sprintf(
		'<a href="%1$s" class="more-link btn btn--secondary" itemprop="url"><span class="more-link__body btn__body">%2$s</span>' . apcom_get_svg_icon( 'arrow_right', 'btn__icon' ) . '</a>',
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
		'<a href="%1$s" class="more-link btn btn--secondary" itemprop="url"><span class="more-link__body btn__body">%2$s</span>' . apcom_get_svg_icon( 'arrow_right', 'btn__icon' ) . '</a>',
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

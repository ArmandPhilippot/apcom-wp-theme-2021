<?php
/**
 * Hooks related to body tag.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Overwrite default body classes.
 *
 * @since  0.0.1
 * @since  1.2.0 Move most of classes (modifiers) to page.
 *
 * @param  array $classes An array of body class names.
 * @return array The custom body classes.
 */
function apcom_body_class( $classes ) {
	$classes   = array();
	$classes[] = 'body';

	if ( is_rtl() ) {
		$classes[] = 'body--is-rtl';
	}

	if ( is_user_logged_in() ) {
		$classes[] = 'body--is-logged-in';
	}

	if ( is_admin_bar_showing() ) {
		$classes[] = 'body--has-admin-bar';
		$classes[] = 'no-customize-support';
	}

	return $classes;
}
add_filter( 'body_class', 'apcom_body_class' );

<?php
/**
 * Hooks related to pagination.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

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
		<h2 class="pagination__title screen-reader-text" id="pagination__title">' . __( 'Pagination', 'APCom' ) . '</h2>
		%3$s
	</nav>';

	return $template;
}
add_filter( 'navigation_markup_template', 'apcom_navigation_markup_template', 10, 2 );

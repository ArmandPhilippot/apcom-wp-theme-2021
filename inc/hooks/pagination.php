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

/**
 * Add classes to paginated links output.
 *
 * @param string $r HTML output.
 * @return string $link The link with custom classes.
 */
function apcom_paginate_links_output( $r ) {
	$list_classes      = 'pagination__list';
	$items_classes     = 'pagination__item';
	$current_classes   = 'pagination__link pagination__link--current';
	$dots_classes      = 'pagination__link pagination__link--dots';
	$prev_link_classes = 'pagination__link btn btn--secondary btn--previous';
	$next_link_classes = 'pagination__link btn btn--secondary btn--next';
	$links_classes     = 'pagination__link btn btn--secondary';

	$r = preg_replace( '/<ul class=\'page-numbers\'>/', '<ul class="' . $list_classes . '">', $r );
	$r = preg_replace( '/<li>/', '<li class="' . $items_classes . '">', $r );
	$r = preg_replace( '/prev page-numbers/', $prev_link_classes, $r );
	$r = preg_replace( '/next page-numbers/', $next_link_classes, $r );
	$r = preg_replace( '/page-numbers current/', $current_classes, $r );
	$r = preg_replace( '/page-numbers dots/', $dots_classes, $r );
	$r = preg_replace( '/<a class="page-numbers/', '<a class="' . $links_classes, $r );

	return $r;
}
add_filter( 'paginate_links_output', 'apcom_paginate_links_output', 10, 1 );

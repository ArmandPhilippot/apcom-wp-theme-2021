<?php
/**
 * Hooks related to nav.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from hooks.php
 */

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

<?php
/**
 * The template for displaying nav in footer.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( has_nav_menu( 'footer-menu' ) ) {
	wp_nav_menu(
		array(
			'menu_class'      => 'nav__list',
			'container'       => 'nav',
			'container_class' => 'footer__nav',
			'theme_location'  => 'footer-menu',
			'item_spacing'    => 'discard',
		)
	);
}

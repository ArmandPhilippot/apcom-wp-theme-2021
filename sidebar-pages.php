<?php
/**
 * The template for displaying the articles and pages sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__pages-widgets' ) ) {
	dynamic_sidebar( 'sidebar__pages-widgets' );
}

<?php
/**
 * The template for displaying the blog sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__blog' ) ) {
	dynamic_sidebar( 'sidebar__blog' );
}

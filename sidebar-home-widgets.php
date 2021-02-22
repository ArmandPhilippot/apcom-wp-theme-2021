<?php
/**
 * The template for displaying the widgets below front-page content.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__home-widgets' ) ) {
	?>
		<?php dynamic_sidebar( 'sidebar__home-widgets' ); ?>
	<?php
}

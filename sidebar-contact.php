<?php
/**
 * The template for displaying the contact page sidebar.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.2
 */

if ( is_active_sidebar( 'sidebar__contact-widgets' ) ) {
	?>
	<aside class="page__sidebar sidebar sidebar--last">
		<?php dynamic_sidebar( 'sidebar__contact-widgets' ); ?>
	</aside>
	<?php
}

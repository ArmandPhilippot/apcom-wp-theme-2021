<?php
/**
 * The template for displaying the contact page sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

if ( is_active_sidebar( 'sidebar__contact-widgets' ) ) {
	?>
	<section class="page__aside page__aside--last">
		<?php dynamic_sidebar( 'sidebar__contact-widgets' ); ?>
	</section>
	<?php
}

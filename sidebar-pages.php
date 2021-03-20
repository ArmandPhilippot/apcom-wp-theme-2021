<?php
/**
 * The template for displaying the articles and pages sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__pages-widgets' ) ) {
	?>
	<section class="page__aside page__aside--last">
		<?php dynamic_sidebar( 'sidebar__pages-widgets' ); ?>
	</section>
	<?php
}

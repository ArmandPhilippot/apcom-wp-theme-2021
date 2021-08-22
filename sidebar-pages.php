<?php
/**
 * The template for displaying the articles/pages sidebar.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

if ( is_active_sidebar( 'sidebar__pages-widgets' ) ) {
	?>
	<section class="sidebar sidebar--last">
		<?php dynamic_sidebar( 'sidebar__pages-widgets' ); ?>
	</section>
	<?php
}

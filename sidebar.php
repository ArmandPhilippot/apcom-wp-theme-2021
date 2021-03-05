<?php
/**
 * The template for displaying the blog sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__blog1' ) ) {
	?>
	<aside class="page__aside page__aside--first">
		<?php dynamic_sidebar( 'sidebar__blog1' ); ?>
	</aside>
	<?php
}
if ( is_active_sidebar( 'sidebar__blog2' ) ) {
	?>
	<aside class="page__aside page__aside--last">
		<?php dynamic_sidebar( 'sidebar__blog2' ); ?>
	</aside>
	<?php
}

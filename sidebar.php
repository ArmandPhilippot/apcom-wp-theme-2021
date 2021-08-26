<?php
/**
 * The template for displaying the blog sidebar.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

if ( is_active_sidebar( 'sidebar__blog1' ) ) {
	?>
	<aside class="page__sidebar sidebar sidebar--first">
		<?php dynamic_sidebar( 'sidebar__blog1' ); ?>
	</aside>
	<?php
}

if ( is_active_sidebar( 'sidebar__blog2' ) ) {
	?>
	<aside class="page__sidebar sidebar sidebar--last">
		<h2><?php esc_html_e( 'Filter articles by:', 'APCom' ); ?></h2>
		<?php dynamic_sidebar( 'sidebar__blog2' ); ?>
	</aside>
	<?php
}

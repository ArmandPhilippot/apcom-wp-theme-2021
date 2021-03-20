<?php
/**
 * The template for displaying the blog sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( is_active_sidebar( 'sidebar__blog1' ) ) {
	?>
	<section class="page__aside page__aside--first">
		<?php dynamic_sidebar( 'sidebar__blog1' ); ?>
	</section>
	<?php
}
if ( is_active_sidebar( 'sidebar__blog2' ) ) {
	?>
	<section class="page__aside page__aside--last">
		<h2><?php esc_html_e( 'Filter articles by:', 'APCom' ); ?></h2>
		<?php dynamic_sidebar( 'sidebar__blog2' ); ?>
	</section>
	<?php
}

<?php
/**
 * The template for displaying the CV sidebar.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

if ( is_active_sidebar( 'sidebar__cv-widgets' ) ) {
	?>
	<section class="page__aside page__aside--last">
		<h2><?php esc_html_e( 'In addition', 'APCom' ); ?></h2>
		<?php dynamic_sidebar( 'sidebar__cv-widgets' ); ?>
	</section>
	<?php
}

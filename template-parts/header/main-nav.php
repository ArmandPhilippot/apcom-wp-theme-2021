<?php
/**
 * The template for displaying main-nav in header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<nav class="main-nav" aria-label="<?php esc_attr_e( 'Main', 'APCom' ); ?>">
	<?php
	wp_nav_menu(
		array(
			'menu_class'      => 'main-nav__list',
			'container'       => '',
			'theme_location'  => 'main-menu',
			'item_spacing'    => 'discard',
			'link_before'     => '<span>',
			'link_after'      => '</span>',
		)
	);
	?>
</nav>

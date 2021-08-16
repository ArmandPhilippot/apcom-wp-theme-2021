<?php
/**
 * The template for displaying main-nav in header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<nav class="header__nav main-nav" aria-label="<?php esc_attr_e( 'Main', 'APCom' ); ?>">
	<?php
	if ( has_nav_menu( 'main-menu' ) ) {
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
	} else {
		wp_page_menu(
			array(
				'menu_class'      => 'main-nav__list main-nav__list--page-menu',
				'container'       => 'ul',
				'item_spacing'    => 'discard',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'before'          => '',
				'after'           => '',
			)
		);
	}
	?>
</nav>

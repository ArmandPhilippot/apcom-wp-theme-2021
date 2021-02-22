<?php
/**
 * The template for displaying main-nav in header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

$apcom_search  = '<li id="menu-item__search" class="menu-item search">';
$apcom_search .= '<input type="checkbox" name="search__checkbox" id="search__checkbox" class="search__checkbox">';
$apcom_search .= '<label for="search__checkbox" class="search__label">';
$apcom_search .= '<span class="search__icon">';
$apcom_search .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.853 17.438l-3.604-3.604a.613.613 0 00-.267-.156A5.457 5.457 0 0016 10.5a5.5 5.5 0 10-5.5 5.5 5.468 5.468 0 003.18-1.018c.028.101.08.191.155.267l3.604 3.604c.301.301.858.227 1.249-.165.391-.391.465-.949.165-1.25zM10.5 14C8.568 14 7 12.432 7 10.5S8.568 7 10.5 7 14 8.568 14 10.5 12.432 14 10.5 14z" /></svg>';
$apcom_search .= '</span>';
$apcom_search .= '<span class="search__label--open screen-reader-text">';
$apcom_search .= esc_html__( 'Open search', 'APCom' );
$apcom_search .= '</span>';
$apcom_search .= '<span class="search__label--close screen-reader-text">';
$apcom_search .= esc_html__( 'Close search', 'APCom' );
$apcom_search .= '</span>';
$apcom_search .= '</label>';
$apcom_search .= get_search_form( false );
$apcom_search .= '</li>';
?>
<nav class="main-nav">
	<?php
	wp_nav_menu(
		array(
			'menu_class'      => 'main-nav__list',
			'container'       => '',
			'theme_location'  => 'main-menu',
			'item_spacing'    => 'discard',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s' . $apcom_search . '</ul>',
		)
	);
	?>
</nav>

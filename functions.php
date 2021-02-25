<?php
/**
 * ArmandPhilippot-com functions and definitions.
 *
 * This file is read by WordPress to setup the theme and his additional
 * features.
 *
 * @package ArmandPhilippot-com
 * @link https://github.com/ArmandPhilippot/armandphilippot.com
 * @author Armand Philippot <contact@armandphilippot.com>
 *
 * @copyright 2020 Armand Philippot
 * @license GPL-2.0-or-later
 * @since 0.0.1
 */

/**
 * Currently theme version.
 */
define( 'APCOM_VERSION', '0.0.1' );

if ( ! function_exists( 'apcom_setup' ) ) {
	/**
	 * Setup ArmandPhilippot-com theme and registers support for various WordPress features.
	 *
	 * @since 0.0.1
	 */
	function apcom_setup() {
		load_textdomain( 'APCom', get_template_directory() . '/languages' );

		add_theme_support( 'align-wide' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 150,
				'height'      => 150,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'html5',
			array(
				'caption',
				'comment-form',
				'comment-list',
				'gallery',
				'script',
				'search-form',
				'style',
			)
		);
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'audio',
				'gallery',
				'image',
				'link',
				'quote',
				'video',
			)
		);
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'title-tag' );

		register_nav_menus(
			array(
				'main-menu'   => __( 'Main menu', 'APCom' ),
				'footer-menu' => __( 'Footer menu', 'APCom' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'apcom_setup' );

/**
 * Register and enqueue styles.
 *
 * @since 0.0.1
 */
function apcom_enqueue_styles() {
	$theme_uri          = get_template_directory_uri();
	$theme_directory    = get_template_directory();
	$style_path         = $theme_directory . '/style.min.css';
	$print_style_path   = $theme_directory . '/print.min.css';
	$vendors_style_path = $theme_directory . '/assets/css/vendors.min.css';

	if ( file_exists( $vendors_style_path ) ) {
		wp_register_style( 'apcom-style-vendors', $theme_uri . '/assets/css/vendors.min.css', array(), APCOM_VERSION );
		wp_enqueue_style( 'apcom-style-vendors' );
	}

	if ( file_exists( $style_path ) ) {
		wp_register_style( 'apcom-style', $theme_uri . '/style.min.css', array(), APCOM_VERSION );
		wp_enqueue_style( 'apcom-style' );
		wp_style_add_data( 'apcom-style', 'rtl', 'replace' );
	}

	if ( file_exists( $print_style_path ) ) {
		wp_register_style( 'apcom-style-print', $theme_uri . '/print.min.css', array(), APCOM_VERSION );
		wp_enqueue_style( 'apcom-style-print' );
	}
}
add_action( 'wp_enqueue_scripts', 'apcom_enqueue_styles' );

/**
 * Register and enqueue scripts.
 *
 * @since 0.0.1
 */
function apcom_enqueue_scripts() {
	$theme_uri            = get_template_directory_uri();
	$theme_directory      = get_template_directory();
	$scripts_path         = $theme_directory . '/assets/js/scripts.min.js';
	$vendors_scripts_path = $theme_directory . '/assets/js/vendors.min.js';

	if ( file_exists( $scripts_path ) ) {
		wp_register_script( 'apcom-scripts', $theme_uri . '/assets/js/scripts.min.js', array(), APCOM_VERSION, true );
		wp_enqueue_script( 'apcom-scripts' );
	}

	if ( file_exists( $vendors_scripts_path ) ) {
		wp_register_script( 'vendors-scripts', $theme_uri . '/assets/js/vendors.min.js', array(), APCOM_VERSION, true );
		wp_enqueue_script( 'vendors-scripts' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'apcom_enqueue_scripts' );

/**
 * Register and enqueue editor styles.
 *
 * @since 0.0.1
 */
function apcom_enqueue_editor_styles() {
	$theme_uri         = get_template_directory_uri();
	$theme_directory   = get_template_directory();
	$style_editor_path = $theme_directory . '/assets/css/style-editor.min.css';

	if ( file_exists( $style_editor_path ) ) {
		wp_register_style( 'apcom-block-editor-styles', $theme_uri . '/assets/css/style-editor.min.css', array(), APCOM_VERSION );
		wp_enqueue_style( 'apcom-block-editor-styles' );
	}
}
add_action( 'enqueue_block_editor_assets', 'apcom_enqueue_editor_styles' );

/**
 * Register sidebars.
 *
 * @since 0.0.2
 */
function apcom_widgets_init() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar(
			array(
				'name'          => __( 'Blog Sidebar', 'APCom' ),
				'id'            => 'sidebar__blog',
				'description'   => __( 'Add widgets here to appear in your blog sidebar.', 'APCom' ),
				'before_title'  => '<h2 class="widget__title">',
				'after_title'   => '</h2>',
				'before_widget' => '<div id="%1s" class="widget %2s box">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Home Widgets', 'APCom' ),
				'id'            => 'sidebar__home-widgets',
				'description'   => __( 'Add widgets here to appear below the front-page content.', 'APCom' ),
				'before_title'  => '<h2 class="widget__title">',
				'after_title'   => '</h2>',
				'before_widget' => '<div id="%1s" class="widget %2s box">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Articles & Pages Widgets', 'APCom' ),
				'id'            => 'sidebar__pages-widgets',
				'description'   => __( 'Add widgets here to appear below the articles and pages.', 'APCom' ),
				'before_title'  => '<h2 class="widget__title">',
				'after_title'   => '</h2>',
				'before_widget' => '<div id="%1s" class="widget %2s box">',
				'after_widget'  => '</div>',
			)
		);
	}
}
add_action( 'widgets_init', 'apcom_widgets_init' );

/**
 * REQUIRED FILES
 * Additional features and helpers functions.
 */
require get_parent_theme_file_path( '/inc/helpers.php' );
require get_parent_theme_file_path( '/inc/hooks.php' );
require get_parent_theme_file_path( 'inc/class-custom-walker-comment.php' );

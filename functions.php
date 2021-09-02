<?php
/**
 * ArmandPhilippot-com functions and definitions.
 *
 * This file is read by WordPress to setup the theme and his additional
 * features.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package   ArmandPhilippot-com
 * @author    Armand Philippot <contact@armandphilippot.com>
 * @copyright 2020 Armand Philippot
 * @license   GPL-2.0-or-later
 * @since     0.0.1
 */

/**
 * Currently theme version.
 */
define( 'APCOM_VERSION', '1.2.4' );

/**
 * Get current environment defined in .env file.
 *
 * @since 1.2.0
 *
 * @return string Current env or empty string.
 */
function apcom_get_current_env() {
	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
		$apcom_dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
		$apcom_dotenv->safeLoad();
		$apcom_current_env = $_ENV['WP_THEME_ENV'];
		return $apcom_current_env;
	} else {
		return '';
	}
}


if ( ! function_exists( 'apcom_setup' ) ) {
	/**
	 * Setup ArmandPhilippot-com theme and registers support for various WordPress features.
	 *
	 * @since 0.0.1
	 */
	function apcom_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'APCom', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add support for custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 150,
				'height'      => 150,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		$editor_css_path = get_template_directory() . '/assets/css/editor-style.css';
		add_editor_style( $editor_css_path );

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'caption',
				'comment-form',
				'comment-list',
				'gallery',
				'navigation-widgets',
				'script',
				'search-form',
				'style',
			)
		);

		// Add post-formats support.
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'audio',
				'chat',
				'gallery',
				'image',
				'link',
				'quote',
				'status',
				'video',
			)
		);

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Register custom menu.
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
	$current_env = apcom_get_current_env();
	$style_path  = get_template_directory() . '/style.css';
	$style_uri   = get_template_directory_uri() . '/style.css';
	$print_path  = get_template_directory() . '/assets/css/print.css';
	$print_uri   = get_template_directory_uri() . '/assets/css/print.css';

	if ( 'development' !== $current_env ) {
		if ( file_exists( $style_path ) ) {
			wp_register_style( 'apcom-style', $style_uri, array(), APCOM_VERSION );
			wp_enqueue_style( 'apcom-style' );
			wp_style_add_data( 'apcom-style', 'rtl', 'replace' );
		}

		if ( file_exists( $print_path ) ) {
			wp_register_style( 'apcom-print', $print_uri, array(), APCOM_VERSION );
			wp_enqueue_style( 'apcom-print' );
			wp_style_add_data( 'apcom-print', 'rtl', 'replace' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'apcom_enqueue_styles' );

/**
 * Register and enqueue scripts.
 *
 * @since 0.0.1
 */
function apcom_enqueue_scripts() {
	$current_env          = apcom_get_current_env();
	$webpack_runtime_path = get_template_directory() . '/assets/webpack/runtime.js';
	$webpack_runtime_uri  = get_template_directory_uri() . '/assets/webpack/runtime.js';
	$footer_scripts_path  = get_template_directory() . '/assets/js/footer.js';
	$footer_scripts_uri   = get_template_directory_uri() . '/assets/js/footer.js';
	$header_scripts_path  = get_template_directory() . '/assets/js/header.js';
	$header_scripts_uri   = get_template_directory_uri() . '/assets/js/header.js';

	$color_scheme_vars = array(
		'lightThemeText' => __( 'Switch to dark theme', 'APCom' ),
		'darkThemeText'  => __( 'Switch to light theme', 'APCom' ),
		'title'          => __( 'Switch theme', 'APCom' ),
	);

	$date_warning = array(
		'beAware'        => sprintf(
			// translators: %1$s Open HTML element. %2$s Closing HTML element.
			__( '%1$sWarning:%2$s', 'APCom' ),
			'<span class="modal__label">',
			'</span>'
		),
		'oldContent'     => __( 'This content has not been updated for over a year. It is possible that it is no longer valid.', 'APCom' ),
		'contentEvolved' => __( 'For example, my opinion may have evolved or the subject is no longer relevant (version has changed, software is dead...).', 'APCom' ),
	);

	$toc_args = array(
		'tocTitle'     => __( 'Table of contents', 'APCom' ),
	);

	if ( file_exists( $webpack_runtime_path ) ) {
		wp_register_script( 'apcom-webpack-runtime', $webpack_runtime_uri, array(), APCOM_VERSION, true );
		wp_enqueue_script( 'apcom-webpack-runtime' );
	}

	if ( file_exists( $footer_scripts_path ) ) {
		wp_register_script( 'apcom-defer-footer', $footer_scripts_uri, array(), APCOM_VERSION, true );
		wp_enqueue_script( 'apcom-defer-footer' );
		wp_localize_script( 'apcom-defer-footer', 'prism_vars', $color_scheme_vars );
		wp_localize_script( 'apcom-defer-footer', 'color_scheme_vars', $color_scheme_vars );
		wp_localize_script( 'apcom-defer-footer', 'date_warning', $date_warning );
		wp_localize_script( 'apcom-defer-footer', 'toc_args', $toc_args );
	}

	if ( file_exists( $header_scripts_path ) ) {
		wp_register_script( 'apcom-header', $header_scripts_uri, array(), APCOM_VERSION, false );
		wp_enqueue_script( 'apcom-header' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( 'development' === $current_env ) {
		$webpack_style_path = get_template_directory() . '/assets/webpack/style.js';
		$webpack_style_uri  = get_template_directory_uri() . '/assets/webpack/style.js';
		$webpack_print_path = get_template_directory() . '/assets/webpack/print.js';
		$webpack_print_uri  = get_template_directory_uri() . '/assets/webpack/print.js';

		if ( file_exists( $webpack_style_path ) ) {
			wp_register_script( 'apcom-webpack-style', $webpack_style_uri, array(), APCOM_VERSION, true );
			wp_enqueue_script( 'apcom-webpack-style' );
		}

		if ( file_exists( $webpack_print_path ) ) {
			wp_register_script( 'apcom-webpack-print', $webpack_print_uri, array(), APCOM_VERSION, true );
			wp_enqueue_script( 'apcom-webpack-print' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'apcom_enqueue_scripts' );

/**
 * Register and enqueue editor assets.
 *
 * @since 1.2.0
 */
function apcom_enqueue_editor_assets() {
	$current_env         = apcom_get_current_env();
	$editor_scripts_path = get_template_directory() . '/assets/js/editor.js';
	$editor_scripts_uri  = get_template_directory_uri() . '/assets/js/editor.js';

	if ( file_exists( $editor_scripts_path ) ) {
		wp_register_script( 'apcom-editor', $editor_scripts_uri, array(), APCOM_VERSION, true );
		wp_enqueue_script( 'apcom-editor' );
	}

	if ( 'development' === $current_env ) {
		$webpack_editor_path = get_template_directory() . '/assets/webpack/editor-style.js';
		$webpack_editor_uri  = get_template_directory_uri() . '/assets/webpack/editor-style.js';

		if ( file_exists( $webpack_editor_path ) ) {
			wp_register_script( 'apcom-webpack-editor', $webpack_editor_uri, array(), APCOM_VERSION, true );
			wp_enqueue_script( 'apcom-webpack-editor' );
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'apcom_enqueue_editor_assets' );

/**
 * Register sidebars.
 *
 * @since 0.0.1
 */
function apcom_widgets_init() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar(
			array(
				'name'          => __( 'Blog Sidebar - Left/First', 'APCom' ),
				'id'            => 'sidebar__blog1',
				'description'   => __( 'Add widgets here to appear in your blog sidebar (first on mobile view, left on large screens).', 'APCom' ),
				'before_title'  => '<h2 class="widget__title">',
				'after_title'   => '</h2>',
				'before_widget' => '<div id="%1s" class="widget %2s">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Blog Sidebar - Right/Last', 'APCom' ),
				'id'            => 'sidebar__blog2',
				'description'   => __( 'Add widgets here to appear in your blog sidebar(last on mobile view, right on large screens).', 'APCom' ),
				'before_title'  => '<h3 class="widget__title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div id="%1s" class="widget %2s">',
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
				'before_widget' => '<div id="%1s" class="widget %2s">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'CV Widgets', 'APCom' ),
				'id'            => 'sidebar__cv-widgets',
				'description'   => __( 'Add widgets here to appear below the CV page.', 'APCom' ),
				'before_title'  => '<h3 class="widget__title">',
				'after_title'   => '</h3>',
				'before_widget' => '<div id="%1s" class="widget %2s">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Contact Widgets', 'APCom' ),
				'id'            => 'sidebar__contact-widgets',
				'description'   => __( 'Add widgets here to appear below the Contact page.', 'APCom' ),
				'before_title'  => '<h2 class="widget__title">',
				'after_title'   => '</h2>',
				'before_widget' => '<div id="%1s" class="widget %2s">',
				'after_widget'  => '</div>',
			)
		);
	}
}
add_action( 'widgets_init', 'apcom_widgets_init' );

/**
 * Add custom favicon
 *
 * @since 1.0.0
 */
function apcom_favicon_links() {
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/apple-touch-icon.png' ) ) . '" />' . "\n";
	echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/favicon-32x32.png' ) ) . '" />' . "\n";
	echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/favicon-16x16.png' ) ) . '" />' . "\n";
	echo '<link rel="manifest" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/site.webmanifest' ) ) . '" />' . "\n";
	echo '<link rel="mask-icon" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/safari-pinned-tab.svg' ) ) . '" color="#194476" />' . "\n";
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_theme_file_uri( '/assets/images/favicon/favicon.ico' ) ) . '" />' . "\n";
	echo '<meta name="msapplication-TileColor" content="#194476">' . "\n";
	echo '<meta name="msapplication-config" content="' . esc_url( get_theme_file_uri( '/assets/images/favicon/browserconfig.xml' ) ) . '">' . "\n";
	echo '<meta name="theme-color" content="#194476">' . "\n";
}
add_action( 'wp_head', 'apcom_favicon_links' );
add_action( 'admin_head', 'apcom_favicon_links' );

/**
 * REQUIRED FILES
 * Additional features and helpers functions.
 */
require_once get_parent_theme_file_path( 'inc/helpers.php' );
require_once get_parent_theme_file_path( 'inc/hooks.php' );
require_once get_parent_theme_file_path( 'inc/class-custom-walker-comment.php' );
require_once get_parent_theme_file_path( 'inc/contact-form.php' );

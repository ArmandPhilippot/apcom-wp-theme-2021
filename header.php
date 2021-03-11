<?php
/**
 * The template for displaying the header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>
	<a href="#main" class="skip-link screen-reader-text">
		<?php esc_html_e( 'Skip to content', 'APCom' ); ?>
	</a>
	<header class="header" id="header">
		<?php
		get_template_part( 'template-parts/header/branding' );
		get_template_part( 'template-parts/header/main-nav' );
		get_template_part( 'template-parts/header/tools' );
		?>
	</header>
	<main class="main" id="main">
		<?php
		get_template_part( 'template-parts/main/breadcrumb' );

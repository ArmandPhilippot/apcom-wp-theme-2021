<?php
/**
 * The header template.
 *
 * This is the template that displays all of the <head> section and everything
 * up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>
	<a href="#main" class="skip-link screen-reader-text">
		<?php esc_html_e( 'Skip to content', 'APCom' ); ?>
	</a>
	<header id="header" class="header">
		<?php
		get_template_part( 'template-parts/header/site', 'branding' );
		get_template_part( 'template-parts/header/site', 'nav' );
		get_template_part( 'template-parts/header/site', 'toolbar' );
		?>
	</header>
	<main id="main" class="main">
		<?php
		if ( ! apcom_is_frontpage() ) {
			get_template_part( 'template-parts/header/site', 'breadcrumb' );
		}

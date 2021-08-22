<?php
/**
 * The branding template.
 *
 * Used to display branding in header template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

$apcom_title       = get_bloginfo( 'name' );
$apcom_title_tag   = apcom_is_frontpage() ? 'h1' : 'p';
$apcom_description = get_bloginfo( 'description' );
?>
<div class="header__branding branding" itemprop="publisher" itemscope itemtype="http://schema.org/Person">
	<?php if ( has_custom_logo() ) { ?>
		<div class="branding__logo logo logo--custom" itemprop="brand" itemscope itemtype="http://schema.org/Brand">
			<?php the_custom_logo(); ?>
		</div>
	<?php } else { ?>
		<div class="branding__logo logo logo--default" itemprop="brand" itemscope itemtype="http://schema.org/Brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo__link" rel="home">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/armand-philippot.jpg'; ?>" alt="<?php esc_html_e( 'Back to Armand Philippot homepage', 'APCom' ); ?>" class="logo__image logo__image--front" itemprop="image">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/armand-philippot-logo.svg'; ?>" alt="<?php esc_html_e( 'Back to Armand Philippot homepage', 'APCom' ); ?>" class="logo__image logo__image--back" itemprop="logo">
			</a>
		</div>
	<?php } ?>
	<<?php echo esc_attr( $apcom_title_tag ); ?> class="branding__title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="name" class="branding__link">
			<?php echo esc_html( $apcom_title ); ?>
		</a>
	</<?php echo esc_attr( $apcom_title_tag ); ?>>
	<p class="branding__baseline" itemprop="jobTitle">
		<?php echo esc_html( $apcom_description ); ?>
	</p>
</div>

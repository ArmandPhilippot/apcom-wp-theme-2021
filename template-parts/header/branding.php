<?php
/**
 * The template part for displaying branding in header.
 *
 * Used to display website name, baseline and logo.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( apcom_is_frontpage() ) {
	$apcom_title_tag = 'h1';
} else {
	$apcom_title_tag = 'p';
}
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
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
		</a>
	</<?php echo esc_attr( $apcom_title_tag ); ?>>
	<p class="branding__baseline" itemprop="jobTitle">
		<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
	</p>
</div>

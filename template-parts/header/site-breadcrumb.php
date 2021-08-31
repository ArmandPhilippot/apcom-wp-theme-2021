<?php
/**
 * The breadcrumb template.
 *
 * Used to display breadcrumb in header template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

$apcom_breadcrumb        = apcom_get_breadcrumb();
$apcom_breadcrumb_length = count( $apcom_breadcrumb );
?>
<nav class="breadcrumb" itemprop="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'APCom' ); ?>">
	<span class="screen-reader-text">
		<?php esc_html_e( 'You are here:', 'APCom' ); ?>
	</span>
	<ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
		<?php
		foreach ( $apcom_breadcrumb as $apcom_depth => $apcom_data ) {
			?>
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb__item">
				<?php
				if ( $apcom_depth === $apcom_breadcrumb_length ) {
					?>
					<span itemprop="name" class="breadcrumb__body" aria-current="location">
						<?php echo wp_kses_post( $apcom_breadcrumb[ $apcom_depth ]['txt'] ); ?>
					</span>
					<?php
				} else {
					?>
					<a itemprop="item" class="breadcrumb__link" href="<?php echo esc_url( $apcom_breadcrumb[ $apcom_depth ]['url'] ); ?>">
						<span itemprop="name" class="breadcrumb__body">
							<?php echo wp_kses_post( $apcom_breadcrumb[ $apcom_depth ]['txt'] ); ?>
						</span>
					</a>
					<?php
				}
				?>
				<meta itemprop="position" content="<?php echo esc_attr( $apcom_depth ); ?>" />
			</li>
			<?php
		}
		?>
	</ol>
</nav>

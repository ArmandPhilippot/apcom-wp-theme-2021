<?php
/**
 * The copyright template.
 *
 * Used for displaying copyright in footer template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

$apcom_title           = get_bloginfo( 'name' );
$apcom_older_post      = get_posts( 'numberposts=1&order=ASC' );
$apcom_older_post_year = mysql2date( 'Y', $apcom_older_post['0']->post_date );
$apcom_current_year    = date_i18n( 'Y' );
$apcom_copyright_date  = '<span itemprop="copyrightYear">' . $apcom_older_post_year . '</span>';

if ( $apcom_current_year !== $apcom_older_post_year ) {
	$apcom_copyright_date .= ' - ' . $apcom_current_year;
}
?>
<div class="footer__copyright copyright">
	<?php echo apcom_get_svg_icon( 'copyright', 'copyright__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<p class="copyright__body">
		<?php echo '<span itemprop="author creator editor" itemscope itemtype="http://schema.org/Person">' . esc_html( $apcom_title ) . '</span>. ' . wp_kses_post( $apcom_copyright_date ) . '.'; ?>
	</p>
</div>

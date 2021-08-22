<?php
/**
 * The back to top link template.
 *
 * Used for displaying copyright in footer template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

?>
<div id="back-to-top" class="back-to-top">
	<a href="#header" class="back-to-top__link btn btn--round">
		<span class="btn__body screen-reader-text">
			<?php esc_html_e( 'Back to top', 'APCom' ); ?>
		</span>
		<?php echo apcom_get_svg_icon( 'arrow_top', 'btn__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</a>
</div>

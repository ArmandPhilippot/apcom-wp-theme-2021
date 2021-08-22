<?php
/**
 * The search form template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

$apcom_unique_id  = esc_attr( uniqid( 'search-form-' ) );
$apcom_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . $args['aria_label'] . '"' : '';
?>
<form role="search" <?php echo esc_attr( $apcom_aria_label ); ?> method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form form--search">
	<label for="<?php echo esc_attr( $apcom_unique_id ); ?>" class="form__label screen-reader-text">
		<?php esc_html_e( 'Search for:', 'APCom' ); ?>
	</label>
	<input type="search" id="<?php echo esc_attr( $apcom_unique_id ); ?>" class="form__field" placeholder="<?php echo esc_attr_x( 'Keywords &hellip;', 'placeholder', 'APCom' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	<button type="submit" class="form__btn btn btn--primary">
		<span class="btn__body">
			<?php echo esc_html_x( 'Search', 'submit button', 'APCom' ); ?>
		</span>
		<?php echo apcom_get_svg_icon( 'search', 'btn__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</button>
</form>

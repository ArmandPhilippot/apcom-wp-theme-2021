<?php
/**
 * The search form template.
 *
 * Used any time that get_search_form() is called.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

$apcom_unique_id  = esc_attr( uniqid( 'search-form-' ) );
$apcom_aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
?>
<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form form--search">
	<label for="<?php echo esc_attr( $apcom_unique_id ); ?>" class="form__label screen-reader-text">
		<?php esc_html_e( 'Search for:', 'APCom' ); ?>
	</label>
	<input type="search" id="<?php echo esc_attr( $apcom_unique_id ); ?>" class="form__field" placeholder="<?php echo esc_attr_x( 'Keywords &hellip;', 'placeholder', 'APCom' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	<button type="submit" class="form__btn btn btn--primary">
		<span class="btn__body">
			<?php echo esc_html_x( 'Search', 'submit button', 'APCom' ); ?>
		</span>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="btn__icon" aria-hidden="true">
			<path d="M18.853 17.438l-3.604-3.604a.613.613 0 00-.267-.156A5.457 5.457 0 0016 10.5a5.5 5.5 0 10-5.5 5.5 5.468 5.468 0 003.18-1.018c.028.101.08.191.155.267l3.604 3.604c.301.301.858.227 1.249-.165.391-.391.465-.949.165-1.25zM10.5 14C8.568 14 7 12.432 7 10.5S8.568 7 10.5 7 14 8.568 14 10.5 12.432 14 10.5 14z" />
		</svg>
	</button>
</form>

<?php
/**
 * The toolbar template.
 *
 * Used to display toolbar in header template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

?>
<div class="header__toolbar toolbar" id="toolbar">
	<div class="toolbar__item toolbar__item--search" id="toolbar__search" title="<?php esc_attr_e( 'Search', 'APCom' ); ?>">
		<input type="checkbox" name="search__checkbox" id="search__checkbox" class="toolbar__checkbox toggle">
		<label for="search__checkbox" class="toolbar__btn btn btn--round">
			<?php echo apcom_get_svg_icon( 'search', 'btn__icon btn__icon--search' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span class="btn__body btn__body--inactivated screen-reader-text">
				<?php esc_html_e( 'Open search', 'APCom' ); ?>
			</span>
			<span class="btn__body btn__body--activated screen-reader-text">
				<?php esc_html_e( 'Close search', 'APCom' ); ?>
			</span>
		</label>
		<?php get_search_form(); ?>
	</div>
</div>

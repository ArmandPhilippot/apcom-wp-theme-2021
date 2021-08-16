<?php
/**
 * The template for displaying toolbar in header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<div class="header__toolbar toolbar" id="toolbar">
	<div class="toolbar__item search" id="toolbar__search" title="<?php esc_attr_e( 'Search', 'APCom' ); ?>">
		<input type="checkbox" name="search__checkbox" id="search__checkbox" class="toolbar__checkbox search__checkbox toggle">
		<label for="search__checkbox" class="toolbar__label toolbar__label--search search__label">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="toolbar__icon toolbar__icon--search search__icon" aria-hidden="true">
				<path d="M98.687 88.602L73.012 62.929a4.368 4.368 0 00-1.902-1.111c4.552-6.39 7.252-14.19 7.252-22.639C78.362 17.545 60.816 0 39.182 0 17.545 0 0 17.545 0 39.18c0 21.633 17.546 39.178 39.181 39.178 8.45 0 16.25-2.7 22.654-7.251.2.72.57 1.36 1.104 1.902l25.675 25.673c2.144 2.144 6.112 1.617 8.897-1.176 2.786-2.785 3.313-6.76 1.176-8.904zM39.18 64.112c-13.763 0-24.933-11.17-24.933-24.933 0-13.762 11.17-24.932 24.933-24.932 13.764 0 24.934 11.17 24.934 24.932 0 13.763-11.17 24.932-24.934 24.932z"/>
			</svg>
			<span class="toolbar__label--inactivated search__label--inactivated screen-reader-text">
				<?php esc_html_e( 'Open search', 'APCom' ); ?>
			</span>
			<span class="toolbar__label--activated search__label--activated screen-reader-text">
				<?php esc_html_e( 'Close search', 'APCom' ); ?>
			</span>
		</label>
		<?php get_search_form(); ?>
	</div>
</div>

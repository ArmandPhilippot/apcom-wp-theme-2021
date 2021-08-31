<?php
/**
 * The feed template displayed in page header.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from category.
 */

if ( is_category() ) {
	$apcom_page_title  = apcom_get_page_title();
	$apcom_category_id = get_cat_ID( $apcom_page_title );
	$apcom_feed_link   = get_category_feed_link( $apcom_category_id );
	?>
	<a href="<?php echo esc_url( $apcom_feed_link ); ?>" class="page__feed btn btn--feed">
		<?php
		printf(
			// translators: %s the page title.
			esc_html__( 'Subscribe to %s', 'APCom' ),
			esc_html( $apcom_page_title )
		);
		?>
	</a>
	<?php
}

<?php
/**
 * The meta template for website.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

$apcom_website_url = '';

if ( is_author() ) {
	$apcom_author_data = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$apcom_author_id   = $apcom_author_data->ID;
	$apcom_website_url = get_the_author_meta( 'user_url', $apcom_author_id );
} elseif ( apcom_is_subject_cpt() ) {
	$apcom_subject_website = get_post_meta( get_queried_object_id(), 'official_website' );
	$apcom_website_url     = $apcom_subject_website[0];
}

if ( $apcom_website_url && '' !== $apcom_website_url ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--website">
		<dt class="meta__term"><?php esc_html_e( 'Website:', 'APCom' ); ?></dt>
		<dd class="meta__description">
			<a href="<?php echo esc_url( $apcom_website_url ); ?>" class="website__link" itemprop="url">
				<?php echo esc_url( $apcom_website_url ); ?>
			</a>
		</dd>
	</div>
	<?php
}

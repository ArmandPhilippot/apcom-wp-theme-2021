<?php
/**
 * The page header template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Split page title and header meta in separated files.
 */

$apcom_page_id = get_queried_object_id();

if ( ! apcom_is_frontpage() ) {
	?>
	<header class="page__header">
		<h1 class="page__title" itemprop="headline name">
			<?php
			if ( $apcom_page_id && apcom_is_subject_cpt( $apcom_page_id ) ) {
				echo get_the_post_thumbnail( $apcom_page_id, 'post-thumbnail', array( 'class' => 'page__logo' ) );
			}
			echo esc_html( apcom_get_page_title() );
			?>
		</h1>
		<?php
		if ( ! apcom_is_contact_page() ) {
			get_template_part( 'template-parts/page/partials/header', 'meta', array( 'page_id' => $apcom_page_id ) );
			get_template_part( 'template-parts/page/partials/header', 'feed' );
		}
		if ( apcom_is_listing_page() && ! is_author() ) {
			get_template_part( 'template-parts/page/partials/intro', 'listing' );
		}
		if ( apcom_is_single_page() ) {
			get_template_part( 'template-parts/page/partials/intro', 'article' );
		}
		?>
	</header>
	<?php
}

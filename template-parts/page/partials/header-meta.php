<?php
/**
 * The meta template to display meta in page header.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.3 Splitted from page-header.
 */

$apcom_page_id = $args['page_id'];
?>
<dl class="page__meta meta">
	<?php
	if ( ! apcom_is_listing_page() ) {
		get_template_part( 'template-parts/page/partials/meta', 'date' );
	}

	if ( apcom_is_listing_page() || apcom_is_thematic_cpt( $apcom_page_id ) || apcom_is_subject_cpt( $apcom_page_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'posts-count', array( 'caller_id' => $apcom_page_id ) );
	}

	if ( is_singular( 'post' ) || is_page() || apcom_is_article_cpt( $apcom_page_id ) || apcom_is_project_cpt( $apcom_page_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'reading-time' );
	}

	if ( is_singular( 'post' ) || apcom_is_article_cpt( $apcom_page_id ) || apcom_is_project_cpt( $apcom_page_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'comments' );
	}

	if ( is_author() || apcom_is_subject_cpt( $apcom_page_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'website' );
	}
	?>
</dl>

<?php
/**
 * The page content template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.3
 */

?>
<div id="page__content" class="page__body" itemprop="articleBody">
	<?php
	the_content( '', true );
	if ( apcom_is_contact_page() ) {
		get_template_part( 'template-parts/page/partials/content', 'contact' );
	}
	if ( apcom_is_thematic_cpt() ) {
		get_template_part( 'template-parts/page/partials/content', 'thematic' );
	}
	if ( apcom_is_subject_cpt() ) {
		get_template_part( 'template-parts/page/partials/content', 'subject' );
	}
	?>
</div>

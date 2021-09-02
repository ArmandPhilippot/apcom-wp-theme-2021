<?php
/**
 * The meta template to display meta in excerpt post header.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.3 Splitted from page-excerpt.
 */

$apcom_post_id = $args['post_id'];
?>
<dl class="article__meta meta">
	<?php
	get_template_part( 'template-parts/page/partials/meta', 'date' );

	if ( apcom_is_thematic_cpt( $apcom_post_id ) || apcom_is_subject_cpt( $apcom_post_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'posts-count', array( 'caller_id' => $apcom_post_id ) );
	}

	if ( ! apcom_is_thematic_cpt( $apcom_post_id ) && ! apcom_is_subject_cpt( $apcom_post_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'reading-time' );
		get_template_part( 'template-parts/page/partials/meta', 'comments' );
	}

	if ( ! is_category() && ! apcom_is_article_cpt( $apcom_post_id ) && ! apcom_is_project_cpt() ) {
		get_template_part( 'template-parts/page/partials/meta', 'categories' );
	}

	if ( is_category() && ! apcom_is_article_cpt( $apcom_post_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'tags' );
	}

	if ( apcom_is_article_cpt( $apcom_post_id ) ) {
		get_template_part( 'template-parts/page/partials/meta', 'thematics' );
	}

	if ( apcom_is_project_cpt( $apcom_post_id ) ) {
		if ( is_post_type_archive( 'project' ) ) {
			get_template_part( 'template-parts/page/partials/meta', 'subjects' );
		} else {
			get_template_part( 'template-parts/page/partials/meta', 'projects' );
		}
	}
	?>
</dl>

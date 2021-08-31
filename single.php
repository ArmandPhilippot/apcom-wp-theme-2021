<?php
/**
 * The single post template.
 *
 * Used when a single post is queried. For this and all other query templates,
 * index.php is used if the query template is not present.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="<?php echo esc_attr( apcom_get_page_classes( get_the_ID() ) ); ?>" itemscope itemtype="http://schema.org/BlogPosting">
			<?php
			get_template_part( 'template-parts/page/page', 'header' );
			get_template_part( 'template-parts/page/page', 'toc' );
			get_template_part( 'template-parts/page/page', 'content' );
			if ( ! apcom_is_thematic_cpt() && ! apcom_is_subject_cpt() ) {
				get_template_part( 'template-parts/page/page', 'footer' );
			}
			get_sidebar( 'pages' );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/page/page', 'none' );
}
get_footer();

<?php
/**
 * Template Name: CV
 *
 * The CV page template.
 *
 * Used when an individual page based on CV template is queried.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package ArmandPhilippot-com
 * @since   0.0.2
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
			get_sidebar( 'cv' );
			?>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/page/page', 'none' );
}
get_footer();

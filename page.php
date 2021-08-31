<?php
/**
 * The page template.
 *
 * Used when an individual page is queried.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
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
			if ( ! apcom_is_frontpage() ) {
				get_template_part( 'template-parts/page/page', 'header' );
				get_template_part( 'template-parts/page/page', 'toc' );
			}
			get_template_part( 'template-parts/page/page', 'content' );
			if ( ! apcom_is_frontpage() ) {
				get_sidebar( 'pages' );
			}
			?>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/page/page', 'none' );
}
get_footer();

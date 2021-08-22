<?php
/**
 * The main template.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme. It is used to display a page when nothing
 * more specific matches a query.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

get_header();
if ( have_posts() ) {
	?>
	<article class="<?php echo esc_attr( apcom_get_page_classes( get_the_ID() ) ); ?>" itemscope itemtype="http://schema.org/Blog">
		<?php get_template_part( 'template-parts/page/page', 'header' ); ?>
		<div class="page__body" itemprop="articleBody">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/page/page', 'excerpt' );
			}
			apcom_get_pagination();
			?>
		</div>
	</article>
	<?php
	get_sidebar();
} else {
	get_template_part( 'template-parts/page/page', 'none' );
}
get_footer();

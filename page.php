<?php
/**
 * The template for displaying the pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="page" itemscope itemtype="http://schema.org/BlogPosting">
			<?php
			get_template_part( 'template-parts/main/page-header' );
			get_template_part( 'template-parts/main/page-toc' );
			get_template_part( 'template-parts/main/page-content' );
			?>
			<aside class="page__aside page__aside--last">
				<?php get_sidebar( 'pages' ); ?>
			</aside>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

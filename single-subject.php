<?php
/**
 * The template for displaying the subject custom post type.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="page" itemscope itemtype="http://schema.org/BlogPosting">
			<?php
			get_template_part( 'template-parts/cpt/subject/header' );
			get_template_part( 'template-parts/main/page-toc' );
			get_template_part( 'template-parts/cpt/subject/content' );
			get_sidebar( 'pages' );
			?>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

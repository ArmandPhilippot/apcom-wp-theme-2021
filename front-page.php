<?php
/**
 * The template for displaying the front-page.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/main/front-page' );
	}
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

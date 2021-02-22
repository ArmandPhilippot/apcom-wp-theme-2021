<?php
/**
 * The template for displaying front-page content.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

?>
<article class="page page--front-page">
	<div class="page__body page__body--front-page" itemprop="articleBody">
		<div class="front-page__body box">
		<?php the_content(); ?>
		</div>
		<?php get_sidebar( 'home-widgets' ); ?>
	</div>
</article>

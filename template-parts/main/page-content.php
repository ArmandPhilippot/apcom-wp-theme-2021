<?php
/**
 * The template for displaying the page content.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.3
 */

if ( get_the_content() ) {
	?>
	<div id="page__content" class="page__body page__body--single-page" itemprop="articleBody">
		<?php the_content( '', true ); ?>
	</div>
	<?php
}

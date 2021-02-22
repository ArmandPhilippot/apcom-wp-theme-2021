<?php
/**
 * The template for displaying the archive pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	?>
	<article class="page" itemscope itemtype="http://schema.org/Blog">
		<header class="page__header">
			<h1 class="page__title" itemprop="headline name">
				<?php
				echo esc_html( get_the_archive_title() );
				?>
			</h1>
			<?php
			if ( the_archive_description() ) {
				?>
				<div class="page__introduction">
					<?php echo wp_kses_post( get_the_archive_description() ); ?>
				</div>
				<?php
			}
			?>
		</header>
		<div class="page__body" itemprop="articleBody">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/main/articles-list' );
			}
			get_template_part( 'template-parts/main/pagination' );
			?>
		</div>
	</article>
	<aside class="page__aside page__aside--last">
		<?php get_sidebar(); ?>
	</aside>
	<?php
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

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
				echo wp_kses_post( get_the_archive_title() );
				?>
			</h1>
			<?php
			$apcom_published_posts_number = $GLOBALS['wp_query']->post_count;
			if ( $apcom_published_posts_number ) {
				?>
				<dl class="page__meta meta">
					<div class="meta__item meta__item--has-icon meta__item--articles">
						<dt class="meta__term"><?php esc_html_e( 'Total', 'APCom' ); ?></dt>
						<dd class="meta__description">
							<?php
							printf(
								esc_html(
									// translators: %s number of posts.
									_n(
										'%s article',
										'%s articles',
										$apcom_published_posts_number,
										'APCom'
									)
								),
								esc_html( $apcom_published_posts_number )
							);
							?>
						</dd>
					</div>
				</dl>
				<?php
			}
			the_archive_description( '<div class="page__introduction">', '</div>' );
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
	<?php
	get_sidebar();
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

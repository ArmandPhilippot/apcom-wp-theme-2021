<?php
/**
 * The template for displaying the search pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	global $wp_query;
	$apcom_posts_found  = $wp_query->post_count;
	$apcom_search_query = get_search_query( false );
	?>
	<article class="page" itemscope itemtype="http://schema.org/Blog">
		<header class="page__header">
			<h1 class="page__title" itemprop="headline name">
				<?php
				printf(
					// translators: %s: search query.
					esc_html__( 'Search results for: %s', 'APCom' ),
					esc_html( $apcom_search_query )
				);
				?>
			</h1>
			<dl class="page__meta meta">
				<div class="meta__item meta__item--has-icon meta__articles">
					<dt class="meta__term"><?php esc_html_e( 'Total', 'APCom' ); ?></dt>
					<dd class="meta__description">
						<?php
						printf(
							esc_html(
								// translators: %s number of posts.
								_n(
									'%s article',
									'%s articles',
									$apcom_posts_found,
									'APCom'
								)
							),
							esc_html( $apcom_posts_found )
						);
						?>
					</dd>
				</div>
			</dl>
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

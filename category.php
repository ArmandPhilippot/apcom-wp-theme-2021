<?php
/**
 * The template for displaying the category pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	$apcom_current_category = single_cat_title( '', false );
	?>
	<article class="page" itemscope itemtype="http://schema.org/Blog">
		<header class="page__header">
			<h1 class="page__title" itemprop="headline name">
				<?php
				echo esc_html( $apcom_current_category );
				?>
			</h1>
			<?php
			$apcom_category_id            = get_cat_ID( $apcom_current_category );
			$apcom_published_posts_number = get_category( $apcom_category_id )->count;
			if ( $apcom_published_posts_number ) {
				?>
				<div class="page__meta-feed">
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
					<div class="page__feed">
						<a href="<?php echo esc_url( get_category_feed_link( $apcom_category_id ) ); ?>" class="page__feed-link">
							<?php
							printf(
								// translators: %s the category name.
								esc_html__( 'Subscribe to %s', 'APCom' ),
								esc_html( $apcom_current_category )
							);
							?>
						</a>
					</div>
				</div>
				<?php
			}
			if ( category_description() ) {
				?>
				<div class="page__introduction">
					<?php echo wp_kses_post( category_description() ); ?>
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
	<?php
	get_sidebar();
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

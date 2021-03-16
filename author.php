<?php
/**
 * The template for displaying the author pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

get_header();
if ( have_posts() ) {
	$apcom_author_data = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$apcom_author_id   = $apcom_author_data->ID;
	?>
	<article class="page" itemscope itemtype="http://schema.org/Blog">
		<header class="page__header">
			<h1 class="page__title" itemprop="headline name">
				<?php
				echo esc_html( get_the_author_meta( 'nickname', $apcom_author_id ) );
				?>
			</h1>
			<?php if ( '' !== get_the_author_meta( 'user_url', $apcom_author_id ) ) { ?>
				<dl class="page__meta meta">
					<div class="meta__item meta__item--has-icon meta__website">
						<dt class="meta__term"><?php esc_html_e( 'Website:', 'APCom' ); ?></dt>
						<dd class="meta__description">
							<a href="<?php echo esc_url( get_the_author_meta( 'user_url', $apcom_author_id ) ); ?>" class="website__link" itemprop="url">
								<?php echo esc_url( get_the_author_meta( 'user_url', $apcom_author_id ) ); ?>
							</a>
						</dd>
					</div>
				</dl>
			<?php } ?>
		</header>
		<div class="page__body" itemprop="articleBody">
			<?php if ( '' !== get_the_author_meta( 'description', $apcom_author_id ) ) { ?>
				<div class="author__introduction">
					<h2 class="author__title">
						<?php esc_html_e( 'Introduction', 'APCom' ); ?>
					</h2>
					<div class="author__avatar" itemprop="image">
						<?php echo get_avatar( get_the_author_meta( 'user_email', $apcom_author_id ), 135 ); ?>
					</div>
					<div class="author__body" itemprop="description">
						<?php echo wp_kses_post( get_the_author_meta( 'description', $apcom_author_id ) ); ?>
					</div>
				</div>
			<?php } ?>
			<div class="author__articles">
				<h2>
					<?php
					printf(
						// translators: %s: author name.
						esc_html_x( '%s\'s articles', 'username', 'APCom' ),
						esc_html( get_the_author_meta( 'nickname', $apcom_author_id ) )
					);
					?>
				</h2>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/main/author-articles' );
				}
				get_template_part( 'template-parts/main/pagination' );
				?>
			</div>
		</div>
	</article>
	<?php
	get_sidebar();
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

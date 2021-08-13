<?php
/**
 * The template for displaying articles list in author pages.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<header class="article__header">
		<h3 class="article__title" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="article__link">
				<?php the_title(); ?>
			</a>
		</h3>
	</header>
	<div class="article__body" itemprop="articleBody">
		<div class="article__description" itemprop="description">
			<?php
			$apcom_post_parts    = get_extended( $post->post_content );
			$apcom_post_extended = $apcom_post_parts['extended'];

			if ( ! empty( $apcom_post_extended ) ) {
				the_content();
			} else {
				the_excerpt();
			}
			?>
		</div>
	</div>
	<footer class="article__footer">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="article__figure">
				<?php
				echo get_the_post_thumbnail(
					$post->ID,
					'post-thumbnail',
					array(
						'class'    => 'article__image',
						'itemprop' => 'image',
					)
				);
				?>
			</figure>
		<?php } ?>
		<dl class="article__meta meta">
			<div class="meta__item meta__item--has-icon meta__item--publication-date">
				<dt class="meta__term">
					<?php esc_html_e( 'Published on', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished">
						<?php echo get_the_date( 'd F Y' ); ?>
					</time>
				</dd>
			</div>
			<div class="meta__item meta__item--has-icon meta__item--reading-time">
				<dt class="meta__term">
					<?php esc_html_e( 'Reading time', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<?php echo wp_kses_post( apcom_get_reading_time( $post->post_content ) ); ?>
				</dd>
			</div>
			<?php
			if ( ! is_category() ) {
				$apcom_article_themes = get_the_category();
			} else {
				$apcom_article_themes = get_the_tags();
			}
			if ( $apcom_article_themes ) {
				?>
				<div class="meta__item meta__item--has-icon meta__item--themes">
					<dt class="meta__term">
						<?php esc_html_e( 'Posted in', 'APCom' ); ?>
					</dt>
					<?php
					foreach ( $apcom_article_themes as $apcom_article_theme ) {
						$apcom_article_theme_link = get_term_link( $apcom_article_theme->term_id );
						$apcom_article_theme_name = $apcom_article_theme->name;
						?>
						<dd class="meta__description" itemprop="keywords">
							<a href="<?php echo esc_url( $apcom_article_theme_link ); ?>" rel="tag">
								<?php echo esc_html( $apcom_article_theme_name ); ?>
							</a>
						</dd>
					<?php } ?>
				</div>
				<?php
			}
			$apcom_comment_count = get_comments_number();
			?>
			<?php if ( comments_open() || $apcom_comment_count > 0 ) { ?>
				<div class="meta__item meta__item--has-icon meta__item--comments">
					<dt class="meta__term">
						<?php esc_html_e( 'Comments', 'APCom' ); ?>
					</dt>
					<dd class="meta__description">
						<?php
						comments_popup_link();
						echo '<meta itemprop="interactionCount" content="UserComments:' . esc_html( $apcom_comment_count ) . '" />';
						?>
					</dd>
				</div>
			<?php } ?>
		</dl>
	</footer>
</article>

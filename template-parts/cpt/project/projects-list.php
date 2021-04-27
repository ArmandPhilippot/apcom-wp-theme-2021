<?php
/**
 * The template for displaying articles list like in blog index.
 *
 * @package ArmandPhilippot-com
 * @since 1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<header class="article__header">
		<h2 class="article__title" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="article__link">
				<?php the_title(); ?>
			</a>
		</h2>
		<dl class="article__meta meta">
			<div class="meta__item meta__item--has-icon meta__publication-date">
				<dt class="meta__term">
					<?php esc_html_e( 'Published on', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished">
						<?php echo get_the_date( 'd F Y' ); ?>
					</time>
				</dd>
			</div>
			<div class="meta__item meta__item--has-icon meta__reading-time">
				<dt class="meta__term">
					<?php esc_html_e( 'Reading time', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<?php echo wp_kses_post( apcom_get_reading_time( $post->post_content ) ); ?>
				</dd>
			</div>
			<?php
			$apcom_project_subjects = get_post_meta( get_the_ID(), 'posts_in_subject' );
			if ( $apcom_project_subjects && is_array( $apcom_project_subjects[0] ) ) {
				?>
				<div class="meta__item meta__item--has-icon meta__themes">
					<dt class="meta__term">
						<?php esc_html_e( 'About', 'APCom' ); ?>
					</dt>
					<?php
					foreach ( $apcom_project_subjects[0] as $apcom_project_subject_id ) {
						$apcom_project_subject_link = get_permalink( $apcom_project_subject_id );
						$apcom_project_subject_name = get_the_title( $apcom_project_subject_id );
						?>
						<dd class="meta__description meta__theme" itemprop="keywords">
							<a href="<?php echo esc_url( $apcom_project_subject_link ); ?>" rel="tag">
								<?php echo esc_html( $apcom_project_subject_name ); ?>
							</a>
						</dd>
						<?php
					}
					?>
				</div>
				<?php
			}
			$apcom_comment_count = get_comments_number();
			?>
			<?php if ( comments_open() || $apcom_comment_count > 0 ) { ?>
				<div class="meta__item meta__item--has-icon meta__comments">
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
	</header>
	<div class="article__body" itemprop="articleBody">
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
</article>

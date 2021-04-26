<?php
/**
 * The template for displaying the Thematic CPT content.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

$apcom_thematic_id    = get_the_ID();
$apcom_thematic_name  = get_the_title();
$apcom_thematic_query = new WP_Query(
	array(
		'post_type'         => array( 'post', 'article' ),
		'posts_per_page'    => -1,
		'orderby'           => 'date',
		'order'             => 'DESC',
		'meta_query'        => array( // phpcs:ignore WordPress.DB.SlowDBQuery
			array(
				'key'     => 'posts_in_thematic',
				'value'   => $apcom_thematic_id,
				'compare' => 'LIKE',
			),
		),
	)
);
?>
<div id="page__content" class="page__body page__body--cpt" itemprop="articleBody">
	<?php the_content( '', true ); ?>
	<h2>
		<?php
		printf(
			// translators: %s The thematic name.
			esc_html__( 'All articles in %s', 'APCom' ),
			esc_html( $apcom_thematic_name )
		);
		?>
	</h2>
	<?php
	if ( $apcom_thematic_query->have_posts() ) {
		while ( $apcom_thematic_query->have_posts() ) {
			$apcom_thematic_query->the_post();
			$apcom_posted_in_subject = get_post_meta( get_the_ID(), 'posts_in_subject' );
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
						if ( $apcom_posted_in_subject && is_array( $apcom_posted_in_subject[0] ) ) {
							$apcom_subjects_number = count( $apcom_posted_in_subject[0] );
							?>
							<div class="meta__item meta__item--has-icon meta__themes">
								<dt class="meta__term">
									<?php
									echo esc_html(
										_n(
											'Topic',
											'Topics',
											$apcom_subjects_number,
											'APCom'
										)
									);
									?>
								</dt>
								<?php
								foreach ( $apcom_posted_in_subject[0] as $apcom_subject_id ) {
									$apcom_article_subject_link = get_permalink( $apcom_subject_id );
									$apcom_article_subject_name = get_the_title( $apcom_subject_id );
									$apcom_meta_theme_class     = '';

									if ( has_post_thumbnail( $apcom_subject_id ) ) {
										$apcom_meta_theme_class = 'meta__theme--icon';
									}
									?>
									<dd class="meta__description meta__theme <?php echo esc_attr( $apcom_meta_theme_class ); ?>" itemprop="keywords">
										<?php echo get_the_post_thumbnail( $apcom_subject_id, 'post-thumbnail', array( 'class' => 'theme__img' ) ); ?>
										<a href="<?php echo esc_url( $apcom_article_subject_link ); ?>" rel="tag">
											<?php echo esc_html( $apcom_article_subject_name ); ?>
										</a>
									</dd>
									<?php
								}
								?>
							</div>
							<?php
						}
						$apcom_comment_count = get_comments_number( $post->ID );
						?>
						<?php if ( comments_open( $post->ID ) || $apcom_comment_count > 0 ) { ?>
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
				</footer>
			</article>
			<?php
		}
	}
	wp_reset_postdata();
	?>
</div>

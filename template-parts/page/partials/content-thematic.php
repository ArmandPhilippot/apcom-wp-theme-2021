<?php
/**
 * The content template displayed in thematic CPT.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
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
					<?php
					get_template_part( 'template-parts/page/partials/meta', 'date' );
					get_template_part( 'template-parts/page/partials/meta', 'reading-time' );
					get_template_part( 'template-parts/page/partials/meta', 'comments' );
					get_template_part( 'template-parts/page/partials/meta', 'subjects' );
					?>
				</dl>
			</footer>
		</article>
		<?php
	}
}
wp_reset_postdata();

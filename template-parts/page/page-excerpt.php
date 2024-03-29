<?php
/**
 * The page excerpt template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Template renamed and meta splitted.
 */

$apcom_post_id = get_the_ID();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<header class="article__header">
		<h2 class="article__title" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="article__link">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php get_template_part( 'template-parts/page/partials/excerpt', 'meta', array( 'post_id' => $apcom_post_id ) ); ?>
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

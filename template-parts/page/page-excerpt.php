<?php
/**
 * The page excerpt template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Template renamed and meta splitted.
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
			<?php
			get_template_part( 'template-parts/page/partials/meta', 'date' );
			if ( apcom_is_thematic_cpt( get_the_ID() ) || apcom_is_subject_cpt( get_the_ID() ) ) {
				get_template_part( 'template-parts/page/partials/meta', 'posts-count' );
			}
			if ( ! apcom_is_thematic_cpt( get_the_ID() ) && ! apcom_is_subject_cpt( get_the_ID() ) ) {
				get_template_part( 'template-parts/page/partials/meta', 'reading-time' );
				get_template_part( 'template-parts/page/partials/meta', 'comments' );
			}
			if ( apcom_is_article_cpt( get_the_ID() ) ) {
				get_template_part( 'template-parts/page/partials/meta', 'thematics' );
			} else {
				if ( ! is_category() && ! apcom_is_article_cpt( get_the_ID() ) ) {
					get_template_part( 'template-parts/page/partials/meta', 'categories' );
				}
				! is_tag() ? get_template_part( 'template-parts/page/partials/meta', 'tags' ) : '';
			}
			if ( apcom_is_project_cpt() ) {
				get_template_part( 'template-parts/page/partials/meta', 'subjects' );
			} else {
				get_template_part( 'template-parts/page/partials/meta', 'projects' );
			}
			?>
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

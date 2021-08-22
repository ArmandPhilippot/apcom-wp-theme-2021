<?php
/**
 * The author template.
 *
 * Used when an author is queried.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#author-display
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

get_header();
if ( have_posts() ) {
	$apcom_author_data = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$apcom_author_id   = $apcom_author_data->ID;
	?>
	<article class="<?php echo esc_attr( apcom_get_page_classes( get_the_ID() ) ); ?>" itemscope itemtype="http://schema.org/Blog">
		<?php get_template_part( 'template-parts/page/page', 'header' ); ?>
		<div class="page__body" itemprop="articleBody">
			<?php get_template_part( 'template-parts/author/author', 'intro', array( 'author_id' => $apcom_author_id ) ); ?>
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
					get_template_part( 'template-parts/author/author', 'articles' );
				}
				apcom_get_pagination();
				?>
			</div>
		</div>
	</article>
	<?php
	get_sidebar();
} else {
	get_template_part( 'template-parts/page/page', 'none' );
}
get_footer();

<?php
/**
 * The page header template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Split page title and header meta in separated files.
 */

if ( ! apcom_is_frontpage() ) {
	?>
	<header class="page__header">
		<h1 class="page__title" itemprop="headline name">
			<?php
			if ( apcom_is_subject_cpt() ) {
				echo get_the_post_thumbnail( null, 'post-thumbnail', array( 'class' => 'page__logo' ) );
			}
			echo esc_html( apcom_get_page_title() );
			?>
		</h1>
		<?php if ( ! apcom_is_contact_page() ) { ?>
			<dl class="page__meta meta">
				<?php
				if ( is_single() || is_page() ) {
					get_template_part( 'template-parts/page/partials/meta', 'date' );
					if ( ! apcom_is_thematic_cpt() && ! apcom_is_subject_cpt() ) {
						get_template_part( 'template-parts/page/partials/meta', 'reading-time' );
					}
					get_template_part( 'template-parts/page/partials/meta', 'comments' );
				}
				get_template_part( 'template-parts/page/partials/meta', 'posts-count' );
				if ( is_author() || apcom_is_subject_cpt() ) {
					get_template_part( 'template-parts/page/partials/meta', 'website' );
				}
				?>
			</dl>
			<?php
			get_template_part( 'template-parts/page/partials/header', 'feed' );
		}
		if ( apcom_is_listing_page() && ! is_author() ) {
			get_template_part( 'template-parts/page/partials/intro', 'listing' );
		}
		if ( apcom_is_single_page() ) {
			get_template_part( 'template-parts/page/partials/intro', 'article' );
		}
		?>
	</header>
	<?php
}

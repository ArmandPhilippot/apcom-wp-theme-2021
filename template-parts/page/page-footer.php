<?php
/**
 * The page footer template.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Split footer meta in separated file.
 */

if ( ! apcom_is_frontpage() ) {
	?>
	<footer class="page__footer">
		<dl class="meta meta--footer">
			<?php
			if ( is_attachment() ) {
				get_template_part( 'template-parts/page/partials/meta', 'attachment' );
			} elseif ( apcom_is_article_cpt() ) {
				get_template_part( 'template-parts/page/partials/meta', 'thematics' );
				get_template_part( 'template-parts/page/partials/meta', 'subjects' );
			} elseif ( apcom_is_project_cpt() ) {
				get_template_part( 'template-parts/page/partials/meta', 'projects' );
				get_template_part( 'template-parts/page/partials/meta', 'subjects' );
			} else {
				get_template_part( 'template-parts/page/partials/meta', 'categories' );
				get_template_part( 'template-parts/page/partials/meta', 'tags' );
			}
			?>
		</dl>
	</footer>
	<?php
}

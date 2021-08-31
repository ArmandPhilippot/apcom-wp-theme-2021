<?php
/**
 * The meta template to display projects.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( get_post_type_object( 'project' ) && get_post_type() === 'project' ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--themes">
		<dt class="meta__term">
			<?php
			if ( apcom_is_project_cpt() ) {
				esc_html_e( 'Posted in:', 'APCom' );
			} else {
				esc_html_e( 'Posted in', 'APCom' );
			}
			?>
		</dt>
		<?php
		$apcom_post_type_object      = get_post_type_object( 'project' );
		$apcom_article_thematic_link = get_post_type_archive_link( 'project' );
		$apcom_article_thematic_name = $apcom_post_type_object ? $apcom_post_type_object->labels->singular_name : '';
		?>
		<dd class="meta__description" itemprop="keywords">
			<a href="<?php echo esc_url( $apcom_article_thematic_link ); ?>" rel="tag">
				<?php echo esc_html( $apcom_article_thematic_name ); ?>
			</a>
		</dd>
	</div>
	<?php
}

<?php
/**
 * The meta template to display thematics.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

$apcom_article_thematics = get_post_meta( get_the_ID(), 'posts_in_thematic' );
if ( $apcom_article_thematics ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--themes">
		<dt class="meta__term">
			<?php
			if ( is_archive() || is_search() || is_home() ) {
				esc_html_e( 'Posted in', 'APCom' );
			} else {
				printf(
					esc_html(
						_n(
							'Thematic:',
							'Thematics:',
							count( $apcom_article_thematics[0] ),
							'APCom'
						)
					)
				);
			}
			?>
		</dt>
		<?php
		foreach ( $apcom_article_thematics[0] as $apcom_thematic_id ) {
			?>
			<dd class="meta__description" itemprop="keywords">
				<a href="<?php echo esc_url( get_permalink( $apcom_thematic_id ) ); ?>" rel="tag">
					<?php echo esc_html( get_the_title( $apcom_thematic_id ) ); ?>
				</a>
			</dd>
			<?php
		}
		?>
	</div>
	<?php
}

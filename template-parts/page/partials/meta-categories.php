<?php
/**
 * The meta template to display categories.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( has_category() ) {
	$apcom_post_categories = get_the_category();
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
							'Category:',
							'Categories:',
							count( $apcom_post_categories ),
							'APCom'
						)
					)
				);
			}
			?>
		</dt>
		<?php
		foreach ( $apcom_post_categories as $apcom_post_category ) {
			?>
			<dd class="meta__description" itemprop="keywords">
				<a href="<?php echo esc_url( get_category_link( $apcom_post_category->term_id ) ); ?>" rel="tag">
					<?php echo esc_html( $apcom_post_category->name ); ?>
				</a>
			</dd>
			<?php
		}
		?>
	</div>
	<?php
}

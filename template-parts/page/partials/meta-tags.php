<?php
/**
 * The meta template to display tags.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( has_tag() ) {
	$apcom_post_tags = get_the_tags();
	?>
	<div class="meta__item meta__item--has-icon meta__item--themes">
		<dt class="meta__term">
			<?php
			printf(
				esc_html(
					_n(
						'Tag:',
						'Tags:',
						count( $apcom_post_tags ),
						'APCom'
					)
				)
			);
			?>
		</dt>
		<?php
		foreach ( $apcom_post_tags as $apcom_post_tag ) {
			?>
			<dd class="meta__description" itemprop="keywords">
				<a href="<?php echo esc_url( get_tag_link( $apcom_post_tag->term_id ) ); ?>" rel="tag">
					<?php echo esc_html( $apcom_post_tag->name ); ?>
				</a>
			</dd>
		<?php } ?>
	</div>
	<?php
}

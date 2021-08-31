<?php
/**
 * The meta template to display posts count.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

$apcom_published_posts_number = apcom_get_posts_count();

if ( 0 !== $apcom_published_posts_number ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--articles">
		<dt class="meta__term"><?php esc_html_e( 'Total', 'APCom' ); ?></dt>
		<dd class="meta__description">
			<?php
			printf(
				esc_html(
					// translators: %s number of posts.
					_n(
						'%s article',
						'%s articles',
						$apcom_published_posts_number,
						'APCom'
					)
				),
				esc_html( $apcom_published_posts_number )
			);
			?>
		</dd>
	</div>
	<?php
}

<?php
/**
 * The author introduction template.
 *
 * Used in author pages when an author is queried.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

if ( '' !== get_the_author_meta( 'description', $args['author_id'] ) ) { ?>
	<div class="author__introduction">
		<h2 class="author__title">
			<?php esc_html_e( 'Introduction', 'APCom' ); ?>
		</h2>
		<div class="author__avatar" itemprop="image">
			<?php echo get_avatar( get_the_author_meta( 'user_email', $args['author_id'] ), 135 ); ?>
		</div>
		<div class="author__body" itemprop="description">
			<?php echo wp_kses_post( get_the_author_meta( 'description', $args['author_id'] ) ); ?>
		</div>
	</div>
	<?php
}

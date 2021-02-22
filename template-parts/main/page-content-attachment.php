<?php
/**
 * The template for displaying attachment content.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<div id="page__content" class="page__content box" itemprop="articleBody">
	<?php if ( wp_attachment_is_image( $post->id ) ) { ?>
		<figure>
			<?php
			echo wp_get_attachment_image( $post->id, 'full' );
			if ( wp_get_attachment_caption() ) {
				?>
				<figcaption>
					<?php echo esc_html( wp_get_attachment_caption() ); ?>
				</figcaption>
				<?php
			}
			?>
		</figure>
		<?php
	} elseif ( wp_attachment_is( 'video' ) ) {
		?>
		<video controls>
			<source src="<?php echo esc_url( wp_get_attachment_url() ); ?>">
		</video>
		<?php
	} elseif ( wp_attachment_is( 'audio' ) ) {
		?>
		<figure>
			<audio
				controls
				src="<?php echo esc_url( wp_get_attachment_url() ); ?>">
			</audio>
		</figure>
		<?php
	} else {
		echo esc_html__( 'The file can be downloaded here:', 'APCom' ) . ' ' . wp_get_attachment_link();
	}
	the_content();
	?>
</div>

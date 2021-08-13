<?php
/**
 * The template for displaying the article CPT header.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

$apcom_post_parts    = get_extended( $post->post_content );
$apcom_post_teaser   = $apcom_post_parts['main'];
$apcom_post_content  = $apcom_post_parts['extended'];
$apcom_published_on  = get_the_date();
$apcom_updated_on    = get_the_modified_date();
$apcom_comment_count = get_comments_number();
?>
<header class="page__header">
	<h1 class="page__title" itemprop="headline name">
		<?php single_post_title(); ?>
	</h1>
	<dl class="page__meta meta">
		<div class="meta__item meta__item--has-icon meta__item--publication-date">
			<dt class="meta__term">
				<?php esc_html_e( 'Published on', 'APCom' ); ?>
			</dt>
			<dd class="meta__description">
				<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished" id="meta__item--publication-date">
					<?php echo esc_html( $apcom_published_on ); ?>
				</time>
			</dd>
		</div>
		<?php if ( $apcom_published_on !== $apcom_updated_on ) { ?>
			<div class="meta__item meta__item--has-icon meta__item--update-date">
				<dt class="meta__term">
					<?php esc_html_e( 'Updated on', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="dateModified" id="meta__item--update-date">
						<?php echo esc_html( $apcom_updated_on ); ?>
					</time>
				</dd>
			</div>
			<?php
		}
		?>
		<div class="meta__item meta__item--has-icon meta__item--reading-time">
			<dt class="meta__term">
				<?php esc_html_e( 'Reading time', 'APCom' ); ?>
			</dt>
			<dd class="meta__description">
				<?php echo wp_kses_post( apcom_get_reading_time( $post->post_content ) ); ?>
			</dd>
		</div>
		<?php
		if ( comments_open() || $apcom_comment_count > 0 ) {
			?>
			<div class="meta__item meta__item--has-icon meta__item--comments">
				<dt class="meta__term">
					<?php esc_html_e( 'Comments', 'APCom' ); ?>
				</dt>
				<dd class="meta__description">
					<?php
					comments_popup_link();
					echo '<meta itemprop="interactionCount" content="UserComments:' . esc_html( $apcom_comment_count ) . '" />';
					?>
				</dd>
			</div>
		<?php } ?>
	</dl>
	<?php if ( '' !== $apcom_post_content ) { ?>
	<div class="page__introduction">
		<?php
		echo wp_kses_post( $apcom_post_teaser );
		?>
	</div>
	<?php } ?>
</header>

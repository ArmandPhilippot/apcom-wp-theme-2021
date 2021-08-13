<?php
/**
 * The template for displaying the article CPT footer.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

$apcom_article_thematics = get_post_meta( get_the_ID(), 'posts_in_thematic' );
$apcom_article_subjects  = get_post_meta( get_the_ID(), 'posts_in_subject' );
?>
<footer class="page__footer">
	<?php if ( $apcom_article_thematics || $apcom_article_subjects ) { ?>
		<dl class="footer__meta meta">
			<?php
			if ( $apcom_article_thematics ) {
				?>
				<div class="meta__item meta__item--categories">
					<dt class="meta__term">
						<?php
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
			if ( $apcom_article_subjects && is_array( $apcom_article_subjects[0] ) ) {
				?>
				<div class="meta__item meta__item--tags">
					<dt class="meta__term">
						<?php
						printf(
							esc_html(
								_n(
									'Topic:',
									'Topics:',
									count( $apcom_article_subjects[0] ),
									'APCom'
								)
							)
						);
						?>
					</dt>
					<?php
					foreach ( $apcom_article_subjects[0] as $apcom_subject_id ) {
						$apcom_meta_theme_class = '';

						if ( has_post_thumbnail( $apcom_subject_id ) ) {
							$apcom_meta_theme_class = 'meta__description--has-icon';
						}
						?>
						<dd class="meta__description <?php echo esc_attr( $apcom_meta_theme_class ); ?>" itemprop="keywords">
							<?php echo get_the_post_thumbnail( $apcom_subject_id, 'post-thumbnail', array( 'class' => 'meta__icon' ) ); ?>
							<a href="<?php echo esc_url( get_permalink( $apcom_subject_id ) ); ?>" rel="tag">
								<?php echo esc_html( get_the_title( $apcom_subject_id ) ); ?>
							</a>
						</dd>
					<?php } ?>
				</div>
			<?php } ?>
		</dl>
	<?php } ?>
</footer>
<?php

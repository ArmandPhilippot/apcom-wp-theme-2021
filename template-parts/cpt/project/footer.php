<?php
/**
 * The template for displaying the project CPT footer.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

$apcom_article_subjects = get_post_meta( get_the_ID(), 'posts_in_subject' );
?>
<footer class="page__footer">
		<dl class="footer__meta meta">
			<div class="meta__item meta__categories">
				<dt class="meta__term">
					<?php esc_html_e( 'Posted in:', 'APCom' ); ?>
				</dt>
				<?php
				$apcom_post_type_object      = get_post_type_object( 'project' );
				$apcom_article_thematic_link = get_post_type_archive_link( 'project' );
				$apcom_article_thematic_name = $apcom_post_type_object->labels->singular_name;
				?>
				<dd class="meta__description meta__category" itemprop="keywords">
					<a href="<?php echo esc_url( $apcom_article_thematic_link ); ?>" rel="tag">
						<?php echo esc_html( $apcom_article_thematic_name ); ?>
					</a>
				</dd>
			</div>
			<?php if ( $apcom_article_subjects ) { ?>
				<div class="meta__item meta__tags">
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
							$apcom_meta_theme_class = 'meta__theme--icon';
						}
						?>
						<dd class="meta__description meta__tag <?php echo esc_attr( $apcom_meta_theme_class ); ?>" itemprop="keywords">
							<?php echo get_the_post_thumbnail( $apcom_subject_id, 'post-thumbnail', array( 'class' => 'theme__img' ) ); ?>
							<a href="<?php echo esc_url( get_permalink( $apcom_subject_id ) ); ?>" rel="tag">
								<?php echo esc_html( get_the_title( $apcom_subject_id ) ); ?>
							</a>
						</dd>
					<?php } ?>
				</div>
			<?php } ?>
		</dl>
</footer>
<?php

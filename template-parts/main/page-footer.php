<?php
/**
 * The template for displaying the page footer.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<footer class="page__footer">
	<?php if ( has_category() || has_tag() ) { ?>
		<dl class="footer__meta meta">
			<?php
			if ( has_category() ) {
				$apcom_post_categories = get_the_category();
				?>
				<div class="meta__item meta__item--categories">
					<dt class="meta__term">
						<?php
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
			if ( has_tag() ) {
				$apcom_post_tags = get_the_tags();
				?>
				<div class="meta__item meta__item--tags">
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
			<?php } ?>
		</dl>
		<?php
	} elseif ( is_attachment() ) {
		if ( $post->post_parent ) {
			?>
			<dl class="footer__meta meta">
				<?php
				$apcom_attachment_parent_link  = get_permalink( $post->post_parent );
				$apcom_attachment_parent_title = get_the_title( $post->post_parent );
				?>
				<dd class="meta__description meta__location">
					<?php echo esc_html__( 'Published in:', 'APCom' ); ?>
				</dd>
				<dt class="meta__term">
					<a href="<?php echo esc_url( $apcom_attachment_parent_link ); ?>"><?php echo esc_html( $apcom_attachment_parent_title ); ?></a>
				</dt>
			</dl>
			<?php
		} else {
			esc_html_e( 'Is not attached to any article.', 'APCom' );
		}
	}
	?>
</footer>
<?php

<?php
/**
 * The meta template to display subjects.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0
 */

$apcom_posted_in_subject = get_post_meta( get_the_ID(), 'posts_in_subject' );
$apcom_article_subjects  = $apcom_posted_in_subject[0];

if ( apcom_is_subject_cpt() ) {
	$apcom_current_page_id  = get_queried_object_id();
	$apcom_this_subject     = array( $apcom_current_page_id );
	$apcom_article_subjects = array_diff( $apcom_article_subjects, $apcom_this_subject );
}

if ( $apcom_posted_in_subject && is_array( $apcom_article_subjects ) && count( $apcom_article_subjects ) > 0 ) {
	?>
	<div class="meta__item meta__item--has-icon meta__item--themes">
		<dt class="meta__term">
			<?php
			if ( apcom_is_subject_cpt() ) {
				printf(
					esc_html(
						_n(
							'Related topic:',
							'Related topics:',
							count( $apcom_article_subjects ),
							'APCom'
						)
					)
				);
			} else {
				printf(
					esc_html(
						_n(
							'Topic:',
							'Topics:',
							count( $apcom_article_subjects ),
							'APCom'
						)
					)
				);
			}
			?>
		</dt>
		<?php
		foreach ( $apcom_article_subjects as $apcom_subject_id ) {
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
	<?php
}

<?php
/**
 * The meta template for publication and update dates.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from page-header.
 */

$apcom_published_on = get_the_date();
$apcom_updated_on   = get_the_modified_date();
?>
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

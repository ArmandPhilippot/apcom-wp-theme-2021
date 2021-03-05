<?php
/**
 * The template for missing content like 404 page.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

?>
<article class="page">
	<header class="page__header">
		<h1 class="page__title" itemprop="headline name">
			<?php esc_html_e( 'Nothing found', 'APCom' ); ?>
		</h1>
	</header>
	<div class="page__body" itemprop="articleBody">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p>
				<?php
				printf(
					// translators: %1$s: URL to publish post.
					esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'APCom' ),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php } else { ?>
			<p>
				<?php
				esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'APCom' );
				?>
			</p>
			<?php
			get_search_form();
		}
		?>
	</div>
</article>
<?php
get_sidebar();

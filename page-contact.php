<?php
/**
 * Template Name: Contact
 *
 * The template for displaying the contact page.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

$apcom_post_parts   = get_extended( $post->post_content );
$apcom_post_teaser  = $apcom_post_parts['main'];
$apcom_post_content = $apcom_post_parts['extended'];

get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="page" itemscope itemtype="http://schema.org/BlogPosting">
		<header class="page__header">
			<h1 class="page__title" itemprop="headline name">
				<?php single_post_title(); ?>
			</h1>
			<?php if ( '' !== $apcom_post_content ) { ?>
			<div class="page__introduction">
				<?php
				echo wp_kses_post( $apcom_post_teaser );
				?>
			</div>
			<?php } ?>
		</header>
			<div id="page__content" class="page__body page__body--single-page" itemprop="articleBody">
				<?php the_content( '', true ); ?>
				<form method="post" class="contact-form">
					<?php
					wp_nonce_field( 'contact', 'contact-form' );
					if ( get_query_var( 'contact-validation' ) ) {
						$apcom_validation = get_query_var( 'contact-validation' );
						switch ( $apcom_validation ) {
							case 'empty':
								echo '<p class="alert error">' . esc_html__( 'Some required fields have not been completed.', 'APCom' ) . '</p>';
								break;
							case 'email':
								echo '<p class="alert error">' . esc_html__( 'Your email address contains errors.', 'APCom' ) . '</p>';
								break;
							case 'ok':
								echo '<p class="alert valid">' . esc_html__( 'Your message has been sent.', 'APCom' ) . '</p>';
								break;
							case 'nice-try':
								echo '<p class="alert nice-try">' . esc_html__( 'Nice try', 'APCom' ) . '</p>';
								break;
							default:
								echo '<p class="alert error">' . esc_html__( 'An error has occurred.', 'APCom' ) . '</p>';
						}
					}
					?>
					<div class="contact-form__item">
						<label for="contact-name" class="contact-form__label">
							<?php esc_html_e( 'Name', 'APCom' ); ?>
							<span class="required"> *</span>
						</label>
						<input type="text" id="contact-name" name="contact-name" maxlength="64" pattern="([^\s][A-z0-9À-ž ,.'’-]+)" placeholder="<?php esc_attr_e( 'Firstname Lastname', 'APCom' ); ?>" class="contact-form__field" required />
					</div>
					<div class="contact-form__item">
						<label for="contact-email" class="contact-form__label">
							<?php esc_html_e( 'Email', 'APCom' ); ?>
							<span class="required"> *</span>
						</label>
						<input type="email" id="contact-email" name="contact-email" placeholder="<?php esc_attr_e( 'your@email.com', 'APCom' ); ?>" class="contact-form__field" required />
					</div>
					<div class="contact-form__item">
						<label for="contact-object" class="contact-form__label">
							<?php esc_html_e( 'Object', 'APCom' ); ?>
						</label>
						<input type="text" id="contact-object" name="contact-object" placeholder="<?php esc_attr_e( 'Mail subject', 'APCom' ); ?>" class="contact-form__field" />
					</div>
					<div class="contact-form__item">
						<label for="contact-message" class="contact-form__label">
							<?php esc_html_e( 'Message', 'APCom' ); ?>
							<span class="required"> *</span>
						</label>
						<textarea id="contact-message" name="contact-message" placeholder="<?php esc_attr_e( 'Your message here...', 'APCom' ); ?>" class="contact-form__field contact-form__field--textarea" required></textarea>
					</div>
					<div class="contact-form__item contact-form__item--none">
						<label for="contact-phone">
							<?php esc_html_e( 'Phone', 'APCom' ); ?>
						</label>
						<input type="text" name="contact-phone" id="contact-phone" pattern="[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}" value="" />
					</div>
					<input type="hidden" name="contact-submitted" value="1">
					<button class="contact-form__btn" type="submit">
						<span><?php esc_attr_e( 'Send', 'APCom' ); ?></span>
					</button>
				</form>
			</div>
			<?php get_sidebar( 'contact' ); ?>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/main/none' );
}
get_footer();

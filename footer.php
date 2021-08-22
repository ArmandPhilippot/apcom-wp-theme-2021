<?php
/**
 * The footer template.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 */

?>
	</main>
	<footer class="footer">
		<?php
			get_template_part( 'template-parts/footer/site', 'copyright' );
			get_template_part( 'template-parts/footer/site', 'nav' );
			get_template_part( 'template-parts/footer/site', 'back-to-top' );
		?>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>

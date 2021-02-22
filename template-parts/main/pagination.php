<?php
/**
 * The template for displaying pagination.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

if ( get_next_posts_link() || get_previous_posts_link() ) {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="pagination__icon pagination__icon--previous"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg>' . __( 'Previous', 'APCom' ),
			'next_text' => __( 'Next', 'APCom' ) . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33.442 15.531" class="pagination__icon pagination__icon--next"><path d="M0 10.221l20.697-.012v5.322l12.745-7.78L20.612 0v5.322L0 5.416v4.805z" /></svg>',
			'type'      => 'list',
			'class'     => 'articles',
		)
	);
} else {
	?>
	<div class="pagination pagination--missing box">
		<?php esc_html_e( 'No more articles.', 'APCom' ); ?>
	</div>
	<?php
}

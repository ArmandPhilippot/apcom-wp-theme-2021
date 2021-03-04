<?php
/**
 * The template for displaying breadcrumb.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.1
 */

$apcom_breadcrumb_data = array(
	1 => array(
		'url' => get_bloginfo( 'url' ),
		'txt' => __( 'Home', 'APCom' ),
	),
);

if ( is_home() ) {
	$apcom_breadcrumb_data += array(
		2 => array(
			'txt' => single_post_title( '', false ),
		),
	);
} elseif ( is_page() ) {
	$apcom_breadcrumb_data += array(
		2 => array(
			'txt' => single_post_title( '', false ),
		),
	);
} elseif ( is_search() ) {
	$apcom_breadcrumb_data += array(
		2 => array(
			'txt' => sprintf(
				// translators: %s: search query.
				esc_html__( 'Search results for: %s', 'APCom' ),
				get_search_query()
			),
		),
	);
} elseif ( is_404() ) {
	$apcom_breadcrumb_data += array(
		2 => array(
			'txt' => __( 'Page not found', 'APCom' ),
		),
	);
} else {
	$apcom_breadcrumb_data += array(
		2 => array(
			'url' => get_post_type_archive_link( 'post' ),
			'txt' => get_the_title( get_option( 'page_for_posts' ) ),
		),
	);
	if ( is_archive() ) {
		if ( is_category() ) {
			$apcom_breadcrumb_data += array(
				3 => array(
					'txt' => single_cat_title( '', false ),
				),
			);
		} elseif ( is_tag() ) {
			$apcom_breadcrumb_data += array(
				3 => array(
					'txt' => single_tag_title( '', false ),
				),
			);
		} elseif ( is_author() ) {
			$apcom_breadcrumb_data += array(
				3 => array(
					'txt' => get_the_author(),
				),
			);
		} elseif ( is_date() ) {
			$apcom_year         = get_the_date( _x( 'Y', 'yearly archives date format', 'APCom' ) );
			$apcom_month        = get_the_date( _x( 'F', 'monthly archives date format', 'APCom' ) );
			$apcom_month_number = get_the_date( _x( 'm', 'monthly archives date format', 'APCom' ) );
			$apcom_day          = get_the_date( _x( 'd', 'daily archives date format', 'APCom' ) );
			if ( is_day() ) {
				$apcom_breadcrumb_data += array(
					3 => array(
						'url' => get_year_link( $apcom_year ),
						'txt' => $apcom_year,
					),
				);
				$apcom_breadcrumb_data += array(
					4 => array(
						'url' => get_month_link( $apcom_year, $apcom_month_number ),
						'txt' => $apcom_month,
					),
				);
				$apcom_breadcrumb_data += array(
					5 => array(
						'txt' => $apcom_day,
					),
				);
			} elseif ( is_month() ) {
				$apcom_breadcrumb_data += array(
					3 => array(
						'url' => get_year_link( $apcom_year ),
						'txt' => $apcom_year,
					),
				);
				$apcom_breadcrumb_data += array(
					4 => array(
						'txt' => $apcom_month,
					),
				);
			} elseif ( is_year() ) {
				$apcom_breadcrumb_data += array(
					3 => array(
						'txt' => $apcom_year,
					),
				);
			}
		} else {
			$apcom_breadcrumb_data += array(
				3 => array(
					'txt' => get_the_archive_title(),
				),
			);
		}
	} elseif ( is_single() ) {
		$apcom_breadcrumb_data += array(
			3 => array(
				'txt' => single_post_title( '', false ),
			),
		);
	}
}

$apcom_breadcrumb_length = count( $apcom_breadcrumb_data );

if ( ! apcom_is_frontpage() ) {
	?>
	<nav class="breadcrumb" itemprop="breadcrumb">
		<span class="screen-reader-text">
			<?php esc_html_e( 'You are here:', 'APCom' ); ?>
		</span>
		<ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
			<?php
			foreach ( $apcom_breadcrumb_data as $apcom_depth => $apcom_data ) {
				?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb__item">
					<?php
					if ( $apcom_depth === $apcom_breadcrumb_length ) {
						?>
						<span itemprop="name" class="breadcrumb__name" aria-current="location">
							<?php echo esc_html( $apcom_breadcrumb_data[ $apcom_depth ]['txt'] ); ?>
						</span>
						<?php
					} else {
						?>
						<a itemprop="item" class="breadcrumb__link" href="<?php echo esc_url( $apcom_breadcrumb_data[ $apcom_depth ]['url'] ); ?>">
							<span itemprop="name" class="breadcrumb__name">
								<?php echo esc_html( $apcom_breadcrumb_data[ $apcom_depth ]['txt'] ); ?>
							</span>
						</a>
						<?php
					}
					?>
					<meta itemprop="position" content="<?php echo esc_attr( $apcom_depth ); ?>" />
				</li>
				<?php
			}
			?>
		</ol>
	</nav>
	<?php
}

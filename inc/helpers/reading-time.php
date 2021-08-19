<?php
/**
 * Helpers functions for getting the reading time.
 *
 * @package ArmandPhilippot-com
 * @since 1.2.0
 */

/**
 * Get a reading time estimation.
 *
 * @since  0.0.1
 *
 * @param  string $content The content to estimate.
 * @return int $reading_time An estimate time in minutes.
 */
function apcom_get_reading_time( $content ) {
	$cleaned_content           = wp_strip_all_tags( strip_shortcodes( $content ) );
	$words_number              = str_word_count( $cleaned_content );
	$words_per_minute          = 245;
	$words_per_second          = $words_per_minute / 60;
	$estimated_time_in_seconds = $words_number / $words_per_second;
	$estimated_time_in_minutes = floor( $estimated_time_in_seconds / 60 );
	$remaining_seconds         = round( $estimated_time_in_seconds - $estimated_time_in_minutes * 60 );

	if ( $estimated_time_in_minutes <= 0 ) {
		$reading_time = $remaining_seconds . ' ' . __( 'seconds', 'APCom' );
	} else {
		if ( $remaining_seconds > 30 ) {
			$estimated_time_in_minutes = $estimated_time_in_minutes + round( $remaining_seconds / 60 );
		}
		// translators: %s : reading time in minutes.
		$reading_time = _nx(
			'%s minute',
			'%s minutes',
			$estimated_time_in_minutes,
			'reading time',
			'APCom'
		);
		$reading_time = $estimated_time_in_minutes . ' ' . __( 'minutes', 'APCom' );
	}

	$reading_time_markup = sprintf(
		'<span title="%s">%2s</span>',
		sprintf(
			// translators: %s : number of words.
			__( 'Approximately %1$s words read at %2$s words per minute.', 'APCom' ),
			$words_number,
			$words_per_minute
		),
		$reading_time
	);

	return $reading_time_markup;
}

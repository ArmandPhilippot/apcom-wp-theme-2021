<?php
/**
 * Hooks related to ACF plugin.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.2
 */

/**
 * Filter relationship query to order posts by date
 *
 * @since  0.0.2
 *
 * @param  array $args The query args. See WP_Query for available args.
 * @param  array $field The field array containing all settings.
 * @param  int   $post_id The current post ID being edited.
 * @return array The custom query args.
 */
function apcom_relationship_query_by_date( $args, $field, $post_id ) {
	$args['order']   = 'DESC';
	$args['orderby'] = 'date';

	return $args;
}
add_filter( 'acf/fields/relationship/query', 'apcom_relationship_query_by_date', 10, 3 );

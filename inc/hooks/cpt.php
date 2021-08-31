<?php
/**
 * Hooks related to Custom Post Types.
 *
 * @package ArmandPhilippot-com
 * @since   1.2.0 Splitted from hooks.php
 */

/**
 * Add article & project CPT to the main query.
 *
 * @since  0.0.2
 *
 * @param  WP_Query $query The WP_Query instance (passed by reference).
 * @return WP_Query The custom query.
 */
function apcom_add_cpt_to_query( $query ) {
	if ( ( $query->is_home() || $query->is_date() ) && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'article', 'project' ) );

		return $query;
	}
}
add_action( 'pre_get_posts', 'apcom_add_cpt_to_query' );

/**
 * Add article & project CPT to the main RSS feed.
 *
 * @since  0.0.2
 *
 * @param  array $query_vars The array of requested query variables.
 * @return array The modified array of requested query variables.
 */
function apcom_feed_request( $query_vars ) {
	if ( isset( $query_vars['feed'] ) && ! isset( $query_vars['post_type'] ) ) {
		$query_vars['post_type'] = array( 'post', 'article', 'project' );
	}
	return $query_vars;
}
add_filter( 'request', 'apcom_feed_request' );

/**
 * Add article & project CPT to the recent posts.
 *
 * @since  0.0.2
 *
 * @param  array $args An array of arguments used to retrieve the recent posts.
 * @return array The custom arguments
 */
function apcom_widget_posts_args_add_cpt( $args ) {
	$args['post_type'] = array( 'post', 'article', 'project' );
	return $args;
}
add_filter( 'widget_posts_args', 'apcom_widget_posts_args_add_cpt' );

/**
 * Add article & project CPT to the WHERE clause for retrieving archives.
 *
 * @since  0.0.2
 *
 * @param  string $sql_where Portion of SQL query containing the WHERE clause.
 * @return string The custom where clause.
 */
function apcom_getarchives_where( $sql_where ) {
	$sql_where = str_replace( "post_type = 'post'", "post_type IN ( 'post', 'article', 'project' )", $sql_where );
	return $sql_where;
}
add_filter( 'getarchives_where', 'apcom_getarchives_where' );


<?php
/**
 * Custom post types registration.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

/**
 * Register a custom post type called "thematic".
 *
 * @see get_post_type_labels() for label keys.
 */
function apcom_thematic_init() {
	$labels = array(
		'name'                  => __( 'Thematics', 'APCom' ),
		'singular_name'         => __( 'Thematic', 'APCom' ),
		'menu_name'             => __( 'Thematics', 'APCom' ),
		'name_admin_bar'        => __( 'Thematic', 'APCom' ),
		'add_new'               => __( 'Add New', 'APCom' ),
		'add_new_item'          => __( 'Add New Thematic', 'APCom' ),
		'new_item'              => __( 'New Thematic', 'APCom' ),
		'edit_item'             => __( 'Edit Thematic', 'APCom' ),
		'view_item'             => __( 'View Thematic', 'APCom' ),
		'all_items'             => __( 'All Thematics', 'APCom' ),
		'search_items'          => __( 'Search Thematics', 'APCom' ),
		'parent_item_colon'     => __( 'Parent Thematics:', 'APCom' ),
		'not_found'             => __( 'No thematics found.', 'APCom' ),
		'not_found_in_trash'    => __( 'No thematics found in Trash.', 'APCom' ),
		'featured_image'        => __( 'Thematic Cover Image', 'APCom' ),
		'set_featured_image'    => __( 'Set cover image', 'APCom' ),
		'remove_featured_image' => __( 'Remove cover image', 'APCom' ),
		'use_featured_image'    => __( 'Use as cover image', 'APCom' ),
		'archives'              => __( 'Thematic archives', 'APCom' ),
		'insert_into_item'      => __( 'Insert into thematic', 'APCom' ),
		'uploaded_to_this_item' => __( 'Uploaded to this thematic', 'APCom' ),
		'filter_items_list'     => __( 'Filter thematics list', 'APCom' ),
		'items_list_navigation' => __( 'Thematics list navigation', 'APCom' ),
		'items_list'            => __( 'Thematics list', 'APCom' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => 'Thematic custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'thematic' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-category',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'thematic', $args );
}
add_action( 'init', 'apcom_thematic_init' );

/**
 * Register a custom post type called "thematic".
 *
 * @see get_post_type_labels() for label keys.
 */
function apcom_subject_init() {
	$labels = array(
		'name'                  => __( 'Subjects', 'APCom' ),
		'singular_name'         => __( 'Subject', 'APCom' ),
		'menu_name'             => __( 'Subjects', 'APCom' ),
		'name_admin_bar'        => __( 'Subject', 'APCom' ),
		'add_new'               => __( 'Add New', 'APCom' ),
		'add_new_item'          => __( 'Add New Subject', 'APCom' ),
		'new_item'              => __( 'New Subject', 'APCom' ),
		'edit_item'             => __( 'Edit Subject', 'APCom' ),
		'view_item'             => __( 'View Subject', 'APCom' ),
		'all_items'             => __( 'All Subjects', 'APCom' ),
		'search_items'          => __( 'Search Subjects', 'APCom' ),
		'parent_item_colon'     => __( 'Parent Subjects:', 'APCom' ),
		'not_found'             => __( 'No subjects found.', 'APCom' ),
		'not_found_in_trash'    => __( 'No subjects found in Trash.', 'APCom' ),
		'featured_image'        => __( 'Subject Cover Image', 'APCom' ),
		'set_featured_image'    => __( 'Set cover image', 'APCom' ),
		'remove_featured_image' => __( 'Remove cover image', 'APCom' ),
		'use_featured_image'    => __( 'Use as cover image', 'APCom' ),
		'archives'              => __( 'Subject archives', 'APCom' ),
		'insert_into_item'      => __( 'Insert into subject', 'APCom' ),
		'uploaded_to_this_item' => __( 'Uploaded to this subject', 'APCom' ),
		'filter_items_list'     => __( 'Filter subjects list', 'APCom' ),
		'items_list_navigation' => __( 'Subjects list navigation', 'APCom' ),
		'items_list'            => __( 'Subjects list', 'APCom' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => 'Subject custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'subject' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-tag',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'subject', $args );
}
add_action( 'init', 'apcom_subject_init' );

/**
 * Flushing rewrite on theme activation
 */
function apcom_rewrite_flush() {
	apcom_thematic_init();
	apcom_subject_init();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'apcom_rewrite_flush' );

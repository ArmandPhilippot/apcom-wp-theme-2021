<?php
/**
 * Custom post types registration.
 *
 * @package ArmandPhilippot-com
 * @since 0.0.2
 */

/**
 * Create the input option to change the thematic slug
 *
 * @since 0.0.2
 */
function apcom_thematic_base_output() {
	?>
	<input name="apcom_thematic_base" id="thematic_base" type="text" class="regular-text code" value="<?php echo esc_attr( get_option( 'apcom_thematic_base' ) ); ?>" placeholder="<?php echo 'thematic'; ?>" />
	<?php
}

/**
 * Create the input option to change the subject slug
 *
 * @since 0.0.2
 */
function apcom_subject_base_output() {
	?>
	<input name="apcom_subject_base" id="subject_base" type="text" class="regular-text code" value="<?php echo esc_attr( get_option( 'apcom_subject_base' ) ); ?>" placeholder="<?php echo 'subject'; ?>" />
	<?php
}

/**
 * Provide slug option for CPT in permalinks settings
 *
 * @since 0.0.2
 */
function apcom_add_cpt_slug_fields() {
	add_settings_field( 'apcom_thematic_base', __( 'Thematic base', 'APCom' ), 'apcom_thematic_base_output', 'permalink', 'optional', array( 'label_for' => 'thematic_base' ) );
	add_settings_field( 'apcom_subject_base', __( 'Subject base', 'APCom' ), 'apcom_subject_base_output', 'permalink', 'optional', array( 'label_for' => 'subject_base' ) );
}
add_action( 'admin_init', 'apcom_add_cpt_slug_fields' );

/**
 * Update the value of CPT slug options
 *
 * @since 0.0.2
 */
function apcom_update_cpt_slugs() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to manage options for this site.', 'APCom' ) );
	}

	if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['apcom_thematic_base'] ) || isset( $_POST['apcom_subject_base'] ) ) {
		check_admin_referer( 'update-permalink' );

		if ( isset( $_POST['apcom_thematic_base'] ) ) {
			$thematic_base = sanitize_text_field( wp_unslash( $_POST['apcom_thematic_base'] ) );

			if ( get_option( 'apcom_thematic_base' ) !== $thematic_base ) {
				update_option( 'apcom_thematic_base', $thematic_base );
			}
		}

		if ( isset( $_POST['apcom_subject_base'] ) ) {
			$subject_base = sanitize_text_field( wp_unslash( $_POST['apcom_subject_base'] ) );

			if ( get_option( 'apcom_subject_base' ) !== $subject_base ) {
				update_option( 'apcom_subject_base', $subject_base );
			}
		}
	}
}
add_action( 'admin_init', 'apcom_update_cpt_slugs' );


/**
 * Register a custom post type called "thematic".
 *
 * @see get_post_type_labels() for label keys.
 * @since 0.0.2
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

	if ( get_option( 'apcom_thematic_base' ) !== '' ) {
		$thematic_slug = get_option( 'apcom_thematic_base' );
	} else {
		$thematic_slug = 'thematic';
	}

	$args = array(
		'labels'             => $labels,
		'description'        => 'Thematic custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $thematic_slug ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-category',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'thematic', $args );
}
add_action( 'init', 'apcom_thematic_init' );

/**
 * Register a custom post type called "thematic".
 *
 * @see get_post_type_labels() for label keys.
 * @since 0.0.2
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

	if ( get_option( 'apcom_subject_base' ) !== '' ) {
		$subject_slug = get_option( 'apcom_subject_base' );
	} else {
		$subject_slug = 'subject';
	}

	$args = array(
		'labels'             => $labels,
		'description'        => 'Subject custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $subject_slug ),
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
 *
 * @since 0.0.2
 */
function apcom_rewrite_flush() {
	apcom_thematic_init();
	apcom_subject_init();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'apcom_rewrite_flush' );

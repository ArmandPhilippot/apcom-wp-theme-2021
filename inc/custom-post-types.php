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
 * Create the input option to change the article slug
 *
 * @since 0.0.2
 */
function apcom_article_base_output() {
	?>
	<input name="apcom_article_base" id="article_base" type="text" class="regular-text code" value="<?php echo esc_attr( get_option( 'apcom_article_base' ) ); ?>" placeholder="<?php echo 'article'; ?>" />
	<?php
}

/**
 * Create the input option to change the project slug
 *
 * @since 0.0.2
 */
function apcom_project_base_output() {
	?>
	<input name="apcom_project_base" id="project_base" type="text" class="regular-text code" value="<?php echo esc_attr( get_option( 'apcom_project_base' ) ); ?>" placeholder="<?php echo 'project'; ?>" />
	<?php
}

/**
 * Create the textarea option to change the project description display on
 * archive page.
 *
 * @since 0.0.2
 */
function apcom_project_description_output() {
	?>
	<textarea name="apcom_project_description" id="project_description" class="large-text code" placeholder="<?php esc_attr_e( 'This page lists the presentations of my different open source projects.', 'APCom' ); ?>" rows="10" cols="50"><?php echo esc_html( get_option( 'apcom_project_description' ) ); ?></textarea>
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
	add_settings_field( 'apcom_article_base', __( 'Article base', 'APCom' ), 'apcom_article_base_output', 'permalink', 'optional', array( 'label_for' => 'article_base' ) );
	add_settings_field( 'apcom_project_base', __( 'Project base', 'APCom' ), 'apcom_project_base_output', 'permalink', 'optional', array( 'label_for' => 'project_base' ) );
	add_settings_field( 'apcom_project_description', __( 'Project description', 'APCom' ), 'apcom_project_description_output', 'permalink', 'optional', array( 'label_for' => 'project_description' ) );
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

	if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['apcom_thematic_base'] ) || isset( $_POST['apcom_subject_base'] ) || isset( $_POST['apcom_article_base'] ) || isset( $_POST['apcom_project_base'] ) ) {
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

		if ( isset( $_POST['apcom_article_base'] ) ) {
			$article_base = sanitize_text_field( wp_unslash( $_POST['apcom_article_base'] ) );

			if ( get_option( 'apcom_article_base' ) !== $article_base ) {
				update_option( 'apcom_article_base', $article_base );
			}
		}

		if ( isset( $_POST['apcom_project_base'] ) ) {
			$project_base = sanitize_text_field( wp_unslash( $_POST['apcom_project_base'] ) );

			if ( get_option( 'apcom_project_base' ) !== $project_base ) {
				update_option( 'apcom_project_base', $project_base );
			}
		}
	}
}
add_action( 'admin_init', 'apcom_update_cpt_slugs' );

/**
 * Update the value of CPT description options
 *
 * @since 0.0.2
 */
function apcom_update_cpt_descriptions() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to manage options for this site.', 'APCom' ) );
	}

	if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['apcom_project_description'] ) ) {
		check_admin_referer( 'update-permalink' );

		$project_description = wp_kses_post( wp_unslash( $_POST['apcom_project_description'] ) );

		if ( get_option( 'apcom_project_description' ) !== $project_description ) {
			update_option( 'apcom_project_description', $project_description );
		}
	}
}
add_action( 'admin_init', 'apcom_update_cpt_descriptions' );

/**
 * Register a custom post type called "article".
 *
 * @see get_post_type_labels() for label keys.
 * @since 0.0.2
 */
function apcom_article_init() {
	$labels = array(
		'name'                  => __( 'Articles', 'APCom' ),
		'singular_name'         => __( 'Article', 'APCom' ),
		'menu_name'             => __( 'Articles', 'APCom' ),
		'name_admin_bar'        => __( 'Article', 'APCom' ),
		'add_new'               => __( 'Add New', 'APCom' ),
		'add_new_item'          => __( 'Add New Article', 'APCom' ),
		'new_item'              => __( 'New Article', 'APCom' ),
		'edit_item'             => __( 'Edit Article', 'APCom' ),
		'view_item'             => __( 'View Article', 'APCom' ),
		'all_items'             => __( 'All Articles', 'APCom' ),
		'search_items'          => __( 'Search Articles', 'APCom' ),
		'parent_item_colon'     => __( 'Parent Articles:', 'APCom' ),
		'not_found'             => __( 'No articles found.', 'APCom' ),
		'not_found_in_trash'    => __( 'No articles found in Trash.', 'APCom' ),
		'featured_image'        => __( 'Article Cover Image', 'APCom' ),
		'set_featured_image'    => __( 'Set cover image', 'APCom' ),
		'remove_featured_image' => __( 'Remove cover image', 'APCom' ),
		'use_featured_image'    => __( 'Use as cover image', 'APCom' ),
		'archives'              => __( 'Article archives', 'APCom' ),
		'insert_into_item'      => __( 'Insert into article', 'APCom' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'APCom' ),
		'filter_items_list'     => __( 'Filter articles list', 'APCom' ),
		'items_list_navigation' => __( 'Articles list navigation', 'APCom' ),
		'items_list'            => __( 'Articles list', 'APCom' ),
	);

	if ( get_option( 'apcom_article_base' ) !== '' ) {
		$article_slug = get_option( 'apcom_article_base' );
	} else {
		$article_slug = 'article';
	}

	$args = array(
		'labels'             => $labels,
		'description'        => 'Article custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $article_slug ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-welcome-write-blog',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'article', $args );
}
add_action( 'init', 'apcom_article_init' );

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
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-category',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'thematic', $args );
}
add_action( 'init', 'apcom_thematic_init' );

/**
 * Register a custom post type called "subject".
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
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-tag',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'subject', $args );
}
add_action( 'init', 'apcom_subject_init' );

/**
 * Register a custom post type called "project".
 *
 * @see get_post_type_labels() for label keys.
 * @since 0.0.2
 */
function apcom_project_init() {
	$labels = array(
		'name'                  => __( 'Projects', 'APCom' ),
		'singular_name'         => __( 'Project', 'APCom' ),
		'menu_name'             => __( 'Projects', 'APCom' ),
		'name_admin_bar'        => __( 'Project', 'APCom' ),
		'add_new'               => __( 'Add New', 'APCom' ),
		'add_new_item'          => __( 'Add New Project', 'APCom' ),
		'new_item'              => __( 'New Project', 'APCom' ),
		'edit_item'             => __( 'Edit Project', 'APCom' ),
		'view_item'             => __( 'View Project', 'APCom' ),
		'all_items'             => __( 'All Projects', 'APCom' ),
		'search_items'          => __( 'Search Projects', 'APCom' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'APCom' ),
		'not_found'             => __( 'No projects found.', 'APCom' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'APCom' ),
		'featured_image'        => __( 'Project Cover Image', 'APCom' ),
		'set_featured_image'    => __( 'Set cover image', 'APCom' ),
		'remove_featured_image' => __( 'Remove cover image', 'APCom' ),
		'use_featured_image'    => __( 'Use as cover image', 'APCom' ),
		'archives'              => __( 'Project archives', 'APCom' ),
		'insert_into_item'      => __( 'Insert into project', 'APCom' ),
		'uploaded_to_this_item' => __( 'Uploaded to this project', 'APCom' ),
		'filter_items_list'     => __( 'Filter projects list', 'APCom' ),
		'items_list_navigation' => __( 'Projects list navigation', 'APCom' ),
		'items_list'            => __( 'Projects list', 'APCom' ),
	);

	if ( get_option( 'apcom_project_base' ) !== '' ) {
		$project_slug = get_option( 'apcom_project_base' );
	} else {
		$project_slug = 'project';
	}

	if ( get_option( 'apcom_project_description' ) !== '' ) {
		$project_description = get_option( 'apcom_project_description' );
	} else {
		$project_description = __( 'This page lists the presentations of my different open source projects.', 'APCom' );
	}

	$args = array(
		'labels'             => $labels,
		'description'        => $project_description,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $project_slug ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 8,
		'menu_icon'          => 'dashicons-open-folder',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'apcom_project_init' );

/**
 * Flushing rewrite on theme activation
 *
 * @since 0.0.2
 */
function apcom_rewrite_flush() {
	apcom_article_init();
	apcom_thematic_init();
	apcom_subject_init();
	apcom_project_init();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'apcom_rewrite_flush' );

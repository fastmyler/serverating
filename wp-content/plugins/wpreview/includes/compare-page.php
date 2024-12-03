<?php

function compare_providers_create() {
	$labels = array(
		'name'                  => _x( 'Compare Providers', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Compare Provider', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Compare Providers', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Compare Provider', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Compare Provider', 'textdomain' ),
		'new_item'              => __( 'New Compare Provider', 'textdomain' ),
		'edit_item'             => __( 'Edit Compare Provider', 'textdomain' ),
		'view_item'             => __( 'View Compare Provider', 'textdomain' ),
		'all_items'             => __( 'All Compare Providers', 'textdomain' ),
		'search_items'          => __( 'Search Compare Providers', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Compare Providers:', 'textdomain' ),
		'not_found'             => __( 'No Compare Providers found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No Compare Providers found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Provider Cover Image', 'Overrides the “Featured Image” phrase for this post type.', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type.', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type.', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type.', 'textdomain' ),
		'archives'              => _x( 'Compare Provider Archives', 'The post type archive label used in nav menus.', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into Compare Provider', 'Overrides the “Insert into post” phrase.', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Compare Provider', 'Overrides the “Uploaded to this post” phrase.', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter Compare Providers list', 'Screen reader text for the filter links heading.', 'textdomain' ),
		'items_list_navigation' => _x( 'Compare Providers list navigation', 'Screen reader text for the pagination heading.', 'textdomain' ),
		'items_list'            => _x( 'Compare Providers list', 'Screen reader text for the items list heading.', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'compare-providers' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'compare_providers', $args );
}

add_action( 'init', 'compare_providers_create' );


function compare_providers_meta_box() {
    add_meta_box(
        'compare_providers_meta', 
        'Select Posts to Compare', 
        'compare_providers_meta_box_callback', 
        'compare_providers',
        'normal', 
        'high' 
    );
}
add_action('add_meta_boxes', 'compare_providers_meta_box');

function compare_providers_meta_box_callback($post) {
    // Nonce for security
    wp_nonce_field('compare_providers_meta_box_nonce', 'compare_providers_nonce');
    
    // Get saved values (if any)
    $post_1 = get_post_meta($post->ID, '_compare_post_1', true);
    $post_2 = get_post_meta($post->ID, '_compare_post_2', true);
    
    // Query for posts to populate the dropdown
    $args = array(
        'post_type' => 'review_item', // Adjust to your post type
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );
    $posts = get_posts($args);

    echo '<label for="compare_post_1">First Post:</label>';
    echo '<select name="compare_post_1" id="compare_post_1">';
    echo '<option value="">Select a post</option>';
    foreach ($posts as $single_post) {
        echo '<option value="' . $single_post->ID . '"' . selected($post_1, $single_post->ID, false) . '>' . $single_post->post_title . '</option>';
    }
    echo '</select>';
    
    echo '<label for="compare_post_2">Second Post:</label>';
    echo '<select name="compare_post_2" id="compare_post_2">';
    echo '<option value="">Select a post</option>';
    foreach ($posts as $single_post) {
        echo '<option value="' . $single_post->ID . '"' . selected($post_2, $single_post->ID, false) . '>' . $single_post->post_title . '</option>';
    }
    echo '</select>';
}


function save_compare_providers_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['compare_providers_nonce']) || !wp_verify_nonce($_POST['compare_providers_nonce'], 'compare_providers_meta_box_nonce')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save values
    if (isset($_POST['compare_post_1'])) {
        update_post_meta($post_id, '_compare_post_1', sanitize_text_field($_POST['compare_post_1']));
    }
    if (isset($_POST['compare_post_2'])) {
        update_post_meta($post_id, '_compare_post_2', sanitize_text_field($_POST['compare_post_2']));
    }
}
add_action('save_post', 'save_compare_providers_meta');
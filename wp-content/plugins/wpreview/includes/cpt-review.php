<?php

// Function that will register the Custom Post type named - review_items
function cpt_review_create() {
	$labels = array(
		'name'                  => _x( 'Reviews', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Review Item', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Review Items', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Review Item', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Review Item', 'textdomain' ),
		'new_item'              => __( 'New Review Item', 'textdomain' ),
		'edit_item'             => __( 'Edit Review Item', 'textdomain' ),
		'view_item'             => __( 'View Review Item', 'textdomain' ),
		'all_items'             => __( 'All Review Items', 'textdomain' ),
		'search_items'          => __( 'Search Review Items', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Review Items:', 'textdomain' ),
		'not_found'             => __( 'No Review Items found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No Review Items found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Review Item Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Review Item archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into Review Item', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Review Item', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter Review Items list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Review Items list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Review Items list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ReviewItem' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'review_item', $args );
}

add_action( 'init', 'cpt_review_create' );


?>
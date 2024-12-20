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

function review_item_tags() {
	// Add new taxonomy, NOT hierarchical (like tags)
$labels = array(
	'name'                       => _x( 'Hosting Categories', 'taxonomy general name', 'textdomain' ),
	'singular_name'              => _x( 'Hosting Category', 'taxonomy singular name', 'textdomain' ),
	'search_items'               => __( 'Search Categories', 'textdomain' ),
	'popular_items'              => __( 'Popular Categories', 'textdomain' ),
	'all_items'                  => __( 'All Categories', 'textdomain' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Category', 'textdomain' ),
	'update_item'                => __( 'Update Category', 'textdomain' ),
	'add_new_item'               => __( 'Add New Category', 'textdomain' ),
	'new_item_name'              => __( 'New Category Name', 'textdomain' ),
	'separate_items_with_commas' => __( 'Separate categories with commas', 'textdomain' ),
	'add_or_remove_items'        => __( 'Add or remove Category', 'textdomain' ),
	'choose_from_most_used'      => __( 'Choose from the most used Categories', 'textdomain' ),
	'not_found'                  => __( 'No Categories found.', 'textdomain' ),
	'menu_name'                  => __( 'Hosting Categories', 'textdomain' ),
);

$args = array(
	'hierarchical'          => false,
	'labels'                => $labels,
	'show_ui'               => true,
	'show_admin_column'     => true,
	'update_count_callback' => '_update_post_term_count',
	'query_var'             => true,
	'rewrite'               => array( 'slug' => 'hosting-category' ),
);

register_taxonomy( 'hosting-catgeory', 'review_item', $args );
}

add_action('init','review_item_tags')
?>




<?php // Show all the providers 
function show_all(){

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
        'post_type'           => 'review_item',
        'post_status'         => 'publish',
        'posts_per_page'      => '5',
		'paged'          	  => $paged, 
        'meta_key'       => 'expert_score',    
        'orderby'        => 'meta_value_num', 
        'order'          => 'DESC',
    );


    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="container" id="listing_cont">
                <div class="image_title_rating">
                    <div id="post_image_rev">
                        <?php
                        if ( has_post_thumbnail() ) {
                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                            echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                        } else {
                            echo 'No Featured Image';
                        }
                        ?>
                    </div>

                    <div id="post_raiting_list">
                        <h6>Customer Reviews Posted</h6>
                        <?php echo comments_number('No Reviews', '1 Review', '% Reviews') ?>
                        <h6>Lowest Price</h6>
                        <?php echo echo_lowest_price()?>
                    </div>
                    <div id="post_raiting_list">
                        <h6>Customer's Score</h6>
                        <span class="fa fa-star" style="color: #6168ff;"></span>
                        <?php star_rating_total_post_average( get_the_ID() ); ?>
                        <h6>Expert's Score</h6>
                        <span class="fa fa-star" style="color: #6168ff;"></span>
                        <?php echo echo_expert_score(); ?>
                    </div>
                    <div id="post_raiting_list">
                    <a href="<?php echo_affiliate_url()?>" class="list_visit" >Visit <?php echo get_the_title()?></a>
                    <a class="list_review" href="<?php echo get_permalink()?>">Reviews</a>
                    </div>
                </div>
            </div>
        <?php 
    endwhile; ?>
	<div class=pagination_all>
	<div class="pagination">
	<?php
	echo paginate_links(array(
		'total'   => $the_query->max_num_pages,
		'current' => $paged,
		'format'  => '?paged=%#%',
		'show_all' => false,
		'type'    => 'list',
		'prev_text' => __('« Previous'),
		'next_text' => __('Next »'),
	));
	?>
	</div>
	</div>
<?php
    endif;
}

add_shortcode('show_all_shortcode','show_all');
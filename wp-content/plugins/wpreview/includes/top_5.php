<?php
// Add the metabox for Order in the list 
function top_sort_metabox() {
    add_meta_box(
        'top_sort_metabox_id',          // Unique ID for the metabox
        'Sort Order',                     // Title of the metabox
        'top_sort_metabox_callback',    // Callback function that renders the metabox
        'review_item',                      // Post type where it will appear
        'side',                             // Context: where on the screen (side, normal, or advanced)
        'default'                           // Priority: default, high, low
    );
}

add_action( 'add_meta_boxes', 'top_sort_metabox' );

// Callback function for rendering the metabox
function top_sort_metabox_callback( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'top_sort_metabox_nonce_action', 'top_sort_metabox_nonce' );

    // Retrieve the saved meta value if it exists
    $top_sort = get_post_meta( $post->ID, 'top_sort', true ); 

    // Create the input field
    echo '<label for="top_sort_field">Order in the top list:</label>';
    echo '<input type="text" id="top_sort_field" name="top_sort_field" value="' . esc_attr( $top_sort ) . '" style="width: 100%;" />';
}

// Save the metabox data
function save_top_sort_metabox_data( $post_id ) {
    // Check nonce for security
    if ( ! isset( $_POST['top_sort_metabox_nonce'] ) || 
         ! wp_verify_nonce( $_POST['top_sort_metabox_nonce'], 'top_sort_metabox_nonce_action' ) ) {
        return;
    }

    // Prevent autosave from overwriting data
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Ensure the user has permission to edit the post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save the lowest price
    if ( isset( $_POST['top_sort_field'] ) ) {
        $top_sort = sanitize_text_field( $_POST['top_sort_field'] );
        update_post_meta( $post_id, 'top_sort', $top_sort );
    }
}

add_action( 'save_post', 'save_top_sort_metabox_data' );
?>

<?php
function top_5(){

    $args = array(
        'post_type'           => 'review_item',
        'post_status'         => 'publish',
        'posts_per_page'      => '5',
        'meta_key'       => 'top_sort',    
        'orderby'        => 'meta_value_num', 
        'order'          => 'ASC',
    );


    $the_query = new WP_Query( $args );
    $i=1;

    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php
            
            echo '<div class="rank-circle">'.$i.'</div>';
        ?>
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
         $i++;    
    endwhile;
    else : ?>
        <p>No posts found.</p>
    <?php endif;
}

add_shortcode('top5','top_5');

?>
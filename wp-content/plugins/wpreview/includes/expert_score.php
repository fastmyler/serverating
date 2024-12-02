<?php 

// Add the metabox
function expert_score_metabox() {
    add_meta_box(
        'expert_score_metabox_id',         // Unique ID for the metabox
        'Expert Score',                    // Title of the metabox
        'expert_score_metabox_callback',   // Callback function that renders the metabox
        'review_item',                     // Post type where it will appear
        'side',                            // Context: where on the screen (side, normal, or advanced)
        'default'                          // Priority: default, high, low
    );
}

add_action( 'add_meta_boxes', 'expert_score_metabox' );

// Callback function for rendering the metabox
function expert_score_metabox_callback( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'expert_score_metabox_nonce_action', 'expert_score_metabox_nonce' );

    // Retrieve the saved meta value if it exists
    $expert_score = get_post_meta( $post->ID, 'expert_score', true ); 

    // Create the input field
    echo '<label for="expert_score_field">Expert Score:</label>';
    echo '<input type="text" id="expert_score_field" name="expert_score_field" value="' . esc_attr( $expert_score ) . '" style="width: 100%;" />';
}

// Save the metabox data
function save_expert_score_metabox_data( $post_id ) {
    // Check nonce for security
    if ( ! isset( $_POST['expert_score_metabox_nonce'] ) || 
         ! wp_verify_nonce( $_POST['expert_score_metabox_nonce'], 'expert_score_metabox_nonce_action' ) ) {
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

    // Save the expert score
    if ( isset( $_POST['expert_score_field'] ) ) {
        $expert_score = sanitize_text_field( $_POST['expert_score_field'] );
        update_post_meta( $post_id, 'expert_score', $expert_score );
    }
}

add_action( 'save_post', 'save_expert_score_metabox_data' );

// Function to echo the expert score
function echo_expert_score() { 
    $post_id = get_the_ID();
    $expert_score = get_post_meta( $post_id, 'expert_score', true );
    echo $expert_score;
}

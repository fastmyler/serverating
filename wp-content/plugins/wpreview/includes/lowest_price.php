<?php // Adding a metabox for lowest_price_metabox 

// Add the metabox
function lowest_price_metabox() {
    add_meta_box(
        'lowest_price_metabox_id',          // Unique ID for the metabox
        'Lowest Price',                     // Title of the metabox
        'lowest_price_metabox_callback',    // Callback function that renders the metabox
        'review_item',                      // Post type where it will appear
        'side',                             // Context: where on the screen (side, normal, or advanced)
        'default'                           // Priority: default, high, low
    );
}

add_action( 'add_meta_boxes', 'lowest_price_metabox' );

// Callback function for rendering the metabox
function lowest_price_metabox_callback( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'lowest_price_metabox_nonce_action', 'lowest_price_metabox_nonce' );

    // Retrieve the saved meta value if it exists
    $lowest_price = get_post_meta( $post->ID, 'lowest_price', true ); 

    // Create the input field
    echo '<label for="lowest_price_field">Lowest Price:</label>';
    echo '<input type="text" id="lowest_price_field" name="lowest_price_field" value="' . esc_attr( $lowest_price ) . '" style="width: 100%;" />';
}

// Save the metabox data
function save_lowest_price_metabox_data( $post_id ) {
    // Check nonce for security
    if ( ! isset( $_POST['lowest_price_metabox_nonce'] ) || 
         ! wp_verify_nonce( $_POST['lowest_price_metabox_nonce'], 'lowest_price_metabox_nonce_action' ) ) {
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
    if ( isset( $_POST['lowest_price_field'] ) ) {
        $lowest_price = sanitize_text_field( $_POST['lowest_price_field'] );
        update_post_meta( $post_id, 'lowest_price', $lowest_price );
    }
}

add_action( 'save_post', 'save_lowest_price_metabox_data' );

// Function to echo the lowest price
function echo_lowest_price() { 
    $post_id = get_the_ID();
    $lowest_price = get_post_meta( $post_id, 'lowest_price', true );
    echo $lowest_price;
}

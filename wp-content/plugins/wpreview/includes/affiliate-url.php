<?php 

// Creating affiliate_URL metabox which will be used mostly with <a href=> nad buttons 
function affiliate_url_metabox() {
    add_meta_box(
        'affiliate_url_metabox_id',         // Unique ID for the metabox
        'Affiliate URL',                    // Title of the metabox
        'affiliate_url_metabox_callback',   // Callback function that renders the metabox
        'review_item',                      // Post type where it will appear
        'side',                             // Context: where on the screen (side, normal, or advanced)
        'default'                           // Priority: default, high, low
    );
}

add_action( 'add_meta_boxes', 'affiliate_url_metabox' );

// Adding the metabox to Admin Dashboard
function affiliate_url_metabox_callback( $post ) {
    wp_nonce_field( 'affiliate_url_metabox_nonce_action', 'affiliate_url_metabox_nonce' );
    $affiliate_url = get_post_meta( $post->ID, 'affiliate_url', true ); 

    echo '<label for="affiliate_url_address">Affiliate URL:</label>';
    echo '<input type="text" id="affiliate_url_address" name="affiliate_url_address" value="' . esc_attr( $affiliate_url ) . '" style="width: 100%;" />';
}

//Saving the affiliate URL into the DB 
function save_affiliate_url_metabox_data( $post_id ) {
    if ( ! isset( $_POST['affiliate_url_metabox_nonce'] ) || 
         ! wp_verify_nonce( $_POST['affiliate_url_metabox_nonce'], 'affiliate_url_metabox_nonce_action' ) ) {
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

    // Save the affiliate URL
    if ( isset( $_POST['affiliate_url_address'] ) ) {
        $affiliate_url = sanitize_text_field( $_POST['affiliate_url_address'] );
        update_post_meta( $post_id, 'affiliate_url', $affiliate_url ); // Using a better meta key
    }
}

add_action( 'save_post', 'save_affiliate_url_metabox_data' );

// Function that will echo the affiliate URL
function echo_affiliate_url() { 

    $post_id=get_the_ID();
    $affiliate_url =  get_post_meta($post_id,'affiliate_url',true);
    echo esc_url($affiliate_url);
}   
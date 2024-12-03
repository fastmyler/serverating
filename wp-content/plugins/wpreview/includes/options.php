<?php
/**
 * Generated Options Page
 */

// Hook to initialize the settings
add_action( 'admin_init', 'wpreview_plugin_settings_init' );

/**
 * Initializes settings and registers them with the Settings API.
 */
function wpreview_plugin_settings_init() {
    // Register the setting to store options in the database
    register_setting( 'wpreview_custom_options_group', 'wpreview_custom_options' );

    // Add a settings section
    add_settings_section(
        'custom_plugin_main_section', // Section ID
        __( 'wpreview Settings', 'wpreview' ), // Section title
        'wpreview_plugin_section_callback', // Callback function for the section
        'wpreview_custom_options' // Page to display the section
    );

    // Add a field for the text input
    add_settings_field(
        'wpreview_choose_avatar', // Field ID
        __( 'Choose Avatar', 'wpreview' ), // Label for the field
        'wpreviewt_choose_avatar_callback', // Callback function for rendering the field
        'wpreview_custom_options', // Page where the field will be displayed
        'custom_plugin_main_section' // Section where the field belongs
    );

}

/**
 * Callback function for the main section description.
 */
function wpreview_plugin_section_callback() {
    echo '<p>' . __( 'Configure the main settings for this plugin.', 'wpreview' ) . '</p>';
}


function wpreview_enqueue_media_uploader() {
    // Make sure we are only loading this script on the plugin's settings page
    if ( isset( $_GET['page'] ) && $_GET['page'] === 'wpreview-custom-options' ) {
        // Enqueue WordPress media scripts
        wp_enqueue_media();
        
        // Enqueue jQuery
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'admin_enqueue_scripts', 'wpreview_enqueue_media_uploader' );

/**
 * Callback function for rendering the text field.
 */
function wpreviewt_choose_avatar_callback() {
    // Retrieve the existing value from the database
    $options = get_option( 'wpreview_custom_options' );
    $value   = isset( $options['wpreview_avatar'] ) ? esc_url( $options['wpreview_avatar'] ) : '';

    ?>
    <input type="text" name="wpreview_custom_options[wpreview_avatar]" id="wpreview-avatar-url" value="<?php echo $value; ?>" />
    <button type="button" class="button" id="wpreview-avatar-button"><?php esc_html_e( 'Choose Avatar', 'wpreview' ); ?></button>
    <p class="description"><?php esc_html_e( 'Choose the Avatar.', 'wpreview' ); ?></p>

    <script type="text/javascript">
        // JavaScript for media uploader
        jQuery(document).ready(function($){
            var mediaUploader;

            $('#wpreview-avatar-button').click(function(e) {
                e.preventDefault();

                // If the uploader object has already been created, reopen the dialog
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                // Create a new media uploader object
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: '<?php esc_html_e( 'Choose Avatar', 'wpreview' ); ?>',
                    button: {
                        text: '<?php esc_html_e( 'Choose Avatar', 'wpreview' ); ?>'
                    },
                    multiple: false // Allow only one file to be selected
                });

                // When an image is selected, set the input field value to the image URL
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#wpreview-avatar-url').val(attachment.url); // Set the URL to the input field
                });

                // Open the uploader dialog
                mediaUploader.open();
            });
        });
    </script>
    <?php
}



// Hook to add the options page to the admin menu
add_action( 'admin_menu', 'custom_plugin_add_options_page' );

/**
 * Adds the options page to the admin menu.
 */
function custom_plugin_add_options_page() {
    add_options_page(
        __( 'wpreview Options', 'wpreview' ), // Page title
        __( 'wpreview Options', 'wpreview' ), // Menu title
        'manage_options', // Capability required to access the page
        'wpreview-custom-options', // Menu slug
        'wpreview_custom_options_page_callback' // Callback function to render the page
    );
}

/**
 * Renders the options page content.
 */
function wpreview_custom_options_page_callback() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'wpreview Options', 'wpreview' ); ?></h1>
        <form action="options.php" method="post">
            <?php

            // Output nonce, action, and option page fields for the settings page
            settings_fields( 'wpreview_custom_options_group' );

            // Output settings sections and fields
            do_settings_sections( 'wpreview_custom_options' );

            // Output the save settings button
            submit_button( __( 'Update Settings', 'wpreview' ) );
            ?>
        </form>
    </div>
    <?php
}
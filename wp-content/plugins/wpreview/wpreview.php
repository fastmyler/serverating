<?php
/*
 * Plugin Name: WpReview
 * Description: Complete Review Solution
 */

 require('includes/cpt-review.php');
 require('includes/starreview.php');
 require('includes/affiliate-url.php');
 require('includes/lowest_price.php');
 require('includes/expert_score.php');
 require('includes/top_5.php');
 require('includes/top_3_related.php');
 require('includes/compare-page.php');
 require('includes/options.php');

 function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('ajax-show-more', plugins_url('/assets/ajax-show-more.js', __FILE__), array('jquery'), null, true);
    
    // Add localized data for the AJAX URL
    wp_localize_script('ajax-show-more', 'ajax_show_more_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


?>

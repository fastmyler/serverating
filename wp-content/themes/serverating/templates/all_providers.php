<?php
/**
 * Template Name: All Providers
 */
?>

<?php get_header(); ?>    

 <!-- Services -->
    <div id="main_home">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <h2 style="color: #006dad;text-align:center;">All Providers</h2>
                <?php echo do_shortcode('[show_all_shortcode]'); ?>
            </div> 
            <div class="search">
            <h2 style="color: #006dad;text-align:center;">Search for Providers and more</h2>
                <?php get_search_form(); ?>
            </div>
            </div> 
        </div> 
    </div> 
   

    <?php get_footer(); ?>
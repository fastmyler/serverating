<?php
/**
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>    
 


 <!-- Services -->
    <div id="main_home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <h2 style="color: #006dad;text-align:center;">Best Hosting Providers December 2024</h2>
                <?php echo do_shortcode('[top5]'); ?>
                <h2 style="color: #006dad;text-align:center;margin-top:70px;">Compare Providers</h2>
                <?php show_compare_items(3)?>
                <div style="display: block;text-align:center;"><button id="load-more" data-offset="3">Show More</button></div>
                <br>
                <h2 style="color: #006dad;text-align:center;margin-top:70px;">Latest Blogs</h2>
                <?php do_shortcode('[related_posts]')?>

                </div> 
            </div> 
        </div> 
    </div> 
   

    <?php get_footer(); ?>
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
   

                </div> 
            </div> 
        </div> 
    </div> 
   

    <?php get_footer(); ?>
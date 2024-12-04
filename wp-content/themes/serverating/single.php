<?php get_header(); ?>    

    <!-- Image -->
    <div id="title_main ">
        <div class="single_container">
            <div class="single_row">
                <div id="post_image">
                    <?php
                    if ( has_post_thumbnail() ) {
                        $image_url = get_the_post_thumbnail_url( get_the_ID()); // 'full' can be replaced with other sizes (thumbnail, medium, large)
                    
                        // Output the featured image with a link to the image URL
                        echo '<img class="mt-5 mb-3" src="' . esc_url( $image_url ) . '" />';
                    } else {
                        echo 'No featured image found.'; // MAKE THIS IMAGE TO BE AN DEFAULT BLOG IMAGE
                    }
                    ?>
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- end of Image -->

    <!-- Title -->
    <div class="title_main  ">
    <h2 class="post_title"><?php echo get_the_title()?></h2>
    <h6><?php echo get_the_date( 'F j, Y' )?></h6>
    </div>
    <!-- end of Title -->

    <!-- Content -->
    <div class="content_main">
        <div class="single_container">
            <div class="single_row">
                <div class="content_main">
                       <?php the_content(); ?>
                </div> 
            </div> 
        </div> 
    </div> 
<h2 class="post_title">Best Hosting Providers</h2>

    <?php do_shortcode('[top3]')?>

    <?php get_footer(); ?>
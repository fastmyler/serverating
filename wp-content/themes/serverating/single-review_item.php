<?php get_header(); ?>    

<div class="mobile_header">
                        <div class="sidebar_div_in">
                        <div class="div_mobile_in">
                        <?php
                            
                            $image_url = get_the_post_thumbnail_url( get_the_ID());                        
                            echo '<img class=sidebar_div_img  src="' . esc_url( $image_url ) . '" />';
                            ?>
                            <a href="<?php ?>" class="sidebar_visit">Visit <?php echo get_the_title()?></a>
                        </div>
                            <ul class="sidebar_div_ul">
                                <li class="sidebar_div_il"><a href="#review_content" class="sidebar_scroll_link">Expert Review</a></li>
                                <li class="sidebar_div_il"><a href="#comments" class="sidebar_scroll_link">Customers Review</a></li>
                                <li class="sidebar_div_il"><a href="#alternative_solutions" class="sidebar_scroll_link">Alternative Solutions</a></li>
                            </ul>
                        </div>
</div>


<div class="main_conteiner_single">
    <div class="main_content_single">
        <!-- Image -->
        <div class="ex-basic-1 pt-5 pb-5">
            <div class="container" id="review_content">
                <div class="image_title_rating">
                    <div id="post_image_rev">
                        <?php
                        if ( has_post_thumbnail() ) {
                            $image_url = get_the_post_thumbnail_url( get_the_ID()); // 'full' can be replaced with other sizes (thumbnail, medium, large)
                        
                            // Output the featured image with a link to the image URL
                            echo '<img  src="' . esc_url( $image_url ) . '" />';
                        } else {
                            echo 'No featured image found.'; // MAKE THIS IMAGE TO BE AN DEFAULT BLOG IMAGE
                        }
                        ?>
                    </div>
                    <div id="post_raiting_single">
                    <h6>Lowest Price</h6>
                    <?php echo echo_lowest_price()?>
                    </div>
                    <div id="post_raiting_single">
                    <h6>Customer's Score</h6>
                    <span class="fa fa-star" style="color: #6168ff;"></span>
                    <?php star_rating_total_post_average(get_the_ID()); ?>
                    </div>
                    <div id="post_raiting_single">
                    <h6>Expert's Score</h6>
                    <span class="fa fa-star" style="color: #6168ff;"></span>
                    <?php echo echo_expert_score()?>
                    </div>

                </div> 
            </div> 
        </div> 

     <!-- Content -->
        <div class="ex-basic-1 pt-4">
            <div class="container">
                <div class="row" id="side-row">
                    <div class="review_content_div">
                        <div>
                        <h2 class="review_h6"><?php echo get_the_title()?> - Expert Review</h2></div>
                        <?php the_content(); ?>
                        <br>
                        <?php
                            // Place the comments section after the post content
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>
                    </div> 
                    <div class="sidebar_div">
                        <div class="sidebar_div_in">
                        <?php
                            $image_url = get_the_post_thumbnail_url( get_the_ID());                        
                            echo '<img class=sidebar_div_img  src="' . esc_url( $image_url ) . '" />';
                            ?>
                            <ul class="sidebar_div_ul">
                            
                            <li class="sidebar_div_il"><a href="#review_content" class="sidebar_scroll_link">Expert Review</a></li>
                            <li class="sidebar_div_il"><a href="#comments" class="sidebar_scroll_link">Customers Review</a></li>
                            <li class="sidebar_div_il"><a href="#alternative_solutions" class="sidebar_scroll_link">Alternative Solutions</a></li>
                            </ul>
                            <div class="side_rat">
                            <h6 style="color:#0073a1;">Expert's Score</h6>
                            <span class="fa fa-star" style="color: #6168ff;"> </span><span><?php echo echo_expert_score()?></span>
                            <h6 style="color:#0073a1;">Customer's Score</h6>
                            <span class="fa fa-star" style="color: #6168ff;">  </span><span><?php star_rating_total_post_average(get_the_ID()); ?></span>
                            </div>
                            <br> 
                            <a href="<?php echo_affiliate_url()?>" class="sidebar_visit">Visit <?php echo get_the_title()?></a>
                        </div>
                        
                    </div> 
                    
            </div> 
        </div> 
        <!-- Content -->

    </div>
    </div>
</div>

<div id="alternative_solutions">
    <h2 class="review_h6" style="text-align: center; width:100%;">Alternative Solutions</h2>
<?php do_shortcode('[top3]')?>
</div>
<?php get_footer(); ?>
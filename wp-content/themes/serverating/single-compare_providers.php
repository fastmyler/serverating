 <!-- Compare 2 Providers template -->
<?php get_header(); ?>   


<?php 
// generating variables for easier use in the template and also testings 

$post_1 = get_post_meta(get_the_ID(),'_compare_post_1',true);
$post_2 = get_post_meta(get_the_ID(),'_compare_post_2',true);

$post_1_title = get_the_title($post_1);
$post_2_title = get_the_title($post_2);

$post_1_expert_score = get_post_meta($post_1,'expert_score',true);
$post_2_expert_score = get_post_meta($post_2,'expert_score',true);

$post_1_lowest_price = get_post_meta($post_1,'lowest_price',true);
$post_2_lowest_price = get_post_meta($post_2,'lowest_price',true);

$post_1_image_url = get_the_post_thumbnail_url($post_1);
$post_2_image_url = get_the_post_thumbnail_url($post_2);

$post_1_affiliate_url = get_post_meta($post_1,'affiliate_url',true);
$post_2_affiliate_url = get_post_meta($post_2,'affiliate_url',true);

$post_1_permalink = get_permalink($post_1);
$post_2_permalink = get_permalink($post_2);

?>
    <!-- Content -->
    <div class="content_main_compare">
    <div class="single_container_compare">
        <!-- Compare Section -->
        <div class="compare_section_compare">
            <div class="compare_card_compare">
                    <div id="compare_image">
                     <img src="<?php echo $post_1_image_url?>">
                    </div>                
                    <div class="post_details_compare">  
                    <p><strong> Customer's Score: </strong><span class="fa fa-star" style="color: #6168ff;"></span><?php star_rating_total_post_average($post_1) ?><br>(<?php echo get_comments_number($post_1)?> Reviews)</p>
                    <p><strong> Expert Score: </strong><span class="fa fa-star" style="color: #6168ff;"></span><?php echo $post_1_expert_score; ?></p>
                    <p><strong>Lowest Price:</strong> <?php echo $post_1_lowest_price; ?></p>
                    <a href="<?php echo $post_1_affiliate_url?>" class="sidebar_visit">Visit <?php echo $post_1_title?></a>
                    <a href="<?php echo $post_1_permalink?>" class="sidenar_review">Check Reviews</a>
                </div>
            </div>

            <div class="vs">VS</div>

            <div class="compare_card_compare">
            <div id="compare_image">
                     <img src="<?php echo $post_2_image_url?>">
                    </div>                 <div class="post_details_compare">
                <p><strong> Customer's Score: </strong><span class="fa fa-star" style="color: #6168ff;"></span><?php star_rating_total_post_average($post_2) ?><br>(<?php echo get_comments_number($post_2)?> Reviews)</p>
                <p><strong> Expert Score: </strong><span class="fa fa-star" style="color: #6168ff;"></span><?php echo $post_2_expert_score; ?></p>
                <p><strong>Lowest Price:</strong> <?php echo $post_2_lowest_price; ?></p>
                <a href="<?php echo $post_2_affiliate_url?>" class="sidebar_visit">Visit <?php echo $post_2_title?></a>
                <a href="<?php echo $post_2_permalink?>" class="sidenar_review">Check Reviews</a>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content_section_compare">
            <h3>Expert Compression</h3>
            <div class="post_content_compare"><?php echo the_content()?></div>
        </div>
    </div>
</div>

    <?php get_footer(); ?>
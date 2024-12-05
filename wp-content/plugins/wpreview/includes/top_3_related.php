<?php
function top_3(){

    $args = array(
        'post_type'           => 'review_item',
        'post_status'         => 'publish',
        'posts_per_page'      => '3',
        'meta_key'       => 'top_sort',    
        'post__not_in'           => [get_the_ID()],
        'orderby'        => 'meta_value_num', 
        'order'          => 'ASC',
    );
?>
<div id="main_related_div">
<?php
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="container_related" id="listing_cont_related">
    <div class="related_post">
        <div class="image_title_rating_related">
            <div id="post_image_rev_related">
                <?php
                if ( has_post_thumbnail() ) {
                    $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                } else {
                    echo 'No Featured Image';
                }
                ?>
            </div>

            <div id="post_raiting_list_related">
                <h6>Customer Reviews Posted</h6>
                <?php echo comments_number('No Reviews', '1 Review', '% Reviews') ?>
                <h6>Lowest Price</h6>
                <?php echo echo_lowest_price()?>
            </div>
            <div id="post_raiting_list_related">
                <h6>Customer's Score</h6>
                <span class="fa fa-star" style="color: #6168ff;"></span>
                <?php star_rating_total_post_average( get_the_ID() ); ?>
                <h6>Expert's Score</h6>
                <span class="fa fa-star" style="color: #6168ff;"></span>
                <?php echo echo_expert_score(); ?>
            </div>
            <div id="post_raiting_list_related">
                <a href="<?php echo_affiliate_url()?>" class="list_visit_related" >Visit <?php echo get_the_title()?></a>
                <a class="list_review_related" href="<?php echo get_permalink()?>">Reviews</a>
            </div>
        </div>
    </div>
</div>


        <?php 
    endwhile;
    else : ?>
        <p>No posts found.</p>
    <?php endif; wp_reset_postdata();
    echo '</div>';
}

add_shortcode('top3','top_3');

?>
<?php get_header(); ?>    
<div class="content-area_archive_review pt-5 pb-5">
    <div class="container_archive_review">
        <div class="col-xl-10 offset-xl-1">
            <h2 class="blog-title_archive_review">ServeRating's Blog - <?php echo get_the_archive_title(); ?></h2>
        </div>
        <div class="posts-grid_archive_review">
            <?php if ( have_posts() ) : ?>    
                <?php while ( have_posts() ) : the_post(); ?>
                <?php $post_id = get_the_ID(); ?>
                <a href="<?php echo get_permalink() ?>" class="post-link_archive_review">
                    <div class="post-item_archive_review">
                        <div class="archive_review_image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php 
                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                            echo '<img class="post-featured-image_archive_review" src="' . esc_url( $image_url ) . '" />';
                            ?>
                        <?php else : ?>
                            <img class="post-default-image_archive_review" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Sample_img_blog.jpg' ); ?>" alt="Default Image" />
                        <?php endif; ?>
                        </div>
                        <h2 class="post-title_archive_review"><?php echo get_the_title(); ?></h2>
                        <div class="post-rating-container_archive_review">
                            <div class="rating-section_archive_review">
                                <h6>Customer Reviews Posted</h6>
                                <?php echo comments_number('No Reviews', '1 Review', '% Reviews'); ?>
                            </div>
                            <div class="rating-section_archive_review">
                                <h6>Lowest Price</h6>
                                <?php echo echo_lowest_price(); ?>
                            </div>
                            <div class="rating-section_archive_review">
                                <h6>Customer's Score</h6>
                                <span class="fa fa-star" style="color: #6168ff;"></span>
                                <?php star_rating_total_post_average( get_the_ID() ); ?>
                            </div>
                            <div class="rating-section_archive_review">
                                <h6>Expert's Score</h6>
                                <span class="fa fa-star" style="color: #6168ff;"></span>
                                <?php echo echo_expert_score(); ?>
                            </div>
                            <div class="rating-section_archive_review">
                                <a href="<?php echo_affiliate_url() ?>" class="visit-related-link_archive_review">Visit <?php echo get_the_title() ?></a>
                                <a class="reviews-related-link_archive_review" href="<?php echo get_permalink() ?>">Reviews</a>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<?php
//Taxonomy page for hosting-categories
?>


<?php get_header(); ?>

<?php
// Get the current taxonomy name
$taxonomy = get_queried_object(); // Provides information about the object being queried.
$taxonomy_name = $taxonomy->name;
?>
<div class="content-area_archive_review pt-5 pb-5">
    <div class="container_archive_review">
        <div class="col-xl-10 offset-xl-1">
            <h2 style="color: #006dad;text-align:center;">Best Hosting for <?php echo $taxonomy_name; ?></h2>
            <br>
        </div>
        <div class="posts-grid_archive_review">
            <?php if (have_posts()): ?>
                <?php while (have_posts()):
                    the_post(); ?>
                    <?php $post_id = get_the_ID(); ?>
                    <div class="search-result-review_item">
                        <div class="container" id="listing_cont">
                            <div class="image_title_rating">
                                <div id="post_image_rev">
                                    <?php if (has_post_thumbnail()) {
                                        $image_url = get_the_post_thumbnail_url(
                                            get_the_ID()
                                        );
                                        echo '<img src="' .
                                            esc_url($image_url) .
                                            '" alt="' .
                                            esc_attr(get_the_title()) .
                                            '">';
                                    } else {
                                        echo "No Featured Image";
                                    } ?>
                                </div>

                                <div id="post_raiting_list">
                                    <h6>Customer Reviews Posted</h6>
                                    <?php echo comments_number(
                                        "No Reviews",
                                        "1 Review",
                                        "% Reviews"
                                    ); ?>
                                    <h6>Lowest Price</h6>
                                    <?php echo echo_lowest_price(); ?>
                                </div>
                                <div id="post_raiting_list">
                                    <h6>Customer's Score</h6>
                                    <span class="fa fa-star" style="color: #6168ff;"></span>
                                    <?php star_rating_total_post_average(
                                        get_the_ID()
                                    ); ?>
                                    <h6>Expert's Score</h6>
                                    <span class="fa fa-star" style="color: #6168ff;"></span>
                                    <?php echo echo_expert_score(); ?>
                                </div>
                                <div id="post_raiting_list">
                                    <a href="<?php echo_affiliate_url(); ?>" class="list_visit">Visit <?php echo get_the_title(); ?></a>
                                    <a class="list_review" href="<?php echo get_permalink(); ?>">Reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile; ?>
            <?php else: ?>
                <p>No posts found.</p>
            <?php endif; ?>

            <?php // Related Posts using the same taxonomy // For example if the taxonomy is wordpress, the page will show WP related posts.


            $args = [
                "post_type" => "post",
                "post_status" => "publish",
                "posts_per_page" => 3,
                "category_name" => $taxonomy_name, // Use 'category_name' for the category slug
                "orderby" => "date",
                "order" => "ASC",
            ];

            $query = new WP_Query($args); // Use the correct variable $query

            if ($query->have_posts()) { ?>
                <h2 style="color: #006dad;text-align:center;"><?php echo $taxonomy_name; ?> Related Posts</h2>
                <?php
                echo '<div class="related_posts">';
                echo '<ul class="related_list">';
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<li class="related_item">';
                    echo '<a href="' .
                        get_the_permalink() .
                        '" class="related_link">';
                    if (has_post_thumbnail()) {
                        echo get_the_post_thumbnail(get_the_ID(), "thumbnail", [
                            "class" => "related_thumbnail",
                        ]);
                    }
                    echo '<h4 class="related_heading">' .
                        get_the_title() .
                        "</h4>";
                    echo '<p class="related_date">' .
                        get_the_date("F j, Y") .
                        "</p>";
                    echo '<p style="text-align: left;">' .
                        get_the_excerpt() .
                        "</p>";
                    echo "</a>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</div>";
                } else { ?>
                <h2 style="color: #ff0000; text-align: center;">No Related Posts Found</h2>
            <?php }
            wp_reset_postdata();
            ?>


        </div>
    </div>
</div>

<?php get_footer(); ?>

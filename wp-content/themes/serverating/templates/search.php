<?php
get_header(); ?>

<div class="container">
    <div class="row">

        <?php if ( is_search() ) : ?>   
            <h1>Search Results for: <?php echo get_search_query(); ?></h1>

            <?php
            // Custom query to fetch posts with specific ordering
            $args = array(
                'post_type' => array('review_item', 'compare_providers', 'post'),
                'posts_per_page' => -1, // or set to any number you need
                'orderby' => 'post_type',
                'order' => 'DESC', // Change this to 'DESC' if you want reverse order
                's' => get_search_query() // Use the current search query
            );
            $search_query = new WP_Query($args);

            if ( $search_query->have_posts() ) :
                while ( $search_query->have_posts() ) : $search_query->the_post();
                    $post_type = get_post_type();
                    ?>

                    <?php if ( 'review_item' === $post_type ) : ?>
                        <!-- Display for review_items -->
                        <h2>Hosting Provider</h2>
                        <div class="search-result-review_item">
                             <div class="container" id="listing_cont">
                                <div class="image_title_rating">
                                    <div id="post_image_rev">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                                            echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                        } else {
                                            echo 'No Featured Image';
                                        }
                                        ?>
                                    </div>

                                    <div id="post_raiting_list">
                                        <h6>Customer Reviews Posted</h6>
                                        <?php echo comments_number('No Reviews', '1 Review', '% Reviews') ?>
                                        <h6>Lowest Price</h6>
                                        <?php echo echo_lowest_price()?>
                                    </div>
                                    <div id="post_raiting_list">
                                        <h6>Customer's Score</h6>
                                        <span class="fa fa-star" style="color: #6168ff;"></span>
                                        <?php star_rating_total_post_average( get_the_ID() ); ?>
                                        <h6>Expert's Score</h6>
                                        <span class="fa fa-star" style="color: #6168ff;"></span>
                                        <?php echo echo_expert_score(); ?>
                                    </div>
                                    <div id="post_raiting_list">
                                        <a href="<?php echo_affiliate_url()?>" class="list_visit" >Visit <?php echo get_the_title()?></a>
                                        <a class="list_review" href="<?php echo get_permalink()?>">Reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ( 'compare_providers' === $post_type ) : ?>
                        <!-- Display for compare_providers -->
                        <div class="search-result-compare_providers" id="search-result-compare_provider">
                            <a href="<?php echo get_permalink() ?>" class="compare_item_a">
                                <div class="compare_item" #id = "compare-Item_ID">
                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                                            echo '<img class="compare_item_img" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                        } else {
                                            echo 'No Featured Image';
                                        }
                                    ?>
                                    <h2 class="compare_title"><?php echo get_the_title() ?></h2>
                                </div>
                            </a>
                        </div>

                    <?php elseif ( 'post' === $post_type ) : ?>
                        <div class="search-result-compare_providers" id="search-result-compare_provider">
                            <a href="<?php echo get_permalink() ?>" class="compare_item_a">
                                <div class="compare_item" #id = "compare-Item_ID">
                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                                            echo '<img class="compare_item_img" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                        } else {
                                            echo 'No Featured Image';
                                        }
                                    ?>
                                    <h2 class="compare_title"><?php echo get_the_title() ?></h2>
                                </div>
                            </a>
                        </div>


                    <?php endif; ?>

                <?php endwhile; ?>
            <?php else : ?>
                <p>No results found for your search.</p>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>

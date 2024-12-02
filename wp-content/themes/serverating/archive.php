<?php get_header(); ?>    




<div class="ex-basic-1 pt-5 pb-5">
    <div class="container">
        <div class="col-xl-10 offset-xl-1">
            <h2 class="post_title">ServeRating's Blog - <?php echo get_the_archive_title(); ?></h2>
        </div>
        <div class="archive_container">
            <?php if ( have_posts() ) : ?>    
                <?php while ( have_posts() ) : the_post(); ?>
                <?php $post_id=get_the_ID()?>
				<a href="<?php echo get_permalink()?>" style="text-decoration:none">
                    <div class="archive_post">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php 
                            $image_url = get_the_post_thumbnail_url( get_the_ID() ); 
                            echo '<img class="archive_featured_image" src="' . esc_url( $image_url ) . '" />';
                            ?>
                        <?php else : ?>
                            <img class="archive_featured_image" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Sample_img_blog.jpg' ); ?>" alt="Default Image" />
                        <?php endif; ?>
                        <h2 class="archive_heading"><?php echo get_the_title(); ?><br></h2>
                        <h6><?php echo get_the_date( 'F j, Y' )?></h6>
                        <p class="archive_excerpt"><?php echo get_the_excerpt();?></p>
						</div>
				</a>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
        <?php echo get_the_posts_pagination();
            ?>

    </div>
</div>

<?php get_footer(); ?>

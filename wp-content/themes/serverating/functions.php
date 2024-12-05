<?php

// Adding Supports
add_theme_support( 'post-thumbnails' );
add_theme_support('excerpt');
remove_filter('comment_reply_link', 'comment_reply_link', 10, 2);


// Enqueeue Styles and Scripts of the theme 
add_action( 'wp_enqueue_scripts', 'serverating_enqueue' );
function serverating_enqueue() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('ajax-show-more', get_stylesheet_directory_uri() . '/assets/js/ajax-show-more.js', array('jquery'), null, true);
    wp_localize_script('ajax-show-more', 'ajax_show_more_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    wp_enqueue_style( 'serverating_bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0' );
    wp_enqueue_style( 'serverating_fontawesome', get_stylesheet_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '1.0.0' );
    wp_enqueue_style( 'serverating_swiper', get_stylesheet_directory_uri() . '/assets/css/swiper.css', array(), '1.0.0' );
    wp_enqueue_style( 'serverating_main_style', get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), '1.0.0' );

    wp_enqueue_script( 'serverating_bootstrap_script', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'serverating_swiper_script', get_stylesheet_directory_uri() . '/assets/js/swiper.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'serverating_purecounter', get_stylesheet_directory_uri() . '/assets/js/purecounter.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'serverating_isotope', get_stylesheet_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'serverating_custom_scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true );
}

//Registering the SideBard so we can use it in the footer
function add_footer_sidebar() {

	register_sidebar(array(
        'id'                    => 'sidebar-1',
        'name'                  => 'Footer Widgets Left',
        'before_widget'         => '<div id="%1$s" class="widget %2$s">',
        'after_widget'          => '</div>',
        'before_title'          => '<h2 class="widgettitle">',
        'after_title'           => '</h2>',
    ));
    
    register_sidebar(array(
            'id'                    => 'sidebar-2',
            'name'                  => 'Footer Widgets Center',
            'before_widget'         => '<div id="%1$s" class="widget %2$s">',
            'after_widget'          => '</div>',
            'before_title'          => '<h2 class="widgettitle">',
            'after_title'           => '</h2>',
        ));

    register_sidebar(array(
            'id'                => 'sidebar-3',
            'name'              => 'Footer Widgets Right',
            'before_widget'     => '<div id="%1$s" class="widget %2$s">',
            'after_widget'      => '</div>',
            'before_title'      => '<h2 class="widgettitle">',
            'after_title'       => '</h2>',
        ));

}

add_action( 'widgets_init', 'add_footer_sidebar' );

//Registering the Navigation TOP MENU 
function serverating_register_nav_menus() {

    register_nav_menu( 'Main', 'Primary Menu' );
}

add_action( 'after_setup_theme', 'serverating_register_nav_menus', 0 );

// Related Blog posts via shortcode
function related_posts_shortcode() {
    // Exclude the current post
    $current_post_id = get_the_ID();

    // Custom query for the last 3 posts excluding the current one
    $args = array(
        'post_type'      => 'post', // Fetch only posts
        'posts_per_page' => 3,      // Limit to 3 posts
        'post__not_in'   => array($current_post_id), // Exclude current post
        'orderby'        => 'date', // Order by date
        'order'          => 'DESC'  // Most recent first
    );

    $recent_posts = new WP_Query($args);

    if ($recent_posts->have_posts()) {
        echo '<div class="related_posts">';
        echo '<ul class="related_list">';
        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
            echo '<li class="related_item">';
            echo '<a href="' . get_the_permalink() . '" class="related_link">';
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class' => 'related_thumbnail'));
            }
            echo '<h4 class="related_heading">' . get_the_title() . '</h4>';
            echo '<p class="related_date">' . get_the_date('F j, Y') . '</p>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    wp_reset_postdata(); // Reset post data after the custom query
}

// Register the shortcode
add_shortcode('related_posts', 'related_posts_shortcode');


// Custom callback to display the comment with author, email, and URL
function custom_comment_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment; ?>
    
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-meta">
            
        <span class="comment-avatar">
        <?php 
             $options = get_option( 'wpreview_custom_options' );
             $avatar_url = isset( $options['wpreview_avatar'] ) ? esc_url( $options['wpreview_avatar'] ) : '';

             echo "<img src=".$avatar_url.">"
        ?>
        </span>

            <span class="comment-author">
                <?php echo get_comment_author(); ?>
            </span>
            </span>
            <span class="comment-url">
                <?php echo '('.get_comment_author_url().")"; ?>
            </span>
            <span class="comment-date"><?php comment_date()?></span>
        </div>
        
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
        
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
    </li>
<?php 
}


function custom_search_template() {
    if (is_search() && !is_admin()) {
        include('templates/search.php');
        exit;
    }
}
add_action('template_redirect', 'custom_search_template');
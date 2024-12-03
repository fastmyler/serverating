<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div id="comments" class="comments-area container">

<details>
  <summary style="float:right;">Write a Review</summary>

  <?php 
comment_form( array(
    'title_reply' => __( 'Add Review', 'textdomain' ),
    'label_submit' => __( 'Post Review', 'textdomain' ),
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'Your Honest Review', 'textdomain' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>',
    'fields' => array(
        'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'textdomain' ) . '</label><input id="author" name="author" type="text" value="" size="30" /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'textdomain' ) . '</label><input id="email" name="email" type="text" value="" size="30" /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'textdomain' ) . '</label><input id="url" name="url" type="text" value="" size="30" /></p>',
    ),
    // Adding a nonce field for security
    'comment_notes_after' => '<p class="comment-notes"><input type="hidden" name="comment_nonce" id="comment_nonce" value="' . wp_create_nonce('comment_nonce') . '" /></p>',
) );
?>

</details>

    <?php if ( have_comments() ) : ?>
        <h2 class="review_h6">
        
    <?php
    printf(
        _nx(
            '%1$s\'s Customer Reviews - One Review', // Singular
            '%1$s\'s Customer Reviews - %2$s Reviews', // Plural
            get_comments_number(),
            'comments title',
            'textdomain'
        ),
        get_the_title(), // %1$s: The post title
        number_format_i18n(get_comments_number()) // %2$s: The number of comments
    );
    ?>
        </h2>


        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 60,
                    'callback'    => 'custom_comment_callback',  // Specify your custom callback function
                    ) );
            ?>
        </ol>
        
        <?php the_comments_navigation(); ?>

    <?php endif; // have_comments() ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'textdomain' ); ?></p>
    <?php endif; ?>

    



</div><!-- #comments -->

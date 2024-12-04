jQuery(document).ready(function($){
    var offset = 3; // Initially, load 3 posts
    var post_per_page = 3; // Set the number of posts to load on each click

    // Bind the click event to the "Load More" button
    $('#load-more').on('click', function(){
        var button = $(this);

        // Trigger AJAX request to load more posts
        $.ajax({
            url: ajax_show_more_params.ajax_url, // Use localized AJAX URL
            method: 'POST',
            data: {
                action: 'load_more_compare_items', // The action hook to trigger in PHP
                offset: offset, // The current offset
                post_per_page: post_per_page // The number of posts to load per request
            },
            beforeSend: function(){
                button.text('Loading...'); // Change the button text while loading
            },
            success: function(response){
                // Append the new posts to the container
                $('.show_compare_items').append(response);

                // Increment the offset by the number of posts per page (3)
                offset += post_per_page;

                button.hide(); // Hide the button after loading more posts

            },
            error: function(){
                button.text('Something went wrong. Please try again!');
            }
        });
    });
});

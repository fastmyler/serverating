<?php

// Enqueue styles for comment ratings.
add_action('wp_enqueue_scripts', 'star_rating_styles');
function star_rating_styles()
{
    wp_register_style('star_rating_styles', plugins_url() . '/wpreview/assets/style.css');
    wp_enqueue_style('dashicons');
    wp_enqueue_style('star_rating_styles');
}

// Add the rating interface to the comment form with 4 Criteries 
add_action('comment_form_logged_in_after', 'star_rating_fields');
add_action('comment_form_after_fields', 'star_rating_fields');
function star_rating_fields()
{
    ?>
    <div id="global-star-div">
        <div id="star_rating">
            <label for="support_rating">Support: <span class="required">*</span></label>
            <fieldset class="comments-rating">  
                <span class="rating-container">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>

                        <input type="radio" id="support_rating-<?php echo esc_attr($i); ?>" name="support_rating" value="<?php echo esc_attr($i); ?>" />
                        <label class="fa-solid fa-star" for="support_rating-<?php echo esc_attr($i); ?>"></label>
                    <?php endfor; ?>
                </span>
            </fieldset>
            <br>

            <label for="uptime_rating">Uptime: <span class="required">*</span></label>
            <fieldset class="comments-rating">
                <span class="rating-container">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>

                        <input type="radio" id="uptime_rating-<?php echo esc_attr($i); ?>" name="uptime_rating" value="<?php echo esc_attr($i); ?>" />
                        <label class="fa-solid fa-star" for="uptime_rating-<?php echo esc_attr($i); ?>"></label>
                    <?php endfor; ?>
                </span>
            </fieldset>
            <br>

            <label for="perf_rating">Performance: <span class="required">*</span></label>
            <fieldset class="comments-rating">
                <span class="rating-container">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                        <input type="radio" id="perf_rating-<?php echo esc_attr($i); ?>" name="perf_rating" value="<?php echo esc_attr($i); ?>" />
                        <label class="fa-solid fa-star" for="perf_rating-<?php echo esc_attr($i); ?>"></label>
                    <?php endfor; ?>
                </span>
            </fieldset>
            <br>

            <label for="pricing_rating">Pricing: <span class="required">*</span></label>
            <fieldset class="comments-rating">
                <span class="rating-container">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>

                        <input type="radio" id="pricing_rating-<?php echo esc_attr($i); ?>" name="pricing_rating" value="<?php echo esc_attr($i); ?>" />
                        <label class="fa-solid fa-star" for="pricing_rating-<?php echo esc_attr($i); ?>"></label>
                    <?php endfor; ?>
                </span>
            </fieldset>
        </div> <!-- Closing div for star_rating -->

        <div id="average_score" style="font-weight: bold;">
            <div id="aver_cont">0</div>
        </div> <!-- Display average rating -->
    </div> <!-- Closing div for global-star-div -->
    
    <script>
// Function to calculate the average score and update the display with one star
function calculateAverage() {
    const ratings = ['support_rating', 'uptime_rating', 'perf_rating', 'pricing_rating'];
    let totalScore = 0;
    let count = 0;

    ratings.forEach(rating => {
        const selectedRating = document.querySelector(`input[name="${rating}"]:checked`);
        if (selectedRating) {
            totalScore += parseInt(selectedRating.value, 10);
            count++;
        }
    });

    let average = 0;
    if (count > 0) {
        average = totalScore / count;
    }

    // Update the average score text with one star
    const averageScoreDiv = document.getElementById('average_score');
    averageScoreDiv.innerHTML = ''; // Clear previous content

    // Create a container div with class 'full-height-rating'
    const fullHeightRatingDiv = document.createElement('div');
    fullHeightRatingDiv.classList.add('full-height-rating');

    // Create the single star element
    const star = document.createElement('i');
    if (average > 0) {
        star.classList.add('fa-solid', 'fa-star'); // Full star
    } else {
        star.classList.add('fa-regular', 'fa-star'); // Empty star if average is 0
    }

    // Create the numeric score span
    const numericScoreDiv = document.createElement('span');
    numericScoreDiv.textContent = ` ${average.toFixed(1)}`;

    // Append the star and the numeric score to the container div
    fullHeightRatingDiv.appendChild(star);
    fullHeightRatingDiv.appendChild(numericScoreDiv);

    // Append the container div to the main average score div
    averageScoreDiv.appendChild(fullHeightRatingDiv);
}

// Add event listeners to update the average whenever a rating changes
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', calculateAverage);
});

// Initial calculation in case there are pre-selected values
calculateAverage();

    </script>
    <?php
}



//Saving the 4 Criteries as Comment Meta 
add_action('comment_post', 'star_rating_meta_save');
function star_rating_meta_save($comment_id)
{
    if (isset($_POST['support_rating']) && $_POST['support_rating'] !== '') {
        $support_rating = intval($_POST['support_rating']);
        add_comment_meta($comment_id, 'support_rating', $support_rating);
    }

    if (isset($_POST['uptime_rating']) && $_POST['uptime_rating'] !== '') {
        $uptime_rating = intval($_POST['uptime_rating']);
        add_comment_meta($comment_id, 'uptime_rating', $uptime_rating);
    }

    if (isset($_POST['perf_rating']) && $_POST['perf_rating'] !== '') {
        $perf_rating = intval($_POST['perf_rating']);
        add_comment_meta($comment_id, 'perf_rating', $perf_rating);
    }

    if (isset($_POST['pricing_rating']) && $_POST['pricing_rating'] !== '') {
        $pricing_rating = intval($_POST['pricing_rating']);
        add_comment_meta($comment_id, 'pricing_rating', $pricing_rating);
    }   
}

// Calculate the rating average and save as Comment meta  
add_action('comment_post', 'star_rating_meta_average');
function star_rating_meta_average($comment_id)
{
    $support_rating = get_comment_meta( $comment_id, 'support_rating', true );
    $uptime_rating = get_comment_meta($comment_id,'uptime_rating', true);
    $perf_rating = get_comment_meta($comment_id,'perf_rating', true);
    $pricing_rating = get_comment_meta($comment_id,'pricing_rating', true);

    $rating_avg = ($support_rating + $uptime_rating + $perf_rating + $pricing_rating)/4;
    add_comment_meta($comment_id, 'comment_rating_avg', $rating_avg);
}

// Calculates the average rating for the post 
function star_rating_total_post_average($post_id){

    $comments = get_comments(array('post_id' => $post_id,));

    $ratings = array();

    // Collect ratings from comment metadata
    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'comment_rating_avg', true);
        if (is_numeric($rating)) {
            $ratings[] = (float) $rating;
        }
    }

    $total_avg = !empty($ratings) ? array_sum($ratings) / count($ratings) : 0;

    echo number_format($total_avg, 2);
}

// Display the rating in the comment text.
add_filter('comment_text', 'star_rating_show');
function star_rating_show($comment_text) {
    // Get the comment rating metadata
    $rating = get_comment_meta(get_comment_ID(), 'comment_rating_avg', true);

    // Check if there's a rating and append it to the comment text
    if ($rating) {
        // Ensure the rating is a float to handle half stars
        $rating = floatval($rating);
        $full_stars = floor($rating); // Number of full stars
        $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0; // Check for half star
        $empty_stars = 5 - $full_stars - $half_star; // Calculate remaining empty stars

        // Create the HTML for the rating
        $rating_html = '<div class="comment-rating">';
        
        $rating_html .= '<span class="rating-number">' . number_format($rating,1) . '</span>';

        // Add full stars
        for ($i = 0; $i < $full_stars; $i++) {
            $rating_html .= '<i class="fa-solid fa-star"></i>';
        }

        // Add half star if needed
        if ($half_star) {
            $rating_html .= '<i class="fa-solid fa-star-half-stroke"></i>';
        }

        // Add empty stars
        for ($i = 0; $i < $empty_stars; $i++) {
            $rating_html .= '<i class="fa-regular fa-star"></i>';
        }

        // Add rating number
        $rating_html .= '</div><br>';

        // Prepend the rating HTML to the comment text
        $comment_text = $rating_html . $comment_text;
    }

    return $comment_text;
}




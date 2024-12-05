<?php get_header(); ?>    

<div class="ex-basic-1 pt-5 pb-5">
    <div class="container text-center">
        <h1 class="display-4">404 Error: Lost in Cyberspace</h1>
        <p class="lead">Looks like the page you’re looking for went offline... or never existed. 🤷‍♂️</p>
        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/404.png" alt="404 illustration" class="img-fluid mb-4" style="max-width: 400px;">
        <p>But don’t worry, we’ve got plenty of great hosting recommendations to get you back on track.</p>
        <a href="<?php echo home_url(); ?>" class="btn btn-primary mt-3">Take Me Home</a>
    </div>
</div>

<?php get_footer(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
	<title><?php wp_title(); ?> | Expert Web Hosting Reviews</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!--  <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/swiper.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/styles.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Oswald:wght@200..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

	
	<!-- Favicon  -->
  

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?> data-post-id="<?php echo get_the_ID(); ?>"  data-bs-spy="scroll" data-bs-target="#navbarExample">





    <!-- Navigation -->
    <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="<?php echo get_home_url()?>"><img src="<?php echo get_site_url();?>/wp-content/uploads/2024/11/Logo.png" alt="alternative"></a> 

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text" href="index.html">Zinc</a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
               
            <?php
            $args = array(
                'menu'				=> "Main", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                'menu_class'		=> "navbar-nav ms-auto navbar-nav-scroll", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                'container'			=> "ul", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
                'container_class'	=> "",
                'theme_location'	=> 'Main', // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
            );
            wp_nav_menu( $args );
            ?>
            
            
            <!-- <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#header">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Drop</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="article.html">Article Details</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><a class="dropdown-item" href="terms.html">Terms Conditions</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                        </ul>
                    </li>
                </ul> -->

            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

<?php if ( is_front_page() ) : ?>
    <!-- Header -->
    <header id="header_front" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-8">
                    <div class="text-container">
                        <div class="section-title"></div>
                        <h1 class="h1-large">Find the perfect hosting for you!</h1>
                            <div>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> 100% Real and Honest Customer Reviews</p>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> 10+ Year Experienced Cloud Expert Reviews</p>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> Compare the Providers</p>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> Comprehensive Performance Metrics</p>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> Exclusive Deals and Discounts</p>
                                <p class="p-large moving_p"><i class="fa-solid fa-check"></i> Exposing hidden fees and terms</p>
                            </div>


                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-4">
                    <div class="image-container">
                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/item.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->
<?php endif; ?>
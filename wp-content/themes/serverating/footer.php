   <!-- Sidebar Dynamic Footer -->
   <div class="footer bg-gray">             
            <?php get_sidebar('footer'); ?>
    </div> 




    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->
    	
    
    <?php wp_footer(); ?>

</body>
</html>
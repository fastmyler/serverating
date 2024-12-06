     <!-- Sidebar Footer -->
    <div class="container">
        <div class="row">

            <div class="footer-left">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Left')) : ?><?php endif; ?>

            </div>

            <div class="footer-center">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Center')) : ?><?php endif; ?>

            </div>

            <div class="footer-right">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Right')) : ?><?php endif; ?>

            </div>

        </div> 
    </div> 

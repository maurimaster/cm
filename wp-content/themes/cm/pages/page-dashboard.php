<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / Dashboard
 *
 * @package Claudia
 * @author  Claudia
 * @license GPL-2.0+
 * @link    http://www.Claudia.com/
 */


// Page 

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_loop' ); // Add custom loop
function custom_do_loop() {
    ?>
    <div class="container">
        <div class="row">
            <!-- <div class="bg-left"> -->
                <div class="col-12 col-md-4 con-left">
                    <nav class="nav-dashboard">
                        <!-- <ul>
                            <li class='current'><a href="#">DASHBOARD</a></li>
                            <li><a href="#">MIEMBROS</a></li>
                            <li><a href="http://wearescale.com/clients/claudiamolina/mi-perfil/">MI PERFIL</a></li>
                            <li><a href="#">FACTURACIÓN</a></li>
                            <li><a href="<?php echo get_site_url().'/wp-login.php?action=logout'?>">CERRAR SESIÓN</a></li>
                        </ul> -->
                        <?php
                        wp_nav_menu( array( 
                            'theme_location' => 'dashboard-menu', 
                            'container_class' => 'dashboard-menu-class' 
                            ) 
                        );
                        ?>
                    </nav>
                </div>
            <!-- </div> -->
            <div class="col-12 col-md-8">
                <div class="box-right">
                    <?php // TO SHOW THE PAGE CONTENTS
                    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
                        <div class="entry-content-page">
                            <?php the_content(); ?> <!-- Page Content -->
                        </div><!-- .entry-content-page -->
                    <?php
                    endwhile; //resetting the page loop
                    wp_reset_query(); //resetting the page query ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();
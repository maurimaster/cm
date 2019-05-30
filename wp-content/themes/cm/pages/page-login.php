<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / Login
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
            <div class="col-md-6">
                <div class="box-left">
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
            <div class="col-md-6">
                <?php 
                    $content = get_field('page_login');
                ?>
                <div class="box-login sec-subscription">
                    <div class="content">
                        <h3><?php echo $content['titulo'] ?></h3>
                        <?php echo $content['contenido'] ?>
                    </div>
                    <img src="<?php echo $content['imagen']['url'] ?>" alt="">
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
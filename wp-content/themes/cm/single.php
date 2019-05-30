<?php
/**
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Single Blog"
*/

add_action('genesis_after_header', 'publicity_function');
function publicity_function() {
    ?>
    <div class="content-submenu">
        <div class="wrap">
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo get_home_url() ?>">HOME</a>
                    /
                    <a href="<?php echo get_home_url() ?>/blog">BLOG</a>
                    /
                    <?php
                    while ( have_posts() ) : the_post();
                        echo '<span>'.get_the_title().'</span>';
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <section class="sec-publicity">
        <div class="wrap">
            <div class="box-publicity d-flex justify-content-center align-items-center">
                <h3>Publicidad</h3>
            </div>
        </div>
    </section>
    <?php
}

add_filter( 'genesis_pre_get_option_site_layout', 'custom_set_single_posts_layout' );
/**
 * Apply Content Sidebar content layout to single posts.
 * 
 * @return string layout ID.
 */
function custom_set_single_posts_layout() {
    if (is_single('post') || is_singular('post')) {
        return 'content-sidebar';
    }
    
}

// Add our custom loop

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'test_do_loop' ); // Add custom loop
function test_do_loop() {
    while ( have_posts() ) : the_post();
            echo '<section class="single-blog">';
                $thumb_url_top = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
                echo '<div class="cont-single">';
                    ?>
                    <div class="feature-img-post">
                        <img src="<?php echo $thumb_url_top[0]; ?>">
                    </div>
                    <div class="b-tag">
                        <span>DIETAS</span>
                    </div>
                    <h3 class="title-post"><?php echo get_the_title(); ?></h3>
                    <div><?php
                        echo the_content();?>
                    </div>
                    <?php
                    
                    if (is_single ()) comments_template (); 
                        echo "<div class='content-single comments_single'>";
                            genesis_list_comments();
                        echo "</div>";

                echo '</div>';

                ?>
                <section class="sec-publicity">
                    <div class="box-publicity d-flex justify-content-center align-items-center">
                        <h3>Publicidad</h3>
                    </div>
                </section>
                <?php

                echo '<hr class="line-hr">';

                echo '<div class="related-blog">';
                    echo '<h3>ARTICULOS RELACIONADOS</h3>';
                    $settings = array(
                        'posts_per_page' => 3, 
                        'post_type' => 'post', 
                        'orderby' => 'date', 
                        'order' => 'DESC', 
                    );
                
                    $list = '<div class="blog-related">';
                        echo '<div class="row">';
                        $loop = new WP_Query( $settings );
                        if($loop->have_posts()):
                            while ( $loop->have_posts() ) : $loop->the_post();
                                ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="box-post item-box-post">
                                        <div class="p-image">
                                            <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'thumb-featured-blog' ) ?>" alt="">
                                        </div>
                                        <h5><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_query();
                        echo '</div>';
                    $list.= '</div>';
                    echo $list;
                echo '</div>';
            echo '</section>';
        endwhile;

}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();
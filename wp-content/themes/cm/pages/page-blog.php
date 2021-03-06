<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / Blog
 *
 * @package Claudia
 * @author  Claudia
 * @license GPL-2.0+
 * @link    http://www.Claudia.com/
 */


// Page 
add_action('genesis_after_header', 'publicity_function');
function publicity_function() {
    ?>
    <div class="content-submenu">
        <div class="wrap">
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo get_home_url() ?>">HOME</a> &nbsp; / &nbsp; <span>BLOG</span>
                </div>
            </div>
        </div>
    </div>
    <?php
    ?>
    <section class="sec-publicity">
        <div class="wrap">
            <div class="box-publicity d-flex justify-content-center align-items-center">
                <h3>Publicidad</h3>
            </div>
        </div>
    </section>
    <?php
}

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_loop' ); // Add custom loop
function custom_do_loop() {
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array( 
        'posts_per_page'   => 9,
        'post_type'      => 'post',
        // 'orderby'         => 'menu_order',
        'orderby'    => 'post_date',
        'order'      => 'DESC',
        'paged'          => $paged
    );
    if(1 == $paged) {
        $featured_posts = get_field('featured_post','option');
        if( $featured_posts ):
            $counter = 0;
            $counter2 = 0;
            echo '<div class="blog-wrap">';
                echo '<div class="row top-featured">';
                    foreach($featured_posts as $top_post):
                        $counter++;
                        if ($counter == 1) {
                            $class_c = 'active';
                        }else{
                            $class_c = '';
                        }
                        setup_postdata($top_post);
                        echo '<div class="col-md-12 posts_big '.$class_c.'" featured-id="'.$top_post->ID.'">';
                            echo '<div class="blog-top">';
                                echo '<div class="row gutter-18">';
                                    echo '<div class="col-md-7">';
                                        echo '<img class="img-blog" src="'.get_the_post_thumbnail_url($top_post->ID, 'thumb-first-blog').'" />';
                                    echo '</div>';
                                    echo '<div class="col-md-5">';
                                        echo '<div class="blog-meta">';
                                            $category = get_the_category($top_post->ID);
                                            echo '<div class="b-tag">';
                                                echo '<span><a href="'.get_category_link($category[0]->cat_ID).'" style="text-transform:uppercase;text-decoration:none;color:#5d5d5d;">'.$category[0]->cat_name.'</a></span>';
                                            echo '</div>';
                                            echo '<h3><a href="'.get_the_permalink($top_post->ID).'">'.$top_post->post_title.'</a></h3>';
                                            echo get_the_excerpt($top_post->ID);
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    endforeach;
                    echo '<div class="col-md-12">';
                        echo '<div class="cont-f-text">';
                            echo '<div class="row gutter-0 links-featured">';
                                foreach( $featured_posts as $post):
                                    $counter2++;
                                    if ($counter2 == 1) {
                                        $class_c = 'active';
                                    }else{
                                        $class_c = '';
                                    }
                                    setup_postdata($post);
                                    echo '<div class="col-md-4 '.$class_c.'" link-id="'.$post->ID.'">';
                                        echo '<div class="f-text '.$class_c.'">';
                                            echo $post->post_title;
                                        echo '</div>';
                                    echo '</div>';
                                endforeach;
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            wp_reset_postdata();
        endif;
        ?>
        <style type="text/css">
            .top-featured .posts_big{
                display: none;
            }
            .top-featured .posts_big.active{
                display: block;
            }
        </style>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('.links-featured .col-md-4').on('click', function(e){
                    e.preventDefault();
                    jQuery('.links-featured .col-md-4').removeClass('active');
                    jQuery('.links-featured .col-md-4 .f-text').removeClass('active');
                    jQuery(this).addClass('active');
                    jQuery(this).find('.f-text').addClass('active');
                    var post_id = jQuery(this).attr('link-id');
                    jQuery('.top-featured .posts_big').removeClass('active');
                    jQuery('.top-featured .posts_big').each(function(){
                        var current = jQuery(this).attr('featured-id');
                        if (current == post_id) {
                            jQuery(this).addClass('active');
                        }
                    });
                });

                var animateMydiv = function() {
                    var counter = 0;
                    var counter2 = 0;
                    jQuery('.links-featured .col-md-4').each(function(){
                        counter++;
                        if (jQuery(this).hasClass('active')){
                            counter2 = counter;
                        }
                    });
                    if (counter2 == 3) {
                        jQuery('.links-featured .col-md-4:nth-child(1)').trigger('click');
                    }
                    if (counter2 == 1) {
                        jQuery('.links-featured .col-md-4:nth-child(2)').trigger('click');
                    }
                    if (counter2 == 2) {
                        jQuery('.links-featured .col-md-4:nth-child(3)').trigger('click');
                    }
                    console.log('test');
                    setTimeout( animateMydiv, 6000 );
                }
                animateMydiv();
            });
        </script>
        <?php
    }

    global $wp_query;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
        $i = 1;
        ?>
        <div class="blog-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="animation-title">
                                <h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">ARTÍCULOS RECIENTES</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
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

            echo '</div>';
            echo '<hr class="line-hr">';
            echo '<div class="c-pagination text-left">';
                pagination_bar( $wp_query );
            echo '</div>';
            
            ?>
        </div>
        <?php
        wp_reset_query();
        ?>
        <?php
    endif;
}
    
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();
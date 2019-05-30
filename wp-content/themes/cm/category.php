<?php
/**
 * 
 * This file lists taxonomies on a page. Based on http://codex.wordpress.org/Function_Reference/get_term_link
 *
 * @author Robin Cornett
 * @link http://robincornett.com/taxonomy-list/
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'wpb_custom_loop' );
function wpb_custom_loop(){
    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;
    //echo $category_id;
    //$featured_posts = get_field('featured_post_by_category', 'category_'.$category_id);
    if ($category_id == 5) {
        $featured_posts = get_field('growth_hacking_features','option');
    }
    if ($category_id == 7) {
        $featured_posts = get_field('monetizing_features','option');
    }
    if ($category_id == 6) {
        $featured_posts = get_field('seo_features','option');
    }
    if ($category_id == 4) {
        $featured_posts = get_field('social_media_features','option');
    }
    
    $arrayfeatured = array();
    if ($featured_posts) {
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
                    $arrayfeatured[] = $top_post->ID;
                    echo '<div class="col-md-12 posts_big '.$class_c.'" featured-id="'.$top_post->ID.'">';
                        echo '<div class="blog-top">';
                            echo '<div class="row gutter-18">';
                                echo '<div class="col-md-7">';
                                    echo '<img class="img-blog" src="'.get_the_post_thumbnail_url($top_post->ID, 'thumb-first-blog').'" />';
                                echo '</div>';
                                echo '<div class="col-md-5">';
                                    echo '<div class="blog-meta">';
                                        echo '<div class="b-tag">';
                                            echo '<span>'.get_cat_name($category_id).'</span>';
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
    }

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
        });
    </script>
    <?php

    if ( have_posts() ) : 
    // The Loop
        echo '<div class="blog-wrap">';
            echo '<div class="row">';
                $c_counter = 0;
                while ( have_posts() ) : the_post();
                    //echo $arrayfeatured[$c_counter];
                    //if (in_array(get_the_ID() ,$arrayfeatured) == 0) {
                        echo '<div class="col-sm-6 col-md-4">';
                            echo '<div class="box-post item-box-post">';
                                echo '<div class="p-image">';
                                    if (has_post_thumbnail()) {
                                        echo '<img src="'.get_the_post_thumbnail_url( get_the_ID(), 'thumb-featured-blog' ).'" alt="">';
                                    }else{
                                        echo '<img src="'.get_stylesheet_directory_uri().'/images/logo-claudia.jpg" alt="">';
                                    }
                                echo '</div>';
                                echo '<h5><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h5>';
                            echo '</div>';
                        echo '</div>';
                    //}
                    $c_counter++;
                endwhile;
                echo '</div>';
            echo '<hr class="line-hr">';
        echo '</div>';
        wp_reset_query();
     
    else:
        echo '<div class="blog-wrap">';
            echo '<div class="row">';
                echo '<div class="col-sm-12 col-md-12">';
                    echo '<h4>Sorry, no posts found...</h4>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    endif;
}
genesis();
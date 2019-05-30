<?php
/**
 * Author: Hastimal Shah
 * Link: http://hastishah.com/
 * Email: hasti@hastishah.com
 */
/* If you dont want to use any force layout then please comment line no 10 to 20 */
 //* Force content-sidebar layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' ); // Remove // to uncomment the code
 //* Force sidebar-content layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
 //* Force content-sidebar-sidebar layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );
 //* Force sidebar-sidebar-content layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );
 //* Force sidebar-content-sidebar layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );
 //* Force full-width-content layout setting
 //add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
/* Remove the default loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'hs_do_search_loop' );
/**
 * Outputs a custom loop
 *
 * @global mixed $paged current page number if paginated
 * @return void
 */
function hs_do_search_loop() {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $s = isset( $_GET["s"] ) ? $_GET["s"] : "";
    // accepts any wp_query args
    $args = (array(
        's' => $s,
        //'post_type' => $post_type,
        'posts_per_page' => 9,
        'order' => 'ASC',
        'orderby' => 'title',
        'paged' => $paged
    ));
    global $wp_query;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
        $i = 1;
        echo '<div class="blog-wrap">';
            echo '<div class="row">';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
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
                endwhile;
            echo '</div>';
            echo '<hr class="line-hr">';
            echo '<div class="c-pagination text-left">';
                pagination_bar( $wp_query );
            echo '</div>';
        echo '</div>';
        wp_reset_query();
    else:
        echo '<div class="blog-wrap">';
            echo '<div class="row">';
                echo '<div class="col-sm-12 col-md-12">';
                    echo '<h4>Sorry, no posts found with "'.$s.'"</h4>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    endif;
}
genesis();
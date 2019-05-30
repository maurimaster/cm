<?php

/**
 * claudia
 *
 * claudia Theme.
 *
 * Template Name: Home
 *
 * @package Claudia
 * @author  Claudia
 * @license GPL-2.0+
 * @link    http://www.Claudia.com/
 */

add_action( 'genesis_meta', __NAMESPACE__ . '\\remove_redundant_markup' );
/**
 * Remove the redundant .site-inner and .content-sidebar-wrap markup.
 *
 * @since 1.0.0
 */
function remove_redundant_markup() {
    // Remove .site-inner everywhere.
    add_filter( 'genesis_markup_site-inner', '__return_null' );
    // Remove .content-sidebar-wrap only when we're using full width content.
    if ( 'full-width-content' === genesis_site_layout() ) {
        add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );
    }
}
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'home' );

 /** Code for custom loop */
function home() {
    if ( have_posts() ) : while ( have_posts() ) : the_post();   
        ?>
        <section class="home-banner">
            <?php echo do_shortcode('[rev_slider alias="home"]'); ?>
        </section>
        <?php
        if($about_me = get_field('about_me')){
            ?>
            <section class="sec-about" data-aos="fade-zoom-in" data-aos-duration="600" data-aos-once="true">
                <div class="wrap">
                    <div class="row">
                        
                        <div class="col-sm-12 col-md-7 my-auto">
                            <div class="block-content" >
                                <?php 
                                if($about_me['about_title']){
                                    ?><div class="animation-title">
                                    <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php echo $about_me['about_title'] ?></h2>
                                    </div><?php
                                }
                                echo $about_me['about_content']; 
                                if($about_me['about_button']){
                                    ?><a class="btn btn-border" href="<?php echo $about_me['about_button']['url'] ?>"><?php echo $about_me['about_button']['title']; ?> <i class="fa fa-chevron-right" ></i></a><?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-5">
                            <div class="block-image">
                                <img src="<?php echo $about_me['about_image']['url'] ?>"/>
                            </div>   
                            <img src="<?php echo get_stylesheet_directory_uri()?>/images/bkg_01.png" alt="bkg" class="img-float-r">
                        </div>

                    </div> 
                </div>
            </section>
            <?php
        }

        if($section_shop = get_field('section_shop')){
            ?>
            <section class="sec-store" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bkg_02.png);">
                <div class="container">
                    <div class="animation-title">
                        <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">TIENDA </h2>
                    </div>
                    <div class="c-border title-prod">
                        <div class="b-top-left"></div>
                        <div class="b-top-right"></div>
                        <div class="b-bottom-right"></div>
                        <div class="b-bottom-left"></div>
                        <div class="row">
                            <?php
                            if($shop_product = $section_shop['shop_product']){
                                foreach($shop_product as $product){
                                    ?>
                                    <div class="col-md-4" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-once="true">
                                        <?php
                                        if($product['prod_image']){
                                            echo '<div class="store-img">';
                                            echo '<a href="'.$product['prod_title']['url'].'" target="'.$product['prod_title']['target'].'"><img src="'.$product['prod_image'].'"/></a>';
                                            echo '</div>';
                                        }
                                        if($product['prod_title']){
                                            echo '<a href="'.$product['prod_title']['url'].'" target="'.$product['prod_title']['target'].'" class="link-black"><h5>'.$product['prod_title']['title'].'</h5></a>';    
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if($section_shop['shop_button']){
                        echo '<a class="btn btn-border" href="'.$section_shop['shop_button']['url'].'">'.$section_shop['shop_button']['title'].' <i class="fa fa-chevron-right"></i></a>';
                    }
                    ?>
                </div>
            </section>
            <?php
        }

        if($section_steps = get_field('section_steps')){
            ?>
            <section class="c-section sec-home-steps">
                <div class="wrap">
                    <?php
                    if($section_steps['steps_title']){
                        echo '<div class="text-center animation-title">';
                        if($section_steps['sub_title']){
                            echo '<h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_steps['sub_title'].'</h3>';
                        }
                        echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_steps['steps_title'].'</h2>';
                        echo '</div>';
                    }
                    ?>
                    <div class="c-row">
                        <div class="_column"  data-aos="fade-right" data-aos-duration="800" data-aos-once="true">
                            <?php
                            if($section_steps['all_steps']){
                                echo '<ul class="group-item">';
                                foreach($section_steps['all_steps'] as $step){
                                    echo '<li>';
                                    echo '<span>'.$step['number'].'</span><div data-aos="fade-up" data-aos-duration="600" data-aos-once="true">';
                                    echo '<h5>'.$step['step_title'].'</h5>';
                                    echo $step['step_content'];
                                    echo '</div></li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                        <div class="_column text-center" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-once="true">
                            <div animation-down>
                                <img src="<?php echo get_stylesheet_directory_uri()?>/images/zhnzl-oudsp.gif"/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        if($section_testimonials = get_field('section_testimonials')){
            ?>
            <section class="sec-testimonials">
                <div class="wrap" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-once="true">
                    <?php
                    if($section_testimonials['test_title']){
                        echo '<div class="animation-title">';
                        echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_testimonials['test_title'].'</h2>';
                        echo '</div>';
                    }
                    echo $section_testimonials['test_content'];
                    if($section_testimonials['test_button']){
                        echo '<a class="btn btn-border" href="'.$section_testimonials['test_button']['url'].'">'.$section_testimonials['test_button']['title'].' <i class="fa fa-chevron-right"></i></a>';
                    }
                    ?>
                </div>
            </section>
            <?php
        }

        if($section_subscription = get_field('section_subscription')){
            ?>
            <section class="sec-subscription" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-once="true">
                <div class="wrap">
                    <div class="row gutter-10">
                        <div class="col-sm-9">
                            <?php
                            if($section_subscription['subs_title']){
                                echo '<h3>'.$section_subscription['subs_title'].'</h3>';
                            }
                            if($section_subscription['subs_description']){
                                echo '<p>'.$section_subscription['subs_description'].'</p>';
                            }
                            ?>
                        </div>
                        <div class="col-sm-3 text-center join-to-susbscribers">
                        <?php
                        if($section_subscription['small_text']){
                            echo '<p><i class="fa fa-long-arrow-down" aria-hidden="true"></i> '.$section_subscription['small_text'].'</p>';
                        }
                        ?>
                        </div>
                    </div>
                    <div class="c-form-subs">
                    <?php
                    echo do_shortcode('[custom_c_2]');
                    ?>
                    </div>
                </div>
            </section>
            <?php
        }

        if($section_events = get_field('section_events')){
            ?>
            <section class="sec-event">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5" data-aos="fade-zoom-in" data-aos-duration="1500" data-aos-once="true">        
                            <div class="block-image text-center">
                                <img src="<?php echo get_stylesheet_directory_uri()?>/images/claudia.png" />
                            </div>   
                            <img src="<?php echo get_stylesheet_directory_uri()?>/images/bkg_03.png" alt="bkg" class="img-float-l">
                        </div>
                        <div class="col-md-7 my-auto">
                            <div class="block-content">
                                <?php
                                if($section_events['event_title']){
                                    echo '<div class="animation-title">';
                                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_events['event_title'].'</h2>';
                                    echo '</div>';
                                }
                                $args_event = array( 
                                    'posts_per_page'   => 2,
                                    'post_type'      => 'evento',
                                    'post_status'    => 'publish',
                                    // 'orderby'         => 'menu_order',
                                    'orderby'        => 'post_date',
                                    'order'          => 'DESC',
                                );
                                $loop_event = new WP_Query( $args_event );
                                if ( $loop_event->have_posts()):
                                    ?>
                                    <div class="row">
                                        <?php
                                        while ( $loop_event->have_posts() ) : $loop_event->the_post();
                                            $start_date = get_field('start_date', false, false);
                                            $end_date = get_field('end_date', false, false);
                                            $end_date = strtotime($end_date);
                                            $address = get_field('address');
                                            $stdate = new DateTime($start_date);
                                            $today = strtotime("today midnight");
                                            $expired = '';
                                            if ($today >= $end_date) {
                                                $expired = '<div class="status-date-expired">Expirado</div>';
                                            } else {
                                                $expired = '<div class="status-date-active"></div>';
                                            }
                                            ?>
                                                    <div class="col-md-6" data-aos="zoom-in" data-aos-duration="800" data-aos-once="true">
                                                        <div class="item-event">
                                                            <?php if (has_post_thumbnail(get_the_ID())):
                                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'large'); 
                                                                ?>
                                                            <div class="feature-event-image" style="background-image: url('<?php echo $image['0']?>')">
                                                                <?php echo $expired ?>
                                                            </div>
                                                            <?php else:?>
                                                                <div class="feature-empy-image"><?php echo $expired ?></div> 
                                                            <?php endif;?>
                                                            <div class="feature-event-content">
                                                                <div class="event-date"><?php echo $stdate->format('M j-y');?></div>
                                                                <div class="event-title">
                                                                    <h3><?php echo get_the_title(); ?></h3>
                                                                </div>
                                                                <div class="event-address"><?php echo $address;?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                        endwhile;
                                        wp_reset_query();
                                    ?>
                                    </div><?php
                                endif;
                                
                                if($section_events['event_button']){
                                    echo '<a class="btn btn-border" href="'.$section_events['event_button']['url'].'">'.$section_events['event_button']['title'].' <i class="fa fa-chevron-right"></i></a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div> 
                </div>
            </section>
            <?php
        }

        if($section_videos = get_field('section_videos')){
            ?>
            <section class="sec-youtube" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bkg_youtube.png)">
                <div class="container">
                    <?php
                    if($section_videos['videos_title']){
                        echo '<div class="animation-title">';
                        echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_videos['videos_title'].'</h2>';
                        echo '</div>';
                    }
                    echo $section_videos['video_content'];
                    if($section_videos['video_button']){
                        echo '<a class="btn btn-border" href="'.$section_videos['video_button']['url'].'">'.$section_videos['video_button']['title'].' <i class="fa fa-chevron-right"></i></a>';
                    }
                    ?>
                </div>
            </section>
            <?php
        }

        if($section_articles = get_field('section_articles')){
            ?>
            <section class="sec-articles">
                <div class="container">
                    <?php
                    if($section_articles['article_title']){
                        echo '<div class="animation-title">';
                        echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_articles['article_title'].'</h2>';
                        echo '</div>';
                    }

                    $args_post = array( 
                        'posts_per_page'   => 3,
                        'post_type'      => 'post',
                        // 'orderby'         => 'menu_order',
                        'orderby'    => 'post_date',
                        'order'      => 'DESC'
                    );
                    global $loop_post;
                    $loop_post = new WP_Query( $args_post );
                    if ( $loop_post->have_posts()):
                        echo '<div class="row gutter-40">';
                            while ( $loop_post->have_posts() ) : $loop_post->the_post();
                                ?>
                                <div class="col-sm-6 col-md-4"  data-aos="zoom-in" data-aos-duration="800" data-aos-once="true">
                                    <div class="box-post">
                                        <div class="p-image">
                                            <a href="<?php esc_url(the_permalink()); ?>"><img src="<?php echo get_the_post_thumbnail_url( $post_id, 'thumb-featured-blog' ) ?>" alt=""></a>
                                        </div>
                                        <h5><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        echo '</div>';
                    wp_reset_query();
                    ?>
                    <?php
                    endif;

                    if($section_articles['art_button']){
                        echo '<a class="btn btn-border" href="'.$section_articles['art_button']['url'].'">'.$section_articles['art_button']['title'].' <i class="fa fa-chevron-right"></i></a>';
                    }
                    ?>
                </div>
            </section>
            <?php
        }

        if($section_instagram = get_field('section_instagram')){
            ?>
            <section class="feed-inst">
                <div class="wrap">
                    <span class="link-ins"><i class="fa fa-instagram"></i></span>
                    <?php
                    if($section_instagram['content']){
                        echo $section_instagram['content'];
                    }
                    ?>
                </div>
                <?php
                if($section_instagram['instagram_user']){
                    ?>
                    <div class="content-inst">
                        <?php
                        $insta = get_field('instagram_feed', 'option');
                        $user_id = $section_instagram['instagram_user'];
                        $token = $insta['token'];
                        $number_of_photos = 6;
                        if($user_id && $token) {
                        ?>
                        <!-- Start Code Instagram -->

                            <div class="row" id="claudia_instafeed">
                            </div>
                            <script>
                            jQuery(document).ready(function($) {
                                var token = '<?php echo $token; ?>', // get from the instagram app
                                    userid = '<?php echo $user_id; ?>',
                                    num_photos = '<?php echo $number_of_photos; ?>'; // to show how many photos you want to display

                                jQuery.ajax({
                                    url: 'https://api.instagram.com/v1/users/self/media/recent',
                                    dataType: 'json',
                                    type: 'GET',
                                    data: {
                                        access_token: token,
                                        count: num_photos
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        for (x in data.data) {
                                            var hightUrl = data.data[x].images.standard_resolution.url;
                                            //var text_overlay = data.data[x].caption.text;
                                            var text_overlay = '';
                                            var text_over = '';
                                            if(data.data[x].caption){
                                                text_overlay = data.data[x].caption.text;
                                                if(text_overlay.length > 15){
                                                    text_overlay = text_overlay.split(' ');
                                                    for(var y=0; y<=15; y++ ){
                                                        if(text_overlay[y] == null){
                                                            break;
                                                        }
                                                        text_over += text_overlay[y]+' ';
                                                    }
                                                }
                                                else {
                                                    text_over = text_overlay;
                                                }
                                                jQuery('#claudia_instafeed').append('<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-2" style="background-image: url(' + hightUrl + ')" onclick="window.open(\''+data.data[x].link+'\',\'_blank\');"><div class="caption"><i class="fa fa-instagram"></i>'+text_over+'</div></div>');     
                                            }else{
                                                jQuery('#claudia_instafeed').append('<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-2" style="background-image: url(' + hightUrl + ')" onclick="window.open(\''+data.data[x].link+'\',\'_blank\');"><div class="caption"><i class="fa fa-instagram"></i></div></div>');     
                                            }
                                        }
                                    },
                                    error: function(data) {
                                        console.log(data);
                                    }
                                });
                            });
                            </script>
                            <!--/ End Code Instagram -->
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </section>
            <?php
        }

    endwhile;
    endif;
    wp_reset_query();
}


 genesis();
<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / Testimonios
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
add_action('genesis_after_header', 'page_event_function');
function page_event_function() {
    ?>
    <!-- Main Banner -->
    <?php
    if($testimonial_banner = get_field('testimonial_banner')){
        ?>
        <section class="banner-testimonial" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-duration="800" data-aos-once="true" style="background-image:url(<?php echo $testimonial_banner['bkg_image'] ?>);">
            <div class="container">
                <div class="main-video">
                <?php
                if($testimonial_banner['banner_title']){
                    echo '<div class="animation-title">';
                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$testimonial_banner['banner_title'].'</h2>';
                    echo '</div>';
                }
                if($testimonial_banner['video_url']){
                    ?>
                    <div class="main-video-item mg-popup">
                        <a href="<?php echo $testimonial_banner['video_url'] ?>" class="video-link">
                            <div class="c-testimonials" style="background-image:url(<?php echo $testimonial_banner['video_bakcground'] ?>">
                                <div class="play play-white"></div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
                    
                </div>
            </div>
        </section>
         <!-- End Main Banner -->
        <?php
    }

    if($test_call_action = get_field('test_call_action')){
        ?>  
        <!-- call action-white -->
        <section class="call-action-white">
            <div class="container">
                <div class="call-action">
                    <a id="open_form" href="<?php echo $test_call_action['ca_button']['url'] ?>" class="btn btn-border"><?php echo $test_call_action['ca_button']['title'] ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </section>
        <!-- end call action white -->
        <?php
    }

    if($section_testimoninals = get_field('section_testimoninals')){
        $section_testimonials = $section_testimoninals['section_testimonials'];
        ?>
        <section class="sec-testimonials page-sec-testimonials sec-youtube">
            <div class="wrap" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-once="true">
                <?php
                if($section_testimoninals['test_title']){
                    echo '<div class="animation-title">';
                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_testimoninals['test_title'].'</h2>';
                    echo '</div>';
                }
                if ($section_testimoninals['testimonials_slider']):
                    ?>
                    <!-- HTML Code -->
                    <div class="c-slider mg-popup" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-duration="600" data-aos-once="true" >
                        <?php
                        foreach($section_testimoninals['testimonials_slider'] as $item_test){
                            if($item_test['add_video']){
                                $url_video = $item_test['url_video'];
                                ?>
                                <div class="box-video">
                                    <a href="<?php echo $url_video;?>" class="video-link">
                                        <div class="c-video-preview" style="background-image:url(<?php echo $item_test['add_featured_image']?>)">
                                            <div class="play"></div>
                                        </div>
                                    </a>
                                    <h5><?php echo $item_test['title_testimonial'] ?></h5>
                                    <p><?php echo $item_test['text_client'] ?></p>
                                </div>
                                <?php
                            }else {
                                ?>
                                <div class="box-video">
                                    <a href="<?php echo $item_test['add_featured_image']?>">
                                        <div class="c-video-preview" style="background-image:url(<?php echo $item_test['add_featured_image']?>)">
                                        </div>
                                    </a>
                                    <h5><?php echo $item_test['title_testimonial'] ?></h5>
                                    <p><?php echo $item_test['text_client'] ?></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div><?php
                endif;
                echo $section_testimoninals['short_description'];
                ?>
            </div>
        </section>
        <?php
    }

    if($call_action_black = get_field('call_action_black')){
        ?>
        <!-- call action-black -->
        <section class="call-action-black">
            <div class="container">
                <div class="call-action" style="font-size:28px;font-weight:bold;" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-duration="600" data-aos-once="true">
                    <?php echo $call_action_black['ctb_text'];
                    echo '&nbsp;&nbsp;&nbsp;';
                    if($call_action_black['ctb_button']){
                        echo '<a class="btn btn-white-transparent open-modal-black" href="'.$call_action_black['ctb_button']['url'].'">'.$call_action_black['ctb_button']['title'].' <i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- end call action black -->
        <?php
    }

    if($section_experience = get_field('section_experience')){
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array( 
            'posts_per_page'   => 5,
            'post_type'      => 'testimonio',
            'post_status'    => 'publish',
            // 'orderby'         => 'menu_order',
            'paged' => $paged,
            'orderby'        => 'post_date',
            'order'          => 'DESC',
        );
        $loop = new WP_Query( $args );
        if ( $loop->have_posts()):
            ?><section class="section-testimonials">
                <div class="container">
                <?php
                if($section_experience['exp_title']){
                    echo '<div class="text-center animation-title">';
                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_experience['exp_title'].'</h2>';
                    echo '</div>';
                }
                while ($loop->have_posts()) : $loop->the_post();
                $reto_image = get_field('reto_image');
                ?>
                    <div class="row testimonial-item" data-aos="fade-zoom-in" data-aos-easing="ease-in-sine" data-aos-duration="600" data-aos-once="true">
                        <div class="col-md-5 col-lg-4 mg-popup">
                            <?php
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
                            if($if_video = get_field('add_video_testimonial')){
                                $url_video = get_field('url_youtube_mp4');
                                ?>
                                <div class="before-now">
                                    <a href="<?php echo $url_video;?>" class="video-link">
                                        <div class="c-testimonials" style="background-image:url(<?php echo $image[0]?>)">
                                            <div class="play"></div>
                                        </div>
                                    </a> 
                                </div>
                                <?php
                            }else {
                                ?>
                                <div class="before-now">
                                    <a href="<?php echo $image[0]?>">
                                        <div class="c-testimonials" style="background-image:url(<?php echo $image[0]?>)"></div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            <!--<div class="before-now">
                                <div class="top-header">
                                    <h3>RETO <?php //echo $reto_image['reto']; ?></h3>
                                    <h2>CUERPAZO PARA<br><span>SIEMBPRE</span></h2>
                                </div>
                                <div class="row test-content">
                                    <div class="col-6">
                                        <div class="before-item" style="background-image: url(<?php //echo $reto_image['antes']; ?>)"></div>
                                        <div class="before-item-txt">ANTES</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="now-item" style="background-image: url(<?php //echo $reto_image['ahora']; ?>)"></div>
                                        <div class="now-item-txt">AHORA</div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <div class="testimonial-txt">
                                <div class="row">
                                    <div class="col-12">
                                    <h5><?php echo get_field('testimonial_address');?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <h3><?php echo get_the_title();?></h3>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <h4>LIBRAS PERDIDAS: <?php echo get_field('libras_perdidas');?></h4>
                                    </div>
                                </div>
                                <div class="row txt-content">
                                    <div class="col-12">
                                    <?php the_content();?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    echo '<div class="c-pagination">';
                        pagination_bar( $loop );
                    echo '</div>';
                    wp_reset_postdata();
                    wp_reset_query();
                    ?>
                </div>
            </section><?php
        endif;
    }

    if($section_steps = get_field('section_steps')){
        $section_steps = $section_steps['section_steps']
        ?>
        <section class="c-section">
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

    if($section_convert = get_field('section_convert')){
        ?>
        <section class="sec-youtube">
            <div class="wrap">
                <?php
                if($section_convert['convert_title']){
                    echo '<div class="animation-title">';
                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_convert['convert_title'].'</h2>';
                    echo '</div>';
                }
                echo $section_convert['convert_content'];
                if($section_convert['convert_button']){
                    echo '<a class="btn btn-border" href="'.$section_convert['convert_button']['url'].'">'.$section_convert['convert_button']['title'].' <i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
                }
                ?>
            </div>
        </section>
        <?php
    }
}
/*********************************************
*	transformation Popup
*********************************************/
add_action('genesis_before_header', 'your_transformation_function');
function your_transformation_function(){
	?>
	<div id="transformation_popup" class="transformation-popup mfp-hide">
        <?php
        echo do_shortcode('[contact-form-7 id="394" title="Transform form"]');
        ?>
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	</div>
    <style type="text/css">
        #r_size .wpcf7-list-item{
            position: relative;
        }
        #r_size .wpcf7-list-item input{
            display: block;
            position: absolute;
            opacity: 0;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
        .testimonial-txt p{
            font-size: 15px;
        }
    </style>
	<?php
}
genesis();
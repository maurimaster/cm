<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / cuerpazo
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
add_action('genesis_after_header', 'page_greatbody_function');
function page_greatbody_function() {
    ?>
    <section class="hero-great-body">
        <div class="c-heart">
            <div id="heart"></div>
        </div>
       <div class="h-float" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/heart-path.png);"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-hero-c">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/cuerpazo01.png" alt="cuerpazo">
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <div class="text-right">
                        <div class="animation-title">
                            <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php the_field('sec1_title'); ?></h2>
                        </div>
                        <?php the_field('sec1_content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
    if( get_field('sect2_title') ):
    ?>
    <section class="sec-challenge" id="sec_challenge">
        <div class="wrap">
            <div class="row">
                <div class="col-md-7">
                    <div class="animation-title">
                        <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php echo get_field('sect2_title'); ?></h2>
                        <h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php echo get_field('sec2_subtitle'); ?></h3>
                    </div>
                    <p><?php echo get_field('sec2_content'); ?></p>

                    <?php if( have_rows('sect2_list') ): ?>
                    <ul class="list-check" data-aos="fade-right" data-aos-duration="600" data-aos-once="true">
                        <?php while( have_rows('sect2_list') ): the_row(); ?>
                        <li>
                            <h3><?php the_sub_field('list_title'); ?></h3>
                            <p><?php the_sub_field('list_content'); ?></p>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="col-md-5 text-center" data-aos="fade-zoom-in" data-aos-duration="1000" data-aos-once="true">
                    <div class="float-top">
                        <div class="block-image" >
                            <img src="<?php echo get_stylesheet_directory_uri()?>/images/claudia_molina.png" alt="Claudia M">
                        </div> 
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/bkg_04.png" alt="bkg" class="img-float">
                    </div>
                    <a class="btn btn-border" href="#" data-scroll-to="#sec_access">¡INSCRÍBETE HOY! <i class="fa fa-chevron-right" ></i></a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php 
    ?>
    <section class="sec-testimonials">
        <div class="wrap">
            <div class="animation-title">
                <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php the_field('sect3_title'); ?></h2>
            </div>
            <?php the_field('sect3_content'); ?>
            <a class="btn btn-border" href="#" data-scroll-to="#sec_access">¡INSCRÍBETE HOY! <i class="fa fa-chevron-right"></i></a>
        </div>
    </section>

    <?php 
        $pins = [
            ['x'=>0.183783783783784, 'y'=>0.342465753424658],
            ['x'=>0.218378378378378, 'y'=>0.48972602739726],
            ['x'=>0.303783783783784, 'y'=>0.784246575342466],

            ['x'=>0.379459459459459, 'y'=>0.229452054794521],
            ['x'=>0.556756756756757, 'y'=>0.636986301369863],
            ['x'=>0.531891891891892, 'y'=>0.775684931506849],

            ['x'=>0.60972972972973, 'y'=>0.229452054794521],
            ['x'=>0.782702702702703, 'y'=>0.366438356164384],
            ['x'=>0.859459459459459, 'y'=>0.808219178082192],
        ];
        $pin_dx = 8;
        $pin_dy = 27;
    ?>
    <section class="sec-map" style="position:relative;">
        <div class="wrap">
            <div class="pinned-map" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/map.png);"  data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
                <?php 
                foreach ($pins as $loc):
                    $seconds = rand(3, 8);
                ?>
                    <span class="pin-loc" style="left:<?php echo $loc['x'] * 100;?>%;top:<?php echo $loc['y'] * 100; ?>%;animation-duration: <?php echo $seconds; ?>s;"></span>
                <?php endforeach; ?>
                <div class="text-center map-content">
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-once="true">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/number.png" alt="follow">
                    </div>
                    <p><?php the_field('map_title') ?></p>
                </div>
            </div>
        </div>
        <!-- mouse -->
        <div style="text-align:center;">
            <div class="tp-caption rev-scroll-btn  tp-withaction tp-scrollbelowslider" data-scroll-to="#sec_tsm_title" style="text-align:center;">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mouse-black.png">
               <div style="padding-top: 5px;">
                   <div class="tp-caption   tp-resizeme tp-svg-layer  animation-1" id="slide-69-layer-16" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['667','430','532','362']" data-width="16" data-height="none" data-whitespace="nowrap" data-type="svg" data-svg_src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg" data-svg_idle="sc:transparent;sw:0;sda:0;sdo:0;" data-responsive_offset="on" data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:500,&quot;frame&quot;:&quot;0&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]" data-textalign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11; min-width: 14px; max-width: 14px; line-height: 1px;color: black; visibility: inherit; transition: none 0s ease 0s; text-align: inherit; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; white-space: nowrap; min-height: 0px; max-height: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;" src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg"> <div class="tp-svg-innercontainer" style="transition: none 0s ease 0s; text-align: inherit; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: black; transition: none 0s ease 0s; text-align: inherit; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; stroke-dashoffset: 0px; stroke-dasharray: 0; stroke-width: 0px; stroke: transparent;"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z" style="fill: black; transition: none 0s ease 0s; text-align: inherit; line-height: 21px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"></path></svg></div></div>
                   <div class="tp-caption   tp-resizeme tp-svg-layer  animation-2" id="slide-69-layer-16" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['667','430','532','362']" data-width="16" data-height="none" data-whitespace="nowrap" data-type="svg" data-svg_src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg" data-svg_idle="sc:transparent;sw:0;sda:0;sdo:0;" data-responsive_offset="on" data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:500,&quot;frame&quot;:&quot;0&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]" data-textalign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11; min-width: 14px; max-width: 14px; color: black; visibility: inherit; transition: none 0s ease 0s; text-align: inherit; line-height: 1px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; white-space: nowrap; min-height: 0px; max-height: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;" src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg"> <div class="tp-svg-innercontainer" style="transition: none 0s ease 0s; text-align: inherit; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: black; transition: none 0s ease 0s; text-align: inherit;border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; stroke-dashoffset: 0px; stroke-dasharray: 0; stroke-width: 0px; stroke: transparent;"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z" style="fill: black; transition: none 0s ease 0s; text-align: inherit; line-height: 21px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"></path></svg></div></div>
                   <div class="tp-caption   tp-resizeme tp-svg-layer  animation-3" id="slide-69-layer-16" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['667','430','532','362']" data-width="16" data-height="none" data-whitespace="nowrap" data-type="svg" data-svg_src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg" data-svg_idle="sc:transparent;sw:0;sda:0;sdo:0;" data-responsive_offset="on" data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:500,&quot;frame&quot;:&quot;0&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]" data-textalign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11; min-width: 14px; max-width: 14px; color: black; visibility: inherit; transition: none 0s ease 0s; text-align: inherit; line-height: 1px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; white-space: nowrap; min-height: 0px; max-height: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;" src="http://wearescale.com/clients/claudiamolina/wp-content/plugins/revslider/public/assets/assets/svg/hardware/ic_keyboard_arrow_down_24px.svg"> <div class="tp-svg-innercontainer" style="transition: none 0s ease 0s; text-align: inherit; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: black; transition: none 0s ease 0s; text-align: inherit;border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px; stroke-dashoffset: 0px; stroke-dasharray: 0; stroke-width: 0px; stroke: transparent;"><path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z" style="fill: black; transition: none 0s ease 0s; text-align: inherit; line-height: 21px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 500; font-size: 13px;"></path></svg></div></div>
               </div>
            </div>
        </div>
    </section>

    <?php if( get_field('sect5_title') ): ?>
    <section class="bkg-gray" id="sec_tsm_title">
        <div class="container" data-aos="fade-in" data-aos-duration="800" data-aos-once="true">
            <h3><?php the_field('sect5_title'); ?></h3>
        </div>
    </section>
    <?php endif; ?>

    <?php if( have_rows('social_testimonials') ): 
        $total_rows = count(get_field('social_testimonials'));
        $count = 0;
        $effect = '';
    ?>
    <section class="sec-tsm-social">
        <div class="wrap">
            <div class="row">
                <?php while( have_rows('social_testimonials') ): the_row();
                    $count++;
                    $col_class= ($count == $total_rows && $total_rows % 2 != 0)? 'col-md-12' : 'col-md-6';
                    $box_class = ($count == $total_rows && $total_rows % 2 != 0)? 'tsm-5' : 'tsm-' . ($count % 5);
                    $effect = ($effect == 'fade-right')? 'fade-left' : 'fade-right';

                ?>
                <div class="<?php echo $col_class; ?>" data-aos="<?php echo $effect; ?>" data-aos-once="true" data-aos-duration="800">
                    <div class="box-text-social <?php echo $box_class; ?>">
                        <?php if( get_sub_field('avatar') ): ?>
                        <img src="<?php the_sub_field('avatar'); ?>" alt="person" class="avatar">
                        <?php endif;  ?>
                        <header><h6><?php the_sub_field('author'); ?></h6>
                            <p><?php the_sub_field('post_date'); ?></p>
                        </header>
                        <?php the_sub_field('description'); ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="sec-online">
        <div class="wrap">
            <div class="row">
                <div class="col-md-4 text-center my-auto">
                    <i class="fa fa-map-marker"></i>
                    <h3>LOS EBOOKS Y LOS ENTRENAMIENTOS ESTÁN DISPONIBLES EN LÍNEA PARA QUE PUEDAS ACCEDER A ELLOS EN CUALQUIER DISPOSITIVO Y DESDE CUALQUIER LUGAR.</h3>
                </div>
                <div class="col-md-8">
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/devices.png" data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
                </div>
            </div>
        </div>
        <?php if( get_field('title_inscription') ): ?>
        <div class="container">
            <?php the_field('title_inscription'); 

                $box_data = get_field('box_number');
            ?>
            <div class="content-time" data-aos="fade-up"  data-aos-duration="800" data-aos-once="true">
                <h5><?php echo $box_data['box_title']; ?></h5>
                <div id="time" class="c-time" data-date="<?php echo $box_data['date_end']; ?>"></div>
            </div>
        </div>
        <?php endif; ?>
    </section>

    <?php if(get_field('sect7_title')): ?>
    <section class="sec-results">
        <div class="container">
            <div class="animation-title">
                <h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php the_field('sect7_title') ?></h3>
            </div>
            <div class="row">
                <?php while( have_rows('box_info') ): the_row(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
                        <h6><?php the_sub_field('bxinfo_title'); ?></h6>
                        <div class="card-image">
                            <?php
                            if (get_sub_field('bxinfo_image')) {
                                ?>
                                <img src="<?php echo get_sub_field('bxinfo_image'); ?>" alt="">
                                <?php
                            }else{
                                ?>
                                <img src="<?php echo get_stylesheet_directory_uri()?>/images/sportswear_store.png" alt="">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-content">
                        <?php the_sub_field('bxinfo_content'); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="sec-access" id="sec_access">
        <div class="wrap" data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
            <div class="animation-title">
                <h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php the_field('sect_8_title') ?></h3>
            </div>
            
            <span>$<?php the_field('sect_8_price') ?></span>
            <a href="<?php echo get_field('sect_8_button')['url']; ?>" class="btn btn-green btn-lg">AGREGAR AL CARRITO <i class="fa fa-chevron-right facircle" ></i></a>
            <div class="money-s d-flex justify-content-center align-items-center">
                <div class="d-flex align-items-center"><img src="<?php echo get_stylesheet_directory_uri()?>/images/sin-reembolsos.png" alt="" width="62">No se realizan reembolsos</div>
                <div class="d-flex align-items-center"><img src="<?php echo get_stylesheet_directory_uri()?>/images/lock.png" alt="" width="35">Pago 100% Seguro</div>
            </div>
            <ul class="card-payment">
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/cardvisa.jpg" alt="">
                </li>  
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/Amex-Logo.jpg" alt="">
                </li>  
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/master_card.jpg" alt="">
                </li>  
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/maestro-logo.jpg" alt="">
                </li>  
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/discover.png" alt="">
                </li>  
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/paypal.png" alt="">
                </li>            
            </ul>
        </div>
    </section>

    <?php if( get_field('sect9_title') ): ?>
    <section class="section-questions">
        <div class="wrap">
            <div class="animation-title">
                <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true"><?php the_field('sect9_title') ?></h2>
            </div>
            <div id="accordion"  data-aos="fade-right" data-aos-duration="800" data-aos-once="true">
                <?php 
                $i = 1;
                while( have_rows('faqs') ): the_row(); ?>
                <div class="item-accordion">
                    <div class="acd-header" data-target="#collapse_<?php echo $i; ?>">
                        <h6><?php the_sub_field('faq_title'); ?></h6>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div id="collapse_<?php echo $i; ?>" class="acd-body">
                        <p><?php the_sub_field('faq_content'); ?></p>
                    </div>
                    <?php $i++; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php
}

genesis();
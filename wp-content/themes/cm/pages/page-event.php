<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / Evento
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
    $args = array( 
        'posts_per_page'   => 6,
        'post_type'      => 'evento',
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts()):
        ?>
    <section class="section-event sec-store">
            <div class="container">
                <div class="animation-title">
                    <h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">EVENTOS</h2>
                </div>
                <div class="row">
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
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
                            <div class="col-md-4">
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
                 </div>
            </div>
        </section><?php
    endif;

    if($section_event_1 = get_field('section_event_1')){
        $section_shop = $section_event_1['section_shop'];
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
                                <div class="col-md-4">
                                    <?php
                                    if($product['prod_image']){
                                        echo '<div class="store-img">';
                                        echo '<a href="'.$product['prod_title']['url'].'" target="'.$product['prod_title']['target'].'" class="link-black">';
                                        echo '<img src="'.$product['prod_image'].'"/>';
                                        echo '</a>';
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

    if($section_event_2 = get_field('section_event_2')){
        $section_steps = $section_event_2['section_steps'];
        ?>
        <section class="c-section">
            <div class="wrap">
                <?php
                if($section_steps['steps_title']){
                    echo '<div class="animation-title">';
                    echo '<h2 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_steps['steps_title'].'</h2>';
                    echo '</div>';
                }
                ?>
                <div class="row">
                    <div class="col-md-8">
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
                    <div class="col-md-4 text-center">
                        <img src="<?php echo get_stylesheet_directory_uri()?>/images/phonex.png"/>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    if($section_event_3 = get_field('section_event_3')){
        $section_testimonials = $section_event_3['section_testimonials'];
        ?>
        <section class="sec-testimonials">
            <div class="wrap">
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
}

genesis();
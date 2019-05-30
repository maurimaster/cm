<?php
/**
 * Claudia
 *
 * Claudia Theme.
 *
 * Template Name: Pagina / biografia
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
add_action('genesis_after_header', 'page_bio_function');
function page_bio_function() {
    $images = get_field('sponsors');
    ?>
    <div class="top-sponsors">
        <div class="wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="sponsors-top-list">
                        <?php
                        if( $images ): ?>
                                <?php foreach( $images as $image ): ?>
                                    <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                                <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if($section_info_1 = get_field('section_info_1')){
    ?>

    <section class="hero-bio">
        <div class="float-bkg-gradient">
            <?php
            if($section_info_1['info1_background_image']){
                echo '<img src="'.$section_info_1['info1_background_image'].'" alt="">';
            }else {
                echo '<img src="'.get_stylesheet_directory_uri().'/images/photo_claudia.png)" alt="">';
            }
            ?>
            
            <div class="bkg-top-left"></div>
            <div class="bkg-top-right"></div>
            <div class="bkg-bottom-left"></div>
            <div class="bkg-bottom-right"></div>
        </div>
        <div class="wrap">
            <div class="row">
                <div class="col-md-6">
                    <div class="cont-details">
                        <?php
                        if($section_info_1['info1_title']){
                            echo '<div class="animation-title">';
                            echo '<h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_info_1['info1_title'].'</h3>';
                            echo '</div>';
                        }
                        echo $section_info_1['info1_content'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap">
            <div class="row">
                <div class="col-md-7">
                    <div class="float-photos">
                    <?php
                    if($section_info_1['info1_image_1']){
                        echo '<div class="c-photo tm-1">';
                            echo '<img src="'.$section_info_1['info1_image_1'].'" alt="">';
                        echo '</div>';
                    }   
                    if($section_info_1['info1_image_2']){
                        echo '<div class="c-photo tm-2">';
                            echo '<img src="'.$section_info_1['info1_image_2'].'" alt="">';
                        echo '</div>';
                    } 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    }

    if($section_info_2 = get_field('section_info_2')){
        ?>
        <section class="sec-success" style="background-image: url(<?php echo get_stylesheet_directory_uri()?>/images/bkg_could.png);">
            <div class="wrap">
                <div class="magnific-card">
                <?php
                if($section_info_2['info2_title']){
                    echo '<div class="animation-title tl-mg-card">';
                    echo '<h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_info_2['info2_title'].'</h3>';
                    echo '</div>';
                }
                if($section_info_2['info2_content']){
                    echo '<div class="c-mg-card">';
                    echo $section_info_2['info2_content'];
                    echo '</div>';
                }
                ?>
                </div>
            </div>
        </section>
        <?php
    }

    $section_info_3 = get_field('section_info_3');
    $section_info_4 = get_field('section_info_4');
    if($section_info_3 || $section_info_4){
        ?>
        <section class="sec-biography">
            <div class="wrap">
                <?php
                if($section_info_3){
                    ?>
                    <div class="row-bio">
                        <div class="col-left">
                            <div class="cont-details">
                            <?php
                            if($section_info_3['info3_title']){
                                echo '<div class="animation-title">';
                                echo '<h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_info_3['info3_title'].'</h3>';
                                echo '</div>';
                            }
                            echo $section_info_3['info3_content'];
                            ?>
                            </div>
                        </div>
                        <div class="col-right">
                            <div class="bio-border"></div>
                            <?php
                            if($section_info_3['info3_right_image']){
                                echo '<div class="cont-image">';
                                echo '<img src="'.$section_info_3['info3_right_image'].'" alt="">';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                if($section_info_4){
                    ?>
                    <div class="row-bio row-reverse">
                        <div class="col-left">
                            <div class="cont-details">
                            <?php
                            if($section_info_4['info4_title']){
                                echo '<div class="animation-title">';
                                echo '<h3 data-aos="fade-up" data-aos-duration="600" data-aos-once="true">'.$section_info_4['info4_title'].'</h3>';
                                echo '</div>';
                            }
                            echo $section_info_4['info4_content'];
                            ?>
                            </div>
                        </div>
                        <div class="col-right">
                            <div class="bio-border"></div>
                            <?php
                            if($section_info_4['info4_left_image']){
                                echo '<div class="cont-image">';
                                echo '<img src="'.$section_info_4['info4_left_image'].'" alt="">';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <?php
    }
    ?>
    


    
    <?php
}

genesis();
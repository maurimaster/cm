<?php
/*********************************
*	Template Name: Course Parent
*********************************/

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

add_filter( 'sidebars_widgets', 'wpsites_unset_sidebar_widget' );
function wpsites_unset_sidebar_widget( $sidebars_widgets ) {
	unset( $sidebars_widgets[ 'sidebar' ] );
	return $sidebars_widgets;
}


add_action('genesis_before_sidebar_widget_area', 'wpsites_sidebar_custom_field');
function wpsites_sidebar_custom_field() {
	$current_page = get_the_ID();
	// echo '<div>current'.$current_page.'</div>';
	// $args = array(
	//     'post_type'      => 'page',
	//     'posts_per_page' => -1,
	//     'post_parent'    => $current_page,
	//     'order'          => 'ASC',
	//     'orderby'        => 'menu_order'
	// );

	dynamic_sidebar( 'menu-subscription-sidebar' );


	// $parent = new WP_Query( $args );

	// if ( $parent->have_posts() ) :

	// 	echo '<section class="widget"><div class="menu-child" style="clear:both;">';
	// 		echo '<div><a href="'.$current_page.'" class="current">'.get_the_title().'</a></div>';
	//     while ( $parent->have_posts() ) : $parent->the_post();

	//         echo '<div><a href="'.get_the_ID().'">'.get_the_title().'</a></div>';

	//     endwhile;

	//     echo '</div></section>';

	// endif;
	// wp_reset_postdata();

	// echo '<script>
	// jQuery(document).ready(function(){
	// 	jQuery(".widget .menu-child a").on("click", function(e){
	// 		e.preventDefault();
	// 		var page_id = jQuery(this).attr("href");
	// 		if(!jQuery(this).hasClass("current")){
	// 			jQuery(".site-inner #genesis-content").addClass("loading");
	// 			jQuery.ajax({
	// 			    url : "'.get_site_url().'/wp-admin/admin-ajax.php",
	// 			    type : "post",
	// 			    data : {
	// 			      action : "post_linked",
	// 			      id : page_id
	// 			    },
	// 			    success : function( response ) {
	// 			    	var obj=jQuery.parseJSON(response);
	// 			    	console.log(obj.res);
	// 			    	jQuery(".site-inner #genesis-content").removeClass("loading");
	// 			    	jQuery(".site-inner #genesis-content>article").html(obj.res);
	// 			    }
	// 			});
	// 		}
	// 		jQuery(".widget .menu-child a").removeClass("current");
	// 		jQuery(this).addClass("current");
	// 	});
	// });
	// </script>';
}

add_action('genesis_before_loop', 'top_links_fff');
function top_links_fff(){
	echo do_shortcode('[top_links]');
}



genesis();
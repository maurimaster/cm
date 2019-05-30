<?php
/**
 * Genesis Sample.
 *
 * This file adds the default theme settings to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://www.studiopress.com/
 */

add_filter( 'genesis_theme_settings_defaults', 'genesis_sample_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 2.2.3
 *
 * @param array $defaults Original theme settings defaults.
 * @return array Modified defaults.
 */
function genesis_sample_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

add_action( 'after_switch_theme', 'genesis_sample_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 2.2.3
 */
function genesis_sample_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings(
			array(
				'blog_cat_num'              => 6,
				'content_archive'           => 'full',
				'content_archive_limit'     => 0,
				'content_archive_thumbnail' => 0,
				'posts_nav'                 => 'numeric',
				'site_layout'               => 'content-sidebar',
			)
		);

	}

	update_option( 'posts_per_page', 6 );

}

add_filter( 'simple_social_default_styles', 'genesis_sample_social_default_styles' );
/**
 * Set Simple Social Icon defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults Social style defaults.
 * @return array Modified social style defaults.
 */
function genesis_sample_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#333333',
		'border_radius'          => 3,
		'border_width'           => 0,
		'icon_color'             => '#333333',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 40,
	);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}
//* Force svg
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//* Force full-width-content layout setting
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

//* Remove the site title
remove_action('genesis_entry_header', 'genesis_do_post_title');

/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action('genesis_site_title', 'genesis_seo_site_title');
remove_action('genesis_site_description', 'genesis_seo_site_description');
remove_action('genesis_site_title', 'genesis_seo_site_title');
function custom_site_title()
{
	$logo = get_field('header', 'option');
	// echo '<a class="retina logo" href="' . get_bloginfo('url') . '" title="AG"><img src="' . $logo['logo'] . '" alt="logo"/></a>';
	echo '<a class="retina logo" href="' . get_bloginfo('url') . '" title="AG"><img src="' . $logo['logo'] . '" alt="logo"/></a>';
	
}
add_action('genesis_site_title', 'custom_site_title');

//* Remove copyright wordpress
function remove_footer_admin()
{
	echo '';
}

add_filter('admin_footer_text', 'remove_footer_admin');
//* Customize the entire footer



/** Register Utility Bar Widget Areas. */
genesis_register_sidebar(array(
	'id' => 'top-bar',
	'name' => __('Top Bar', 'theme-prefix'),
	'description' => __('This is the left utility bar above the header.', 'theme-prefix'),
));


remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'sp_custom_footer');
function sp_custom_footer()	{
	$footer = get_field('footer','option');
	?>
	<div class="section-subscription">
		<div class="wrap">
			<div class="subscription row gutter-10">
				<div class="subscription-left col-sm-9">
					<h3><?echo $footer['titulo'];?></h3>
					<p><?echo $footer['subtitulo'];?></p>
				</div>
				<div class="subscription-right col-sm-3">
					<p><i class="fa fa-long-arrow-down" aria-hidden="true"></i> <?echo $footer['texto_derecha'];?></p>
				</div>
			</div>
			<div class="c-form-subs" style="margin-bottom: 15px;">
				<?php
				echo do_shortcode('[custom_c]');
				?>
			</div>
			<div class="socials">
				<ul>
					<li><a href="<?php echo $footer['facebook_url']?>"><i class="fa fa-facebook" aria-hidden="true"></i>
</a></li>
					<li><a href="<?php echo $footer['instagram_url'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i>
					</a></li>
					<li><a href="<?php echo $footer['youtube_url'] ?>"><i class="fa fa-youtube" aria-hidden="true"></i>
					</a></li>

				</ul>
				<h4><?php echo $footer['text_bottom'];?></h4>
			</div>
			<div class="menu-footer">
				<ul>
				<?php if($menu_links = $footer['menu_links']):
					foreach($menu_links as $link ):
					?>
					<li><a href="<?php echo $link['menu_item']['url']?>"><?php echo $link['menu_item']['title'] ?></a></li>
				<?php endforeach;endif;?>
					</ul>
			</div>
			<div class="footer-button">
				<a class="btn btn-white-transparent" href="<?php echo $footer['forma_parte_del_reto']['url'] ?>"><?php echo $footer['forma_parte_del_reto']['title'] ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="section-copyright">
		<div class="wrap">
			<div class="row align-items-center">
				<div class="col-sm-3 text-left">
					<a href="#"><img class="logo-footer" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo_footer.png" /></a>
				</div>
				<div class="col-sm-6 text-center">
					<p>&copy; MCM Entertainment Inc. 2018  TODOS LOS DERECHOS RESERVADOS</p>
				</div>
				<div class="col-sm-3 text-right">
					<a href="http://www.wearescale.com/"><img class="scale" src="<?php echo get_stylesheet_directory_uri() ?>/images/scale.png" /></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}

add_action('genesis_before_header', 'utility_bar');
/**

 */
function utility_bar()
{

	echo '<div class="utility-bar"><div class="wrap">';

	genesis_widget_area('top-bar', array(
		'before' => '<div class="top-bar">',
		'after' => '</div>',
	));


	echo '</div></div>';

}


/*********************************************
 *	Register Custom Post Type
 *********************************************/
function custom_post_type1()
{

	$labels = array(
		'name' => _x('Testimonios', 'Post Type General Name', 'text_domain'),
		'singular_name' => _x('Testimonios', 'Post Type Singular Name', 'text_domain'),
		'menu_name' => __('Testimonios', 'text_domain'),
		'name_admin_bar' => __('Testimonio', 'text_domain'),
		'archives' => __('Item Testimonios', 'text_domain'),
		'attributes' => __('Item Testimonio', 'text_domain'),
		'parent_item_colon' => __('Parent Item:', 'text_domain'),
		'all_items' => __('All Items', 'text_domain'),
		'add_new_item' => __('Add New Item', 'text_domain'),
		'add_new' => __('Add New', 'text_domain'),
		'new_item' => __('New Item', 'text_domain'),
		'edit_item' => __('Edit Item', 'text_domain'),
		'update_item' => __('Update Item', 'text_domain'),
		'view_item' => __('View Item', 'text_domain'),
		'view_items' => __('View Items', 'text_domain'),
		'search_items' => __('Search Item', 'text_domain'),
		'not_found' => __('Not found', 'text_domain'),
		'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
		'featured_image' => __('Featured Image', 'text_domain'),
		'set_featured_image' => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image' => __('Use as featured image', 'text_domain'),
		'insert_into_item' => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list' => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list' => __('Filter items list', 'text_domain'),
	);
	$args = array(
		'label' => __('Testimonio', 'text_domain'),
		'description' => __('Testimonios', 'text_domain'),
		'labels' => $labels,
		'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-editor-quote',
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type('testimonio', $args);

}
add_action('init', 'custom_post_type1', 0);

function custom_post_type2()
{

	$labels = array(
		'name' => _x('Eventos', 'Post Type General Name', 'text_domain'),
		'singular_name' => _x('Eventos', 'Post Type Singular Name', 'text_domain'),
		'menu_name' => __('Eventos', 'text_domain'),
		'name_admin_bar' => __('Evento', 'text_domain'),
		'archives' => __('Item Eventos', 'text_domain'),
		'attributes' => __('Item Evento', 'text_domain'),
		'parent_item_colon' => __('Parent Item:', 'text_domain'),
		'all_items' => __('All Items', 'text_domain'),
		'add_new_item' => __('Add New Item', 'text_domain'),
		'add_new' => __('Add New', 'text_domain'),
		'new_item' => __('New Item', 'text_domain'),
		'edit_item' => __('Edit Item', 'text_domain'),
		'update_item' => __('Update Item', 'text_domain'),
		'view_item' => __('View Item', 'text_domain'),
		'view_items' => __('View Items', 'text_domain'),
		'search_items' => __('Search Item', 'text_domain'),
		'not_found' => __('Not found', 'text_domain'),
		'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
		'featured_image' => __('Featured Image', 'text_domain'),
		'set_featured_image' => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image' => __('Use as featured image', 'text_domain'),
		'insert_into_item' => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list' => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list' => __('Filter items list', 'text_domain'),
	);
	$args = array(
		'label' => __('Evento', 'text_domain'),
		'description' => __('Eventos', 'text_domain'),
		'labels' => $labels,
		'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'menu_icon' => 'dashicons-calendar-alt',
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type('evento', $args);

}
add_action('init', 'custom_post_type2', 0);


/*********************************************
*	Contact Popup
*********************************************/
add_action('genesis_before_header', 'contact_function');
function contact_function(){
	?>
	<div id="contact_popup" class="contact-popup mfp-hide">
	<?php	
		echo do_shortcode('[contact-form-7 id="393" title="Contact form"]');
	?>
		<!--<h2>¿CÓMO TE PUEDO AYUDAR?</h2>
		<p>Por favor, introduzca sus datos y nos pondremos en contacto pronto.</p>
		<div class="row">
			<div class="col-md-3">
				<label for="your_name">Nombre:*</label>
				<label for="telephone">Teléfono:*</label>
				<label for="your_email">Email:*</label>
				<label for="your_interest">Interesado en:</label>
				<label for="your_message">Mensaje:</label>
			</div>
			<div class="col-md-9">
				<div class="item-form">
					<input type="text" name="your_name">
				</div>
				<div class="item-form">
					<input type="text" name="telephone">
				</div>
				<div class="item-form">
					<input type="email" name="your_email">
				</div>
				<div class="item-form c-select">
					<select name="your_interest">
						<option disabled selected value></option>
						<option value="optiom 1">option 1</option>
						<option value="optiom 2">option 2</option>
						<option value="optiom 3">option 3</option>
					</select>
				</div>
				<div class="item-form">
					<textarea name="your_message" id="" rows="8"></textarea>
				</div>
				<div class="item-form">
					<button class="btn">ENVIAR MENSAJE <i class="fa fa-chevron-right" ></i></button>
				</div>
			</div>
		</div>-->
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	</div>
	<?php
}
add_action( 'wp_ajax_nopriv_post_linked', 'post_linked' );
add_action( 'wp_ajax_post_linked', 'post_linked' );
function post_linked() {
	$id_post = $_POST['id'];
	if ($id_post) {
		$results['res'] = '';
		//$results['res'] .= do_shortcode('[top_links]');
		$results['res'] .= '<article class="post page entry">';
		$content_post = get_page($id_post);
		$results['res'] .= do_shortcode(apply_filters('the_content',$content_post->post_content));
		$results['res'] .= '</article>';
		/*********************************/
		echo json_encode($results);
	}
	die();
}
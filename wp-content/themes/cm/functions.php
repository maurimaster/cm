<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

//* Shortcodes Theme
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';
//* Start plugins
include_once(get_stylesheet_directory() . '/plugins/init.php');
// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'claudia' );
define( 'CHILD_THEME_URL', 'https://www.claudia.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	// wp_enqueue_style(
	// 	'passion-font',
	// 	'//fonts.googleapis.com/css?family=Passion+One:700',
	// 	array(),
	// 	CHILD_THEME_VERSION
	// );
	// wp_enqueue_style(
	// 	'open-sans',
	// 	'//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800',
	// 	array(),
	// 	CHILD_THEME_VERSION
	// );

		
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', array(), '23130608');
	wp_enqueue_style('grid-boostrap', get_stylesheet_directory_uri() . '/css/grid.min.css', array(), '20130608');
	wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/css/slick.css', array());
	wp_enqueue_style('magnific-popup', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array());
	wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/custom.css', array(), '20130609');
	wp_enqueue_style('responsive-css', get_stylesheet_directory_uri() . '/css/responsive.css', array(), '20130609');
	wp_enqueue_style('responsive2-css', get_stylesheet_directory_uri() . '/css/responsive2.css', array(), '20130610');
	wp_enqueue_script('jquery-slick', get_stylesheet_directory_uri() . "/js/slick.min.js", array('jquery'), CHILD_THEME_VERSION, true);
	wp_enqueue_script('magnific-popup-js', get_stylesheet_directory_uri() . "/js/jquery.magnific-popup.min.js", array('jquery'), CHILD_THEME_VERSION, true);
	wp_enqueue_script('sticky-kit', get_stylesheet_directory_uri() . "/js/jquery.sticky-kit.min.js", array('jquery'), CHILD_THEME_VERSION, true);

	// AOS animation
	wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css?ver=20130610', array(), '23130608');
	wp_enqueue_script('aos-js', "https://unpkg.com/aos@2.3.1/dist/aos.js?ver=2.3.0", array('jquery'), CHILD_THEME_VERSION, true);
	
	wp_enqueue_script(
		'genesis-sample',
		get_stylesheet_directory_uri() . '/js/genesis-sample.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_enqueue_script('jquery-common', get_stylesheet_directory_uri() . "/js/common.js", array('jquery'), CHILD_THEME_VERSION, true);

}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Sets the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 702; // Pixels.
}

// Adds support for HTML5 markup structure.
add_theme_support(
	'html5', array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	)
);

// Adds support for accessibility.
add_theme_support(
	'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	)
);

// Adds viewport meta tag for mobile browsers.
add_theme_support(
	'genesis-responsive-viewport'
);

// Adds custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	)
);

// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'genesis-sample' ),
		'secondary' => __( 'Footer Menu', 'genesis-sample' ),
	)
);

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
// add_theme_support( 'genesis-footer-widgets', 3 );

genesis_register_sidebar( array(
	'id' => 'menu-subscription-sidebar',
	'name' => 'Menu Levels Sidebar',
	'description' => 'This is the sidebar for menu pages.',
));


// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_image_size('thumb-first-blog', 515, 370, true );

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}


//* Add Custom Pagination with numbers
function pagination_bar( $custom_query ) {
    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __( '<i class="fa fa-angle-left"></i>' ),
			'next_text' => __( '<i class="fa fa-angle-right"></i>' ),
        ));
    }
}

add_filter('comment_form_defaults', 'set_my_comment_title', 20);
function set_my_comment_title( $defaults ){
 $defaults['title_reply'] = __('Deja una respuesta', 'customizr-child');
 $defaults['label_submit'] = __('Enviar Comentario', 'customizr-child');
 return $defaults;
}
function wpforo_search_form( $html ) {

    $html = str_replace( 'placeholder="Search this website ', 'placeholder="¿Qué estas buscando? ', $html );

    return $html;
}
add_filter( 'get_search_form', 'wpforo_search_form' );


function wpb_dashboard_menu() {
	register_nav_menu('dashboard-menu',__( 'Dashboard Menu' ));
}
add_action( 'init', 'wpb_dashboard_menu' );

add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
    if ($args->theme_location == 'dashboard-menu') {
    	//$c_item = do_shortcode('[accessally_logout_url text="CERRAR SESIÓN"]');
    	$test = get_site_url()."/wp-login.php?action=logout";
    	$c_item = '<a href="'.get_site_url()."/wp-login.php?action=logout".'">CERRAR SESIÓN</a>';
        $items .= '<li class="menu-item">'.$c_item.'</li>';
    }
    return $items;
}






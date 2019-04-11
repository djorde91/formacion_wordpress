<?php
/**
 * trade-hub functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package trade-hub
 */

if ( !function_exists('trade_hub_file_directory') ) 
{
	function trade_hub_file_directory($file_path)
	{
		if ( file_exists(trailingslashit( get_stylesheet_directory() ). $file_path) )
		{
			return trailingslashit( get_stylesheet_directory() ). $file_path;
		}
		else
		{
			return trailingslashit( get_template_directory() ). $file_path;
		}
	}
}

/**
 * require trade-hub int.
 */
require get_template_directory() . '/inc/init.php';
// $trade_hub_init_file_path = trade_hub_file_directory('inc/init.php');
// require $trade_hub_init_file_path;


if ( ! function_exists( 'trade_hub_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trade_hub_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on trade-hub, use a find and replace
	 * to change 'trade-hub' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'trade-hub', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'trade-hub' ),
		'social' => esc_html__( 'Social Menu', 'trade-hub' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'trade_hub_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*implimenting new feature from 4.5*/
	add_theme_support( 'custom-logo', array(
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	/*woocommerce support*/
	add_theme_support( 'woocommerce' );




}
endif;
add_action( 'after_setup_theme', 'trade_hub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function trade_hub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trade_hub_content_width', 640 );
}
add_action( 'after_setup_theme', 'trade_hub_content_width', 0 );


// for font 
function trade_hub_google_fonts()
{
	global $trade_hub_customizer_all_values;
	$fonts_url = '';
	$fonts     = array();

	$trade_hub_font_family_site_identity = $trade_hub_customizer_all_values['trade-hub-font-family-site-identity'];
	$trade_hub_font_family_menu = $trade_hub_customizer_all_values['trade-hub-font-family-menu'];
	$trade_hub_font_family_h1_h6 = $trade_hub_customizer_all_values['trade-hub-font-family-h1-h6'];
	$trade_hub_font_family_body  = $trade_hub_customizer_all_values['trade-hub-font-family-body'];

	$trade_hub_pro_fonts = array();
	$trade_hub_pro_fonts[]=$trade_hub_font_family_site_identity;
	$trade_hub_pro_fonts[]=$trade_hub_font_family_menu;
	$trade_hub_pro_fonts[]=$trade_hub_font_family_h1_h6;
	$trade_hub_pro_fonts[]=$trade_hub_font_family_body;

	 $trade_hub_pro_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	  $i  = 0;
	  for ($i=0; $i < count( $trade_hub_pro_fonts ); $i++) { 

	    if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'trade-hub' ), $trade_hub_pro_fonts[$i] ) ) {
			$fonts[] = $trade_hub_pro_fonts[$i];
		}

	  }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urldecode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function trade_hub_scripts() {
    global $trade_hub_customizer_all_values;
		// *** STYLE ***//
		//slick main
	    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/frameworks/slick/slick.css', array(), '3.4.0' );/*added*/

		
		// Main stylesheet
		wp_enqueue_style( 'trade-hub-style', get_stylesheet_uri() );

		// google font
		wp_enqueue_style( 'trade-hub-google-fonts', trade_hub_google_fonts() );


		// *** SCRIPT ***//
		$min = '.min';
		if ( defined( 'SCRIPT_DEBUG' ) && true == SCRIPT_DEBUG ) {
			$min = '';
		}
		
		// modernizr
		wp_enqueue_script( 'jquery-modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'), '2.8.3', true );

		// wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array('jquery'), true );

		
		// easing
		wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/assets/frameworks/jquery.easing/jquery.easing.js', array('jquery'), '0.3.6', 1);
	    // slick
	    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/frameworks/slick/slick' . $min . '.js', array('jquery'), '1.6.0', 1);
	    // waypoints
	    wp_enqueue_script('jquery-waypoints', get_template_directory_uri() . '/assets/frameworks/waypoints/jquery.waypoints' . $min . '.js', array('jquery'), '4.0.0', 1);
		// custom
		wp_enqueue_script('trade-hub-custom-js', get_template_directory_uri() . '/assets/js/evision-custom.js', array('jquery'), '', true);

		// skip-link-focus-fix
		wp_enqueue_script( 'trade-hub-skip-link-focus-fix', get_template_directory_uri() . './assets/js/skip-link-focus-fix.js', array(), '20151215', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trade_hub_scripts', 99 );


/**
 * Customizer control styles and scripts.
 */
function trade_hub_customizer_control_scripts()
{
    wp_enqueue_style('trade-hub-customize-controls-style', get_template_directory_uri() . '/editor-style.css');
}

add_action('customize_controls_enqueue_scripts', 'trade_hub_customizer_control_scripts', 0);


/*added admin css for meta*/
function trade_hub_wp_admin_style($hook) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        wp_register_style( 'trade-hub-admin-css', get_template_directory_uri() . '/assets/css/admin-meta.css',array(), ''  );
        wp_enqueue_style( 'trade-hub-admin-css' );
    }
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_media();
		wp_enqueue_script( 'trade-hub-widgets-script', get_template_directory_uri() . '/assets/js/widgets.js', array( 'jquery' ), '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'trade_hub_wp_admin_style' );
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';




/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';



/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/*breadcrum function*/

if ( ! function_exists( 'trade_hub_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function trade_hub_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/frameworks/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;

/*update to pro added*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/trade-hub/class-customize.php' );

function trade_hub_primary_menu_callback() {
	?>
		<ul id="menu">
			<li><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e('Home','trade-hub');?></a></li>
			<li><a href="<?php echo esc_url( admin_url( '/nav-menus.php' ) );?>"><?php esc_html_e('Set Primary Menu','trade-hub');?></a></li>
		</ul>
	<?php
}

function trade_hub_primary_menu_mobile_callback() {
	?>
		<ul id="mobile-menu">
			<li><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e('Home','trade-hub');?></a></li>
			<li><a href="<?php echo esc_url( admin_url( '/nav-menus.php' ) );?>"><?php esc_html_e('Set Primary Menu','trade-hub');?></a></li>
		</ul>
	<?php
}
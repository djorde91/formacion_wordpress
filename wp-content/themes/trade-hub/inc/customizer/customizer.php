<?php
/**
 * evision themes Theme Customizer
 *
 * @package eVision themes
 * @subpackage trade-hub
 * @since trade-hub 1.0.0
 */
/*Define Url for including css and js*/
if ( !defined( 'EVISION_CUSTOMIZER_URL' ) ) {
    define( 'EVISION_CUSTOMIZER_URL', trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/evision-customizer/' );
}
/*Define path for including php files*/
if ( !defined( 'EVISION_CUSTOMIZER_PATH' ) ) {
    define( 'EVISION_CUSTOMIZER_PATH', trailingslashit( get_template_directory() ) . 'inc/frameworks/evision-customizer/' );
}

/*define constant for evision customizer name*/
if(!defined('EVISION_CUSTOMIZER_NAME')){
    define( 'EVISION_CUSTOMIZER_NAME', 'trade_hub_options' );
}

/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since trade-hub 1.0.0
 */
if ( ! function_exists( 'trade_hub_reset_options' ) ) :
    function trade_hub_reset_options( $reset_options ) {
        set_theme_mod( EVISION_CUSTOMIZER_NAME, $reset_options );
    }
endif;

/**
 * Customizer framework added.
 */
require get_template_directory() . '/inc/frameworks/evision-customizer/evision-customizer.php';
global $trade_hub_panels;
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

/******************************************
Modify Site Color Options
 *******************************************/
require get_template_directory().'/inc/customizer/color/color-section.php';

/******************************************
Modify Site Font Options
 *******************************************/
require get_template_directory().'/inc/customizer/font/font-section.php';

/******************************************
Featured Slider options
 *******************************************/
// require get_template_directory().'/inc/customizer/featured-slider/slider-panel.php';

/******************************************
Modify Theme Option Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/theme-option/option-panel.php';


/******************************************
main-home-page options
 *******************************************/
require get_template_directory().'/inc/customizer/main-home-page.php';
// $trade_hub_main_home_page_file_path = trade_hub_file_directory('inc/customizer/main-home-page.php');
// require $trade_hub_main_home_page_file_path;



/*Resetting all Values*/
/**
 * Reset color settings to default
 *
 * @since trade-hub 1.0.0
 */
global $trade_hub_customizer_defaults;
$trade_hub_customizer_defaults['trade-hub-customizer-reset-settings'] = '';
if ( ! function_exists( 'trade_hub_customizer_reset' ) ) :
    function trade_hub_customizer_reset( ) {
        global $trade_hub_customizer_saved_values;
        $trade_hub_customizer_saved_values = trade_hub_get_all_options();
        if ( $trade_hub_customizer_saved_values['trade-hub-customizer-reset-settings'] == 1 ) {
            global $trade_hub_customizer_defaults;
            /*getting fields*/
            $trade_hub_customizer_defaults['trade-hub-customizer-reset-settings'] = '';
            /*resetting fields*/
            trade_hub_reset_options( $trade_hub_customizer_defaults );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','trade_hub_customizer_reset' );

$trade_hub_sections['trade-hub-customizer-reset'] =
    array(
        'priority'       => 999,
        'title'          => esc_html__( 'Reset All Options', 'trade-hub' )
    );
$trade_hub_settings_controls['trade-hub-customizer-reset-settings'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-customizer-reset-settings'],
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Reset All Options', 'trade-hub' ),
            'description'           =>  esc_html__( 'Caution: Reset all options settings to default. Refresh the page after save to view the effects. ', 'trade-hub' ),
            'section'               => 'trade-hub-customizer-reset',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/******************************************
Aranging header image
 *******************************************/
$trade_hub_sections['custom_css'] =
    array(
        'title'          => esc_html__( 'Additional CSS', 'trade-hub' ),
        'priority'       => 400,
    );
    
$trade_hub_sections['header_image'] =
    array(
        'priority'       => 1999,
        'title'          => esc_html__( 'Header Image', 'trade-hub' )
    );

$trade_hub_customizer_args = array(
    'panels'            => $trade_hub_panels, /*always use key panels */
    'sections'          => $trade_hub_sections,/*always use key sections*/
    'settings_controls' => $trade_hub_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $trade_hub_repeated_settings_controls,/*always use key sections*/
);

/*registering panel section setting and control start*/
function trade_hub_add_panels_sections_settings() {
    global $trade_hub_customizer_args;
    return $trade_hub_customizer_args;
}
add_filter( 'evision_customizer_panels_sections_settings', 'trade_hub_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trade_hub_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'trade_hub_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trade_hub_customize_preview_js() {
    wp_enqueue_script( 'trade_hub_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'trade_hub_customize_preview_js' );


/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since trade-hub 1.0.0
 */
if ( ! function_exists( 'trade_hub_get_all_options' ) ) :
    function trade_hub_get_all_options( $merge_default = 0 ) {
        $trade_hub_customizer_saved_values = evision_customizer_get_all_values( EVISION_CUSTOMIZER_NAME );
        if( 1 == $merge_default ){
            global $trade_hub_customizer_defaults;
            if(is_array( $trade_hub_customizer_saved_values )){
                $trade_hub_customizer_saved_values = array_merge($trade_hub_customizer_defaults, $trade_hub_customizer_saved_values );
            }
            else{
                $trade_hub_customizer_saved_values = $trade_hub_customizer_defaults;
            }
        }
        return $trade_hub_customizer_saved_values;
    }
endif;

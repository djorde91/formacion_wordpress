<?php
global$trade_hub_sections;
global$trade_hub_settings_controls;
global$trade_hub_customizer_defaults;

/*defaults values*/
$trade_hub_customizer_defaults['trade-hub-site-identity-color'] = '#313131';
$trade_hub_customizer_defaults['trade-hub-primary-color'] = '#239ddb';
$trade_hub_customizer_defaults['trade-hub-heading-section-title-color'] = '#000000';
$trade_hub_customizer_defaults['trade-hub-post-page-title-color'] = '#000000';
$trade_hub_customizer_defaults['trade-hub-menu-text-color'] = '#000000';
$trade_hub_customizer_defaults['trade-hub-color-reset'] = '';



/*Default color*/
$trade_hub_sections['colors'] = array(
        'priority'       => 40,
        'title'          => esc_html__( 'Colors Options', 'trade-hub' )
    );



/**
 * Reset color settings to default
 *
 * @since trade-hub 1.0.0
 */
if ( ! function_exists( 'trade_hub_color_reset' ) ) :
    function trade_hub_color_reset( ) {
        
        global$trade_hub_customizer_saved_values;
        $trade_hub_customizer_saved_values = trade_hub_get_all_options();
      
        if ( 1 == intval($trade_hub_customizer_saved_values['trade-hub-color-reset'] ) ) {
            global$trade_hub_customizer_defaults;
            /*getting fields*/

            /*setting fields */
           $trade_hub_customizer_saved_values['trade-hub-site-identity-color']            = $trade_hub_customizer_defaults['trade-hub-site-identity-color'] ;
           $trade_hub_customizer_saved_values['trade-hub-primary-color']                  = $trade_hub_customizer_defaults['trade-hub-primary-color'] ;
           $trade_hub_customizer_saved_values['trade-hub-heading-section-title-color']     = $trade_hub_customizer_defaults['trade-hub-heading-section-title-color'];
           $trade_hub_customizer_saved_values['trade-hub-post-page-title-color']          = $trade_hub_customizer_defaults['trade-hub-post-page-title-color'];
           $trade_hub_customizer_saved_values['trade-hub-menu-text-color']                = $trade_hub_customizer_defaults['trade-hub-menu-text-color'];
          
            remove_theme_mod( 'background_color' );
           $trade_hub_customizer_saved_values['trade-hub-color-reset']                    = '';

            /*resetting fields*/
            trade_hub_reset_options($trade_hub_customizer_saved_values );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','trade_hub_color_reset' );




$trade_hub_settings_controls['trade-hub-site-identity-color'] = array(
    'setting' =>  array(
        'default'  => $trade_hub_customizer_defaults['trade-hub-site-identity-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Site Identity Color', 'trade-hub' ),
        'description'           =>  esc_html__( 'Site title and tagline color', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 20,
        'active_callback'       => ''
    )
);

$trade_hub_settings_controls['trade-hub-primary-color'] = array(
    'setting' => array(
        'default' => $trade_hub_customizer_defaults['trade-hub-primary-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Primary Color', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 30,
        'active_callback'       => ''
    )
);


$trade_hub_settings_controls['trade-hub-menu-text-color'] = array(
    'setting' => array(
        'default' => $trade_hub_customizer_defaults['trade-hub-menu-text-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Menu Text Color', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 40,
        'active_callback'       => ''
    )
);

$trade_hub_settings_controls['trade-hub-heading-section-title-color'] = array(
    'setting' => array(
        'default' => $trade_hub_customizer_defaults['trade-hub-heading-section-title-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Section Heading Title Color', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 45,
        'active_callback'       => ''
    )
);

$trade_hub_settings_controls['trade-hub-post-page-title-color'] = array(
    'setting' => array(
        'default' => $trade_hub_customizer_defaults['trade-hub-post-page-title-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Post Page Title Color', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 50,
        'active_callback'       => ''
    )
);



$trade_hub_settings_controls['trade-hub-color-reset'] = array(
    'setting' => array(
        'default'   => $trade_hub_customizer_defaults['trade-hub-color-reset'],
        'transport'            => 'postmessage',
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Reset', 'trade-hub' ),
        'description'           =>  esc_html__( 'Caution: Reset all color settings above to default. Refresh the page after saving to view the effects', 'trade-hub' ),
        'section'               => 'colors',
        'type'                  => 'checkbox',
        'priority'              => 220,
        'active_callback'       => ''
    )
);
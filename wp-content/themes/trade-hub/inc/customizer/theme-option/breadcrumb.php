<?php
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

/*defaults values*/
$trade_hub_customizer_defaults['trade-hub-enable-breadcrumb'] = 1;

$trade_hub_sections['trade-hub-breadcrumb-options'] =
    array(
        'priority'       => 50,
        'title'          => esc_html__( 'Breadcrumb Options', 'trade-hub' ),
        'panel'          => 'trade-hub-theme-options',
    );

$trade_hub_settings_controls['trade-hub-enable-breadcrumb'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-enable-breadcrumb'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Enable Breadcrumb', 'trade-hub' ),
            'section'               => 'trade-hub-breadcrumb-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );
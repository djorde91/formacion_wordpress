<?php
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

/*defaults values*/
$trade_hub_customizer_defaults['trade-hub-enable-back-to-top'] = 1;

$trade_hub_sections['trade-hub-back-to-top-options'] =
    array(
        'priority'       => 80,
        'title'          => esc_html__( 'Back To Top Options', 'trade-hub' ),
        'panel'          => 'trade-hub-theme-options'
    );

$trade_hub_settings_controls['trade-hub-enable-back-to-top'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-enable-back-to-top'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Enable Back To Top', 'trade-hub' ),
            'section'               => 'trade-hub-back-to-top-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );
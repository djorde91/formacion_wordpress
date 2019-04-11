<?php
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

/*defaults values*/
$trade_hub_customizer_defaults['trade-hub-enable-static-page']          = 0;
$trade_hub_customizer_defaults['trade-hub-search-button-enable-option'] = 1;
$trade_hub_customizer_defaults['trade-hub-alternate-layout']            = 1;
$trade_hub_customizer_defaults['trade-hub-default-layout']              = 'right-sidebar';
$trade_hub_customizer_defaults['trade-hub-single-post-image-align']     = 'full';
$trade_hub_customizer_defaults['trade-number-of-words']                 = 35;
$trade_hub_customizer_defaults['trade-hub-archive-layout']              = 'thumbnail-and-excerpt';
$trade_hub_customizer_defaults['trade-hub-archive-image-align']         = 'full';

$trade_hub_sections['trade-hub-layout-options'] =
    array(
        'priority'       => 20,
        'title'          => esc_html__( 'Layout Options', 'trade-hub' ),
        'panel'          => 'trade-hub-theme-options',
    );

    /*home page static page display*/
$trade_hub_settings_controls['trade-hub-enable-static-page'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-enable-static-page'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Enable Static Front Page', 'trade-hub' ),
            'description'           =>  esc_html__( 'If you disable this the static page will be disappera form the home page and other section from customizer will reamin as it is', 'trade-hub' ),
            'section'               => 'trade-hub-layout-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );

    /*home page static page display*/
$trade_hub_settings_controls['trade-hub-search-button-enable-option'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-search-button-enable-option'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Enable Search Button', 'trade-hub' ),
            'section'               => 'trade-hub-layout-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );

/*search button enable option*/
$trade_hub_settings_controls['trade-hub-alternate-layout'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-alternate-layout'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Alternate Archive Image Alignment', 'trade-hub' ),
            'section'               => 'trade-hub-layout-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );

/*layout-options option responsive lodader start*/

$trade_hub_settings_controls['trade-hub-default-layout'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-default-layout'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Default Layout', 'trade-hub' ),
            'description'           =>  esc_html__( 'Please note that this section can be overridden for individual page/posts', 'trade-hub' ),
            'section'               => 'trade-hub-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'trade-hub' ),
                'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'trade-hub' ),
                'no-sidebar'    => esc_html__( 'No Sidebar', 'trade-hub' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$trade_hub_settings_controls['trade-hub-single-post-image-align'] =
    array(
        'setting' =>     array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-single-post-image-align'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Alignment of Image In Single Post/Page', 'trade-hub' ),
            'section'               => 'trade-hub-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'full'      => esc_html__( 'Full', 'trade-hub' ),
                'right'     => esc_html__( 'Right', 'trade-hub' ),
                'left'      => esc_html__( 'Left', 'trade-hub' ),
                'no-image'  => esc_html__( 'No image', 'trade-hub' )
            ),
            'priority'              => 40,
            'description'           =>  esc_html__( 'Please note that this setting can be override from individual post/page', 'trade-hub' ),
        )
    );

    // $trade_hub_settings_controls['trade-hub-excerpt-length'] =
    //     array(
    //         'setting' =>     array(
    //             'default'              => $trade-hub-excerpt-length['trade-hub-excerpt-length'],
    //         ),
    //         'control' => array(
    //             'label'                 =>  esc_html__( 'Excerpt Length (in words)', 'trade-hub' ),
    //             'section'               => 'trade-hub-layout-options',
    //             'type'                  => 'number',
    //             'priority'              => 40,
    //         )
    //     );

    $trade_hub_settings_controls['trade-number-of-words'] =
    array(
        'setting' =>       array(
            'default'              =>   $trade_hub_customizer_defaults['trade-number-of-words']
        ),
        'control' =>   array(
            'label'                 =>    esc_html__( 'Number of Words For Excerpt', 'trade-hub' ),
            'description'           =>    esc_html__( 'This will control the excerpt length on listing page', 'trade-hub' ),
            'section'               =>   'trade-hub-layout-options',
            'type'                  =>   'number',
            'input_attrs'           =>   array( 'min' => 1, 'max' => 200 ),
            'priority'              =>   40,
            'active_callback'       =>   ''
        )
    );


        $trade_hub_settings_controls['trade-hub-archive-layout'] =
            array(
                'setting' =>     array(
                    'default'              => $trade_hub_customizer_defaults['trade-hub-archive-layout'],
                ),
                'control' => array(
                    'label'                 =>  esc_html__( 'Archive Layout', 'trade-hub' ),
                    'section'               => 'trade-hub-layout-options',
                    'type'                  => 'select',
                    'choices'               => array(
                        'excerpt-only' => esc_html__( 'Excerpt Only', 'trade-hub' ),
                        'thumbnail-and-excerpt' => esc_html__( 'Thumbnail and Excerpt', 'trade-hub' ),
                        'full-post' => esc_html__( 'Full Post', 'trade-hub' ),
                        'thumbnail-and-full-post' => esc_html__( 'Thumbnail and Full Post', 'trade-hub' ),
                    ),
                    'priority'              => 55,
                )
            );
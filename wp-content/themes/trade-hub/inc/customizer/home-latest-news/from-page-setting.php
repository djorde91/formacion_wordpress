<?php 
global $trade_hub_panels;
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

// defaults value
$trade_hub_customizer_defaults['trade-hub-latest-news-enable-option']   = 1;
$trade_hub_customizer_defaults['trade-hub-latest-news-title-text']      = esc_html__('Latest News','trade-hub');
$trade_hub_customizer_defaults['trade-hub-latest-news-category']        = 1;
$trade_hub_customizer_defaults['trade-hub-latest-news-single-word']     = 30;
$trade_hub_customizer_defaults['trade-hub-latest-news-section-number']  = 3;
$trade_hub_customizer_defaults['trade-hub-latest-news-button-text']     = esc_html__('Read more','trade-hub');
$trade_hub_customizer_defaults['trade-hub-latest-news-selection']       = 'from-category';

// create a section for latest news
$trade_hub_sections['trade-hub-latest-news-section'] = 
array(
	'title'				=> esc_html__( 'Latest News', 'trade-hub' ),
	'panel'				=> 'trade-hub-main-homepage-panel',
	'priority'			=> 250
);

// create a setting control for enable option
$trade_hub_settings_controls['trade-hub-latest-news-enable-option'] = 
array(
	'setting'				=> array(
		'default'			=> $trade_hub_customizer_defaults['trade-hub-latest-news-enable-option']
	),
	'control'				=> array(
		'label'				=> esc_html__( 'Enable Latest News', 'trade-hub' ),
		'section'			=> 'trade-hub-latest-news-section',
		'type'				=> 'checkbox',
		'priority'			=> 10,
		'active_callback'	=> ''
	)
);

// create a setting control for title text
$trade_hub_settings_controls['trade-hub-latest-news-title-text'] = 
array(
	'setting'				=> array(
		'default'			=> $trade_hub_customizer_defaults['trade-hub-latest-news-title-text']
	),
	'control'				=> array(
		'label'				=> esc_html__( 'Title Text', 'trade-hub' ),
		'section'			=> 'trade-hub-latest-news-section',
		'type'				=> 'text',
		'priority'			=> 20,
		'active_callback'	=> ''
	)
);

// create a setting control for single word
$trade_hub_settings_controls['trade-hub-latest-news-single-word'] = 
array(
	'setting'				=> array(
		'default'			=> $trade_hub_customizer_defaults['trade-hub-latest-news-single-word']
	),
	'control'				=> array(
		'label'				=> esc_html__( 'Number of Words', 'trade-hub' ),
		'section'			=> 'trade-hub-latest-news-section',
		'type'				=> 'number',
		'input_attr'		=> array('min' => 1, 'max' =>200),
		'priority'			=> 30,
		'active_callback'	=> ''
	)
);

/*creating setting control for trade-hub-fs-Category start*/
$trade_hub_settings_controls['trade-hub-latest-news-category'] =
    array(
        'setting' =>       array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-latest-news-category']
        ),
        'control' =>   array(
            'label'                 => esc_html__( 'Select Category', 'trade-hub' ),
            'description'           => esc_html__( 'News will only displayed from this category', 'trade-hub' ),
            'section'               => 'trade-hub-latest-news-section',
            'type'                  => 'category_dropdown',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );

$trade_hub_settings_controls['trade-hub-latest-news-button-text'] =
    array(
        'setting' =>       array(
            'default'              => $trade_hub_customizer_defaults['trade-hub-latest-news-button-text']
        ),
        'control' =>   array(
            'label'                 => esc_html__( 'Button Text', 'trade-hub' ),
            'section'               => 'trade-hub-latest-news-section',
            'type'                  => 'text',
            'priority'              => 60,
            'active_callback'       => ''
        )
    );


<?php

global $trade_hub_panels;
global $trade_hub_sections;
global $trade_hub_settings_controls;
global $trade_hub_repeated_settings_controls;
global $trade_hub_customizer_defaults;

// create a default value
$trade_hub_customizer_defaults['trade-hub-top-nav-enable'] 				= 0;
$trade_hub_customizer_defaults['trade-hub-top-header-bar-enable']		= 1;
$trade_hub_customizer_defaults['trade-hub-enable-top-social-menu']		= 1;
$trade_hub_customizer_defaults['tarde-hub-top-header-menu-aligment'] 	= 'social-nav-right';
$trade_hub_customizer_defaults['trade-hub-top-nav-email'] 				= esc_html__('evisionthemes@gmail.com','trade-hub');
$trade_hub_customizer_defaults['trade-hub-top-nav-contact'] 			= esc_html__('+977-1234567890','trade-hub');
$trade_hub_customizer_defaults['trade-hub-top-nav-location'] 			= esc_html__('manbhawan lalitpur','trade-hub');

// create a section for top-nav
$trade_hub_sections['trade-hub-top-nav-section'] =  array(
	'title'			=> esc_html__('Top Nav Section','trade-hub'),
	'panel'			=> 'trade-hub-main-homepage-panel',
	'priority'		=> 5
);
//create a enable option for top nav 
$trade_hub_settings_controls['trade-hub-top-header-bar-enable'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-top-header-bar-enable']
	),
	'control' => array(
	'label'				=> esc_html__(' Enable Top Header Bar','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'checkbox',
	'priority'			=> 10,
	'active_callback'	=> ''
	)
);


//create a enable option for top nav 
$trade_hub_settings_controls['trade-hub-top-nav-enable'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-top-nav-enable']
	),
	'control' => array(
	'label'				=> esc_html__('Enable Slider Top Nav  Banner','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'checkbox',
	'priority'			=> 15,
	'active_callback'	=> ''
	)
);

//create a enable option for top social-menu 
$trade_hub_settings_controls['trade-hub-enable-top-social-menu'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-enable-top-social-menu']
	),
	'control' => array(
	'label'				=> esc_html__('Enable Top Nav Social Menu','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'checkbox',
	'priority'			=> 17,
	'active_callback'	=> ''
	)
);


//create a enable option for top nav 
$trade_hub_settings_controls['tarde-hub-top-header-menu-aligment'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['tarde-hub-top-header-menu-aligment']
	),
	'control' => array(
	'label'				=> esc_html__('Arrange Layout','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'select',
	'choices' => array(
		'social-nav-left' => esc_html__('Social Nav - Contact ','trade-hub'),
		'social-nav-right' => esc_html__('Contact - Social Nav','trade-hub'),


	),		
	'priority'			=> 18,
	'active_callback'	=> ''
	)
);


$trade_hub_settings_controls['trade-hub-top-nav-email'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-top-nav-email']
	),
	'control' => array(
	'label'				=> esc_html__('Text Email','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'text',
	'priority'			=> 20,
	'active_callback'	=> ''
	)
);


$trade_hub_settings_controls['trade-hub-top-nav-contact'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-top-nav-contact']
	),
	'control' => array(
	'label'				=> esc_html__('Text Contact','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'text',
	'priority'			=> 30,
	'active_callback'	=> ''
	)
);


$trade_hub_settings_controls['trade-hub-top-nav-location'] = array(
	'setting' => array(
		'default' => $trade_hub_customizer_defaults['trade-hub-top-nav-location']
	),
	'control' => array(
	'label'				=> esc_html__('Text location','trade-hub'),
	'section'			=> 'trade-hub-top-nav-section',
	'type'				=> 'text',
	'priority'			=> 40,
	'active_callback'	=> ''
	)
);




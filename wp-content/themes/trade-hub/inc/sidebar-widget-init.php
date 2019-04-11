<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function trade_hub_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'trade-hub' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    $trade_hub_get_all_options = trade_hub_get_all_options( absint( 1 ) );
    $trade_hub_footer_widgets_number = $trade_hub_get_all_options['trade-hub-footer-sidebar-number'];

    if( $trade_hub_footer_widgets_number > absint( 0 ) ){
        register_sidebar(array(
            'name' => esc_html__( 'Footer Column One', 'trade-hub' ),
            'id' => 'footer-col-one',
            'description' => esc_html__( 'Displays items on footer section.', 'trade-hub' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        if( $trade_hub_footer_widgets_number > absint( 1 ) ){
            register_sidebar(array(
                'name' => esc_html__( 'Footer Column Two', 'trade-hub' ),
                'id' => 'footer-col-two',
                'description' => esc_html__( 'Displays items on footer section.','trade-hub' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
        if( $trade_hub_footer_widgets_number > absint( 2 ) ){
            register_sidebar(array(
                'name' => esc_html__( 'Footer Column Three', 'trade-hub' ),
                'id' => 'footer-col-three',
                'description' => esc_html__( 'Displays items on footer section.', 'trade-hub' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
        if( $trade_hub_footer_widgets_number > absint( 3 ) ){
            register_sidebar(array(
                'name' => esc_html__( 'Footer Column Four', 'trade-hub' ),
                'id' => 'footer-col-four',
                'description' => esc_html__( 'Displays items on footer section.','trade-hub' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
    }
}
add_action( 'widgets_init', 'trade_hub_widgets_init' );
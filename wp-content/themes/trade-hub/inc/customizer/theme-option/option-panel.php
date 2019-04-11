<?php
global $trade_hub_panels;
/*creating panel for theme settings*/
$trade_hub_panels['trade-hub-theme-options'] =
    array(
        'title'          => esc_html__( 'Theme Options', 'trade-hub' ),
        'priority'       => 235
    );

/*footer options */
require get_template_directory().'/inc/customizer/theme-option/footer.php';

/*layout options */
require get_template_directory().'/inc/customizer/theme-option/layout-options.php';

/*breadcrumb options */
require get_template_directory().'/inc/customizer/theme-option/breadcrumb.php';

/*back to top options */
require get_template_directory().'/inc/customizer/theme-option/back-to-top.php';
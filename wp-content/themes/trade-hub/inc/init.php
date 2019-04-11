<?php
/**
 * evision themes init file
 *
 * @package eVision themes
 * @subpackage trade-hub
 * @since trade-hub 1.0.0
 */
require get_template_directory().'/inc/hooks/inline-style.php';

require get_template_directory().'/inc/hooks/homepage-slider.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';
// $trade_hub_customizer_file_path = trade_hub_file_directory('inc/customizer/customizer.php');
// require $trade_hub_customizer_file_path;

/**
*sidebar widget.
*/
require get_template_directory() . '/inc/sidebar-widget-init.php';

/**
Layout additions
 */
 require get_template_directory() . '/inc/post-meta/layout-meta.php';

/**
 * Include 
 */
require get_template_directory().'/inc/hooks/excerpt.php';


require get_template_directory().'/inc/function/words-count.php';

require get_template_directory().'/inc/function/single-image-align.php';

require get_template_directory() . '/inc/function/header-logo.php';

require get_template_directory() . '/inc/hooks/header.php';

require get_template_directory() . '/inc/hooks/footer.php';

require get_template_directory() . '/inc/hooks/homepage-feature.php';
// $trade_hub_feature_section_path  = trade_hub_file_directory('inc/hooks/homepage-feature.php');
// require $trade_hub_feature_section_path;

require get_template_directory() . '/inc/hooks/homepage-our-service.php';

require get_template_directory() . '/inc/hooks/homepage-call-to-action.php';

require get_template_directory() . '/inc/hooks/homepage-testimonial.php';

require get_template_directory() . '/inc/hooks/homepage-about-us.php';

require get_template_directory() . '/inc/hooks/homepage-latestnews.php';

// require get_template_directory().'/inc/hooks/customizer-link.php';



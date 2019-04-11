<?php

if( ! function_exists( 'trade_hub_inline_style' ) ) :

    /**
     * trade-hub wp_head hook
     *
     * @since  trade-hub 1.0.0
     */
    function trade_hub_inline_style(){
      
        global $trade_hub_customizer_all_values;



        global$trade_hub_google_fonts;
        $trade_hub_customizer_defaults['trade-hub-font-family-site-identity'] = 'Raleway:400,300,500,600,700,900';
        $trade_hub_customizer_defaults['trade-hub-font-family-menu'] = 'Raleway:400,300,500,600,700,900';

        $trade_hub_font_family_site_identity =$trade_hub_google_fonts[$trade_hub_customizer_all_values['trade-hub-font-family-site-identity']];
        $trade_hub_font_family_menu =$trade_hub_google_fonts[$trade_hub_customizer_all_values['trade-hub-font-family-menu']];
        $trade_hub_font_family_h1_h6 =$trade_hub_google_fonts[$trade_hub_customizer_all_values['trade-hub-font-family-h1-h6']];
        $trade_hub_font_family_body =$trade_hub_google_fonts[$trade_hub_customizer_all_values['trade-hub-font-family-body']];


        $trade_hub_background_color                 = get_background_color();
        $trade_hub_primary_color_option             = $trade_hub_customizer_all_values['trade-hub-primary-color'];
        $trade_hub_site_identity_color_option       = $trade_hub_customizer_all_values['trade-hub-site-identity-color']; 
        $trade_hub_section_heading_title_color      = $trade_hub_customizer_all_values['trade-hub-heading-section-title-color'];
        $trade_hub_post_page_title_color            = $trade_hub_customizer_all_values['trade-hub-post-page-title-color'];
        $trade_hub_menu_text_color                  = $trade_hub_customizer_all_values['trade-hub-menu-text-color'];                  

        /*end of about section*/
        ?>
        <style type="text/css">
        /*site identity font family*/
        .site-title,
        .site-title a,
        .site-description,
        .site-description a {
            font-family: '<?php echo esc_attr( $trade_hub_font_family_site_identity ); ?>'!important;
        }
        /*main menu*/
        .main-navigation a{
            font-family: '<?php echo esc_attr( $trade_hub_font_family_menu ); ?>'!important;
        }
        
        h2, h2 a, .h2, .h2 a, 
        h2.widget-title, .h1, .h3, .h4, .h5, .h6, 
        h1, h3, h4, h5, h6 .h1 a, .h3 a, .h4 a,
        .h5 a, .h6 a, h1 a, h3 a, h4 a, h5 a, 
        h6 a {
            font-family: '<?php echo esc_attr( $trade_hub_font_family_h1_h6 ); ?>'!important;
        }
        
        html,body {
            font-family: '<?php echo esc_attr( $trade_hub_font_family_body ); ?>';
        }

        /*=====COLOR OPTION=====*/

        /*Color*/
        /*----------------------------------*/
        /*background color*/ 
        <?php 

        if( !empty($trade_hub_site_identity_color_option) ){
        ?>
            /*Site identity / logo & tagline*/
            body:not(.transparent-header) .site-branding a,
            body:not(.transparent-header) .site-branding p,
            body.home.transparent-header.small-header .site-branding a,
            body.home.transparent-header.small-header .site-branding p {
              color: <?php echo esc_attr( $trade_hub_site_identity_color_option );?>;
            }
        <?php
        }
        
        if( !empty($trade_hub_background_color) ){
        ?>
          
          body{
            background-color: #<?php echo esc_html( $trade_hub_background_color );?>;
          }
        <?php
        } 
            /*Primary*/


        if( !empty($trade_hub_post_page_title_color) ){
        ?>
          
            h2, h2 a, .h2, .h2 a, 
            h2.widget-title, .h1, .h3, .h4, .h5, .h6, 
            h1, h3, h4, h5, h6 .h1 a, .h3 a, .h4 a,
            .h5 a, .h6 a, h1 a, h3 a, h4 a, h5 a, 
            h6 a {
            color: <?php echo esc_attr($trade_hub_post_page_title_color);?>;
          }
        <?php
        } 


        if ( !empty($trade_hub_menu_text_color) )
        {?>
            /* menu text color */
            .main-navigation a, .main-navigation a:visited
            {
                color: <?php echo esc_attr($trade_hub_menu_text_color);?>;
            }
        <?php }


        if( !empty($trade_hub_primary_color_option) ){
        ?>
           {
              background-color: <?php echo esc_attr( $trade_hub_primary_color_option );?>;
            }

            .widget-title,
            .widgettitle,
            .wrapper-slider,
            .flip-container .front,
            .flip-container .back,            
            .ribbon span::before {
              border-color: <?php echo esc_attr( $trade_hub_primary_color_option );?>; 
            }

            section#banner-section {
              border-bottom-color: <?php echo esc_attr( $trade_hub_primary_color_option );?> !important; 
            }

            .main-navigation .current_page_item > a:after,
            .main-navigation .current-menu-item > a:after,
            .main-navigation .current_page_ancestor > a:after,
            .main-navigation li.active > a:after,
            .main-navigation li.active > a:after,
            .main-navigation li.active > a:after,
            a.border-btn,
            .main-navigation li.current_page_parent a:after,
            a#gotop,
            .overlay-callback,
            section#trade-hub-callback,
            .ribbon span,
            .button, button, html input[type="button"], input[type="button"], input[type="reset"], input[type="submit"], .button:visited, button:visited, html input[type="button"]:visited, input[type="button"]:visited, input[type="reset"]:visited, input[type="submit"]:visited,
            h2.widget-title:after,
            .nav-holder #sec-menu-toggle,
            section.testimonials-section .slick-dots li.slick-active,
            .slick-dots li.slick-active {
                background-color: <?php echo esc_attr( $trade_hub_primary_color_option );?>;
              }
         

            .latestpost-footer .moredetail a,
            .latestpost-footer .moredetail a:visited,
            h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
            .posted-on a:hover, .date a:hover, .cat-links a:hover, .tags-links a:hover, .author a:hover, .comments-link a:hover,
            .edit-link a:hover,
            .edit-link a:focus,            
            .widget li a:hover, .widget li a:focus, .widget li a:active, .widget li a:visited:hover, .widget li a:visited:focus, .widget li a:visited:active,
            .main-navigation a:hover, .main-navigation a:focus, .main-navigation a:active, .main-navigation a:visited:hover, .main-navigation a:visited:focus, .main-navigation a:visited:active,
            .site-branding h1 a:hover,
            .site-branding p a:hover,
            .trade-hub-top-menu ul li a:hover,
            .top-header .noticebar .ticker .slide-item a:hover,
            h2.user-title a span,
            .page-inner-title .entry-header a:hover, .page-inner-title .entry-header a:focus, .page-inner-title .entry-header a:active, .page-inner-title .entry-header a:visited:hover, .page-inner-title .entry-header a:visited:focus, .page-inner-title .entry-header a:visited:active, .page-inner-title .entry-header time:hover, .page-inner-title .entry-header time:focus, .page-inner-title .entry-header time:active, .page-inner-title .entry-header time:visited:hover, .page-inner-title .entry-header time:visited:focus, .page-inner-title .entry-header time:visited:active,
            .wrap-breadcrumb a:hover, .wrap-breadcrumb a:focus, .wrap-breadcrumb a:active,
            body.blog .content-start article:hover h2 a,
            .popular:hover i,
            .comment:hover i,
            .recent:hover i,
            a.blog-meta:hover,
            a.blog-meta:focus,
            a.know-more:hover,
            a.know-more:focus,
            a.border-btn:hover,
            a.border-btn:focus,
            a.border-btn:active,
            .feature-content:hover i,
            .site-footer .site-info a:hover, .site-footer .site-info a:focus, .site-footer .site-info a:active, .site-footer .site-info a:visited:hover, .site-footer .site-info a:visited:focus, .site-footer .site-info a:visited:active,
            .main-navigation.sec-main-navigation ul ul li:hover > a, .main-navigation.sec-main-navigation ul ul li:focus > a, .main-navigation.sec-main-navigation ul ul li:active > a  {
              color: <?php echo esc_attr( $trade_hub_primary_color_option );?>;
            }
        <?php
        }
         

        if ( !empty($trade_hub_section_heading_title_color) )
        {?>
            /* section heading color */
             section.section-wrapper h2, section.section-wrapper h2 a
            {
                color: <?php echo esc_attr($trade_hub_section_heading_title_color);?>;
            }
        <?php }

        /* search */
        if(isset($trade_hub_customizer_all_values['trade-hub-search-button-enable-option']) )
        {
        ?>
            .main-navigation {
                margin-right: 10px;
            }

        <?php 
        }//endif 
          
        ?>
        </style>
    <?php
    }
endif;

add_action( 'wp_head', 'trade_hub_inline_style' );
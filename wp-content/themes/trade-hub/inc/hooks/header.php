<?php
if ( ! function_exists( 'trade_hub_set_global' ) ) :
/**
 * Setting global values for all saved customizer values
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_set_global() {
    /*Getting saved values start*/
    $GLOBALS['trade_hub_customizer_all_values'] = trade_hub_get_all_options(1);
}
endif;
add_action( 'trade_hub_action_before_head', 'trade_hub_set_global', 0 );

if ( ! function_exists( 'trade_hub_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_doctype() {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'trade_hub_action_before_head', 'trade_hub_doctype', 10 );

if ( ! function_exists( 'trade_hub_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_before_wp_head() {
    ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'/>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
}
endif;
add_action( 'trade_hub_action_before_wp_head', 'trade_hub_before_wp_head', 10 );

if( ! function_exists( 'trade_hub_default_layout' ) ) :
    /**
     * trade-hub default layout function
     *
     * @since  trade-hub 1.0.0
     *
     * @param int
     * @return string
     */
    function trade_hub_default_layout( $post_id = null ){

        global $trade_hub_customizer_all_values,$post;
        $trade_hub_default_layout = $trade_hub_customizer_all_values['trade-hub-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $trade_hub_default_layout_meta = get_post_meta( $post_id, 'trade-hub-default-layout', true );

        if( false != $trade_hub_default_layout_meta ) {
            $trade_hub_default_layout = $trade_hub_default_layout_meta;
        }
        return $trade_hub_default_layout;
    }
endif;

if ( ! function_exists( 'trade_hub_body_class' ) ) :
/**
 * add body class
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_body_class( $trade_hub_body_classes ) {
  global $trade_hub_customizer_all_values;
  $trade_hub_alternate_layout = '';
    if ($trade_hub_customizer_all_values['trade-hub-alternate-layout'] == 1) {
      $trade_hub_alternate_layout = " alternate";
    } else {
      $trade_hub_alternate_layout = " non-alternate";
    }

    if(!is_front_page() || ( is_front_page())){
        $trade_hub_default_layout = trade_hub_default_layout();
        if( !empty( $trade_hub_default_layout ) ){
            if( 'left-sidebar' == $trade_hub_default_layout ){
                $trade_hub_body_classes[] = 'evision-left-sidebar'. $trade_hub_alternate_layout;
            }
            elseif( 'right-sidebar' == $trade_hub_default_layout ){
                $trade_hub_body_classes[] = 'evision-right-sidebar'. $trade_hub_alternate_layout;
            }
            elseif( 'both-sidebar' == $trade_hub_default_layout ){
                $trade_hub_body_classes[] = 'evision-both-sidebar' . $trade_hub_alternate_layout;
            }
            elseif( 'no-sidebar' == $trade_hub_default_layout ){
                $trade_hub_body_classes[] = 'evision-no-sidebar'. $trade_hub_alternate_layout;
            }
            else{
                $trade_hub_body_classes[] = 'evision-right-sidebar'. $trade_hub_alternate_layout;
            }
        }
        else{
            $trade_hub_body_classes[] = 'evision-right-sidebar'. $trade_hub_alternate_layout;
        }
    }
    return $trade_hub_body_classes;

}
endif;
add_filter( 'body_class', 'trade_hub_body_class', 10, 1);

if ( ! function_exists( 'trade_hub_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_before_page_start() {
    global $trade_hub_customizer_all_values;
    /*intro loader*/
}
endif;
add_action( 'trade_hub_action_before', 'trade_hub_before_page_start', 10 );

if ( ! function_exists( 'trade_hub_page_start' ) ) :
/**
 * page start
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_page_start() {
?>
    <div id="page" class="site clearfix">
<?php
}
endif;
add_action( 'trade_hub_action_before', 'trade_hub_page_start', 15 );

if ( ! function_exists( 'trade_hub_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function trade_hub_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'trade-hub' ); ?></a>
<?php
}
endif;
add_action( 'trade_hub_action_before_header', 'trade_hub_skip_to_content', 10 );
   
   if ( ! function_exists( 'trade_hub_navigation_page_start' ) ) :
   /**
    * Skip to content
    *
    * @since trade-hub 1.0.0
    *
    * @param null
    * @return null
    *
    */
   function trade_hub_navigation_page_start() {
       global $trade_hub_customizer_all_values; 
       ?>
        <div id="preloader">
          <div id="status">&nbsp;</div>
        </div>
        <header id="masthead" class="wrapper wrap-head site-header">

                 <!-- topheader -->
          <?php 
          $top_nav_bar = $trade_hub_customizer_all_values['trade-hub-top-header-bar-enable'];
          $top_bar_aligment  = $trade_hub_customizer_all_values['tarde-hub-top-header-menu-aligment'];

           if(1 == $top_nav_bar ) { ?>
            <div id="topheader" class="<?php echo esc_html($top_bar_aligment)?>">
              <div class="container">
                <?php
                  /* for top -nav header*/
                  $trade_hub_top_nva_email = $trade_hub_customizer_all_values['trade-hub-top-nav-email'];
                  $trade_hub_top_nva_contact = $trade_hub_customizer_all_values['trade-hub-top-nav-contact'];
                  $trade_hub_top_nva_location = $trade_hub_customizer_all_values['trade-hub-top-nav-location'];

                ?>

                <!-- additional nav -->
                <div class="trade-additional-nav">
                  <ul>
                    <?php if(!empty($trade_hub_top_nva_email)  ) { ?>
                      <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_html($trade_hub_top_nva_email);?>"><?php echo esc_html($trade_hub_top_nva_email);?></a></li>
                    <?php } ?>
                     <?php if(!empty($trade_hub_top_nva_contact)  ) { ?>
                    <li><i class="fa fa-phone"></i><?php echo esc_html($trade_hub_top_nva_contact);?></li>
                    <?php } ?>
                     <?php if( !empty($trade_hub_top_nva_location) ) { ?>
                    <li><i class="fa fa-map-signs"></i><?php echo esc_html($trade_hub_top_nva_location);?></li>
                    <?php } ?>
                  </ul>
                </div>
                
                <a href="#!" class="head-list-toggle float-left d-md-none"></a>

                <!-- social-nav -->
                <?php if( $trade_hub_customizer_all_values['trade-hub-enable-top-social-menu'] == 1 ){ ?>
                <div class="social-icon-only social-nav">
                    <div class="menu-social-links-container">
                        <?php
                          wp_nav_menu( array(
                              'theme_location' => 'social',
                              'menu_id'        => 'social-menu',
                              'menu_class'     => 'trade-hub-social-menu',
                              'fallback_cb'    => 'trade_hub_social_menu_callback'
                          ) );
                        ?>        
                    </div>
                </div>
                <?php } ?>

              </div>
            </div>
          <?php } ?>
          <div class="container top-header-wrap">
            <div class="row">
              <div class="col-md-4 wrapper wrapper-site-identity">
                <div class="site-branding">
                 <?php trade_hub_the_custom_logo(); ?>
                  <?php
                     if ( is_front_page() && is_home() ) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php
                     endif;
                     
                     $description = get_bloginfo( 'description', 'display' );
                     if ( $description || is_customize_preview() ) : ?>
                  <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                  <?php
                     endif; ?>               
                </div>
              </div>
              <nav class="col-md-8 wrapper wrap-nav">
                 <div class="container--">
                    <div class="wrap-inner">
                       <div class="sec-menu">
                          <nav id="sec-site-navigation" class="main-navigation sec-main-navigation" role="navigation" aria-label="secondary-menu">
                             <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'primary-menu',
                                    'menu_class'     => 'primary-menu',
                                    'fallback_cb'    => 'trade_hub_primary_menu_callback'
                                ) );
                                ?>
                          </nav>
                          <!-- #site-navigation -->
                          <div class="nav-holder">
                             <button id="sec-menu-toggle" class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>
                             <div id="sec-site-header-menu" class="site-header-menu">
                                <div class="container">
                                   <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                         <button id="mobile-menu-toggle-close" class="menu-toggle" aria-controls="secondary-menu"><i class="fa fa-close"></i></button>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12 trade-hub-main-nav">
                                         <nav id="sec-site-navigation-mobile" class="main-navigation sec-main-navigation" role="navigation" aria-label="secondary-menu">
                                            <?php
                                               wp_nav_menu( array(
                                                   'theme_location' => 'primary',
                                                   'menu_id'        => 'primary-menu-mobile',
                                                   'menu_class'     => 'primary-menu',
                                                   'fallback_cb'    => 'trade_hub_primary_menu_mobile_callback'
                                               ) );
                                               ?>
                                         </nav>
                                         <!-- #site-navigation -->
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <!-- site-header-menu -->
                          </div>
                       </div>
                      
                       <div class="nav-buttons col-md-1">                       
                          <div class="button-list">
                            <?php if ( 0 != $trade_hub_customizer_all_values['trade-hub-search-button-enable-option']) 
                            {?>
                             <div class="search-holder">
                                <a class="button-search button-outline">
                                <i class="fa fa-search"></i>
                                </a>                                
                             </div>
                            <?php } ?>
                          </div>                        
                       </div>                                             
                    </div>

                    <div class="search-form-nav" id="top-search">
                       <?php get_search_form();?>
                    </div>
                   
                 </div>
              </nav>
            </div>
          </div>
        </header>
        <?php if ( is_front_page()  ) {
          do_action('trade_hub_homepage_slider'); 
        }else{
      
        } ?>


<div id="content" class="site-content">

<?php
}
endif;
add_action( 'trade_hub_action_nav_page_start', 'trade_hub_navigation_page_start', 10 );


if( ! function_exists( 'trade_hub_main_slider_setion' ) ) :
/**
 * Main slider
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function trade_hub_main_slider_setion(){
        if (  is_front_page() && !is_home() ) {
            do_action('trade_hub_action_main_slider');
        } else {
            /**
             * trade_hub_action_after_title hook
             * @since trade-hub 1.0.0
             *
             * @hooked null
             */
            do_action( 'trade_hub_action_after_title' );
        }
    }
endif;
add_action( 'trade_hub_action_on_header', 'trade_hub_main_slider_setion', 10 );


if( ! function_exists( 'trade_hub_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since trade-hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function trade_hub_add_breadcrumb(){
        global $trade_hub_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $trade_hub_customizer_all_values['trade-hub-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="wrapper wrap-breadcrumb"><div class="container">';
         trade_hub_simple_breadcrumb();
        echo '</div><!-- .container --></div><!-- #breadcrumb -->';
        return;
    }
endif;
add_action( 'trade_hub_action_after_title', 'trade_hub_add_breadcrumb', 10 );



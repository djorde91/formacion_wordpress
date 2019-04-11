<?php
if ( ! function_exists( 'trade_hub_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function trade_hub_before_footer() {
    ?>
        </div><!-- #content -->
    </div>
    </section>
    <?php do_action( 'trade_hub_show_message_if_no_option_selected' );?>
        <!-- *****************************************
             Footer section starts
    ****************************************** -->
    <footer class="wrapper wrap-footer">
    <?php
    }
endif;
add_action( 'trade_hub_action_before_footer', 'trade_hub_before_footer', 10 );

if ( ! function_exists( 'trade_hub_widget_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function trade_hub_widget_before_footer() {
        global $trade_hub_customizer_all_values;
        $trade_hub_footer_widgets_number = $trade_hub_customizer_all_values['trade-hub-footer-sidebar-number'];
        if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
            return false;
        }
        if( 1 == $trade_hub_footer_widgets_number ){
                $col = 'col-md-12';
            }
        elseif( 2 == $trade_hub_footer_widgets_number ){
            $col = 'col-md-6 col-sm-6 col-xs-12';
        }
        elseif( 3 == $trade_hub_footer_widgets_number ){
            $col = 'col-md-4 col-sm-4 col-xs-12';
        }
        else{
            $col = 'col-md-3 col-sm-3 col-xs-12';
        }
        ?>
        <!-- footer widget -->
        <section class="wrapper footer-widget">
            <div class="container">
                <div class="row">
                     <?php if( is_active_sidebar( 'footer-col-one' ) && $trade_hub_footer_widgets_number > 0 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-one' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-two' ) && $trade_hub_footer_widgets_number > 1 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-two' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-three' ) && $trade_hub_footer_widgets_number > 2 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-three' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-four' ) && $trade_hub_footer_widgets_number > 3 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-four' ); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </section>
    <?php
    }
endif;
add_action( 'trade_hub_action_widget_before_footer', 'trade_hub_widget_before_footer', 10 );

if ( ! function_exists( 'trade_hub_footer' ) ) :
    /**
     * Footer content
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function trade_hub_footer() {
        global $trade_hub_customizer_all_values;
        ?> 
        <!-- footer site info -->
        <section id="colophon" class="wrapper site-footer" role="contentinfo">
            <div class="container">
                <div class="row">
                    <div class="xs-12 col-sm-12 col-md-12">
                        <div class="site-info">
                            <?php
                            if(isset($trade_hub_customizer_all_values['trade-hub-copyright-text'])){
                                echo wp_kses_post( $trade_hub_customizer_all_values['trade-hub-copyright-text'] );
                            }
                            ?>
                            <?php
                             if( 1 == $trade_hub_customizer_all_values['trade-hub-enable-theme-name']){
                                ?>
                                <span class="sep"> | </span>
                                <?php /* translators: %s: search term */ ?>
                                <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'trade-hub' ), 'Trade Hub', sprintf('<a href="%s" target = "_blank" rel="designer">%s</a>', esc_url( 'http://evisionthemes.com/' ), esc_html__( 'eVisionThemes', 'trade-hub' ) )  ); ?>
                                <?php
                            }
                            ?>
                        </div><!-- .site-info -->
                    </div>                   
                </div>
            </div>
        </section><!-- #colophon -->     

    </footer><!-- #colophon -->
    <!-- *****************************************
             Footer section ends
    ****************************************** -->
    <?php
    }
endif;
add_action( 'trade_hub_action_footer', 'trade_hub_footer', 10 );

if ( ! function_exists( 'trade_hub_page_end' ) ) :
    /**
     * Page end
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function trade_hub_page_end() {
    global $trade_hub_customizer_all_values;
        ?>
    <?php
    $helo = $trade_hub_customizer_all_values['trade-hub-enable-back-to-top'];
    // var_dump($hello); die('k vo');
     if( 1 == $helo) {
        ?>
            <a id="gotop" class="evision-back-to-top" href="#page"><i class="fa fa-angle-up"></i></a>
        <?php
        } ?>
    </div><!-- #page -->
    <?php }
endif;
add_action( 'trade_hub_action_after', 'trade_hub_page_end', 10 );
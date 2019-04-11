<?php
if ( ! function_exists( 'trade_hub_our_service_array' ) ) :
    /**
     * trade_hub_testimonial
     *
     * @since trade-hub 1.0.0
     *
     * @param $from_slider
     * @return array
     */
    function trade_hub_our_service_array( $from_slider ){
        global $trade_hub_customizer_all_values;
        $trade_hub_our_service_single_words = absint($trade_hub_customizer_all_values['trade-hub-our-service-single-word']);

        $trade_hub_our_service_contents_array = array();
        
        $trade_hub_our_service_page = array('trade-hub-our-service-page-id');
        $trade_hub_our_service_posts = evision_customizer_get_repeated_all_value(3 , $trade_hub_our_service_page);
        $trade_hub_our_service_posts_ids = array();

        if( 'from-category'  == $from_slider ){
            $trade_hub_service_from_post = $trade_hub_customizer_all_values['trade-hub-our-service-post-category'];
            if( 0 != $trade_hub_service_from_post ){
                $trade_hub_our_service_args = array(
                    'post_type'         => 'post',
                    'cat'               => absint($trade_hub_service_from_post),
                    'posts_per_page'    => 3 ,
                    'orderby'           => 'Desc'

                );
            }
        }
        else{
            if( null != $trade_hub_our_service_posts )
            {
                foreach( $trade_hub_our_service_posts as $trade_hub_our_service_post )
                {
                    if( 0 != $trade_hub_our_service_post['trade-hub-our-service-page-id'] )
                    {
                        $trade_hub_our_service_posts_ids[] = $trade_hub_our_service_post['trade-hub-our-service-page-id'];
                    }
                     
                }
                if( !empty( $trade_hub_our_service_posts_ids ))
                {
                    $trade_hub_our_service_args =    array(
                        'post_type' => 'page',
                        'post__in' => array_map( 'absint', $trade_hub_our_service_posts_ids ),

                        'orderby' => 'post__in'
                    );
                }
            }
        }
        // the query
        if( !empty( $trade_hub_our_service_args ))
        {

            $trade_hub_our_service_contents_array = array(); /*again empty array*/
            $trade_hub_our_service_post_query = new WP_Query( $trade_hub_our_service_args );
            if ( $trade_hub_our_service_post_query->have_posts() ) :
                $i = 1;
                while ( $trade_hub_our_service_post_query->have_posts() ) : $trade_hub_our_service_post_query->the_post();
                    $trade_hub_our_service_contents_array[]  = array(
                        'trade-hub-our_service-title'         => get_the_title(),
                        'trade-hub-our_service-content'       => has_excerpt()  ? the_excerpt() : trade_hub_words_count($trade_hub_our_service_single_words,get_the_content()),
                        'trade-hub-our_service-link'           => esc_url(get_the_permalink())

                    );
                    
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $trade_hub_our_service_contents_array;
    }
endif;

if ( ! function_exists( 'trade_hub_our_service' ) ) :
       /**
     * trade_hub_testimonial
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return array
     *
     */
    function trade_hub_our_service()
    {
        global $trade_hub_customizer_all_values;
        if( ! $trade_hub_customizer_all_values['trade-hub-our-service-enable-option'] )
        {
            return null;
        }
        $trade_hub_our_service_select_post = $trade_hub_customizer_all_values['trade-hub-our-service-post-selection'];
        $trade_hub_our_service_arrays = trade_hub_our_service_array( $trade_hub_our_service_select_post );
        if( is_array( $trade_hub_our_service_arrays ))
        {
            $trade_hub_our_service_single_words = absint($trade_hub_customizer_all_values['trade-hub-our-service-single-word']);
            $trade_hub_our_service_main_title  = esc_html($trade_hub_customizer_all_values['trade-hub-our-service-main_title']);
            $trade_hub_our_service_image  = $trade_hub_customizer_all_values['trade-hub-our-service-image'];
            ?> 

            <?php if(!empty($trade_hub_our_service_image) || !empty($trade_hub_our_service_main_title) || count($trade_hub_our_service_arrays) > 0) { ?>
                <section class="portfolio-first section-wrapper container" id="portfolio">
                    <div class="background-image-div portfolio-left"  style="background-image: url(<?php echo esc_url($trade_hub_our_service_image);?>);"><!-- put background image link here -->
                        <div class="bg-overlay">
                        </div>
                    </div><!-- background image div -->
                        <div class="text-div right">
                            <?php if( !empty($trade_hub_our_service_main_title) ) { ?>
                                    <h2><?php echo esc_html($trade_hub_our_service_main_title);?></h2>
                                    <?php } ?>
                            <?php 
                            $i = 1;
                            foreach ( $trade_hub_our_service_arrays as $trade_hub_our_service_array )
                            { 
                                ?>
                                    <?php if(!empty($trade_hub_our_service_array['trade-hub-our_service-title']) || !empty($trade_hub_our_service_array['trade-hub-our_service-content']) ) { ?>
                                        <div class="listing">
                                            <?php if ( !empty($trade_hub_our_service_array['trade-hub-our_service-title']) ) { ?>
                                            <h3><?php echo esc_html($trade_hub_our_service_array['trade-hub-our_service-title']);?></h3>
                                            <?php } ?>
                                            <p><?php echo wp_kses_post( trade_hub_words_count ($trade_hub_our_service_single_words, $trade_hub_our_service_array['trade-hub-our_service-content']) ) ; ?></p>  
                                        </div>
                                    <?php } ?>
                                
                                <?php
                                $i++;
                            }
                            ?>              
                        </div><!-- testimonials -->
                </section><!-- testimonials section end --> 
            <?php } ?> 
            <?php
        }
    }
endif;
add_action( 'trade_hub_homepage', 'trade_hub_our_service', 40 );
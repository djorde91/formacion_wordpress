<?php
if ( ! function_exists( 'trade_hub_home_feature_array' ) ) :
    /**
     * trade_hub_feature_section_creation
     *
     * @since trade-hub 1.0.0
     *
     * @param $fropm_slider
     * @return array
     */
    function trade_hub_home_feature_array($from_slider){
        global $trade_hub_customizer_all_values;
        $trade_hub_home_feature_single_words = absint($trade_hub_customizer_all_values['trade-hub-our-single-word-page']);
        $trade_hub_home_feature_contents_array = array();
        $trade_hub_icons_array = array('trade-hub-home-feature-page-icon');
        $trade_hub_home_feature_page = array('trade-hub-home-feature-pages-ids');

        $trade_hub_icons_arrays = evision_customizer_get_repeated_all_value(3 , $trade_hub_icons_array );
        $trade_hub_home_feature_posts = evision_customizer_get_repeated_all_value(3 , $trade_hub_home_feature_page);
        $trade_hub_home_feature_posts_ids = array();

        if( 'from-category'  == $from_slider ){
            $trade_hub_feture_category = $trade_hub_customizer_all_values['trade-hub-our-feature-category'];
            if( 0 != $trade_hub_feture_category){
                $trade_hub_home_feature_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'cat'            => absint($trade_hub_feture_category),
                    'order'        => 'Desc'
                );
            }
        } 
        else{
            if( null != $trade_hub_home_feature_posts ) {
                foreach( $trade_hub_home_feature_posts as $trade_hub_home_feature_post_id ) {
                    if( $trade_hub_home_feature_post_id['trade-hub-home-feature-pages-ids'] ) {
                        $trade_hub_home_feature_posts_ids[] = $trade_hub_home_feature_post_id['trade-hub-home-feature-pages-ids'];
                    }
                } 
                if(!empty($trade_hub_home_feature_posts_ids)){
                    $trade_hub_home_feature_args =    array(
                    'post_type' => 'page',
                    'post__in' => array_map( 'absint', $trade_hub_home_feature_posts_ids ),
                    'orderby' => 'post__in'
                );
                }          
            }
        }
        
        // the query
            if(!empty($trade_hub_home_feature_args)){
            $trade_hub_home_feature_contents_array = array(); /*again empty array*/
            $trade_hub_home_feature_post_query = new WP_Query( $trade_hub_home_feature_args );
            if ( $trade_hub_home_feature_post_query->have_posts() ) :
                $i = 1;
                while ( $trade_hub_home_feature_post_query->have_posts() ) : $trade_hub_home_feature_post_query->the_post();

                        $trade_hub_home_feature_contents_array[]  = array(
                        'trade-hub-home-feature-title'         => get_the_title(),
                        'trade-hub-home-feature-content'       => has_excerpt()  ? the_excerpt() : trade_hub_words_count($trade_hub_home_feature_single_words,get_the_content()),
                        'trade-hub-home-feature-link'           => esc_url(get_the_permalink()),
                        'trade-hub-home-feature-page-icon'      => isset($trade_hub_icons_arrays[$i]['trade-hub-home-feature-page-icon']) ? $trade_hub_icons_arrays[$i]['trade-hub-home-feature-page-icon'] : 'fa-desktop'

                    );
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
       
        return $trade_hub_home_feature_contents_array;
    }
endif;

if ( ! function_exists( 'trade_hub_home_feature' ) ) :
   /**
     * trade_hub_feature_section_creation
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return array
     */
    function trade_hub_home_feature()
    {
        global $trade_hub_customizer_all_values;
        if( ! $trade_hub_customizer_all_values['trade-hub-our-feature-enable'] ) {
            return null;
        }
        $trade_hub_feature_selection_type = $trade_hub_customizer_all_values['trade-hub-our-feautre-selection'];
        $trade_hub_feature_arrays = trade_hub_home_feature_array($trade_hub_feature_selection_type);
        
        if( is_array( $trade_hub_feature_arrays ))
        {
            $trade_hub_home_feature_title = $trade_hub_customizer_all_values['trade-hub-our-feature-title-text'];
            ?>   

            <?php if(!empty($trade_hub_home_feature_title) || count($trade_hub_feature_arrays) > 0) { ?>
            <section class="feature-section section-wrapper" id="trade-hub-feature">
                <div class="container">
                    <div class="row">
                        <?php if(!empty($trade_hub_home_feature_title ) ) { ?>
                            <h2><?php echo esc_html($trade_hub_home_feature_title); ?></h2> 
                        <?php } ?>  
                                  
                            <div class="feature-icon-content-wrapper justify-content-sm-center col-md-12">
                                <?php
                                    $i = 0;

                                    foreach ($trade_hub_feature_arrays as $trade_hub_feature_array)
                                    {   ?> 
                                        <?php if(!empty($trade_hub_feature_array['trade-hub-home-feature-page-icon']) || !empty($trade_hub_feature_array['trade-hub-home-feature-title']) || !empty($trade_hub_feature_array['trade-hub-home-feature-content']) ) { ?>

                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="feature-content">
                                                    <i class="fa <?php echo esc_attr($trade_hub_feature_array['trade-hub-home-feature-page-icon']);?>"></i>
                                                    <div class="content-right">
                                                        <?php if(!empty($trade_hub_feature_array['trade-hub-home-feature-link']) ) { ?>
                                                        <h3><a href="<?php echo esc_url($trade_hub_feature_array['trade-hub-home-feature-link']);?>"><?php echo esc_html($trade_hub_feature_array['trade-hub-home-feature-title']);
                                                         ?></a></h3>
                                                         <?php } ?>
                                                         <?php if(!empty($trade_hub_feature_array['trade-hub-home-feature-content']) ) { ?>
                                                        <p><?php echo wp_kses_post($trade_hub_feature_array['trade-hub-home-feature-content']);?></p>
                                                        <?php } ?>
                                                    </div><!--content -->
                                                </div><!-- feature content -->
                                            </div><!-- col-md-12 -->
                                        <?php } ?>
                                        <?php
                                        $i++;
                                    }
                                    ?>         
                            </div><!-- md-6 -->
            
                         </div><!-- row -->
                    </div><!-- container -->
            </section><!-- feature section end --> 
            <?php } ?>
            <?php
        }
    }
endif;
add_action( 'trade_hub_homepage', 'trade_hub_home_feature', 20 );
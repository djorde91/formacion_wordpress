<?php
if ( ! function_exists( 'trade_hub_testimonial_array' ) ) :
    /**
     * trade_hub_testimonial
     *
     * @since trade-hub 1.0.0
     *
     * @param $from_slider
     * @return array
     */
    function trade_hub_testimonial_array( $from_slider ){
        global $trade_hub_customizer_all_values;
        $trade_hub_testimonial_single_words = absint($trade_hub_customizer_all_values['trade-hub-testimonial-single-word']);

        $trade_hub_testimonial_contents_array = array();

        $trade_hub_testimonial_page = array('trade-hub-testimonial-pages-ids');
        $trade_hub_testimonial_posts = evision_customizer_get_repeated_all_value(6 , $trade_hub_testimonial_page);
        $trade_hub_testimonial_posts_ids = array();

        if('form-category' == $from_slider){
            $trade_hub_tetsimonial_category = $trade_hub_customizer_all_values['trade-hub-testimonila-from-category'];
            if( 0 != $trade_hub_tetsimonial_category ){
                $trade_hub_testimonial_args = array(
                    'post_type' => 'post',
                    'cat'       => absint($trade_hub_tetsimonial_category),
                    'post_per_page' => 3,
                    'orderby'   => 'Desc'
                );
            }
        }
        else{
            if( null != $trade_hub_testimonial_posts )
            {
                foreach( $trade_hub_testimonial_posts as $trade_hub_testimonial_post )
                {
                    if( 0 != $trade_hub_testimonial_post['trade-hub-testimonial-pages-ids'] )
                    {
                        $trade_hub_testimonial_posts_ids[] = $trade_hub_testimonial_post['trade-hub-testimonial-pages-ids'];
                    }
                     
                }
                if( !empty( $trade_hub_testimonial_posts_ids ))
                {
                    $trade_hub_testimonial_args =    array(
                        'post_type'         => 'page',
                        'post__in'          => array_map( 'absint', $trade_hub_testimonial_posts_ids ),
                        'orderby'           => 'post__in'
                    );
                }
            }
        }
        // the query
        if( !empty( $trade_hub_testimonial_args ))
        {

            $trade_hub_testimonial_contents_array = array(); /*again empty array*/
            $trade_hub_testimonial_post_query = new WP_Query( $trade_hub_testimonial_args );
            if ( $trade_hub_testimonial_post_query->have_posts() ) :
                $i = 1;
                while ( $trade_hub_testimonial_post_query->have_posts() ) : $trade_hub_testimonial_post_query->the_post();
                    $thumb_image = '';
                    if(has_post_thumbnail())
                    {
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        $thumb_image = $thumb['0'];
                    }
                    $trade_hub_testimonial_contents_array[]  = array(
                        'trade-hub-testimonial-title'         => get_the_title(),
                        'trade-hub-testimonial-content'       => has_excerpt()  ? the_excerpt() : trade_hub_words_count($trade_hub_testimonial_single_words,get_the_content()),
                        'trade-hub-testimonial-link'           => esc_url(get_the_permalink()),
                        'trade-hub-testimonial-image'           =>$thumb_image,
                    );
                    
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $trade_hub_testimonial_contents_array;
    }
endif;

if ( ! function_exists( 'trade_hub_home_testimonial' ) ) :
       /**
     * trade_hub_testimonial
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return array
     *
     */
    function trade_hub_home_testimonial()
    {
        global $trade_hub_customizer_all_values;
        if( ! $trade_hub_customizer_all_values['trade-hub-testimonial-enable-option'] )
        {
            return null;
        }
        $trade_hub_testimonial_select_post_type = $trade_hub_customizer_all_values['trade-hub-testimonial-selection-post'];
        $trade_hub_testimonial_arrays = trade_hub_testimonial_array($trade_hub_testimonial_select_post_type );
        if( is_array( $trade_hub_testimonial_arrays ))
        {

            $trade_hub_testimonial_title = $trade_hub_customizer_all_values['trade-hub-testimonial-title-text'];
            ?>          
            <?php if(!empty($trade_hub_testimonial_title) || count($trade_hub_testimonial_arrays) > 0) { ?>
                <section class="testimonials-section  section-wrapper"><!-- testimonials section start here -->
                   <div class="container">
                      <div class="row">
                        <?php if(!empty($trade_hub_testimonial_title) ) { ?>
                            <h2><?php echo esc_html($trade_hub_testimonial_title); ?></h2>
                        <?php } ?>
                        <?php if(count($trade_hub_testimonial_arrays) > 0) { ?>
                            <div class="testimonials">
                                <?php 
                                $i = 1;
                                foreach ( $trade_hub_testimonial_arrays as $trade_hub_testimonial_array )
                                {     ?>
                                    <?php if(!empty($trade_hub_testimonial_array['trade-hub-testimonial-image']) || !empty($trade_hub_testimonial_array['trade-hub-testimonial-content']) || !empty($trade_hub_testimonial_array['trade-hub-testimonial-title']) ) { ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12 testimonials-wrapper">
                                            <div class="testimonials-content">
                                                <div id="th-f1_container">
                                                    <div id="th-f1_card" class="shadow">
                                                        <?php if(!empty($trade_hub_testimonial_array['trade-hub-testimonial-image']) ){ ?>
                                                            <div class="th-front th-face">
                                                                <img src="<?php echo esc_url($trade_hub_testimonial_array['trade-hub-testimonial-image']);?>" />
                                                            </div><!-- testimonials image -->
                                                        <?php } ?>
                                                        <?php if(!empty($trade_hub_testimonial_array['trade-hub-testimonial-content']) ) { ?>
                                                            <div class="th-back th-face center"><!-- put background image inline style here -->
                                                                <p><?php echo wp_kses_post($trade_hub_testimonial_array['trade-hub-testimonial-content'])?></p>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if(!empty($trade_hub_testimonial_array['trade-hub-testimonial-title']) ) { ?>
                                                            <h4><i class="fa fa-angle-right"></i><a href="<?php echo esc_url($trade_hub_testimonial_array['trade-hub-testimonial-link']);?>"><?php echo esc_html($trade_hub_testimonial_array['trade-hub-testimonial-title']);?></a></h4><!-- custom link for testimonials -->
                                                        <?php } ?>
                                                    </div>
                                                </div><!-- flip 1 container -->
                                                
                                            </div><!-- testimonials content -->
                                        </div><!-- wrapper -->
                                    <?php } ?>
                                    <?php
                                    $i++;
                                }
                                ?>              
                            </div><!-- testimonials -->
                        <?php } ?>
                      </div><!-- row -->
                   </div><!-- container -->
                </section><!-- testimonials section end -->
            <?php
            }
        }
    }
endif;
add_action( 'trade_hub_homepage', 'trade_hub_home_testimonial', 50 );
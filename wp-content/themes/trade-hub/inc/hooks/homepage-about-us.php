<?php
if ( ! function_exists( 'tarde_hub_about_us' ) ) :
    /**
    * about-event 
    *
    * @since trade-hub1.0.0
    *
    * @param null
    * @return null
    *
    */
function  tarde_hub_about_us()
{
	global$trade_hub_customizer_all_values;
	$trade_hub_feature_slider_single_words_about = absint($trade_hub_customizer_all_values['trade-hub-single-word'] );
	$trade_hub_home_about_button_text = esc_html($trade_hub_customizer_all_values['trade-hub-button-text']);
	$trade_hub_home_about_posts = absint($trade_hub_customizer_all_values['trade-hub-about-us-page']);


  	if( !$trade_hub_customizer_all_values['trade-hub-about-us-enable'] ) {
        return null;
    }
    ?>
    <?php
    if( !empty($trade_hub_home_about_posts ))
    {
       $trade_hub_feature_about_args =    array(
            'post_type' => 'page',
            'p' =>$trade_hub_home_about_posts,
            'posts_per_page' => 1

        );
       $trade_hub_fature_about_section_post_query = new WP_Query($trade_hub_feature_about_args );
        if ($trade_hub_fature_about_section_post_query->have_posts() ) :
          while ($trade_hub_fature_about_section_post_query->have_posts() ) :$trade_hub_fature_about_section_post_query->the_post();
            if(has_post_thumbnail())
            {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            }
            else
            {
                $thumb[0] = get_template_directory_uri() .'/assets/imgage/1.jpg';
            }
            ?>

            <section class="about-section section-wrapper container" style="background-image: url('<?php echo esc_url($thumb[0]); ?>');"><!-- background image style here -->
			        <div class="row">
			        	<div class="col-md-6 col-xs-12 col-sm-6">
    			            <div class="feature-text-content-wrapper col-md-12">
    			                <div class="content-left clearfix">   
    			                    
    			                        <div class="left-text-content feature-section">

        			                       <h2><?php the_title();?></h2>

        			                       <p><?php echo wp_kses_post(trade_hub_words_count( $trade_hub_feature_slider_single_words_about ,get_the_content()));?></p>
        			                       <a href="<?php the_permalink();?>" class="know-more"><?php echo esc_html($trade_hub_home_about_button_text);?>
        			                    	
        			                       </a>
    			                        </div>
    			                    </div><!-- col-md-6 -->                  
			                </div>
			            </div>
			           
			        </div>
		    </section><!-- about section -->

              

            <?php
            endwhile;
        endif;
    } 
}
endif;

add_action( 'trade_hub_homepage', 'tarde_hub_about_us', 30 );

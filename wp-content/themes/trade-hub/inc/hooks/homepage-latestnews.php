<?php



if ( ! function_exists( 'trade_hub_latest_news' ) ) :
    /**
     * Featured Slider
     *
     * @since trade-hub 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function trade_hub_latest_news() 
    {
        global $trade_hub_customizer_all_values;

        if( ! $trade_hub_customizer_all_values['trade-hub-latest-news-enable-option'] )
        {
            return null;
        }

        $trade_hub_latest_news_single_words = absint( $trade_hub_customizer_all_values['trade-hub-latest-news-single-word'] );
        $trade_hub_latest_news_button_text = $trade_hub_customizer_all_values['trade-hub-latest-news-button-text'];
        $trade_hub_latest_news_selection_options = $trade_hub_customizer_all_values['trade-hub-latest-news-selection'];

        $trade_hub_latest_news_category = $trade_hub_customizer_all_values['trade-hub-latest-news-category'];
        if( $trade_hub_latest_news_category ) {
            $trade_hub_latest_news_args = array(
                'post_type' => 'post',
                'cat' => $trade_hub_latest_news_category,
                'posts_per_page' => 3,                    
                'ignore_sticky_posts' => true
            );
            $trade_hub_fature_section_post_query = new WP_Query( $trade_hub_latest_news_args );
            if( $trade_hub_fature_section_post_query->have_posts() ) :
                ?>
                <section class="section-wrapper" id="th-news">
                    <div class="container">
                      <h2><?php echo esc_html( $trade_hub_customizer_all_values['trade-hub-latest-news-title-text'] ); ?></h2>

                      <div class="row justify-content-sm-center clearfix">
                        <?php if ( !empty($trade_hub_customizer_all_values['trade-hub-latest-news-title-text']) ) { ?>
                        <?php } ?>
                            <?php while($trade_hub_fature_section_post_query->have_posts() ) : $trade_hub_fature_section_post_query->the_post();?>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                <div class="th-news-wrapper">
                                    <div class="ribbon">
                                        <a href="<?php echo esc_url( get_category_link( $trade_hub_latest_news_category ) );?>">
                                               <span><?php printf( // WPCS: XSS OK
                                                '%s', get_cat_name( $trade_hub_latest_news_category ) );?></span>
                                        </a>
                                    </div>
                                    
                                    <div class="news-image">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <?php the_post_thumbnail('full');?>
                                    <?php else: ?>    
                                        <img alt="<?php echo esc_url( get_permalink() );?>" class="img-responsive" src = "<?php echo esc_url( get_template_directory_uri().'/assets/images/no-image.png' ); ?>">
                                    <?php endif;?>

                                    </div><!-- img -->
                                    
                                    <div class="news-heading-content feature-section">
                                        <h3><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h3>
                                        <?php if( has_excerpt() ) : ?>
                                        <p><?php echo wp_kses_post( get_the_excerpt() );?></p>
                                        <?php else: ?>
                                         <p>   <?php echo  wp_kses_post( trade_hub_words_count( $trade_hub_latest_news_single_words ,get_the_content() ) ); ?>
                                        <?php endif;?></p> 
                                        <?php 
                                            $archive_year  = get_the_time('Y'); 
                                            $archive_month = get_the_time('m'); 
                                            $archive_day   = get_the_time('d'); 
                                        ?>

                                        <a class="date-meta" href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo esc_html( get_the_date() );?></a>
                                         <a class="author" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')) ); ?>"><?php echo esc_html(get_the_author() );?></a>
                                    </div><!-- content -->

                                </div><!-- th-news-wrapper -->  

                            </div><!-- col-md-4 col-sm-4 col-xs-12 -->
                            <?php endwhile;?>
                      </div><!-- row -->

                      <div class="row">
                        <?php if(!empty($trade_hub_latest_news_button_text)) { ?>
                        <div class="news-more-link col-md-12 clearfix">
                           <a href="<?php echo esc_url( get_category_link( $trade_hub_latest_news_category ) );?>" class="border-btn"><?php echo esc_html( $trade_hub_latest_news_button_text );?></a>
                        </div>
                        <?php } ?>
                      </div>
                    </div><!-- container -->
                </section><!-- section-wrapper -->
                <?php       
            endif;
        }
}
endif;
add_action( 'trade_hub_homepage', 'trade_hub_latest_news', 70 );
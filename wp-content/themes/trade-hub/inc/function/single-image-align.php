<?php 
/*image alignment single post*/
if( ! function_exists( 'trade_hub_single_post_image_align' ) ) :
    /**
     * trade-hub default layout function
     *
     * @since  trade-hub 1.0.0
     *
     * @param int
     * @return string
     */
    function trade_hub_single_post_image_align( $post_id = null ){
        global $trade_hub_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $trade_hub_single_post_image_align = $trade_hub_customizer_all_values['trade-hub-single-post-image-align'];
       
        $trade_hub_single_post_image_align_meta = get_post_meta( $post_id, 'trade-hub-single-post-image-align', true );

        if( false != $trade_hub_single_post_image_align_meta ) {
            $trade_hub_single_post_image_align = $trade_hub_single_post_image_align_meta;
        }
        return $trade_hub_single_post_image_align;
    }
endif;
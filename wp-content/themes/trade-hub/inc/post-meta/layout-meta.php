<?php
/**
 * trade-hub Custom Metabox
 *
 * @package trade-hub
 */
$trade_hub_post_types = array(
    'post',
    'page'
);

add_action( 'add_meta_boxes', 'trade_hub_add_layout_metabox' );

function trade_hub_add_layout_metabox() {
    global $post;
    $frontpage_id = get_option( 'page_on_front' );
    if ( $post->ID == $frontpage_id ) {
        return;
    }

    global $trade_hub_post_types;
    foreach ( $trade_hub_post_types as $post_type ) {
        add_meta_box(
            'trade_hub_layout_options', // $id
            esc_html__( 'Layout options', 'trade-hub' ), // $title
            'trade_hub_layout_options_callback', // $callback
            $post_type, // $page
            'normal', // $context
            'high'// $priority
        );
    }

}
/* trade-hub sidebar layout */
$trade_hub_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/no-sidebar.png'
    )
);
/* trade-hub featured layout */
$trade_hub_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => esc_html__( 'Full', 'trade-hub' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => esc_html__( 'Right ', 'trade-hub' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => esc_html__( 'Left', 'trade-hub' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => esc_html__( 'No Image', 'trade-hub' )
    )
);

function trade_hub_layout_options_callback() {

    global $post , $trade_hub_default_layout_options, $trade_hub_single_post_image_align_options;
    $trade_hub_customizer_saved_values = trade_hub_get_all_options( absint(1) );

    /*trade-hub-single-post-image-align*/
    $trade_hub_single_post_image_align = $trade_hub_customizer_saved_values['trade-hub-single-post-image-align'];

    /*trade-hub default layout*/
    $trade_hub_single_sidebar_layout = $trade_hub_customizer_saved_values['trade-hub-default-layout'];

    wp_nonce_field( basename( __FILE__ ), 'trade_hub_layout_options_nonce' );
    ?>
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'trade-hub' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
                $trade_hub_single_sidebar_layout_meta = get_post_meta( $post->ID, 'trade-hub-default-layout', true );
                if ( false != $trade_hub_single_sidebar_layout_meta ) {
                   $trade_hub_single_sidebar_layout = $trade_hub_single_sidebar_layout_meta;
                }
                foreach ( $trade_hub_default_layout_options as $field ) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="trade-hub-default-layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $trade_hub_single_sidebar_layout ); ?> /> 
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php esc_html_e( 'You can set up the sidebar content', 'trade-hub' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php esc_html_e( 'here', 'trade-hub' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php esc_html_e( 'Featured Image Alignment', 'trade-hub' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
                $trade_hub_single_post_image_align_meta = get_post_meta( $post->ID, 'trade-hub-single-post-image-align', true );
                if( false != $trade_hub_single_post_image_align_meta ){
                    $trade_hub_single_post_image_align = $trade_hub_single_post_image_align_meta;
                }
                foreach ($trade_hub_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="trade-hub-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $trade_hub_single_post_image_align ); ?>/> 
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function trade_hub_save_sidebar_layout( $post_id ) {
    global $post;

    if ( isset( $_POST['trade_hub_layout_options_nonce'] ) ) {
        $_POST[ 'trade_hub_layout_options_nonce' ] = sanitize_text_field( wp_unslash( $_POST[ 'trade_hub_layout_options_nonce' ] ) );
    }

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'trade_hub_layout_options_nonce' ] ) || !wp_verify_nonce( sanitize_key($_POST[ 'trade_hub_layout_options_nonce' ] ), basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if(isset($_POST['trade-hub-default-layout'])){
        $old = get_post_meta( $post_id, 'trade-hub-default-layout', true );
        $new = sanitize_text_field( wp_unslash( $_POST['trade-hub-default-layout'] ) );
        if ( $new && $new != $old ) {
            update_post_meta( $post_id, 'trade-hub-default-layout', $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id,'trade-hub-default-layout', $old );
        }
    }

    /*image align*/
    if(isset($_POST['trade-hub-single-post-image-align'])){
        $old = get_post_meta( $post_id, 'trade-hub-single-post-image-align', true );
        $new = sanitize_text_field( wp_unslash ( $_POST['trade-hub-single-post-image-align'] ) );
        if ( $new && $new != $old ) {
            update_post_meta( $post_id, 'trade-hub-single-post-image-align', $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, 'trade-hub-single-post-image-align', $old );
        }
    }
}
add_action('save_post', 'trade_hub_save_sidebar_layout');

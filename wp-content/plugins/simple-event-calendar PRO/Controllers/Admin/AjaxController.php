<?php

namespace GDCalendar\Controllers\Admin;

use GDCalendar\Models\PostTypes\Calendar;
use GDCalendar\Models\PostTypes\Organizer;
use GDCalendar\Models\PostTypes\Venue;
use GDCalendar\Models\Settings\Theme;
use GDCalendar\Models\Settings\ThemeSettings;

class AjaxController
{
    public static function init(){
        add_action('wp_ajax_select_events', array(__CLASS__, 'calendarSettingsSelectBoxAjax'));

        add_action('wp_ajax_repeat_rate', array(__CLASS__, 'eventGeneralOptionsAjax'));

        add_action('wp_ajax_event_save_venue', array(__CLASS__, 'eventVenueSaveAjax'));

        add_action('wp_ajax_event_save_organizer', array(__CLASS__, 'eventOrganizerSaveAjax'));

        add_action('wp_ajax_contact_us', array(__CLASS__, 'contactUs'));

        add_action('wp_ajax_add_subscriber', array(__CLASS__, 'addSubscriber'));
	
        add_action( 'wp_ajax_gd_calendar_save_api_key', array( __CLASS__, 'saveApiKey' ) );

        add_action( 'wp_ajax_theme_save_settings', array( __CLASS__, 'themeSaveSettings' ) );
    }

    public function calendarSettingsSelectBoxAjax() {
        check_ajax_referer('events_by', 'nonce');

        $post_id = absint($_POST['postId']);
        $type = $_POST['type'];
        $menu_type = $_POST['value'];

        $calendar = new Calendar($post_id);

        switch ($type) {
            case 'post' :
                $posts = get_posts(array('post_type' => $menu_type, 'posts_per_page' => -1));
                /**
                 * @var \WP_Post $post
                 */
                ob_start();
                foreach ($posts as $post) {
                    $check = false;
                    if (in_array($post->ID , $calendar->get_cat())){
                        $check = $post->ID;
                    }
                    ?>
                    <label><input type="checkbox" name="cat[]" class="cat" <?php checked($check, absint($post->ID)) ?> value="<?php echo absint($post->ID); ?>"><?php echo esc_html($post->post_title); ?></label>
                    <?php
                }
                echo ob_get_clean();
                break;
            case 'taxonomy' :
                $terms = get_terms(array('taxonomy' => $menu_type, 'hide_empty' => false,));
                /**
                 * @var \WP_Term $term
                 */
                ob_start();
                foreach ($terms as $term) {
                    $check = false;
                    if (in_array($term->term_id , $calendar->get_cat())){
                        $check = $term->term_id;
                    }
                    ?>
                    <label><input type="checkbox" name="cat[]" class="cat" <?php checked($check, absint($term->term_id)) ?> value="<?php echo absint($term->term_id); ?>"><?php echo esc_html($term->name); ?></label>
                    <?php
                }
                echo ob_get_clean();
                break;
            default :
                wp_die();
        }
        wp_die();
    }

    public static function eventGeneralOptionsAjax(){
        check_ajax_referer('repeat_rate', 'nonce');

        if(!isset($_POST['type'])){
            return;
        }

        $type = $_POST['type'];

        if($type !== 'choose_type') {
            $type = absint($type);
        }
        $response = array(
            "status" => 1,
            "type" => $type
        );
        echo json_encode($response);
        wp_die();
    }

    public function eventVenueSaveAjax(){
        check_ajax_referer('event_save_venue', 'nonce');

        if(isset($_POST['title'])) {
            $title = sanitize_text_field($_POST['title']);
        }

        if(!empty($title)) {
            $post_data = array(
                'post_title'    => $title,
                'post_status'   => 'publish',
                'post_type'     => 'gd_venues'
            );
            $post_id = wp_insert_post( $post_data );
            $venue = new Venue($post_id);

            $venue->set_address($_POST['address'])
                ->set_latitude($_POST['latitude'])
                ->set_longitude($_POST['longitude']);
            $venue->save();

            $response = array(
                "status" => 1,
                "id" => $post_id,
                "title" => $title
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 0));
        }
        wp_die();
    }

    public static function eventOrganizerSaveAjax() {
        check_ajax_referer('event_save_organizer', 'nonce');

        if(isset($_POST['title'])) {
            $title = sanitize_text_field($_POST['title']);
        }

        if(!empty($title)) {
            $post_data = array(
                'post_title'    => $title,
                'post_status'   => 'publish',
                'post_type'     => 'gd_organizers'
            );
            $post_id = wp_insert_post( $post_data );

            $organizer = new Organizer($post_id);

            $organizer->set_organized_by($_POST['organized_by'])
                ->set_organizer_address($_POST['organizer_address'])
                ->set_phone($_POST['phone'])
                ->set_website($_POST['website'])
                ->set_organizer_email($_POST['organizer_email']);
            $organizer->save();

            $response = array(
                "status" => 1,
                "id" => $post_id,
                "title" => $title
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 0));
        }

        wp_die();
    }

    public static function contactUs(){
        check_ajax_referer('contact_us', 'nonce');
        try{
            $_POST = array_map('trim', $_POST);

            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['content'])) {
                throw new \Exception(__('All fields required.', 'gd-calendar'));
            }

            if (!is_email($_POST['email'])) {
                throw new \Exception(__('Please enter a valid email address.', 'gd-calendar'));
            }

            $send_to = 'admin@grandwp.com';
            $subject = __('Message via calendar contact us', 'gd-calendar');
            $headers = __('Reply-To: ' . sanitize_text_field($_POST['email']), 'gd-calendar');
            $message = __('Message: ' . sanitize_text_field($_POST['text']), 'gd-calendar');

            // filters
            add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
            add_filter('wp_mail_from_name', create_function('', 'return sanitize_text_field($_POST["name"]);'));

            wp_mail($send_to, $subject, $message, $headers);

            wp_send_json_success(__('Your email was sent to the website administrator. Thanks!', 'gd-calendar'));
        }
        catch (\Exception $ex) {
            wp_send_json_error($ex->getMessage());
        }

    }

    public function addSubscriber() {
        check_ajax_referer('subscribe_form', 'nonce');

        try {
            $_POST = array_map('trim', $_POST);

            if (empty($_POST['email']) || !is_email($_POST['email'])) {
                throw new \Exception(__('Please enter a valid email address.', 'gd-calendar'));
            }

           wp_remote_post('//grandwp.com/wp-admin/admin-ajax.php',array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'blocking' => true,
                'headers' => array(),
                'body' => array(
                        'email' => sanitize_text_field($_POST['email']),
                        'action' => 'wpmm_add_subscriber',
                ),
            ));

            wp_send_json_success(__('You successfully subscribed. Thanks!', 'gd-calendar'));
        } catch (\Exception $ex) {
            wp_send_json_error($ex->getMessage());
        }
    }

    public static function saveApiKey() {
        check_ajax_referer('gd_calendar_save_api_key', 'api_nonce');

        if ( isset( $_REQUEST['api_nonce'] ) && ! empty( $_REQUEST['api_nonce'] ) && wp_verify_nonce( $_REQUEST['api_nonce'], 'gd_calendar_save_api_key' ) && isset( $_REQUEST['api_key'] ) && ! empty( $_REQUEST['api_key'] ) ) {
            update_option( 'gd_calendar_api_key', $_REQUEST['api_key'] );
            echo json_encode( array( 'success' => 1 ) );
        }
        else {
            echo json_encode( array( 'success' => 0 ) );
        }
        wp_die();
    }

    public static function themeSaveSettings(){
	    check_ajax_referer('theme_settings', 'nonce');

	    $settings_arr = array();
	    parse_str($_REQUEST["formdata"], $settings_arr);
	    $theme_id = absint($settings_arr['gd_calendar_theme_id']);
	    $theme_name = sanitize_text_field($settings_arr['gd_calendar_theme_name']);

	    $theme = new Theme(array('id' => $theme_id));
	    $theme->set_name($theme_name)->save();

	    $settings = new ThemeSettings();
	    foreach ($settings_arr as $k => $items) {
	        foreach ($items as $type => $options){
	            foreach ($options as $key => $value){
		            $settings->set_theme_settings($theme_id, $type, $key, $value);
                }
	        }
	    }

	    echo 'ok';
	    wp_die();
    }

}
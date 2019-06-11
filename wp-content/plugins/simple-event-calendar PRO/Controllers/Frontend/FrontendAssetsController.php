<?php

namespace GDCalendar\Controllers\Frontend;


use GDCalendar\Helpers\View;
use GDCalendar\Models\PostTypes\Calendar;
use GDCalendar\Models\PostTypes\Event;
use GDCalendar\Models\PostTypes\Venue;

class FrontendAssetsController
{
    public function __construct() {
//        add_action( 'gd_calendar_frontend_css', array( __CLASS__, 'frontendStyles' ) );
	    add_action( 'wp_enqueue_scripts', array( __CLASS__ , 'frontendStyles' ));

	    add_action( 'gd_calendar_frontend_datepicker_css', array( __CLASS__, 'datepickerFrontShowStyle' ), 100 );
        add_action( 'gd_calendar_frontend_js', array( __CLASS__, 'frontendScripts' ) );
        add_action( 'gd_calendar_themes', array( __CLASS__, 'selectTheme'));
        add_action( 'gd_calendar_show_script', array( __CLASS__, 'calendar_show_script'));
    }

    public static function frontendStyles(){
        wp_enqueue_style("gdCalendarFrontendCss", \GDCalendar()->pluginUrl() . "/resources/assets/style/frontend.css", false);
        wp_enqueue_style("gdCalendarFrontendMediaCss", \GDCalendar()->pluginUrl() . "/resources/assets/style/frontend_media.css", false);
    }

    /**
     * @param $id
     */
    public static function selectTheme($id){
        $calendar = new Calendar($id);
        $theme = $calendar->get_theme();
        if($theme == 1) {
            wp_enqueue_style("gd_calendar_default_theme", \GDCalendar()->pluginUrl() . "/resources/assets/style/default_theme.css", false);
        }
        else{
	        View::render( '../../resources/assets/style/themes.css.php', array('theme' => $theme) );
        }
    }

    public static function datepickerFrontShowStyle(){
        wp_enqueue_style("gdCalendarTimeFrontCss", \GDCalendar()->pluginUrl() . "/vendor/dateTimePicker/style/time_front.css", false);
    }

    public static function calendar_show_script(){
        wp_enqueue_script("jquery-ui-datepicker");
        wp_enqueue_script("gdCalendarFront", \GDCalendar()->pluginUrl() . "/resources/assets/js/calendar_front.js", array('jquery'), false, true);
        wp_enqueue_script("gdCalendarResizeSensor", \GDCalendar()->pluginUrl() . "/vendor/cssElementQueries/js/ResizeSensor.js", array('jquery'), false, true);
        wp_enqueue_script("gdCalendarElementQueries", \GDCalendar()->pluginUrl() . "/vendor/cssElementQueries/js/ElementQueries.js", array('jquery'), false, true);
        wp_enqueue_script("gdCalendarMomentJs", \GDCalendar()->pluginUrl() . "/vendor/momentJS/js/moment.min.js", array('jquery'), false, true);

	    $event_filter = wp_create_nonce('event_filter');
	    $calendar_load = wp_create_nonce('calendar_load');
        $calendar_front = wp_create_nonce('calendar_front');
	    $more_events = wp_create_nonce('more_events');
	    $change_month = wp_create_nonce('change_month');
	    $search_front = wp_create_nonce('search_front');
        wp_localize_script('gdCalendarFront', 'gdCalendarFrontObj',
            array(
                'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                'loadNonce' => $calendar_load,
                'frontNonce' => $calendar_front,
                'filterNonce' => $event_filter,
                'moreEventsNonce' => $more_events,
                'changeMonthNonce' => $change_month,
                'searchNonce' => $search_front
            )
        );
    }

    public static function frontendScripts()
    {
        $api_key = \GDCalendar()->getApiKey();
        if(!is_null($api_key) && $api_key != ""){
            $key_param = 'key='.$api_key.'&';
        }else{
            $key_param = '';
        }

        global $post;
        if($post->post_type === Event::get_post_type() || $post->post_type === Venue::get_post_type()){
            wp_enqueue_script("gdCalendarGooglemapFront", 'https://maps.googleapis.com/maps/api/js?'. $key_param . '&libraries=places', false, false, true);
            wp_enqueue_script("gdCalendarMapsJs", \GDCalendar()->pluginUrl() . "/resources/assets/js/maps_front.js", array('jquery','gdCalendarGooglemapFront'), false, true);
            ?>
            <script>
                function gm_authFailure() {
                    jQuery(".map_view").remove();
                }
            </script>
            <?php
        }
    }
}
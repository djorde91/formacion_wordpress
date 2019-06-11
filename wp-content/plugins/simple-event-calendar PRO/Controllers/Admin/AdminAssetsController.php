<?php

namespace GDCalendar\Controllers\Admin;

use GDCalendar\Models\PostTypes\Calendar;
use GDCalendar\Models\PostTypes\Event;
use GDCalendar\Models\PostTypes\Organizer;
use GDCalendar\Models\PostTypes\Venue;

class AdminAssetsController
{

    public function __construct()
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
    }

    /**
     * @param $hook string hook of current page
     */
    public function styles( $hook ){
        wp_enqueue_style("gdCalendarAdminCss", \GDCalendar()->pluginUrl() . "/resources/assets/style/admin.css", false);
        wp_enqueue_style("gdCalendarAdminFontAwesome", \GDCalendar()->pluginUrl() . "/resources/assets/fonts/font-awesome.min.css", false);

        $edit_pages = array('post.php','post-new.php');
        if(!in_array($hook, $edit_pages)){
            return;
        }

        global $post;
        if($post->post_type == Event::get_post_type() ){
            wp_register_style("gdCalendarJqueryUiCss", \GDCalendar()->pluginUrl() . "/vendor/dateTimePicker/style/jquery-ui.min.css", false);
            wp_enqueue_style( 'gdCalendarJqueryUiCss' );
            wp_enqueue_style("gdCalendarTimeCss", \GDCalendar()->pluginUrl() . "/vendor/dateTimePicker/style/time.css", false);
        }

        if($post->post_type == Organizer::get_post_type() || $post->post_type == Event::get_post_type()) {
            wp_enqueue_style("gdCalendarPhoneCss", \GDCalendar()->pluginUrl() . "/vendor/intlTelInput/style/intlTelInput.css", false);
        }
    }

    public function scripts( $hook )
    {
	    global $post;

       /* if($hook === \GDCalendar()->Admin->Pages['settings']){
            wp_enqueue_script("gdCalendarContactUsValidate", \GDCalendar()->pluginUrl()."/vendor/validation/jquery.validate.min.js" );
            wp_enqueue_script("gdCalendarContactUs", \GDCalendar()->pluginUrl()."/resources/assets/js/coming_soon.js" );

            $contact_us = wp_create_nonce('contact_us');
            $subscribe_form = wp_create_nonce('subscribe_form');
            wp_localize_script('gdCalendarContactUs', 'gdCalendarContactUsObj',
                array(
                    'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                    'gdNonceContactUs' => $contact_us,
                    'gdNonceSubscribeForm' => $subscribe_form
                )
            );
        }*/


        if($hook === \GDCalendar()->Admin->Pages['themes']){
	        wp_enqueue_script("gdCalendarThemesJs", \GDCalendar()->pluginUrl()."/resources/assets/js/themes.js" );
	        wp_enqueue_script("gdCalendarThemesJsColor", \GDCalendar()->pluginUrl()."/vendor/jsColor/js/jscolor.min.js" );
	        wp_enqueue_style("gdCalendarThemesToastrCss", \GDCalendar()->pluginUrl() . "/vendor/toastr/style/toastr.css");
	        wp_enqueue_script("gdCalendarThemesToastrJs", \GDCalendar()->pluginUrl()."/vendor/toastr/js/toastr.min.js" );
	        $theme_settings_nonce = wp_create_nonce('theme_settings');
	        wp_localize_script('gdCalendarThemesJs', 'gdCalendarThemesJsObj',
		        array(
			        'ajaxUrl' => \GDCalendar()->ajaxUrl(),
			        'gdNonceThemeSettings' => $theme_settings_nonce,
		        )
	        );
        }

	    if($hook === \GDCalendar()->Admin->Pages['themes'] || isset($post->post_type) && ($post->post_type === Organizer::get_post_type() || $post->post_type === Event::get_post_type() || $post->post_type === Venue::get_post_type() || $post->post_type === Calendar::get_post_type())){
		    wp_enqueue_script("gdCalendarEditListJs", \GDCalendar()->pluginUrl()."/resources/assets/js/edit_list.js" );
		    wp_enqueue_script('masonry');
	    }

        $api_key = \GDCalendar()->getApiKey();
        if(!empty($api_key)){
            $KeyParam = 'key='.$api_key.'&';
        }else{
            $KeyParam = '';
        }

        $edit_pages = array('post.php','post-new.php');
        if(!in_array($hook, $edit_pages)){
            return;
        }
        if (in_array( $hook, $edit_pages)){
            wp_enqueue_script("gdCalendarAdminJs", \GDCalendar()->pluginUrl() . "/resources/assets/js/admin.js", array('jquery'));
            wp_enqueue_script("gdCalendarInlinePopup", \GDCalendar()->pluginUrl()."/resources/assets/js/inline_popup.js", array( 'jquery' ), false, true );
            $events_by_nonce = wp_create_nonce('events_by');
            wp_localize_script('gdCalendarAdminJs', 'gdCalendarAjaxObj',
                array(
                    'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                    'gdNonce' => $events_by_nonce,
                )
            );
        }

        if($post->post_type == Event::get_post_type()) {
            wp_enqueue_script("jquery-ui-datepicker");
            wp_enqueue_script( 'timepicker' );
            wp_enqueue_script("gdCalendarDatepicker", \GDCalendar()->pluginUrl() . "/resources/assets/js/datepicker.js", array('jquery'), false, true);
            wp_localize_script('gdCalendarDatepicker', 'orderL10n', array(
                'titleError' => __('Title is required field', 'gd-calendar'),
            ));
            wp_enqueue_script("gdCalendarTimeJs", \GDCalendar()->pluginUrl() . "/vendor/dateTimePicker/js/time.js", array('jquery-ui-datepicker'));
            wp_enqueue_script("gdCalendarEventAjax", \GDCalendar()->pluginUrl() . "/resources/assets/js/event_ajax.js", array('jquery'), false, true);
            wp_enqueue_script("gdCalendarRepeatAjax", \GDCalendar()->pluginUrl() . "/resources/assets/js/repeat_ajax.js", array('jquery'));
            $event_save_venue = wp_create_nonce('event_save_venue');
            $event_save_organizer = wp_create_nonce('event_save_organizer');
            wp_localize_script('gdCalendarEventAjax', 'gdCalendarEventAjaxObj',
                array(
                    'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                    'gdNonceSave' => $event_save_venue,
                    'gdNonceSaveOrg' => $event_save_organizer
                )
            );
            $repeat_nonce = wp_create_nonce('repeat_rate');
            wp_localize_script('gdCalendarRepeatAjax', 'gdCalendarRepeatAjaxObj',
                array(
                    'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                    'repeatNonce' => $repeat_nonce
                )
            );
        }

        if($post->post_type == Organizer::get_post_type() || $post->post_type == Event::get_post_type()) {
            wp_enqueue_script("gdCalendarIntlTelInputJs", \GDCalendar()->pluginUrl() . "/vendor/intlTelInput/js/intlTelInput.js");
            wp_enqueue_script("gdCalendarPhoneJs", \GDCalendar()->pluginUrl() . "/resources/assets/js/phone.js", array('jquery'));
            wp_enqueue_script("gdCalendarPhoneValidationJs", \GDCalendar()->pluginUrl() . "/vendor/intlTelInput/js/utils.js");
        }

        if($post->post_type == Venue::get_post_type() || $post->post_type == Event::get_post_type()){
            wp_enqueue_script( 'gdCalendarAdminApiKey', \GDCalendar()->pluginUrl().'/resources/assets/js/api-key.js', array( 'jquery' ), false, true );
            wp_localize_script( 'gdCalendarAdminApiKey', 'gdCalendarAdminApiKeyObj',
                array(
                    'ajaxUrl' => \GDCalendar()->ajaxUrl(),
                    'apiKeyNonce' => wp_create_nonce('gd_calendar_save_api_key'),
                    'mapApiInfo' => __('GOOGLE API KEY SAVED SUCCESSFULLY!', 'gd-calendar'),
                    'noticeDismiss' => __('Dismiss this notice.', 'gd-calendar')
                ));

            wp_enqueue_script("gdCalendarGooglemap", 'https://maps.googleapis.com/maps/api/js?'. $KeyParam . '&libraries=places', false, false, true);
            wp_enqueue_script("gdCalendarMapsJs", \GDCalendar()->pluginUrl() . "/resources/assets/js/maps.js", array('jquery','gdCalendarGooglemap'), false, true);
        }
    }

}
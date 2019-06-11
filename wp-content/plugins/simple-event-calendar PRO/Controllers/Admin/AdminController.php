<?php
namespace GDCalendar\Controllers\Admin;

use GDCalendar\Core\ErrorHandling\ErrorBag;
use GDCalendar\Helpers\View;
use GDCalendar\Models\PostTypes\Calendar;
use GDCalendar\Models\Settings\Theme;
use GDCalendar\Core\Admin\Listener;
use GDCalendar\Models\Settings\ThemeSettings;

class AdminController{

    use Listener;

    /**
     * @var array
     */
    public $Pages = array();

    public function __construct()
    {
	    if (!session_id()){
		    session_start();
        }

        $this->Pages = array('gd_events', 'gd_calendar', 'gd_organizers', 'gd_venues');
        add_action( 'admin_menu', array( $this, 'adminMenu' ) );
        add_filter('admin_head', array($this, 'topBanner'));
	    add_action('admin_init', array(__CLASS__, 'createTheme'), 1);
	    add_action( 'admin_init', array( __CLASS__, 'deleteTheme' ) , 1);
	    add_action('admin_init', array( $this, 'delayNotices'), 1);
        add_filter('screen_options_show_screen', array($this, 'removeScreenOptions'));
        add_filter('manage_edit-gd_calendar_columns', array(__CLASS__, 'calendarColumns'));
	    add_action('load-post-new.php',  array(__CLASS__, 'menuStyle') );
        add_action('manage_gd_calendar_posts_custom_column', array($this, 'calendarColumnsData'), 10, 2);
        add_action('save_post', array(__CLASS__, 'setDefaultObjectTerms'), 99, 2);
	    add_action( 'admin_notices', array($this, 'errorMessages'), 100, 2);

	    new AdminAssetsController();
        new MetaBoxesController();
        new ShortcodeController();
    }

	public static function menuStyle(){
		echo '<style>#adminmenu .wp-submenu li.wp-first-item a{color: #fff;font-weight: 600;}</style>';
	}

    public function removeScreenOptions(){
        global $current_screen;
        $type = $current_screen->post_type;
        $page = $current_screen->id;

        if(!in_array($type, $this->Pages) && $page !== 'gd_events_page_gd_events_featured_plugins' && $page !== 'gd_events_page_gd_events_themes'){
            return true;
        }
        return false;
    }

    public function errorMessages(){
	    if ( array_key_exists( 'errors', $_SESSION ) && !empty($_SESSION['errors']) ) {
	        ?>
            <div class="error">
                <p><?php
                    $errors = $_SESSION['errors'];
                        foreach ($errors as $error){
                            echo $error . '</br>';
                        }
                    ?>
                </p>
            </div><?php
		    unset( $_SESSION['errors'] );
	    }
    }

    public function topBanner(){
        global $taxnow;
        global $current_screen;

	    $type = $current_screen->post_type;
        $page = $current_screen->id;
        $base = $current_screen->base;

        if ( $type !== '' && in_array($type, $this->Pages) && $page !== 'gd_events_page_gd_events_settings' || $page === 'gd_events_page_gd_events_themes') {
	        if( $taxnow === '' && $base !== 'edit' ){
		        echo '<style>.wrap h1.wp-heading-inline{display:inline-block;}</style>';
	        }
        ?>
            <div class="gd_calendar_top_banner_container">
            <?php
            if (get_option('gd_calendar_review_notice_ignore') || get_option('gd_calendar_review_notice_delayed') &&
                (strtotime('now') - strtotime(get_option('gd_calendar_review_notice_delayed'))) < 604800 ||
                (strtotime('now') - strtotime(get_option('gd_calendar_plugin_installed'))) < 604800) {
            } else {
                View::render( 'admin/ask-for-review.php' );
            }
                View::render( 'admin/top-banner.php', array(
                    'taxonomy' => $taxnow,
                    'current_screen' => $current_screen,
                    'page' => $page
                ));
        ?>
            </div>
            <?php
        }
    }

    /* Ask user for review */
    public function delayNotices(){
        if ( isset( $_GET['gd_calendar_delay_notice'] ) ) {
            update_option('gd_calendar_review_notice_delayed', date('Y-m-d H:i:s'));

            $redirectLink = remove_query_arg( array( 'gd_calendar_delay_notice' ) );
            wp_redirect( $redirectLink );
            exit;
        } else if ( isset( $_GET['gd_calendar_ignore_notice'] ) ) {
            update_option('gd_calendar_review_notice_ignore', 1 );
            $redirectLink = remove_query_arg( array( 'gd_calendar_ignore_notice' ) );
            wp_redirect( $redirectLink );
            exit;
        }
    }

    public function adminMenu()
    {
        remove_submenu_page( 'edit.php?post_type=gd_events', 'post-new.php?post_type=gd_events' );
	    $this->Pages['themes'] = add_submenu_page( 'edit.php?post_type=gd_events', __('Themes', 'gd-calendar'), __('Themes', 'gd-calendar'), 'manage_options', 'gd_events_themes', array(__CLASS__, 'calendarThemes'));
	    //$this->Pages['settings'] = add_submenu_page( 'edit.php?post_type=gd_events', __('Settings', 'gd-calendar'), __('Settings', 'gd-calendar'), 'manage_options', 'gd_events_settings', array(__CLASS__, 'calendarSettings'));
        $this->Pages['featured_plugins'] = add_submenu_page( 'edit.php?post_type=gd_events', __('Featured Plugins', 'gd-calendar'), __('Featured Plugins', 'gd-calendar'), 'manage_options', 'gd_events_featured_plugins', array(__CLASS__, 'calendarFeaturedPlugins'));
    }

    public static function calendarColumns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Title', 'gd-calendar'),
            'featured_image' => __('Featured Image', 'gd-calendar'),
            'shortcode' => __('Shortcode', 'gd-calendar'),
            'theme' => __('Theme', 'gd-calendar'),
            'date' => __('Date', 'gd-calendar'),
        );
        return $columns;
    }

    public static function calendarColumnsData($column, $post_id)
    {
        switch ( $column ) {
            case 'shortcode' :
            	echo '<span class="gd_calendar_textarea_box" >[gd_calendar id="' . $post_id . '"]</span><span class="calendar_use_another_shortcode">or use php shortcode</span>';
            	echo '<span>&lt;?php echo do_shortcode("[gd_calendar id=\'' . $post_id .'\']"); ?&gt;</span>';
                break;
            case 'theme' :
	            $all_themes = Theme::get_all_themes_names();
                $calendar = new Calendar($post_id);
	            if (array_key_exists($calendar->get_theme(), $all_themes)){
		            $theme_name = stripslashes($all_themes[$calendar->get_theme()]);
		            _e( $theme_name, 'gd-calendar' );
	            }
	            else{ _e( 'Default Theme', 'gd-calendar' ); }
                break;
            case 'featured_image' :
                $calendar = new Calendar($post_id);
                echo '<a href="'. $calendar->get_edit_link() . '">' . get_the_post_thumbnail( $post_id, array(50, 50)) . '</a>' ;
                break;
        }
    }

    public static function setDefaultObjectTerms($post_id, $post)
    {
        if ( 'publish' === $post->post_status && get_post_type($post_id) == 'gd_events') {
            $defaults = array( 'event_category' => 'Uncategorized' );
            $taxonomy = 'event_category';
            $terms = wp_get_post_terms( $post_id, $taxonomy );

            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                $affected_ids = wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                if( is_array( $affected_ids ) && !empty( $affected_ids ) ){
                    update_option('default_event_category', $affected_ids[0]);
                }
            }
        }
    }

    public static function calendarThemes(){
	    if ( ! isset( $_GET['task'] ) ) {
		    View::render('admin/calendar-themes.php');
	    } else {
		    $task = $_GET['task'];
		    if( $task === 'edit_theme' ){
                if ( ! isset( $_GET['id'] ) ) {
                    \GDCalendar()->Admin->printError( __( 'Missing "id" parameter.', 'gd-calendar' ) );
                }

                $id = absint( $_GET['id'] );

                if ( ! $id ) {
                    \GDCalendar()->Admin->printError( __( '"id" parameter must be not negative integer.', 'gd-calendar' ) );
                }

                $theme = new Theme( array( 'id' => $id ) );

                View::render( 'admin/edit-theme.php', array( 'theme' => $theme  ) );
            }
	    }
    }

	public static function createTheme()
	{
		if(!self::isRequest('gd_events_themes','create_new_theme','GET')){
			return;
		}

		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'gd_events_themes_create_new_theme'  ) ) {

			\GDCalendar()->Admin->printError( __( 'Security check failed.', 'gd-calendar' ) );

		}

		$theme = new Theme();
		$theme = $theme->set_name('New Theme')->save();

		$setting = new ThemeSettings();
		$defaults = $setting->get_theme_settings_by_id(1);

		foreach ($defaults as $key_type => $default){
			foreach ($default as $key => $val){
				$setting->set_theme_settings($theme, $key_type, $key, $val);
			}
        }

		/**
		 * after the theme is created we need to redirect user to the edit page
		 */
		if ( $theme && is_int( $theme ) ) {

			$location = admin_url('edit.php?post_type=gd_events&page=gd_events_themes&task=edit_theme&id=' . $theme);
			$location = wp_nonce_url($location, 'gd_events_themes_edit_theme_' . $theme);
			$location = html_entity_decode( $location );

			header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			header("Location: $location");

			exit;

		} else {
			wp_die( __( 'Problems occured while creating new theme.', 'gd-calendar' ) );
		}
	}

	public static function deleteTheme(){
		if(!self::isRequest('gd_events_themes','remove_theme','GET')){
			return;
		}

		if ( ! isset( $_GET['id'] ) ) {
			wp_die( __( '"id" parameter is required', 'gd-calendar' ) );
		}

		$id = $_GET['id'];

		if ( absint( $id ) != $id ) {
			wp_die( __( '"id" parameter must be non negative integer', 'gd-calendar' ) );
		}

		if ( absint( $id ) === 1 ) {
		    wp_die( __( 'Cannot delete Default Theme', 'gd-calendar' ) );
        }

		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'gd_events_themes_remove_theme_' . $id ) ) {
			wp_die( __( 'Security check failed', 'gd-calendar' ) );
		}

		Theme::delete( $id );

		$location = admin_url( 'edit.php?post_type=gd_events&page=gd_events_themes' );

		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header("Location: $location");

		exit;
	}

    public static function calendarSettings() {
        View::render('admin/calendar-settings.php');
    }

    public static function calendarFeaturedPlugins(){
        View::render('admin/calendar-featured-plugins.php');
    }

	public function printError( $error_message, $die = true ){

		$str = sprintf( '<div class="error"><p>%s&nbsp;<a href="#" onclick="window.history.back()">%s</a></p></div>', $error_message, __( 'Go back', 'gd-calendar' ) );

		if ( $die ) {
			wp_die( $str );
		} else {
			echo $str;
		}
	}
}
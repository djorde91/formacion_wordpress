<?php

namespace GDCalendar\Models\PostTypes;

use GDCalendar\Core\PostTypeModel;
use GDCalendar\Models\Settings\Theme;

class Calendar extends PostTypeModel
{
    protected static $post_type = 'gd_calendar';

    public static $menu = array('event_tag', 'event_category', 'gd_venues', 'gd_organizers');

    /**
     * @var string
     */
    protected $select_events_by = 'event_category';

    /**
     * @var array
     */
    protected $cat = array();

	/**
	 * @var string
	 */
    protected $view_type_sidebar;

    /**
     * @var array
     */
    protected $view_type = array();

    /**
     * @var int
     */
    protected $theme = 1;

    protected static $meta_keys = array(
        'select_events_by',
        'cat',
        'view_type_sidebar',
        'view_type',
        'theme'
    );

    /**
     * @return string
     */
    public function get_select_events_by(){
        return $this->select_events_by;
    }

    /**
     * @param $select_events_by
     * @return Calendar
     * @throws \Exception
     */
    public function set_select_events_by($select_events_by){
        if (!in_array($select_events_by, self::$menu)) {
            throw new \Exception('Wrong selected value given.');
        }

        $this->select_events_by = $select_events_by;
        return $this;
    }

    public function get_cat(){
        return $this->cat;
    }

    public function set_cat($cat){
        $this->cat = array_map('intval', $cat);
        return $this;
    }

	/**
	 * @param $view_type_sidebar
	 * @return Calendar
	 * @throws \Exception
	 */
    public function set_view_type_sidebar($view_type_sidebar){
	    if (!empty($view_type_sidebar) && $view_type_sidebar != 'gd_calendar_view_type_sidebar') {
		    throw new \Exception('Wrong value given.');
	    }
	    $this->view_type_sidebar = $view_type_sidebar;
	    return $this;
	}

	/**
	 * @return string
	 */
	public function get_view_type_sidebar(){
        return $this->view_type_sidebar;
	}

    /**
     * @param $view_type
     * @return Calendar
     */
    public function set_view_type($view_type){
        $this->view_type = array_map('intval', $view_type);
        return $this;
    }

    /**
     * @return array
     */
    public function get_view_type(){
        return $this->view_type;
    }

    /**
     * @param $theme
     * @return Calendar
     */
    public function set_theme($theme){
        $this->theme = absint($theme);
        return $this->theme;
    }

    /**
     * @return int
     */
    public function get_theme(){
	    $all_themes = Theme::get_all_themes_names();

	    if(!array_key_exists($this->theme, $all_themes)){
		    $this->set_theme(1);
		    $this->save();
	    }

        return $this->theme;
    }

    /**
     * @return bool
     */
    public function save(){
        return $this->save_meta();
    }

}
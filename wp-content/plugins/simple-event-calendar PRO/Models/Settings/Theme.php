<?php

namespace GDCalendar\Models\Settings;

use GDCalendar\Core\Model;

class Theme extends Model
{
    protected static $tableName='gdcalendarthemes';

    /**
     * Theme Name
     * @var string
     */
    private $name;

    protected static $dbFields = array('name');

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function get_name() {
        return (!empty($this->name) ? $this->name : __( '(Empty Theme)', 'gd-calendar' ) );
    }

    /**
     * @param string $name
     * @return Theme
     */
    public function set_name( $name ) {
        $this->name = sanitize_text_field( $name );
        return $this;
    }

	/**
	 * Edit link for current theme
	 */
	public function get_edit_link()
	{
		if (is_null($this->id)) {
			return false;
		}

		$edit_theme = admin_url('edit.php?post_type=gd_events&page=gd_events_themes&task=edit_theme&id=' . $this->id);
		return $edit_theme = wp_nonce_url($edit_theme, 'gd_events_themes_edit_theme_' . $this->id);
	}

	public static function get_all_themes_names(){

		if(empty(self::$tableName)){
			throw new \Exception('"tableName" field cannot be empty');
		}
		global $wpdb;

		$all_themes =array();

		$query = "SELECT * FROM " . self::getTableName() . " GROUP BY id";

		$themes = $wpdb->get_results($query);

		if (empty($themes)) {
			return null;
		}

		foreach ($themes as $theme){
			$all_themes[$theme->id] = $theme->name;
		}

		return $all_themes;

	}
}
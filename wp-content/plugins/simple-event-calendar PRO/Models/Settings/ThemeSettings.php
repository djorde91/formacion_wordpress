<?php

namespace GDCalendar\Models\Settings;

use GDCalendar\Core\Model;

class ThemeSettings extends Model
{
    protected static $tableName='gdcalendarthemessettings';

	/**
	 * Theme of current theme settings
	 * @var Theme
	 */
	private $theme;

	/**
	 * @var array
	 */
    private $theme_settings = array();

    private $info = array(
        'sidebar_header_bg_color' =>
	        array(
	            'description' => 'Header Background Color',
		        'help' => 'Set Header background Color'
	        ),
        'active_button_bg_color' =>
	        array(
		        'description' => 'Active Button Background Color',
		        'help' => 'Set Active Button Background Color'
	        ),
        'view_button_bg_color' =>
	        array(
		        'description' => 'View Button(s) Background Color',
		        'help' => 'Set View Button(s) Background Color'
	        ),
        'view_button_hover_bg_color' =>
	        array(
		        'description' => 'View Button On-Hover Background Color',
		        'help' => 'Set View Button On-Hover Background Color'
	        ),
        'month_current_date_bg_color' =>
	        array(
		        'description' => 'Current Day Background Color',
		        'help' => 'Set Current Day Background Color'
	        ),
        'sidebar_current_date_bg_color' =>
	        array(
		        'description' => 'Current Day Background Color',
		        'help' => 'Set Current Day Background Color'
	        ),
        'week_current_day_bg_color' =>
	        array(
		        'description' => 'Current Day Background Color',
		        'help' => 'Set Current Day Background Color (above the calendar table)'
	        ),
        'year_current_date_bg_color' =>
	        array(
		        'description' => 'Current Day Background Color',
		        'help' => 'Set Current Day Background Color'
	        ),
        'sidebar_bg_color' =>
	        array(
		        'description' => 'Background Color',
		        'help' => 'Set Content Background Color'
	        ),
        'day_today_color' =>
	        array(
		        'description' => 'Current Day Background Color',
		        'help' => 'Set Current Day Background Color (above the calendar table)'
	        ),
        'week_number_color' =>
	        array(
		        'description' => 'Current Week Text Color',
		        'help' => 'Set CW Text Color'
	        ),
        'year_title_color' =>
	        array(
		        'description' => 'Current Year Text Color',
		        'help' => 'Set Current Year Text Color (above calendar table)'
	        ),
        'year_current_month_color' =>
	        array(
		        'description' => 'Table Content Background Color',
		        'help' => 'Set Table Full Content Background Color'
	        ),
        'week_see_all_link_color' =>
	        array(
		        'description' => 'View All Link Color',
		        'help' => 'Set View All Link Color'
	        ),
        'month_see_all_link_color' =>
	        array(
		        'description' => 'View All Link Color',
		        'help' => 'Set View All Link Color'
	        ),
        'sidebar_first_circle_bg_color' =>
	        array(
		        'description' => 'First Bullet Color',
		        'help' => 'Set First Bullet Color'
	        ),
        'month_first_circle_bg_color' =>
	        array(
		        'description' => 'First Bullet Color',
		        'help' => 'Set First Bullet Color'
	        ),
        'year_first_circle_bg_color' =>
	        array(
		        'description' => 'First Bullet Color',
		        'help' => 'Set First Bullet Color'
	        ),
        'sidebar_second_circle_bg_color' =>
	        array(
		        'description' => 'Second Bullet Color',
		        'help' => 'Set Second Bullet Color'
	        ),
        'month_second_circle_bg_color' =>
	        array(
		        'description' => 'Second Bullet Color',
		        'help' => 'Set Second Bullet Color'
	        ),
        'year_second_circle_bg_color' =>
	        array(
		        'description' => 'Second Bullet Color',
		        'help' => 'Set Second Bullet Color'
	        ),
        'sidebar_third_circle_bg_color' =>
	        array(
		        'description' => 'Third Bullet Color',
		        'help' => 'Set Third Bullet Color'
	        ),
        'month_third_circle_bg_color' =>
	        array(
		        'description' => 'Third Bullet Color',
		        'help' => 'Set Third Bullet Color'
	        ),
        'year_third_circle_bg_color' =>
	        array(
		        'description' => 'Third Bullet Color',
		        'help' => 'Set Third Bullet Color'
	        ),
        'day_event_first_bg_color' =>
	        array(
		        'description' => 'First Event Background Color',
		        'help' => 'Set First Event Background Color'
	        ),
        'week_event_first_bg_color' =>
	        array(
		        'description' => 'First Event Background Color',
		        'help' => 'Set First Event Background Color'
	        ),
        'month_event_first_bg_color' =>
	        array(
		        'description' => 'First Event Background Color',
		        'help' => 'Set First Event Background Color'
	        ),
        'day_event_second_bg_color' =>
	        array(
		        'description' => 'Second Event Background Color',
		        'help' => 'Set Second Event Background Color'
	        ),
        'week_event_second_bg_color' =>
	        array(
		        'description' => 'Second Event Background Color',
		        'help' => 'Set Second Event Background Color'
	        ),
        'month_event_second_bg_color' =>
	        array(
		        'description' => 'Second Event Background Color',
		        'help' => 'Second Event Background Color'
	        ),
        'day_event_third_bg_color' =>
	        array(
		        'description' => 'Third Event Background Color',
		        'help' => 'Set Third Event Background Color'
	        ),
        'week_event_third_bg_color' =>
	        array(
		        'description' => 'Third Event Background Color',
		        'help' => 'Set Third Event Background Color'
	        ),
        'month_event_third_bg_color' =>
	        array(
		        'description' => 'Third Event Background Color',
		        'help' => 'Set Third Event Background Color'
	        ),
        'day_event_first_border_left' =>
	        array(
		        'description' => 'First Event Left Border Color',
		        'help' => 'Set First Event Left Border Color'
	        ),
        'day_event_second_border_left' =>
	        array(
		        'description' => 'Second Event Left Border Color',
		        'help' => 'Set Second Event Left Border Color'
	        ),
        'day_event_third_border_left' =>
	        array(
		        'description' => 'Third Event Left Border Color',
		        'help' => 'Set Third Event Left Border Color'
	        ),
	    'week_event_first_border_left' =>
	        array(
		        'description' => 'First Event Left Border Color',
		        'help' => 'Set First Event Left Border Color'
	        ),
	    'week_event_second_border_left' =>
	        array(
		        'description' => 'Second Event Left Border Color',
		        'help' => 'Set Second Event Left Border Color'
	        ),
	    'week_event_third_border_left' =>
	        array(
		        'description' => 'Third Event Left Border Color',
		        'help' => 'Set Third Event Left Border Color'
	        ),
	    'datepicker_button_bg_color' =>
	        array(
		        'description' => 'Datepicker Selected Value Background Color',
		        'help' => 'Set Datepicker Button Background Color for Month, Year views'
	        ),
	    'datepicker_current_day_active_bg_color' =>
	        array(
		        'description' => 'Datepicker Current Day Background Color',
		        'help' => 'Set Datepicker Current Day Background Color for Day, Week views'
	        ),
	    'datepicker_current_day_selected_bg_color' =>
	        array(
		        'description' => 'Datepicker Selected Day Background Color',
		        'help' => 'Set Datepicker Selected Day Background Color for Day, Week views'
	        ),
	    'week_table_background_color' =>
	        array(
		        'description' => 'Table Content Background Color',
		        'help' => 'Set Table Full Content Background Color'
	        ),
	    'day_table_weekend_columns_background_color' =>
	        array(
		        'description' => 'Weekend Column Background Color',
		        'help' => 'Set Weekend Table Column Background Color'
	        ),
	    'week_table_weekend_columns_background_color' =>
	        array(
		        'description' => 'Weekend Column Background Color',
		        'help' => 'Set Weekend Column Background Color'
	        ),
	    'month_table_background_color' =>
	        array(
		        'description' => 'Table Content Background Color',
		        'help' => 'Set Table Full Content Background Color'
	        ),
	    'month_table_weekend_columns_background_color' =>
	        array(
		        'description' => 'Weekend Column Background Color',
		        'help' => 'Set Weekend Column Background Color'
	        ),
	    'year_table_days_background_color' =>
	        array(
		        'description' => 'Days Background Color',
		        'help' => 'Days Background Color'
	        ),
    );

	public function get_theme_settings_by_id($id){
		if(empty(self::$tableName)){
			throw new \Exception('"tableName" field cannot be empty');
		}
		global $wpdb;

		$settings_by_id = array();
		$query = $wpdb->prepare("SELECT theme_id, theme_type, theme_option_key, theme_option_value FROM " . self::getTableName() . " WHERE theme_id = %d GROUP BY id", $id);

		$theme_settings = $wpdb->get_results($query);

		if (empty($theme_settings)) {
			return null;
		}
		foreach ($theme_settings as $setting){
			$settings_by_id[$setting->theme_type][$setting->theme_option_key] = $setting->theme_option_value;
		}
		return $settings_by_id;
	}

	public function get_theme_settings_fields_name(){

		if(empty(self::$tableName)){
			throw new \Exception('"tableName" field cannot be empty');
		}
		global $wpdb;

		$query = "SELECT theme_option_key FROM " . self::getTableName() . " GROUP BY theme_option_key";
		$theme_settings = $wpdb->get_results($query);

		if (empty($theme_settings)) {
			return null;
		}
		foreach ($theme_settings as $key => $setting){
			if(isset( $this->info[$setting->theme_option_key])) {
				$setting->description = $this->info[$setting->theme_option_key]['description'];
				$setting->help = $this->info[$setting->theme_option_key]['help'];
			}
		}
		return $theme_settings;
	}

	public function get_all_theme_settings(){
		if(empty(self::$tableName)){
			throw new \Exception('"tableName" field cannot be empty');
		}
		global $wpdb;

		$all_setting = array();
		$query = "SELECT theme_id, theme_type, theme_option_key, theme_option_value FROM " . self::getTableName();
		$theme_settings = $wpdb->get_results($query);

		if (empty($theme_settings)) {
			return null;
		}
		foreach ($theme_settings as $setting){
			$all_setting[$setting->theme_id][$setting->theme_type][$setting->theme_option_key] = $setting->theme_option_value;
		}
		return $all_setting;
	}

	/**
	 * @return array
	 */
    public function get_theme_settings(){
		return $this->theme_settings;
    }

	/**
	 * @param $theme_id int
	 * @param $key_option string
	 * @param $value_option string
	 * @param $theme_type string
	 * @return ThemeSettings
	 */
	public function set_theme_settings($theme_id, $theme_type, $key_option, $value_option){
		global $wpdb;

		$wpdb->query($wpdb->prepare('INSERT INTO ' .self::getTableName(). '(theme_id, theme_type, theme_option_key, theme_option_value) VALUES(%d,%s,%s,%s) ON DUPLICATE KEY UPDATE theme_option_value=%s', $theme_id, $theme_type, $key_option, $value_option, $value_option));

		$this->theme_settings[$theme_id][$theme_type][$key_option] = $value_option;
		return $this;
	}

	/**
	 * @return Theme
	 */
	public function get_theme()
	{
		return $this->theme;
	}

	/**
	 * @param $id int
	 * @return ThemeSettings
	 * @throws \Exception
	 */
	public function set_theme($id)
	{
		if(empty($id)){
			return $this;
		}

		if (absint($id) == $id) {
			$this->theme_id = absint($id);
			$this->theme = new Theme(array('id' => $this->theme_id));
		}

		return $this;
	}

}
<?php

namespace GDCalendar\Database\Migrations;

use GDCalendar\Models\Settings\ThemeSettings;

class UpdateThemeSettingTable extends ThemeSettings {

	public static function run(){
		self::updateDefaultThemeSettings();
	}

	private static function updateDefaultThemeSettings(){

		global $wpdb;

		$wpdb->query($wpdb->prepare("UPDATE " . self::getTableName() .
		                                 " SET theme_option_key = 
		                            case theme_option_key 
		                                when '%s' then 'view_button_bg_color'
		                                when '%s' then 'view_button_hover_bg_color'
	                                else theme_option_key
	                                end", "active_view_focus_bg_color", "active_view_hover_bg_color"
									)
					);
	}

}